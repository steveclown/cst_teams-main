<?php
	Class CoreLengthService extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreLengthService_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreLengthService']		= $this->CoreLengthService_model->getCoreLengthService();
			$data['Main_view']['content']				= 'CoreLengthService/listCoreLengthService_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreLengthService(){
			$data['Main_view']['content']				= 'CoreLengthService/formaddCoreLengthService_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreLengthService(){
			$data = array(
				'length_service_code' 		=> $this->input->post('length_service_code',true),
				'length_service_name' 		=> $this->input->post('length_service_name',true),
				'length_service_range1' 	=> $this->input->post('length_service_range1',true),
				'length_service_range2' 	=> $this->input->post('length_service_range2',true),
				'length_service_amount' 	=> $this->input->post('length_service_amount',true),
				'length_service_remark' 	=> $this->input->post('length_service_remark',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('length_service_code', 'Length Service Code', 'required');
			$this->form_validation->set_rules('length_service_name', 'Length Service Name', 'required');
			$this->form_validation->set_rules('length_service_range1', 'Length Service Range 1', 'required|numeric');
			$this->form_validation->set_rules('length_service_range2', 'Length Service Range 2', 'required|numeric');
			$this->form_validation->set_rules('length_service_amount', 'Length Service Amount', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreLengthService_model->saveNewCoreLengthService($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreLengthService.processaddCoreLengthService',$auth['username'],'Add New Length Service');
					$msg = "<div class='alert alert-success'>                
								Add Data Length Service Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreLengthService');
					redirect('CoreLengthService/addCoreLengthService');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Length Service UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreLengthService',$data);
					redirect('CoreLengthService/addCoreLengthService');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreLengthService',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthService/addCoreLengthService');
			}
		}
		
		function editCoreLengthService(){
			$data['Main_view']['CoreLengthService']		= $this->CoreLengthService_model->getCoreLengthService_Detail($this->uri->segment(3));
			$data['Main_view']['content']				= 'CoreLengthService/formeditCoreLengthService_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreLengthService(){
			
			$data = array(
				'length_service_id' 			=> $this->input->post('length_service_id',true),
				'length_service_code' 			=> $this->input->post('length_service_code',true),
				'length_service_name' 			=> $this->input->post('length_service_name',true),
				'length_service_range1' 		=> $this->input->post('length_service_range1',true),
				'length_service_range2' 		=> $this->input->post('length_service_range2',true),
				'length_service_amount' 		=> $this->input->post('length_service_amount',true),
				'length_service_remark' 		=> $this->input->post('length_service_remark',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('length_service_code', 'Length Service Code', 'required');
			$this->form_validation->set_rules('length_service_name', 'Length Service Name', 'required');
			$this->form_validation->set_rules('length_service_range1', 'Length Service Range 1', 'required|numeric');
			$this->form_validation->set_rules('length_service_range2', 'Length Service Range 2', 'required|numeric');
			$this->form_validation->set_rules('length_service_amount', 'Length Service Amount', 'required|numeric');
			$this->form_validation->set_rules('length_service_remark', 'Length Service Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreLengthService_model->saveEditCoreLengthService($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreLengthService.Edit',$auth['username'],'Edit Length Service');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['length_service_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Length Service Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLengthService/editCoreLengthService/'.$data['length_service_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreLengthService/editCoreLengthService/'.$data['length_service_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthService/editCoreLengthService/'.$data['length_service_id']);
			}
		}
		
				
		function deleteCoreLengthService(){
			if($this->CoreLengthService_model->deleteCoreLengthService($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreLengthService.delete',$auth['username'],'Delete Length Service');
				$msg = "<div class='alert alert-success'>                
							Delete Data Length Service Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthService');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Length Service UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthService');
			}
		}
	}
?>