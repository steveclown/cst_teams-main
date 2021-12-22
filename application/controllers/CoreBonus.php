<?php
	Class CoreBonus extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreBonus_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');

		}
		
		public function index(){
			$data['main_view']['CoreBonus']		= $this->CoreBonus_model->getCoreBonus();
			$data['main_view']['content']		= 'CoreBonus/listCoreBonus_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addCoreBonus(){
			$data['main_view']['content']		= 'CoreBonus/formaddCoreBonus_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreBonus-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreBonus-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreBonus-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreBonus-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreBonus-'.$unique['unique']);	
			redirect('CoreBonus/addCoreBonus');
		}
		
		public function processAddCoreBonus(){
			$data = array(
				'bonus_code' 		=> $this->input->post('bonus_code',true),
				'bonus_name' 		=> $this->input->post('bonus_name',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('bonus_code', 'Bonus Code', 'required');
			$this->form_validation->set_rules('bonus_name', 'Bonus Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreBonus_model->insertCoreBonus($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreBonus.processAddlanguage',$auth['username'],'Add New coreCoreBonus');
					$msg = "<div class='alert alert-success'>                
								Add Data Bonus Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreBonus');
					redirect('CoreBonus/addCoreBonus');
				}else{
					$msg = "<div class='alert alert-success'>                
								Add Data Bonus UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreBonus/addCoreBonus');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreBonus',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreBonus/addCoreBonus');
			}
		}
		
		public function editCoreBonus(){
			$bonus_id = $this->uri->segment(3);
			$data['main_view']['CoreBonus']		= $this->CoreBonus_model->getCoreBonus_Detail($bonus_id);
			$data['main_view']['content']		= 'CoreBonus/formeditCoreBonus_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreBonus(){
			
			$data = array(
				'bonus_id' 			=> $this->input->post('bonus_id',true),
				'bonus_code' 		=> $this->input->post('bonus_code',true),
				'bonus_name' 		=> $this->input->post('bonus_name',true),
				'data_state'		=> '0'
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('bonus_code', 'Bonus Code', 'required');
			$this->form_validation->set_rules('bonus_name', 'Bonus Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreBonus_model->updateCoreBonus($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreBonus.Edit',$auth['username'],'Edit Core Bonus');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreBonus_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Bonus Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreBonus/editCoreBonus/'.$data['bonus_id']);
				}else{		
					$msg = "<div class='alert alert-success'>                
								Edit Bonus UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreBonus/editCoreBonus/'.$data['bonus_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreBonus/editCoreBonus'.$data['bonus_id']);
			}
		}
		
				
		public function deleteCoreBonus(){
			$bonus_id = $this->uri->segment(3);
			if($this->CoreBonus_model->deleteCoreBonus($bonus_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreBonus.delete',$auth['username'],'Delete coreCoreBonus');
				$msg = "<div class='alert alert-success'>                
							Delete Data Bonus Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreBonus');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Bonus UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreBonus');
			}
		}
	}
?>