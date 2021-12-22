<?php
	Class CoreProbation extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreProbation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreProbation']		= $this->CoreProbation_model->getCoreProbation();
			$data['main_view']['content']			= 'CoreProbation/listCoreProbation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreProbation(){
			$data['main_view']['content']		= 'CoreProbation/formaddCoreProbation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreProbation(){
			$data = array(
				'probation_code' 		=> $this->input->post('probation_code',true),
				'probation_name' 		=> $this->input->post('probation_name',true),
				'probation_remark' 		=> $this->input->post('probation_remark',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('probation_code', 'Probation Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('probation_name', 'Probation Name', 'required');
			$this->form_validation->set_rules('probation_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->CoreProbation_model->saveNewCoreProbation($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreProbation.processAddCoreProbation',$auth['username'],'Add New Probation');
					$msg = "<div class='alert alert-success'>                
								Add Data Probation Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreProbation');
					redirect('CoreProbation/addCoreProbation');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Probation UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreProbation',$data);
					redirect('CoreProbation/addCoreProbation');
				}
			}else{
				$this->session->set_userdata('addCoreProbation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreProbation/addCoreProbation');
			}
		}
		
		function editCoreProbation(){
			$data['main_view']['CoreProbation']		= $this->CoreProbation_model->getCoreProbation_Detail($this->uri->segment(3));
			$data['main_view']['content']			= 'CoreProbation/formeditCoreProbation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreProbation(){
			$data = array(
				'probation_id' 			=> $this->input->post('probation_id',true),
				'probation_code' 		=> $this->input->post('probation_code',true),
				'probation_name' 		=> $this->input->post('probation_name',true),
				'probation_remark' 		=> $this->input->post('probation_remark',true),
				'data_state'			=> 0
			);
			$this->form_validation->set_rules('probation_code', 'Probation Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('probation_name', 'Probation Name', 'required');
			$this->form_validation->set_rules('probation_remark', 'Remark', 'filterspecialchar');
			if($this->form_validation->run()==true){
				if($this->CoreProbation_model->saveEditCoreProbation($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreProbation.edit',$auth['username'],'Edit Probation');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreProbation_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Probation Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreProbation/editCoreProbation/'.$data['probation_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Probation UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreProbation/editCoreProbation/'.$data['probation_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreProbation/editCoreProbation/'.$data['probation_id']);
			}
		}
		
		function deleteCoreProbation(){
			if($this->CoreProbation_model->deleteCoreProbation($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreProbation.delete',$auth['username'],'Delete CoreProbation');
				$msg = "<div class='alert alert-success'>                
							Delete Probation Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreProbation');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Probation Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreProbation');
			}
		}
	}
?>