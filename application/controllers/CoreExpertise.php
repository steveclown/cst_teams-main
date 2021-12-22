<?php
	Class CoreExpertise extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreExpertise_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreExpertise']		= $this->CoreExpertise_model->getCoreExpertise();
			$data['Main_view']['content']			= 'CoreExpertise/listCoreExpertise_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreExpertise(){
			$data['Main_view']['content']			= 'CoreExpertise/formaddCoreExpertise_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreExpertise(){
			$data = array(
				'expertise_code' 		=> $this->input->post('expertise_code',true),
				'expertise_name' 		=> $this->input->post('expertise_name',true),
				'expertise_remark' 		=> $this->input->post('expertise_remark',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('expertise_code', 'Expertise Code', 'required');
			$this->form_validation->set_rules('expertise_name', 'Expertise Name', 'required');
			$this->form_validation->set_rules('expertise_name', 'Expertise Type', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreExpertise_model->saveNewCoreExpertise($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreExpertise.processAddlanguage',$auth['username'],'Add New CoreExpertise');
					$msg = "<div class='alert alert-success'>                
								Add Data Expertise Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreExpertise');
					redirect('CoreExpertise/addCoreExpertise');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Expertise UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreExpertise/addCoreExpertise');
				}
			}else{
				$this->session->set_userdata('addCoreExpertise',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreExpertise/addCoreExpertise');
			}
		}
		
		function editCoreExpertise(){
			$data['Main_view']['CoreExpertise']		= $this->CoreExpertise_model->getCoreExpertise_Detail($this->uri->segment(3));
			$data['Main_view']['content']			= 'CoreExpertise/formeditCoreExpertise_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreExpertise(){
			$data = array(
				'expertise_id' 			=> $this->input->post('expertise_id',true),
				'expertise_code' 		=> $this->input->post('expertise_code',true),
				'expertise_name' 		=> $this->input->post('expertise_name',true),
				'expertise_remark' 		=> $this->input->post('expertise_remark',true),
				'data_state'		=> '0'
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('expertise_code', 'Expertise Code', 'required');
			$this->form_validation->set_rules('expertise_name', 'Expertise Name', 'required');
			$this->form_validation->set_rules('expertise_name', 'Expertise Type', 'required');
;
			if($this->form_validation->run()==true){
				if($this->CoreExpertise_model->saveEditCoreExpertise($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreExpertise.Edit',$auth['username'],'Edit CoreExpertise');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreExpertise_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Expertise Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreExpertise/editCoreExpertise/'.$data['expertise_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Expertise UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreExpertise/editCoreExpertise/'.$data['expertise_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreExpertise/editCoreExpertise/'.$data['expertise_id']);
			}
		}
		
				
		function deleteCoreExpertise(){
			if($this->CoreExpertise_model->deleteCoreExpertise($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreExpertise.delete',$auth['username'],'Delete CoreExpertise');
				$msg = "<div class='alert alert-success'>                
							Delete Data Expertise Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreExpertise');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Expertise UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreExpertise');
			}
		}
	}
?>