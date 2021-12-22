<?php
	Class CoreOvertimeType extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreOvertimeType_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreOvertimeType']		= $this->CoreOvertimeType_model->getCoreOvertimeType();
			$data['Main_view']['content']				= 'CoreOvertimeType/listCoreOvertimeType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreOvertimeType(){
			$data['Main_view']['content']				= 'CoreOvertimeType/formaddCoreOvertimeType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddCoreOvertimeType(){
			$data = array(
				'overtime_type_code' 					=> $this->input->post('overtime_type_code',true),
				'overtime_type_name' 					=> $this->input->post('overtime_type_name',true),
				'overtime_type_working_day_hour1' 		=> $this->input->post('overtime_type_working_day_hour1',true),
				'overtime_type_working_day_ratio1' 		=> $this->input->post('overtime_type_working_day_ratio1',true),
				'overtime_type_working_day_hour2' 		=> $this->input->post('overtime_type_working_day_hour2',true),
				'overtime_type_working_day_ratio2' 		=> $this->input->post('overtime_type_working_day_ratio2',true),
				'overtime_type_day_off_hour1' 			=> $this->input->post('overtime_type_day_off_hour1',true),
				'overtime_type_day_off_ratio1' 			=> $this->input->post('overtime_type_day_off_ratio1',true),
				'overtime_type_day_off_hour2' 			=> $this->input->post('overtime_type_day_off_hour2',true),
				'overtime_type_day_off_ratio2' 			=> $this->input->post('overtime_type_day_off_ratio2',true),
				'overtime_type_amount' 					=> $this->input->post('overtime_type_amount',true),
				'overtime_type_remark' 					=> $this->input->post('overtime_type_remark',true),
				'data_state'							=> 0
			);
			
			$this->form_validation->set_rules('overtime_type_code', 'Overtime Type Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('overtime_type_name', 'Overtime Type Name', 'required');
			/*$this->form_validation->set_rules('overtime_type_working_day_hour1', 'Working Day Hour 1', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_ratio1', 'Working Day Ratio 1', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_hour2', 'Working Day Hour 2', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_ratio2', 'Working Day Ratio 2', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_hour1', 'Day Off Hour 1', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_ratio1', 'Day Off Ratio 1', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_hour2', 'Day Off Hour 2', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_ratio2', 'Day Off Ratio 2', 'required');*/
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeType_model->saveNewCoreOvertimeType($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreOvertimeType.processAddCoreOvertimeType',$auth['username'],'Add New Overtime Type');
					$msg = "<div class='alert alert-success'>                
								Add Data Overtime Type Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddOvertimeType');
					redirect('CoreOvertimeType/addCoreOvertimeType');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Type UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddOvertimeType',$data);
					redirect('CoreOvertimeType/addCoreOvertimeType');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddOvertimeType',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeType/addCoreOvertimeType');
			}
		}
		
		public function editCoreOvertimeType(){
			$data['Main_view']['CoreOvertimeType']	= $this->CoreOvertimeType_model->getCoreOvertimeType_Detail($this->uri->segment(3));
			$data['Main_view']['content']	= 'CoreOvertimeType/formeditCoreOvertimeType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreOvertimeType(){
			
			$data = array(
				'overtime_type_id' 						=> $this->input->post('overtime_type_id',true),
				'overtime_type_code' 					=> $this->input->post('overtime_type_code',true),
				'overtime_type_name' 					=> $this->input->post('overtime_type_name',true),
				'overtime_type_working_day_hour1' 		=> $this->input->post('overtime_type_working_day_hour1',true),
				'overtime_type_working_day_ratio1' 		=> $this->input->post('overtime_type_working_day_ratio1',true),
				'overtime_type_working_day_hour2' 		=> $this->input->post('overtime_type_working_day_hour2',true),
				'overtime_type_working_day_ratio2' 		=> $this->input->post('overtime_type_working_day_ratio2',true),
				'overtime_type_day_off_hour1' 			=> $this->input->post('overtime_type_day_off_hour1',true),
				'overtime_type_day_off_ratio1' 			=> $this->input->post('overtime_type_day_off_ratio1',true),
				'overtime_type_day_off_hour2' 			=> $this->input->post('overtime_type_day_off_hour2',true),
				'overtime_type_day_off_ratio2' 			=> $this->input->post('overtime_type_day_off_ratio2',true),
				'overtime_type_amount' 					=> $this->input->post('overtime_type_amount',true),
				'overtime_type_remark' 					=> $this->input->post('overtime_type_remark',true),
				'data_state'							=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('overtime_type_code', 'Overtime Type Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('overtime_type_name', 'Overtime Type Name', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_hour1', 'Working Day Hour 1', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_ratio1', 'Working Day Ratio 1', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_hour2', 'Working Day Hour 2', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_ratio2', 'Working Day Ratio 2', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_hour1', 'Day Off Hour 1', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_ratio1', 'Day Off Ratio 1', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_hour2', 'Day Off Hour 2', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_ratio2', 'Day Off Ratio 2', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeType_model->saveEditCoreOvertimeType($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreOvertimeType.Edit',$auth['username'],'Edit Overtime Type');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['overtime_type_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Overtime Type Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeType/editCoreOvertimeType/'.$data['overtime_type_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeType/editCoreOvertimeType/'.$data['overtime_type_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeType/editCoreOvertimeType/'.$data['overtime_type_id']);
			}
		}
		
				
		public function deleteCoreOvertimeType(){
			if($this->CoreOvertimeType_model->deleteCoreOvertimeType($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreOvertimeType.delete',$auth['username'],'Delete Overtime Type');
				$msg = "<div class='alert alert-success'>                
							Delete Data Overtime Type Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeType');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Overtime Type UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeType');
			}
		}
	}
?>