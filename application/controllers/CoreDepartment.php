<?php
	Class CoreDepartment extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'department';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreDepartment_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreDepartment-'.$unique['unique']);
			$this->session->unset_userdata('CoreDepartmentToken-'.$unique['unique']);

			$data['main_view']['coredepartment']	= $this->CoreDepartment_model->getCoreDepartment();
			$data['main_view']['content']			= 'CoreDepartment/ListCoreDepartment_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreDepartment-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreDepartment-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreDepartment-'.$unique['unique']);
			$this->session->unset_userdata('CoreDepartmentToken-'.$unique['unique']);
			redirect('department/add');
		}
		
		function addCoreDepartment(){
			$unique 			= $this->session->userdata('unique');
			$department_token	= $this->session->userdata('CoreDepartmentToken-'.$unique['unique']);

			if(empty($department_token)){
				$department_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreDepartmentToken-'.$unique['unique'], $department_token);
			}

			$data['main_view']['coredivision']	= create_double($this->CoreDepartment_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['content']		= 'CoreDepartment/FormAddCoreDepartment_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreDepartment(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'division_id' 				=> $this->input->post('division_id',true),
				'department_code' 			=> $this->input->post('department_code',true),
				'department_name' 			=> $this->input->post('department_name',true),
				'department_token' 			=> $this->input->post('department_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$department_token 			= $this->CoreDepartment_model->getDepartmentToken($data['department_token']);
			
			$this->form_validation->set_rules('division_id', 'Nama Devisi', 'required');
			$this->form_validation->set_rules('department_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('department_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($department_token == 0){
					if($this->CoreDepartment_model->insertCoreDepartment($data)){
						$department_id 		= $this->CoreDepartment_model->getDepartmentID($data['department_id']);


						$this->fungsi->set_log($auth['user_id'], $department_id, '3122', 'Application.CoreDepartment.processAddCoreDepartment', $department_id, 'Add New Core Department');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Department Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreDepartment-'.$unique['unique']);
						$this->session->unset_userdata('CoreDepartmentToken-'.$unique['unique']);
						redirect('department/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Department Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreDepartment',$data);
						redirect('department/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Department Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('department/add');
				}
			}else{
				$this->session->set_userdata('addCoreDepartment',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('department/add');
			}
		}
		
		function editCoreDepartment(){
			$department_id 							= $this->uri->segment(3);
			$data['main_view']['coredivision']		= create_double($this->CoreDepartment_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']	= $this->CoreDepartment_model->getCoreDepartment_Detail($department_id);
			$data['main_view']['content']			= 'CoreDepartment/FormEditCoreDepartment_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 		= $this->session->userdata('unique');
			$department_id	= $this->uri->segment(3);

			redirect('department/edit/'.$department_id);
		}
		
		function processEditCoreDepartment(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'department_id' 			=> $this->input->post('department_id',true),
				'division_id' 				=> $this->input->post('division_id',true),
				'department_code' 			=> $this->input->post('department_code',true),
				'department_name' 			=> $this->input->post('department_name',true),
				'updated_id' 				=> $auth['user_id'],
				'updated_on' 				=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('division_id', 'Nama Devisi', 'required');
			$this->form_validation->set_rules('department_code', 'Department Code', 'required');
			$this->form_validation->set_rules('department_name', 'Department Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreDepartment_model->updateCoreDepartment($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['department_id'], '3122', 'Application.CoreDepartment.processEditCoreDepartment', $data['department_id'], 'Edit Core Department');


					$msg = "<div class='alert alert-success'>                
								Edit Data Department Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('department/edit/'.$data['department_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Department Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('department/edit/'.$data['department_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('department/edit/'.$data['department_id']);
			}
		}
		
				
		function deleteCoreDepartment(){
			$auth 			= $this->session->userdata('auth');
			$department_id 	= $this->uri->segment(3);

			$data = array(
				'department_id' 	=> $department_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreDepartment_model->deleteCoreDepartment($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['department_id'], '3122', 'Application.CoreDepartment.deleteCoreDepartment', $data['department_id'], 'Delete Core Department');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Department Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('department');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Department Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('department');
			}
		}
	}
?>