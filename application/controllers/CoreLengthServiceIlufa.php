<?php
	Class CoreLengthServiceIlufa extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreLengthServiceIlufa_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['corelengthservice']		= $this->CoreLengthServiceIlufa_model->getCoreLengthService();
			$data['main_view']['content']				= 'CoreLengthServiceIlufa/listCoreLengthServiceIlufa_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreLengthService(){
			$data['main_view']['content']				= 'CoreLengthServiceIlufa/formaddCoreLengthServiceIlufa_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddCoreLengthService(){
			$data = array(	
				'length_service_code' 				=> $this->input->post('length_service_code',true),
				'length_service_name' 				=> $this->input->post('length_service_name',true),
				'length_service_range1' 			=> $this->input->post('length_service_range1',true),
				'length_service_range2' 			=> $this->input->post('length_service_range2',true),
				'length_service_amount' 			=> $this->input->post('length_service_amount',true),
				'length_service_amount_multiply' 	=> $this->input->post('length_service_amount_multiply',true),
				'length_service_min_saving' 		=> $this->input->post('length_service_min_saving',true),
				'length_service_remark' 			=> $this->input->post('length_service_remark',true),
				'data_state'						=> 0
			);
			
			$this->form_validation->set_rules('length_service_code', 'Length Service Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('length_service_name', 'Length Service Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('length_service_range1', 'Length Service Range 1', 'required|numeric');
			$this->form_validation->set_rules('length_service_range2', 'Length Service Range 2', 'required|numeric');
			$this->form_validation->set_rules('length_service_amount', 'Length Service Amount', 'required|numeric');
			$this->form_validation->set_rules('length_service_amount_multiply', 'Length Service Amount Multiply', 'required|numeric');
			$this->form_validation->set_rules('length_service_min_saving', 'Length Service Min Saving', 'required|numeric');
			
			if($this->form_validation->run()==true){
				if($this->CoreLengthServiceIlufa_model->saveNewCoreLengthService($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreLengthService.processaddcorelengthservice',$auth['username'],'Add New Length Service');
					$msg = "<div class='alert alert-success'>                
								Add Data Length Service Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addcorelengthservice');
					redirect('CoreLengthServiceIlufa/addCoreLengthService');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Length Service UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addcorelengthservice',$data);
					redirect('CoreLengthServiceIlufa/addCoreLengthService');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addcorelengthservice',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthServiceIlufa/addCoreLengthService');
			}
		}
		
		public function editCoreLengthService(){
			$data['main_view']['corelengthservice']		= $this->CoreLengthServiceIlufa_model->getCoreLengthService_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CoreLengthServiceIlufa/formeditCoreLengthServiceIlufa_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreLengthService(){
			
			$data = array(
				'length_service_id' 				=> $this->input->post('length_service_id',true),
				'length_service_code' 				=> $this->input->post('length_service_code',true),
				'length_service_name' 				=> $this->input->post('length_service_name',true),
				'length_service_range1' 			=> $this->input->post('length_service_range1',true),
				'length_service_range2' 			=> $this->input->post('length_service_range2',true),
				'length_service_amount' 			=> $this->input->post('length_service_amount',true),
				'length_service_amount_multiply' 	=> $this->input->post('length_service_amount_multiply',true),
				'length_service_min_saving' 		=> $this->input->post('length_service_min_saving',true),
				'length_service_remark' 			=> $this->input->post('length_service_remark',true),
				'data_state'						=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			
			$this->form_validation->set_rules('length_service_code', 'Length Service Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('length_service_name', 'Length Service Name', 'required|filterspecialchar');
			$this->form_validation->set_rules('length_service_range1', 'Length Service Range 1', 'required|numeric');
			$this->form_validation->set_rules('length_service_range2', 'Length Service Range 2', 'required|numeric');
			$this->form_validation->set_rules('length_service_amount', 'Length Service Amount', 'required|numeric');
			$this->form_validation->set_rules('length_service_amount_multiply', 'Length Service Amount Multiply', 'required|numeric');
			$this->form_validation->set_rules('length_service_min_saving', 'Length Service Min Saving', 'required|numeric');
			$this->form_validation->set_rules('length_service_remark', 'Length Service Remark', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->CoreLengthServiceIlufa_model->saveEditCoreLengthService($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreLengthService.Edit',$auth['username'],'Edit Length Service');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['length_service_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Length Service Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLengthServiceIlufa/editCoreLengthService/'.$data['length_service_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreLengthServiceIlufa/editCoreLengthService/'.$data['length_service_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthServiceIlufa/editCoreLengthService/'.$data['length_service_id']);
			}
		}
		
		public function deleteCoreLengthService(){
			if($this->CoreLengthServiceIlufa_model->deleteCoreLengthService($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreLengthService.delete',$auth['username'],'Delete Length Service');
				$msg = "<div class='alert alert-success'>                
							Delete Data Length Service Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthServiceIlufa');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Length Service UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLengthServiceIlufa');
			}
		}
	}
?>