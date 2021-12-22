<?php
	Class CorePermit extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CorePermit_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CorePermit']		= $this->CorePermit_model->getCorePermit();
			$data['Main_view']['content']			= 'CorePermit/listCorePermit_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePermit-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCorePermit-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCorePermit-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCorePermit-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function addCorePermit(){
			$data['Main_view']['corededuction']		= create_double($this->CorePermit_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['Main_view']['content']			= 'CorePermit/formaddCorePermit_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCorePermit-'.$sesi['unique']);	
			redirect('CorePermit/addCorePermit');
		}
		
		public function processAddCorePermit(){
			$data = array(
				'deduction_id'			=> $this->input->post('deduction_id',true),
				'permit_code' 			=> $this->input->post('permit_code',true),
				'permit_name' 			=> $this->input->post('permit_name',true),
				'data_state'			=> 0
				
			);
			
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('permit_code', 'Permit Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('permit_name', 'Permit Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CorePermit_model->saveNewCorePermit($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CorePermit.processAddCorePermit',$auth['user_id'],'Add New Permit');
					$msg = "<div class='alert alert-success'>                
								Add Data Permit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCorePermit');
					redirect('CorePermit/addCorePermit');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Permit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCorePermit',$data);
					redirect('CorePermit/addCorePermit');
				}
			}else{
				$this->session->set_userdata('addCorePermit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CorePermit/addCorePermit');
			}
		}
		
		public function editCorePermit(){
			$permit_id = $this->uri->segment(3);
			$data['Main_view']['corededuction']		= create_double($this->CorePermit_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['Main_view']['CorePermit']		= $this->CorePermit_model->getCorePermit_Detail($permit_id);
			$data['Main_view']['content']			= 'CorePermit/formeditCorePermit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCorePermit(){
			
			$data = array(
				'permit_id' 			=> $this->input->post('permit_id',true),
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'permit_code' 			=> $this->input->post('permit_code',true),
				'permit_name' 			=> $this->input->post('permit_name',true),
				'data_state'			=> 0
			);

			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('permit_code', 'Permit Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('permit_name', 'Permit Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CorePermit_model->saveEditCorePermit($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['user_id'],'1077','Application.CorePermit.editCorePermit',$auth['user_id'],'Edit Permit');
					// $this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['permit_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Permit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CorePermit/editCorePermit/'.$data['permit_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Edit Permit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CorePermit/editCorePermit/'.$data['permit_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CorePermit/editCorePermit/'.$data['permit_id']);
			}
		}

		public function deleteCorePermit(){
			$permit_id = $this->uri->segment(3);
			if($this->CorePermit_model->deleteCorePermit($permit_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CorePermit.deleteCorePermit',$auth['user_id'],'Delete Permit');
				$msg = "<div class='alert alert-success'>                
							Delete Data Permit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CorePermit');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Permit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CorePermit');
			}
		}
	}
?>