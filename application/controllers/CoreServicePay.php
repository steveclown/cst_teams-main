<?php
	Class CoreServicePay extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreServicePay_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreServicePay']		= $this->CoreServicePay_model->getCoreServicePay();
			$data['main_view']['content']				= 'CoreServicePay/listCoreServicePay_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreServicePay(){
			$data['main_view']['content']				= 'CoreServicePay/formaddCoreServicePay_view';
			$data['main_view']['servicepaytype']		= $this->configuration->ServicePayType();
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreServicePay(){
			$data = array(
				'service_pay_code' 		=> $this->input->post('service_pay_code',true),
				'service_pay_name' 		=> $this->input->post('service_pay_name',true),
				'service_pay_range1' 	=> $this->input->post('service_pay_range1',true),
				'service_pay_range2' 	=> $this->input->post('service_pay_range2',true),
				'service_pay_ratio' 	=> $this->input->post('service_pay_ratio',true),
				'service_pay_type' 		=> $this->input->post('service_pay_type',true),
				'service_pay_remark' 	=> $this->input->post('service_pay_remark',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('service_pay_code', 'Service Pay Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('service_pay_name', 'Service Pay Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('service_pay_range1', 'Service Pay Range 1', 'required|numeric');
			$this->form_validation->set_rules('service_pay_range2', 'Service Pay Range 2', 'required|numeric');
			$this->form_validation->set_rules('service_pay_ratio', 'Service Pay Ratio', 'required|numeric');
			$this->form_validation->set_rules('service_pay_type', 'Service Pay Type', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreServicePay_model->saveNewCoreServicePay($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreServicePay.processaddCoreServicePay',$auth['username'],'Add New Service Pay');
					$msg = "<div class='alert alert-success'>                
								Add Data Service Pay Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreServicePay');
					redirect('CoreServicePay/addCoreServicePay');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Service Pay UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreServicePay',$data);
					redirect('CoreServicePay/addCoreServicePay');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreServicePay',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreServicePay/addCoreServicePay');
			}
		}
		
		function editCoreServicePay(){
			$data['main_view']['CoreServicePay']		= $this->CoreServicePay_model->getCoreServicePay_Detail($this->uri->segment(3));
			$data['main_view']['servicepaytype']		= $this->configuration->ServicePayType();
			$data['main_view']['content']				= 'CoreServicePay/formeditCoreServicePay_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreServicePay(){
			
			$data = array(
				'service_pay_id' 			=> $this->input->post('service_pay_id',true),
				'service_pay_code' 			=> $this->input->post('service_pay_code',true),
				'service_pay_name' 			=> $this->input->post('service_pay_name',true),
				'service_pay_range1' 		=> $this->input->post('service_pay_range1',true),
				'service_pay_range2' 		=> $this->input->post('service_pay_range2',true),
				'service_pay_ratio' 		=> $this->input->post('service_pay_ratio',true),
				'service_pay_type' 			=> $this->input->post('service_pay_type',true),
				'service_pay_remark' 		=> $this->input->post('service_pay_remark',true),
				'data_state'				=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('service_pay_code', 'Service Pay Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('service_pay_name', 'Service Pay Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('service_pay_range1', 'Service Pay Range 1', 'required|numeric');
			$this->form_validation->set_rules('service_pay_range2', 'Service Pay Range 2', 'required|numeric');
			$this->form_validation->set_rules('service_pay_ratio', 'Service Pay Ratio', 'required|numeric');
			$this->form_validation->set_rules('service_pay_type', 'Service Pay Type', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->CoreServicePay_model->saveEditCoreServicePay($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreServicePay.Edit',$auth['username'],'Edit Service Pay');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['service_pay_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Service Pay Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreServicePay/editCoreServicePay/'.$data['service_pay_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreServicePay/editCoreServicePay/'.$data['service_pay_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreServicePay/editCoreServicePay/'.$data['service_pay_id']);
			}
		}
		
				
		function deleteCoreServicePay(){
			if($this->CoreServicePay_model->deleteCoreServicePay($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreServicePay.delete',$auth['username'],'Delete Service Pay');
				$msg = "<div class='alert alert-success'>                
							Delete Data Service Pay Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreServicePay');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Service Pay UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreServicePay');
			}
		}
	}
?>