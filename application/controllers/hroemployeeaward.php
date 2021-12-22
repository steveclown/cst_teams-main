<?php
	Class hroemployeeaward extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeaward_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeaward');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeaward_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeaward_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeaward_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeaward_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');

			$data['main_view']['hroemployeedata_award']		= $this->hroemployeeaward_model->getHROEmployeeData_Award($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeaward/listhroemployeeaward_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeaward',$data);
			redirect('hroemployeeaward');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeaward-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeaward-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeaward-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeaward-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeaward');
			$this->session->unset_userdata('filter-hroemployeeaward');
			redirect('hroemployeeaward');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeaward-'.$sesi['unique']);	
			redirect('hroemployeeaward');
		}
		
		function addHROEmployeeAward(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeaward_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeaward_data']		= $this->hroemployeeaward_model->getHROEmployeeAward_Data($employee_id);
			$data['main_view']['coreaward']					= create_double($this->hroemployeeaward_model->getCoreAward(),'award_id','award_name');

			$data['main_view']['content']					= 'hroemployeeaward/listaddhroemployeeaward_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddHROEmployeeAward(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'award_id' 							=> $this->input->post('award_id',true),
				'employee_award_date'				=> tgltodb($this->input->post('employee_award_date',true)),
				'employee_award_description'		=> $this->input->post('employee_award_description',true),
				'employee_award_remark' 			=> $this->input->post('employee_award_remark',true),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_award_date', 'Date', 'required');
			$this->form_validation->set_rules('award_id', 'Award', 'required');
			$this->form_validation->set_rules('employee_award_description', 'Award Description', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeaward_model->saveNewHROEmployeeAward($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.HROEmployeeAward.processAddHROEmployeeAward',$auth['user_id'],'Add New Employee Award');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Award Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addhroemployeeaward');
					redirect('hroemployeeaward/addHROEmployeeAward/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Award UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addhroemployeeaward',$data);
					redirect('hroemployeeaward/addHROEmployeeAward/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				$this->session->set_userdata('Addhroemployeeaward',$data);
				redirect('hroemployeeaward/addHROEmployeeAward/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->hroemployeeaward_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'hroemployeeaward/edithroemployeeaward_view';
			$data['main_view']['employee']		= create_double($this->hroemployeeaward_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['award']			= create_double($this->hroemployeeaward_model->getaward(),'award_id','award_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeaward(){
			
			$data = array(
				'employee_award_id' 				=> $this->input->post('employee_award_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_award_date'				=> tgltodb($this->input->post('employee_award_date',true)),
				'employee_award_remark' 			=> $this->input->post('employee_award_remark',true),
				'award_id' 							=> $this->input->post('award_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_award_date', 'Date', 'required');
			$this->form_validation->set_rules('award_id', 'Award', 'required');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeaward_model->saveEdithroemployeeaward($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeaward.Edit',$auth['username'],'Edit Employee Award');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_award_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Award Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeaward/Edit/'.$data['employee_award_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Award UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeaward/Edit/'.$data['employee_award_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeaward/Edit/'.$data['employee_award_id']);
			}
		}
		
		function deleteHROEmployeeAward(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeaward_model->deleteHROEmployeeAward($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAward.delete',$auth['user_id'],'Delete Employee Award');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Award Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeaward');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Award UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeaward');
			}
		}

		function deleteHROEmployeeAward_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_award_id = $this->uri->segment(4);

			if($this->hroemployeeaward_model->deleteHROEmployeeAward_Data($employee_award_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.HROEmployeeAward_Data.delete',$auth['user_id'],'Delete Employee Award');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Award Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeaward/addHROEmployeeAward/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Award UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeaward/addHROEmployeeAward/'.$employee_id);
			}
		}
	}
?>