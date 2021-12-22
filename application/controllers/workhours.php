<?php
	Class workhours extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('workhours_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		public function lists(){
			$data['main_view']['workhours']	= $this->workhours_model->get_list();
			$data['main_view']['content']	= 'workhours/listworkhours_view';
			$this->load->view('mainpage_view',$data);
		}
				
		function add(){
			$data['main_view']['content']	= 'workhours/formAddworkhours_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddworkhours(){
			$data = array(
				'shift_code' 			=> $this->input->post('shift_code',true),
				'shift_name' 			=> $this->input->post('shift_name',true),
				'start_working_hour' 	=> $this->input->post('start_working_hour',true),
				'end_working_hour' 		=> $this->input->post('end_working_hour',true),
				'start_rest_hour' 		=> $this->input->post('start_rest_hour',true),
				'end_rest_hour' 		=> $this->input->post('end_rest_hour',true),
				'due_time_late' 		=> $this->input->post('due_time_late',true),
				'shift_remark' 			=> $this->input->post('shift_remark',true),
				'data_state'			=> '0'				
			);
			
			$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');
			$this->form_validation->set_rules('start_working_hour', 'Start Work Hour', 'required');
			$this->form_validation->set_rules('end_working_hour', 'End Work Hour', 'required');
			$this->form_validation->set_rules('start_rest_hour', 'Start End Rest', 'required');
			$this->form_validation->set_rules('end_rest_hour', 'End Rest Hour', 'required');
			$this->form_validation->set_rules('due_time_late', 'Time Late', 'required');
			
			if($this->form_validation->run()==true){
				if($this->workhours_model->saveneworkhours($data)){
					$auth = $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1003','Application.workhours.processAddworkhours',$auth['username'],'Add New workhours');
					$msg = "<div class='alert alert-success'>                
								Add Data workhours Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addworkhours');
					redirect('workhours/add');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data workhours UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('workhours/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addworkhours',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('workhours/add');
			}
		}
		
		function edit(){
			$data['main_view']['result']	= $this->workhours_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']	= 'workhours/formEditworkhours_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processupdateworkhours(){
			$data = array(
				'shift_id'				=> $this->input->post('shift_id',true),
				'shift_code' 			=> $this->input->post('shift_code',true),
				'shift_name' 			=> $this->input->post('shift_name',true),
				'start_working_hour' 	=> $this->input->post('start_working_hour',true),
				'end_working_hour' 		=> $this->input->post('end_working_hour',true),
				'start_rest_hour' 		=> $this->input->post('start_rest_hour',true),
				'end_rest_hour' 		=> $this->input->post('end_rest_hour',true),
				'due_time_late' 		=> $this->input->post('due_time_late',true),
				'shift_remark' 			=> $this->input->post('shift_remark',true),
				'data_state'			=> '0'				
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('shift_code', 'Shift Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('shift_name', 'Shift Name', 'required');
			$this->form_validation->set_rules('start_working_hour', 'Start Work Hour', 'required');
			$this->form_validation->set_rules('end_working_hour', 'End Work Hour', 'required');
			$this->form_validation->set_rules('start_rest_hour', 'Start End Rest', 'required');
			$this->form_validation->set_rules('end_rest_hour', 'End Rest Hour', 'required');
			$this->form_validation->set_rules('due_time_late', 'Time Late', 'required');
			
			//print_r($data);exit;
			
			if($this->form_validation->run()==true){
				if($this->workhours_model->updateworkhours($data)==true){
					$auth 	= $this->session->userdata('auth');
					//$this->fungsi->set_log($auth['username'],'1077','Application.workhours.Edit',$auth['username'],'Edit division');
					//$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['division_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Working Hour Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('workhours/edit/'.$data['shift_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Working Hour UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('workhours/edit/'.$data['shift_id']);
				}
			}else{
				$msg = "<div class='alert alert-error'>                
							Edit Working Hour UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('workhours/edit/'.$data['shift_id']);
			}
		}
		
				
		function delete(){
			if($this->division_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				//$this->fungsi->set_log($auth['username'],'1005','Application.workhours.delete',$auth['username'],'Delete division');
				$msg = "<div class='alert alert-success'>                
							Delete Data Working Hours Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('workhours');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Working Hours UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('workhours');
			}
		}
	}
?>