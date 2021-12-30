<?php
	Class CoreUnit extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'unit';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreUnit_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}

		public function index(){
			$data['main_view']['CoreUnit']		= $this->CoreUnit_model->getCoreUnit();
			$data['main_view']['content']		= 'CoreUnit/listCoreUnit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreUnit(){
			$unique 			= $this->session->userdata('unique');
			$unit_token		= $this->session->userdata('CoreUnitToken-'.$unique['unique']);

			if(empty($unit_token)){
				$unit_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreUnitToken-'.$unique['unique'], $unit_token);
			}

			$data['main_view']['coresection']	= create_double($this->CoreUnit_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['content']		= 'CoreUnit/FormAddCoreUnit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreUnit(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'section_id' 				=> $this->input->post('section_id',true),
				'unit_code' 			=> $this->input->post('unit_code',true),
				'unit_name' 			=> $this->input->post('unit_name',true),
				'unit_token' 			=> $this->input->post('unit_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$unit_token 			= $this->CoreUnit_model->getUnitToken($data['unit_token']);
			
			$this->form_validation->set_rules('section_id', 'Nama Devisi', 'required');
			$this->form_validation->set_rules('unit_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('unit_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($unit_token == 0){
					if($this->CoreUnit_model->insertCoreUnit($data)){
						$unit_id 		= $this->CoreUnit_model->getUnitID($data['unit_id']);


						$this->fungsi->set_log($auth['user_id'], $unit_id, '3122', 'Application.CoreUnit.processAddCoreUnit', $unit_id, 'Add New Core Unit');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Unit Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreUnit-'.$unique['unique']);
						$this->session->unset_userdata('CoreUnitToken-'.$unique['unique']);
						redirect('unit/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Unit Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreUnit',$data);
						redirect('unit/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Unit Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('unit/add');
				}
			}else{
				$this->session->set_userdata('addCoreUnit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('unit/add');
			}
		}
		
		public function editCoreUnit(){
			$unit_id 							= $this->uri->segment(3);
			$data['main_view']['coresection']	= create_double($this->CoreUnit_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['coreunit']		= $this->CoreUnit_model->getCoreUnit_Detail($unit_id);
			$data['main_view']['content']		= 'CoreUnit/FormEditCoreUnit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_edit(){
			$unique 		= $this->session->userdata('unique');
			$unit_id		= $this->uri->segment(3);

			redirect('unit/edit/'.$unit_id);
		}
		
		function processEditCoreUnit(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'unit_id' 			=> $this->input->post('unit_id',true),
				'section_id' 		=> $this->input->post('section_id',true),
				'unit_code' 			=> $this->input->post('unit_code',true),
				'unit_name' 			=> $this->input->post('unit_name',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('section_id', 'Nama Department', 'required');
			$this->form_validation->set_rules('unit_code', 'Unit Code', 'required');
			$this->form_validation->set_rules('unit_name', 'Unit Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreUnit_model->updateCoreUnit($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['unit_id'], '3122', 'Application.CoreUnit.processEditCoreUnit', $data['unit_id'], 'Edit Core Unit');


					$msg = "<div class='alert alert-success'>                
								Edit Data Unit Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('unit/edit/'.$data['unit_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Unit Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('unit/edit/'.$data['unit_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('unit/edit/'.$data['unit_id']);
			}
		}

		function deleteCoreUnit(){
			$auth 			= $this->session->userdata('auth');
			$unit_id 	= $this->uri->segment(3);

			$data = array(
				'unit_id' 			=> $unit_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreUnit_model->deleteCoreUnit($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['unit_id'], '3122', 'Application.CoreUnit.deleteCoreUnit', $data['unit_id'], 'Delete Core Unit');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Unit Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('unit');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Unit Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('unit');
			}
		}
	}
?>