<?php
	Class religion extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('religion_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['religion']		= $this->religion_model->get_list();
			$data['main_view']['content']		= 'religion/listreligion_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']	= 'religion/formaddreligion_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddreligion(){
			$data = array(
				'religion_code' 		=> $this->input->post('religion_code',true),
				'religion_name' 		=> $this->input->post('religion_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('religion_code', 'Religion Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('religion_name', 'Religion Name', 'required');
			if($this->form_validation->run()==true){
				if($this->religion_model->savenewreligion($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.religion.processaddreligion',$auth['username'],'Add New Religion');
					$msg = "<div class='alert alert-success'>                
								Add Data Religion Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addreligion');
					redirect('religion/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Religion UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addreligion',$data);
					redirect('religion/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addreligion',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('religion/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->religion_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'religion/formeditreligion_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditreligion(){
			
			$data = array(
				'religion_id' 		=> $this->input->post('religion_id',true),
				'religion_code' 	=> $this->input->post('religion_code',true),
				'religion_name' 	=> $this->input->post('religion_name',true),
				'data_state'		=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('religion_code', 'Religion Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('religion_name', 'Religion Name', 'required');
			if($this->form_validation->run()==true){
				if($this->religion_model->saveeditreligion($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.religion.Edit',$auth['username'],'Edit Applicant Status');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['religion_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Religion Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('religion/Edit/'.$data['religion_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Religion UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('religion/Edit/'.$data['religion_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('religion/Edit/'.$data['religion_id']);
			}
		}
		
		function delete(){
			if($this->religion_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.religion.delete',$auth['username'],'Delete Applicant Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Religion Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('religion');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Religion UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('religion');
			}
		}
	}
?>