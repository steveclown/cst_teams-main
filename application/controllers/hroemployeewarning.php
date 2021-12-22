<?php
	Class hroemployeewarning extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeewarning_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeewarning');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeewarning_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeewarning_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeewarning_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeewarning_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_warning']		= $this->hroemployeewarning_model->getHROEmployeeData_Warning($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeewarning/listhroemployeewarning_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeewarning',$data);
			redirect('hroemployeewarning');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeewarning-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeewarning-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeewarning-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeewarning-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeewarning');
			$this->session->unset_userdata('filter-hroemployeewarning');
			redirect('hroemployeewarning');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeewarning-'.$sesi['unique']);	
			redirect('hroemployeewarning');
		}
		
		function addHROEmployeeWarning(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeewarning_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeewarning_data']		= $this->hroemployeewarning_model->getHROEmployeeWarning_Data($employee_id);
			$data['main_view']['corewarning']					= create_double($this->hroemployeewarning_model->getCoreWarning(),'warning_id','warning_name');

			$data['main_view']['content']					= 'hroemployeewarning/listaddhroemployeewarning_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeWarning(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'warning_id' 							=> $this->input->post('warning_id',true),
				'employee_warning_date'				=> tgltodb($this->input->post('employee_warning_date',true)),
				'employee_warning_description'		=> $this->input->post('employee_warning_description',true),
				'employee_warning_remark' 			=> $this->input->post('employee_warning_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_warning_date', 'Date', 'required');
			$this->form_validation->set_rules('warning_id', 'Warning', 'required');
			$this->form_validation->set_rules('employee_warning_description', 'Warning Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeewarning_model->saveNewHROEmployeeWarning($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeWarning.processAddHROEmployeeWarning',$auth['user_id'],'Add New Employee Warning');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Warning Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addhroemployeewarning');
					redirect('hroemployeewarning/addHROEmployeeWarning/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Warning UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeewarning',$data);
					redirect('hroemployeewarning/addHROEmployeeWarning/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeewarning',$data);
				redirect('hroemployeewarning/addHROEmployeeWarning/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeewarning_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeewarning/edithroemployeewarning_view';
			$data['main_view']['employee']		= create_double($this->hroemployeewarning_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['warning']			= create_double($this->hroemployeewarning_model->getwarning(),'warning_id','warning_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeewarning(){
			
			$data = array(
				'employee_warning_id' 				=> $this->input->post('employee_warning_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_warning_date'				=> tgltodb($this->input->post('employee_warning_date',true)),
				'employee_warning_remark' 			=> $this->input->post('employee_warning_remark',true),
				'warning_id' 							=> $this->input->post('warning_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_warning_date', 'Date', 'required');
			$this->form_validation->set_rules('warning_id', 'Warning', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeewarning_model->saveEdithroemployeewarning($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeewarning.Edit',$auth['username'],'Edit Employee Warning');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Warning Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeewarning/Edit/'.$data['employee_warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Warning UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeewarning/Edit/'.$data['employee_warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeewarning/Edit/'.$data['employee_warning_id']);
			}
		}
		
		function deleteHROEmployeeWarning(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeewarning_model->deleteHROEmployeeWarning($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeWarning.delete',$auth['user_id'],'Delete Employee Warning');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Warning Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeewarning');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Warning UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeewarning');
			}
		}

		function deleteHROEmployeeWarning_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_warning_id = $this->uri->segment(4);

			if($this->hroemployeewarning_model->deleteHROEmployeeWarning_Data($employee_warning_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeWarning_Data.delete',$auth['user_id'],'Delete Employee Warning');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Warning Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeewarning/addHROEmployeeWarning/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Warning UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeewarning/addHROEmployeeWarning/'.$employee_id);
			}
		}
	}
?>