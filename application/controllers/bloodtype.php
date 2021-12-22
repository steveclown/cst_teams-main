<?php
	Class bloodtype extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('bloodtype_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['bloodtype']		= $this->bloodtype_model->get_list();
			$data['main_view']['content']		= 'bloodtype/listbloodtype_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']			= 'bloodtype/formaddbloodtype_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddbloodtype(){
			$data = array(
				'blood_type_code' 				=> $this->input->post('blood_type_code',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('blood_type_code', 'Blood Type Code', 'required|alpha_numeric');
			if($this->form_validation->run()==true){
				if($this->bloodtype_model->savenewbloodtype($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.bloodtype.processaddbloodtype',$auth['username'],'Add New Blood Type');
					$msg = "<div class='alert alert-success'>                
								Add Data Blood Type Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addbloodtype');
					redirect('bloodtype/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Blood Type UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addbloodtype',$data);
					redirect('bloodtype/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addbloodtype',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('bloodtype/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->bloodtype_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'bloodtype/formeditbloodtype_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditbloodtype(){
			
			$data = array(
				'blood_type_id' 		=> $this->input->post('blood_type_id',true),
				'blood_type_code' 		=> $this->input->post('blood_type_code',true),
				'data_state'				=> 0
			);
		
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('blood_type_code', 'Blood Type Code', 'required|alpha_numeric');
			if($this->form_validation->run()==true){
				if($this->bloodtype_model->saveeditbloodtype($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.bloodtype.Edit',$auth['username'],'Edit Applicant Status');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['blood_type_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Blood Type Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bloodtype/Edit/'.$data['blood_type_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Blood Type UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('bloodtype/Edit/'.$data['blood_type_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('bloodtype/Edit/'.$data['blood_type_id']);
			}
		}
		
		function delete(){
			if($this->bloodtype_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.bloodtype.delete',$auth['username'],'Delete Applicant Status');
				$msg = "<div class='alert alert-success'>                
							Delete Data Blood Type Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('bloodtype');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Blood Type UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('bloodtype');
			}
		}
	}
?>