<?php
	Class CoreGrade extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreGrade_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreGrade']		= $this->CoreGrade_model->getCoreGrade();
			$data['Main_view']['content']		= 'CoreGrade/listCoreGrade_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreGrade(){
			$data['Main_view']['content']		= 'CoreGrade/formaddCoreGrade_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreGrade(){
			$data = array(
				'grade_code' 		=> $this->input->post('grade_code',true),
				'grade_name' 		=> $this->input->post('grade_name',true),
				'grade_remark' 		=> $this->input->post('grade_remark',true),
				'data_state'		=> 0
			);
			
			$this->form_validation->set_rules('grade_code', 'Grade Code', 'required');
			$this->form_validation->set_rules('grade_name', 'Grade Name', 'required');
			$this->form_validation->set_rules('grade_remark', 'Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreGrade_model->saveNewCoreGrade($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreGrade.processaddCoreGrade',$auth['username'],'Add new CoreGrade');
					$msg = "<div class='alert alert-success'>                
								Add Data Grade Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreGrade');
					redirect('CoreGrade/addCoreGrade');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Grade UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreGrade',$data);
					redirect('CoreGrade/addCoreGrade');
				}
			}else{
				$this->session->set_userdata('addCoreGrade',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreGrade/addCoreGrade');
			}
		}
		
		function editCoreGrade(){
			$data['Main_view']['CoreGrade']	= $this->CoreGrade_model->getCoreGrade_Detail($this->uri->segment(3));
			$data['Main_view']['content']	= 'CoreGrade/formeditCoreGrade_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreGrade(){
			$data = array(
				'grade_id' 			=> $this->input->post('grade_id',true),
				'grade_code' 		=> $this->input->post('grade_code',true),
				'grade_name' 		=> $this->input->post('grade_name',true),
				'grade_remark' 		=> $this->input->post('grade_remark',true),
				'data_state'		=> 0
			);
			$this->form_validation->set_rules('grade_code', 'Grade Code', 'required');
			$this->form_validation->set_rules('grade_name', 'Grade Name', 'required');
			$this->form_validation->set_rules('grade_remark', 'Remark', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreGrade_model->saveEditCoreGrade($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreGrade.edit',$auth['username'],'Edit CoreGrade');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreGrade_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Grade Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreGrade/editCoreGrade/'.$data['grade_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Grade UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreGrade/editCoreGrade/'.$data['grade_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreGrade/editCoreGrade/'.$data['grade_id']);
			}
		}
		
		function deleteCoreGrade(){
			if($this->CoreGrade_model->deleteCoreGrade($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreGrade.delete',$auth['username'],'Delete CoreGrade');
				$msg = "<div class='alert alert-success'>                
							Delete Grade Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreGrade');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Grade Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreGrade');
			}
		}
	}
?>