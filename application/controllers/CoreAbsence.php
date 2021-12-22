<?php
	Class CoreAbsence extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreAbsence_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreAbsence']		= $this->CoreAbsence_model->getCoreAbsence();
			$data['Main_view']['content']			= 'CoreAbsence/listCoreAbsence_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreAbsence(){
			$data['Main_view']['corededuction']		= create_double($this->CoreAbsence_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['Main_view']['content']			= 'CoreAbsence/formaddCoreAbsence_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreAbsence-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreAbsence-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreAbsence-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreAbsence-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreAbsence-'.$sesi['unique']);	
			redirect('CoreAbsence/addCoreAbsence');
		}
		
		public function processAddCoreAbsence(){
			$data = array(
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'absence_code' 			=> $this->input->post('absence_code',true),
				'absence_name' 			=> $this->input->post('absence_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('absence_code', 'Absence Code', 'required');
			$this->form_validation->set_rules('absence_name', 'Absence Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreAbsence_model->saveNewCoreAbsence($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreAbsence.processAddCoreAbsence',$auth['user_id'],'Add New Absence');
					$msg = "<div class='alert alert-success'>                
								Add Data Absence Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreAbsence');
					redirect('CoreAbsence/addCoreAbsence');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Absence UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreAbsence',$data);
					redirect('CoreAbsence/addCoreAbsence');
				}
			}else{
				$this->session->set_userdata('addCoreAbsence',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreAbsence/addCoreAbsence');
			}
		}
		
		public function editCoreAbsence(){
			$absence_id = $this->uri->segment(3);
			$data['Main_view']['corededuction']		= create_double($this->CoreAbsence_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['Main_view']['CoreAbsence']		= $this->CoreAbsence_model->getCoreAbsence_Detail($absence_id);
			$data['Main_view']['content']			= 'CoreAbsence/formeditCoreAbsence_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreAbsence(){
			
			$data = array(
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'absence_id' 			=> $this->input->post('absence_id',true),
				'absence_code' 			=> $this->input->post('absence_code',true),
				'absence_name' 			=> $this->input->post('absence_name',true),
				'data_state'			=> 0
			);

			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('absence_code', 'Absence Code', 'required');
			$this->form_validation->set_rules('absence_name', 'Absence Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreAbsence_model->saveEditCoreAbsence($data)==true){
					$auth 	= $this->session->userdata('auth');					
					// $this->fungsi->set_log($auth['user_id'],'1077','Application.CoreAbsence.editCoreAbsence',$auth['user_id'],'Edit Absence');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['absence_id']);					
					$msg = "<div class='alert alert-success alert-dismissable'>                
								Edit Absence Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAbsence/editCoreAbsence/'.$data['absence_id']);
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>
								Edit Absence UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAbsence/editCoreAbsence/'.$data['absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreAbsence/editCoreAbsence/'.$data['absence_id']);
			}
		}

		public function deleteCoreAbsence(){
			$absence_id = $this->uri->segment(3);
			if($this->CoreAbsence_model->deleteCoreAbsence($absence_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreAbsence.deleteCoreAbsence',$auth['user_id'],'Delete Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAbsence');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAbsence');
			}
		}
	}
?>