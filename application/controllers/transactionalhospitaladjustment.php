<?php
	Class transactionalhospitaladjustment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalhospitaladjustment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalhospitaladjustment']		= $this->transactionalhospitaladjustment_model->get_list();
			$data['main_view']['content']	= 'transactionalhospitaladjustment/listtransactionalhospitaladjustment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function listhospitalcoverage(){
			$data['main_view']['hospitalcoverage']		= $this->transactionalhospitaladjustment_model->get_listhospitalcoverage($this->session->userdata("employee_id"));
			$data['main_view']['content']		= 'transactionalhospitaladjustment/listtransactionalhospitalcoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalhospitaladjustment/addtransactionalhospitaladjustment_view';
			// $data['main_view']['employee']		= create_double($this->transactionalhospitaladjustment_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['employee']		= $this->transactionalhospitaladjustment_model->getemployeename($this->session->userdata("employee_id"));
			// $data['main_view']['hospitalcoverage']	= create_double($this->transactionalhospitaladjustment_model->gethospitalcoverage(),'hospital_coverage_id','hospital_coverage_name');
			$data['main_view']['data']		= $this->transactionalhospitaladjustment_model->gethospitalcoverage($this->uri->segment(3));
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddtransactionalhospitaladjustment(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_hospital_coverage_id'	 	=> $this->input->post('employee_hospital_coverage_id',true),
				'hospital_adjustment_date' 			=> tgltodb($this->input->post('hospital_adjustment_date',true)),
				'hospital_adjustment_amount'			=> $this->input->post('hospital_adjustment_amount',true),
				'hospital_adjustment_remark' 		=> $this->input->post('hospital_adjustment_remark',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			// print_r($data);exit;
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_hospital_coverage_id', 'Hospital Coverage name', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalhospitaladjustment_model->saveNewtransactionalhospitaladjustment($data)){
					$hospital_coverage_amount = $data[hospital_adjustment_amount]-$this->input->post('hospital_coverage_amount',true);
					// print_r($hospital_coverage_amount);exit;
					$this->transactionalhospitaladjustment_model->updatedata($data[employee_hospital_coverage_id],$hospital_coverage_amount);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalhospitaladjustment.processAddtransactionalhospitaladjustment',$auth['username'],'Add New Transactional Hospital Adjustment');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Hospital Adjustment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtransactionalhospitaladjustment');
					redirect('transactionalhospitaladjustment/listhospitalcoverage');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Hospital Adjustment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalhospitaladjustment/Add/'.$data[employee_hospital_coverage_id]);
				}
			}else{
				$this->session->set_userdata('Addtransactionalhospitaladjustment',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalhospitaladjustment/Add/'.$data[employee_hospital_coverage_id]);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalhospitaladjustment_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalhospitaladjustment/edittransactionalhospitaladjustment_view';
			$data['main_view']['employee']		= create_double($this->transactionalhospitaladjustment_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['hospitalcoverage']		= create_double($this->transactionalhospitaladjustment_model->gethospitalcoverage(),'hospital_coverage_id','hospital_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalhospitaladjustment(){
			
			$data = array(
				'hospital_adjustment_id' 					=> $this->input->post('hospital_adjustment_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'hospital_coverage_id'	 			=> $this->input->post('hospital_coverage_id',true),
				'hospital_adjustment_date' 				=> $this->input->post('hospital_adjustment_date',true),
				'hospital_adjustment_amount'			 	=> $this->input->post('hospital_adjustment_amount',true),
				'hospital_adjustment_remark' 				=> $this->input->post('hospital_adjustment_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('hospital_coverage_id', 'Hospital Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalhospitaladjustment_model->saveEdittransactionalhospitaladjustment($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalhospitaladjustment.Edit',$auth['username'],'Edit Transactional Hospital Adjustment');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['hospital_adjustment_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Hospital Adjustment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalhospitaladjustment/Edit/'.$data['hospital_adjustment_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Hospital Adjustment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalhospitaladjustment/Edit/'.$data['hospital_adjustment_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalhospitaladjustment/Edit/'.$data['hospital_adjustment_id']);
			}
		}
		
		function delete(){
			if($this->transactionalhospitaladjustment_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalhospitaladjustment.delete',$auth['username'],'Delete transactionalhospitaladjustment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Hospital Adjustment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalhospitaladjustment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Hospital Adjustment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalhospitaladjustment');
			}
		}
	}
?>