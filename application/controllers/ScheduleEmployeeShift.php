<?php
	Class ScheduleEmployeeShift extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('ScheduleEmployeeShift_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth 					= $this->session->userdata('auth');
			$region_id 				= $auth['region_id'];
			$branch_id 				= $auth['branch_id'];
			$location_id 			= $auth['location_id'];
			//$payroll_employee_level = $auth['payroll_employee_level'];

			$sesi	= 	$this->session->userdata('filter-ScheduleEmployeeShift');
			if(!is_array($sesi)){
				$sesi['location_id']		= '';
			}
			/*
			if ($payroll_employee_level == 9){
				$location_id 	= $sesi['location_id'];
			} else {
				$location_id 	= $location_id;
			}*/

			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique']);	
			$this->session->unset_userdata('editarrayScheduleEmployeeShiftitemfirst-'.$unique['unique']);	

			$data['Main_view']['corelocation']					= create_double($this->ScheduleEmployeeShift_model->getCoreLocation(), 'location_id', 'location_name');

			$data['Main_view']['ScheduleEmployeeShift']			= $this->ScheduleEmployeeShift_model->getScheduleEmployeeShift($region_id, $branch_id, $location_id/*, $payroll_employee_level*/);

			$data['Main_view']['ScheduleEmployeeShiftstatus']	= $this->configuration->ScheduleEmployeeShiftStatus();

			$data['Main_view']['content']						= 'ScheduleEmployeeShift/listScheduleEmployeeShift_view';
			$this->load->view('MainPage_view',$data);
		}

		public function filter_ScheduleEmployeeShift(){
			$data = array (
				'location_id'		=> $this->input->post('location_id',true),	
			);

			$this->session->set_userdata('filter-ScheduleEmployeeShift',$data);
			redirect('ScheduleEmployeeShift');
		}
		
		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->ScheduleEmployeeShift_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->ScheduleEmployeeShift_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreUnit(){
			$section_id = $this->input->post('section_id');
			
			$item = $this->ScheduleEmployeeShift_model->getCoreUnit($section_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[unit_id]'>$mp[unit_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData(){
			$auth 						= $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];

			$division_id 	= $this->input->post('division_id');
			$department_id	= $this->input->post('department_id');
			$section_id		= $this->input->post('section_id');
			$unit_id		= $this->input->post('unit_id');
			
			// print("auth :");
			// print_r($auth);
			// print("<br>");
			// print("branc :");
			// print_r($branch_id);
			// print("<br>");
			// print("lokasi :");
			// print_r($location_id);
			// print("<br>");
			// print("devisi :");
			// print_r($division_id);
			// print("<br>");
			// print("depart :");
			// print_r($department_id);
			// print("<br>");
			// print("section :");
			// print_r($section_id);
			// print("<br>");
			// print("unit :");
			// print_r($unit_id);
			// print("<br>");

			if ($payroll_employee_level == 9){
				$location_id = $this->input->post('location_id');
			} 
			
			$item = $this->ScheduleEmployeeShift_model->getHroEmployeeData($region_id, $branch_id, $location_id,$division_id, $department_id, $section_id, $unit_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}

		public function addScheduleEmployeeShift(){
			$data['Main_view']['coredivision']		= create_double($this->ScheduleEmployeeShift_model->getCoreDivision(), 'division_id', 'division_name');

			$data['Main_view']['corelocation']		= create_double($this->ScheduleEmployeeShift_model->getCoreLocation(), 'location_id', 'location_name');

			$data['Main_view']['content']			= 'ScheduleEmployeeShift/formaddScheduleEmployeeShift_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddArrayScheduleEmployeeShift(){
			$auth 			= $this->session->userdata('auth');

			$data_ScheduleEmployeeShiftitem = array(
				'department_id'					=> $this->input->post('department_id', true),
				'section_id'					=> $this->input->post('section_id', true),
				'unit_id'						=> $this->input->post('unit_id', true),
				'employee_id'					=> $this->input->post('employee_id', true),
			);

			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('unit_id', 'Unit Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayScheduleEmployeeShiftitem-'.$unique['unique']);
				
				$dataArrayHeader[$data_ScheduleEmployeeShiftitem['employee_id']] = $data_ScheduleEmployeeShiftitem;
				
				$this->session->set_userdata('addarrayScheduleEmployeeShiftitem-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_ScheduleEmployeeShiftitem = $this->session->userdata('addScheduleEmployeeShift-'.$sesi['unique']);
				
				$data_ScheduleEmployeeShiftitem['department_id'] 				= '';
				$data_ScheduleEmployeeShiftitem['section_id'] 					= '';
				$data_ScheduleEmployeeShiftitem['unit_id'] 						= '';
				$data_ScheduleEmployeeShiftitem['employee_id'] 					= '';
				
				$this->session->set_userdata('addScheduleEmployeeShift-'.$sesi['unique'],$data_ScheduleEmployeeShiftitem);
				redirect('ScheduleEmployeeShift/addScheduleEmployeeShift');
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleEmployeeShift/addScheduleEmployeeShift');
			}
		}

		public function deleteArrayScheduleEmployeeShiftItem(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayScheduleEmployeeShiftitem-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayScheduleEmployeeShiftitem-'.$unique['unique'],$arrayBaru);
			
			redirect('ScheduleEmployeeShift/addScheduleEmployeeShift/');
		}

		public function processAddScheduleEmployeeShift(){
			$unique 	= $this->session->userdata('unique');

			$data 					= $this->session->userdata('addScheduleEmployeeShift-'.$unique['unique']);
			$dataArray 				= $this->session->userdata($data['created_on']);
			$auth 					= $this->session->userdata('auth');

			$payroll_employee_level = $auth['payroll_employee_level'];

			if ($payroll_employee_level == 9){
				$location_id = $this->input->post('location_id', true);
			} else {
				$location_id = $auth['location_id'];
			}
			
			$session_ScheduleEmployeeShift = $this->session->userdata('addarrayScheduleEmployeeShiftitem-'.$unique['unique']);

			$data_ScheduleEmployeeShift = array(
				'region_id'					=> $auth['region_id'],
				'branch_id'					=> $auth['branch_id'],
				'location_id'				=> $location_id,
				'division_id'				=> $this->input->post('division_id', true),
				'employee_shift_code'		=> $this->input->post('employee_shift_code', true),
				'employee_shift_status'		=> 1,
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id'],
				'created_on'				=> date('Y-m-d- H:i:s'),
			);

			if($this->ScheduleEmployeeShift_model->insertScheduleEmployeeShift($data_ScheduleEmployeeShift)){
				$employee_shift_id 	= $this->ScheduleEmployeeShift_model->getEmployeeShiftID($data_ScheduleEmployeeShift['created_id']);	

				if(!empty($session_ScheduleEmployeeShift)){
					foreach($session_ScheduleEmployeeShift as $key => $val){
						$hroemployeedata 	= $this->ScheduleEmployeeShift_model->getHROEmployeeData_Detail($val['employee_id']);

						$data_ScheduleEmployeeShiftitem= array(
							'employee_shift_id'		=> $employee_shift_id,
							'region_id'				=> $hroemployeedata['region_id'],
							'branch_id'				=> $hroemployeedata['branch_id'],
							'location_id'			=> $hroemployeedata['location_id'],
							'division_id'			=> $data_ScheduleEmployeeShift['division_id'],
							'department_id'			=> $val['department_id'],
							'section_id'			=> $val['section_id'],		
							'unit_id'				=> $val['unit_id'],		
							'employee_id'			=> $val['employee_id'],
							'employee_rfid_code'	=> $hroemployeedata['employee_rfid_code'],
						);

						if ($this->ScheduleEmployeeShift_model->insertScheduleEmployeeShiftItem($data_ScheduleEmployeeShiftitem)){
							$data_update = array(
								'employee_id'		=> $data_ScheduleEmployeeShiftitem['employee_id'],
								'employee_shift_id'	=> $data_ScheduleEmployeeShiftitem['employee_shift_id'],
							);
							$this->ScheduleEmployeeShift_model->updateHROEmployeeData($data_update);
						}
					}
				}

				$auth = $this->session->userdata('auth');

				$msg = "<div class='alert alert-success'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
							Add Data Schedule Employee Shift Success
						</div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('addScheduleEmployeeShift-'.$unique['unique']);
				$this->session->unset_userdata('addarrayScheduleEmployeeShiftitem-'.$unique['unique']);
				redirect('ScheduleEmployeeShift/addScheduleEmployeeShift/');
			}else{
				$msg = "<div class='alert alert-danger'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
							Add Data Schedule Employee Shift UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleEmployeeShift/addScheduleEmployeeShift/');
			}
		}

		public function showdetail(){
			$employee_shift_id = $this->uri->segment(3);

			$data['Main_view']['ScheduleEmployeeShift']		= $this->ScheduleEmployeeShift_model->getScheduleEmployeeShift_Detail($employee_shift_id);

			$data['Main_view']['ScheduleEmployeeShiftitem']	= $this->ScheduleEmployeeShift_model->getScheduleEmployeeShiftItem_Detail($employee_shift_id);

			$data['Main_view']['content']					= 'ScheduleEmployeeShift/detailScheduleEmployeeShift_view';
			$this->load->view('MainPage_view',$data);
		}

		public function resetitem(){
			$sesi 	= $this->session->userdata('unique');
			$header = $this->session->userdata('addScheduleEmployeeShift-'.$sesi['unique']);
			
			$this->session->unset_userdata('addScheduleEmployeeShift-'.$sesi['unique']);
			$this->session->unset_userdata('addarrayScheduleEmployeeShiftitem-'.$sesi['unique']);	
			$this->session->unset_userdata($data['created_on']);
			redirect('ScheduleEmployeeShift/addScheduleEmployeeShift');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addScheduleEmployeeShift-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addScheduleEmployeeShift-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addScheduleEmployeeShift-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addScheduleEmployeeShift-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-ScheduleEmployeeShift');
			$this->session->unset_userdata('filter-hroemployeelate');
			redirect('ScheduleEmployeeShift');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addScheduleEmployeeShift-'.$sesi['unique']);	
		}

		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editScheduleEmployeeShift-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editScheduleEmployeeShift-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function editScheduleEmployeeShift(){
			$employee_shift_id 	= $this->uri->segment(3);

			$auth 					= $this->session->userdata('auth');
			$unique 				= $this->session->userdata('unique');
				

			$data['Main_view']['coredivision']		= create_double($this->ScheduleEmployeeShift_model->getCoreDivision(), 'division_id', 'division_name');
			
			$ScheduleEmployeeShiftitem 				= $this->ScheduleEmployeeShift_model->getScheduleEmployeeShiftItem_Detail($employee_shift_id);

			$dataArrayHeader	= $this->session->userdata('editarrayScheduleEmployeeShiftitemfirst-'.$unique['unique']);

			if (!empty($ScheduleEmployeeShiftitem)){
				if (empty($dataArrayHeader)){
					foreach ($ScheduleEmployeeShiftitem as $keyShiftItem => $valShiftItem) {
						$data_employeeshiftitem = array(
							'employee_shift_item_id'		=> $valShiftItem['employee_shift_item_id'],
							'employee_shift_id'				=> $valShiftItem['employee_shift_id'],
							'region_id'						=> $valShiftItem['region_id'],
							'branch_id'						=> $valShiftItem['branch_id'],
							'location_id'					=> $valShiftItem['location_id'],
							'division_id'					=> $valShiftItem['division_id'],
							'department_id'					=> $valShiftItem['department_id'],
							'section_id'					=> $valShiftItem['section_id'],
							'unit_id'						=> $valShiftItem['unit_id'],
							'employee_id'					=> $valShiftItem['employee_id'],
							'employee_rfid_code'			=> $valShiftItem['employee_rfid_code'],
							'employee_shift_item_status'	=> 1,
						);

						$unique 			= $this->session->userdata('unique');
						$session_name 		= $this->input->post('session_name',true);
						$dataArrayHeader	= $this->session->userdata('editarrayScheduleEmployeeShiftitemfirst-'.$unique['unique']);

						$dataArrayHeader[$data_employeeshiftitem['employee_id']] = $data_employeeshiftitem;
						
						$this->session->set_userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique'],$dataArrayHeader);

						$this->session->set_userdata('editarrayScheduleEmployeeShiftitemfirst-'.$unique['unique'],$dataArrayHeader);

						$sesi 	= $this->session->userdata('unique');
						$data_employeeshiftitem = $this->session->userdata('editScheduleEmployeeShift-'.$sesi['unique']);
					}
				}

			}
			
			$data['Main_view']['ScheduleEmployeeShift']		= $this->ScheduleEmployeeShift_model->getScheduleEmployeeShift_Detail($employee_shift_id);

			$data['Main_view']['content']					= 'ScheduleEmployeeShift/formeditScheduleEmployeeShift_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_edit(){
			$employee_shift_id = $this->uri->segment(3);
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique']);	
			$this->session->unset_userdata('editarrayScheduleEmployeeShiftitemfirst-'.$unique['unique']);	
			redirect('ScheduleEmployeeShift/editScheduleEmployeeShift/'.$employee_shift_id);
		}

		public function processEditArrayScheduleEmployeeShift(){
			$auth 			= $this->session->userdata('auth');


			$employee_shift_id	= $this->input->post('employee_shift_id', true);

			$data_ScheduleEmployeeShiftitem = array(
				'department_id'					=> $this->input->post('department_id', true),
				'section_id'					=> $this->input->post('section_id', true),
				'unit_id'						=> $this->input->post('unit_id', true),
				'employee_id'					=> $this->input->post('employee_id', true),
				'employee_shift_item_status'	=> 2,
			);

			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('unit_id', 'Unit Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee ID', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique']);
				
				$dataArrayHeader[$data_ScheduleEmployeeShiftitem['employee_id']] = $data_ScheduleEmployeeShiftitem;
				
				$this->session->set_userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_ScheduleEmployeeShiftitem = $this->session->userdata('editScheduleEmployeeShift-'.$sesi['unique']);
				
				$data_ScheduleEmployeeShiftitem['department_id'] 				= '';
				$data_ScheduleEmployeeShiftitem['section_id'] 					= '';
				$data_ScheduleEmployeeShiftitem['unit_id'] 						= '';
				$data_ScheduleEmployeeShiftitem['employee_id'] 					= '';
				
				$this->session->set_userdata('editScheduleEmployeeShift-'.$sesi['unique'],$data_ScheduleEmployeeShiftitem);
				redirect('ScheduleEmployeeShift/editScheduleEmployeeShift/'.$employee_shift_id);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleEmployeeShift/editScheduleEmployeeShift/'.$employee_shift_id);
			}
		}

		public function deleteArrayEditScheduleEmployeeShiftItem(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$employee_shift_id 	= $this->uri->segment(4);
			$session_name		= "editarrayScheduleEmployeeShiftitem-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				$arrayBaru[$key] = $val;
				if($key == $var_to){
					$arrayBaru[$key]['employee_shift_item_status'] = 0;
				}
			}

			$this->session->set_userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique'],$arrayBaru);
			
			redirect('ScheduleEmployeeShift/editScheduleEmployeeShift/'.$employee_shift_id);
		}

		public function processEditScheduleEmployeeShift(){
			$unique 	= $this->session->userdata('unique');

			$data 					= $this->session->userdata('addScheduleEmployeeShift-'.$unique['unique']);
			$dataArray 				= $this->session->userdata($data['created_on']);
			$auth 					= $this->session->userdata('auth');
			
			$session_ScheduleEmployeeShift = $this->session->userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique']);

			$employee_shift_id	= $this->input->post('employee_shift_id',true);
			$division_id		= $this->input->post('division_id', true);

			if (!empty($session_ScheduleEmployeeShift)){
				foreach($session_ScheduleEmployeeShift as $key=>$val){
					if ($val['employee_shift_item_status'] == 0){
						$data_delete = array (
							'employee_shift_id'  	=> $val['employee_shift_id'],
							'employee_id'			=> $val['employee_id']
						);

						if ($this->ScheduleEmployeeShift_model->deleteScheduleEmployeeShiftItem($data_delete)){
							$datadelete_schedule = array(
								'employee_shift_id'				=> $val['employee_shift_id'],
								'employee_id'					=> $val['employee_id'],
								'employee_schedule_item_date'	=> date("Y-m-d"),
							);


							$this->ScheduleEmployeeShift_model->deleteScheduleEmployeeScheduleItem($datadelete_schedule);
						} else {

						}
					}

					if ($val['employee_shift_item_status'] == 2){
						$hroemployeedata 	= $this->ScheduleEmployeeShift_model->getHROEmployeeData_Detail($val['employee_id']);

						$data_ScheduleEmployeeShiftitem= array(
							'employee_shift_id'		=> $employee_shift_id,
							'region_id'				=> $hroemployeedata['region_id'],
							'branch_id'				=> $hroemployeedata['branch_id'],
							'location_id'			=> $hroemployeedata['location_id'],
							'division_id'			=> $division_id,
							'department_id'			=> $val['department_id'],
							'section_id'			=> $val['section_id'],		
							'unit_id'				=> $val['unit_id'],		
							'employee_id'			=> $val['employee_id'],
							'employee_rfid_code'	=> $hroemployeedata['employee_rfid_code'],
						);
					
						if ($this->ScheduleEmployeeShift_model->insertScheduleEmployeeShiftItem($data_ScheduleEmployeeShiftitem)){

							$data_update = array(
								'employee_id'		=> $data_ScheduleEmployeeShiftitem['employee_id'],
								'employee_shift_id'	=> $data_ScheduleEmployeeShiftitem['employee_shift_id'],
							);

							$this->ScheduleEmployeeShift_model->updateHROEmployeeData($data_update);
						}
					}
				}

				$auth 	= $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1077','Application.ScheduleEmployeeShift.edit',$auth['username'],'Edit ScheduleEmployeeShift');
				// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['shift_id']);
				$msg = "<div class='alert alert-success'>                
							Edit Shift Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique']);	
				$this->session->unset_userdata('editarrayScheduleEmployeeShiftitemfirst-'.$unique['unique']);	
				redirect('ScheduleEmployeeShift/editScheduleEmployeeShift/'.$employee_shift_id);
				/*}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Shift UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('ScheduleEmployeeShift/editScheduleEmployeeShift/'.$employee_shift_id);
				}*/
			}
		}
				
		public function deleteScheduleEmployeeShift(){
			$employee_shift_id = $this->uri->segment(3);
			if($this->ScheduleEmployeeShift_model->deleteScheduleEmployeeShift($employee_shift_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.ScheduleEmployeeShift.delete',$auth['username'],'Delete ScheduleEmployeeShift');
				$msg = "<div class='alert alert-success'>                
							Delete Data Shift Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleEmployeeShift');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Shift UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('ScheduleEmployeeShift');
			}
		}
	}
?>