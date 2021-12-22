<?php
	Class attendanceregistration extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('attendanceregistration_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$sesi=$this->session->userdata('filter-attendanceregistration');
			if(!is_array($sesi)){
				$sesi['machine_id'] ='';
				$sesi['attendance_status'] ='';
			}
			$data['main_view']['attendanceregistration']		= $this->attendanceregistration_model->get_list($sesi);
			$data['main_view']['machine']	= create_double($this->attendanceregistration_model->getmachine(),'machine_id', 'machine_name');
			$data['main_view']['content']	= 'attendanceregistration/listattendanceregistration_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'machine_id'				=> $this->input->post('machine_id',true),
				'attendance_status'			=> $this->input->post('attendance_status',true),
			);

			$this->session->set_userdata('filter-attendanceregistration',$data);
			redirect('attendanceregistration');
		}		
		
		public function resetfilter(){
			$this->session->unset_userdata('filter-attendanceregistration',$data);
			redirect('attendanceregistration');
		}
		
		function assign(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data = array(
							'attendance_employee_id' 	=> $this->uri->segment(3),
							'employee_id' 				=> $employee_id,
			);
			if($this->attendanceregistration_model->saveeditattendanceregistration($data)==true){
				$msg = "<div class='alert alert-success'>
							Employee Registration Succesful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('attendanceregistration');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Employee Registration Unsuccesful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('attendanceregistration');
			}
			$data['main_view']['content']	= 'attendanceregistration/listattendanceregistration_view';
			$this->load->view('mainpage_view',$data);
		}

		function remove(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data = array(
							'attendance_employee_id' 	=> $this->uri->segment(3),
							'employee_id' 				=> '',
			);
			if($this->attendanceregistration_model->saveeditattendanceregistration($data)==true){
				$msg = "<div class='alert alert-success'>
							Employee Registration Succesful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('attendanceregistration');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Employee Registration Unsuccesful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('attendanceregistration');
			}
			$data['main_view']['content']	= 'attendanceregistration/listattendanceregistration_view';
			$this->load->view('mainpage_view',$data);
		}
	}
?>