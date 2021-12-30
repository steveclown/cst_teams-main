<?php
	Class CoreLanguage extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'language';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreLanguage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreLanguage-'.$unique['unique']);
			$this->session->unset_userdata('CoreLanguageToken-'.$unique['unique']);

			$data['main_view']['corelanguage']		= $this->CoreLanguage_model->getCoreLanguage();
			$data['main_view']['content']			= 'CoreLanguage/ListCoreLanguage_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreLanguage(){
			$unique 			= $this->session->userdata('unique');
			$language_token		= $this->session->userdata('CoreLanguageToken-'.$unique['unique']);

			if(empty($language_token)){
				$language_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreLanguageToken-'.$unique['unique'], $language_token);
			}
			$data['main_view']['content']		= 'CoreLanguage/FormAddCoreLanguage_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLanguage-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreLanguage-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLanguage-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreLanguage-'.$unique['unique'],$sessions);
			// echo $name;
		}
		function processAddCoreLanguage(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'language_code' 			=> $this->input->post('language_code',true),
				'language_name' 			=> $this->input->post('language_name',true),
				'language_token' 			=> $this->input->post('language_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$language_token 			= $this->CoreLanguage_model->getLanguageToken($data['language_token']);
			
			$this->form_validation->set_rules('language_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('language_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($language_token == 0){
					if($this->CoreLanguage_model->insertCoreLanguage($data)){
						$language_id 		= $this->CoreLanguage_model->getLanguageID($data['language_id']);


						$this->fungsi->set_log($auth['user_id'], $language_id, '3122', 'Application.CoreLanguage.processAddCoreLanguage', $language_id, 'Add New Core Language');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Language Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreLanguage-'.$unique['unique']);
						$this->session->unset_userdata('CoreLanguageToken-'.$unique['unique']);
						redirect('language/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Language Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreLanguage',$data);
						redirect('language/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Language Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('language/add');
				}
			}else{
				$this->session->set_userdata('addCoreLanguage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('language/add');
			}
		}
		
		function editCoreLanguage(){
			$data['main_view']['corelanguage']		= $this->CoreLanguage_model->getCoreLanguage_Detail($this->uri->segment(3));
			$data['main_view']['content']			= 'CoreLanguage/FormEditCoreLanguage_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$language_id	= $this->uri->segment(3);

			redirect('language/edit/'.$language_id);
		}
		
		function processEditCoreLanguage(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'language_id' 			=> $this->input->post('language_id',true),
				'language_code' 		=> $this->input->post('language_code',true),
				'language_name' 		=> $this->input->post('language_name',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);

			// print_r("data ");
			// print_r($data);
			// exit;
			
			$this->form_validation->set_rules('language_code', 'Language Code', 'required');
			$this->form_validation->set_rules('language_name', 'Language Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreLanguage_model->updateCoreLanguage($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['language_id'], '3122', 'Application.CoreLanguage.processEditCoreLanguage', $data['language_id'], 'Edit Core Language');


					$msg = "<div class='alert alert-success'>                
								Edit Data Language Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('language/edit/'.$data['language_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Language Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('language/edit/'.$data['language_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('language/edit/'.$data['language_id']);
			}
		}
		
				
		function deleteCoreLanguage(){
			$auth 			= $this->session->userdata('auth');
			$language_id 	= $this->uri->segment(3);

			$data = array(
				'language_id' 		=> $language_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreLanguage_model->deleteCoreLanguage($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['language_id'], '3122', 'Application.CoreLanguage.deleteCoreLanguage', $data['language_id'], 'Delete Core Language');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Language Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('language');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Language Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('language');
			}
		}
	}
?>