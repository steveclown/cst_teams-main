<?php
	Class CoreInsurance extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreInsurance_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreInsurance']		= $this->CoreInsurance_model->getCoreInsurance();
			$data['main_view']['content']			= 'CoreInsurance/listCoreInsurance_view';
			$this->load->view('mainpage_view',$data);

		}
		
		function addCoreInsurance(){
			$data['main_view']['content']	= 'CoreInsurance/formaddCoreInsurance_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreInsurance(){
			$data = array(
				'insurance_code' 			=> $this->input->post('insurance_code',true),
				'insurance_name' 			=> $this->input->post('insurance_name',true),
				'insurance_address' 		=> $this->input->post('insurance_address',true),
				'insurance_city' 			=> $this->input->post('insurance_city',true),
				'insurance_home_phone' 		=> $this->input->post('insurance_home_phone',true),
				'insurance_mobile_phone' 	=> $this->input->post('insurance_mobile_phone',true),
				'insurance_contact_person' 	=> $this->input->post('insurance_contact_person',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('insurance_code', 'Insurance Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('insurance_name', 'Insurance Name', 'required');
			$this->form_validation->set_rules('insurance_address', 'Insurance Address', 'required');
			$this->form_validation->set_rules('insurance_city', 'Insurance City', 'required');
			$this->form_validation->set_rules('insurance_home_phone', 'Insurance Home Phone', 'required');
			$this->form_validation->set_rules('insurance_mobile_phone', 'Insurance Mobile Phone', 'required');
			$this->form_validation->set_rules('insurance_contact_person', 'Insurance Contact Person', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreInsurance_model->saveNewCoreInsurance($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreInsurance.processAddCoreInsurance',$auth['username'],'Add New Insurance');
					$msg = "<div class='alert alert-success'>                
								Add Data Insurance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddInsurance');
					redirect('CoreInsurance/addCoreInsurance');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Insurance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddInsurance',$data);
					redirect('CoreInsurance/addCoreInsurance');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddInsurance',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurance/addCoreInsurance');
			}
		}
		
		function editCoreInsurance(){
			$data['main_view']['CoreInsurance']		= $this->CoreInsurance_model->getCoreInsurance_Detail($this->uri->segment(3));
			$data['main_view']['content']			= 'CoreInsurance/formeditCoreInsurance_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreInsurance(){
			$data = array(
				'insurance_id' 					=> $this->input->post('insurance_id',true),
				'insurance_code' 				=> $this->input->post('insurance_code',true),
				'insurance_name' 				=> $this->input->post('insurance_name',true),
				'insurance_address' 			=> $this->input->post('insurance_address',true),
				'insurance_city' 				=> $this->input->post('insurance_city',true),
				'insurance_home_phone' 			=> $this->input->post('insurance_home_phone',true),
				'insurance_mobile_phone' 		=> $this->input->post('insurance_mobile_phone',true),
				'insurance_contact_person' 		=> $this->input->post('insurance_contact_person',true),
				'data_state'					=> 0
			);
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('insurance_code', 'Insurance Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('insurance_name', 'Insurance Name', 'required');
			$this->form_validation->set_rules('insurance_address', 'Insurance Address', 'required');
			$this->form_validation->set_rules('insurance_city', 'Insurance City', 'required');
			$this->form_validation->set_rules('insurance_home_phone', 'Insurance Home Phone', 'required');
			$this->form_validation->set_rules('insurance_mobile_phone', 'Insurance Mobile Phone', 'required');
			$this->form_validation->set_rules('insurance_contact_person', 'Insurance Contact Person', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreInsurance_model->saveEditCoreInsurance($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreInsurance.editCoreInsurance',$auth['username'],'Edit CoreInsurance');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreInsurance_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Insurance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreInsurance/editCoreInsurance/'.$data['insurance_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Insurance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreInsurance/editCoreInsurance/'.$data['insurance_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurance/editCoreInsurance/'.$data['insurance_id']);
			}
		}

		function deleteCoreInsurance(){
			if($this->CoreInsurance_model->deleteCoreInsurance($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreInsurance.deleteCoreInsurance',$auth['username'],'Delete CoreInsurance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Insurance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurance');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Insurance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreInsurance');
			}
		}
	}
?>