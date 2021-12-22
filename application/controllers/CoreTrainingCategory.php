<?php
	Class CoreTrainingCategory extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreTrainingCategory_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreTrainingCategory']		= $this->CoreTrainingCategory_model->getCoreTrainingCategory();
			$data['main_view']['content']					= 'CoreTrainingCategory/listCoreTrainingCategory_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreTrainingCategory(){
			$data['main_view']['content']					= 'CoreTrainingCategory/formaddCoreTrainingCategory_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreTrainingCategory(){
			$data = array(
				'training_category_code' 		=> $this->input->post('training_category_code',true),
				'training_category_name' 		=> $this->input->post('training_category_name',true),
				'training_category_remark' 		=> $this->input->post('training_category_remark',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('training_category_code', 'Training Category Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('training_category_name', 'Training Category Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreTrainingCategory_model->saveNewCoreTrainingCategory($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreTrainingCategory.processAddCoreTrainingCategory',$auth['username'],'Add New Training Category');
					$msg = "<div class='alert alert-success'>                
								Add New Training Category Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddTrainingCategory');
					redirect('CoreTrainingCategory/addCoreTrainingCategory');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add New Training Category UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddTrainingCategory',$data);
					redirect('CoreTrainingCategory/addCoreTrainingCategory');
				}
			}else{
				$this->session->set_userdata('AddTrainingCategory',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingCategory/addCoreTrainingCategory');
			}
		}
		
		function editCoreTrainingCategory(){
			$data['main_view']['CoreTrainingCategory']		= $this->CoreTrainingCategory_model->getCoreTrainingCategory_Detail($this->uri->segment(3));
			$data['main_view']['content']					= 'CoreTrainingCategory/formeditCoreTrainingCategory_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreTrainingcategory(){
			$data = array(
				'training_category_id' 			=> $this->input->post('training_category_id',true),
				'training_category_code' 		=> $this->input->post('training_category_code',true),
				'training_category_name' 		=> $this->input->post('training_category_name',true),
				'training_category_remark' 		=> $this->input->post('training_category_remark',true),
				'data_state'					=> 0
			);
			
			$this->form_validation->set_rules('training_category_code', 'Training Category Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('training_category_name', 'Training Category Name', 'required');
			
			$this->session->set_userdata('Edit',$data);
			if($this->form_validation->run()==true){
				if($this->CoreTrainingCategory_model->saveEditCoreTrainingCategory($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreTrainingCategory.processEditCoreTrainingcategory',$auth['username'],'Edit Training category');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['training_category_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Category Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingCategory/editCoreTrainingCategory/'.$data['training_category_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Training Category UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingCategory/editCoreTrainingCategory/'.$data['training_category_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingCategory/editCoreTrainingCategory/'.$data['training_category_id']);
			}
		}
		
		function deleteCoreTrainingCategory(){
			if($this->CoreTrainingCategory_model->deleteCoreTrainingCategory($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreTrainingCategory.deleteCoreTrainingCategory',$auth['username'],'Delete Training category');
				$msg = "<div class='alert alert-success'>                
							Delete Training Category Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingCategory');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Training Category Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingCategory');
			}
		}
	}
?>