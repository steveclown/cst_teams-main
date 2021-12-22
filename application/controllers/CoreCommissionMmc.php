<?php
	Class CoreCommissionMmc extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreCommissionMmc_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreCommissionMmc']		= $this->CoreCommissionMmc_model->getCoreCommissionMmc();
			$data['main_view']['content']				= 'CoreCommissionMmc/listCoreCommissionMmc_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addCoreCommissionMmc(){
			$data['main_view']['corejobtitle']			= create_double($this->CoreCommissionMmc_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['content']				= 'CoreCommissionMmc/formaddCoreCommissionMmc_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreCommissionMmc-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreCommissionMmc-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreCommissionMmc-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreCommissionMmc-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreCommissionMmc-'.$unique['unique']);	
			redirect('CoreCommissionMmc/addCoreCommissionMmc');
		}

		public function function_elements_edit(){

			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editCoreCommissionMmc-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editCoreCommissionMmc-'.$unique['unique'],$sessions);
		}

		public function reset_edit(){
			$commission_mmc_id = $this->uri->segment(3);

			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('editCoreCommissionMmc-'.$unique['unique']);	
			redirect('CoreCommissionMmc/editCoreCommissionMmc/'.$commission_mmc_id);
		}
		
		public function processAddCoreCommissionMmc(){
			$unique	= $this->session->userdata('unique');

			$data = array(
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'commission_mmc_start_omzet'	=> $this->input->post('commission_mmc_start_omzet',true),
				'commission_mmc_end_omzet' 		=> $this->input->post('commission_mmc_end_omzet',true),
				'commission_mmc_unit'		 	=> $this->input->post('commission_mmc_unit',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('commission_mmc_start_omzet', 'Start Omzet', 'required');
			$this->form_validation->set_rules('commission_mmc_end_omzet', 'End Omzet', 'required');
			$this->form_validation->set_rules('commission_mmc_unit', 'Unit', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreCommissionMmc_model->insertCoreCommissionMmc($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreCommissionMmc.processAddlanguage',$auth['username'],'Add New coreCoreCommissionMmc');
					$msg = "<div class='alert alert-success'>                
								Add Data Commission MMC Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					
					$this->session->unset_userdata('addCoreCommissionMmc-'.$unique['unique']);	

					redirect('CoreCommissionMmc/addCoreCommissionMmc');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Commission MMC UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCommissionMmc/addCoreCommissionMmc');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreCommissionMmc',$data);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionMmc/addCoreCommissionMmc');
			}
		}
		
		public function editCoreCommissionMmc(){
			$commission_mmc_id = $this->uri->segment(3);

			$data['main_view']['corejobtitle']			= create_double($this->CoreCommissionMmc_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['CoreCommissionMmc']		= $this->CoreCommissionMmc_model->getCoreCommissionMmc_Detail($commission_mmc_id);

			$data['main_view']['content']				= 'CoreCommissionMmc/formeditCoreCommissionMmc_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreCommissionMmc(){
			
			$data = array(
				'commission_mmc_id' 			=> $this->input->post('commission_mmc_id',true),
				'job_title_id' 					=> $this->input->post('job_title_id',true),
				'commission_mmc_start_omzet'	=> $this->input->post('commission_mmc_start_omzet',true),
				'commission_mmc_end_omzet' 		=> $this->input->post('commission_mmc_end_omzet',true),
				'commission_mmc_unit'		 	=> $this->input->post('commission_mmc_unit',true),
			);

			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('commission_mmc_start_omzet', 'Start Omzet', 'required');
			$this->form_validation->set_rules('commission_mmc_end_omzet', 'End Omzet', 'required');
			$this->form_validation->set_rules('commission_mmc_unit', 'Unit', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreCommissionMmc_model->updateCoreCommissionMmc($data)){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreCommissionMmc.Edit',$auth['username'],'Edit Core Commission MMC');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreCommissionMmc_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Commission MMC Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCommissionMmc/editCoreCommissionMmc/'.$data['commission_mmc_id']);
				}else{		
					$msg = "<div class='alert alert-success'>                
								Edit Commission MMC UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCommissionMmc/editCoreCommissionMmc/'.$data['commission_mmc_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionMmc/editCoreCommissionMmc'.$data['commission_mmc_id']);
			}
		}
		
				
		public function deleteCoreCommissionMmc(){
			$commission_mmc_id = $this->uri->segment(3);
			if($this->CoreCommissionMmc_model->deleteCoreCommissionMmc($commission_mmc_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreCommissionMmc.delete',$auth['username'],'Delete coreCoreCommissionMmc');
				$msg = "<div class='alert alert-success'>                
							Delete Data Commission MMC Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionMmc');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Commission MMC UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCommissionMmc');
			}
		}
	}
?>