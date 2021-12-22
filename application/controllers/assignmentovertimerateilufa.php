<?php
	Class assignmentovertimerateilufa extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('assignmentovertimerateilufa_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$data['main_view']['assignmentovertimerateilufa']	= $this->assignmentovertimerateilufa_model->getAssignmentOvertimeRate();
			$data['main_view']['content']						= 'assignmentovertimerateilufa/listassignmentovertimerateilufa_view';
			$this->load->view('mainpage_view',$data);
		}
			
		public function addAssignmentOvertimeRate(){
			$data['main_view']['corejobtitle']		= create_double($this->assignmentovertimerateilufa_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['content']			= 'assignmentovertimerateilufa/formaddassignmentovertimerateilufa_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addassignmentovertimerateilufa-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addassignmentovertimerateilufa-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addassignmentovertimerateilufa-'.$unique['unique']);	
			redirect('assignmentovertimerateilufa/addAssignmentOvertimeRate');
		}

		public function function_state_edit(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editcoreshift-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('editcoreshift-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editcoreshift-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editcoreshift-'.$unique['unique'],$sessions);
		}

		public function reset_edit(){
			$unique 			= $this->session->userdata('unique');

			$this->session->unset_userdata('editassignmentovertimerateilufa-'.$unique['unique']);
			redirect('assignmentovertimerateilufa/editAssignmentOvertimeRate/');
		}

		public function processAddAssignmentOvertimeRate(){
			$auth = $this->session->userdata('auth');

			$session_assignmentovertimerateilufatitle	= $this->session->userdata('addarrayassignmentovertimerateilufatitle-'.$unique['unique']);

			$data_overtimerate = array(
				'job_title_id'						=> $this->input->post('job_title_id',true),
				'overtime_rate_description'			=> $this->input->post('overtime_rate_description',true),
				'overtime_rate_effective_date'		=> tgltodb($this->input->post('overtime_rate_effective_date',true)),
				'overtime_rate_amount'				=> $this->input->post('overtime_rate_amount',true),
				'overtime_rate_trip_amount'			=> $this->input->post('overtime_rate_trip_amount',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")	
			);

			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('overtime_rate_description', 'Overtime Rate Description', 'required');
			$this->form_validation->set_rules('overtime_rate_effective_date', 'Overtime Rate Effective Date', 'required');
			$this->form_validation->set_rules('overtime_rate_amount', 'Overtime Rate Amount', 'required');
			$this->form_validation->set_rules('overtime_rate_trip_amount', 'Overtime Rate Trip Amount', 'required');
			
			if($this->form_validation->run()==true){
				if($this->assignmentovertimerateilufa_model->insertAssignmentOvertimeRate($data_overtimerate)){

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8142','Application.assignmentOvertimeRate.processAddAssignmentOvertimeRate',$overtime_rate_id,'Add New Assignment Overtime Rate');

					$msg = "<div class='alert alert-success'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
								Add Data Assignment Overtime Rate Successful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addassignmentovertimerateilufa-'.$unique['unique']);
					redirect('assignmentovertimerateilufa/addAssignmentOvertimeRate/');

				}else{
					$msg = "<div class='alert alert-danger'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
								Add Data Assignment Overtime Rate Fail
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentovertimerateilufa/addAssignmentOvertimeRate/');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addassignmentbusinesstrip',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerateilufa/addAssignmentOvertimeRate/');
			}
		}

		public function editAssignmentOvertimeRate(){
			$sesi 				= $this->session->userdata('unique');
			$unique 			= $this->session->userdata('unique');

			$overtime_rate_id 	= $this->uri->segment(3);
			
			$data['main_view']['assignmentovertimerateilufa']	= $this->assignmentovertimerateilufa_model->getAssignmentOvertimeRate_Detail($overtime_rate_id);

			$data['main_view']['corejobtitle']					= create_double($this->assignmentovertimerateilufa_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['content']						= 'assignmentovertimerateilufa/formeditassignmentovertimerateilufa_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditAssignmentOvertimeRate(){			
			$unique 				= $this->session->userdata('unique');
			
			$data_overtimerate = array(
				'overtime_rate_id'					=> $this->input->post('overtime_rate_id',true),
				'job_title_id'						=> $this->input->post('job_title_id',true),
				'overtime_rate_description'			=> $this->input->post('overtime_rate_description',true),
				'overtime_rate_effective_date'		=> tgltodb($this->input->post('overtime_rate_effective_date',true)),
				'overtime_rate_amount'				=> $this->input->post('overtime_rate_amount',true),
				'overtime_rate_trip_amount'			=> $this->input->post('overtime_rate_trip_amount',true)
			);

			if($this->assignmentovertimerateilufa_model->updateAssignmentOvertimeRate($data_overtimerate)){
				$auth = $this->session->userdata('auth');
				//
				$msg = "<div class='alert alert-success alert-dismissable'>   
					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
							Update Data Overtime Rate Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('editassignmentovertimerateilufa-'.$unique['unique']);
				redirect('assignmentovertimerateilufa/editAssignmentOvertimeRate/'.$data_overtimerate['overtime_rate_id']);
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>  
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>            
							Update Data Overtime Rate UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerateilufa/editAssignmentOvertimeRate/'.$data_overtimerate['overtime_rate_id']);
			}
		}
		
		public function deleteAssignmentOvertimeRate(){
			$overtime_rate_id = $this->uri->segment(3);
			if($this->assignmentovertimerateilufa_model->deleteAssignmentOvertimeRate($overtime_rate_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'],'8134','Application.assignmentOvertimeRate.processDeleteAssignmentOvertimeRate', $overtime_rate_id,'Delete Assignment Overtime Rate');

				$msg = "<div class='alert alert-success'>                
							Delete Data Overtime Rate Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerateilufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Overtime Rate Profile UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerateilufa');
			}
		}
	}
?>