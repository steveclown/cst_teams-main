<?php
	Class hroemployeecontractextending extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeecontractextending_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeecontractextending');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']			= create_double($this->hroemployeecontractextending_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']		= create_double($this->hroemployeecontractextending_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']			= create_double($this->hroemployeecontractextending_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']		= create_double($this->hroemployeecontractextending_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_contractextending']		= $this->hroemployeecontractextending_model->getHROEmployeeData_ContractExtending($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']				= 'hroemployeecontractextending/listhroemployeecontractextending_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeecontractextending',$data);
			redirect('payrollhospitalclaim');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeecontractextending-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeecontractextending-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeecontractextending-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeecontractextending-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeecontractextending');
			$this->session->unset_userdata('filter-hroemployeecontractextending');
			redirect('hroemployeecontractextending');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeestatusalteration-'.$sesi['unique']);	
			redirect('hroemployeecontractextending');
		}
		
		public function addHROEmployeeContractExtending(){
			$employee_id = $this->uri->segment(3);

			$data['main_view']['corecontract']							= create_double($this->hroemployeecontractextending_model->getCoreContract(),'contract_id','contract_name');
			$data['main_view']['hroemployeedata']						= $this->hroemployeecontractextending_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeecontractextending_data']	= $this->hroemployeecontractextending_model->getHROEmployeeContractExtending_Data($employee_id);
			$data['main_view']['content']								= 'hroemployeecontractextending/listaddhroemployeecontractextending_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeContractExtending(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'contract_id' 						=> $this->input->post('contract_id',true),
				'contract_extending_description'	=> $this->input->post('contract_extending_description',true),
				'contract_extending_date' 			=> tgltodb($this->input->post('contract_extending_date',true)),
				'contract_extending_last_date' 	=> tgltodb($this->input->post('contract_extending_last_date',true)),
				'contract_extending_next_date' 	=> tgltodb($this->input->post('contract_extending_next_date',true)),
				'contract_extending_remark' 		=> $this->input->post('contract_extending_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('contract_id', 'Contract', 'required');
			$this->form_validation->set_rules('contract_extending_date', 'Contract Extending Date', 'required');
			$this->form_validation->set_rules('contract_extending_next_date', 'Contract Extending Next Date', 'required');
			$this->form_validation->set_rules('contract_extending_description', 'Contract Extending Description', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeecontractextending_model->saveNewHROEmployeeContractExtending($data)){
					$this->hroemployeecontractextending_model->updateNewHROEmployeeContractExtending($data);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeContractExtending.processAddHROEmployeeContractExtending',$auth['user_id'],'Add New  Contract Extending');
					$msg = "<div class='alert alert-success'>                
								Add Data Contract Extending Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeecontractextending');
					redirect('hroemployeecontractextending/addHROEmployeeContractExtending/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Contract Extending UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeecontractextending/addHROEmployeeContractExtending/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addhroemployeecontractextending',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeecontractextending/addHROEmployeeContractExtending/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeecontractextending_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeecontractextending/edithroemployeecontractextending_view';
			$data['main_view']['employee']		= create_double($this->hroemployeecontractextending_model->getemployee(),'employee_id','employee_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeecontractextending(){
			
			$data = array(
				'contract_extending_id' 				=> $this->input->post('contract_extending_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'contract_extending_date' 			=> $this->input->post('contract_extending_date',true),
				'contract_extending_due_date' 		=> $this->input->post('contract_extending_due_date',true),
				'contract_extending_remark' 		=> $this->input->post('contract_extending_remark',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('contract_extending_date', 'Date', 'required');
			$this->form_validation->set_rules('contract_extending_due_date', 'Due Date', 'required');
			$this->form_validation->set_rules('contract_extending_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeecontractextending_model->saveEdithroemployeecontractextending($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeecontractextending.Edit',$auth['username'],'Edit Transactional Contract Extending');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['contract_extending_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Contract Extending Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeecontractextending/Edit/'.$data['contract_extending_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Contract Extending UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeecontractextending/Edit/'.$data['contract_extending_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeecontractextending/Edit/'.$data['contract_extending_id']);
			}
		}
		
		function deleteHROEmployeeContractExtending_Data(){
			$employee_id = $this->uri->segment(3);
			$contract_extending_id = $this->uri->segment(4);
			if($this->hroemployeecontractextending_model->deleteHROEmployeeContractExtending_Data($contract_extending_id, $employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.hroemployeecontractextending.delete',$auth['username'],'Delete hroemployeecontractextending');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Contract Extending Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeecontractextending');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Contract Extending UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeecontractextending');
			}
		}
	}
?>