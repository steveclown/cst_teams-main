<?php
	Class CoreTrainingTitle extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreTrainingTitle_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreTrainingTitle']		= $this->CoreTrainingTitle_model->getCoreTrainingTitle();
			$data['main_view']['content']				= 'CoreTrainingTitle/listCoreTrainingTitle_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreTrainingTitle(){
			$data['main_view']['content']					= 'CoreTrainingTitle/formaddCoreTrainingTitle_view';
			$data['main_view']['coretrainingcategory']		= create_double($this->CoreTrainingTitle_model->getCoreTrainingCategory(),'training_category_id','training_category_name');
			$this->load->view('mainpage_view',$data);
		}
			
		public function show_child()
		{
			$id = $this->uri->segment(3);
			$combo_level = $this->uri->segment(4);
			$childs = $this->trainingtitle_model->get_child($id);
			if(count($childs) > 0)
			{
				$combo_level ++;
				$childs = array(''=>'- None -') + $childs;
				echo form_dropdown('training_title_parent[]',$childs,'','onchange="show_extra_combo(this,'.$combo_level.')"');
			}	
			else
			{
				echo "";
			}
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreTrainingTitle-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreTrainingTitle-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreTrainingTitle-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreTrainingTitle-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function processAddCoreTrainingTitle(){
			$data = array(
				'training_category_id' 				=> $this->input->post('training_category_id',true),
				'training_title_code' 				=> $this->input->post('training_title_code',true),
				'training_title_name' 				=> $this->input->post('training_title_name',true),
				'training_title_remark' 			=> $this->input->post('training_title_remark',true),
				'data_state'						=> 0
			);
			
			// print_r($data); exit;
			$this->form_validation->set_rules('training_category_id', 'Training Category', 'required');
			$this->form_validation->set_rules('training_title_code', 'Training Title Code', 'required');
			$this->form_validation->set_rules('training_title_name', 'Training Title Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreTrainingTitle_model->saveNewCoreTrainingTitle($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreTrainingTitle.processAddCoreTrainingTitle',$auth['user_id'],'Add New Core Training Title');
					$msg = "<div class='alert alert-success'>                
								Add Data Training Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('Addtrainingtitle');
					redirect('CoreTrainingTitle/addCoreTrainingTitle');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Training Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('Addtrainingtitle',$data);
					redirect('CoreTrainingTitle/addCoreTrainingTitle');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('Addtrainingtitle',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingTitle/addCoreTrainingTitle');
			}
		}
		
		public function editCoreTrainingTitle(){
			$data['main_view']['CoreTrainingTitle']		= $this->CoreTrainingTitle_model->getCoreTrainingTitle_Detail($this->uri->segment(3));
			$data['main_view']['coretrainingcategory']	= create_double($this->CoreTrainingTitle_model->getCoreTrainingCategory(),'training_category_id','training_category_name');
			/*$data['multilevel'] = array(''=>'- None -') + $this->trainingtitle_model->get_child(0);*/
			$data['main_view']['content']				= 'CoreTrainingTitle/formeditCoreTrainingTitle_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreTrainingTitle(){
			$data = array(
				'training_title_id' 				=> $this->input->post('training_title_id',true),
				'training_category_id' 				=> $this->input->post('training_category_id',true),
				'training_title_code' 				=> $this->input->post('training_title_code',true),
				'training_title_name' 				=> $this->input->post('training_title_name',true),
				'training_title_remark' 			=> $this->input->post('training_title_remark',true),
				'data_state'						=> 0
			);
			
			// print_r($data); exit;
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('training_category_id', 'Training Category', 'required');
			$this->form_validation->set_rules('training_title_code', 'Training Title Code', 'required');
			$this->form_validation->set_rules('training_title_name', 'Training Title Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreTrainingTitle_model->saveEditCoreTrainingTitle($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.CoreTrainingTitle.processEditCoreTrainingTitle',$auth['user_id'],'Edit Core Training Title');
					$this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['training_title_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingTitle/editCoreTrainingTitle/'.$data['training_title_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Training Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreTrainingTitle/editCoreTrainingTitle/'.$data['training_title_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingTitle/editCoreTrainingTitle/'.$data['training_title_id']);
			}
		}
		
		function deleteCoreTrainingTitle(){
			if($this->CoreTrainingTitle_model->deleteCoreTrainingTitle($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreTrainingTitle.deleteCoreTrainingTitle',$auth['user_id'],'Delete Core Training Title');
					$msg = "<div class='alert alert-success'>                
							Delete Data Training Title Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingTitle');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Training Title UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreTrainingTitle');
			}


			/*$row = $this->CoreTrainingTitle_model->getChildstatus($this->uri->segment(3));
			
			if($row=='0'){
				
			} else {
					$msg = "<div class='alert alert-error'>                
							Training Title has child, cannot deleted
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('trainingtitle');
			}*/
		}
	}
?>