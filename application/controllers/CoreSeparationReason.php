<?php
	Class CoreSeparationReason extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'separation-reason';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreSeparationReason_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSeparationReason-'.$unique['unique']);
			$this->session->unset_userdata('CoreSeparationReasonToken-'.$unique['unique']);
			
			$data['main_view']['coreseparationreason']		= $this->CoreSeparationReason_model->getCoreSeparationReason();
			$data['main_view']['content']					= 'CoreSeparationReason/ListCoreSeparationReason_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addCoreSeparationReason(){
			$unique 						= $this->session->userdata('unique');
			$separation_reason_token		= $this->session->userdata('CoreSeparationReasonToken-'.$unique['unique']);

			if(empty($separation_reason_token)){
				$separation_reason_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreSeparationReasonToken-'.$unique['unique'], $separation_reason_token);
			}
			$data['main_view']['content']					= 'CoreSeparationReason/FormAddCoreSeparationReason_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSeparationReason-'.$unique['unique']);			
			redirect('separation-reason/add');
		}
		
		function processAddCoreSeparationReason(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'separation_reason_name' 				=> $this->input->post('separation_reason_name',true),
				'separation_reason_token' 				=> $this->input->post('separation_reason_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$separation_reason_token 			= $this->CoreSeparationReason_model->getSeparationReasonToken($data['separation_reason_token']);
			
			$this->form_validation->set_rules('separation_reason_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($separation_reason_token == 0){
					if($this->CoreSeparationReason_model->insertCoreSeparationReason($data)){
						$separation_reason_id 		= $this->CoreSeparationReason_model->getSeparationReasonID($data['separation_reason_id']);


						$this->fungsi->set_log($auth['user_id'], $separation_reason_id, '3122', 'Application.CoreSeparationReason.processAddCoreSeparationReason', $separation_reason_id, 'Add New Core SeparationReason');

						$msg = "<div class='alert alert-success'>                
									Tambah Data SeparationReason Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreSeparationReason-'.$unique['unique']);
						$this->session->unset_userdata('CoreSeparationReasonToken-'.$unique['unique']);
						redirect('separation-reason');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data SeparationReason Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreSeparationReason',$data);
						redirect('separation-reason/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data SeparationReason Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('separation-reason/add');
				}
			}else{
				$this->session->set_userdata('addCoreSeparationReason',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('separation-reason/add');
			}
		}

		public function reset_edit(){
			$separation_reason_id = $this->uri->segment(3);
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreSeparationReason-'.$unique['unique']);			
			redirect('separation-reason/edit/'.$separation_reason_id);
		}

		function editCoreSeparationReason(){
			$data['main_view']['coreseparationreason']		= $this->CoreSeparationReason_model->getCoreSeparationReason_Detail($this->uri->segment(3));
			$data['main_view']['content']					= 'CoreSeparationReason/formeditCoreSeparationReason_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processEditCoreSeparationReason(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'separation_reason_id' 				=> $this->input->post('separation_reason_id',true),
				'separation_reason_name' 			=> $this->input->post('separation_reason_name',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('separation_reason_name', 'SeparationReason Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreSeparationReason_model->updateCoreSeparationReason($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['separation_reason_id'], '3122', 'Application.CoreSeparationReason.processEditCoreSeparationReason', $data['separation_reason_id'], 'Edit Core SeparationReason');


					$msg = "<div class='alert alert-success'>                
								Edit Data SeparationReason Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('separation-reason');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data SeparationReason Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('separation-reason/edit/'.$data['separation_reason_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('separation-reason/edit/'.$data['separation_reason_id']);
			}
		}
		
				
		function deleteCoreSeparationReason(){
			$auth 			= $this->session->userdata('auth');
			$separation_reason_id 	= $this->uri->segment(3);

			$data = array(
				'separation_reason_id' 		=> $separation_reason_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreSeparationReason_model->deleteCoreSeparationReason($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['separation_reason_id'], '3122', 'Application.CoreSeparationReason.deleteCoreSeparationReason', $data['separation_reason_id'], 'Delete Core SeparationReason');

				$msg = "<div class='alert alert-success'>                
							Hapus Data SeparationReason Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('separation-reason');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data SeparationReason Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('separation-reason');
			}
		}
	}
?>