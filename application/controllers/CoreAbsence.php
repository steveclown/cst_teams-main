<?php
	Class CoreAbsence extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'absence';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreAbsence_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreAbsence-'.$unique['unique']);
			$this->session->unset_userdata('CoreAbsenceToken-'.$unique['unique']);

			$data['main_view']['coreabsence']		= $this->CoreAbsence_model->getCoreAbsence();
			$data['main_view']['content']			= 'CoreAbsence/ListCoreAbsence_view';
			$this->load->view('Mainpage_view',$data);
		}
		
		public function addCoreAbsence(){
			$unique 			= $this->session->userdata('unique');
			$absence_token		= $this->session->userdata('CoreAbsenceToken-'.$unique['unique']);

			if(empty($absence_token)){
				$absence_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreAbsenceToken-'.$unique['unique'], $absence_token);
			}

			$data['main_view']['corededuction']		= create_double($this->CoreAbsence_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['content']			= 'CoreAbsence/FormAddCoreAbsence_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreAbsence-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreAbsence-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreAbsence-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreAbsence-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreAbsence-'.$sesi['unique']);	
			redirect('CoreAbsence/addCoreAbsence');
		}
		
		function processAddCoreAbsence(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'absence_code' 				=> $this->input->post('absence_code',true),
				'absence_name' 				=> $this->input->post('absence_name',true),
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'absence_token' 			=> $this->input->post('absence_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$absence_token 			= $this->CoreAbsence_model->getAbsenceToken($data['absence_token']);
			
			$this->form_validation->set_rules('absence_code', 'Kode Absensi', 'required');
			$this->form_validation->set_rules('absence_name', 'Nama Absensi', 'required');


			if($this->form_validation->run()==true){
				if ($absence_token == 0){
					if($this->CoreAbsence_model->insertCoreAbsence($data)){
						$absence_id 		= $this->CoreAbsence_model->getAbsenceID($data['absence_id']);


						$this->fungsi->set_log($auth['user_id'], $absence_id, '3122', 'Application.CoreAbsence.processAddCoreAbsence', $absence_id, 'Add New Core Absence');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Absence Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreAbsence-'.$unique['unique']);
						$this->session->unset_userdata('CoreAbsenceToken-'.$unique['unique']);
						redirect('absence/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Absence Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreAbsence',$data);
						redirect('absence/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Absence Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('absence/add');
				}
			}else{
				$this->session->set_userdata('addCoreAbsence',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('absence/add');
			}
		}
		
		public function editCoreAbsence(){
			$absence_id = $this->uri->segment(3);
			$data['main_view']['corededuction']		= create_double($this->CoreAbsence_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['coreabsence']		= $this->CoreAbsence_model->getCoreAbsence_Detail($absence_id);
			$data['main_view']['content']			= 'CoreAbsence/FormeditCoreAbsence_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$absence_id	= $this->uri->segment(3);

			redirect('absence/edit/'.$absence_id);
		}
		
		function processEditCoreAbsence(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'absence_id' 			=> $this->input->post('absence_id',true),
				'absence_code' 			=> $this->input->post('absence_code',true),
				'absence_name' 			=> $this->input->post('absence_name',true),
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('absence_code', 'Absence Code', 'required');
			$this->form_validation->set_rules('absence_name', 'Absence Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreAbsence_model->updateCoreAbsence($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['absence_id'], '3122', 'Application.CoreAbsence.processEditCoreAbsence', $data['absence_id'], 'Edit Core Absence');


					$msg = "<div class='alert alert-success'>                
								Edit Data Absence Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('absence/edit/'.$data['absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Absence Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('absence/edit/'.$data['absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('absence/edit/'.$data['absence_id']);
			}
		}
		
				
		function deleteCoreAbsence(){
			$auth 			= $this->session->userdata('auth');
			$absence_id 	= $this->uri->segment(3);

			$data = array(
				'absence_id' 		=> $absence_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreAbsence_model->deleteCoreAbsence($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['absence_id'], '3122', 'Application.CoreAbsence.deleteCoreAbsence', $data['absence_id'], 'Delete Core Absence');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Absence Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('absence');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Absence Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('absence');
			}
		}
	}
?>