<?php
	Class CoreRegion extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'region';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreRegion_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreRegion-'.$unique['unique']);
			$this->session->unset_userdata('CoreRegionToken-'.$unique['unique']);

			$data['main_view']['coreregion']		= $this->CoreRegion_model->getCoreRegion();
			$data['main_view']['content']			= 'CoreRegion/ListCoreRegion_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreRegion-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreRegion-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreRegion-'.$unique['unique']);
			$this->session->unset_userdata('CoreRegionToken-'.$unique['unique']);
			redirect('region/add');
		}
		
		function addCoreRegion(){
			$unique 		= $this->session->userdata('unique');
			$region_token	= $this->session->userdata('CoreRegionToken-'.$unique['unique']);

			if(empty($region_token)){
				$region_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreRegionToken-'.$unique['unique'], $region_token);
			}

			$data['main_view']['content']		= 'CoreRegion/FormAddCoreRegion_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreRegion(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'region_code' 		=> $this->input->post('region_code',true),
				'region_name' 		=> $this->input->post('region_name',true),
				'region_token' 		=> $this->input->post('region_token',true),
				'created_id' 		=> $auth['user_id'],
				'created_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 0
			);

			$region_token 			= $this->CoreRegion_model->getRegionToken($data['region_token']);
			
			$this->form_validation->set_rules('region_code', 'Region Code', 'required');
			$this->form_validation->set_rules('region_name', 'Region Name', 'required');


			if($this->form_validation->run()==true){
				if ($region_token == 0){
					if($this->CoreRegion_model->insertCoreRegion($data)){
						$region_id 		= $this->CoreRegion_model->getRegionID($data['region_id']);


						$this->fungsi->set_log($auth['user_id'], $region_id, '3122', 'Application.CoreRegion.processAddCoreRegion', $region_id, 'Add New Core Region');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Wilayah Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreRegion-'.$unique['unique']);
						$this->session->unset_userdata('CoreRegionToken-'.$unique['unique']);
						redirect('region/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Wilayah Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreRegion',$data);
						redirect('region/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Wilayah Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('region/add');
				}
			}else{
				$this->session->set_userdata('addCoreRegion',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('region/add');
			}
		}
		
		function editCoreRegion(){
			$region_id 							= $this->uri->segment(3);
			$data['main_view']['coreregion']	= $this->CoreRegion_model->getCoreRegion_Detail($region_id);
			$data['main_view']['content']		= 'CoreRegion/FormEditCoreRegion_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$region_id	= $this->uri->segment(3);

			redirect('region/edit/'.$region_id);
		}
		
		function processEditCoreRegion(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'region_id' 		=> $this->input->post('region_id',true),
				'region_code' 		=> $this->input->post('region_code',true),
				'region_name' 		=> $this->input->post('region_name',true),
				'updated_id' 		=> $auth['user_id'],
				'updated_on' 		=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('region_code', 'Region Code', 'required');
			$this->form_validation->set_rules('region_name', 'Region Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreRegion_model->updateCoreRegion($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['region_id'], '3122', 'Application.CoreRegion.processEditCoreRegion', $data['region_id'], 'Edit Core Region');


					$msg = "<div class='alert alert-success'>                
								Edit Data Wilayah Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('region/edit/'.$data['region_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Wilayah Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('region/edit/'.$data['region_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('region/edit/'.$data['region_id']);
			}
		}
		
				
		function deleteCoreRegion(){
			$auth 		= $this->session->userdata('auth');
			$region_id 	= $this->uri->segment(3);

			$data = array(
				'region_id' 		=> $region_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreRegion_model->deleteCoreRegion($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['region_id'], '3122', 'Application.CoreRegion.deleteCoreRegion', $data['region_id'], 'Delete Core Region');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Wilayah Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('region');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Wilayah Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('region');
			}
		}
	}
?>