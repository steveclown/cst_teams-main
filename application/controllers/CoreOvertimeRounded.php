<?php
	Class CoreOvertimeRounded extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreOvertimeRounded_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreOvertimeRounded']		= $this->CoreOvertimeRounded_model->getCoreOvertimeRounded();
			$data['main_view']['content']					= 'CoreOvertimeRounded/listCoreOvertimeRounded_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreOvertimeRounded(){
			$data['main_view']['content']					= 'CoreOvertimeRounded/formaddCoreOvertimeRounded_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreOvertimeRounded(){
			$data = array(
				'overtime_minute_range1' 	=> $this->input->post('overtime_minute_range1',true),
				'overtime_minute_range2' 	=> $this->input->post('overtime_minute_range2',true),
				'overtime_minute_rounded' 	=> $this->input->post('overtime_minute_rounded',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('overtime_minute_range1', 'Overtime Minute Range 1', 'required|numeric');
			$this->form_validation->set_rules('overtime_minute_range2', 'Overtime Minute Range 2', 'required|numeric');
			$this->form_validation->set_rules('overtime_minute_rounded', 'Overtime Minute Rounded', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeRounded_model->saveNewCoreOvertimeRounded($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreOvertimeRounded.processAddCoreOvertimeRounded',$auth['username'],'Add New Overtime Rounded');
					$msg = "<div class='alert alert-success'>                
								Add Data Overtime Rounded Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreOvertimeRounded');
					redirect('CoreOvertimeRounded/addCoreOvertimeRounded');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Rounded UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreOvertimeRounded',$data);
					redirect('CoreOvertimeRounded/addCoreOvertimeRounded');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreOvertimeRounded',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeRounded/addCoreOvertimeRounded');
			}
		}
		
		function editCoreOvertimeRounded(){
			$data['main_view']['CoreOvertimeRounded']	= $this->CoreOvertimeRounded_model->getCoreOvertimeRounded_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CoreOvertimeRounded/formeditCoreOvertimeRounded_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreOvertimeRounded(){
			$data = array(
				'overtime_rounded_id' 			=> $this->input->post('overtime_rounded_id',true),
				'overtime_minute_range1' 		=> $this->input->post('overtime_minute_range1',true),
				'overtime_minute_range2' 		=> $this->input->post('overtime_minute_range2',true),
				'overtime_minute_rounded'	 	=> $this->input->post('overtime_minute_rounded',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('overtime_minute_range1', 'Overtime Minute Range 1', 'required|numeric');
			$this->form_validation->set_rules('overtime_minute_range2', 'Overtime Minute Range 2', 'required|numeric');
			$this->form_validation->set_rules('overtime_minute_rounded', 'Overtime Minute Rounded', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeRounded_model->saveEditCoreOvertimeRounded($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreOvertimeRounded.processEditCoreOvertimeRounded',$auth['username'],'Edit Overtime Rounded');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['overtime_rounded_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Overtime Rounded Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeRounded/editCoreOvertimeRounded/'.$data['overtime_rounded_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeRounded/editCoreOvertimeRounded/'.$data['overtime_rounded_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeRounded/editCoreOvertimeRounded/'.$data['overtime_rounded_id']);
			}
		}
		
				
		function deleteCoreOvertimeRounded(){
			if($this->CoreOvertimeRounded_model->deleteCoreOvertimeRounded($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreOvertimeRounded.deleteCoreOvertimeRounded',$auth['username'],'Delete Overtime Rounded');
				$msg = "<div class='alert alert-success'>                
							Delete Data Overtime Rounded Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeRounded');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Overtime Rounded UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeRounded');
			}
		}
	}
?>