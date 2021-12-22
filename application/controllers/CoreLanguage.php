<?php
	Class CoreLanguage extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreLanguage_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreLanguage']	= $this->CoreLanguage_model->getCoreLanguage();
			$data['Main_view']['content']		= 'CoreLanguage/listCoreLanguage_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreLanguage(){
			$data['Main_view']['content']		= 'CoreLanguage/formaddCoreLanguage_view';
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
			$data = array(
				'language_code' 			=> $this->input->post('language_code',true),
				'language_name' 			=> $this->input->post('language_name',true),
				'data_state'				=> '0'
				
			);
			
			$this->form_validation->set_rules('language_code', 'Language Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('language_name', 'Language Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreLanguage_model->saveNewCoreLanguage($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreLanguage.processaddCoreLanguage',$auth['username'],'Add New CoreLanguage');
					$msg = "<div class='alert alert-success'>                
								Add Data Language Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreLanguage');
					redirect('CoreLanguage/addCoreLanguage');
				}else{
					$msg = "<div class='alert alert-danger'>
								Add Data Language UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLanguage/addCoreLanguage');
				}
			}else{
				$this->session->set_userdata('addCoreLanguage',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreLanguage/addCoreLanguage');
			}
		}
		
		function editCoreLanguage(){
			$data['Main_view']['CoreLanguage']		= $this->CoreLanguage_model->getCoreLanguage_Detail($this->uri->segment(3));
			$data['Main_view']['content']			= 'CoreLanguage/formeditCoreLanguage_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreLanguage(){
			
			$data = array(
				'language_id' 				=> $this->input->post('language_id',true),
				'language_code' 			=> $this->input->post('language_code',true),
				'language_name' 			=> $this->input->post('language_name',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('language_code', 'Language Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('language_name', 'Language Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreLanguage_model->saveEditCoreLanguage($data)==true){
					$auth 	= $this->session->userdata('auth');
					
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreLanguage.edit',$auth['username'],'Edit CoreLanguage');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['language_id']);
					$msg = "<div class='alert alert-success alert-dismissable'>                
								Edit Language Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLanguage/editCoreLanguage/'.$data['language_id']);

				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Language UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLanguage/editCoreLanguage/'.$data['language_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreLanguage/editCoreLanguage/'.$data['language_id']);
			}
		}
		
				
		function deleteCoreLanguage(){
			if($this->CoreLanguage_model->deleteCoreLanguage($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreLanguage.delete',$auth['username'],'Delete CoreLanguage');
				$msg = "<div class='alert alert-success'>                
							Delete Data Language Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLanguage');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Language UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLanguage');
			}
		}
	}
?>