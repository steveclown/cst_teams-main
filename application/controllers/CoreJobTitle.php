<?php
	Class CoreJobTitle extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'jobtitle';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreJobTitle_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreJobTitle-'.$unique['unique']);
			$this->session->unset_userdata('CoreJobTitleToken-'.$unique['unique']);

			$data['main_view']['corejobtitle']		= $this->CoreJobTitle_model->getCoreJobTitle();
			$data['main_view']['content']			= 'CoreJobTitle/ListCoreJobTitle_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreJobTitle(){
			$unique 		= $this->session->userdata('unique');
			$jobtitle_token	= $this->session->userdata('CoreJobTitleToken-'.$unique['unique']);
			
			if(empty($jobtitle_token)){
				$jobtitle_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreJobTitleToken-'.$unique['unique'], $jobtitle_token);
			}

			$data['multilevel'] 					= array(''=>'- None -') + $this->CoreJobTitle_model->getChildCoreJobTitle(0);
			$data['main_view']['content']			= 'CoreJobTitle/FormAddCoreJobTitle_view';
			$this->load->view('MainPage_view',$data);
		}
			
		public function showChildCoreJobTitle(){
			$id = $this->uri->segment(3);
			$combo_level = $this->uri->segment(4);
			$childs = $this->CoreJobTitle_model->getChildCoreJobTitle($id);
			if(count($childs) > 0)
			{
				$combo_level ++;
				$childs = array(''=>'- None -') + $childs;
				echo form_dropdown('job_title_parent[]',$childs,'','class="form-control select2me" onchange="show_extra_combo(this,'.$combo_level.')"');
			}	
			else
			{
				echo "";
			}
		}
		
		public function processAddCoreJobTitle(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'job_title_code' 				=> $this->input->post('job_title_code',true),
				'job_title_parent_id' 			=> $this->input->post('job_title_parent_id',true),
				'job_title_name' 				=> $this->input->post('job_title_name',true),
				'job_title_top_parent_id'		=> $this->input->post('job_title_parent_id',true),
				'job_title_has_child' 			=> $this->input->post('job_title_has_child',true),
				'job_title_remark' 				=> $this->input->post('job_title_remark',true),
				'created_id' 					=> $auth['user_id'],
				'created_on' 					=> date("Y-m-d H:i:s"),
				'data_state'					=> '0'
			);

			$jobtitle_token 			= $this->CoreJobTitle_model->getJobTitleToken($data['jobtitle_token']);

			// print_r($data); exit;
			$this->form_validation->set_rules('job_title_code', 'Code', 'required');
			// $this->form_validation->set_rules('job_title_parent_', 'Parent', 'required');
			$this->form_validation->set_rules('job_title_name', 'Name', 'required');
			$this->form_validation->set_rules('job_title_remark', 'Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($jobtitle_token == 0){
					if($this->CoreJobTitle_model->saveNewCoreJobTitle($data)){
						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['user_id'], $job_title_id, '3122', 'Application.CoreRegion.processAddCoreRegion', $job_title_id, 'Add New Core Job Title');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Job Title Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreJobTitle');
						redirect('CoreJobTitle/addCoreJobTitle');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Data Job Title UnSuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreJobTitle',$data);
						redirect('CoreJobTitle/addCoreJobTitle');
					}
				}
			}else{
				$this->session->set_userdata('addCoreJobTitle',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreJobTitle/addCoreJobTitle');
			}
		}
		
		public function editCoreJobTitle(){
			$job_title_id = $this->uri->segment(3);
			$data['Main_view']['CoreJobTitle']	= $this->CoreJobTitle_model->getCoreJobTitle_Detail($job_title_id);
			$data['Main_view']['content']		= 'CoreJobTitle/formeditCoreJobTitle_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreJobTitle(){
			$data = array(
				'job_title_id' 			=> $this->input->post('job_title_id',true),
				'job_title_code' 		=> $this->input->post('job_title_code',true),
				'job_title_name' 		=> $this->input->post('job_title_name',true),
				'job_title_parent_id' 	=> $this->input->post('job_title_parent_id',true),
				'data_state'			=> 0
			);
			$this->form_validation->set_rules('job_title_code', 'Job Title Code', 'required');
			$this->form_validation->set_rules('job_title_name', 'Job Title Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreJobTitle_model->saveEditCoreJobTitle($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreJobTitle.edit',$auth['username'],'Edit Job Title');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['job_title_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Job Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreJobTitle/editCoreJobTitle/'.$data['job_title_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Job Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreJobTitle/editCoreJobTitle/'.$data['job_title_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreJobTitle/editCoreJobTitle/'.$data['job_title_id']);
			}
		}
		
		public function deleteCoreJobTitle(){
			$row = $this->CoreJobTitle_model->getChildStatus($this->uri->segment(3));
			if($row=='0'){
				if($this->CoreJobTitle_model->deleteCoreJobTitle($this->uri->segment(3))){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1005','Application.CoreJobTitle.delete',$auth['username'],'Delete Setting Job Title');
					$msg = "<div class='alert alert-success'>                
								Delete Data Job Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreJobTitle');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Delete Data Job Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreJobTitle');
				}
			} else {
					$msg = "<div class='alert alert-danger'>                
							Job Title has child, cannot deleted
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreJobTitle');
			}
		}
	}
?>