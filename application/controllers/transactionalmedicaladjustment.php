<?php
	Class transactionalmedicaladjustment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalmedicaladjustment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalmedicaladjustment']		= $this->transactionalmedicaladjustment_model->get_list();
			$data['main_view']['content']	= 'transactionalmedicaladjustment/listtransactionalmedicaladjustment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function listmedicalcoverage(){
			$data['main_view']['medicalcoverage']		= $this->transactionalmedicaladjustment_model->get_listmedicalcoverage($this->session->userdata("employee_id"));
			$data['main_view']['content']		= 'transactionalmedicaladjustment/listtransactionalmedicalcoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalmedicaladjustment/addtransactionalmedicaladjustment_view';
			// $data['main_view']['employee']		= create_double($this->transactionalmedicaladjustment_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['employee']		= $this->transactionalmedicaladjustment_model->getemployeename($this->session->userdata("employee_id"));
			// $data['main_view']['medicalcoverage']	= create_double($this->transactionalmedicaladjustment_model->getmedicalcoverage(),'medical_coverage_id','medical_coverage_name');
			$data['main_view']['data']		= $this->transactionalmedicaladjustment_model->getmedicalcoverage($this->uri->segment(3));
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddtransactionalmedicaladjustment(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_medical_coverage_id'	 	=> $this->input->post('employee_medical_coverage_id',true),
				'medical_adjustment_date' 			=> tgltodb($this->input->post('medical_adjustment_date',true)),
				'medical_adjustment_amount'			=> $this->input->post('medical_adjustment_amount',true),
				'medical_adjustment_remark' 		=> $this->input->post('medical_adjustment_remark',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			// print_r($data);exit;
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_medical_coverage_id', 'Medical Coverage name', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalmedicaladjustment_model->saveNewtransactionalmedicaladjustment($data)){
					$medical_coverage_amount = $data[medical_adjustment_amount]-$this->input->post('medical_coverage_amount',true);
					// print_r($medical_coverage_amount);exit;
					$this->transactionalmedicaladjustment_model->updatedata($data[employee_medical_coverage_id],$medical_coverage_amount);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalmedicaladjustment.processAddtransactionalmedicaladjustment',$auth['username'],'Add New Transactional Medical Adjustment');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Medical Adjustment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtransactionalmedicaladjustment');
					redirect('transactionalmedicaladjustment/listmedicalcoverage');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Medical Adjustment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalmedicaladjustment/Add/'.$data[employee_medical_coverage_id]);
				}
			}else{
				$this->session->set_userdata('Addtransactionalmedicaladjustment',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalmedicaladjustment/Add/'.$data[employee_medical_coverage_id]);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalmedicaladjustment_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalmedicaladjustment/edittransactionalmedicaladjustment_view';
			$data['main_view']['employee']		= create_double($this->transactionalmedicaladjustment_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['medicalcoverage']		= create_double($this->transactionalmedicaladjustment_model->getmedicalcoverage(),'medical_coverage_id','medical_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalmedicaladjustment(){
			
			$data = array(
				'medical_adjustment_id' 					=> $this->input->post('medical_adjustment_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'medical_coverage_id'	 			=> $this->input->post('medical_coverage_id',true),
				'medical_adjustment_date' 				=> $this->input->post('medical_adjustment_date',true),
				'medical_adjustment_amount'			 	=> $this->input->post('medical_adjustment_amount',true),
				'medical_adjustment_remark' 				=> $this->input->post('medical_adjustment_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('medical_coverage_id', 'Medical Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalmedicaladjustment_model->saveEdittransactionalmedicaladjustment($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalmedicaladjustment.Edit',$auth['username'],'Edit Transactional Medical Adjustment');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['medical_adjustment_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Medical Adjustment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalmedicaladjustment/Edit/'.$data['medical_adjustment_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Medical Adjustment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalmedicaladjustment/Edit/'.$data['medical_adjustment_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalmedicaladjustment/Edit/'.$data['medical_adjustment_id']);
			}
		}
		
		function delete(){
			if($this->transactionalmedicaladjustment_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalmedicaladjustment.delete',$auth['username'],'Delete transactionalmedicaladjustment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Medical Adjustment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalmedicaladjustment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Medical Adjustment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalmedicaladjustment');
			}
		}
	}
?>