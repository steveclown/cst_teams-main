<?php
	Class CoreAppraisal extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreAppraisal_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreAppraisal']		= $this->CoreAppraisal_model->getCoreAppraisal();
			$data['main_view']['content']			= 'CoreAppraisal/listCoreAppraisal_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addCoreAppraisal(){
			$data['main_view']['appraisaltype']		= $this->configuration->AppraisalType();

			$data['main_view']['content']			= 'CoreAppraisal/formaddCoreAppraisal_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreAppraisal-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreAppraisal-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreAppraisal-'.$unique['unique']);
			redirect('CoreAppraisal/addCoreAppraisal');
		}
		
		public function processAddCoreAppraisal(){
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'appraisal_code' 			=> $this->input->post('appraisal_code',true),
				'appraisal_name' 			=> $this->input->post('appraisal_name',true),
				'appraisal_start_value' 	=> $this->input->post('appraisal_start_value',true),
				'appraisal_end_value' 		=> $this->input->post('appraisal_end_value',true),
				'appraisal_type' 			=> $this->input->post('appraisal_type',true),
				'appraisal_remark' 			=> $this->input->post('appraisal_remark',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('appraisal_code', 'Appraisal Code', 'required');
			$this->form_validation->set_rules('appraisal_name', 'Appraisal Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreAppraisal_model->insertCoreAppraisal($data)){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['username'],'1003','Application.CoreAppraisal.processAddlanguage',$auth['username'],'Add New coreCoreAppraisal');

					$msg = "<div class='alert alert-success'>                
								Add Data Appraisal Successful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					
					$this->session->unset_userdata('addCoreAppraisal-'.$unique['unique']);
					redirect('CoreAppraisal/addCoreAppraisal');
				}else{
					$msg = "<div class='alert alert-success'>                
								Add Data Appraisal Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAppraisal/addCoreAppraisal');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreAppraisal',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreAppraisal/addCoreAppraisal');
			}
		}
		
		public function editCoreAppraisal(){
			$appraisal_id 							= $this->uri->segment(3);

			$data['main_view']['appraisaltype']		= $this->configuration->AppraisalType();
			$data['main_view']['CoreAppraisal']		= $this->CoreAppraisal_model->getCoreAppraisal_Detail($appraisal_id);

			$data['main_view']['content']			= 'CoreAppraisal/formeditCoreAppraisal_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editCoreAppraisal-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editCoreAppraisal-'.$unique['unique'],$sessions);
		}

		public function reset_edit(){
			$appraisal_id 	= $this->uri->segment(3);
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('editCoreAppraisal-'.$unique['unique']);
			redirect('CoreAppraisal/editCoreAppraisal/'.$appraisal_id);
		}
		
		public function processEditCoreAppraisal(){
			
			$data = array(
				'appraisal_id' 				=> $this->input->post('appraisal_id',true),
				'appraisal_code' 			=> $this->input->post('appraisal_code',true),
				'appraisal_name' 			=> $this->input->post('appraisal_name',true),
				'appraisal_start_value' 	=> $this->input->post('appraisal_start_value',true),
				'appraisal_end_value' 		=> $this->input->post('appraisal_end_value',true),
				'appraisal_type' 			=> $this->input->post('appraisal_type',true),
				'appraisal_remark' 			=> $this->input->post('appraisal_remark',true),
			);

			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('appraisal_code', 'Appraisal Code', 'required');
			$this->form_validation->set_rules('appraisal_name', 'Appraisal Name', 'required');

			$old_data = $this->CoreAppraisal_model->getCoreAppraisal_Detail($data['appraisal_id']);

			if($this->form_validation->run()==true){
				if($this->CoreAppraisal_model->updateCoreAppraisal($data)==true){
					$auth 	= $this->session->userdata('auth');

					$this->fungsi->set_log($auth['username'],'1077','Application.CoreAppraisal.Edit',$auth['username'],'Edit coreCoreAppraisal');

					$this->fungsi->set_change_log($old_data, $data, $auth['username'],  $data[' appraisal_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Appraisal Successful 
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAppraisal/editCoreAppraisal/'.$data['appraisal_id']);
				}else{		
					$msg = "<div class='alert alert-success'>                
								Edit Appraisal Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAppraisal/editCoreAppraisal/'.$data['appraisal_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreAppraisal/editCoreAppraisal'.$data['appraisal_id']);
			}
		}
		
				
		public function deleteCoreAppraisal(){
			$appraisal_id = $this->uri->segment(3);

			$data = array (
				'appraisal_id'			=> $appraisal_id,
				'data_state'			=> 1
			);

			if($this->CoreAppraisal_model->deleteCoreAppraisal($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreAppraisal.delete',$auth['username'],'Delete coreCoreAppraisal');
				$msg = "<div class='alert alert-success'>                
							Delete Data Appraisal Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAppraisal');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Appraisal Fail
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAppraisal');
			}
		}
	}
?>