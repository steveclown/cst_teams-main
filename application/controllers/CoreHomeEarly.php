<?php
	Class CoreHomeEarly extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'home-early';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreHomeEarly_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreHomeEarly-'.$unique['unique']);
			$this->session->unset_userdata('CoreHomeEarlyToken-'.$unique['unique']);

			$data['main_view']['corehomeearly']		= $this->CoreHomeEarly_model->getCoreHomeEarly();
			$data['main_view']['content']			= 'CoreHomeEarly/listCoreHomeEarly_view';
			$this->load->view('Mainpage_view',$data);
		}
		
		function addCoreHomeEarly(){
			$unique 			= $this->session->userdata('unique');
			$home_early_token		= $this->session->userdata('CoreHomeEarlyToken-'.$unique['unique']);

			if(empty($home_early_token)){
				$home_early_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreHomeEarlyToken-'.$unique['unique'], $home_early_token);
			}

			$data['main_view']['corededuction']		= create_double($this->CoreHomeEarly_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['content']		= 'CoreHomeEarly/FormAddCoreHomeEarly_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreHomeEarly-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreHomeEarly-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreHomeEarly-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreHomeEarly-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreHomeEarly-'.$sesi['unique']);	
			redirect('home-early/add');
		}
		
		function processAddCoreHomeEarly(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'home_early_code' 				=> $this->input->post('home_early_code',true),
				'home_early_name' 				=> $this->input->post('home_early_name',true),
				'deduction_id' 				=> $this->input->post('deduction_id',true),
				'home_early_token' 				=> $this->input->post('home_early_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$home_early_token 			= $this->CoreHomeEarly_model->getHomeEarlyToken($data['home_early_token']);
			
			$this->form_validation->set_rules('home_early_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('home_early_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($home_early_token == 0){
					if($this->CoreHomeEarly_model->insertCoreHomeEarly($data)){
						$home_early_id 		= $this->CoreHomeEarly_model->getHomeEarlyID($data['home_early_id']);


						$this->fungsi->set_log($auth['user_id'], $home_early_id, '3122', 'Application.CoreHomeEarly.processAddCoreHomeEarly', $home_early_id, 'Add New Core HomeEarly');

						$msg = "<div class='alert alert-success'>                
									Tambah Data HomeEarly Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreHomeEarly-'.$unique['unique']);
						$this->session->unset_userdata('CoreHomeEarlyToken-'.$unique['unique']);
						redirect('home-early/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data HomeEarly Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreHomeEarly',$data);
						redirect('home-early/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data HomeEarly Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('home-early/add');
				}
			}else{
				$this->session->set_userdata('addCoreHomeEarly',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('home-early/add');
			}
		}
		
		public function editCoreHomeEarly(){
			$home_early_id = $this->uri->segment(3);
			$data['main_view']['corededuction']		= create_double($this->CoreHomeEarly_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['main_view']['corehomeearly']		= $this->CoreHomeEarly_model->getCoreHomeEarly_Detail($home_early_id);
			$data['main_view']['content']			= 'CoreHomeEarly/formeditCoreHomeEarly_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$home_early_id	= $this->uri->segment(3);

			redirect('home-early/edit/'.$home_early_id);
		}
		
		function processEditCoreHomeEarly(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'home_early_id' 				=> $this->input->post('home_early_id',true),
				'home_early_code' 			=> $this->input->post('home_early_code',true),
				'home_early_name' 			=> $this->input->post('home_early_name',true),
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('home_early_code', 'HomeEarly Code', 'required');
			$this->form_validation->set_rules('home_early_name', 'HomeEarly Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreHomeEarly_model->updateCoreHomeEarly($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['home_early_id'], '3122', 'Application.CoreHomeEarly.processEditCoreHomeEarly', $data['home_early_id'], 'Edit Core HomeEarly');


					$msg = "<div class='alert alert-success'>                
								Edit Data HomeEarly Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('home-early/edit/'.$data['home_early_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data HomeEarly Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('home-early/edit/'.$data['home_early_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('home-early/edit/'.$data['home_early_id']);
			}
		}
		
				
		function deleteCoreHomeEarly(){
			$auth 			= $this->session->userdata('auth');
			$home_early_id 	= $this->uri->segment(3);

			$data = array(
				'home_early_id' 		=> $home_early_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreHomeEarly_model->deleteCoreHomeEarly($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['home_early_id'], '3122', 'Application.CoreHomeEarly.deleteCoreHomeEarly', $data['home_early_id'], 'Delete Core HomeEarly');

				$msg = "<div class='alert alert-success'>                
							Hapus Data HomeEarly Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('home-early');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data HomeEarly Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('home-early');
			}
		}
	}
?>