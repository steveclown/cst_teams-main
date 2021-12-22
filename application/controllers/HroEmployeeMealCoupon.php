<?php
	class HroEmployeeMealCoupon extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeMealCoupon_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}

		
		public function index(){
			$auth = $this->session->userdata('auth');
			$data['Main_view']['content']					= 'HroEmployeeMealCoupon/formaddHroEmployeeMealCoupon_view';
			$this->load->view('MainPage_view',$data);
		}

		public function processAddHROEmployeeMealCoupon(){
			$auth 					= $this->session->userdata('auth');
			$unique 				= $this->session->userdata('unique');
			$location_id			= $auth['location_id'];
			$machine_ip_address		= '192.168.1.140';

			$this->session->unset_userdata('addarrayHroEmployeeMealCoupon-'.$unique['unique']);

			
			$data = array(
				'employee_rfid_code'		=> $this->input->post('employee_rfid_code',true),
			);

			$this->form_validation->set_rules('employee_rfid_code', 'Employee RFID Code', 'required');

			/*$employee_working_minute = $this->HroEmployeeMealCoupon_model->getEmployeeWorkingMinute();

			$employee_working_minute = "-".$employee_working_minute." minutes";

			$employee_meal_coupon_date1 = strtotime($employee_working_minute);
			$employee_meal_coupon_date 	= date('Y-m-d H:i:s', $employee_meal_coupon_date1);*/

			/*print_r("employee_meal_coupon_date1 ");
			print_r($employee_meal_coupon_date1);
			print_r("<BR>");
			print_r("employee_meal_coupon_date ");
			print_r($employee_meal_coupon_date);
			exit;*/
			
			if($this->form_validation->run()==true){
				$employee_meal_coupon_date = date('Y-m-d');

				$scheduleemployeescheduleitem = $this->HroEmployeeMealCoupon_model->getScheduleEmployeeScheduleItem($data['employee_rfid_code'], $location_id, $employee_meal_coupon_date);

				if (!empty($scheduleemployeescheduleitem)){
					$data_HroEmployeeMealCoupon = array(
						'region_id' 				=> $scheduleemployeescheduleitem['region_id'],
						'branch_id' 				=> $scheduleemployeescheduleitem['branch_id'],
						'location_id' 				=> $scheduleemployeescheduleitem['location_id'],
						'division_id' 				=> $scheduleemployeescheduleitem['division_id'],
						'department_id' 			=> $scheduleemployeescheduleitem['department_id'],
						'section_id' 				=> $scheduleemployeescheduleitem['section_id'],
						'unit_id' 					=> $scheduleemployeescheduleitem['unit_id'],
						'employee_shift_id' 		=> $scheduleemployeescheduleitem['employee_shift_id'],
						'employee_id' 				=> $scheduleemployeescheduleitem['employee_id'],
						'employee_rfid_code' 		=> $scheduleemployeescheduleitem['employee_rfid_code'],
						'employee_meal_coupon_date'	=> $employee_meal_coupon_date,
						'machine_ip_address'		=> $machine_ip_address,
					);

					if ($this->HroEmployeeMealCoupon_model->insertHROEmployeeMealCoupon($data_HroEmployeeMealCoupon)){
						$data_hroemployeeattendance = array(
							'region_id' 						=> $scheduleemployeescheduleitem['region_id'],
							'branch_id' 						=> $scheduleemployeescheduleitem['branch_id'],
							'location_id' 						=> $scheduleemployeescheduleitem['location_id'],
							'division_id' 						=> $scheduleemployeescheduleitem['division_id'],
							'department_id' 					=> $scheduleemployeescheduleitem['department_id'],
							'section_id' 						=> $scheduleemployeescheduleitem['section_id'],
							'unit_id' 							=> $scheduleemployeescheduleitem['unit_id'],
							'shift_id'							=> $scheduleemployeescheduleitem['shift_id'],
							'employee_shift_id' 				=> $scheduleemployeescheduleitem['employee_shift_id'],
							'employee_id' 						=> $scheduleemployeescheduleitem['employee_id'],
							'employee_rfid_code' 				=> $scheduleemployeescheduleitem['employee_rfid_code'],
							'employee_attendance_date_status'	=> $scheduleemployeescheduleitem['employee_schedule_item_date_status'],
							'employee_attendance_status'		=> 0,
							'employee_attendance_date'			=> $employee_meal_coupon_date,
							'machine_ip_address'				=> $machine_ip_address
						);



						/*$this->HroEmployeeMealCoupon_model->insertHROEmployeeAttendance($data_hroemployeeattendance);*/

						$data_update = array(
							'employee_schedule_item_id'						=> $scheduleemployeescheduleitem['employee_schedule_item_id'],
							'employee_id'									=> $data_HroEmployeeMealCoupon['employee_id'],
							'employee_schedule_item_date'					=> date('Y-m-d'),
							'employee_schedule_item_meal_coupon_date'		=> date('Y-m-d H:i:s'),
							'employee_schedule_item_meal_coupon_status'		=> 1,
						);

						$this->HroEmployeeMealCoupon_model->updateScheduleEmployeeScheduleItem_Coupon($data_update);

						$dataArrayHeader	= $this->session->userdata('addarrayHroEmployeeMealCoupon-'.$unique['unique']);

						$hroemployeedata    = $this->HroEmployeeMealCoupon_model->getHROEmployeeData_Detail($data['employee_rfid_code']);

						$data_HroEmployeeMealCoupon_array = array(
							'region_id'			=> $hroemployeedata['region_id'],
							'branch_id'			=> $hroemployeedata['branch_id'],
							'location_id'		=> $hroemployeedata['location_id'],
							'division_id'		=> $hroemployeedata['division_id'],
							'division_name'		=> $hroemployeedata['division_name'],
							'department_id'		=> $hroemployeedata['department_id'],
							'department_name'	=> $hroemployeedata['department_name'],
							'section_id'		=> $hroemployeedata['section_id'],
							'section_name'		=> $hroemployeedata['section_name'],
							'unit_id'			=> $hroemployeedata['unit_id'],
							'unit_name'			=> $hroemployeedata['unit_name'],
							'job_title_id'		=> $hroemployeedata['job_title_id'],
							'job_title_name'	=> $hroemployeedata['job_title_name'],
							'employee_shift_id'	=> $hroemployeedata['employee_shift_id'],
							'employee_id'		=> $hroemployeedata['employee_id'],
							'employee_code'		=> $hroemployeedata['employee_code'],
							'employee_name'		=> $hroemployeedata['employee_name'],
						);

						$dataArrayHeader = $data_HroEmployeeMealCoupon_array;

						/*print_r("hroemployeedata ");
						print_r($hroemployeedata);
						print_r("<BR>");
						print_r("data_HroEmployeeMealCoupon_array ");
						print_r($data_HroEmployeeMealCoupon_array);
						print_r("<BR>");
						print_r("dataArrayHeader ");
						print_r($dataArrayHeader);
						print_r("<BR>");
						exit;*/
						
						$this->session->set_userdata('addarrayHroEmployeeMealCoupon-'.$unique['unique'],$dataArrayHeader);

						$msg = "<div class='alert alert-success'>                
									Add Data Employee Meal Coupon Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addcoreunit');
						redirect('HroEmployeeMealCoupon');
					} else {
						$msg = "<div class='alert alert-danger'>                
								Employee Meal Coupon Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						$this->session->unset_userdata('addcoreunit');
						redirect('HroEmployeeMealCoupon');
					}

					
				} else {
					$msg = "<div class='alert alert-danger'>                
								Employee Data Can't Tapping
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addcoreunit');
					redirect('HroEmployeeMealCoupon');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addcoreunit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('HroEmployeeMealCoupon');
			}
		}
	}
?>