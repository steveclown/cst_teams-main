<?php
	Class hroemployeelate extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeelate_model');
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


			$sesi	= 	$this->session->userdata('filter-hroemployeelate');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeelate_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeelate_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeelate_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeelate_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_late']		= $this->hroemployeelate_model->getHROEmployeeData_Late($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeelate/listhroemployeelate_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeelate',$data);
			redirect('hroemployeelate');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeelate-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeelate-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeelate-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeelate-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeelate');
			$this->session->unset_userdata('filter-hroemployeelate');
			redirect('hroemployeelate');
		}

		public function reset_add(){
			$employee_id 	= $this->uri->segment(3);	
			$unique 		= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeelate-'.$unique['unique']);	
			redirect('hroemployeelate/addHROEmployeeLate/'.$employee_id);
		}
		
		public function addHROEmployeeLate(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeelate_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeelate_data']		= $this->hroemployeelate_model->getHROEmployeeLate_Data($employee_id);
			$data['main_view']['corelate']					= create_double($this->hroemployeelate_model->getCoreLate(),'late_id','late_name');

			$data['main_view']['content']					= 'hroemployeelate/formaddhroemployeelate_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHROEmployeeLate(){
			$unique 	= $this->session->userdata('unique');
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'late_id' 							=> $this->input->post('late_id',true),
				'employee_late_date'				=> tgltodb($this->input->post('employee_late_date',true)),
				'employee_late_description'			=> $this->input->post('employee_late_description',true),
				'employee_late_duration'			=> $this->input->post('employee_late_duration',true),
				'employee_late_remark' 				=> $this->input->post('employee_late_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_late_date', 'Date', 'required');
			$this->form_validation->set_rules('late_id', 'Late', 'required');
			$this->form_validation->set_rules('employee_late_description', 'Late Description', 'required');
			$this->form_validation->set_rules('employee_late_duration', 'Late Duration', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeelate_model->saveNewHROEmployeeLate($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeLate.processAddHROEmployeeLate',$auth['user_id'],'Add New Employee Late');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Late Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addhroemployeelate-'.$unique['unique']);	
					redirect('hroemployeelate/addHROEmployeeLate/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Late UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeelate/addHROEmployeeLate/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeelate',$data);
				redirect('hroemployeelate/addHROEmployeeLate/'.$data['employee_id']);
			}
		}










		
		
		public function Edit(){
			$data['main_view']['result']		= $this->hroemployeelate_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeelate/edithroemployeelate_view';
			$data['main_view']['employee']		= create_double($this->hroemployeelate_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['late']			= create_double($this->hroemployeelate_model->getlate(),'late_id','late_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeelate(){
			
			$data = array(
				'employee_late_id' 				=> $this->input->post('employee_late_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_late_date'				=> tgltodb($this->input->post('employee_late_date',true)),
				'employee_late_remark' 			=> $this->input->post('employee_late_remark',true),
				'late_id' 							=> $this->input->post('late_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_late_date', 'Date', 'required');
			$this->form_validation->set_rules('late_id', 'Late', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeelate_model->saveEdithroemployeelate($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeelate.Edit',$auth['username'],'Edit Employee Late');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_late_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Late Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeelate/Edit/'.$data['employee_late_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Late UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeelate/Edit/'.$data['employee_late_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelate/Edit/'.$data['employee_late_id']);
			}
		}
		
		function deleteHROEmployeeLate(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeelate_model->deleteHROEmployeeLate($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate.delete',$auth['user_id'],'Delete Employee Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Late Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelate');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Late UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelate');
			}
		}

		function deleteHROEmployeeLate_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_late_id = $this->uri->segment(4);

			if($this->hroemployeelate_model->deleteHROEmployeeLate_Data($employee_late_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeLate_Data.delete',$auth['user_id'],'Delete Employee Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Late Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelate/addHROEmployeeLate/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Late UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeelate/addHROEmployeeLate/'.$employee_id);
			}
		}
	}
?>