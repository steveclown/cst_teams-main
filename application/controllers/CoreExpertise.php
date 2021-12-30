<?php
	Class CoreExpertise extends MY_Controller{
		public function __construct(){
			parent::__construct();
			
			$menu = 'expertise';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreExpertise_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreExpertise-'.$unique['unique']);
			$this->session->unset_userdata('CoreExpertiseToken-'.$unique['unique']);

			$data['main_view']['coreexpertise']		= $this->CoreExpertise_model->getCoreExpertise();
			$data['main_view']['content']			= 'CoreExpertise/ListCoreExpertise_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreExpertise-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreExpertise-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreExpertise-'.$unique['unique']);
			$this->session->unset_userdata('CoreExpertiseToken-'.$unique['unique']);
			redirect('expretise/add');
		}
		
		function addCoreExpertise(){
			$unique 			= $this->session->userdata('unique');
			$expretise_token		= $this->session->userdata('CoreExpertiseToken-'.$unique['unique']);

			if(empty($expretise_token)){
				$expretise_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreExpertiseToken-'.$unique['unique'], $expretise_token);
			}

			$data['main_view']['content']		= 'CoreExpertise/FormAddCoreExpertise_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreExpertise(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'expertise_code' 			=> $this->input->post('expertise_code',true),
				'expertise_name' 			=> $this->input->post('expertise_name',true),
				'expertise_remark' 			=> $this->input->post('expertise_remark',true),
				'expertise_token' 			=> $this->input->post('expertise_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$expertise_token 			= $this->CoreExpertise_model->getExpertiseToken($data['expertise_token']);
			
			$this->form_validation->set_rules('expertise_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('expertise_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($expertise_token == 0){
					if($this->CoreExpertise_model->insertCoreExpertise($data)){
						$expertise_id 		= $this->CoreExpertise_model->getExpertiseID($data['expertise_id']);


						$this->fungsi->set_log($auth['user_id'], $expertise_id, '3122', 'Application.CoreExpertise.processAddCoreExpertise', $expertise_id, 'Add New Core Expertise');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Expertise Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreExpertise-'.$unique['unique']);
						$this->session->unset_userdata('CoreExpertiseToken-'.$unique['unique']);
						redirect('expertise/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Expertise Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreExpertise',$data);
						redirect('expertise/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Expertise Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('expertise/add');
				}
			}else{
				$this->session->set_userdata('addCoreExpertise',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('expertise/add');
			}
		}
		
		function editCoreExpertise(){
			$expertise_id 							= $this->uri->segment(3);
			$data['main_view']['coreexpertise']		= $this->CoreExpertise_model->getCoreExpertise_Detail($expertise_id);
			$data['main_view']['content']			= 'CoreExpertise/FormEditCoreExpertise_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 		= $this->session->userdata('unique');
			$expertise_id	= $this->uri->segment(3);

			redirect('expertise/edit/'.$expertise_id);
		}
		
		function processEditCoreExpertise(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'expertise_id' 			=> $this->input->post('expertise_id',true),
				'expertise_code' 		=> $this->input->post('expertise_code',true),
				'expertise_name' 		=> $this->input->post('expertise_name',true),
				'expertise_remark' 		=> $this->input->post('expertise_remark',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('expertise_code', 'Expertise Code', 'required');
			$this->form_validation->set_rules('expertise_name', 'Expertise Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreExpertise_model->updateCoreExpertise($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['expertise_id'], '3122', 'Application.CoreExpertise.processEditCoreExpertise', $data['expertise_id'], 'Edit Core Expertise');


					$msg = "<div class='alert alert-success'>                
								Edit Data Expertise Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('expertise/edit/'.$data['expertise_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Expertise Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('expertise/edit/'.$data['expertise_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('expertise/edit/'.$data['expertise_id']);
			}
		}
		
				
		function deleteCoreExpertise(){
			$auth 			= $this->session->userdata('auth');
			$expertise_id 	= $this->uri->segment(3);

			$data = array(
				'expertise_id' 		=> $expertise_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreExpertise_model->deleteCoreExpertise($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['expertise_id'], '3122', 'Application.CoreExpertise.deleteCoreExpertise', $data['expertise_id'], 'Delete Core Expertise');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Expertise Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('expertise');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Expertise Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('expertise');
			}
		}
	}
?>