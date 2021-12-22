<?php
	Class socialsecurity extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('socialsecurity_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['socialsecurity']		= $this->socialsecurity_model->get_list();
			$data['main_view']['content']	= 'socialsecurity/listsocialsecurity_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function Add(){
			$data['main_view']['content']	= 'socialsecurity/formaddsocialsecurity_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddsocialsecurity(){
			$data = array(
				'social_security_period' 			=> $this->input->post('social_security_period',true),
				'social_security_jkm' 				=> $this->input->post('social_security_jkm',true),
				'social_security_jkk' 				=> $this->input->post('social_security_jkk',true),
				'social_security_jht_employee' 		=> $this->input->post('social_security_jht_employee',true),
				'social_security_jht_company' 		=> $this->input->post('social_security_jht_company',true),
				'social_security_medical_employee' 	=> $this->input->post('social_security_medical_employee',true),
				'social_security_medical_company' 	=> $this->input->post('social_security_medical_company',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('social_security_period', 'Social Security Period', 'required|alpha_numeric');
			$this->form_validation->set_rules('social_security_jkm', 'Social Security JKM', 'required');
			if($this->form_validation->run()==true){
				if($this->socialsecurity_model->saveNewsocialsecurity($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.socialsecurity.processAddsocialsecurity',$auth['username'],'Add New Social Security');
					$msg = "<div class='alert alert-success'>                
								Add Data Social Security Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addsocialsecurity');
					redirect('socialsecurity/Add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Social Security UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addsocialsecurity',$data);
					redirect('socialsecurity/Add');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('Addsocialsecurity',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('socialsecurity/Add');
			}
		}
		
		function Edit(){
			$data['main_view']['result']	= $this->socialsecurity_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']	= 'socialsecurity/formeditsocialsecurity_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditsocialsecurity(){
			
			$data = array(
				'social_security_id' 		=> $this->input->post('social_security_id',true),
				'social_security_period' 			=> $this->input->post('social_security_period',true),
				'social_security_jkm' 				=> $this->input->post('social_security_jkm',true),
				'social_security_jkk' 				=> $this->input->post('social_security_jkk',true),
				'social_security_jht_employee' 		=> $this->input->post('social_security_jht_employee',true),
				'social_security_jht_company' 		=> $this->input->post('social_security_jht_company',true),
				'social_security_medical_employee' 	=> $this->input->post('social_security_medical_employee',true),
				'social_security_medical_company' 	=> $this->input->post('social_security_medical_company',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('social_security_code', 'Social Security Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('social_security_jkm', 'Social Security JKM', 'required');
			if($this->form_validation->run()==true){
				if($this->socialsecurity_model->saveEditsocialsecurity($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.socialsecurity.Edit',$auth['username'],'Edit Social Security');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['social_security_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Social Security Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('socialsecurity/Edit/'.$data['social_security_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('socialsecurity/Edit/'.$data['social_security_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('socialsecurity/Edit/'.$data['social_security_id']);
			}
		}
		
				
		function delete(){
			if($this->socialsecurity_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.socialsecurity.delete',$auth['username'],'Delete Social Security');
				$msg = "<div class='alert alert-success'>                
							Delete Data Social Security Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('socialsecurity');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Social Security UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('socialsecurity');
			}
		}
	}
?>