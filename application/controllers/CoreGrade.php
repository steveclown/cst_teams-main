<?php
	Class CoreGrade extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'grade';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreGrade_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreGrade-'.$unique['unique']);
			$this->session->unset_userdata('CoreGradeToken-'.$unique['unique']);

			$data['main_view']['coregrade']		= $this->CoreGrade_model->getCoreGrade();
			$data['main_view']['content']			= 'CoreGrade/ListCoreGrade_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreGrade(){
			$unique 		= $this->session->userdata('unique');
			$grade_token	= $this->session->userdata('CoreGradeToken-'.$unique['unique']);

			if(empty($grade_token)){
				$grade_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreGradeToken-'.$unique['unique'], $grade_token);
			}

			$data['main_view']['content']		= 'CoreGrade/FormAddCoreGrade_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreGrade(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'grade_code' 		=> $this->input->post('grade_code',true),
				'grade_name' 		=> $this->input->post('grade_name',true),
				'grade_remark' 		=> $this->input->post('grade_remark',true),
				'grade_token' 		=> $this->input->post('grade_token',true),
				'created_id' 		=> $auth['user_id'],
				'created_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 0
			);

			$grade_token 			= $this->CoreGrade_model->getGradeToken($data['grade_token']);
			
			$this->form_validation->set_rules('grade_code', 'Grade Code', 'required');
			$this->form_validation->set_rules('grade_name', 'Grade Name', 'required');


			if($this->form_validation->run()==true){
				if ($grade_token == 0){
					if($this->CoreGrade_model->insertCoreGrade($data)){
						$grade_id 		= $this->CoreGrade_model->getGradeID($data['grade_id']);


						$this->fungsi->set_log($auth['user_id'], $grade_id, '3122', 'Application.CoreGrade.processAddCoreGrade', $grade_id, 'Add New Core Grade');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Grade Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreGrade-'.$unique['unique']);
						$this->session->unset_userdata('CoreGradeToken-'.$unique['unique']);
						redirect('grade/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Grade Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreGrade',$data);
						redirect('grade/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Grade Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('grade/add');
				}
			}else{
				$this->session->set_userdata('addCoreGrade',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('grade/add');
			}
		}
		
		function editCoreGrade(){
			$grade_id 							= $this->uri->segment(3);
			$data['main_view']['coregrade']		= $this->CoreGrade_model->getCoreGrade_Detail($grade_id);
			$data['main_view']['content']		= 'CoreGrade/FormEditCoreGrade_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$grade_id	= $this->uri->segment(3);

			redirect('grade/edit/'.$grade_id);
		}
		
		function processEditCoreGrade(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'grade_id'	 		=> $this->input->post('grade_id',true),
				'grade_code' 		=> $this->input->post('grade_code',true),
				'grade_name' 		=> $this->input->post('grade_name',true),
				'updated_id' 		=> $auth['user_id'],
				'updated_on' 		=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('grade_code', 'Grade Code', 'required');
			$this->form_validation->set_rules('grade_name', 'Grade Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreGrade_model->updateCoreGrade($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['grade_id'], '3122', 'Application.CoreGrade.processEditCoreGrade', $data['grade_id'], 'Edit Core Grade');


					$msg = "<div class='alert alert-success'>                
								Edit Data Grade Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('grade/edit/'.$data['grade_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Grade Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('grade/edit/'.$data['grade_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('grade/edit/'.$data['grade_id']);
			}
		}
		
		
		function deleteCoreGrade(){
			$auth 		= $this->session->userdata('auth');
			$grade_id 	= $this->uri->segment(3);

			$data = array(
				'grade_id' 			=> $grade_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreGrade_model->deleteCoreGrade($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['grade_id'], '3122', 'Application.CoreGrade.deleteCoreGrade', $data['grade_id'], 'Delete Core Grade');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Grade Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('grade');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Grade Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('grade');
			}
		}
	}
?>