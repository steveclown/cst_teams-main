<?php
	Class CoreLate extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'late';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreLate_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreLate-'.$unique['unique']);
			$this->session->unset_userdata('CoreLateToken-'.$unique['unique']);

			$data['main_view']['corelate']			= $this->CoreLate_model->getCoreLate();
			$data['main_view']['content']			= 'CoreLate/ListCoreLate_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreLate(){
			$unique 			= $this->session->userdata('unique');
			$late_token			= $this->session->userdata('CoreLateToken-'.$unique['unique']);

			if(empty($late_token)){
				$late_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreLateToken-'.$unique['unique'], $late_token);
			}

			$data['main_view']['corededuction']		= create_double($this->CoreLate_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['content']			= 'CoreLate/FormAddCoreLate_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreLate-'.$sesi['unique']);	
			redirect('late/add');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLate-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreLate-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLate-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreLate-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		function processAddCoreLate(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'late_code' 				=> $this->input->post('late_code',true),
				'late_name' 				=> $this->input->post('late_name',true),
				'deduction_id' 				=> $this->input->post('deduction_id',true),
				'late_token' 				=> $this->input->post('late_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$late_token 			= $this->CoreLate_model->getLateToken($data['late_token']);
			
			$this->form_validation->set_rules('late_code', 'Kode Terlambat', 'required');
			$this->form_validation->set_rules('late_name', 'Nama Terlambat', 'required');


			if($this->form_validation->run()==true){
				if ($late_token == 0){
					if($this->CoreLate_model->insertCoreLate($data)){
						$late_id 		= $this->CoreLate_model->getLateID($data['late_id']);


						$this->fungsi->set_log($auth['user_id'], $late_id, '3122', 'Application.CoreLate.processAddCoreLate', $late_id, 'Add New Core Late');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Late Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreLate-'.$unique['unique']);
						$this->session->unset_userdata('CoreLateToken-'.$unique['unique']);
						redirect('late/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Late Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreLate',$data);
						redirect('late/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Late Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('late/add');
				}
			}else{
				$this->session->set_userdata('addCoreLate',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('late/add');
			}
		}
		
		public function editCoreLate(){
			$late_id = $this->uri->segment(3);
			$data['main_view']['corededuction']		= create_double($this->CoreLate_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['corelate']			= $this->CoreLate_model->getCoreLate_Detail($late_id);
			$data['main_view']['content']			= 'CoreLate/FormEditCoreLate_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$late_id	= $this->uri->segment(3);

			redirect('late/edit/'.$late_id);
		}

		function processEditCoreLate(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'late_id' 				=> $this->input->post('late_id',true),
				'late_code' 			=> $this->input->post('late_code',true),
				'late_name' 			=> $this->input->post('late_name',true),
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('late_code', 'Late Code', 'required');
			$this->form_validation->set_rules('late_name', 'Late Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreLate_model->updateCoreLate($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['late_id'], '3122', 'Application.CoreLate.processEditCoreLate', $data['late_id'], 'Edit Core Late');


					$msg = "<div class='alert alert-success'>                
								Edit Data Late Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('late/edit/'.$data['late_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Late Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('late/edit/'.$data['late_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('late/edit/'.$data['late_id']);
			}
		}

		function deleteCoreLate(){
			$auth 			= $this->session->userdata('auth');
			$late_id 		= $this->uri->segment(3);

			$data = array(
				'late_id' 			=> $late_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreLate_model->deleteCoreLate($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['late_id'], '3122', 'Application.CoreLate.deleteCoreLate', $data['late_id'], 'Delete Core Late');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Late Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('late');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Late Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('late');
			}
		}
	}
?>