<?php
	Class transactionalglassesadjustment extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalglassesadjustment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalglassesadjustment']		= $this->transactionalglassesadjustment_model->get_list();
			$data['main_view']['content']	= 'transactionalglassesadjustment/listtransactionalglassesadjustment_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function listglassescoverage(){
			$data['main_view']['glassescoverage']		= $this->transactionalglassesadjustment_model->get_listglassescoverage($this->session->userdata("employee_id"));
			$data['main_view']['content']		= 'transactionalglassesadjustment/listtransactionalglassescoverage_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']		= 'transactionalglassesadjustment/addtransactionalglassesadjustment_view';
			// $data['main_view']['employee']		= create_double($this->transactionalglassesadjustment_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['employee']		= $this->transactionalglassesadjustment_model->getemployeename($this->session->userdata("employee_id"));
			// $data['main_view']['glassescoverage']	= create_double($this->transactionalglassesadjustment_model->getglassescoverage(),'glasses_coverage_id','glasses_coverage_name');
			$data['main_view']['data']		= $this->transactionalglassesadjustment_model->getglassescoverage($this->uri->segment(3));
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddtransactionalglassesadjustment(){
			$auth = $this->session->userdata('auth');
			$data = array(
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_glasses_coverage_id'	 	=> $this->input->post('employee_glasses_coverage_id',true),
				'glasses_adjustment_date' 			=> tgltodb($this->input->post('glasses_adjustment_date',true)),
				'glasses_adjustment_amount'			=> $this->input->post('glasses_adjustment_amount',true),
				'glasses_adjustment_remark' 		=> $this->input->post('glasses_adjustment_remark',true),
				'data_state'						=> '0',
				'created_by'						=> $auth['username'],
				'created_on'						=> date("Y-m-d H:i:s")
			);
			// print_r($data);exit;
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_glasses_coverage_id', 'Glasses Coverage name', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalglassesadjustment_model->saveNewtransactionalglassesadjustment($data)){
					$glasses_coverage_amount = $data[glasses_adjustment_amount]-$this->input->post('glasses_coverage_amount',true);
					// print_r($glasses_coverage_amount);exit;
					$this->transactionalglassesadjustment_model->updatedata($data[employee_glasses_coverage_id],$glasses_coverage_amount);
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.transactionalglassesadjustment.processAddtransactionalglassesadjustment',$auth['username'],'Add New Transactional Glasses Adjustment');
					$msg = "<div class='alert alert-success'>                
								Add Data Transactional Glasses Adjustment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtransactionalglassesadjustment');
					redirect('transactionalglassesadjustment/listglassescoverage');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Transactional Glasses Adjustment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalglassesadjustment/Add/'.$data[employee_glasses_coverage_id]);
				}
			}else{
				$this->session->set_userdata('Addtransactionalglassesadjustment',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalglassesadjustment/Add/'.$data[employee_glasses_coverage_id]);
			}
		}
		
		function Edit(){
			$data['main_view']['result']		= $this->transactionalglassesadjustment_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'transactionalglassesadjustment/edittransactionalglassesadjustment_view';
			$data['main_view']['employee']		= create_double($this->transactionalglassesadjustment_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['glassescoverage']		= create_double($this->transactionalglassesadjustment_model->getglassescoverage(),'glasses_coverage_id','glasses_coverage_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdittransactionalglassesadjustment(){
			
			$data = array(
				'glasses_adjustment_id' 					=> $this->input->post('glasses_adjustment_id',true),
				'status' 							=> $this->input->post('status',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'glasses_coverage_id'	 			=> $this->input->post('glasses_coverage_id',true),
				'glasses_adjustment_date' 				=> $this->input->post('glasses_adjustment_date',true),
				'glasses_adjustment_amount'			 	=> $this->input->post('glasses_adjustment_amount',true),
				'glasses_adjustment_remark' 				=> $this->input->post('glasses_adjustment_remark',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('glasses_coverage_id', 'Glasses Coverage Name', 'required');
			if($this->form_validation->run()==true){
				if($this->transactionalglassesadjustment_model->saveEdittransactionalglassesadjustment($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.transactionalglassesadjustment.Edit',$auth['username'],'Edit Transactional Glasses Adjustment');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['glasses_adjustment_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Transactional Glasses Adjustment Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalglassesadjustment/Edit/'.$data['glasses_adjustment_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Transactional Glasses Adjustment UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalglassesadjustment/Edit/'.$data['glasses_adjustment_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('transactionalglassesadjustment/Edit/'.$data['glasses_adjustment_id']);
			}
		}
		
		function delete(){
			if($this->transactionalglassesadjustment_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.transactionalglassesadjustment.delete',$auth['username'],'Delete transactionalglassesadjustment');
				$msg = "<div class='alert alert-success'>                
							Delete Data Transactional Glasses Adjustment Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalglassesadjustment');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Transactional Glasses Adjustment UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalglassesadjustment');
			}
		}
	}
?>