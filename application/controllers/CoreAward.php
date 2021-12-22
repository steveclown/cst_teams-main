<?php
	Class CoreAward extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreAward_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreAward']		= $this->CoreAward_model->getCoreAward();
			$data['Main_view']['content']		= 'CoreAward/listCoreAward_view';
			$this->load->view('MainPage_view',$data);
		}

		function addCoreAward(){
			$data['Main_view']['content']		= 'CoreAward/formaddCoreAward_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreAward(){
			$data = array(
				'award_code' 		=> $this->input->post('award_code',true),
				'award_name' 		=> $this->input->post('award_name',true),
				'award_remark' 		=> $this->input->post('award_remark',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('award_code', 'Award Code', 'required');
			$this->form_validation->set_rules('award_name', 'Award Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreAward_model->saveNewCoreAward($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreAward.processAddlanguage',$auth['username'],'Add New coreCoreAward');
					$msg = "<div class='alert alert-success'>                
								Add Data Award Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreAward');
					redirect('CoreAward/addCoreAward');
				}else{
					$msg = "<div class='alert alert-success'>                
								Add Data Award UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAward/addCoreAward');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreAward',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreAward/addCoreAward');
			}
		}
		
		function editCoreAward(){
			$data['Main_view']['CoreAward']		= $this->CoreAward_model->getCoreAward_Detail($this->uri->segment(3));
			$data['Main_view']['content']		= 'CoreAward/formeditCoreAward_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreAward(){
			
			$data = array(
				'award_id' 			=> $this->input->post('award_id',true),
				'award_code' 		=> $this->input->post('award_code',true),
				'award_name' 		=> $this->input->post('award_name',true),
				'award_remark' 		=> $this->input->post('award_remark',true),
				'data_state'		=> '0'
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('award_code', 'Award Code', 'required');
			$this->form_validation->set_rules('award_name', 'Award Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreAward_model->saveEditCoreAward($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreAward.Edit',$auth['username'],'Edit coreCoreAward');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreAward_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Award Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAward/editCoreAward/'.$data['award_id']);
				}else{		
					$msg = "<div class='alert alert-success'>                
								Edit Award UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAward/editCoreAward/'.$data['award_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreAward/editCoreAward'.$data['award_id']);
			}
		}
		
				
		function deleteCoreAward(){
			if($this->CoreAward_model->deleteCoreAward($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreAward.delete',$auth['username'],'Delete coreCoreAward');
				$msg = "<div class='alert alert-success'>                
							Delete Data Award Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAward');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Award UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAward');
			}
		}
	}
?>