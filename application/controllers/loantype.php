<?php
	Class loantype extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('loantype_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}

		public function lists(){
			$data['main_view']['loantype']		= $this->loantype_model->get_list();
			$data['main_view']['content']	= 'loantype/listLoantype_view';
			$this->load->view('mainpage_view',$data);
		}

		function Add(){
			$data['main_view']['content']	= 'loantype/formAddLoantype_view';
			$this->load->view('mainpage_view',$data);
		}

		function processAddLoanType(){
			$data = array(
				'loan_type_code' 		=> $this->input->post('loan_type_code',true),
				'loan_type_name' 		=> $this->input->post('loan_type_name',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('loan_type_code', 'Loan Type Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('loan_type_name', 'Loan Type Name', 'required');
			if($this->form_validation->run()==true){
				if($this->loantype_model->saveNewloantype($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.loantype.processAddLoanType',$auth['username'],'Add New loantype');
					$msg = "<div class='alert alert-success'>                
								Add Data Loan Type Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddLoanType');
					redirect('loantype/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Loan Type UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddLoanType',$data);
					redirect('loantype/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddLoanType',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('loantype/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->loantype_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'loantype/formEditLoantype_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditLoantype(){
			
			$data = array(
				'loan_type_id' 			=> $this->input->post('loan_type_id',true),
				'loan_type_code' 		=> $this->input->post('loan_type_code',true),
				'loan_type_name' 		=> $this->input->post('loan_type_name',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('loan_type_code', 'Loan Type Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('loan_type_name', 'Loan Type Name', 'required');
			if($this->form_validation->run()==true){
				if($this->loantype_model->saveEditloantype($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.loantype.Edit',$auth['username'],'Edit loan type');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['loan_type_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Loan Type Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('loantype/Edit/'.$data['loan_type_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('loantype/Edit/'.$data['loan_type_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('loantype/Edit/'.$data['loan_type_id']);
			}
		}
		
				
		function delete(){
			if($this->loantype_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.loantype.delete',$auth['username'],'Delete loantype');
				$msg = "<div class='alert alert-success'>                
							Delete Data Loan Type Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('loantype');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Loan Type UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('loantype');
			}
		}
	}
?>