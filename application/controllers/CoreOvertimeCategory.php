<?php
	Class CoreOvertimeCategory extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreOvertimeCategory_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreOvertimeCategory']		= $this->CoreOvertimeCategory_model->getCoreOvertimeCategory();
			$data['main_view']['content']					= 'CoreOvertimeCategory/listCoreOvertimeCategory_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreOvertimeCategory(){
			$data['main_view']['content']					= 'CoreOvertimeCategory/formaddCoreOvertimeCategory_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreOvertimeCategory(){
			$data = array(
				'overtime_name' 		=> $this->input->post('overtime_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('overtime_name', 'Overtime Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeCategory_model->saveNewCoreOvertimeCategory($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreOvertimeCategory.processAddCoreOvertimeCategory',$auth['username'],'Add New Overtime Category');
					$msg = "<div class='alert alert-success'>                
								Add Data Overtime Category Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddOvertimeCategory');
					redirect('CoreOvertimeCategory/addCoreOvertimeCategory');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Overtime Category UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeCategory/addCoreOvertimeCategory');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddOvertimeCategory',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeCategory/addCoreOvertimeCategory');
			}
		}
		
		function editCoreOvertimeCategory(){
			$data['main_view']['CoreOvertimeCategory']		= $this->CoreOvertimeCategory_model->getCoreOvertimeCategory_Detail($this->uri->segment(3));
			$data['main_view']['content']					= 'CoreOvertimeCategory/formeditCoreOvertimeCategory_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreOvertimeCategory(){
			$data = array(
				'overtime_category_id' 			=> $this->input->post('overtime_category_id',true),
				'overtime_name' 				=> $this->input->post('overtime_category_name',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('overtime_category_name', 'Category Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeCategory_model->saveEditCoreOvertimeCategory($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreOvertimeCategory.processEditCoreOvertimeCategory',$auth['username'],'Edit Overtime Category');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['overtime_category_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Overtime Category Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeCategory/editCoreOvertimeCategory/'.$data['overtime_category_id']);
				}else{
					$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('CoreOvertimeCategory/editCoreOvertimeCategory/'.$data['overtime_category_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeCategory/editCoreOvertimeCategory/'.$data['overtime_category_id']);
			}
		}
		
		function deleteCoreOvertimeCategory(){
			if($this->CoreOvertimeCategory_model->deleteCoreOvertimeCategory($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreOvertimeCategory.deleteCoreOvertimeCategory',$auth['username'],'Delete Overtime Category');
				$msg = "<div class='alert alert-success'>                
							Delete Overtime Category Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeCategory');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Overtime Category UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreOvertimeCategory');
			}
		}
	}
?>