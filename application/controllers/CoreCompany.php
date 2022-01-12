<?php
	Class CoreCompany extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'company';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreCompany_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreCompany-'.$unique['unique']);
			$this->session->unset_userdata('CoreCompanyToken-'.$unique['unique']);

			$data['main_view']['corecompany']		= $this->CoreCompany_model->getCoreCompany();
			$data['main_view']['content']			= 'CoreCompany/ListCoreCompany_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreCompany-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreCompany-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreCompany-'.$unique['unique']);
			$this->session->unset_userdata('CoreCompanyToken-'.$unique['unique']);
			redirect('company/add');
		}
		
		function addCoreCompany(){
			$unique 		= $this->session->userdata('unique');
			$company_token	= $this->session->userdata('CoreCompanyToken-'.$unique['unique']);

			if(empty($company_token)){
				$company_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreCompanyToken-'.$unique['unique'], $company_token);
			}

			$data['main_view']['content']		= 'CoreCompany/FormAddCoreCompany_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreCompany(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'company_code' 		=> $this->input->post('company_code',true),
				'company_name' 		=> $this->input->post('company_name',true),
				'company_token' 		=> $this->input->post('company_token',true),
				'created_id' 		=> $auth['user_id'],
				'created_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 0
			);

			$company_token 			= $this->CoreCompany_model->getCompanyToken($data['company_token']);
			
			$this->form_validation->set_rules('company_code', 'Company Code', 'required');
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');


			if($this->form_validation->run()==true){
				if ($company_token == 0){
					if($this->CoreCompany_model->insertCoreCompany($data)){
						$company_id 		= $this->CoreCompany_model->getCompanyID($data['company_id']);


						$this->fungsi->set_log($auth['user_id'], $company_id, '3122', 'Application.CoreCompany.processAddCoreCompany', $company_id, 'Add New Core Company');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Company Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreCompany-'.$unique['unique']);
						$this->session->unset_userdata('CoreCompanyToken-'.$unique['unique']);
						redirect('company/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Company Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreCompany',$data);
						redirect('company/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Company Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('company/add');
				}
			}else{
				$this->session->set_userdata('addCoreCompany',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('company/add');
			}
		}
		
		function editCoreCompany(){
			$company_id 							= $this->uri->segment(3);
			$data['main_view']['corecompany']	= $this->CoreCompany_model->getCoreCompany_Detail($company_id);
			$data['main_view']['content']		= 'CoreCompany/FormEditCoreCompany_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$company_id	= $this->uri->segment(3);

			redirect('company/edit/'.$company_id);
		}
		
		function processEditCoreCompany(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'company_id' 		=> $this->input->post('company_id',true),
				'company_code' 		=> $this->input->post('company_code',true),
				'company_name' 		=> $this->input->post('company_name',true),
				'updated_id' 		=> $auth['user_id'],
				'updated_on' 		=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('company_code', 'Company Code', 'required');
			$this->form_validation->set_rules('company_name', 'Company Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreCompany_model->updateCoreCompany($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['company_id'], '3122', 'Application.CoreCompany.processEditCoreCompany', $data['company_id'], 'Edit Core Company');


					$msg = "<div class='alert alert-success'>                
								Edit Data Company Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('company/edit/'.$data['company_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Company Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('company/edit/'.$data['company_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('company/edit/'.$data['company_id']);
			}
		}
		
				
		function deleteCoreCompany(){
			$auth 		= $this->session->userdata('auth');
			$company_id 	= $this->uri->segment(3);

			$data = array(
				'company_id' 		=> $company_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreCompany_model->deleteCoreCompany($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['company_id'], '3122', 'Application.CoreCompany.deleteCoreCompany', $data['company_id'], 'Delete Core Company');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Company Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('company');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Company Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('company');
			}
		}
	}
?>