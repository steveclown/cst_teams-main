<?php
	Class CoreTrainingProvider extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreTrainingProvider_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreTrainingProvider']		= $this->CoreTrainingProvider_model->getCoreTrainingProvider();
			$data['main_view']['content']					= 'CoreTrainingProvider/listCoreTrainingProvider_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreTrainingProvider(){
			$data['main_view']['content']					= 'CoreTrainingProvider/formaddCoreTrainingProvider_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function function_state_add(){
			$unique 				= $this->session->userdata('unique');
			$value 					= $this->input->post('value',true);
			$sessions				= $this->session->userdata('addCoreTrainingProvider-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreTrainingProvider-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 			= $this->session->userdata('unique');
			$name 				= $this->input->post('name',true);
			$value 				= $this->input->post('value',true);
			$sessions			= $this->session->userdata('addCoreTrainingProvider-'.$unique['unique']);
			$sessions[$name] 	= $value;
			$this->session->set_userdata('addCoreTrainingProvider-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function processAddCoreTrainingProvider(){
			$data = array(
				'training_provider_code' 			=> $this->input->post('training_provider_code',true),
				'training_provider_name' 			=> $this->input->post('training_provider_name',true),
				'training_provider_address' 		=> $this->input->post('training_provider_address',true),
				'training_provider_city' 			=> $this->input->post('training_provider_city',true),
				'training_provider_home_phone' 		=> $this->input->post('training_provider_home_phone',true),
				'training_provider_mobile_phone' 	=> $this->input->post('training_provider_mobile_phone',true),
				'training_provider_fax_number' 		=> $this->input->post('training_provider_fax_number',true),
				'training_provider_email' 			=> $this->input->post('training_provider_email',true),
				'training_provider_contact_person' 	=> $this->input->post('training_provider_contact_person',true),
				'training_provider_remark' 			=> $this->input->post('training_provider_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('training_provider_code', 'Training Provider Code', 'required');
			$this->form_validation->set_rules('training_provider_name', 'Training Provider Name', 'required');
			$this->form_validation->set_rules('training_provider_address', 'Address', 'required');
			$this->form_validation->set_rules('training_provider_home_phone', 'Home Phone', 'required');
			$this->form_validation->set_rules('training_provider_city', 'City', 'required');
			$this->form_validation->set_rules('training_provider_contact_person', 'Contact Person', 'required');
			$this->form_validation->set_rules('training_provider_email', 'Training Provider Email', 'required|valid_emails');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingProvider_model->saveNewCoreTrainingProvider($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreTrainingProvider.processAddCoreTrainingProvider',$auth['user_id'],'Add New Training Provider');
					$msg = "<div class='alert alert-success'>                
								Add Data Training Provider Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreTrainingProvider');
					redirect('CoreTrainingProvider/addCoreTrainingProvider');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Training Provider UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreTrainingProvider',$data);
					redirect('CoreTrainingProvider/addCoreTrainingProvider');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreTrainingProvider',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProvider/addCoreTrainingProvider');
			}	
		}
		
		function editCoreTrainingProvider(){
			$data['main_view']['CoreTrainingProvider']	= $this->CoreTrainingProvider_model->getCoreTrainingProvider_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CoreTrainingProvider/formeditCoreTrainingProvider_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreTrainingProvider(){
			$data = array(
				'training_provider_id'	 			=> $this->input->post('training_provider_id',true),
				'training_provider_code' 			=> $this->input->post('training_provider_code',true),
				'training_provider_name' 			=> $this->input->post('training_provider_name',true),
				'training_provider_address' 		=> $this->input->post('training_provider_address',true),
				'training_provider_city' 			=> $this->input->post('training_provider_city',true),
				'training_provider_home_phone' 		=> $this->input->post('training_provider_home_phone',true),
				'training_provider_mobile_phone' 	=> $this->input->post('training_provider_mobile_phone',true),
				'training_provider_fax_number' 		=> $this->input->post('training_provider_fax_number',true),
				'training_provider_email' 			=> $this->input->post('training_provider_email',true),
				'training_provider_contact_person' 	=> $this->input->post('training_provider_contact_person',true),
				'training_provider_remark' 			=> $this->input->post('training_provider_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('training_provider_code', 'Training Provider Code', 'required');
			$this->form_validation->set_rules('training_provider_name', 'Training Provider Name', 'required');
			$this->form_validation->set_rules('training_provider_address', 'Address', 'required');
			$this->form_validation->set_rules('training_provider_home_phone', 'Home Phone', 'required');
			$this->form_validation->set_rules('training_provider_city', 'City', 'required');
			$this->form_validation->set_rules('training_provider_contact_person', 'Contact Person', 'required');
			$this->form_validation->set_rules('training_provider_email', 'Training Provider Email', 'required|valid_emails');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingProvider_model->saveEditCoreTrainingProvider($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.CoreTrainingProvider.processEditCoreTrainingProvider',$auth['user_id'],'Edit Training Provider');
					$this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['training_provider_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Provider Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingProvider/editCoreTrainingProvider/'.$data['training_provider_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Training Provider UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingProvider/editCoreTrainingProvider/'.$data['training_provider_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProvider/editCoreTrainingProvider/'.$data['training_provider_id']);
			}
		}
		

		function deleteCoreTrainingProvider(){
			if($this->CoreTrainingProvider_model->deleteCoreTrainingProvider($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreTrainingProvider.deleteCoreTrainingProvider',$auth['user_id'],'Delete Training Job Title');
				$msg = "<div class='alert alert-success'>                
							Delete Data Training Provider Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProvider');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Training Provider UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingProvider');
			}
		}
	}
?>