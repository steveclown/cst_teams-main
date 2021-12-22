<?php
	Class CoreHomeEarly extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreHomeEarly_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreHomeEarly']		= $this->CoreHomeEarly_model->getCoreHomeEarly();
			$data['main_view']['content']			= 'CoreHomeEarly/listCoreHomeEarly_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreHomeEarly(){
			$data['main_view']['corededuction']		= create_double($this->CoreHomeEarly_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['content']			= 'CoreHomeEarly/formaddCoreHomeEarly_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreHomeEarly-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreHomeEarly-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreHomeEarly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreHomeEarly-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreHomeEarly-'.$sesi['unique']);	
			redirect('CoreHomeEarly/addCoreHomeEarly');
		}
		
		public function processAddCoreHomeEarly(){
			$data = array(
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'home_early_code' 		=> $this->input->post('home_early_code',true),
				'home_early_name' 		=> $this->input->post('home_early_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('home_early_code', 'HomeEarly Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('home_early_name', 'HomeEarly Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreHomeEarly_model->saveNewCoreHomeEarly($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.coreHomeEarly.processAddCoreHomeEarly',$auth['user_id'],'Add New Home Early');
					$msg = "<div class='alert alert-success'>                
								Add Data Home Early Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreHomeEarly');
					redirect('CoreHomeEarly/addCoreHomeEarly');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Home Early UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreHomeEarly',$data);
					redirect('CoreHomeEarly/addCoreHomeEarly');
				}
			}else{
				$this->session->set_userdata('addCoreHomeEarly',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreHomeEarly/addCoreHomeEarly');
			}
		}
		
		public function editCoreHomeEarly(){
			$home_early_id = $this->uri->segment(3);
			$data['main_view']['corededuction']		= create_double($this->CoreHomeEarly_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['CoreHomeEarly']		= $this->CoreHomeEarly_model->getCoreHomeEarly_Detail($home_early_id);
			$data['main_view']['content']			= 'CoreHomeEarly/formeditCoreHomeEarly_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreHomeEarly(){
			
			$data = array(
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'home_early_id' 		=> $this->input->post('home_early_id',true),
				'home_early_code' 		=> $this->input->post('home_early_code',true),
				'home_early_name' 		=> $this->input->post('home_early_name',true),
				'data_state'			=> 0
			);

			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('home_early_code', 'Home Early Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('home_early_name', 'Home Early Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreHomeEarly_model->saveEditCoreHomeEarly($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.CoreHomeEarly.editCoreHomeEarly',$auth['user_id'],'Edit HomeEarly');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['homeearly_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Home Early Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreHomeEarly/editCoreHomeEarly/'.$data['home_early_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Edit Home Early UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreHomeEarly/editCoreHomeEarly/'.$data['home_early_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreHomeEarly/editCoreHomeEarly/'.$data['home_early_id']);
			}
		}

		public function deleteCoreHomeEarly(){
			$home_early_id = $this->uri->segment(3);
			if($this->CoreHomeEarly_model->deleteCoreHomeEarly($home_early_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.coreHomeEarly.deleteCoreHomeEarly',$auth['user_id'],'Delete HomeEarly');
				$msg = "<div class='alert alert-success'>                
							Delete Data HomeEarly Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreHomeEarly');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data HomeEarly UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreHomeEarly');
			}
		}
	}
?>