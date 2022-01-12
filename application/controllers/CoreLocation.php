<?php
	Class CoreLocation extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'location';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreLocation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreLocation-'.$unique['unique']);
			$this->session->unset_userdata('CoreLocationToken-'.$unique['unique']);

			$data['main_view']['corelocation']	= $this->CoreLocation_model->getCoreLocation();
			$data['main_view']['content']			= 'CoreLocation/ListCoreLocation_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLocation-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreLocation-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreLocation-'.$unique['unique']);
			$this->session->unset_userdata('CoreLocationToken-'.$unique['unique']);
			redirect('location/add');
		}
		
		function addCoreLocation(){
			$unique 			= $this->session->userdata('unique');
			$location_token	= $this->session->userdata('CoreLocationToken-'.$unique['unique']);

			if(empty($location_token)){
				$location_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreLocationToken-'.$unique['unique'], $location_token);
			}

			$data['main_view']['corebranch']	= create_double($this->CoreLocation_model->getCoreBranch(),'branch_id','branch_name');

			$data['main_view']['content']		= 'CoreLocation/FormAddCoreLocation_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreLocation(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'branch_id' 				=> $this->input->post('branch_id',true),
				'location_code' 			=> $this->input->post('location_code',true),
				'location_name' 			=> $this->input->post('location_name',true),
				'location_token' 			=> $this->input->post('location_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$location_token 			= $this->CoreLocation_model->getLocationToken($data['location_token']);
			
			$this->form_validation->set_rules('branch_id', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('location_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('location_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($location_token == 0){
					if($this->CoreLocation_model->insertCoreLocation($data)){
						$location_id 		= $this->CoreLocation_model->getLocationID($data['location_id']);


						$this->fungsi->set_log($auth['user_id'], $location_id, '3122', 'Application.CoreLocation.processAddCoreLocation', $location_id, 'Add New Core Location');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Location Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreLocation-'.$unique['unique']);
						$this->session->unset_userdata('CoreLocationToken-'.$unique['unique']);
						redirect('location/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Location Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreLocation',$data);
						redirect('location/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Location Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('location/add');
				}
			}else{
				$this->session->set_userdata('addCoreLocation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('location/add');
			}
		}
		
		function editCoreLocation(){
			$location_id 							= $this->uri->segment(3);
			$data['main_view']['corebranch']		= create_double($this->CoreLocation_model->getCoreBranch(),'branch_id','branch_name');
			$data['main_view']['corelocation']	= $this->CoreLocation_model->getCoreLocation_Detail($location_id);
			$data['main_view']['content']			= 'CoreLocation/FormEditCoreLocation_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 		= $this->session->userdata('unique');
			$location_id	= $this->uri->segment(3);

			redirect('location/edit/'.$location_id);
		}
		
		function processEditCoreLocation(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'location_id' 			=> $this->input->post('location_id',true),
				'branch_id' 				=> $this->input->post('branch_id',true),
				'location_code' 			=> $this->input->post('location_code',true),
				'location_name' 			=> $this->input->post('location_name',true),
				'updated_id' 				=> $auth['user_id'],
				'updated_on' 				=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('branch_id', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('location_code', 'Location Code', 'required');
			$this->form_validation->set_rules('location_name', 'Location Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreLocation_model->updateCoreLocation($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['location_id'], '3122', 'Application.CoreLocation.processEditCoreLocation', $data['location_id'], 'Edit Core Location');


					$msg = "<div class='alert alert-success'>                
								Edit Data Location Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('location/edit/'.$data['location_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Location Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('location/edit/'.$data['location_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('location/edit/'.$data['location_id']);
			}
		}
		
				
		function deleteCoreLocation(){
			$auth 			= $this->session->userdata('auth');
			$location_id 	= $this->uri->segment(3);

			$data = array(
				'location_id' 	=> $location_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreLocation_model->deleteCoreLocation($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['location_id'], '3122', 'Application.CoreLocation.deleteCoreLocation', $data['location_id'], 'Delete Core Location');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Location Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('location');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Location Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('location');
			}
		}
	}
?>