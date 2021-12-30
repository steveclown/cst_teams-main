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
			$job_title_token	= $this->session->userdata('CoreJobTitleToken-'.$unique['unique']);
			
			if(empty($job_title_token)){
				$job_title_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreJobTitleToken-'.$unique['unique'], $job_title_token);
			}

			$data['main_view']['corejobtitle_parent']		= create_double($this->CoreJobTitle_model->getCoreJobTitle_Parent(),'job_title_id','job_title_name');

			$data['main_view']['content']			= 'CoreJobTitle/FormAddCoreJobTitle_view';
			$this->load->view('MainPage_view',$data);
		}
			
		
		  
		public function processAddCoreJobTitle(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'job_title_code' 				=> $this->input->post('job_title_code',true),
				'job_title_parent_id' 			=> $this->input->post('job_title_parent_id',true),
				'job_title_name' 				=> $this->input->post('job_title_name',true),
				'job_title_remark' 				=> $this->input->post('job_title_remark',true),
				'created_id' 					=> $auth['user_id'],
				'created_on' 					=> date("Y-m-d H:i:s"),
				'data_state'					=> '0'
			);

			// print_r("data ");
			// print_r($data);
			// exit;

			$job_title_token 			= $this->CoreJobTitle_model->getJobTitleToken($data['job_title_token']);

			// print_r($data); exit;
			$this->form_validation->set_rules('job_title_code', 'Code', 'required');
			// $this->form_validation->set_rules('job_title_parent_', 'Parent', 'required');
			$this->form_validation->set_rules('job_title_name', 'Name', 'required');
			$this->form_validation->set_rules('job_title_remark', 'Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($job_title_token == 0){
					if($this->CoreJobTitle_model->insertCoreJobTitle($data)){
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
			// dropdown ambil data dari table region
			// $data['main_view']['coreregion']	= create_double($this->CoreJobTitle_model->getCoreRegion(),'region_id','region_name');
			$data['main_view']['corejobtitle']	= $this->CoreJobTitle_model->getCoreJobTitle_Detail($job_title_id);
			$data['main_view']['content']		= 'CoreJobTitle/FormEditCoreJobTitle_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreJobTitle(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'job_title_id' 			=> $this->input->post('job_title_id',true),
				'job_title_code' 		=> $this->input->post('job_title_code',true),
				'job_title_name' 		=> $this->input->post('job_title_name',true),
				'job_title_remark' 		=> $this->input->post('job_title_remark',true),
				'job_title_parent_id' 	=> $this->input->post('job_title_parent_id',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
				'data_state'			=> 0
			);
			$this->form_validation->set_rules('job_title_code', 'Job Title Code', 'required');
			$this->form_validation->set_rules('job_title_name', 'Job Title Name', 'required');
			$this->form_validation->set_rules('job_title_remark', 'Job Title Remark', 'required');
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
		
		// public function deleteCoreJobTitle(){
		// 	$row = $this->CoreJobTitle_model->getChildStatus($this->uri->segment(3));
		// 	if($row=='0'){
		// 		if($this->CoreJobTitle_model->deleteCoreJobTitle($this->uri->segment(3))){
		// 			$auth = $this->session->userdata('auth');
		// 			$this->fungsi->set_log($auth['username'],'1005','Application.CoreJobTitle.delete',$auth['username'],'Delete Setting Job Title');
		// 			$msg = "<div class='alert alert-success'>                
		// 						Delete Data Job Title Successfully
		// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('CoreJobTitle');
		// 		}else{
		// 			$msg = "<div class='alert alert-danger'>                
		// 						Delete Data Job Title UnSuccessful
		// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('CoreJobTitle');
		// 		}
		// 	} else {
		// 			$msg = "<div class='alert alert-danger'>                
		// 					Job Title has child, cannot deleted
		// 					<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
		// 			$this->session->set_userdata('message',$msg);
		// 			redirect('CoreJobTitle');
		// 	}
		// }

		function deleteCoreJobTitle(){
			$auth 		= $this->session->userdata('auth');
			$job_title_id 	= $this->uri->segment(3);

			$data = array(
				'job_title_id' 		=> $job_title_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreJobTitle_model->deleteCoreJobTitle($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['job_title_id'], '3122', 'Application.CoreJobTitle.deleteCoreJobTitle', $data['job_title_id'], 'Delete Core JobTitle');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Job Title Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreJobTitle');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Job Title Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreJobTitle');
			}
		}
	}
?>