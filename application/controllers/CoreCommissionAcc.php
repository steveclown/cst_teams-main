<?php
	Class CoreCommissionAcc extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreCommissionAcc_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreCommissionAcc']		= $this->CoreCommissionAcc_model->getCoreCommissionAcc();
			$data['main_view']['content']				= 'CoreCommissionAcc/listCoreCommissionAcc_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addCoreCommissionAcc(){
			$data['main_view']['corejobtitle']			= create_double($this->CoreCommissionAcc_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['content']				= 'CoreCommissionAcc/formaddCoreCommissionAcc_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreCommissionAcc-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreCommissionAcc-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreCommissionAcc-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreCommissionAcc-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreCommissionAcc-'.$unique['unique']);	
			redirect('CoreCommissionAcc/addCoreCommissionAcc');
		}

		public function function_elements_edit(){

			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editCoreCommissionAcc-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editCoreCommissionAcc-'.$unique['unique'],$sessions);
		}

		public function reset_edit(){
			$commission_acc_id = $this->uri->segment(3);

			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('editCoreCommissionAcc-'.$unique['unique']);	
			redirect('CoreCommissionAcc/editCoreCommissionAcc/'.$commission_acc_id);
		}
		
		public function processAddCoreCommissionAcc(){
			$unique	= $this->session->userdata('unique');

			$data = array(
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'commission_acc_start_omzet'	=> $this->input->post('commission_acc_start_omzet',true),
				'commission_acc_end_omzet' 		=> $this->input->post('commission_acc_end_omzet',true),
				'commission_acc_percentage' 	=> $this->input->post('commission_acc_percentage',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('commission_acc_start_omzet', 'Start Omzet', 'required');
			$this->form_validation->set_rules('commission_acc_end_omzet', 'End Omzet', 'required');
			$this->form_validation->set_rules('commission_acc_percentage', 'Percentage', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreCommissionAcc_model->insertCoreCommissionAcc($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreCommissionAcc.processAddlanguage',$auth['username'],'Add New coreCoreCommissionAcc');
					$msg = "<div class='alert alert-success'>                
								Add Data Commission Accesories Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					
					$this->session->unset_userdata('addCoreCommissionAcc-'.$unique['unique']);	

					redirect('CoreCommissionAcc/addCoreCommissionAcc');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Commission Accesories UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCommissionAcc/addCoreCommissionAcc');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreCommissionAcc',$data);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionAcc/addCoreCommissionAcc');
			}
		}
		
		public function editCoreCommissionAcc(){
			$commission_acc_id = $this->uri->segment(3);

			$data['main_view']['corejobtitle']			= create_double($this->CoreCommissionAcc_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['CoreCommissionAcc']		= $this->CoreCommissionAcc_model->getCoreCommissionAcc_Detail($commission_acc_id);

			$data['main_view']['content']				= 'CoreCommissionAcc/formeditCoreCommissionAcc_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreCommissionAcc(){
			
			$data = array(
				'commission_acc_id' 			=> $this->input->post('commission_acc_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'commission_acc_start_omzet'	=> $this->input->post('commission_acc_start_omzet',true),
				'commission_acc_end_omzet' 		=> $this->input->post('commission_acc_end_omzet',true),
				'commission_acc_percentage' 	=> $this->input->post('commission_acc_percentage',true),
			);

			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('commission_acc_start_omzet', 'Start Omzet', 'required');
			$this->form_validation->set_rules('commission_acc_end_omzet', 'End Omzet', 'required');
			$this->form_validation->set_rules('commission_acc_percentage', 'Percentage', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreCommissionAcc_model->updateCoreCommissionAcc($data)){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreCommissionAcc.Edit',$auth['username'],'Edit Core Commission Accesories');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreCommissionAcc_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Commission Accesories Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCommissionAcc/editCoreCommissionAcc/'.$data['commission_acc_id']);
				}else{		
					$msg = "<div class='alert alert-success'>                
								Edit Commission Accesories UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCommissionAcc/editCoreCommissionAcc/'.$data['commission_acc_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionAcc/editCoreCommissionAcc'.$data['commission_acc_id']);
			}
		}
		
				
		public function deleteCoreCommissionAcc(){
			$commission_acc_id = $this->uri->segment(3);
			if($this->CoreCommissionAcc_model->deleteCoreCommissionAcc($commission_acc_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreCommissionAcc.delete',$auth['username'],'Delete coreCoreCommissionAcc');
				$msg = "<div class='alert alert-success'>                
							Delete Data Commission Accesories Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionAcc');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Commission Accesories UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionAcc');
			}
		}
	}
?>