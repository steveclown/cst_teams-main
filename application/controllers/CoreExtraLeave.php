<?php
	Class CoreExtraLeave extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreExtraLeave_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreExtraLeave']		= $this->CoreExtraLeave_model->getCoreExtraLeave();
			$data['main_view']['content']				= 'CoreExtraLeave/listCoreExtraLeave_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreExtraLeave(){
			$data['main_view']['content']				= 'CoreExtraLeave/formaddCoreExtraLeave_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreExtraLeave(){
			$data = array(
				'extra_leave_code' 			=> $this->input->post('extra_leave_code',true),
				'extra_leave_name' 			=> $this->input->post('extra_leave_name',true),
				'extra_leave_range1' 		=> $this->input->post('extra_leave_range1',true),
				'extra_leave_range2' 		=> $this->input->post('extra_leave_range2',true),
				'extra_leave_days' 			=> $this->input->post('extra_leave_days',true),
				'extra_leave_remark' 		=> $this->input->post('extra_leave_remark',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('extra_leave_code', 'Extra Leave Code', 'required');
			$this->form_validation->set_rules('extra_leave_name', 'Extra Leave Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreExtraLeave_model->saveNewCoreExtraLeave($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreExtraLeave.processAddCoreExtraLeave',$auth['username'],'Add New Extra Leave');
					$msg = "<div class='alert alert-success'>                
								Add Data Extra Leave Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddCoreExtraLeave');
					redirect('CoreExtraLeave/addCoreExtraLeave');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Extra Leave UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreExtraLeave',$data);
					redirect('CoreExtraLeave/addCoreExtraLeave');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreExtraLeave',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreExtraLeave/addCoreExtraLeave');
			}
		}
		
		function editCoreExtraLeave(){
			$data['main_view']['CoreExtraLeave']		= $this->CoreExtraLeave_model->getCoreExtraLeave_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CoreExtraLeave/formeditCoreExtraLeave_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreExtraLeave(){
			$data = array(
				'extra_leave_id' 			=> $this->input->post('extra_leave_id',true),
				'extra_leave_code' 			=> $this->input->post('extra_leave_code',true),
				'extra_leave_name' 			=> $this->input->post('extra_leave_name',true),
				'extra_leave_range1' 		=> $this->input->post('extra_leave_range1',true),
				'extra_leave_range2' 		=> $this->input->post('extra_leave_range2',true),
				'extra_leave_days' 			=> $this->input->post('extra_leave_days',true),
				'extra_leave_remark' 		=> $this->input->post('extra_leave_remark',true),
				'data_state'				=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('extra_leave_code', 'Extra Leave Code', 'required');
			$this->form_validation->set_rules('extra_leave_name', 'Extra Leave Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreExtraLeave_model->saveEditCoreExtraLeave($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreExtraLeave.processEditCoreExtraLeave',$auth['username'],'Edit Extra Leave');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['extra_leave_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Extra Leave Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreExtraLeave/editCoreExtraLeave/'.$data['extra_leave_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Extra Leave Unsuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreExtraLeave/editCoreExtraLeave/'.$data['extra_leave_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreExtraLeave/editCoreExtraLeave/'.$data['extra_leave_id']);
			}
		}
		
				
		function deleteCoreExtraLeave(){
			if($this->CoreExtraLeave_model->deleteCoreExtraLeave($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreExtraLeave.deleteCoreExtraLeave',$auth['username'],'Delete Extra Leave');
				$msg = "<div class='alert alert-success'>                
							Delete Data Extra Leave Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreExtraLeave');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Extra Leave UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreExtraLeave');
			}
		}
	}
?>