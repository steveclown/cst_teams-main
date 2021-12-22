<?php
	Class CoreDivision extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'division';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreDivision_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreDivision-'.$unique['unique']);
			$this->session->unset_userdata('CoreDivisionToken-'.$unique['unique']);

			$data['main_view']['coredivision']		= $this->CoreDivision_model->getCoreDivision();
			$data['main_view']['content']			= 'CoreDivision/ListCoreDivision_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreDivision-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreDivision-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreDivision-'.$unique['unique']);
			$this->session->unset_userdata('CoreDivisionToken-'.$unique['unique']);
			redirect('division/add');
		}
		
		function addCoreDivision(){
			$unique 		= $this->session->userdata('unique');
			$division_token	= $this->session->userdata('CoreDivisionToken-'.$unique['unique']);

			if(empty($division_token)){
				$division_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreDivisionToken-'.$unique['unique'], $division_token);
			}

			$data['main_view']['content']		= 'CoreDivision/FormAddCoreDivision_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreDivision(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'division_code' 		=> $this->input->post('division_code',true),
				'division_name' 		=> $this->input->post('division_name',true),
				'division_token' 		=> $this->input->post('division_token',true),
				'created_id' 		=> $auth['user_id'],
				'created_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 0
			);

			$division_token 			= $this->CoreDivision_model->getDivisionToken($data['division_token']);
			
			$this->form_validation->set_rules('division_code', 'Division Code', 'required');
			$this->form_validation->set_rules('division_name', 'Division Name', 'required');


			if($this->form_validation->run()==true){
				if ($division_token == 0){
					if($this->CoreDivision_model->insertCoreDivision($data)){
						$division_id 		= $this->CoreDivision_model->getDivisionID($data['division_id']);


						$this->fungsi->set_log($auth['user_id'], $division_id, '3122', 'Application.CoreDivision.processAddCoreDivision', $division_id, 'Add New Core Division');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Division Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreDivision-'.$unique['unique']);
						$this->session->unset_userdata('CoreDivisionToken-'.$unique['unique']);
						redirect('division/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Division Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreDivision',$data);
						redirect('division/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Division Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('division/add');
				}
			}else{
				$this->session->set_userdata('addCoreDivision',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('division/add');
			}
		}
		
		function editCoreDivision(){
			$division_id 						= $this->uri->segment(3);
			$data['main_view']['coredivision']	= $this->CoreDivision_model->getCoreDivision_Detail($division_id);
			$data['main_view']['content']		= 'CoreDivision/FormEditCoreDivision_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$division_id	= $this->uri->segment(3);

			redirect('division/edit/'.$division_id);
		}
		
		function processEditCoreDivision(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'division_id' 		=> $this->input->post('division_id',true),
				'division_code' 		=> $this->input->post('division_code',true),
				'division_name' 		=> $this->input->post('division_name',true),
				'updated_id' 		=> $auth['user_id'],
				'updated_on' 		=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('division_code', 'Division Code', 'required');
			$this->form_validation->set_rules('division_name', 'Division Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreDivision_model->updateCoreDivision($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['division_id'], '3122', 'Application.CoreDivision.processEditCoreDivision', $data['division_id'], 'Edit Core Division');


					$msg = "<div class='alert alert-success'>                
								Edit Data Division Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('division/edit/'.$data['division_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Division Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('division/edit/'.$data['division_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('division/edit/'.$data['division_id']);
			}
		}
		
				
		function deleteCoreDivision(){
			$auth 		= $this->session->userdata('auth');
			$division_id 	= $this->uri->segment(3);

			$data = array(
				'division_id' 		=> $division_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreDivision_model->deleteCoreDivision($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['division_id'], '3122', 'Application.CoreDivision.deleteCoreDivision', $data['division_id'], 'Delete Core Division');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Division Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('division');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Division Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('division');
			}
		}
	}
?>