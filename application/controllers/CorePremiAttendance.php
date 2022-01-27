<?php
	Class CorePremiAttendance extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'premi-attendance';

			$this->cekLogin();
			$this->accessMenu($menu);
			
			$this->load->model('MainPage_model');
			$this->load->model('CorePremiAttendance_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CorePremiAttendance']		= $this->CorePremiAttendance_model->getCorePremiAttendance();
			$data['main_view']['content']					= 'CorePremiAttendance/listCorePremiAttendance_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCorePremiAttendance(){
			$data['main_view']['content']					= 'CorePremiAttendance/formaddCorePremiAttendance_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCorePremiAttendance(){
			$data = array(
				'premi_attendance_code' 		=> $this->input->post('premi_attendance_code',true),
				'premi_attendance_name' 		=> $this->input->post('premi_attendance_name',true),
				'premi_attendance_range1' 		=> $this->input->post('premi_attendance_range1',true),
				'premi_attendance_range2' 		=> $this->input->post('premi_attendance_range2',true),
				'premi_attendance_amount' 		=> $this->input->post('premi_attendance_amount',true),
				'premi_attendance_remark' 		=> $this->input->post('premi_attendance_remark',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('premi_attendance_code', 'Premi Attendance Code', 'required');
			$this->form_validation->set_rules('premi_attendance_name', 'Premi Attendance Name', 'required');
			$this->form_validation->set_rules('premi_attendance_range1', 'Premi Attendance Range 1', 'required|numeric');
			$this->form_validation->set_rules('premi_attendance_range2', 'Premi Attendance Range 2', 'required|numeric');
			$this->form_validation->set_rules('premi_attendance_amount', 'Premi Attendance Amount', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CorePremiAttendance_model->saveNewCorePremiAttendance($data)){
					$auth = $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1003','Application.CorePremiAttendance.processAddCorep=PremiAttendance',$auth['username'],'Add New Premi Attendance');
					$msg = "<div class='alert alert-success'>                
								Add Data Premi Attendance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCorePremiAttendance');
					redirect('premi-attendance/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Premi Attendance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCorePremiAttendance',$data);
					redirect('premi-attendance/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCorePremiAttendance',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('premi-attendance/add');
			}
		}
		
		function editCorePremiAttendance(){
			$data['main_view']['CorePremiAttendance']	= $this->CorePremiAttendance_model->getCorePremiAttendance_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CorePremiAttendance/formeditCorePremiAttendance_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCorePremiAttendance(){
			
			$data = array(
				'premi_attendance_id' 			=> $this->input->post('premi_attendance_id',true),
				'premi_attendance_code' 		=> $this->input->post('premi_attendance_code',true),
				'premi_attendance_name' 		=> $this->input->post('premi_attendance_name',true),
				'premi_attendance_range1' 		=> $this->input->post('premi_attendance_range1',true),
				'premi_attendance_range2' 		=> $this->input->post('premi_attendance_range2',true),
				'premi_attendance_amount' 		=> $this->input->post('premi_attendance_amount',true),
				'premi_attendance_remark' 		=> $this->input->post('premi_attendance_remark',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('premi_attendance_code', 'Premi Attendance Code', 'required');
			$this->form_validation->set_rules('premi_attendance_name', 'Premi Attendance Name', 'required');
			$this->form_validation->set_rules('premi_attendance_range1', 'Premi Attendance Range 1', 'required|numeric');
			$this->form_validation->set_rules('premi_attendance_range2', 'Premi Attendance Range 2', 'required|numeric');
			$this->form_validation->set_rules('premi_attendance_amount', 'Premi Attendance Amount', 'required|numeric');
			$this->form_validation->set_rules('premi_attendance_remark', 'Premi Attendance Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CorePremiAttendance_model->saveEditCorePremiAttendance($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CorePremiAttendance.Edit',$auth['username'],'Edit Premi Attendance');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['premi_attendance_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Premi Attendance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('premi-attendance/edit/'.$data['premi_attendance_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('premi-attendance/edit/'.$data['premi_attendance_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('premi-attendance/edit/'.$data['premi_attendance_id']);
			}
		}
		
				
		function deleteCorePremiAttendance(){
			if($this->CorePremiAttendance_model->deleteCorePremiAttendance($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.CorePremiAttendance.delete',$auth['username'],'Delete Premi Attendance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Premi Attendance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('premi-attendance');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Premi Attendance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('premi-attendance');
			}
		}
	}
?>