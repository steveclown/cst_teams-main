<?php
	Class HroEmployeeAbsenceReport extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('HroEmployeeAbsenceReport_model');
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


			$sesi	= 	$this->session->userdata('filter-HroEmployeeAbsenceReport');
			if(!is_array($sesi)){
				$sesi['start_date']			= date('d-m-Y');
				$sesi['end_date']			= date('d-m-Y');
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['absence_id']			= '';	
			}

			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$data['main_view']['coredivision']					= create_double($this->HroEmployeeAbsenceReport_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']				= create_double($this->HroEmployeeAbsenceReport_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']					= create_double($this->HroEmployeeAbsenceReport_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['coreabsence']					= create_double($this->HroEmployeeAbsenceReport_model->getCoreAbsence(),'absence_id','absence_name');

			$data['main_view']['hroemployeeabsence_report']		= $this->HroEmployeeAbsenceReport_model->getHROEmployeeAbsence_Report($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['division_id'], $sesi['department_id'] , $sesi['section_id'], $sesi['absence_id'], $start_date, $end_date);

			$data['main_view']['content']						= 'HroEmployeeAbsenceReport/listHroEmployeeAbsenceReport_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'start_date'		=> $this->input->post('start_date',true),
				'end_date'			=> $this->input->post('end_date',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
				'absence_id'		=> $this->input->post('absence_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeAbsenceReport',$data);
			redirect('HroEmployeeAbsenceReport');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAbsenceReport-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeAbsenceReport-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeAbsenceReport-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeAbsenceReport-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeAbsenceReport');
			$this->session->unset_userdata('filter-HroEmployeeAbsenceReport');
			redirect('HroEmployeeAbsenceReport');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addHroEmployeeAbsenceReport-'.$sesi['unique']);	
			redirect('HroEmployeeAbsenceReport');
		}
	}
?>