<?php
	Class shiftgroup extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('shiftgroup_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['shiftgroup']	= $this->shiftgroup_model->get_list();
			$data['main_view']['content']		= 'shiftgroup/listshiftgroup_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['shift']		= create_double($this->shiftgroup_model->getshift(),'shift_id','shift_name');
			$data['main_view']['content']	= 'shiftgroup/formaddshiftgroup_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddshiftgroup(){
			$data = array(
				'shift_group_code' 	=> $this->input->post('shift_group_code',true),
				'shift_group_name' 	=> $this->input->post('shift_group_name',true),
				'shift_id' 			=> $this->input->post('shift_id',true),
				'shift_group_remark' 			=> $this->input->post('shift_group_remark',true),
				'data_state'		=> '0'
			);
			// print_r($data);exit;
			$this->form_validation->set_rules('shift_group_code', 'Shift Group Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('shift_group_name', 'Shift Group Name', 'required');
			$this->form_validation->set_rules('shift_id', 'Shift Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->shiftgroup_model->saveNewshiftgroup($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.shiftgroup.processAddshiftgroup',$auth['username'],'Add New Shift Group');
					$msg = "<div class='alert alert-success'>                
								Add Data Shift Group Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddShiftGroup');
					redirect('shiftgroup/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Shift Group UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddShiftGroup',$data);
					redirect('shiftgroup/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddShiftGroup',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('shiftgroup/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['shift']	= create_double($this->shiftgroup_model->getshift(),'shift_id','shift_name');
			$data['main_view']['result']	= $this->shiftgroup_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'shiftgroup/formeditshiftgroup_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditshiftgroup(){
			$data = array(
				'shift_group_id' 			=> $this->input->post('shift_group_id',true),
				'shift_group_code' 		=> $this->input->post('shift_group_code',true),
				'shift_group_name' 		=> $this->input->post('shift_group_name',true),
				'shift_id' 		=> $this->input->post('shift_id',true),
				'shift_group_remark' 			=> $this->input->post('shift_group_remark',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('shift_group_code', 'Shift Group Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('shift_group_name', 'Shift Group Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->shiftgroup_model->saveEditshiftgroup($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.shiftgroup.Edit',$auth['username'],'Edit Shift Group');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_group_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Shift Group Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('shiftgroup/Edit/'.$data['shift_group_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('shiftgroup/Edit/'.$data['shift_group_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('shiftgroup/Edit/'.$data['shift_group_id']);
			}
		}

		function delete(){
			if($this->shiftgroup_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.shiftgroup.delete',$auth['username'],'Delete Shift Group');
				$msg = "<div class='alert alert-success'>                
							Delete Data Shift Group Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('shiftgroup');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Shift Group UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('shiftgroup');
			}
		}
	}
?>