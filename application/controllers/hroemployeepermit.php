<?php
	Class hroemployeepermit extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeepermit_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-hroemployeepermit');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeepermit_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeepermit_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeepermit_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeepermit_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_permit']		= $this->hroemployeepermit_model->getHROEmployeeData_Permit($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeepermit/listhroemployeepermit_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeepermit',$data);
			redirect('hroemployeepermit');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeepermit-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeepermit-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeepermit-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeepermit-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeepermit');
			$this->session->unset_userdata('filter-hroemployeepermit');
			redirect('hroemployeepermit');
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeepermit-'.$sesi['unique']);	
			redirect('hroemployeepermit/addHROEmployeePermit/'.$employee_id);
		}
		
		public function addHROEmployeePermit(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeepermit_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeepermit_data']	= $this->hroemployeepermit_model->getHROEmployeePermit_Data($employee_id);
			$data['main_view']['corepermit']				= create_double($this->hroemployeepermit_model->getCorePermit(),'permit_id','permit_name');

			$data['main_view']['content']					= 'hroemployeepermit/formaddhroemployeepermit_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeePermit(){
			$auth 				= $this->session->userdata('auth');

			$permit_id 			= $this->input->post('permit_id',true);

			$permit_type 		= $this->hroemployeepermit_model->getPermitType($permit_id);

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'permit_id' 						=> $permit_id,
				'permit_type' 						=> $permit_type,
				'employee_permit_date'				=> tgltodb($this->input->post('employee_permit_date',true)),
				'employee_permit_description'		=> $this->input->post('employee_permit_description',true),
				'employee_permit_start_date'		=> tgltodb($this->input->post('employee_permit_start_date',true)),
				'employee_permit_end_date'			=> tgltodb($this->input->post('employee_permit_end_date',true)),
				'employee_permit_remark' 			=> $this->input->post('employee_permit_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_permit_date', 'Date', 'required');
			$this->form_validation->set_rules('permit_id', 'Permit', 'required');
			$this->form_validation->set_rules('employee_permit_description', 'Permit Description', 'required');
			$this->form_validation->set_rules('employee_permit_duration', 'Permit Duration', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeepermit_model->saveNewHROEmployeePermit($data)){
					$employee_permit_id = $this->hroemployeepermit_model->getEmployeePermitID($data['created_id']);

					$employee_permit_detail_date = $data['employee_permit_start_date'];
					/*$employee_permit_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($employee_permit_detail_date)));*/

					date_default_timezone_set('UTC');

					while (strtotime($employee_permit_detail_date) <= strtotime($data['employee_permit_end_date'])) {
						$day_name = date("D", strtotime($employee_permit_detail_date));

						$dayoff_date = $this->hroemployeepermit_model->getDayOffDate($employee_permit_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_employeepermitdetail = array (
						    	'employee_permit_id'				=> $employee_permit_id,
						    	'employee_id'						=> $data['employee_id'],
						    	'employee_permit_detail_date'		=> $employee_permit_detail_date,
						    );

						    $this->hroemployeepermit_model->saveNewHROEmployeePermit_Detail($data_employeepermitdetail);
						} 

						$employee_permit_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_permit_detail_date)));
					} 

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeePermit.processAddHROEmployeePermit',$auth['user_id'],'Add New Employee Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Permit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addhroemployeepermit');
					redirect('hroemployeepermit/addHROEmployeePermit/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Permit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeepermit',$data);
					redirect('hroemployeepermit/addHROEmployeePermit/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeepermit',$data);
				redirect('hroemployeepermit/addHROEmployeePermit/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeepermit_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeepermit/edithroemployeepermit_view';
			$data['main_view']['employee']		= create_double($this->hroemployeepermit_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['permit']			= create_double($this->hroemployeepermit_model->getpermit(),'permit_id','permit_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeepermit(){
			
			$data = array(
				'employee_permit_id' 				=> $this->input->post('employee_permit_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_permit_date'				=> tgltodb($this->input->post('employee_permit_date',true)),
				'employee_permit_remark' 			=> $this->input->post('employee_permit_remark',true),
				'permit_id' 							=> $this->input->post('permit_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_permit_date', 'Date', 'required');
			$this->form_validation->set_rules('permit_id', 'Permit', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeepermit_model->saveEdithroemployeepermit($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeepermit.Edit',$auth['username'],'Edit Employee Permit');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_permit_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Permit Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeepermit/Edit/'.$data['employee_permit_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Permit UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeepermit/Edit/'.$data['employee_permit_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeepermit/Edit/'.$data['employee_permit_id']);
			}
		}
		
		function deleteHROEmployeePermit(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeepermit_model->deleteHROEmployeePermit($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit.delete',$auth['user_id'],'Delete Employee Permit');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Permit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeepermit');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Permit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeepermit');
			}
		}

		function deleteHROEmployeePermit_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_permit_id = $this->uri->segment(4);

			if($this->hroemployeepermit_model->deleteHROEmployeePermit_Data($employee_permit_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeePermit_Data.delete',$auth['user_id'],'Delete Employee Permit');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Permit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeepermit/addHROEmployeePermit/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Permit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeepermit/addHROEmployeePermit/'.$employee_id);
			}
		}
	}
?>