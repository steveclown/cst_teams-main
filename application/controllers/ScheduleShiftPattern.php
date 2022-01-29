<?php
class ScheduleShiftPattern extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$menu = 'schedule-employee-shift';

		$this->cekLogin();
		$this->accessMenu($menu);

		$this->load->model('MainPage_model');
		$this->load->model('ScheduleShiftPattern_model');
		$this->load->helper('sistem');
		$this->load->library('fungsi');
		$this->load->library('configuration');
		$this->load->database('default');
	}

	public function index()
	{
		$data['main_view']['ScheduleShiftPattern']		= $this->ScheduleShiftPattern_model->getScheduleShiftPattern();
		$data['main_view']['shiftpatternday']			= $this->configuration->ShiftPatternDay();
		$data['main_view']['content']					= 'ScheduleShiftPattern/ListScheduleShiftPattern_view';
		$this->load->view('mainpage_view', $data);
	}

	public function addScheduleShiftPattern()
	{
		$data['main_view']['coreshift']						= create_double($this->ScheduleShiftPattern_model->getCoreShift(), 'shift_id', 'shift_name');

		$data['main_view']['shiftpatternday']				= $this->configuration->ShiftPatternDay();

		$data['main_view']['scheduleemployeeshift']			= create_double($this->ScheduleShiftPattern_model->getScheduleEmployeeShift(), 'employee_shift_id', 'employee_shift_code');

		$data['main_view']['content']						= 'ScheduleShiftPattern/FormAddScheduleShiftPattern_view';
		$this->load->view('mainpage_view', $data);
	}

	public function processAddArrayScheduleShiftPattern()
	{
		$auth 			= $this->session->userdata('auth');

		$data_ScheduleShiftPatternitem = array(
			'shift_id'					=> $this->input->post('shift_id', true),
			'employee_shift_id'			=> $this->input->post('employee_shift_id', true),
			'record_id'					=> date("YmdHis"),
		);

		$this->form_validation->set_rules('shift_id', 'Shift Name', 'required');
		$this->form_validation->set_rules('employee_shift_id', 'Employee Shift Code', 'required');

		if ($this->form_validation->run() == true) {
			$unique 			= $this->session->userdata('unique');
			$session_name 		= $this->input->post('session_name', true);
			$dataArrayHeader	= $this->session->userdata('addarrayScheduleShiftPatternitem-' . $unique['unique']);

			$dataArrayHeader[$data_ScheduleShiftPatternitem['record_id']] = $data_ScheduleShiftPatternitem;

			$this->session->set_userdata('addarrayScheduleShiftPatternitem-' . $unique['unique'], $dataArrayHeader);
			$data_ScheduleShiftPatternitem = $this->session->userdata('addScheduleShiftPattern-' . $unique['unique']);

			$data_ScheduleShiftPatternitem['shift_id'] 				= '';
			$data_ScheduleShiftPatternitem['employee_shift_id'] 	= '';

			$this->session->set_userdata('addScheduleShiftPattern-' . $unique['unique'], $data_ScheduleShiftPatternitem);
			redirect('ScheduleShiftPattern/addScheduleShiftPattern');
		} else {
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
			$this->session->set_userdata('message', $msg);
			redirect('ScheduleShiftPattern/addScheduleShiftPattern');
		}
	}

	public function deleteArrayScheduleShiftPatternItem()
	{
		$arrayBaru			= array();
		$var_to 			= $this->uri->segment(3);
		$session_name		= "addarrayScheduleShiftPatternitem-";
		$unique 			= $this->session->userdata('unique');
		$dataArrayHeader	= $this->session->userdata($session_name . $unique['unique']);
		$unique 			= $this->session->userdata('unique');

		foreach ($dataArrayHeader as $key => $val) {
			if ($key != $var_to) {
				$arrayBaru[$key] = $val;
			}
		}

		$this->session->set_userdata('addarrayScheduleShiftPatternitem-' . $unique['unique'], $arrayBaru);

		redirect('ScheduleShiftPattern/addScheduleShiftPattern');
	}

	public function processAddScheduleShiftPattern()
	{
		$unique 	= $this->session->userdata('unique');
		if ($sesi['unique'] == '') {
			$this->session->set_userdata('unique', array('unique' => $this->ScheduleShiftPattern_model->get_unique()));
		}

		$data 					= $this->session->userdata('addScheduleShiftPattern-' . $unique['unique']);
		$dataArray 				= $this->session->userdata($data['created_on']);
		$auth 					= $this->session->userdata('auth');

		$session_ScheduleShiftPattern = $this->session->userdata('addarrayScheduleShiftPatternitem-' . $unique['unique']);


		$data_ScheduleShiftPattern = array(
			'shift_pattern_code'		=> $this->input->post('shift_pattern_code', true),
			'shift_pattern_name'		=> $this->input->post('shift_pattern_name', true),
			'shift_pattern_weekly'		=> $this->input->post('shift_pattern_weekly', true),
			'shift_pattern_cycle'		=> $this->input->post('shift_pattern_cycle', true),
			'shift_pattern_day'			=> $this->input->post('shift_pattern_day', true),
			'data_state'				=> 0,
			'created_id'				=> $auth['user_id'],
			'created_on'				=> date('Y-m-d- H:i:s'),
		);

		//print_r("data_ScheduleShiftPattern ");
		//print_r($data_ScheduleShiftPattern);

		$this->form_validation->set_rules('shift_pattern_code', 'Shift Pattern Code', 'required');
		$this->form_validation->set_rules('shift_pattern_name', 'Shift Pattern Name', 'required');
		$this->form_validation->set_rules('shift_pattern_weekly', 'Shift Pattern Weekly', 'required');
		$this->form_validation->set_rules('shift_pattern_cycle', 'Shift Pattern Cycle', 'required');
		$this->form_validation->set_rules('shift_pattern_day', 'Shift Pattern Day', 'required');

		if ($this->form_validation->run() == true) {
			if ($this->ScheduleShiftPattern_model->insertScheduleShiftPattern($data_ScheduleShiftPattern)) {

				$shift_pattern_id = $this->ScheduleShiftPattern_model->getShiftPatternID($data_ScheduleShiftPattern['created_id']);

				if (!empty($session_ScheduleShiftPattern)) {
					foreach ($session_ScheduleShiftPattern as $key => $val) {

						$shift_next_day = $this->ScheduleShiftPattern_model->getShiftNextDay($val['shift_id']);

						$data_ScheduleShiftPatternitem = array(
							'shift_pattern_id'		=> $shift_pattern_id,
							'shift_id'				=> $val['shift_id'],
							'employee_shift_id'		=> $val['employee_shift_id'],
							'shift_next_day'		=> $shift_next_day,
						);

						$this->ScheduleShiftPattern_model->insertScheduleShiftPatternItem($data_ScheduleShiftPatternitem);
					}
				}

				$auth = $this->session->userdata('auth');

				$msg = "<div class='alert alert-success'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
								Add Data Schedule Employee Shift Success
							</div> ";
				$this->session->set_userdata('message', $msg);
				$this->session->unset_userdata('addScheduleShiftPattern-' . $unique['unique']);
				$this->session->unset_userdata('addarrayScheduleShiftPatternitem-' . $unique['unique']);
				redirect('ScheduleShiftPattern/addScheduleShiftPattern/');
			} else {
				$msg = "<div class='alert alert-danger'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
								Add Data Schedule Employee Shift UnSuccessful
							</div> ";
				$this->session->set_userdata('message', $msg);
				redirect('ScheduleShiftPattern/addScheduleShiftPattern/');
			}
		} else {
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
			$this->session->set_userdata('message', $msg);
			redirect('ScheduleShiftPattern/addScheduleShiftPattern');
		}
	}

	public function showdetail()
	{
		$shift_pattern_id = $this->uri->segment(3);

		$ScheduleShiftPattern 		= $this->ScheduleShiftPattern_model->getScheduleShiftPattern_Detail($shift_pattern_id);
		$ScheduleShiftPatternitem 	= $this->ScheduleShiftPattern_model->getScheduleShiftPatternItem_Detail($shift_pattern_id);
		$data['main_view']['shiftpatternday']			= $this->configuration->ShiftPatternDay();

		$data['main_view']['ScheduleShiftPattern']		= $this->ScheduleShiftPattern_model->getScheduleShiftPattern_Detail($shift_pattern_id);
		$data['main_view']['ScheduleShiftPatternitem']	= $this->ScheduleShiftPattern_model->getScheduleShiftPatternItem_Detail($shift_pattern_id);
		$data['main_view']['content']					= 'ScheduleShiftPattern/DetailScheduleShiftPattern_view';
		$this->load->view('mainpage_view', $data);
	}

	public function resetitem()
	{
		$sesi 	= $this->session->userdata('unique');
		$header = $this->session->userdata('addScheduleShiftPattern-' . $sesi['unique']);

		$this->session->unset_userdata('addScheduleShiftPattern-' . $sesi['unique']);
		$this->session->unset_userdata('addarrayScheduleShiftPatternitem-' . $sesi['unique']);
		$this->session->unset_userdata($data['created_on']);
		redirect('ScheduleShiftPattern/addScheduleShiftPattern');
	}

	public function function_state_add()
	{
		$unique 	= $this->session->userdata('unique');
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('addScheduleShiftPattern-' . $unique['unique']);
		$sessions['active_tab'] = $value;
		$this->session->set_userdata('addScheduleShiftPattern-' . $unique['unique'], $sessions);
	}

	public function function_elements_add()
	{
		$unique 	= $this->session->userdata('unique');
		$name 		= $this->input->post('name', true);
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('addScheduleShiftPattern-' . $unique['unique']);
		$sessions[$name] = $value;
		$this->session->set_userdata('addScheduleShiftPattern-' . $unique['unique'], $sessions);
		// echo $name;
	}

	public function reset_search()
	{
		$sesi = $this->session->userdata('filter-ScheduleShiftPattern');
		$this->session->unset_userdata('filter-hroemployeelate');
		redirect('ScheduleShiftPattern');
	}

	public function reset_session()
	{
		$sesi 	= $this->session->userdata('unique');
		$this->session->unset_userdata('addScheduleShiftPattern-' . $sesi['unique']);
	}

	public function editScheduleShiftPattern()
	{
		$unique 			= $this->session->userdata('unique');
		$shift_pattern_id 	= $this->uri->segment(3);

		$ScheduleShiftPatternitem 	= $this->ScheduleShiftPattern_model->getScheduleShiftPatternItem_Detail($shift_pattern_id);

		$dataArrayHeader	= $this->session->userdata('editarrayScheduleShiftPatternitemfirst-' . $unique['unique']);

		if (!empty($ScheduleShiftPatternitem)) {
			if (empty($dataArrayHeader)) {
				foreach ($ScheduleShiftPatternitem as $keyPatternItem => $valPatternItem) {
					$data_patternitem = array(
						'record_id'				=> $valPatternItem['shift_pattern_item_id'],
						'shift_id'				=> $valPatternItem['shift_id'],
						'employee_shift_id'		=> $valPatternItem['employee_shift_id'],
					);


					$session_name 		= $this->input->post('session_name', true);
					$dataArrayHeader	= $this->session->userdata('editarrayScheduleShiftPatternitemfirst-' . $unique['unique']);

					$dataArrayHeader[$data_patternitem['record_id']] = $data_patternitem;

					$this->session->set_userdata('editarrayScheduleShiftPatternitem-' . $unique['unique'], $dataArrayHeader);

					$this->session->set_userdata('editarrayScheduleShiftPatternitemfirst-' . $unique['unique'], $dataArrayHeader);

					$data_patternitem = $this->session->userdata('editScheduleShiftPattern-' . $unique['unique']);
				}
			}
		}

		$data['main_view']['coreshift']					= create_double($this->ScheduleShiftPattern_model->getCoreShift(), 'shift_id', 'shift_name');

		$data['main_view']['shiftpatternday']			= $this->configuration->ShiftPatternDay();

		$data['main_view']['scheduleemployeeshift']		= create_double($this->ScheduleShiftPattern_model->getScheduleEmployeeShift(), 'employee_shift_id', 'employee_shift_code');

		$data['main_view']['ScheduleShiftPattern']		= $this->ScheduleShiftPattern_model->getScheduleShiftPattern_Detail($shift_pattern_id);
		$data['main_view']['content']					= 'ScheduleShiftPattern/FormEditScheduleShiftPattern_view';
		$this->load->view('mainpage_view', $data);
	}

	public function processEditArrayScheduleShiftPattern()
	{
		$auth 			= $this->session->userdata('auth');

		$data_ScheduleShiftPatternitem = array(
			'shift_id'					=> $this->input->post('shift_id', true),
			'employee_shift_id'			=> $this->input->post('employee_shift_id', true),
			'record_id'					=> date("YmdHis"),
		);

		$this->form_validation->set_rules('shift_id', 'Shift Name', 'required');
		$this->form_validation->set_rules('employee_shift_id', 'Employee Shift Code', 'required');

		if ($this->form_validation->run() == true) {
			$unique 			= $this->session->userdata('unique');
			$session_name 		= $this->input->post('session_name', true);
			$dataArrayHeader	= $this->session->userdata('editarrayScheduleShiftPatternitem-' . $unique['unique']);

			$dataArrayHeader[$data_ScheduleShiftPatternitem['record_id']] = $data_ScheduleShiftPatternitem;

			$this->session->set_userdata('editarrayScheduleShiftPatternitem-' . $unique['unique'], $dataArrayHeader);
			$data_ScheduleShiftPatternitem = $this->session->userdata('editScheduleShiftPattern-' . $unique['unique']);

			$data_ScheduleShiftPatternitem['shift_id'] 				= '';
			$data_ScheduleShiftPatternitem['employee_shift_id'] 	= '';

			$this->session->set_userdata('editScheduleShiftPattern-' . $unique['unique'], $data_ScheduleShiftPatternitem);
			redirect('ScheduleShiftPattern/editScheduleShiftPattern/');
		} else {
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
			$this->session->set_userdata('message', $msg);
			redirect('ScheduleShiftPattern/editScheduleShiftPattern');
		}
	}

	public function deleteEditArrayScheduleShiftPatternItem()
	{
		$arrayBaru			= array();
		$shift_pattern_id 	= $this->uri->segment(3);
		$var_to 			= $this->uri->segment(4);
		$session_name		= "editarrayScheduleShiftPatternitem-";
		$unique 			= $this->session->userdata('unique');
		$dataArrayHeader	= $this->session->userdata($session_name . $unique['unique']);
		$unique 			= $this->session->userdata('unique');

		foreach ($dataArrayHeader as $key => $val) {
			if ($key != $var_to) {
				$arrayBaru[$key] = $val;
			}
		}

		$this->session->set_userdata('editarrayScheduleShiftPatternitem-' . $unique['unique'], $arrayBaru);

		redirect('ScheduleShiftPattern/editScheduleShiftPattern/' . $shift_pattern_id);
	}

	public function reset_edit()
	{
		$unique 			= $this->session->userdata('unique');
		$shift_pattern_id 	= $this->uri->segment(3);

		$this->session->unset_userdata('editScheduleShiftPattern-' . $unique['unique']);
		$this->session->unset_userdata('editarrayScheduleShiftPatternitem-' . $unique['unique']);
		$this->session->unset_userdata('editarrayScheduleShiftPatternitemfirst-' . $unique['unique']);
		redirect('ScheduleShiftPattern/editScheduleShiftPattern/' . $shift_pattern_id);
	}

	public function processEditScheduleShiftPattern()
	{
		$unique 	= $this->session->userdata('unique');

		$session_ScheduleShiftPatternitem = $this->session->userdata('editarrayScheduleShiftPatternitem-' . $unique['unique']);

		$shift_pattern_id	= $this->input->post('shift_pattern_id', true);

		if (!empty($session_ScheduleShiftPatternitem)) {
			if ($this->ScheduleShiftPattern_model->deleteScheduleShiftPatternItem($shift_pattern_id) == true) {

				foreach ($session_ScheduleShiftPatternitem as $key => $val) {
					$data_ScheduleShiftPatternitem = array(
						'shift_pattern_id'		=> $shift_pattern_id,
						'shift_id'				=> $val['shift_id'],
						'employee_shift_id'		=> $val['employee_shift_id'],
					);

					$this->ScheduleShiftPattern_model->insertScheduleShiftPatternItem($data_ScheduleShiftPatternitem);
				}

				$auth 	= $this->session->userdata('auth');

				$this->session->unset_userdata('editScheduleShiftPattern-' . $unique['unique']);
				$this->session->unset_userdata('editarrayScheduleShiftPatternitem-' . $unique['unique']);
				$this->session->unset_userdata('editarrayScheduleShiftPatternitemfirst-' . $unique['unique']);
				$this->fungsi->set_log($auth['username'], '1077', 'Application.scheduleemployeeshift.edit', $auth['username'], 'Edit scheduleemployeeshift');
				$this->fungsi->set_change_log($old_data, $data, $auth['username'], $data['shift_id']);
				$msg = "<div class='alert alert-success'>                
								Edit Schedule Shift Pattern  Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);
				redirect('ScheduleShiftPattern/editScheduleShiftPattern/' . $shift_pattern_id);
			} else {
				$msg = "<div class='alert alert-danger'>                
								Edit Schedule  Shift Pattern Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);
				redirect('ScheduleShiftPattern/editScheduleShiftPattern/' . $shift_pattern_id);
			}
		}
	}

	public function deleteScheduleShiftPattern()
	{
		$shift_pattern_id = $this->uri->segment(3);
		if ($this->ScheduleShiftPattern_model->deleteScheduleShiftPattern($shift_pattern_id)) {

			$auth = $this->session->userdata('auth');
			$this->fungsi->set_log($auth['username'], '1005', 'Application.ScheduleShiftPattern.delete', $auth['username'], 'Delete ScheduleShiftPattern');
			$msg = "<div class='alert alert-success'>                
							Delete Data Shift Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message', $msg);
			redirect('ScheduleShiftPattern');
		} else {
			$msg = "<div class='alert alert-danger'>                
							Delete Data Shift UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message', $msg);
			redirect('ScheduleShiftPattern');
		}
	}
}
