<?php
	Class nationality extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('nationality_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['nationality']		= $this->nationality_model->get_list();
			$data['main_view']['content']			= 'nationality/listnationality_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']	= 'nationality/formaddnationality_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddnationality(){
			$data = array(
				'nationality_code' 		=> $this->input->post('nationality_code',true),
				'nationality_name' 		=> $this->input->post('nationality_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('nationality_code', 'Nationality Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('nationality_name', 'Nationality Name', 'required');
			if($this->form_validation->run()==true){
				if($this->nationality_model->savenewnationality($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.nationality.processaddnationality',$auth['username'],'Add New Nationality');
					$msg = "<div class='alert alert-success'>                
								Add Data Nationality Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addnationality');
					redirect('nationality/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Nationality UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addnationality',$data);
					redirect('nationality/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addnationality',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('nationality/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->nationality_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'nationality/formeditnationality_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditnationality(){
			
			$data = array(
				'nationality_id' 		=> $this->input->post('nationality_id',true),
				'nationality_code' 		=> $this->input->post('nationality_code',true),
				'nationality_name' 		=> $this->input->post('nationality_name',true),
				'data_state'			=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('nationality_code', 'Nationality Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('nationality_name', 'Nationality Name', 'required');
			if($this->form_validation->run()==true){
				if($this->nationality_model->saveeditnationality($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.nationality.Edit',$auth['username'],'Edit Applicant Status');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['nationality_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Nationality Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('nationality/Edit/'.$data['nationality_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Nationality UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('nationality/Edit/'.$data['nationality_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('nationality/Edit/'.$data['nationality_id']);
			}
		}
		
		function delete(){
			if($this->nationality_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.nationality.delete',$auth['username'],'Delete Applicant Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Nationality Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('nationality');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Nationality UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('nationality');
			}
		}
	}
?>