<?php
	Class hroemployeeprobationextending extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeprobationextending_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeprobationextending');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']			= create_double($this->hroemployeeprobationextending_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']		= create_double($this->hroemployeeprobationextending_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']			= create_double($this->hroemployeeprobationextending_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']		= create_double($this->hroemployeeprobationextending_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_probationextending']		= $this->hroemployeeprobationextending_model->getHROEmployeeData_ProbationExtending($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']				= 'hroemployeeprobationextending/listhroemployeeprobationextending_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeprobationextending',$data);
			redirect('payrollhospitalclaim');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeprobationextending-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeprobationextending-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeprobationextending-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeprobationextending-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeprobationextending');
			$this->session->unset_userdata('filter-hroemployeeprobationextending');
			redirect('hroemployeeprobationextending');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeestatusalteration-'.$sesi['unique']);	
			redirect('hroemployeeprobationextending');
		}
		
		public function addHROEmployeeProbationExtending(){
			$employee_id = $this->uri->segment(3);

			$data['main_view']['coreprobation']							= create_double($this->hroemployeeprobationextending_model->getCoreProbation(),'probation_id','probation_name');
			$data['main_view']['hroemployeedata']						= $this->hroemployeeprobationextending_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeprobationextending_data']	= $this->hroemployeeprobationextending_model->getHROEmployeeProbationExtending_Data($employee_id);
			$data['main_view']['content']								= 'hroemployeeprobationextending/listaddhroemployeeprobationextending_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeProbationExtending(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'probation_id' 						=> $this->input->post('probation_id',true),
				'probation_extending_description'	=> $this->input->post('probation_extending_description',true),
				'probation_extending_date' 			=> tgltodb($this->input->post('probation_extending_date',true)),
				'probation_extending_last_date' 	=> tgltodb($this->input->post('probation_extending_last_date',true)),
				'probation_extending_next_date' 	=> tgltodb($this->input->post('probation_extending_next_date',true)),
				'probation_extending_remark' 		=> $this->input->post('probation_extending_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('probation_id', 'Probation', 'required');
			$this->form_validation->set_rules('probation_extending_date', 'Probation Extending Date', 'required');
			$this->form_validation->set_rules('probation_extending_next_date', 'Probation Extending Next Date', 'required');
			$this->form_validation->set_rules('probation_extending_description', 'Probation Extending Description', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeprobationextending_model->saveNewHROEmployeeProbationExtending($data)){
					$this->hroemployeeprobationextending_model->updateNewHROEmployeeProbationExtending($data);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeProbationExtending.processAddHROEmployeeProbationExtending',$auth['user_id'],'Add New  Probation Extending');
					$msg = "<div class='alert alert-success'>                
								Add Data Probation Extending Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeprobationextending');
					redirect('hroemployeeprobationextending/addHROEmployeeProbationExtending/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Probation Extending UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeprobationextending/addHROEmployeeProbationExtending/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addhroemployeeprobationextending',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeprobationextending/addHROEmployeeProbationExtending/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeeprobationextending_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeprobationextending/edithroemployeeprobationextending_view';
			$data['main_view']['employee']		= create_double($this->hroemployeeprobationextending_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeprobationextending(){
			
			$data = array(
				'probation_extending_id' 				=> $this->input->post('probation_extending_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'probation_extending_date' 			=> $this->input->post('probation_extending_date',true),
				'probation_extending_due_date' 		=> $this->input->post('probation_extending_due_date',true),
				'probation_extending_remark' 		=> $this->input->post('probation_extending_remark',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('probation_extending_date', 'Date', 'required');
			$this->form_validation->set_rules('probation_extending_due_date', 'Due Date', 'required');
			$this->form_validation->set_rules('probation_extending_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeprobationextending_model->saveEdithroemployeeprobationextending($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeprobationextending.Edit',$auth['username'],'Edit Transactional Probation Extending');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['probation_extending_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Probation Extending Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeprobationextending/Edit/'.$data['probation_extending_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Probation Extending UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeprobationextending/Edit/'.$data['probation_extending_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeprobationextending/Edit/'.$data['probation_extending_id']);
			}
		}
		
		function deleteHROEmployeeProbationExtending_Data(){
			$employee_id = $this->uri->segment(3);
			$probation_extending_id = $this->uri->segment(4);
			if($this->hroemployeeprobationextending_model->deleteHROEmployeeProbationExtending_Data($probation_extending_id, $employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.hroemployeeprobationextending.delete',$auth['username'],'Delete hroemployeeprobationextending');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Probation Extending Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeprobationextending');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Probation Extending UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeprobationextending');
			}
		}
	}
?>