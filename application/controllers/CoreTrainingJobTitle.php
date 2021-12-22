<?php
	Class CoreTrainingJobTitle extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreTrainingJobTitle_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreTrainingJobTitle']		= $this->CoreTrainingJobTitle_model->getCoreTrainingJobTitle();
			$data['main_view']['content']					= 'CoreTrainingJobTitle/listCoreTrainingJobTitle_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreTrainingJobTitle(){
			$data['main_view']['content']				= 'CoreTrainingJobTitle/formaddCoreTrainingJobTitle_view';
			$data['main_view']['coretrainingtitle']		= create_double($this->CoreTrainingJobTitle_model->getCoreTrainingTitle(),'training_title_id','training_title_name');
			$data['main_view']['corejobtitle']			= create_double($this->CoreTrainingJobTitle_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreTrainingJobTitle-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreTrainingJobTitle-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreTrainingJobTitle-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreTrainingJobTitle-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		function processAddCoreTrainingJobTitle(){
			$data = array(
				'training_title_id' 			=> $this->input->post('training_title_id',true),
				'job_title_id'	 				=> $this->input->post('job_title_id',true),
				'training_job_title_code' 		=> $this->input->post('training_job_title_code',true),
				'training_job_title_name' 		=> $this->input->post('training_job_title_name',true),
				'training_job_title_remark' 	=> $this->input->post('training_job_title_remark',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('training_job_title_code', 'training_job_title Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('training_job_title_name', 'training_job_title Name', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingJobTitle_model->saveNewCoreTrainingJobTitle($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreTrainingJobTitle.processAddCoreTrainingJobTitle',$auth['user_id'],'Add New Training Job Title');
					$msg = "<div class='alert alert-success'>                
								Add Data Training Jobtitle Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreTrainingJobTitle');
					redirect('CoreTrainingJobTitle/addCoreTrainingJobTitle');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Training Jobtitle UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddTrainingJobTitle',$data);
					redirect('CoreTrainingJobTitle/addCoreTrainingJobTitle');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddTrainingJobTitle',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingJobTitle/addCoreTrainingJobTitle');
			}
		}
		
		function editCoreTrainingJobTitle(){
			$data['main_view']['CoreTrainingJobTitle']	= $this->CoreTrainingJobTitle_model->getCoreTrainingJobTitle_Detail($this->uri->segment(3));
			$data['main_view']['coretrainingtitle']		= create_double($this->CoreTrainingJobTitle_model->getCoreTrainingTitle(),'training_title_id','training_title_name');
			$data['main_view']['corejobtitle']			= create_double($this->CoreTrainingJobTitle_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['content']				= 'CoreTrainingJobTitle/formeditCoreTrainingJobTitle_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreTrainingJobTitle(){
			$data = array(
				'training_job_title_id' 		=> $this->input->post('training_job_title_id',true),
				'training_title_id' 			=> $this->input->post('training_title_id',true),
				'job_title_id'	 				=> $this->input->post('job_title_id',true),
				'training_job_title_code' 		=> $this->input->post('training_job_title_code',true),
				'training_job_title_name' 		=> $this->input->post('training_job_title_name',true),
				'training_job_title_remark' 	=> $this->input->post('training_job_title_remark',true),
				'data_state'					=> 0
			);
			// print_r ($data); exit;
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('training_job_title_code', 'Training Job Title Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('training_job_title_name', 'Training Job Title Name', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingJobTitle_model->saveEditCoreTrainingJobTitle($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.CoreTrainingJobTitle.processEditCoreTrainingJobTitle',$auth['user_id'],'Edit Training Job Title');
					$this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['training_job_title_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Job Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingJobTitle/editCoreTrainingJobTitle/'.$data['training_job_title_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Training Job Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingJobTitle/editCoreTrainingJobTitle/'.$data['training_job_title_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingJobTitle/editCoreTrainingJobTitle/'.$data['training_job_title_id']);
			}
		}
		

		function deleteCoreTrainingJobTitle(){
			if($this->CoreTrainingJobTitle_model->deleteCoreTrainingJobTitle($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreTrainingJobTitle.deleteCoreTrainingJobTitle',$auth['user_id'],'Delete Training Job Title');
				$msg = "<div class='alert alert-success'>                
							Delete Data Training Job Title Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingJobTitle');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Training Jobtitle UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingJobTitle');
			}
		}
	}
?>