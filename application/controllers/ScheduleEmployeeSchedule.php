<?php
class ScheduleEmployeeSchedule extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$menu = 'schedule-employee-schedule';

		$this->cekLogin();
		$this->accessMenu($menu);

		$this->load->model('MainPage_model');
		$this->load->model('ScheduleEmployeeSchedule_model');
		$this->load->helper('sistem');
		$this->load->library('fungsi');
		$this->load->library('configuration');
		$this->load->database('default');
	}

	public function index()
	{
		$auth 			= $this->session->userdata('auth');
		$region_id 		= $auth['region_id'];
		$branch_id 		= $auth['branch_id'];
		$location_id 	= $auth['location_id'];

		$sesi	= 	$this->session->userdata('filter-ScheduleEmployeeScheduleitem');

		if (!is_array($sesi)) {
			$sesi['start_date']				= date("Y-m-d");
			$sesi['end_date']				= date("Y-m-d");
			$sesi['division_id']			= '0';
			$sesi['department_id']			= '0';
			$sesi['section_id']				= '0';
			$sesi['unit_id']				= '0';
			$sesi['employee_id']			= '0';
			$sesi['employee_shift_id']		= '0';
		}

		$start_date = tgltodb($sesi['start_date']);
		$end_date 	= tgltodb($sesi['end_date']);

		$data['main_view']['scheduleemployeeshift']			= create_double($this->ScheduleEmployeeSchedule_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id), 'employee_shift_id', 'employee_shift_code');

		$data['main_view']['coredivision']					= create_double($this->ScheduleEmployeeSchedule_model->getCoreDivision(), 'division_id', 'division_name');

		$data['main_view']['ScheduleEmployeeScheduleitem']	= $this->ScheduleEmployeeSchedule_model->getScheduleEmployeeScheduleItem($start_date, $end_date, $sesi['employee_shift_id'], $sesi['employee_id']);

		$data['main_view']['content']						= 'ScheduleEmployeeSchedule/ListScheduleEmployeeSchedule_view';
		$this->load->view('MainPage_view', $data);
	}

	public function filter()
	{
		$data = array(
			'start_date'			=> $this->input->post('start_date', true),
			'end_date'				=> $this->input->post('end_date', true),
			'division_id'			=> $this->input->post('division_id', true),
			'department_id'			=> $this->input->post('department_id', true),
			'section_id'			=> $this->input->post('section_id', true),
			'unit_id'				=> $this->input->post('unit_id', true),
			'employee_id'			=> $this->input->post('employee_id', true),
			'employee_shift_id'		=> $this->input->post('employee_shift_id', true),
		);

		$this->session->set_userdata('filter-ScheduleEmployeeScheduleitem', $data);
		redirect('ScheduleEmployeeSchedule');
	}

	public function reset_search()
	{
		$sesi = $this->session->userdata('filter-ScheduleEmployeeScheduleitem');
		$this->session->unset_userdata('filter-ScheduleEmployeeScheduleitem');
		redirect('ScheduleEmployeeSchedule');
	}

	public function getCoreDepartment()
	{
		$auth 	= $this->session->userdata('auth');

		$division_id = $this->input->post('division_id');

		$item = $this->ScheduleEmployeeSchedule_model->getCoreDepartment($division_id);

		$data .= "<option value=''>--Choose One--</option>";
		foreach ($item as $mp) {
			$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";
		}
		echo $data;
	}

	public function getCoreSection()
	{
		$auth 	= $this->session->userdata('auth');

		$department_id = $this->input->post('department_id');

		$item = $this->ScheduleEmployeeSchedule_model->getCoreSection($department_id);

		$data .= "<option value=''>--Choose One--</option>";
		foreach ($item as $mp) {
			$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";
		}
		echo $data;
	}

	public function getCoreUnit()
	{
		$auth 	= $this->session->userdata('auth');

		$section_id = $this->input->post('section_id');

		$item = $this->ScheduleEmployeeSchedule_model->getCoreUnit($section_id);

		$data .= "<option value=''>--Choose One--</option>";
		foreach ($item as $mp) {
			$data .= "<option value='$mp[unit_id]'>$mp[unit_name]</option>\n";
		}
		echo $data;
	}

	public function getHROEmployeeData()
	{
		$auth 			= $this->session->userdata('auth');
		$region_id 		= $auth['region_id'];
		$branch_id 		= $auth['branch_id'];
		$location_id 	= $auth['location_id'];

		$division_id 	= $this->input->post('division_id');
		$department_id 	= $this->input->post('department_id');
		$section_id 	= $this->input->post('section_id');
		$unit_id 		= $this->input->post('unit_id');

		$item = $this->ScheduleEmployeeSchedule_model->getHROEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id, $unit_id);

		$data .= "<option value=''>--Choose One--</option>";
		foreach ($item as $mp) {
			$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";
		}
		echo $data;
	}

	public function showdetail()
	{
		$employee_schedule_id = $this->uri->segment(3);

		$data['main_view']['ScheduleEmployeeSchedule']			= $this->ScheduleEmployeeSchedule_model->getScheduleEmployeeSchedule_Detail($employee_schedule_id);

		$data['main_view']['ScheduleEmployeeScheduleitem']		= $this->ScheduleEmployeeSchedule_model->getScheduleEmployeeScheduleItem_Detail($employee_schedule_id);

		$data['main_view']['content']		= 'ScheduleEmployeeSchedule/FormDetailScheduleEmployeeSchedule_view';
		$this->load->view('MainPage_view', $data);
	}

	public function editScheduleEmployeeScheduleWorking()
	{
		$employee_schedule_item_id 	= $this->uri->segment(3);
		$employee_id 				= $this->uri->segment(4);

		$data['main_view']['ScheduleEmployeeScheduleitem']		= $this->ScheduleEmployeeSchedule_model->getScheduleEmployeeScheduleItem_DetailWorking($employee_schedule_item_id);

		// $data['main_view']['ScheduleEmployeeScheduleworking']	= $this->ScheduleEmployeeSchedule_model->getScheduleEmployeeScheduleWorking($employee_id);

		$data['main_view']['content']							= 'ScheduleEmployeeSchedule/FormEditScheduleEmployeeScheduleWorking_view';

		$this->load->view('MainPage_view', $data);
	}

	public function processEditScheduleEmployeeScheduleWorking()
	{
		$auth 		= $this->session->userdata('auth');
		$unique 	= $this->session->userdata('unique');

		$employeeworkingminute 					= $this->ScheduleEmployeeSchedule_model->getEmployeeWorkingMinute();

		$employee_schedule_item_in_start_date 	= $this->input->post('employee_schedule_item_in_start_date', true);

		$employee_schedule_item_in_end_date1 	= strtotime($employee_schedule_item_in_start_date) + ($employeeworkingminute['employee_working_in_start_minute'] * 60);

		$employee_schedule_item_in_end_date 	= date('Y-m-d H:i:s', $employee_schedule_item_in_end_date1);

		/*print_r("employeeworkingminute ");
			print_r($employeeworkingminute);
			print_r("<BR>");

			print_r("employee_schedule_item_in_start_date ");
			print_r($employee_schedule_item_in_start_date);
			print_r("<BR>");

			print_r("employee_schedule_item_in_end_date1 ");
			print_r($employee_schedule_item_in_end_date1);
			print_r("<BR>");

			print_r("employee_schedule_item_in_end_date ");
			print_r($employee_schedule_item_in_end_date);
			print_r("<BR>");

			exit;*/

		$data = array(
			'employee_id' 								=> $this->input->post('employee_id', true),
			'employee_schedule_id' 						=> $this->input->post('employee_schedule_id', true),
			'employee_schedule_item_id' 				=> $this->input->post('employee_schedule_item_id', true),
			'employee_schedule_item_date' 				=> tgltodb($this->input->post('employee_schedule_item_date', true)),
			'employee_schedule_item_in_start_date_old'	=> $this->input->post('employee_schedule_item_in_start_date_old', true),
			'employee_schedule_item_in_start_date'		=> $this->input->post('employee_schedule_item_in_start_date', true),
			'employee_schedule_item_in_end_date'		=> $employee_schedule_item_in_end_date,
			'employee_schedule_working_reason'			=> $this->input->post('employee_schedule_working_reason', true),
			'data_state'								=> 0,
			'created_id'								=> $auth['user_id'],
			'created_on'								=> date("Y-m-d H:i:s"),
		);

		$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
		$this->form_validation->set_rules('employee_schedule_item_in_start_date', 'Schedule In Date', 'required');
		$this->form_validation->set_rules('employee_schedule_working_reason', 'Schedule Working Reason', 'required');

		if ($this->form_validation->run() == true) {
			if ($this->ScheduleEmployeeSchedule_model->insertScheduleEmployeeScheduleWorking($data)) {
				$auth = $this->session->userdata('auth');

				$data_update = array(
					'employee_schedule_item_id' 			=> $data['employee_schedule_item_id'],
					'employee_schedule_item_in_start_date'	=> $data['employee_schedule_item_in_start_date']
				);

				if ($this->ScheduleEmployeeSchedule_model->updateScheduleEmployeeScheduleItem($data_update)) {
					$this->fungsi->set_log($auth['user_id'], '1003', 'Application.PayrollEmployeePayment.processAddPayrollEmployeePayment', $auth['user_id'], 'Add New Employee Payment');

					$msg = "<div class='alert alert-success'>                
									Edit Schedule Employee Schedule Working Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message', $msg);
					$this->session->unset_userdata('addpayrollemployeepayment-' . $unique['unique']);
					redirect('ScheduleEmployeeSchedule/editScheduleEmployeeScheduleWorking/' . $data['employee_schedule_item_id'] . '/' . $data['employee_id']);
				} else {
					$msg = "<div class='alert alert-danger'>                
								Edit Schedule Employee Schedule Working Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message', $msg);
					$this->session->set_userdata('Addpayrollemployeepayment', $data);
					redirect('ScheduleEmployeeSchedule/editScheduleEmployeeScheduleWorking/' . $data['employee_schedule_item_id'] . '/' . $data['employee_id']);
				}
			} else {
				$msg = "<div class='alert alert-danger'>                
								Edit Schedule Employee Schedule Working Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);
				$this->session->set_userdata('Addpayrollemployeepayment', $data);
				redirect('ScheduleEmployeeSchedule/editScheduleEmployeeScheduleWorking/' . $data['employee_schedule_item_id'] . '/' . $data['employee_id']);
			}
		} else {
			$data['password'] = '';
			$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
			$this->session->set_userdata('message', $msg);
			$this->session->set_userdata('Addpayrollemployeepayment', $data);
			redirect('ScheduleEmployeeSchedule/editScheduleEmployeeScheduleWorking/' . $data['employee_schedule_item_id'] . '/' . $data['employee_id']);
		}
	}
}
