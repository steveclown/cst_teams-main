<?php
	Class CoreEducation extends MY_Controller{
		public function __construct(){
			parent::__construct();
			
			$menu	= 'education';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreEducation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){

			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreEducation-'.$unique['unique']);
			$this->session->unset_userdata('CoreEducationToken-'.$unique['unique']);
			
			$data['main_view']['coreeducation']		= $this->CoreEducation_model->getCoreEducation();
			$data['main_view']['coreeducationtype']	= $this->configuration->EducationType();
			$data['main_view']['content']			= 'CoreEducation/listCoreEducation_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreEducation(){
			$unique 			= $this->session->userdata('unique');
			$education_token		= $this->session->userdata('CoreEducationToken-'.$unique['unique']);

			if(empty($education_token)){
				$education_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreEducationToken-'.$unique['unique'], $education_token);
			}

			$data['main_view']['content']				= 'CoreEducation/FormAddCoreEducation_view';
			$data['main_view']['coreeducationtype']		= $this->configuration->EducationType();
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreEducation(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'education_code' 			=> $this->input->post('education_code',true),
				'education_name' 			=> $this->input->post('education_name',true),
				'education_type' 			=> $this->input->post('education_type',true),
				'education_remark' 			=> $this->input->post('education_remark',true),
				'education_token' 			=> $this->input->post('education_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			// print_r("data ");
			// print_r($data);
			// exit;

			$education_token 			= $this->CoreEducation_model->getEducationToken($data['education_token']);
			
			$this->form_validation->set_rules('education_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('education_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($education_token == 0){
					if($this->CoreEducation_model->insertCoreEducation($data)){
						$education_id 		= $this->CoreEducation_model->getEducationID($data['education_id']);


						$this->fungsi->set_log($auth['user_id'], $education_id, '3122', 'Application.CoreEducation.processAddCoreEducation', $education_id, 'Add New Core Education');

						$msg = "<div class='alert alert-success'>                
									Tambah Data Education Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreEducation-'.$unique['unique']);
						$this->session->unset_userdata('CoreEducationToken-'.$unique['unique']);
						redirect('education/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data Education Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreEducation',$data);
						redirect('education/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data Education Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('education/add');
				}
			}else{
				$this->session->set_userdata('addCoreEducation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('education/add');
			}
		}
		
		function editCoreEducation(){
			$data['main_view']['coreeducation']		= $this->CoreEducation_model->getCoreEducation_Detail($this->uri->segment(3));
			$data['main_view']['content']			= 'CoreEducation/formeditCoreEducation_view';
			$data['main_view']['coreeducationtype']	= $this->configuration->EducationType();
			$this->load->view('MainPage_view',$data);
		}
		
		public function reset_edit(){
			$unique 		= $this->session->userdata('unique');
			$education_id	= $this->uri->segment(3);

			redirect('education/edit/'.$education_id);
		}
		
		function processEditCoreEducation(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'education_id' 			=> $this->input->post('education_id',true),
				'education_code' 		=> $this->input->post('education_code',true),
				'education_name' 		=> $this->input->post('education_name',true),
				'education_type' 		=> $this->input->post('education_type',true),
				'education_remark' 		=> $this->input->post('education_remark',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('education_code', 'Education Code', 'required');
			$this->form_validation->set_rules('education_name', 'Education Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreEducation_model->updateCoreEducation($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['education_id'], '3122', 'Application.CoreEducation.processEditCoreEducation', $data['education_id'], 'Edit Core Education');


					$msg = "<div class='alert alert-success'>                
								Edit Data Education Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('education/edit/'.$data['education_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Education Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('education/edit/'.$data['education_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('education/edit/'.$data['education_id']);
			}
		}
		
				
		function deleteCoreEducation(){
			$auth 			= $this->session->userdata('auth');
			$education_id 	= $this->uri->segment(3);

			$data = array(
				'education_id' 		=> $education_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreEducation_model->deleteCoreEducation($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['education_id'], '3122', 'Application.CoreEducation.deleteCoreEducation', $data['education_id'], 'Delete Core Education');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Education Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('education');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Education Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('education');
			}
		}
	}
?>