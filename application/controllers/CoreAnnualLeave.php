<?php
	Class CoreAnnualLeave extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu	= 'annual-leave';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreAnnualLeave_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreAnnualLeave-'.$unique['unique']);
			$this->session->unset_userdata('CoreAnnualLeaveToken-'.$unique['unique']);

			$data['main_view']['coreannualleave']		= $this->CoreAnnualLeave_model->getCoreAnnualLeave();
			$data['main_view']['annualleavetype']		= $this->configuration->AnnualLeaveType();	
			$data['main_view']['content']				= 'CoreAnnualLeave/ListCoreAnnualLeave_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreAnnualLeave(){
			$unique 				= $this->session->userdata('unique');
			$annual_leave_token		= $this->session->userdata('CoreAnnualLeaveToken-'.$unique['unique']);

			if(empty($annual_leave_token)){
				$annual_leave_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreAnnualLeaveToken-'.$unique['unique'], $annual_leave_token);
			}
			$data['main_view']['content']				= 'CoreAnnualLeave/FormAddCoreAnnualLeave_view';

			$data['main_view']['annualleavetype']		= $this->configuration->AnnualLeaveType();			

			$data['main_view']['includedayoff']			= $this->configuration->IncludeDayOff();			

			$this->load->view('MainPage_view',$data);
		}
		

		function processAddCoreAnnualLeave(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'annual_leave_code' 		=> $this->input->post('annual_leave_code',true),
				'annual_leave_name' 		=> $this->input->post('annual_leave_name',true),
				'annual_leave_days' 		=> $this->input->post('annual_leave_days',true),
				'annual_leave_type' 		=> $this->input->post('annual_leave_type',true),
				'annual_leave_remark' 		=> $this->input->post('annual_leave_remark',true),
				'annual_leave_token' 			=> $this->input->post('annual_leave_token',true),
				'created_id' 				=> $auth['user_id'],
				'created_on' 				=> date("Y-m-d H:i:s"),
				'data_state'				=> 0
			);

			// print_r("data ");
			// print_r($data);
			// exit;

			$annual_leave_token 			= $this->CoreAnnualLeave_model->getAnnualLeaveToken($data['annual_leave_token']);
			
			$this->form_validation->set_rules('annual_leave_code', 'Kode Cabang', 'required');
			$this->form_validation->set_rules('annual_leave_name', 'Nama Cabang', 'required');


			if($this->form_validation->run()==true){
				if ($annual_leave_token == 0){
					if($this->CoreAnnualLeave_model->insertCoreAnnualLeave($data)){
						$annual_leave_id 		= $this->CoreAnnualLeave_model->getAnnualLeaveID($data['annual_leave_id']);


						$this->fungsi->set_log($auth['user_id'], $annual_leave_id, '3122', 'Application.CoreAnnualLeave.processAddCoreAnnualLeave', $annual_leave_id, 'Add New Core AnnualLeave');

						$msg = "<div class='alert alert-success'>                
									Tambah Data AnnualLeave Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreAnnualLeave-'.$unique['unique']);
						$this->session->unset_userdata('CoreAnnualLeaveToken-'.$unique['unique']);
						redirect('annual-leave/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data AnnualLeave Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreAnnualLeave',$data);
						redirect('annual-leave/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data AnnualLeave Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('annual-leave/add');
				}
			}else{
				$this->session->set_userdata('addCoreAnnualLeave',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('annual-leave/add');
			}
		}
		
		public function editCoreAnnualLeave(){
			$annual_leave_id = $this->uri->segment(3);

			$data['main_view']['coreannualleave']		= $this->CoreAnnualLeave_model->getCoreAnnualLeave_Detail($annual_leave_id);

			$data['main_view']['annualleavetype']		= $this->configuration->AnnualLeaveType();			

			$data['main_view']['includedayoff']			= $this->configuration->IncludeDayOff();			

			$data['main_view']['content']				= 'CoreAnnualLeave/formeditCoreAnnualLeave_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreAnnualLeave(){
			$auth 		= $this->session->userdata('auth');

			$data = array(
				'annual_leave_id' 			=> $this->input->post('annual_leave_id',true),
				'annual_leave_code' 		=> $this->input->post('annual_leave_code',true),
				'annual_leave_name' 		=> $this->input->post('annual_leave_name',true),
				'annual_leave_days' 		=> $this->input->post('annual_leave_days',true),
				'annual_leave_type' 		=> $this->input->post('annual_leave_type',true),
				'annual_leave_remark' 		=> $this->input->post('annual_leave_remark',true),
				'updated_id' 				=> $auth['user_id'],
				'updated_on' 				=> date("Y-m-d H:i:s"),
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('annual_leave_code', 'Annual Leave Code', 'required');
			$this->form_validation->set_rules('annual_leave_name', 'Annual Leave Name', 'required');
			$this->form_validation->set_rules('annual_leave_days', 'Annual Leave Days', 'required');
			$this->form_validation->set_rules('annual_leave_type', 'Annual Leave Type', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreAnnualLeave_model->updateCoreAnnualLeave($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['annual_leave_id'], '3122', 'Application.CoreAnnualLeave.processEditCoreAnnualLeave', $data['annual_leave_id'], 'Edit Core AnnualLeave');


					$msg = "<div class='alert alert-success'>                
								Edit Data AnnualLeave Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('annual-leave/edit/'.$data['annual_leave_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data AnnualLeave Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('annual-leave/edit/'.$data['annual_leave_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('annual-leave/edit/'.$data['annual_leave_id']);
			}
		}
				
		function deleteCoreAnnualLeave(){
			$auth 			= $this->session->userdata('auth');
			$annual_leave_id 	= $this->uri->segment(3);

			$data = array(
				'annual_leave_id' 	=> $annual_leave_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreAnnualLeave_model->deleteCoreAnnualLeave($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['annual_leave_id'], '3122', 'Application.CoreAnnualLeave.deleteCoreAnnualLeave', $data['annual_leave_id'], 'Delete Core AnnualLeave');

				$msg = "<div class='alert alert-success'>                
							Hapus Data AnnualLeave Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('annual-leave');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data AnnualLeave Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('annual-leave');
			}
		}
	}
?>