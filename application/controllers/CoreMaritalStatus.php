<?php
	Class CoreMaritalStatus extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreMaritalStatus_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreMaritalStatus']		= $this->CoreMaritalStatus_model->getCoreMaritalStatus();
			$data['Main_view']['content']				= 'CoreMaritalStatus/listCoreMaritalStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreMaritalStatus(){
			$data['Main_view']['content']				= 'CoreMaritalStatus/formaddCoreMaritalStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreMaritalStatus(){
			$data = array(
				'marital_status_code' 		=> $this->input->post('marital_status_code',true),
				'marital_status_name' 		=> $this->input->post('marital_status_name',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('marital_status_code', 'Marital Status Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('marital_status_name', 'Marital Status Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreMaritalStatus_model->saveNewCoreMaritalStatus($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.MaritalStatus.processAddCoreMaritalStatus',$auth['username'],'Add New Marital Status');
					$msg = "<div class='alert alert-success'>                
								Add Data Marital Status Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddCoreMaritalStatus');
					redirect('CoreMaritalStatus/addCoreMaritalStatus');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Marital Status UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddMaritalStatus',$data);
					redirect('CoreMaritalStatus/addCoreMaritalStatus');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddMaritalStatus',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreMaritalStatus/addCoreMaritalStatus');
			}
		}
		
		function editCoreMaritalStatus(){
			$data['Main_view']['CoreMaritalStatus']		= $this->CoreMaritalStatus_model->getCoreMaritalStatus_Detail($this->uri->segment(3));
			$data['Main_view']['content']				= 'CoreMaritalStatus/formeditCoreMaritalStatus_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreMaritalStatus(){
			$data = array(
				'marital_status_id' 		=> $this->input->post('marital_status_id',true),
				'marital_status_code' 		=> $this->input->post('marital_status_code',true),
				'marital_status_name' 		=> $this->input->post('marital_status_name',true),
				'data_state'				=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('marital_status_code', 'Marital Status Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('marital_status_name', 'Marital Status Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreMaritalStatus_model->saveEditCoreMaritalStatus($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.MaritalStatus.Edit',$auth['username'],'Edit Marital Status');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['marital_status_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Marital Status Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreMaritalStatus/editCoreMaritalStatus/'.$data['marital_status_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreMaritalStatus/editCoreMaritalStatus/'.$data['marital_status_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreMaritalStatus/editCoreMaritalStatus'.$data['marital_status_id']);
			}
		}
		
		function deleteCoreMaritalStatus(){
			if($this->CoreMaritalStatus_model->deleteCoreMaritalStatus($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.MaritalStatus.delete',$auth['username'],'Delete Marital Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Marital Status Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreMaritalStatus');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Marital Status UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreMaritalStatus');
			}
		}
	}
?>