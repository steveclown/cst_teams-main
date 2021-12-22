<?php
	Class HroEmployeeAbsence extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('HroEmployeeAbsence_model');			
			//$this->load->model('Connection_model');
			$this->load->model('MainPage_model');			
			$this->load->helper('sistem');
			$this->load->helper('url');
			$this->load->database('default');
			$this->load->library('configuration');
			$this->load->library('fungsi');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-HroEmployeeAbsence');
			if(empty($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['Main_view']['coredivision']				= create_double($this->HroEmployeeAbsence_model->getCoreDivision(),'division_id','division_name');			
			$data['Main_view']['coredepartment']			= create_double($this->HroEmployeeAbsence_model->getCoreDepartment(),'department_id','department_name');
			$data['Main_view']['coresection']				= create_double($this->HroEmployeeAbsence_model->getCoreSection(),'section_id','section_name');
			$data['Main_view']['hroemployeedata']			= create_double($this->HroEmployeeAbsence_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['Main_view']['hroemployeedata_absence']		= $this->HroEmployeeAbsence_model->getHROEmployeeData_Absence($sesi['employee_id']);

			$data['Main_view']['content']	= 'HroEmployeeAbsence/listHroEmployeeAbsence_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeAbsence',$data);
			redirect('HroEmployeeAbsence');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAbsence-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeAbsence-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAbsence-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeAbsence-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeAbsence');
			$this->session->unset_userdata('filter-HroEmployeeAbsence');
			redirect('HroEmployeeAbsence');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addHroEmployeeAbsence-'.$sesi['unique']);	
			redirect('HroEmployeeAbsence');
		}
		
		public function addHroEmployeeAbsence(){
			$employee_id = $this->uri->segment(3);	

			$data['Main_view']['hroemployeedata']				= $this->HroEmployeeAbsence_model->getHROEmployeeData($employee_id);
			$data['Main_view']['HroEmployeeAbsence_data']		= $this->HroEmployeeAbsence_model->getHROEmployeeAbsence_Data($employee_id);
			$data['Main_view']['coreabsence']					= create_double($this->HroEmployeeAbsence_model->getCoreAbsence(),'absence_id','absence_name');

			$data['Main_view']['content']						= 'HroEmployeeAbsence/formAddHroEmployeeAbsence_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddHROEmployeeAbsence(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'absence_id' 						=> $this->input->post('absence_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_start_date'		=> tgltodb($this->input->post('employee_absence_start_date',true)),
				'employee_absence_end_date'			=> tgltodb($this->input->post('employee_absence_end_date',true)),
				'employee_absence_description'		=> $this->input->post('employee_absence_description',true),
				'employee_absence_duration'			=> $this->input->post('employee_absence_duration',true),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			$this->form_validation->set_rules('employee_absence_description', 'Absence Description', 'required');
			$this->form_validation->set_rules('employee_absence_duration', 'Absence Duration', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAbsence_model->saveNewHROEmployeeAbsence($data)){
					$employee_absence_id = $this->HroEmployeeAbsence_model->getEmployeeAbsenceID($data['created_id']);

					$employee_absence_detail_date = $data['employee_absence_start_date'];
/*					$employee_absence_detail_date = date ("Y-m-d", strtotime("-1 day", strtotime($employee_absence_detail_date)));*/

					date_default_timezone_set('UTC');

					while (strtotime($employee_absence_detail_date) <= strtotime($data['employee_absence_end_date'])) {
						

						$day_name = date("D", strtotime($employee_absence_detail_date));

						$dayoff_date = $this->HroEmployeeAbsence_model->getDayOffDate($employee_absence_detail_date);

						if ($day_name != "Sun" && count($dayoff_date) == 0){
							$data_employeeabsencedetail = array (
						    	'employee_absence_id'				=> $employee_absence_id,
						    	'employee_id'						=> $data['employee_id'],
						    	'employee_absence_detail_date'		=> $employee_absence_detail_date,
						    );

						    $this->HroEmployeeAbsence_model->saveNewHROEmployeeAbsence_Detail($data_employeeabsencedetail);
						} 

						$employee_absence_detail_date = date ("Y-m-d", strtotime("+1 day", strtotime($employee_absence_detail_date)));
					} 


					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAbsence.processAddHROEmployeeAbsence',$auth['user_id'],'Add New Employee Absence');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Absence Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeAbsence');
					redirect('HroEmployeeAbsence/addHROEmployeeAbsence/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Absence UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeAbsence',$data);
					redirect('HroEmployeeAbsence/addHROEmployeeAbsence/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('AddHroEmployeeAbsence',$data);
				redirect('HroEmployeeAbsence/addHROEmployeeAbsence/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->HroEmployeeAbsence_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'HroEmployeeAbsence/editHroEmployeeAbsence_view';
			$data['main_view']['employee']		= create_double($this->HroEmployeeAbsence_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['absence']		= create_double($this->HroEmployeeAbsence_model->getabsence(),'absence_id','absence_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditHroEmployeeAbsence(){
			
			$data = array(
				'employee_absence_id' 				=> $this->input->post('employee_absence_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'absence_id' 							=> $this->input->post('absence_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			
			if($this->form_validation->run()==true){
				if($this->HroEmployeeAbsence_model->saveEditHroEmployeeAbsence($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HroEmployeeAbsence.Edit',$auth['username'],'Edit Employee Absence');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_absence_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Absence Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAbsence/Edit/'.$data['employee_absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Absence UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('HroEmployeeAbsence/Edit/'.$data['employee_absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAbsence/Edit/'.$data['employee_absence_id']);
			}
		}
		
		public function deleteHROEmployeeAbsence(){
			$employee_id = $this->uri->segment(3);

			if($this->HroEmployeeAbsence_model->deleteHROEmployeeAbsence($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence.delete',$auth['user_id'],'Delete Employee Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAbsence');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAbsence');
			}
		}

		public function deleteHROEmployeeAbsence_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_absence_id = $this->uri->segment(4);

			if($this->HroEmployeeAbsence_model->deleteHROEmployeeAbsence_Data($employee_absence_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAbsence_Data.delete',$auth['user_id'],'Delete Employee Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAbsence/addHROEmployeeAbsence/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeAbsence/addHROEmployeeAbsence/'.$employee_id);
			}
		}
	}
?>