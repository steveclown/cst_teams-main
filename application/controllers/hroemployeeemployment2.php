<?php
	Class hroemployeeemployment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeemployment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeemployment');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']					= create_double($this->hroemployeeemployment_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['hroemployeedata_employment']	= $this->hroemployeeemployment_model->getHROEmployeeData_Employment($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']						= 'hroemployeeemployment/listhroemployeeemployment_view';
			$this->load->view('mainpage_view',$data);
		}

		public function getCoreDepartment(){
			$auth 	= $this->session->userdata('auth');

			$division_id = $this->input->post('division_id');
			
			$item = $this->hroemployeeemployment_model->getCoreDepartment($division_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$auth 	= $this->session->userdata('auth');

			$department_id = $this->input->post('department_id');
			
			$item = $this->hroemployeeemployment_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$division_id 				= $this->input->post('division_id');
			$department_id 				= $this->input->post('department_id');
			$section_id 	= $this->input->post('section_id');
			
			$item = $this->hroemployeeemployment_model->getHROEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $payroll_employee_level);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeemployment',$data);
			redirect('hroemployeeemployment');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeemployment-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeemployment-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeemployment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeemployment-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeemployment');
			$this->session->unset_userdata('filter-hroemployeeemployment');
			redirect('hroemployeeemployment');
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeemployment-'.$unique['unique']);	
			redirect('hroemployeeemployment/addHROEmployeeLate/'.$employee_id);
		}

		public function function_elements_add_appraisal(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeappraisal-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeappraisal-'.$unique['unique'],$sessions);
		}

		public function reset_add_appraisal(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeappraisal-'.$unique['unique']);	
			$this->session->unset_userdata('addhroemployeeappraisaldetail-'.$unique['unique']);	
			$this->session->unset_userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique']);	
			redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$employee_id);
		}
		
		public function addHROEmployeeEmployment(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeemployment_model->getHROEmployeeData_Detail($employee_id);

			$data['main_view']['coreappraisal']				= create_double($this->hroemployeeemployment_model->getCoreAppraisal(), 'appraisal_id', 'appraisal_name');

			$data['main_view']['hroemployeeappraisal']		= $this->hroemployeeemployment_model->getHROEmployeeAppraisal($employee_id);

			$data['main_view']['content']					= 'hroemployeeemployment/formaddhroemployeeemployment_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add_detail(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeappraisaldetail-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeappraisaldetail-'.$unique['unique'],$sessions);
		}

		public function reset_add_detail(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeappraisaldetail-'.$unique['unique']);	
			redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$employee_id);
		}

		public function processAddArrayHROEmployeeAppraisalDetail(){
			$employee_appraisal_detail_value	= $this->input->post('employee_appraisal_detail_value', true);

			$employee_appraisal_detail_code 	= $this->hroemployeeemployment_model->getAppraisalCode($employee_appraisal_detail_value);

			$data_appraisal = array(
				'appraisal_id'						=> $this->input->post('appraisal_id', true),
				'employee_appraisal_detail_value'	=> $this->input->post('employee_appraisal_detail_value', true),
				'employee_appraisal_detail_code'	=> $employee_appraisal_detail_code,
			);
			
			$this->form_validation->set_rules('appraisal_id', 'Appraisal Name', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique']);
				$dataArrayHeader[$data_appraisal['appraisal_id']] = $data_appraisal;
								
				$this->session->set_userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique'],$dataArrayHeader);
				$this->session->unset_userdata('addhroemployeeappraisaldetail-'.$unique['unique']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayHROEmployeeAppraisalDetail(){
			$arrayBaru			= array();
			$employee_id 		= $this->uri->segment(3);
			$var_to 			= $this->uri->segment(4);
			$session_name		= "addarrayhroemployeeappraisaldetail-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique'],$arrayBaru);
			
			redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$employee_id);
		}
		
		public function processAddHROEmployeeAppraisal(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$session_hroemployeeappraisaldetail		= $this->session->userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique']);

			$employee_appraisal_total_value 		= 0;

			if (!empty($session_hroemployeeappraisaldetail)){
				foreach ($session_hroemployeeappraisaldetail as $keyAppraisal => $valAppraisal) {
					$employee_appraisal_total_value = $$employee_appraisal_total_value + $valAppraisal['employee_appraisal_detail_value'];
				}
			}

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_appraisal_date' 			=> tgltodb($this->input->post('employee_appraisal_date',true)),
				'employee_appraisal_remark'			=> $this->input->post('employee_appraisal_remark',true),
				'employee_appraisal_total_value'	=> $employee_appraisal_total_value,
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_appraisal_date', 'Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeemployment_model->insertHROEmployeeAppraisal($data)){
					$employee_appraisal_id = $this->hroemployeeemployment_model->getEmployeeAppraisalID($data['created_id']);

					if (!empty($session_hroemployeeappraisaldetail)){
						foreach ($session_hroemployeeappraisaldetail as $keyAppraisal => $valAppraisal) {
							$data_hroemployeeappraisaldetail = array (
								'employee_appraisal_id'				=> $employee_appraisal_id,
								'appraisal_id'						=> $valAppraisal['appraisal_id'],
								'employee_appraisal_detail_value'	=> $valAppraisal['employee_appraisal_detail_value'],
								'employee_appraisal_detail_code'	=> $valAppraisal['employee_appraisal_detail_code'],
							);	

							$this->hroemployeeemployment_model->insertHROEmployeeAppraisalDetail($data_hroemployeeappraisaldetail);
						}
					}

					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeEmployment.processAddHROEmployeeLate',$auth['user_id'],'Add New Employee Late');

					$msg = "<div class='alert alert-success'>                
								Add Data Employee Late Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeeappraisal-'.$unique['unique']);	
					$this->session->unset_userdata('addhroemployeeappraisaldetail-'.$unique['unique']);	
					$this->session->unset_userdata('addarrayhroemployeeappraisaldetail-'.$unique['unique']);	
					redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Late UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeeemployment',$data);
				redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$data['employee_id']);
			}
		}

		public function deleteHROEmployeeAppraisal(){
			$employee_id 			= $this->uri->segment(3);
			$employee_appraisal_id 	= $this->uri->segment(4);

			$data = array (
				'employee_appraisal_id'		=> $employee_appraisal_id,
				'data_state'				=> 1
			);

			if($this->hroemployeeemployment_model->deleteHROEmployeeAppraisal($data)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.deleteHROEmployeeLate',$auth['user_id'],'Delete Employee Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Late Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Late Fail
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeemployment/addHROEmployeeEmployment/'.$employee_id);
			}
		}

		
		


		
		
		
	}
?>