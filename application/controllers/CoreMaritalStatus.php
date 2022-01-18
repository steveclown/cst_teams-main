<?php
	Class CoreMaritalStatus extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'marital-status';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreMaritalStatus_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreMaritalStatus-'.$unique['unique']);
			$this->session->unset_userdata('CoreMaritalStatusToken-'.$unique['unique']);

			$data['main_view']['coremaritalstatus']		= $this->CoreMaritalStatus_model->getCoreMaritalStatus();
			$data['main_view']['content']				= 'CoreMaritalStatus/ListCoreMaritalStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreMaritalStatus(){
			$unique 					= $this->session->userdata('unique');
			$marital_status_token		= $this->session->userdata('CoreMaritalStatusToken-'.$unique['unique']);

			if(empty($marital_status_token)){
				$marital_status_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreMaritalStatusToken-'.$unique['unique'], $marital_status_token);
			}
			$data['main_view']['content']				= 'CoreMaritalStatus/FormAddCoreMaritalStatus_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreMaritalStatus-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreMaritalStatus-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreMaritalStatus-'.$unique['unique']);
			$this->session->unset_userdata('CoreMaritalStatusToken-'.$unique['unique']);
			redirect('maritalstatus/add');
		}
		
		function processAddCoreMaritalStatus(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'marital_status_code' 				=> $this->input->post('marital_status_code',true),
				'marital_status_name' 				=> $this->input->post('marital_status_name',true),
				'marital_status_token' 				=> $this->input->post('marital_status_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$marital_status_token 			= $this->CoreMaritalStatus_model->getMaritalStatusToken($data['marital_status_token']);
			
			$this->form_validation->set_rules('marital_status_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('marital_status_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($marital_status_token == 0){
					if($this->CoreMaritalStatus_model->insertCoreMaritalStatus($data)){
						$marital_status_id 		= $this->CoreMaritalStatus_model->getMaritalStatusID($data['marital_status_id']);


						$this->fungsi->set_log($auth['user_id'], $marital_status_id, '3122', 'Application.CoreMaritalStatus.processAddCoreMaritalStatus', $marital_status_id, 'Add New Core MaritalStatus');

						$msg = "<div class='alert alert-success'>                
									Tambah Data MaritalStatus Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreMaritalStatus-'.$unique['unique']);
						$this->session->unset_userdata('CoreMaritalStatusToken-'.$unique['unique']);
						redirect('maritalstatus/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data MaritalStatus Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreMaritalStatus',$data);
						redirect('maritalstatus/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data MaritalStatus Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('maritalstatus/add');
				}
			}else{
				$this->session->set_userdata('addCoreMaritalStatus',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('maritalstatus/add');
			}
		}
		
		function editCoreMaritalStatus(){
			$data['main_view']['coremaritalstatus']		= $this->CoreMaritalStatus_model->getCoreMaritalStatus_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CoreMaritalStatus/FormEditCoreMaritalStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$marital_status_id	= $this->uri->segment(3);

			redirect('marital_tatus/edit/'.$marital_status_id);
		}
		
		function processEditCoreMaritalStatus(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'marital_status_id' 				=> $this->input->post('marital_status_id',true),
				'marital_status_code' 			=> $this->input->post('marital_status_code',true),
				'marital_status_name' 			=> $this->input->post('marital_status_name',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('marital_status_code', 'MaritalStatus Code', 'required');
			$this->form_validation->set_rules('marital_status_name', 'MaritalStatus Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreMaritalStatus_model->updateCoreMaritalStatus($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['marital_status_id'], '3122', 'Application.CoreMaritalStatus.processEditCoreMaritalStatus', $data['marital_status_id'], 'Edit Core MaritalStatus');


					$msg = "<div class='alert alert-success'>                
								Edit Data MaritalStatus Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('marital-status/edit/'.$data['marital_status_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data MaritalStatus Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('marital-status/edit/'.$data['marital_status_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('marital-status/edit/'.$data['marital_status_id']);
			}
		}
		
				
		function deleteCoreMaritalStatus(){
			$auth 			= $this->session->userdata('auth');
			$marital_status_id 	= $this->uri->segment(3);

			$data = array(
				'marital_status_id' 		=> $marital_status_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreMaritalStatus_model->deleteCoreMaritalStatus($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['marital_status_id'], '3122', 'Application.CoreMaritalStatus.deleteCoreMaritalStatus', $data['marital_status_id'], 'Delete Core MaritalStatus');

				$msg = "<div class='alert alert-success'>                
							Hapus Data MaritalStatus Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('maritalstatus');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data MaritalStatus Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('maritalstatus');
			}
		}
	}
?>