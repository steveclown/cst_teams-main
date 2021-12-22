<?php
	Class CoreContract extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreContract_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreContract']		= $this->CoreContract_model->getCoreContract();
			$data['main_view']['content']			= 'CoreContract/listCoreContract_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreContract(){
			$data['main_view']['content']		= 'CoreContract/formaddCoreContract_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreContract(){
			$data = array(
				'contract_code' 		=> $this->input->post('contract_code',true),
				'contract_name' 		=> $this->input->post('contract_name',true),
				'contract_remark' 		=> $this->input->post('contract_remark',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('contract_code', 'Contract Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('contract_name', 'Contract Name', 'required');
			$this->form_validation->set_rules('contract_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->CoreContract_model->saveNewCoreContract($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreContract.processAddCoreContract',$auth['username'],'Add New Contract');
					$msg = "<div class='alert alert-success'>                
								Add Data Contract Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreContract');
					redirect('CoreContract/addCoreContract');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Contract UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreContract',$data);
					redirect('CoreContract/addCoreContract');
				}
			}else{
				$this->session->set_userdata('addCoreContract',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreContract/addCoreContract');
			}
		}
		
		function editCoreContract(){
			$data['main_view']['CoreContract']	= $this->CoreContract_model->getCoreContract_Detail($this->uri->segment(3));
			$data['main_view']['content']		= 'CoreContract/formeditCoreContract_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreContract(){
			$data = array(
				'contract_id' 			=> $this->input->post('contract_id',true),
				'contract_code' 		=> $this->input->post('contract_code',true),
				'contract_name' 		=> $this->input->post('contract_name',true),
				'contract_remark' 		=> $this->input->post('contract_remark',true),
				'data_state'		=> 0
			);
			$this->form_validation->set_rules('contract_code', 'Contract Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('contract_name', 'Contract Name', 'required');
			$this->form_validation->set_rules('contract_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->CoreContract_model->saveEditCoreContract($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreContract.edit',$auth['username'],'Edit Contract');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreContract_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Contract Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreContract/editCoreContract/'.$data['contract_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Contract UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreContract/editCoreContract/'.$data['contract_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreContract/editCoreContract/'.$data['contract_id']);
			}
		}
		
		function deleteCoreContract(){
			if($this->CoreContract_model->deleteCoreContract($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreContract.delete',$auth['username'],'Delete CoreContract');
				$msg = "<div class='alert alert-success'>                
							Delete Contract Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreContract');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Contract Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreContract');
			}
		}
	}
?>