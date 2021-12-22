<?php
	Class CoreSection extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'section';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreSection_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSection-'.$unique['unique']);
			$this->session->unset_userdata('CoreSectionToken-'.$unique['unique']);

			$data['main_view']['coresection']		= $this->CoreSection_model->getCoreSection();
			$data['main_view']['content']			= 'CoreSection/ListCoreSection_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreSection-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreSection-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSection-'.$unique['unique']);
			$this->session->unset_userdata('CoreSectionToken-'.$unique['unique']);
			redirect('section/add');
		}
		
		function addCoreSection(){
			$unique 			= $this->session->userdata('unique');
			$section_token		= $this->session->userdata('CoreSectionToken-'.$unique['unique']);

			if(empty($section_token)){
				$section_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreSectionToken-'.$unique['unique'], $section_token);
			}

			$data['main_view']['coredepartment']	= create_double($this->CoreSection_model->getCoreDepartment(),'department_id','department_name');

			$data['main_view']['content']		= 'CoreSection/FormAddCoreSection_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreSection(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'department_id' 				=> $this->input->post('department_id',true),
				'section_code' 			=> $this->input->post('section_code',true),
				'section_name' 			=> $this->input->post('section_name',true),
				'section_token' 			=> $this->input->post('section_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$section_token 			= $this->CoreSection_model->getSectionToken($data['section_token']);
			
			$this->form_validation->set_rules('department_id', 'Nama Devisi', 'required');
			$this->form_validation->set_rules('section_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('section_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($section_token == 0){
					if($this->CoreSection_model->insertCoreSection($data)){
						$section_id 		= $this->CoreSection_model->getSectionID($data['section_id']);


						$this->fungsi->set_log($auth['user_id'], $section_id, '3122', 'Application.CoreSection.processAddCoreSection', $section_id, 'Add New Core Section');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Section Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreSection-'.$unique['unique']);
						$this->session->unset_userdata('CoreSectionToken-'.$unique['unique']);
						redirect('section/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Section Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreSection',$data);
						redirect('section/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Section Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('section/add');
				}
			}else{
				$this->session->set_userdata('addCoreSection',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('section/add');
			}
		}
		
		function editCoreSection(){
			$section_id 							= $this->uri->segment(3);
			$data['main_view']['coredepartment']	= create_double($this->CoreSection_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']		= $this->CoreSection_model->getCoreSection_Detail($section_id);
			$data['main_view']['content']			= 'CoreSection/FormEditCoreSection_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 		= $this->session->userdata('unique');
			$section_id	= $this->uri->segment(3);

			redirect('section/edit/'.$section_id);
		}
		
		function processEditCoreSection(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'section_id' 			=> $this->input->post('section_id',true),
				'department_id' 		=> $this->input->post('department_id',true),
				'section_code' 			=> $this->input->post('section_code',true),
				'section_name' 			=> $this->input->post('section_name',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('department_id', 'Nama Department', 'required');
			$this->form_validation->set_rules('section_code', 'Section Code', 'required');
			$this->form_validation->set_rules('section_name', 'Section Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreSection_model->updateCoreSection($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['section_id'], '3122', 'Application.CoreSection.processEditCoreSection', $data['section_id'], 'Edit Core Section');


					$msg = "<div class='alert alert-success'>                
								Edit Data Section Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('section/edit/'.$data['section_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Section Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('section/edit/'.$data['section_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('section/edit/'.$data['section_id']);
			}
		}
		
				
		function deleteCoreSection(){
			$auth 			= $this->session->userdata('auth');
			$section_id 	= $this->uri->segment(3);

			$data = array(
				'section_id' 		=> $section_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreSection_model->deleteCoreSection($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['section_id'], '3122', 'Application.CoreSection.deleteCoreSection', $data['section_id'], 'Delete Core Section');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Section Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('section');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Section Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('section');
			}
		}
	}
?>