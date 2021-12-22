<?php
	Class CoreBranch extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'branch';

			$this->cekLogin();
			$this->accessMenu($menu); 

			$this->load->model('MainPage_model');
			$this->load->model('CoreBranch_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreBranch-'.$unique['unique']);
			$this->session->unset_userdata('CoreBranchToken-'.$unique['unique']);

			$data['main_view']['corebranch']		= $this->CoreBranch_model->getCoreBranch();
			$data['main_view']['content']			= 'CoreBranch/ListCoreBranch_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreBranch-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreBranch-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreBranch-'.$unique['unique']);
			$this->session->unset_userdata('CoreBranchToken-'.$unique['unique']);
			redirect('branch/add');
		}
		
		function addCoreBranch(){
			$unique 		= $this->session->userdata('unique');
			$branch_token	= $this->session->userdata('CoreBranchToken-'.$unique['unique']);

			if(empty($branch_token)){
				$branch_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreBranchToken-'.$unique['unique'], $branch_token);
			}

			// dropdown ambil data dari table region
			$data['main_view']['coreregion']		= create_double($this->CoreBranch_model->getCoreRegion(),'region_id','region_name');

			$data['main_view']['content']		= 'CoreBranch/FormAddCoreBranch_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreBranch(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'region_id' 			=> $this->input->post('region_id',true),
				'branch_code' 			=> $this->input->post('branch_code',true),
				'branch_name' 			=> $this->input->post('branch_name',true),
				'branch_address' 		=> $this->input->post('branch_address',true),
				'branch_contact_person'	=> $this->input->post('branch_contact_person',true),
				'branch_phone1' 		=> $this->input->post('branch_phone1',true),
				'branch_phone2' 		=> $this->input->post('branch_phone2',true),
				'branch_email' 			=> $this->input->post('branch_email',true),
				'branch_token' 			=> $this->input->post('branch_token',true),
				'created_id' 			=> $auth['user_id'],
				'created_on' 			=> date("Y-m-d H:i:s"),
				'data_state'			=> 0
			);

			$branch_token 			= $this->CoreBranch_model->getBranchToken($data['branch_token']);
			
			$this->form_validation->set_rules('region_id', 'Nama Wilayah', 'required');
			$this->form_validation->set_rules('branch_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('branch_name', 'Nama Cabang', 'required');
			$this->form_validation->set_rules('branch_phone1', 'Nomor HP1 Harus Angka', 'trim|required|regex_match[/^[0-9]/]');
			$this->form_validation->set_rules('branch_phone2', 'Nomor HP2 Harus Angka', 'trim|required|regex_match[/^[0-9]/]');
			$this->form_validation->set_rules('branch_email', 'Format Email Salah', 'trim|required|valid_email');


			if($this->form_validation->run()==true){
				if ($branch_token == 0){
					if($this->CoreBranch_model->insertCoreBranch($data)){
						$branch_id 		= $this->CoreBranch_model->getBranchID($data['branch_id']);


						$this->fungsi->set_log($auth['user_id'], $branch_id, '3122', 'Application.CoreBranch.processAddCoreBranch', $branch_id, 'Add New Core Branch');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Wilayah Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreBranch-'.$unique['unique']);
						$this->session->unset_userdata('CoreBranchToken-'.$unique['unique']);
						redirect('branch/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Wilayah Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreBranch',$data);
						redirect('branch/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Wilayah Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('branch/add');
				}
			}else{
				$this->session->set_userdata('addCoreBranch',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('branch/add');
			}
		}
		
		function editCoreBranch(){
			$branch_id 							= $this->uri->segment(3);
			// dropdown ambil data dari table region
			$data['main_view']['coreregion']	= create_double($this->CoreBranch_model->getCoreRegion(),'region_id','region_name');
			$data['main_view']['corebranch']	= $this->CoreBranch_model->getCoreBranch_Detail($branch_id);
			$data['main_view']['content']		= 'CoreBranch/FormEditCoreBranch_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$branch_id	= $this->uri->segment(3);

			redirect('branch/edit/'.$branch_id);
		}
		
		function processEditCoreBranch(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'branch_id' 			=> $this->input->post('branch_id',true),
				'region_id' 			=> $this->input->post('region_id',true),
				'branch_code' 			=> $this->input->post('branch_code',true),
				'branch_name' 			=> $this->input->post('branch_name',true),
				'branch_address' 		=> $this->input->post('branch_address',true),
				'branch_contact_person' => $this->input->post('branch_contact_person',true),
				'branch_phone1' 		=> $this->input->post('branch_phone1',true),
				'branch_phone2' 		=> $this->input->post('branch_phone2',true),
				'branch_email' 			=> $this->input->post('branch_email',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('branch_code', 'Branch Code', 'required');
			$this->form_validation->set_rules('branch_name', 'Branch Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreBranch_model->updateCoreBranch($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['branch_id'], '3122', 'Application.CoreBranch.processEditCoreBranch', $data['branch_id'], 'Edit Core Branch');


					$msg = "<div class='alert alert-success'>                
								Edit Data Wilayah Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('branch/edit/'.$data['branch_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Wilayah Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('branch/edit/'.$data['branch_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('branch/edit/'.$data['branch_id']);
			}
		}
		
				
		function deleteCoreBranch(){
			$auth 		= $this->session->userdata('auth');
			$branch_id 	= $this->uri->segment(3);

			$data = array(
				'branch_id' 		=> $branch_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreBranch_model->deleteCoreBranch($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['branch_id'], '3122', 'Application.CoreBranch.deleteCoreBranch', $data['branch_id'], 'Delete Core Branch');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Wilayah Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('branch');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Wilayah Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('branch');
			}
		}
	}
?>