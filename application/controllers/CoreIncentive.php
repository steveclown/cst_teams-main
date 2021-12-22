<?php
	Class CoreIncentive extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreIncentive_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreIncentive']		= $this->CoreIncentive_model->getCoreIncentive();
			$data['Main_view']['content']			= 'CoreIncentive/listCoreIncentive_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreIncentive(){
			$data['Main_view']['content']					= 'CoreIncentive/formaddCoreIncentive_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreIncentive-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreIncentive-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreIncentive-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreIncentive-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreIncentive-'.$sesi['unique']);	
			redirect('CoreIncentive/addCoreIncentive');
		}
		
		public function processAddCoreIncentive(){
			$data = array(
				'incentive_code' 		=> $this->input->post('incentive_code',true),
				'incentive_name' 		=> $this->input->post('incentive_name',true),
				'incentive_amount' 		=> $this->input->post('incentive_amount',true),
				'incentive_remark' 		=> $this->input->post('incentive_remark',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('incentive_code', 'Incentive Code', 'required');
			$this->form_validation->set_rules('incentive_name', 'Incentive Name', 'required');
			$this->form_validation->set_rules('incentive_amount', 'Incentive Amount', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreIncentive_model->saveNewCoreIncentive($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreIncentive.processAddCoreIncentive',$auth['username'],'Add New Incentive');
					$msg = "<div class='alert alert-success'>                
								Add Data Incentive Success
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreIncentive');
					redirect('CoreIncentive/addCoreIncentive');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Incentive Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreIncentive',$data);
					redirect('CoreIncentive/addCoreIncentive');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreIncentive',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreIncentive/addCoreIncentive');
			}
		}
		
		public function editCoreIncentive(){
			$data['Main_view']['CoreIncentive']		= $this->CoreIncentive_model->getCoreIncentive_Detail($this->uri->segment(3));
			$data['Main_view']['content']			= 'CoreIncentive/formeditCoreIncentive_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreIncentive(){
			
			$data = array(
				'incentive_id' 			=> $this->input->post('incentive_id',true),
				'incentive_code' 		=> $this->input->post('incentive_code',true),
				'incentive_name' 		=> $this->input->post('incentive_name',true),
				'incentive_amount' 		=> $this->input->post('incentive_amount',true),
				'incentive_remark' 		=> $this->input->post('incentive_remark',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('incentive_code', 'Incentive Code', 'required');
			$this->form_validation->set_rules('incentive_name', 'Incentive Name', 'required');
			$this->form_validation->set_rules('incentive_amount', 'Incentive Amount', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreIncentive_model->saveEditCoreIncentive($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreIncentive.Edit',$auth['username'],'Edit Incentive');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['incentive_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Incentive Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreIncentive/editCoreIncentive/'.$data['incentive_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreIncentive/editCoreIncentive/'.$data['incentive_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreIncentive/editCoreIncentive/'.$data['incentive_id']);
			}
		}
		
				
		public function deleteCoreIncentive(){
			if($this->CoreIncentive_model->deleteCoreIncentive($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreIncentive.delete',$auth['username'],'Delete Incentive');
				$msg = "<div class='alert alert-success'>                
							Delete Data Incentive Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreIncentive');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Incentive UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreIncentive');
			}
		}
	}
?>