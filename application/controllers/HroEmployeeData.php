<?php
	class HroEmployeeData extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'hroemployeedata';

			$this->cekLogin();
			$this->accessMenu($menu);

			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeData_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}

		public function index(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addHroEmployeeData-'.$unique['unique']);
			$this->session->unset_userdata('HroEmployeeDataToken-'.$unique['unique']);

			$auth 						= $this->session->userdata('auth');
			// $region_id 					= $auth['region_id'];
			// $branch_id 					= $auth['branch_id'];
			// $location_id 				= $auth['location_id'];
		//	$payroll_employee_level 	= $auth['payroll_employee_level'];

			/*print_r($auth);
			exit;*/
			$sesi	= 	$this->session->userdata('filter-HroEmployeeData');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
			}

			$data['main_view']['coredivision']			= create_double($this->HroEmployeeData_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']		= create_double($this->HroEmployeeData_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']			= create_double($this->HroEmployeeData_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['HroEmployeeData']		= $this->HroEmployeeData_model->getHROEmployeeData(/*$region_id, $branch_id, $location_id, $payroll_employee_level,*/ $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);
			$data['main_view']['content']				= 'HroEmployeeData/ListHroEmployeeData_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-HroEmployeeData',$data);
			redirect('HroEmployeeData');
		}

		public function addHROEmployeeData(){
			$unique 			= $this->session->userdata('unique');
			$employee_token		= $this->session->userdata('HroEmployeeDataToken-'.$unique['unique']);

			if(empty($employee_token)){
				$employee_token = md5(date("YmdHis"));
				$this->session->set_userdata('HroEmployeeDataToken-'.$unique['unique'], $employee_token);
			}

			$data['main_view']['coremaritalstatus']		= create_double($this->HroEmployeeData_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');
			$data['main_view']['coredivision']			= create_double($this->HroEmployeeData_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']		= create_double($this->HroEmployeeData_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']			= create_double($this->HroEmployeeData_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['corejobtitle']			= create_double($this->HroEmployeeData_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['coregrade']				= create_double($this->HroEmployeeData_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']				= create_double($this->HroEmployeeData_model->getCoreClass(),'class_id','class_name');

			$data['main_view']['path']					= $this->configuration->PhotoDirectory();
			$data['main_view']['gender']				= $this->configuration->Gender();
			$data['main_view']['religion']				= $this->configuration->Religion();
			$data['main_view']['bloodtype']				= $this->configuration->BloodType();
			$data['main_view']['workingstatus']			= $this->configuration->WorkingStatus();
			$data['main_view']['employeestatus']		= $this->configuration->EmployeeStatus();
			$data['main_view']['overtimestatus']		= $this->configuration->OvertimeStatus();	
			$data['main_view']['idtype']				= $this->configuration->IDType();
			$data['main_view']['payrollemployeelevel']	= $this->configuration->PayrollEmployeeLevel();
			$data['main_view']['coreunit']				= create_double($this->HroEmployeeData_model->getCoreUnit(),'unit_id','unit_name');
			$data['main_view']['corebank']				= create_double($this->HroEmployeeData_model->getCoreBank(), 'bank_id', 'bank_name');

			$data['main_view']['content']				= 'HroEmployeeData/FormAddHroEmployeeData_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function editHROEmployeeData(){
			$employee_id 								= $this->uri->segment(3);
			$data['main_view']['HroEmployeeData']		= $this->HroEmployeeData_model->getHROEmployeeData_Detail($employee_id);
			$data['main_view']['coremaritalstatus']		= create_double($this->HroEmployeeData_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');
			$data['main_view']['coredivision']			= create_double($this->HroEmployeeData_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']		= create_double($this->HroEmployeeData_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']			= create_double($this->HroEmployeeData_model->getCoreSection(),'section_id','section_name');

			$data['main_view']['corejobtitle']			= create_double($this->HroEmployeeData_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['coregrade']				= create_double($this->HroEmployeeData_model->getCoreGrade(),'grade_id','grade_name');
			$data['main_view']['coreclass']				= create_double($this->HroEmployeeData_model->getCoreClass(),'class_id','class_name');
			$data['main_view']['coreunit']				= create_double($this->HroEmployeeData_model->getCoreUnit(),'unit_id','unit_name');
			$data['main_view']['corebank']				= create_double($this->HroEmployeeData_model->getCoreBank(), 'bank_id', 'bank_name');

			$data['main_view']['path']					= $this->configuration->PhotoDirectory();
			$data['main_view']['gender']				= $this->configuration->Gender();
			$data['main_view']['religion']				= $this->configuration->Religion();
			$data['main_view']['bloodtype']				= $this->configuration->BloodType();
			$data['main_view']['workingstatus']			= $this->configuration->WorkingStatus();
			$data['main_view']['employeestatus']		= $this->configuration->EmployeeStatus();
			$data['main_view']['overtimestatus']		= $this->configuration->OvertimeStatus();	
			$data['main_view']['idtype']				= $this->configuration->IDType();
			$data['main_view']['payrollemployeelevel']	= $this->configuration->PayrollEmployeeLevel();
			$data['main_view']['content']				= 'HroEmployeeData/formeditHroEmployeeData_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeData-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addHroEmployeeData-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addHroEmployeeData-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addHroEmployeeData-'.$unique['unique'],$sessions);
			// echo $name;
		}

		function lookup_core_division(){
			$division_id = $this->input->post('division_id');
			$item = $this->HroEmployeeData_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		function processAddHROEmployeeData(){
			$auth 			= $this->session->userdata('auth');
			$unique 		= $this->session->userdata('unique');
			// $region_id 		= $auth['region_id'];
			// $branch_id 		= $auth['branch_id'];
			// $location_id	= $auth['location_id'];
			// $created_id 	= $auth['user_id'];

			/*$tempat = $this->configuration->PhotoDirectory;
			$newfilename = md5_file($_FILES['employee_picture']['tmp_name']);
			if($_FILES['employee_picture']['error'] == 0 && $_FILES['employee_picture']['size']>0){
				if($_POST[old_employee_picture]!=""){
					$gambarlama=$this->configuration->PhotoDirectory.$_POST[old_employee_picture];
						try {
							unlink($gambarlama);
						} catch (Exception $e) {

						}
				}
				$config['upload_path'] = $tempat;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['file_name'] = $newfilename;
				$config['remove_spaces'] = true;
				$this->load->library('upload', $config);
				if( $_POST AND $this->upload->do_upload('employee_picture') ) {
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
					// $config['maintain_ratio'] = FALSE;
					// $config['width'] = 60;
					// $config['height'] = 60;
					$this->load->library('image_lib', $config);
					if ( ! $this->image_lib->resize()){
						$msg = "<div class='alert alert-danger'>                
							".$this->upload->display_errors('', '')."
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeData');
					} else {*/
					
					$data = array(
						// 'region_id'								=> $region_id,
						// 'branch_id'								=> $branch_id,
						// 'location_id'							=> $location_id,
						'division_id'							=> $this->input->post('division_id',true),
						'department_id'							=> $this->input->post('department_id',true),
						'section_id'							=> $this->input->post('section_id',true),
						'job_title_id'							=> $this->input->post('job_title_id',true),
						'grade_id'								=> $this->input->post('grade_id',true),
						'class_id'								=> $this->input->post('class_id',true),
						'unit_id'								=> $this->input->post('unit_id',true),
						'bank_id'								=> $this->input->post('bank_id',true),
						'employee_code'							=> $this->input->post('employee_code',true),	
						'employee_rfid_code'					=> $this->input->post('employee_rfid_code',true),	
						'employee_name'							=> $this->input->post('employee_name',true),		
						'employee_address'						=> $this->input->post('employee_address',true),
						'employee_city'							=> $this->input->post('employee_city',true),
						'employee_postal_code'					=> $this->input->post('employee_postal_code',true),
						'employee_rt'							=> $this->input->post('employee_rt',true),
						'employee_rw'							=> $this->input->post('employee_rw',true),
						'employee_kelurahan'					=> $this->input->post('employee_kelurahan',true),
						'employee_kecamatan'					=> $this->input->post('employee_kecamatan',true),
						'employee_home_phone'					=> $this->input->post('employee_home_phone',true),
						'employee_mobile_phone'					=> $this->input->post('employee_mobile_phone',true),
						'employee_email_address'				=> $this->input->post('employee_email_address',true),
						'employee_gender'						=> $this->input->post('employee_gender',true),
						'employee_date_of_birth'				=> tgltodb($this->input->post('employee_date_of_birth',true)),
						'employee_place_of_birth'				=> $this->input->post('employee_place_of_birth',true),
						'employee_id_type'						=> $this->input->post('employee_id_type',true),
						'employee_id_number'					=> $this->input->post('employee_id_number',true),
						'employee_religion'						=> $this->input->post('employee_religion',true),
						'employee_blood_type'					=> $this->input->post('employee_blood_type',true),
						'employee_residential_address'			=> $this->input->post('employee_residential_address',true),
						'employee_residential_city'				=> $this->input->post('employee_residential_city',true),
						'employee_residential_postal_code'		=> $this->input->post('employee_residential_postal_code',true),
						'employee_residential_rt'				=> $this->input->post('employee_residential_rt',true),
						'employee_residential_rw'				=> $this->input->post('employee_residential_rw',true),
						'employee_residential_kecamatan'		=> $this->input->post('employee_residential_kecamatan',true),
						'employee_residential_kelurahan'		=> $this->input->post('employee_residential_kelurahan',true),
						'marital_status_id'						=> $this->input->post('marital_status_id',true),
						'employee_heir_name'					=> $this->input->post('employee_heir_name',true),
						'employee_employment_working_status'	=> $this->input->post('employee_employment_working_status',true),
						'employee_employment_overtime_status'	=> $this->input->post('employee_employment_overtime_status',true),
						'employee_employment_status'			=> $this->input->post('employee_employment_status',true),
						'employee_hire_date'					=> tgltodb($this->input->post('employee_hire_date',true)),
						'employee_employment_status_date'		=> tgltodb($this->input->post('employee_employment_status_date',true)),
						'employee_employment_status_duedate'	=> tgltodb($this->input->post('employee_employment_status_duedate',true)),
						'payroll_employee_level'				=> $this->input->post('payroll_employee_level',true),
						'employee_remark'						=> $this->input->post('employee_remark',true),
						'employee_token'						=> $this->input->post('employee_token',true),
						'created_id' 							=> $auth['user_id'],
						'created_on'							=> date("YmdHis"),
						'data_state'							=> 0
					);

					
			// print_r("data ");
			// print_r($data);
			// exit;
			
			$employee_token 			= $this->HroEmployeeData_model->getHroEmployeeDataToken($data['employee_token']);
			
			$this->form_validation->set_rules('employee_code', 'Employee Code', 'required');
			$this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status Name', 'required');

			
			if($this->form_validation->run()==true){
				if ($employee_token == 0){
					if($this->HroEmployeeData_model->saveNewHROEmployeeData($data)){

						$this->fungsi->set_log($auth['user_id'], $employee_id, '3122', 'Application.CoreHroEmployeeData.processAddCoreHroEmployeeData', $employee_id, 'Add New Core HroEmployeeData');

						$msg = "<div class='alert alert-success'>                
									Tambah Data HroEmployeeData Baru Berhasil
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addCoreHroEmployeeData-'.$unique['unique']);
						$this->session->unset_userdata('CoreHroEmployeeDataToken-'.$unique['unique']);
						redirect('hroemployeedata/add');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Tambah Data HroEmployeeData Baru Gagal
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->set_userdata('addCoreHroEmployeeData',$data);
						redirect('hroemployeedata/add');
					}
				} else {
					$msg = "<div class='alert alert-danger'>                
						Tambah Data HroEmployeeData Baru Sudah Ada
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeedata/add');
				}
			}else{
				$this->session->set_userdata('addCoreHroEmployeeData',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeedata/add');
			}
		}
		
		function processEditHroEmployeeData(){
			$auth 			= $this->session->userdata('auth');
			// $region_id 		= $auth['region_id'];
			// $branch_id 		= $auth['branch_id'];
			// $location_id 	= $auth['location_id'];

			/*$tempat = $this->configuration->PhotoDirectory;*/
			// print_r($tempat);exit;
			// if( !is_dir($tempat) ) {
			// mkdir($tempat, DIR_WRITE_MODE);
			// }
			/*$newfilename = md5_file($_FILES['employee_picture']['tmp_name']);
			if($_FILES['employee_picture']['error'] == 0 && $_FILES['employee_picture']['size']>0){
				if($_POST[old_employee_picture]!=""){
					$gambarlama=$this->configuration->PhotoDirectory.$_POST[old_employee_picture];
					// print_r($gambarlama);exit;
						try {
							unlink($gambarlama);
						} catch (Exception $e) {

						}
				}
				$config['upload_path'] = $tempat;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['file_name'] = $newfilename;
				$config['remove_spaces'] = true;
				$this->load->library('upload', $config);
				if( $_POST AND $this->upload->do_upload('employee_picture') ) {
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
					// $config['maintain_ratio'] = FALSE;
					// $config['width'] = 60;
					// $config['height'] = 60;
					$this->load->library('image_lib', $config);
					if ( ! $this->image_lib->resize()){
						$msg = "<div class='alert alert-danger'>                
							".$this->upload->display_errors('', '')."
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeData');
					} else {*/
						
						$data = array(
							// 'region_id'								=> $region_id,
							// 'branch_id'								=> $branch_id,
							// 'location_id'							=> $location_id,
							'employee_id'							=> $this->input->post('employee_id',true),
							'division_id'							=> $this->input->post('division_id',true),
							'department_id'							=> $this->input->post('department_id',true),
							'section_id'							=> $this->input->post('section_id',true),
							'job_title_id'							=> $this->input->post('job_title_id',true),
							'grade_id'								=> $this->input->post('grade_id',true),
							'class_id'								=> $this->input->post('class_id',true),
							'unit_id'								=> $this->input->post('unit_id',true),
							'bank_id'								=> $this->input->post('bank_id',true),
							'employee_code'							=> $this->input->post('employee_code',true),	
							'employee_rfid_code'					=> $this->input->post('employee_rfid_code',true),	
							'employee_name'							=> $this->input->post('employee_name',true),		
							'employee_address'						=> $this->input->post('employee_address',true),
							'employee_city'							=> $this->input->post('employee_city',true),
							'employee_postal_code'					=> $this->input->post('employee_postal_code',true),
							'employee_rt'							=> $this->input->post('employee_rt',true),
							'employee_rw'							=> $this->input->post('employee_rw',true),
							'employee_kelurahan'					=> $this->input->post('employee_kelurahan',true),
							'employee_kecamatan'					=> $this->input->post('employee_kecamatan',true),
							'employee_home_phone'					=> $this->input->post('employee_home_phone',true),
							'employee_mobile_phone'					=> $this->input->post('employee_mobile_phone',true),
							'employee_email_address'				=> $this->input->post('employee_email_address',true),
							'employee_gender'						=> $this->input->post('employee_gender',true),
							'employee_date_of_birth'				=> tgltodb($this->input->post('employee_date_of_birth',true)),
							'employee_place_of_birth'				=> $this->input->post('employee_place_of_birth',true),
							'employee_id_type'						=> $this->input->post('employee_id_type',true),
							'employee_id_number'					=> $this->input->post('employee_id_number',true),
							'employee_religion'						=> $this->input->post('employee_religion',true),
							'employee_blood_type'					=> $this->input->post('employee_blood_type',true),
							'employee_residential_address'			=> $this->input->post('employee_residential_address',true),
							'employee_residential_city'				=> $this->input->post('employee_residential_city',true),
							'employee_residential_postal_code'		=> $this->input->post('employee_residential_postal_code',true),
							'employee_residential_rt'				=> $this->input->post('employee_residential_rt',true),
							'employee_residential_rw'				=> $this->input->post('employee_residential_rw',true),
							'employee_residential_kecamatan'		=> $this->input->post('employee_residential_kecamatan',true),
							'employee_residential_kelurahan'		=> $this->input->post('employee_residential_kelurahan',true),
							'marital_status_id'						=> $this->input->post('marital_status_id',true),
							'employee_heir_name'					=> $this->input->post('employee_heir_name',true),
							'employee_employment_working_status'	=> $this->input->post('employee_employment_working_status',true),
							'employee_employment_overtime_status'	=> $this->input->post('employee_employment_overtime_status',true),
							'employee_employment_status'			=> $this->input->post('employee_employment_status',true),
							'employee_hire_date'					=> tgltodb($this->input->post('employee_hire_date',true)),
							'employee_employment_status_date'		=> tgltodb($this->input->post('employee_employment_status_date',true)),
							'employee_employment_status_duedate'	=> tgltodb($this->input->post('employee_employment_status_duedate',true)),
							'employee_remark'						=> $this->input->post('employee_remark',true),
							'updated_id' 							=> $auth['user_id'],
							'updated_on' 							=> date("Y-m-d H:i:s"),
						);
			
			
			$this->form_validation->set_rules('employee_code', 'Employee Code', 'required');
			$this->form_validation->set_rules('employee_name', 'Employee Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('grade_id', 'Grade Name', 'required');
			$this->form_validation->set_rules('class_id', 'Class Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status Name', 'required');
			// print_r($data);exit;
			if($this->form_validation->run()==true){
				// if($this->uploadgambar()==true){
					if($this->HroEmployeeData_model->saveEditHROEmployeeData($data)==true){
						$auth 	= $this->session->userdata('auth');
						// $this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeData.Edit',$auth['username'],'Edit Employee Data');
						// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_id']);
						$msg = "<div class='alert alert-success'>                
									Edit Employee Data Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeData/editHROEmployeeData/'.$data['employee_id']);
					}else{
						$msg = "<div class='alert alert-danger'>                
									Edit Employee Data UnSuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeData/editHROEmployeeData/'.$data['employee_id']);
					}
				// }
			}
			else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeData/editHROEmployeeData/'.$data['employee_id']);
			}
		}

		function deleteHROEmployeeData(){
			$employee_id = $this->uri->segment(3);
			if($this->HroEmployeeData_model->deleteHROEmployeeData($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeData.delete',$auth['username'],'Delete HROEmployeeData');
				$msg = "<div class='alert alert-success'>                
							Delete Employee Data Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeData');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Employee Data UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeData');
			}
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-HroEmployeeData');
			$this->session->unset_userdata('filter-HroEmployeeData');
			redirect('HroEmployeeData');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployedata-'.$sesi['unique']);	
			redirect('HroEmployeeData/addHROEmployeeData');
		}
		
		/* function uploadgambar(){
			$tempat = $this->configuration->PhotoDirectory;
			if( !is_dir($tempat) ) {
			mkdir($tempat, DIR_WRITE_MODE);
			}
			if($_FILES['employee_picture']['error'] == 0 && $_FILES['employee_picture']['size']>0){
				if($_POST[old_employee_picture]!=""){
					$gambarlama=$this->configuration->PhotoDirectory.$_POST[old_employee_picture];
					// print_r($gambarlama);exit;
					unlink($gambarlama);
				}
				$config['upload_path'] = $tempat;
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['overwrite'] = false;
				$config['remove_spaces'] = true;
				$this->load->library('upload', $config);
				if( $_POST AND $this->upload->do_upload('employee_picture') ) {
					$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
					$config['maintain_ratio'] = FALSE;
					$config['width'] = 60;
					$config['height'] = 60;
					$this->load->library('image_lib', $config);
					if ( ! $this->image_lib->resize()){
						$msg = "<div class='alert alert-danger'>                
							".$this->upload->display_errors('', '')."
						</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('HroEmployeeData');
					} else {
						$data['employee_picture'] = $this->upload->file_name;
					}
				}
				// print_r($data['employee_picture']);exit;
				// return $this->upload->file_name;
			}else{
				return false;
			}
		} */


/*
	boros
 		function renamefile(){
			//fungsi file renaming
			$pathdirectory=$this->configuration->PhotoDirectory;
			
			$filenamelawas		= $this->input->post('old_employee_picture',true);
			$filenamebaru 		= $_FILES['employee_picture']['name'];
			
			if($filenamelawas!="" && $filenamebaru!=""){
				$filenamelawas=$filenamebaru;
			}
			if($filenamelawas=="" && $filenamebaru!=""){
				$filenamelawas=$filenamebaru;
			}
			if($filenamelawas!="" && $filenamebaru==""){
				$filenamelawas=$filenamebaru;
			}
			if($filenamelawas=="" && $filenamebaru==""){
				// $filenamelawas=$filenamebaru;
			}
			
			$breaker=explode('.',$filenamelawas);
			$ekstensifile=$breaker[1];

			$kode=$this->input->post('employee_code',true);
			$filenameanyar=$kode.".".$ekstensifile;

			$namafilelama=$pathdirectory.$filenamelawas;
			$namafilebaru=$pathdirectory.$filenameanyar;
			
			rename($namafilelama, $namafilebaru);

			return $filenameanyar;
		}
		
		function gambaredit(){
				// fungsi upload gambar
				$fileName 			= $_FILES['employee_picture']['name'];
				$fileSize 			= $_FILES['employee_picture']['size'];
				$fileError 			= $_FILES['employee_picture']['error'];
				
				if($fileSize > 0){
					$parse		= explode('.',$fileName);
					$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe', 'bmp', 'JPG');
					if (!in_array($parse[count($parse)-1], $image_types)){
						$message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('main');
					}
				}
				
				if (round($fileSize/1024,2) > 1024){
					$message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							filesize not allowed, max file 1024 Kb!!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('main');
				}
				if($fileSize > 0 || $fileError == 0){
					try {
						$employee_code=$this->input->post('employee_code',true);
						$newfilename=$employee_code.".".$parse[1];
						
						$config['upload_path'] 		= $this->configuration->PhotoDirectory;
						$config['allowed_types'] 	= 'gif|jpg|png|jpeg|JPG|bmp|jpe';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;
						
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('employee_picture')){
							$msg = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('main');
						}
					}catch (Exception $msg){
						$message = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						redirect('main');
					}
				}
				return $newfilename;
			}
		
		function determine(){
			//fungsi untuk kondisi pengeditan
			$fileName 			= $_FILES['employee_picture']['name'];
			$fileError 			= $_FILES['employee_picture']['error'];
			// print_r($fileName);exit;
			if($fileName==''){
				$retur=$this->renamefile();
				return $retur;
			}else{
				$retur=$this->renamefile();
				$photodir=$this->configuration->PhotoDirectory;
				$kill=$photodir.$retur;
				unlink($kill);
				$baru=$this->gambaredit();
				return $baru;
			}
		}
		
// For those whom having hard time reading mine algorithm, read this :
// untuk gambar, file naming menggunakan kode karyawan
// setting path di application/libraries/configuration
// kondisi update gambar 

// --> kode employee tidak ganti / gambar tidak ganti
// --> kode employee ganti / gambar tidak ganti
// --> kode employee tidak ganti / gambar ganti
// --> kode employee ganti / gambar ganti


// ------------------------------------|
    // Code        |    Gambar         |
// ------------------------------------|
    // No Change   |    No Change      | -> rename file,
    // Change      |    No Change      | -> rename file,
    // No Change   |    Change         | -> rename file, hapus gambar, simpan gambar
    // Change      |    Change         | -> rename file, hapus gambar, simpan gambar
// ------------------------------------|

// The Approach :

// if gambar = null
// then rename file dengan kode

// if gambar = ada
// then delete file lawas, upload file baru

// kode ganti / tidak ganti tetap
// rename file gambar lawas dengan kode baru
		
		function gambar(){
				$data = array(
				'employee_code'					=> $this->input->post('employee_code',true),
				'employee_name'					=> $this->input->post('employee_name',true),
				'employee_nick_name'			=> $this->input->post('employee_nick_name',true),
				'employee_address'				=> $this->input->post('employee_address',true),
				'employee_city'					=> $this->input->post('employee_city',true),
				'employee_zip_code'				=> $this->input->post('employee_zip_code',true),
				'employee_rt'					=> $this->input->post('employee_rt',true),
				'employee_rw'					=> $this->input->post('employee_rw',true),
				'employee_kecamatan'			=> $this->input->post('employee_kecamatan',true),
				'employee_kelurahan'			=> $this->input->post('employee_kelurahan',true),
				'employee_home_phone'			=> $this->input->post('employee_home_phone',true),
				'employee_mobile_phone'			=> $this->input->post('employee_mobile_phone',true),
				'employee_email_address'		=> $this->input->post('employee_email_address',true),
				'employee_gender'				=> $this->input->post('employee_gender',true),
				'date_of_birth'					=> $this->input->post('date_of_birth',true),
				'place_of_birth'				=> $this->input->post('place_of_birth',true),
				'employee_religion'				=> $this->input->post('employee_religion',true),
				'employee_id_number'			=> $this->input->post('employee_id_number',true),
				'employee_residence_address'	=> $this->input->post('employee_residence_address',true),
				'employee_residence_city'		=> $this->input->post('employee_residence_city',true),
				'employee_residence_zip_code'	=> $this->input->post('employee_residence_zip_code',true),
				'employee_residence_rt'			=> $this->input->post('employee_residence_rt',true),
				'employee_residence_rw'			=> $this->input->post('employee_residence_rw',true),
				'employee_residence_kecamatan'	=> $this->input->post('employee_residence_kecamatan',true),
				'employee_residence_kelurahan'	=> $this->input->post('employee_residence_kelurahan',true),
				'employee_bank_name'			=> $this->input->post('employee_bank_name',true),
				'employee_bank_acct_no'			=> $this->input->post('employee_residence_acct_no',true),
				'employee_bank_acct_name'		=> $this->input->post('employee_residence_acct_name',true),
				'marital_status_id'				=> $this->input->post('marital_status_id',true),
				'number_of_children'			=> $this->input->post('number_of_children',true),
				'employee_heir_name'			=> $this->input->post('employee_heir_name',true),
				'employee_heir_occupation'		=> $this->input->post('employee_heir_occupation',true),
				'employee_blood_type'			=> $this->input->post('employee_blood_type',true),
				'employee_driving_licenseA'		=> $this->input->post('employee_driving_licenseA',true),
				'employee_driving_licenseB'		=> $this->input->post('employee_driving_licenseB',true),
				'employee_driving_licenseB1'	=> $this->input->post('employee_driving_licenseB1',true),
				'data_state'					=> '0'
				);
				
				
				$fileName 			= $_FILES['employee_picture']['name'];
				$fileSize 			= $_FILES['employee_picture']['size'];
				$fileError 			= $_FILES['employee_picture']['error'];
				
				if($fileSize > 0){
					$parse		= explode('.',$fileName);
					$image_types = array('gif', 'jpg', 'jpeg', 'png', 'jpe', 'bmp', 'JPG');
					if (!in_array($parse[count($parse)-1], $image_types)){
						$message = "<div class='alert alert-danger'>                
								filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
							</div> ";
						$this->session->set_userdata('message',$message);
						$this->session->set_userdata('AddHroEmployeeData',$data);
						redirect('HroEmployeeData/Add');
					}
				}
				
				if (round($fileSize/1024,2) > 1024){
					$message = "<div class='alert alert-danger'>                
							filesize not allowed, max file 1024 Kb!!!
						</div> ";
					$this->session->set_userdata('message',$message);
					$this->session->set_userdata('AddHroEmployeeData',$data);
					redirect('HroEmployeeData/Add');
				}
				if($fileSize > 0 || $fileError == 0){
					try {
						$employee_code=$this->input->post('employee_code',true);
						$newfilename=$employee_code.".".$parse[1];
						
						$config['upload_path'] 		= $this->configuration->PhotoDirectory;
						$config['allowed_types'] 	= 'gif|jpg|png|jpeg|JPG|bmp|jpe';
						$config['overwrite'] 		= false;
						$config['remove_spaces'] 	= true;
						$config['file_name'] 		= $newfilename;
						
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('employee_picture')){
							$msg = "<div class='alert alert-danger'>                
									".$this->upload->display_errors('', '')."
								</div> ";
							$this->session->set_userdata('message',$msg);
							$this->session->set_userdata('AddHroEmployeeData',$data);
							redirect('HroEmployeeData/Add');
						}
					}catch (Exception $msg){
						$message = "<div class='alert alert-danger'>                
								Error in uploading due".$msg->getMessage()."
							</div> ";
						$this->session->set_userdata('message',$message);
						$this->session->set_userdata('AddHroEmployeeData',$data);
						redirect('HroEmployeeData/Add');
					}
				}
				return $newfilename;
			} */
	}
?>