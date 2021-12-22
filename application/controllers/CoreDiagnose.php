<?php
	Class CoreDiagnose extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreDiagnose_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreDiagnose']		= $this->CoreDiagnose_model->getCoreDiagnose();
			$data['main_view']['content']			= 'CoreDiagnose/listCoreDiagnose_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreDiagnose(){
			$data['main_view']['content']			= 'CoreDiagnose/formaddCoreDiagnose_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreDiagnose(){
			$data = array(
				'diagnose_code' 		=> $this->input->post('diagnose_code',true),
				'diagnose_name' 		=> $this->input->post('diagnose_name',true),
				'diagnose_remark' 		=> $this->input->post('diagnose_remark',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('diagnose_code', 'Diagnose Code', 'required');
			$this->form_validation->set_rules('diagnose_name', 'Diagnose Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreDiagnose_model->saveNewCoreDiagnose($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreDiagnose.processAddCoreDiagnose',$auth['username'],'Add New Diagnose');
					$msg = "<div class='alert alert-success'>                
								Add Data Diagnose Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddCoreDiagnose');
					redirect('CoreDiagnose/addCoreDiagnose');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Diagnose UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddDiagnose',$data);
					redirect('CoreDiagnose/addCoreDiagnose');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddDiagnose',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreDiagnose/addCoreDiagnose');
			}
		}
		
		function editCoreDiagnose(){
			$data['main_view']['CoreDiagnose']		= $this->CoreDiagnose_model->getCoreDiagnose_Detail($this->uri->segment(3));
			$data['main_view']['content']			= 'CoreDiagnose/formeditCoreDiagnose_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreDiagnose(){
			$data = array(
				'diagnose_id' 		=> $this->input->post('diagnose_id',true),
				'diagnose_code' 	=> $this->input->post('diagnose_code',true),
				'diagnose_name' 	=> $this->input->post('diagnose_name',true),
				'diagnose_remark' 	=> $this->input->post('diagnose_remark',true),
				'data_state'		=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('diagnose_code', 'Diagnose Code', 'required');
			$this->form_validation->set_rules('diagnose_name', 'Diagnose Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreDiagnose_model->saveEditCoreDiagnose($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreDiagnose.processEditCoreDiagnose',$auth['username'],'Edit Diagnose');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreDiagnose_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Diagnose Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreDiagnose/editCoreDiagnose/'.$data['diagnose_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreDiagnose/editCoreDiagnose/'.$data['diagnose_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreDiagnose/editCoreDiagnose/'.$data['diagnose_id']);
			}
		}
		
				
		function deleteCoreDiagnose(){
			if($this->CoreDiagnose_model->deleteCoreDiagnose($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreDiagnose.deleteCoreDiagnose',$auth['username'],'Delete Diagnose');
				$msg = "<div class='alert alert-success'>                
							Delete Data Diagnose Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDiagnose');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Diagnose UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDiagnose');
			}
		}
	}
?>