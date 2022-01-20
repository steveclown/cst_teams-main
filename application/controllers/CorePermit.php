<?php
	Class CorePermit extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'permit';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CorePermit_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCorePermit-'.$unique['unique']);
			$this->session->unset_userdata('CorePermitToken-'.$unique['unique']);

			$data['main_view']['corepermit']		= $this->CorePermit_model->getCorePermit();
			$data['main_view']['content']			= 'CorePermit/listCorePermit_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePermit-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCorePermit-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePermit-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCorePermit-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function addCorePermit(){
			$unique 			= $this->session->userdata('unique');
			$permit_token		= $this->session->userdata('CorePermitToken-'.$unique['unique']);

			if(empty($permit_token)){
				$permit_token = md5(date("YmdHis"));
				$this->session->set_userdata('CorePermitToken-'.$unique['unique'], $permit_token);
			}

			$data['main_view']['corededuction']		= create_double($this->CorePermit_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['content']			= 'CorePermit/FormAddCorePermit_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCorePermit-'.$sesi['unique']);	
			redirect('permit/add');
		}
		
		function processAddCorePermit(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'permit_code' 				=> $this->input->post('permit_code',true),
				'permit_name' 				=> $this->input->post('permit_name',true),
				'deduction_id' 				=> $this->input->post('deduction_id',true),
				'permit_token' 				=> $this->input->post('permit_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$permit_token 			= $this->CorePermit_model->getPermitToken($data['permit_token']);
			
			$this->form_validation->set_rules('permit_code', 'Kode Izin', 'required');
			$this->form_validation->set_rules('permit_name', 'Nama Izin', 'required');


			if($this->form_validation->run()==true){
				if ($permit_token == 0){
					if($this->CorePermit_model->insertCorePermit($data)){
						$permit_id 		= $this->CorePermit_model->getPermitID($data['permit_id']);


						$this->fungsi->set_log($auth['user_id'], $permit_id, '3122', 'Application.CorePermit.processAddCorePermit', $permit_id, 'Add New Core Permit');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Permit Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCorePermit-'.$unique['unique']);
						$this->session->unset_userdata('CorePermitToken-'.$unique['unique']);
						redirect('permit/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Permit Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCorePermit',$data);
						redirect('permit/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Permit Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('permit/add');
				}
			}else{
				$this->session->set_userdata('addCorePermit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('permit/add');
			}
		}
		
		public function editCorePermit(){
			$permit_id = $this->uri->segment(3);
			$data['main_view']['corededuction']		= create_double($this->CorePermit_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['corepermit']		= $this->CorePermit_model->getCorePermit_Detail($permit_id);
			$data['main_view']['content']			= 'CorePermit/FormeditCorePermit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$permit_id	= $this->uri->segment(3);

			redirect('permit/edit/'.$permit_id);
		}
		
		function processEditCorePermit(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'permit_id' 			=> $this->input->post('permit_id',true),
				'permit_code' 			=> $this->input->post('permit_code',true),
				'permit_name' 			=> $this->input->post('permit_name',true),
				'deduction_id' 		=> $this->input->post('deduction_id',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('permit_code', 'Permit Code', 'required');
			$this->form_validation->set_rules('permit_name', 'Permit Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CorePermit_model->updateCorePermit($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['permit_id'], '3122', 'Application.CorePermit.processEditCorePermit', $data['permit_id'], 'Edit Core Permit');


					$msg = "<div class='alert alert-success'>                
								Edit Data Permit Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('permit/edit/'.$data['permit_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Permit Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('permit/edit/'.$data['permit_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('permit/edit/'.$data['permit_id']);
			}
		}

		function deleteCorePermit(){
			$auth 			= $this->session->userdata('auth');
			$permit_id 	= $this->uri->segment(3);

			$data = array(
				'permit_id' 		=> $permit_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CorePermit_model->deleteCorePermit($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['permit_id'], '3122', 'Application.CorePermit.deleteCorePermit', $data['permit_id'], 'Delete Core Permit');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Permit Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('permit');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Permit Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('permit');
			}
		}
	}
?>