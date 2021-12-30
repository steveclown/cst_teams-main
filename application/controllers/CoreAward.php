<?php
	Class CoreAward extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'award';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreAward_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreAward-'.$unique['unique']);
			$this->session->unset_userdata('CoreAwardToken-'.$unique['unique']);

			$data['main_view']['coreaward']		= $this->CoreAward_model->getCoreAward();
			$data['main_view']['content']		= 'CoreAward/ListCoreAward_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreAward-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreAward-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreAward-'.$unique['unique']);
			$this->session->unset_userdata('CoreAwardToken-'.$unique['unique']);
			redirect('award/add');
		}
		
		function addCoreAward(){
			$unique 			= $this->session->userdata('unique');
			$award_token		= $this->session->userdata('CoreAwardToken-'.$unique['unique']);

			if(empty($award_token)){
				$award_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreAwardToken-'.$unique['unique'], $award_token);
			}

			$data['main_view']['content']		= 'CoreAward/FormAddCoreAward_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreAward(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'award_code' 				=> $this->input->post('award_code',true),
				'award_name' 				=> $this->input->post('award_name',true),
				'award_remark' 				=> $this->input->post('award_remark',true),
				'award_token' 				=> $this->input->post('award_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$award_token 			= $this->CoreAward_model->getAwardToken($data['award_token']);
			
			$this->form_validation->set_rules('award_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('award_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($award_token == 0){
					if($this->CoreAward_model->insertCoreAward($data)){
						$award_id 		= $this->CoreAward_model->getAwardID($data['award_id']);


						$this->fungsi->set_log($auth['user_id'], $award_id, '3122', 'Application.CoreAward.processAddCoreAward', $award_id, 'Add New Core Award');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Award Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreAward-'.$unique['unique']);
						$this->session->unset_userdata('CoreAwardToken-'.$unique['unique']);
						redirect('award/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Award Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreAward',$data);
						redirect('award/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Award Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('award/add');
				}
			}else{
				$this->session->set_userdata('addCoreAward',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('award/add');
			}
		}
		
		function editCoreAward(){
			$award_id 							= $this->uri->segment(3);
			$data['main_view']['coreaward']		= $this->CoreAward_model->getCoreAward_Detail($award_id);
			$data['main_view']['content']		= 'CoreAward/FormEditCoreAward_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$award_id	= $this->uri->segment(3);

			redirect('award/edit/'.$award_id);
		}
		
		function processEditCoreAward(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'award_id' 				=> $this->input->post('award_id',true),
				'award_code' 			=> $this->input->post('award_code',true),
				'award_name' 			=> $this->input->post('award_name',true),
				'award_remark' 			=> $this->input->post('award_remark',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('award_code', 'Award Code', 'required');
			$this->form_validation->set_rules('award_name', 'Award Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreAward_model->updateCoreAward($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['award_id'], '3122', 'Application.CoreAward.processEditCoreAward', $data['award_id'], 'Edit Core Award');


					$msg = "<div class='alert alert-success'>                
								Edit Data Award Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('award/edit/'.$data['award_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Award Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('award/edit/'.$data['award_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('award/edit/'.$data['award_id']);
			}
		}
		
				
		function deleteCoreAward(){
			$auth 			= $this->session->userdata('auth');
			$award_id 	= $this->uri->segment(3);

			$data = array(
				'award_id' 		=> $award_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreAward_model->deleteCoreAward($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['award_id'], '3122', 'Application.CoreAward.deleteCoreAward', $data['award_id'], 'Delete Core Award');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Award Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('award');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Award Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('award');
			}
		}
	}
?>