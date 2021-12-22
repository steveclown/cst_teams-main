<?php
	Class CoreSeparationReason extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreSeparationReason_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreSeparationReason']		= $this->CoreSeparationReason_model->getCoreSeparationReason();
			$data['Main_view']['content']					= 'CoreSeparationReason/listCoreSeparationReason_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreSeparationReason(){
			$data['Main_view']['content']					= 'CoreSeparationReason/formaddCoreSeparationReason_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSeparationReason-'.$unique['unique']);			
			redirect('CoreSeparationReason/addCoreSeparationReason');
		}
		
		function processAddCoreSeparationReason(){
			$data = array(
				'separation_reason_name' 		=> $this->input->post('separation_reason_name',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('separation_reason_name', 'Separation Reason Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreSeparationReason_model->saveNewCoreSeparationReason($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreSeparationReason.processAddCoreSeparationReason',$auth['username'],'Add New SeparationReason');
					$msg = "<div class='alert alert-success'>                
								Add Data SeparationReason Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreSeparationReason');
					redirect('CoreSeparationReason/addCoreSeparationReason');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data SeparationReason UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreSeparationReason',$data);
					redirect('CoreSeparationReason/addCoreSeparationReason');
				}
			}else{
				$this->session->set_userdata('addCoreSeparationReason',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreSeparationReason/addCoreSeparationReason');
			}
		}

		public function reset_edit(){
			$separation_reason_id = $this->uri->segment(3);
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSeparationReason-'.$unique['unique']);			
			redirect('CoreSeparationReason/editCoreSeparationReason/'.$separation_reason_id);
		}

		function editCoreSeparationReason(){
			$data['Main_view']['CoreSeparationReason']		= $this->CoreSeparationReason_model->getCoreSeparationReason_Detail($this->uri->segment(3));
			$data['Main_view']['content']					= 'CoreSeparationReason/formeditCoreSeparationReason_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreSeparationReason(){
			$data = array(
				'separation_reason_id' 			=> $this->input->post('separation_reason_id',true),
				'separation_reason_name' 		=> $this->input->post('separation_reason_name',true),
				'data_state'					=> 0
			);
			$this->form_validation->set_rules('separation_reason_name', 'Separation Reason Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreSeparationReason_model->saveEditCoreSeparationReason($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreSeparationReason.edit',$auth['username'],'Edit SeparationReason');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreSeparationReason_id']);
					$msg = "<div class='alert alert-success'>                
								Edit SeparationReason Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSeparationReason/editCoreSeparationReason/'.$data['separation_reason_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit SeparationReason UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSeparationReason/editCoreSeparationReason/'.$data['separation_reason_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreSeparationReason/editCoreSeparationReason/'.$data['separation_reason_id']);
			}
		}
		
		function deleteCoreSeparationReason(){
			if($this->CoreSeparationReason_model->deleteCoreSeparationReason($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreSeparationReason.delete',$auth['username'],'Delete CoreSeparationReason');
				$msg = "<div class='alert alert-success'>                
							Delete SeparationReason Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreSeparationReason');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete SeparationReason Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreSeparationReason');
			}
		}
	}
?>