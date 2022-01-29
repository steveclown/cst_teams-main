<?php
class CoreShift extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();

		$menu = 'shift';

		$this->cekLogin();
		$this->accessMenu($menu);

		$this->load->model('MainPage_model');
		$this->load->model('CoreShift_model');
		$this->load->helper('sistem');
		$this->load->library('fungsi');
		$this->load->library('configuration');
		$this->load->database('default');
	}

	public function index()
	{
		$data['main_view']['CoreShift']		= $this->CoreShift_model->getCoreShift();
		$data['main_view']['shiftnextday']	= $this->configuration->ShiftNextDay();

		$data['main_view']['content']		= 'CoreShift/listCoreShift_view';
		$this->load->view('MainPage_view', $data);
	}

	public function addCoreShift()
	{
		$data['main_view']['shiftnextday']		= $this->configuration->ShiftNextDay();
		$data['main_view']['content']			= 'CoreShift/formaddCoreShift_view';
		$this->load->view('MainPage_view', $data);
	}

	public function function_state_add()
	{
		$unique 	= $this->session->userdata('unique');
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('addCoreShift-' . $unique['unique']);
		$sessions['active_tab'] = $value;
		$this->session->set_userdata('addCoreShift-' . $unique['unique'], $sessions);
	}

	public function function_elements_add()
	{
		$unique 	= $this->session->userdata('unique');
		$name 		= $this->input->post('name', true);
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('addCoreShift-' . $unique['unique']);
		$sessions[$name] = $value;
		$this->session->set_userdata('addCoreShift-' . $unique['unique'], $sessions);
	}

	public function reset_add()
	{
		$unique 	= $this->session->userdata('unique');
		$this->session->unset_userdata('addCoreShift-' . $unique['unique']);
		redirect('CoreShift/addCoreShift');
	}

	public function function_state_edit()
	{
		$unique 	= $this->session->userdata('unique');
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('editCoreShift-' . $unique['unique']);
		$sessions['active_tab'] = $value;
		$this->session->set_userdata('editCoreShift-' . $unique['unique'], $sessions);
	}

	public function function_elements_edit()
	{
		$unique 	= $this->session->userdata('unique');
		$name 		= $this->input->post('name', true);
		$value 		= $this->input->post('value', true);
		$sessions	= $this->session->userdata('editCoreShift-' . $unique['unique']);
		$sessions[$name] = $value;
		$this->session->set_userdata('editCoreShift-' . $unique['unique'], $sessions);
	}

	public function reset_edit()
	{
		$shift_id 	= $this->uri->segment(3);
		$unique 	= $this->session->userdata('unique');
		$this->session->unset_userdata('editCoreShift-' . $unique['unique']);
		redirect('CoreShift/editCoreShift/' . $shift_id);
	}

	public function processAddCoreShift()
	{
		$data = array(
			'shift_code' 				=> $this->input->post('shift_code', true),
			'shift_name' 				=> $this->input->post('shift_name', true),
			'start_working_hour'		=> $this->input->post('start_working_hour', true),
			'end_working_hour'			=> $this->input->post('end_working_hour', true),
			'working_hours_start'		=> $this->input->post('working_hours_start', true),
			'working_hours_end'			=> $this->input->post('working_hours_end', true),
			'shift_next_day'			=> $this->input->post('shift_next_day', true),
			'shift_remark'				=> $this->input->post('shift_remark', true),
			'data_state'				=> 0

		);

		$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
		$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');

		if ($this->form_validation->run() == true) {
			if ($this->CoreShift_model->insertCoreShift($data)) {
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'], '1003', 'Application.CoreShift.processaddCoreShift', $auth['username'], 'Add New CoreShift');
				$msg = "<div class='alert alert-success'>                
								Add Data Shift Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);

				$unique 	= $this->session->userdata('unique');
				$this->session->unset_userdata('addCoreShift-' . $unique['unique']);

				$this->session->unset_userdata('addCoreShift');
				redirect('CoreShift/addCoreShift');
			} else {
				$msg = "<div class='alert alert-danger'>
								Add Data Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);
				redirect('CoreShift/addCoreShift');
			}
		} else {
			$this->session->set_userdata('addCoreShift', $data);
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
			$this->session->set_userdata('message', $msg);
			redirect('CoreShift/addCoreShift');
		}
	}

	public function editCoreShift()
	{
		$shift_id = $this->uri->segment(3);
		$data['main_view']['shiftnextday']		= $this->configuration->ShiftNextDay();
		$data['main_view']['CoreShift']			= $this->CoreShift_model->getCoreShift_Detail($shift_id);
		$data['main_view']['content']			= 'CoreShift/formeditCoreShift_view';
		$this->load->view('MainPage_view', $data);
	}

	public function processEditCoreShift()
	{

		$data = array(
			'shift_id' 				=> $this->input->post('shift_id', true),
			'shift_code' 			=> $this->input->post('shift_code', true),
			'shift_name' 			=> $this->input->post('shift_name', true),
			'start_working_hour'	=> $this->input->post('start_working_hour', true),
			'end_working_hour'		=> $this->input->post('end_working_hour', true),
			'working_hours_start'	=> $this->input->post('working_hours_start', true),
			'working_hours_end'		=> $this->input->post('working_hours_end', true),
			'shift_next_day'		=> $this->input->post('shift_next_day', true),
			'shift_remark'			=> $this->input->post('shift_remark', true),
			'data_state'			=> 0
		);

		$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
		$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');

		if ($this->form_validation->run() == true) {
			if ($this->CoreShift_model->updateCoreShift($data) == true) {
				$auth 	= $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1077','Application.CoreShift.edit',$auth['username'],'Edit CoreShift');
				// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_id']);
				$msg = "<div class='alert alert-success'>                
								Edit Shift Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);

				$unique 	= $this->session->userdata('unique');
				$this->session->unset_userdata('editCoreShift-' . $unique['unique']);

				redirect('CoreShift/editCoreShift/' . $data['shift_id']);
			} else {
				$msg = "<div class='alert alert-danger'>                
								Edit Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message', $msg);
				redirect('CoreShift/editCoreShift/' . $data['shift_id']);
			}
		} else {
			$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
			$this->session->set_userdata('message', $msg);
			redirect('CoreShift/editCoreShift/' . $data['shift_id']);
		}
	}


	public function deleteCoreShift()
	{
		$shift_id = $this->uri->segment(3);
		if ($this->CoreShift_model->deleteCoreShift($shift_id)) {
			$auth = $this->session->userdata('auth');
			$this->fungsi->set_log($auth['username'], '1005', 'Application.CoreShift.delete', $auth['username'], 'Delete CoreShift');
			$msg = "<div class='alert alert-success'>                
							Delete Data Shift Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message', $msg);
			redirect('CoreShift');
		} else {
			$msg = "<div class='alert alert-danger'>                
							Delete Data Shift UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
			$this->session->set_userdata('message', $msg);
			redirect('CoreShift');
		}
	}
}
