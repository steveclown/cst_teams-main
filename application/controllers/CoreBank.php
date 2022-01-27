<?php
	Class CoreBank extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'bank';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreBank_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreBank']		= $this->CoreBank_model->getCoreBank();
			$data['main_view']['content']		= 'CoreBank/listCoreBank_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addCoreBank(){
			$data['main_view']['content']		= 'CoreBank/formaddCoreBank_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddCoreBank(){
			$data = array(
				'bank_code' 		=> $this->input->post('bank_code',true),
				'bank_name' 		=> $this->input->post('bank_name',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('bank_code', 'Bank Code', 'required');
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreBank_model->saveNewCoreBank($data)){
					$auth = $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['user_id'],'1003','Application.Bank.processAddCoreBank',$auth['user_id'],'Add New Bank');
					$msg = "<div class='alert alert-success'>                
								Add Data Bank Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addbank');
					redirect('bank/add');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Bank UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bank/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addbank',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('bank/add');
			}
		}
		
		public function editCoreBank(){
			$data['main_view']['CoreBank']	= $this->CoreBank_model->getCoreBank_Detail($this->uri->segment(3));
			$data['main_view']['content']	= 'CoreBank/formeditCoreBank_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreBank(){
			
			$data = array(
				'bank_id' 			=> $this->input->post('bank_id',true),
				'bank_code' 		=> $this->input->post('bank_code',true),
				'bank_name' 		=> $this->input->post('bank_name',true),
				'data_state'		=> 0
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('bank_code', 'Bank Code', 'required');
			$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreBank_model->saveEditCoreBank($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['user_id'],'1077','Application.Bank.processEditCoreBank',$auth['user_id'],'Edit Bank');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['bank_id']);
					$msg = "<div class='alert alert-success'>                
								Edit bank Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bank/edit/'.$data['bank_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit bank UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bank/edit/'.$data['bank_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('bank/edit/'.$data['bank_id']);
			}
		}
		
				
		function deleteCoreBank(){
			if($this->CoreBank_model->deleteCoreBank($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['user_id'],'1005','Application.Bank.deleteCoreBank',$auth['user_id'],'Delete Bank');
				$msg = "<div class='alert alert-success'>                
							Delete Data core_bank Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('bank');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data core_bank UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('bank');
			}
		}
	}
?>