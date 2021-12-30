<?php
	Class CoreWarning extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'warning';

			$this->cekLogin();
			$this->accessMenu($menu);
			
			$this->load->model('MainPage_model');
			$this->load->model('CoreWarning_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreWarning-'.$unique['unique']);
			$this->session->unset_userdata('CoreWarningToken-'.$unique['unique']);

			$data['main_view']['corewarning']		= $this->CoreWarning_model->getCoreWarning();
			$data['main_view']['content']			= 'CoreWarning/ListCoreWarning_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreWarning-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreWarning-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreWarning-'.$unique['unique']);
			$this->session->unset_userdata('CoreWarningToken-'.$unique['unique']);
			redirect('warning/add');
		}
		
		function addCoreWarning(){
			$unique 			= $this->session->userdata('unique');
			$warning_token		= $this->session->userdata('CoreWarningToken-'.$unique['unique']);

			if(empty($warning_token)){
				$warning_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreWarningToken-'.$unique['unique'], $warning_token);
			}

			$data['main_view']['content']		= 'CoreWarning/FormAddCoreWarning_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreWarning(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'warning_code' 				=> $this->input->post('warning_code',true),
				'warning_name' 				=> $this->input->post('warning_name',true),
				'warning_remark' 				=> $this->input->post('warning_remark',true),
				'warning_token' 			=> $this->input->post('warning_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$warning_token 			= $this->CoreWarning_model->getWarningToken($data['warning_token']);
			
			$this->form_validation->set_rules('warning_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('warning_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($warning_token == 0){
					if($this->CoreWarning_model->insertCoreWarning($data)){
						$warning_id 		= $this->CoreWarning_model->getWarningID($data['warning_id']);


						$this->fungsi->set_log($auth['user_id'], $warning_id, '3122', 'Application.CoreWarning.processAddCoreWarning', $warning_id, 'Add New Core Warning');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Warning Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreWarning-'.$unique['unique']);
						$this->session->unset_userdata('CoreWarningToken-'.$unique['unique']);
						redirect('warning/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Warning Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreWarning',$data);
						redirect('warning/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Warning Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('warning/add');
				}
			}else{
				$this->session->set_userdata('addCoreWarning',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('warning/add');
			}
		}
		
		function editCoreWarning(){
			$warning_id 							= $this->uri->segment(3);
			$data['main_view']['corewarning']		= $this->CoreWarning_model->getCoreWarning_Detail($warning_id);
			$data['main_view']['content']		= 'CoreWarning/FormEditCoreWarning_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$warning_id	= $this->uri->segment(3);

			redirect('warning/edit/'.$warning_id);
		}
		
		function processEditCoreWarning(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'warning_id' 				=> $this->input->post('warning_id',true),
				'warning_code' 			=> $this->input->post('warning_code',true),
				'warning_name' 			=> $this->input->post('warning_name',true),
				'warning_remark' 			=> $this->input->post('warning_remark',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('warning_code', 'Warning Code', 'required');
			$this->form_validation->set_rules('warning_name', 'Warning Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreWarning_model->updateCoreWarning($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['warning_id'], '3122', 'Application.CoreWarning.processEditCoreWarning', $data['warning_id'], 'Edit Core Warning');


					$msg = "<div class='alert alert-success'>                
								Edit Data Warning Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('warning/edit/'.$data['warning_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Warning Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('warning/edit/'.$data['warning_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('warning/edit/'.$data['warning_id']);
			}
		}
		
				
		function deleteCoreWarning(){
			$auth 			= $this->session->userdata('auth');
			$warning_id 	= $this->uri->segment(3);

			$data = array(
				'warning_id' 		=> $warning_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreWarning_model->deleteCoreWarning($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['warning_id'], '3122', 'Application.CoreWarning.deleteCoreWarning', $data['warning_id'], 'Delete Core Warning');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Warning Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('warning');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Warning Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('warning');
			}
		}
	}
?>