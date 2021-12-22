<?php
	Class hroemployeepresent extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeepresent_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$sesi	= $this->session->userdata('filter-hroemployeepresent');

			if(!is_array($sesi)){
				$sesi['employee_id']		='';
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeepresent_model->getCoreDivision(),'division_id', 'division_name');
			$data['main_view']['hroemployeepresent']		= $this->hroemployeepresent_model->getHROEmployeeDataPresent($region_id, $branch_id, $location_id, $sesi['employee_id']);

			$data['main_view']['content']				= 'hroemployeepresent/listhroemployeepresent_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter_hroemployeepresent(){
			$data = array (
				'employee_id'	=> $this->input->post('employee_id',true),
			);

			$this->session->set_userdata('filter-hroemployeepresent',$data);
			redirect('hroemployeepresent');
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->hroemployeepresent_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->hroemployeepresent_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHroEmployeeData(){
			$division_id 	= $this->input->post('division_id');
			$department_id	= $this->input->post('department_id');
			$section_id		= $this->input->post('section_id');
			
			$item = $this->hroemployeepresent_model->getHroEmployeeData($division_id, $department_id, $section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function addHroEmployeePresent(){
			$employee_id = $this->uri->segment(3);

			$data['main_view']['hroemployeedata']	= $this->hroemployeepresent_model->getHroEmployeeCode($employee_id);
			$data['main_view']['content']		= 'hroemployeepresent/formaddhroemployeepresent_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddHroEmployeePresent(){
			$data = array(
				'employee_id' 				=> $this->input->post('employee_id', true),
				'employee_present_date'		=> date('Y-m-d'),
			);

			print_r("data ");
			print_r($data);
			print_r("<br>");
			print_r("<br>");
			$scheduleemployeeschedule = $this->hroemployeepresent_model->getScheduleEmployeeScheduleItem($data['employee_id'], $data['employee_present_date']);
			// print_r("scheduleemployeeschedule ");
			// print_r($scheduleemployeeschedule);
			// print_r("<br>");
			// print_r("<br>");
			// exit;
			if(empty($scheduleemployeeschedule)){
				$msg = "<div class='alert alert-danger'>
							Tidak Masuk Jadwal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeepresent');
			}else{
				foreach ($scheduleemployeeschedule as $key => $val) {
					if($data['employee_present_date'] == $val['employee_schedule_item_date']){
						if($this->hroemployeepresent_model->insertHroEmployeePresent($data)){
							$auth = $this->session->userdata('auth');
							$this->fungsi->set_log($auth['username'],'1003','Application.hroemployeepresent.processaddhroemployeepresent',$auth['username'],'Add New hroemployeepresent');
							$msg = "<div class='alert alert-success'>                
										Add Data Employee Present Successfully
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->unset_userdata('addhroemployeepresent');
							redirect('hroemployeepresent');
						}else{
							$msg = "<div class='alert alert-danger'>
										Add Data Employee Present UnSuccessful
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							redirect('hroemployeepresent');
						}
					} else {
						$msg = "<div class='alert alert-danger'>
										Tidak Masuk Jadwal
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							redirect('hroemployeepresent');
					}
				}
			}
		}		
	}
?>