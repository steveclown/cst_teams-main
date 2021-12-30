<?php
	Class CoreClass extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'class';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreClass_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreClass-'.$unique['unique']);
			$this->session->unset_userdata('CoreClassToken-'.$unique['unique']);

			$data['main_view']['coreclass']		= $this->CoreClass_model->getCoreClass();
			$data['main_view']['content']		= 'CoreClass/ListCoreClass_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreClass(){
			$unique		= $this->session->userdata('uniqui');
			$class_token	= $this->session->userdata('CoreClassToken-'.$unique['unique']);

			if(empty($class_token)){
				$class_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreClassToken-'.$unique['unique'],$class_token);
			}

			$data['main_view']['coregrade']		= create_double($this->CoreClass_model->getCoreGrade(),'grade_id','grade_name');

			$data['main_view']['content']		= 'CoreClass/FormAddCoreClass_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreClass(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'grade_id' 						=> $this->input->post('grade_id',true),
				'class_code' 					=> $this->input->post('class_code',true),
				'class_name' 					=> $this->input->post('class_name',true),
				'standard_salary_range1' 		=> $this->input->post('standard_salary_range1',true),
				'standard_salary_range2'		=> $this->input->post('standard_salary_range2',true),
				'class_remark' 					=> $this->input->post('class_remark',true),
				'class_token' 					=> $this->input->post('class_token',true),
				'created_id' 					=> $auth['user_id'],
				'created_on' 					=> date("Y-m-d H:i:s"),
				'data_state'					=> 0
			);

			$class_token 			= $this->CoreClass_model->getClassToken($data['class_token']);
			
			$this->form_validation->set_rules('grade_id', 'Nama Class', 'required');
			$this->form_validation->set_rules('class_code', 'Kode Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($class_token == 0){
					if($this->CoreClass_model->insertCoreClass($data)){
						$class_id 		= $this->CoreClass_model->getClassID($data['class_id']);


						$this->fungsi->set_log($auth['user_id'], $class_id, '3122', 'Application.CoreClass.processAddCoreClass', $class_id, 'Add New Core Class');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Class Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreClass-'.$unique['unique']);
						$this->session->unset_userdata('CoreClassToken-'.$unique['unique']);
						redirect('class/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Class Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreClass',$data);
						redirect('class/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Class Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('class/add');
				}
			}else{
				$this->session->set_userdata('addCoreClass',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('class/add');
			}
		}
		
		function editCoreClass(){
			$data['main_view']['coreclass']		= $this->CoreClass_model->getCoreClass_Detail($this->uri->segment(3));
			$data['main_view']['coregrade']		= create_double($this->CoreClass_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['content']		= 'CoreClass/FormEditCoreClass_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$class_id	= $this->uri->segment(3);

			redirect('class/edit/'.$class_id);
		}
		
		function processEditCoreClass(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'class_id' 				=> $this->input->post('class_id',true),
				'grade_id' 				=> $this->input->post('grade_id',true),
				'class_code' 			=> $this->input->post('class_code',true),
				'class_name' 			=> $this->input->post('class_name',true),
				'standard_salary_range1'=> $this->input->post('standard_salary_range1',true),
				'standard_salary_range2'=> $this->input->post('standard_salary_range2',true),
				'class_remark' 			=> $this->input->post('class_remark',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('class_code', 'Class Code', 'required');
			$this->form_validation->set_rules('class_name', 'Class Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreClass_model->updateCoreClass($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['class_id'], '3122', 'Application.CoreClass.processEditCoreClass', $data['class_id'], 'Edit Core Class');


					$msg = "<div class='alert alert-success'>                
								Edit Data Class Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('class/edit/'.$data['class_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Class Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('class/edit/'.$data['class_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('class/edit/'.$data['class_id']);
			}
		}
		
		function deleteCoreClass(){
			$auth 		= $this->session->userdata('auth');
			$class_id 	= $this->uri->segment(3);

			$data = array(
				'class_id' 		=> $class_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreClass_model->deleteCoreClass($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['class_id'], '3122', 'Application.CoreClass.deleteCoreClass', $data['class_id'], 'Delete Core Class');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Class Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('class');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Class Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('class');
			}
		}
	}
?>