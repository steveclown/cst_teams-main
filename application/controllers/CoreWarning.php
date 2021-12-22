<?php
	Class CoreWarning extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreWarning_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreWarning']		= $this->CoreWarning_model->getCoreWarning();
			$data['Main_view']['content']			= 'CoreWarning/listCoreWarning_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreWarning(){
			$data['Main_view']['content']			= 'CoreWarning/formaddCoreWarning_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreWarning(){
			$data = array(
				'warning_code' 		=> $this->input->post('warning_code',true),
				'warning_name' 		=> $this->input->post('warning_name',true),
				'warning_remark' 	=> $this->input->post('warning_remark',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('warning_code', 'Warning Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('warning_name', 'Warning Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreWarning_model->saveNewCoreWarning($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.Warning.processAddCoreWarning',$auth['username'],'Add New Warning');
					$msg = "<div class='alert alert-success'>                
								Add Data Warning Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddCoreWarning');
					redirect('CoreWarning/addCoreWarning');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Warning UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreWarning/addCoreWarning');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddCoreWarning',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreWarning/addCoreWarning');
			}
		}
		
		function editCoreWarning(){
			$data['Main_view']['CoreWarning']	= $this->CoreWarning_model->getCoreWarning_Detail($this->uri->segment(3));
			$data['Main_view']['content']		= 'CoreWarning/formeditCoreWarning_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreWarning(){
			
			$data = array(
				'warning_id' 			=> $this->input->post('warning_id',true),
				'warning_code' 			=> $this->input->post('warning_code',true),
				'warning_name' 			=> $this->input->post('warning_name',true),
				'warning_remark' 		=> $this->input->post('warning_remark',true),
				'data_state'			=> 0
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('warning_code', 'Warning Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('warning_name', 'Warning Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreWarning_model->saveEditCoreWarning($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.Warning.Edit',$auth['username'],'Edit Warning');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['warning_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Warning Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreWarning/editCoreWarning/'.$data['warning_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Warning UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreWarning/editCoreWarning/'.$data['warning_id']);
				}
			}else{
				$msg = "<div class='alert alert-error'>                
								ID Warning : <b>".$data['warning_id']."</b> has been exist !
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreWarning/editCoreWarning/'.$data['warning_id']);
			}
		}
				
		function deleteCoreWarning(){
			if($this->CoreWarning_model->deleteCoreWarning($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreWarning.delete',$auth['username'],'Delete Warning');
				$msg = "<div class='alert alert-success'>                
							Delete Data Warning Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreWarning');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Warning UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreWarning');
			}
		}
	}
?>