<?php
	Class CoreOvertimeType extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu	= 'overtime-type';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('CoreOvertimeType_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreOvertimeType-'.$unique['unique']);
			$this->session->unset_userdata('CoreOvertimeTypeToken-'.$unique['unique']);

			$data['main_view']['coreovertimetype']		= $this->CoreOvertimeType_model->getCoreOvertimeType();
			$data['main_view']['content']				= 'CoreOvertimeType/ListCoreOvertimeType_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreOvertimeType-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreOvertimeType-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addCoreOvertimeType-'.$unique['unique']);
			$this->session->unset_userdata('CoreOvertimeTypeToken-'.$unique['unique']);
			redirect('overtime-type/add');
		}
		
		function addCoreOvertimeType(){
			$unique 			= $this->session->userdata('unique');
			$overtime_type_token		= $this->session->userdata('CoreOvertimeTypeToken-'.$unique['unique']);

			if(empty($overtime_type_token)){
				$overtime_type_token = md5(date("YmdHis"));
				$this->session->set_userdata('CoreOvertimeTypeToken-'.$unique['unique'], $overtime_type_token);
			}

			$data['main_view']['content']		= 'CoreOvertimeType/FormAddCoreOvertimeType_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddCoreOvertimeType(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$data = array(
				'overtime_type_code' 					=> $this->input->post('overtime_type_code',true),
				'overtime_type_name' 					=> $this->input->post('overtime_type_name',true),
				'overtime_type_working_day_hour1' 		=> $this->input->post('overtime_type_working_day_hour1',true),
				'overtime_type_working_day_ratio1' 		=> $this->input->post('overtime_type_working_day_ratio1',true),
				'overtime_type_working_day_hour2' 		=> $this->input->post('overtime_type_working_day_hour2',true),
				'overtime_type_working_day_ratio2' 		=> $this->input->post('overtime_type_working_day_ratio2',true),
				'overtime_type_day_off_hour1' 			=> $this->input->post('overtime_type_day_off_hour1',true),
				'overtime_type_day_off_ratio1' 			=> $this->input->post('overtime_type_day_off_ratio1',true),
				'overtime_type_day_off_hour2' 			=> $this->input->post('overtime_type_day_off_hour2',true),
				'overtime_type_day_off_ratio2' 			=> $this->input->post('overtime_type_day_off_ratio2',true),
				'overtime_type_amount' 					=> $this->input->post('overtime_type_amount',true),
				'overtime_type_remark' 					=> $this->input->post('overtime_type_remark',true),
				'overtime_type_token' 					=> $this->input->post('overtime_type_token',true),
				'created_id' 							=> $auth['user_id'],
				'created_on' 							=> date("Y-m-d H:i:s"),
				'data_state'							=> 0
			);

			$overtime_type_token 			= $this->CoreOvertimeType_model->getOvertimeTypeToken($data['overtime_type_token']);
			
			$this->form_validation->set_rules('overtime_type_code', 'Overtime Type Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('overtime_type_name', 'Overtime Type Name', 'required');
			/*$this->form_validation->set_rules('overtime_type_working_day_hour1', 'Working Day Hour 1', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_ratio1', 'Working Day Ratio 1', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_hour2', 'Working Day Hour 2', 'required');
			$this->form_validation->set_rules('overtime_type_working_day_ratio2', 'Working Day Ratio 2', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_hour1', 'Day Off Hour 1', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_ratio1', 'Day Off Ratio 1', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_hour2', 'Day Off Hour 2', 'required');
			$this->form_validation->set_rules('overtime_type_day_off_ratio2', 'Day Off Ratio 2', 'required');*/

			if($this->form_validation->run()==true){
				if ($overtime_type_token == 0){
					if($this->CoreOvertimeType_model->insertCoreOvertimeType($data)){
						$overtime_type_id 		= $this->CoreOvertimeType_model->getOvertimeTypeID($data['overtime_type_id']);


						$this->fungsi->set_log($auth['user_id'], $overtime_type_id, '3122', 'Application.CoreOvertimeType.processAddCoreOvertimeType', $overtime_type_id, 'Add New Core OvertimeType');

						$msg = "<div class='alert alert-success'>                
									Tambah Data OvertimeType Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreOvertimeType-'.$unique['unique']);
						$this->session->unset_userdata('CoreOvertimeTypeToken-'.$unique['unique']);
						redirect('overtime-type/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data OvertimeType Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreOvertimeType',$data);
						redirect('overtime-type/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data OvertimeType Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('overtime-type/add');
				}
			}else{
				$this->session->set_userdata('addCoreOvertimeType',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('overtime-type/add');
			}
		}
		
		public function editCoreOvertimeType(){
			$overtime_type_id = $this->uri->segment(3);
			$data['main_view']['CoreOvertimeType']	= $this->CoreOvertimeType_model->getCoreOvertimeType_Detail($overtime_type_id);
			$data['main_view']['content']	= 'CoreOvertimeType/FormEditCoreOvertimeType_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$unique 	= $this->session->userdata('unique');
			$overtime_type_id	= $this->uri->segment(3);

			redirect('overtime-type/edit/'.$overtime_type_id);
		}
		
		function processEditCoreOvertimeType(){
			$auth 		= $this->session->userdata('auth');
	
				$data = array(
					'overtime_type_id' 						=> $this->input->post('overtime_type_id',true),
					'overtime_type_code' 					=> $this->input->post('overtime_type_code',true),
					'overtime_type_name' 					=> $this->input->post('overtime_type_name',true),
					'overtime_type_working_day_hour1' 		=> $this->input->post('overtime_type_working_day_hour1',true),
					'overtime_type_working_day_ratio1' 		=> $this->input->post('overtime_type_working_day_ratio1',true),
					'overtime_type_working_day_hour2' 		=> $this->input->post('overtime_type_working_day_hour2',true),
					'overtime_type_working_day_ratio2' 		=> $this->input->post('overtime_type_working_day_ratio2',true),
					'overtime_type_day_off_hour1' 			=> $this->input->post('overtime_type_day_off_hour1',true),
					'overtime_type_day_off_ratio1' 			=> $this->input->post('overtime_type_day_off_ratio1',true),
					'overtime_type_day_off_hour2' 			=> $this->input->post('overtime_type_day_off_hour2',true),
					'overtime_type_day_off_ratio2' 			=> $this->input->post('overtime_type_day_off_ratio2',true),
					'overtime_type_amount' 					=> $this->input->post('overtime_type_amount',true),
					'overtime_type_remark' 					=> $this->input->post('overtime_type_remark',true),
					'updated_id' 							=> $auth['user_id'],
					'updated_on' 							=> date("Y-m-d H:i:s"),
				);
				
					$this->session->set_userdata('Edit',$data);
					$this->form_validation->set_rules('overtime_type_code', 'Overtime Type Code', 'required|alpha_numeric');
					$this->form_validation->set_rules('overtime_type_name', 'Overtime Type Name', 'required');
					$this->form_validation->set_rules('overtime_type_working_day_hour1', 'Working Day Hour 1', 'required');
					$this->form_validation->set_rules('overtime_type_working_day_ratio1', 'Working Day Ratio 1', 'required');
					$this->form_validation->set_rules('overtime_type_working_day_hour2', 'Working Day Hour 2', 'required');
					$this->form_validation->set_rules('overtime_type_working_day_ratio2', 'Working Day Ratio 2', 'required');
					$this->form_validation->set_rules('overtime_type_day_off_hour1', 'Day Off Hour 1', 'required');
					$this->form_validation->set_rules('overtime_type_day_off_ratio1', 'Day Off Ratio 1', 'required');
					$this->form_validation->set_rules('overtime_type_day_off_hour2', 'Day Off Hour 2', 'required');
					$this->form_validation->set_rules('overtime_type_day_off_ratio2', 'Day Off Ratio 2', 'required');
	
			if($this->form_validation->run()==true){
				if($this->CoreOvertimeType_model->updateCoreOvertimeType($data)==true){
					
					$this->fungsi->set_log($auth['user_id'], $data['overtime_type_id'], '3122', 'Application.CoreAward.processEditCoreAward', $data['overtime_type_id'], 'Edit Core Award');
							$msg = "<div class='alert alert-success'>                
								Edit Data Award Berhasil
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('overtime-type/edit/'.$data['overtime_type_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data Award Gagal
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('overtime-type/edit/'.$data['overtime_type_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('overtime-type/edit/'.$data['overtime_type_id']);
			}
		}
		
				
		function deleteCoreOvertimeType(){
			$auth 			= $this->session->userdata('auth');
			$overtime_type_id 		= $this->uri->segment(3);

			$data = array(
				'overtime_type_id' 	=> $overtime_type_id,
				'deleted_id' 		=> $auth['user_id'],
				'deleted_on' 		=> date("Y-m-d H:i:s"),
				'data_state'		=> 1
			);

			if($this->CoreOvertimeType_model->deleteCoreOvertimeType($data)){
				
				$this->fungsi->set_log($auth['user_id'], $data['overtime_type_id'], '3122', 'Application.CoreOvertimeType.deleteCoreOvertimeType', $data['overtime_type_id'], 'Delete Core Award');

				$msg = "<div class='alert alert-success'>                
							Hapus Data Overtime Type Berhasil
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('overtime-type');
			}else{
				$msg = "<div class='alert alert-danger'>                
					Hapus Data Overtime Type Gagal
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('overtime-type');
			}
		}
	}
?>