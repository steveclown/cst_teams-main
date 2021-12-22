<?php
	Class CoreInsurancePremi extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreInsurancePremi_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreInsurancePremi']		= $this->CoreInsurancePremi_model->getCoreInsurancePremi();
			$data['main_view']['content']					= 'CoreInsurancePremi/listCoreInsurancePremi_view';
			$this->load->view('mainpage_view',$data);
		}

		function addCoreInsurancePremi(){
			$data['main_view']['content']			= 'CoreInsurancePremi/formaddCoreInsurancePremi_view';
			$data['main_view']['coreinsurance']		= create_double($this->CoreInsurancePremi_model->getCoreInsurance(),'insurance_id','insurance_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreInsurancePremi(){
			$data = array(
				'insurance_premi_code' 			=> $this->input->post('insurance_premi_code',true),
				'insurance_premi_amount' 		=> $this->input->post('insurance_premi_amount',true),
				'insurance_premi_remark' 		=> $this->input->post('insurance_premi_remark',true),
				'insurance_id' 					=> $this->input->post('insurance_id',true),
				'data_state'					=> 0
			);
			$this->form_validation->set_rules('insurance_premi_code', 'Insurance Premi Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('insurance_id', 'Insurance ID', 'required');
			$this->form_validation->set_rules('insurance_premi_amount', 'Insurance Premi Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreInsurancePremi_model->saveNewCoreInsurancePremi($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreInsurancePremi.processAddCoreInsurancePremi',$auth['username'],'Add New CoreInsurancePremi');
					$msg = "<div class='alert alert-success'>                
								Add Data Insurance Premi Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddInsurancePremi');
					redirect('CoreInsurancePremi/addCoreInsurancePremi');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Insurance Premi UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddInsurancePremi',$data);
					redirect('CoreInsurancePremi/addCoreInsurancePremi');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddInsurancePremi',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurancePremi/addCoreInsurancePremi');
			}
		}
		
		function editCoreInsurancePremi(){
			$data['main_view']['CoreInsurancePremi']	= $this->CoreInsurancePremi_model->getCoreInsurancePremi_Detail($this->uri->segment(3));
			$data['main_view']['coreinsurance']			= create_double($this->CoreInsurancePremi_model->getCoreInsurance(),'insurance_id','insurance_name');
			$data['main_view']['content']				= 'CoreInsurancePremi/formeditCoreInsurancePremi_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreInsurancePremi(){
			$data = array(
				'insurance_premi_id' 			=> $this->input->post('insurance_premi_id',true),
				'insurance_premi_code' 			=> $this->input->post('insurance_premi_code',true),
				'insurance_id' 					=> $this->input->post('insurance_id',true),
				'insurance_premi_amount' 		=> $this->input->post('insurance_premi_amount',true),
				'insurance_premi_remark' 		=> $this->input->post('insurance_premi_remark',true),
				'data_state'		=> '0'
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('insurance_premi_code', 'Insurance Premi Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('insurance_id', 'Insurance ID', 'required');
			$this->form_validation->set_rules('insurance_premi_amount', 'Insurance Premi Amount', 'required|numeric');
			if($this->form_validation->run()==true){
				if($this->CoreInsurancePremi_model->saveEditCoreInsurancePremi($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreInsurancePremi.processEditCoreInsurancePremi',$auth['username'],'Edit Insurance Premi');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['insurance_premi_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Insurance Premi Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreInsurancePremi/editCoreInsurancePremi/'.$data['insurance_premi_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Insurance Premi UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreInsurancePremi/editCoreInsurancePremi/'.$data['insurance_premi_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurancePremi/editCoreInsurancePremi/'.$data['insurance_premi_id']);
			}
		}

		function deleteCoreInsurancePremi(){
			if($this->CoreInsurancePremi_model->deleteCoreInsurancePremi($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreInsurancePremi.deleteCoreInsurancePremi',$auth['username'],'Delete CoreInsurancePremi');
				$msg = "<div class='alert alert-success'>                
							Delete Data Insurance Premi Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurancePremi');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Insurance Premi UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurancePremi');
			}
		}
	}
?>