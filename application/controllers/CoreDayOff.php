<?php
	Class CoreDayOff extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'day-off';

			$this->cekLogin();
			$this->accessMenu($menu);
			
			$this->load->model('MainPage_model');
			$this->load->model('CoreDayOff_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreDayOff-'.$unique['unique']);
			$this->session->unset_userdata('CoreDayOffToken-'.$unique['unique']);

			$data['main_view']['coredayoff']		= $this->CoreDayOff_model->getCoreDayOff();
			$data['main_view']['content']			= 'CoreDayOff/ListCoreDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreDayOff-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreDayOff-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreDayOff-'.$unique['unique']);
			$this->session->unset_userdata('CoreDayOffToken-'.$unique['unique']);
			redirect('day-off/add');
		}
		
		function addCoreDayOff(){
			$unique 			= $this->session->userdata('unique');
			$dayoff_token		= $this->session->userdata('CoreDayOffToken-'.$unique['unique']);

			if(empty($dayoff_token)){
				$dayoff_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreDayOffToken-'.$unique['unique'], $dayoff_token);
			}

			$data['main_view']['content']		= 'CoreDayOff/FormAddCoreDayOff_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processAddCoreDayOff(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'dayoff_code' 				=> $this->input->post('dayoff_code',true),
				'dayoff_name' 				=> $this->input->post('dayoff_name',true),
				'dayoff_token' 				=> $this->input->post('dayoff_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			$dayoff_token 			= $this->CoreDayOff_model->getDayOffToken($data['dayoff_token']);
			
			$this->form_validation->set_rules('dayoff_code', 'Kode Libur', 'required');
			$this->form_validation->set_rules('dayoff_name', 'Nama Libur', 'required');


			if($this->form_validation->run()==true){
				if ($dayoff_token == 0){
					if($this->CoreDayOff_model->insertCoreDayOff($data)){
						$dayoff_id 		= $this->CoreDayOff_model->getDayOffID($data['dayoff_id']);


						$this->fungsi->set_log($auth['user_id'], $dayoff_id, '3122', 'Application.CoreDayOff.processAddCoreDayOff', $dayoff_id, 'Add New Core DayOff');

						$msg = "<div class='alert alert-success'>                
									Tambah Data DayOff Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreDayOff-'.$unique['unique']);
						$this->session->unset_userdata('CoreDayOffToken-'.$unique['unique']);
						redirect('day-off/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data DayOff Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreDayOff',$data);
						redirect('day-off/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data DayOff Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('day-off/add');
				}
			}else{
				$this->session->set_userdata('addCoreDayOff',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('day-off/add');
			}
		}
		
		function editCoreDayOff(){
			$dayoff_id	= $this->uri->segment(3);
			$data['main_view']['coredayoff']		= $this->CoreDayOff_model->getCoreDayOff_Detail($dayoff_id);
			$data['main_view']['content']			= 'CoreDayOff/FormEditCoreDayOff_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$dayoff_id	= $this->uri->segment(3);

			redirect('day-off/edit/'.$dayoff_id);
		}
		
		function processEditCoreDayOff(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'dayoff_id' 			=> $this->input->post('dayoff_id',true),
				'dayoff_code' 			=> $this->input->post('dayoff_code',true),
				'dayoff_name' 			=> $this->input->post('dayoff_name',true),
				'updated_id' 			=> $auth['user_id'],
				'updated_on' 			=> date("Y-m-d H:i:s"),
			);
			
			$this->form_validation->set_rules('dayoff_code', 'DayOff Code', 'required');
			$this->form_validation->set_rules('dayoff_name', 'DayOff Name', 'required');


			if($this->form_validation->run()==true){
				if($this->CoreDayOff_model->updateCoreDayOff($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['dayoff_id'], '3122', 'Application.CoreDayOff.processEditCoreDayOff', $data['dayoff_id'], 'Edit Core DayOff');


					$msg = "<div class='alert alert-success'>                
								Edit Data DayOff Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('day-off/edit/'.$data['dayoff_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data DayOff Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('day-off/edit/'.$data['dayoff_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('day-off/edit/'.$data['dayoff_id']);
			}
		}
		
				
		function deleteCoreDayOff(){
			$auth 			= $this->session->userdata('auth');
			$dayoff_id 	= $this->uri->segment(3);

			$data = array(
				'dayoff_id' 		=> $dayoff_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreDayOff_model->deleteCoreDayOff($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['dayoff_id'], '3122', 'Application.CoreDayOff.deleteCoreDayOff', $data['dayoff_id'], 'Delete Core DayOff');

				$msg = "<div class='alert alert-success'>                
							Hapus Data DayOff Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('day-off');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data DayOff Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('day-off');
			}
		}
	}
?>