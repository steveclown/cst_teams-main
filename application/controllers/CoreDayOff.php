<?php
	Class CoreDayOff extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreDayOff_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreDayOff']		= $this->CoreDayOff_model->getCoreDayOff();
			$data['Main_view']['content']			= 'CoreDayOff/listCoreDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreDayOff(){
			$data['Main_view']['content']			= 'CoreDayOff/formaddCoreDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddCoreDayOff(){
			$data = array(
				'dayoff_code' 			=> $this->input->post('dayoff_code',true),
				'dayoff_name' 			=> $this->input->post('dayoff_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('dayoff_code', 'Day Off Code', 'required');
			$this->form_validation->set_rules('dayoff_name', 'Day Off Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreDayOff_model->saveNewCoreDayOff($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreDayOff.processAddCoreDayOff',$auth['user_id'],'Add New Day Off');
					$msg = "<div class='alert alert-success'>                
								Add Data Day Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreDayOff');
					redirect('CoreDayOff/addCoreDayOff');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data DayOff UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreDayOff',$data);
					redirect('CoreDayOff/addCoreDayOff');
				}
			}else{
				$this->session->set_userdata('addCoreDayOff',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreDayOff/addCoreDayOff');
			}
		}
		
		function editCoreDayOff(){
			$data['Main_view']['CoreDayOff']		= $this->CoreDayOff_model->getCoreDayOff_Detail($this->uri->segment(3));
			$data['Main_view']['content']			= 'CoreDayOff/formeditCoreDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreDayOff(){
			
			$data = array(
				'dayoff_id' 			=> $this->input->post('dayoff_id',true),
				'dayoff_code' 			=> $this->input->post('dayoff_code',true),
				'dayoff_name' 			=> $this->input->post('dayoff_name',true),
				'data_state'			=> 0
			);

			$this->form_validation->set_rules('dayoff_code', 'DayOff Code', 'required');
			$this->form_validation->set_rules('dayoff_name', 'DayOff Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreDayOff_model->saveEditCoreDayOff($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['user_id'],'1077','Application.CoreDayOff.editCoreDayOff',$auth['user_id'],'Edit Core Day Off');
					// $this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['dayoff_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Day Off Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreDayOff/editCoreDayOff/'.$data['dayoff_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Edit Day Off UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreDayOff/editCoreDayOff/'.$data['dayoff_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreDayOff/editCoreDayOff/'.$data['dayoff_id']);
			}
		}

		function deleteCoreDayOff(){
			if($this->CoreDayOff_model->deleteCoreDayOff($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreDayOff.deleteCoreDayOff',$auth['user_id'],'Delete Core Day Off');
				$msg = "<div class='alert alert-success'>                
							Delete Data Day Off Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDayOff');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Day Off UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDayOff');
			}
		}
	}
?>