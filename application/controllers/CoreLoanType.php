<?php
	Class CoreLoanType extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'loan-type';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreLoanType_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreLoanType']		= $this->CoreLoanType_model->getCoreLoanType();
			$data['main_view']['content']			= 'CoreLoanType/listCoreLoanType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreLoanType(){
			$data['main_view']['content']			= 'CoreLoanType/formaddCoreLoanType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddCoreLoanType(){
			$data = array(
				'loan_type_code' 		=> $this->input->post('loan_type_code',true),
				'loan_type_name' 		=> $this->input->post('loan_type_name',true),
				'data_state'			=> 0
				
			);
			
			$this->form_validation->set_rules('loan_type_code', 'Asset Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('loan_type_name', 'Asset Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreLoanType_model->saveNewCoreLoanType($data)){
					$loan_type_id = $this->CoreLoanType_model->getLoanTypeID();
					$auth = $this->session->userdata('auth');

					// $this->fungsi->set_log($auth['user_id'], $auth['username'],'4132','Application.coreLoanType.processAddCoreLoanType', $loan_type_id,'Add New Core Loan Type');

					$msg = "<div class='alert alert-success'>                
								Add Data Loan Type Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreLoanType');
					redirect('loan-type/add');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Loan Type UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('loan-type/add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreLoanType',$data);
				$msg = validation_errors("<div class='alert alert-error'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('loan-type/add');
			}
		}
		public function editCoreLoanType(){
			$loan_type_id = $this->uri->segment(3);
			$data['main_view']['CoreLoanType']	= $this->CoreLoanType_model->getCoreLoanType_Detail($loan_type_id);
			$data['main_view']['content']		= 'CoreLoanType/formeditCoreLoanType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreLoanType(){
			$data = array(
				'loan_type_id' 			=> $this->input->post('loan_type_id',true),
				'loan_type_code' 		=> $this->input->post('loan_type_code',true),
				'loan_type_name' 		=> $this->input->post('loan_type_name',true),
				'data_state'			=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('loan_type_code', 'Loan Type Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('loan_type_name', 'Loan Type Name', 'required');

			$old_data = $this->CoreLoanType_model->getCoreLoanType_Detail($data['loan_type_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreLoanType_model->saveEditCoreLoanType($data)==true){
					$auth 	= $this->session->userdata('auth');

					// $this->fungsi->set_log($auth['user_id'], $auth['username'],'4133','Application.coreLoanType.processEditCoreLoanType', $data['loan_type_id'],'Edit Core Loan Type');

					// $this->fungsi->set_change_log($old_data, $data, $auth['user_id'], $data['loan_type_id']);

					$msg = "<div class='alert alert-success'>                
								Edit Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('loan-type/edit/'.$data['loan_type_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('loan-type/edit/'.$data['loan_type_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('loan-type/edit/'.$data['loan_type_id']);
			}
		}
		
				
		public function deleteCoreLoanType(){
			$loan_type_id = $this->uri->segment(3);
			if($this->CoreLoanType_model->deleteCoreLoanType($loan_type_id)){
				$auth = $this->session->userdata('auth');

				// $this->fungsi->set_log($auth['user_id'], $auth['username'],'4134','Application.coreLoanType.processDeleteCoreLoanType', $loan_type_id,'Delete Core Loan Type');

				$msg = "<div class='alert alert-success'>                
							Delete Data Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('loan-type');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('loan-type');
			}
		}
	}
?>