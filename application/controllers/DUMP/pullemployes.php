<?php
	Class PullEmployes extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('PullEmployes_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$data['main_view']['content']='PullEmployes/pull-employes';
			$this->load->view('mainpage_view',$data);
		}
		
		public function selectMachine(){
			$data = array (
				"ip" 				=> $this->input->post('ip',true),
				"comkey" 			=> $this->input->post('comkey',true)
			);
			$this->session->set_userdata('filter-selectMachine',$data);
			redirect('pullemployes');
		}
		
		public function reset_machine(){
			$this->session->unset_userdata('filter-selectMachine');
			redirect('pullemployes');
		}
		public function getdetail(){
			$user_id	= $this->uri->segment(3);
			// print_r($user_id); exit;
			$data['item']	= $this->PullEmployes_model->getDetail($user_id);
			$data['main_view']['content']	= 'pullemployes/formEditEmployee_view';
			$this->load->view('mainpage_view',$data);
		}
		function processEditEmployee(){
			
			$data = array(
				'user_id' 			=> $this->input->post('user_id',true),
				'name' 				=> $this->input->post('name',true),
				'employee_address' 		=> $this->input->post('employee_address',true),
				'employee_ktp' 		=> $this->input->post('employee_ktp',true),
				'employee_ttl' 		=> $this->input->post('employee_ttl',true)
				// 'data_state'		=> '0'
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_ktp', 'No. KTP', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->PullEmployes_model->saveEditEmployee($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.pullemployes.getdetail',$auth['username'],'Edit Employee');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['user_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('pullemployes/getdetail/'.$data['user_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit bank UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('pullemployes/getdetail/'.$old_setting_user_id);
				}
			}else{
				$msg = "<div class='alert alert-error'>                
								Id User : <b>".$data['user_id']."</b> has been exist !
							</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('pullemployes/getdetail/'.$old_setting_user_id);
			}
		}
		// public function SavePullEmployes(){
			
		// }
	}
?>