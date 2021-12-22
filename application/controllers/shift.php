<?php
	Class shift extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('shift_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['shift']		= $this->shift_model->get_list();
			$data['main_view']['content']	= 'shift/listshift_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']	= 'shift/formaddshift_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddshift(){
			$data = array(
				'shift_code' 		=> $this->input->post('shift_code',true),
				'shift_name' 		=> $this->input->post('shift_name',true),
				'start_working_hour' 		=> $this->input->post('start_working_hour',true),
				'end_working_hour' 		=> $this->input->post('end_working_hour',true),
				'start_rest_hour' 		=> $this->input->post('start_rest_hour',true),
				'end_rest_hour' 		=> $this->input->post('end_rest_hour',true),
				'due_time_late' 		=> $this->input->post('due_time_late',true),
				'shift_remark' 		=> $this->input->post('shift_remark',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');
			if($this->form_validation->run()==true){
				if($this->shift_model->saveNewShift($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.shift.processaddshift',$auth['username'],'Add New Shift');
					$msg = "<div class='alert alert-success'>                
								Add Data Shift Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addshift');
					redirect('shift/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addshift',$data);
					redirect('shift/Add');
				}
			}else{
				$this->session->set_userdata('addshift',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('shift/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->shift_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'shift/formeditshift_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditshift(){
			
			$data = array(
				'shift_id' 		=> $this->input->post('shift_id',true),
				'shift_code' 		=> $this->input->post('shift_code',true),
				'shift_name' 		=> $this->input->post('shift_name',true),
				'start_working_hour' 		=> $this->input->post('start_working_hour',true),
				'end_working_hour' 		=> $this->input->post('end_working_hour',true),
				'start_rest_hour' 		=> $this->input->post('start_rest_hour',true),
				'end_rest_hour' 		=> $this->input->post('end_rest_hour',true),
				'due_time_late' 		=> $this->input->post('due_time_late',true),
				'shift_remark' 		=> $this->input->post('shift_remark',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');
			if($this->form_validation->run()==true){
				if($this->shift_model->saveeditshift($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.shift.Edit',$auth['username'],'Edit Shift');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Shift Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('shift/Edit/'.$data['shift_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('shift/Edit/'.$data['shift_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('shift/Edit/'.$data['shift_id']);
			}
		}
		
				
		function delete(){
			if($this->shift_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.shift.delete',$auth['username'],'Delete Shift');
				$msg = "<div class='alert alert-success'>                
							Delete Data Shift Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('shift');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Shift UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('shift');
			}
		}
	}
?>