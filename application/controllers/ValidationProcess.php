<?php
	Class ValidationProcess extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('ValidationProcess_model');
			$this->load->model('MainPage_model');
			$this->load->model('HroEmployeeData_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database("default");
			$this->load->helper('url'); 
		}
		
		public function index(){
			$this->load->model('ValidationProcess_model');
			$posisition = str_replace('\'', '/', realpath(dirname(__FILE__))) . '/';
			$root		= str_replace('\'', '/', realpath($posisition . '../../')) . '/';
			
			$now = strtotime(date("Y-m-d"));
			$filename = $root.'parameter.par';
			if (file_exists($filename)) {
				$last = strtotime(date("Y-m-d", filectime($filename)));
				if($now>$last){
					$content ='';
					for($i=0;$i<5000;$i++){
						if ($i==2500){
							$content .= "?".get_unique().";";
						} else {
							$content .= chr(rand(128,248));
						}
					}
					$file = fopen($filename, 'w');		
					fwrite($file, $content);
					fclose($file);
				}
			} else {
				$content ='';
					for($i=0;$i<5000;$i++){
						if ($i==2500){
							$content .= "?".get_unique().";";
						} else {
							$content .= chr(rand(128,248));
						}
					}
					$file = fopen($filename, 'w');		
					fwrite($file, $content);
					fclose($file);
			}
			
			$this->load->view('LoginForm');
		}
		
		public function loginValidate(){
			$this->load->model('ValidationProcess_model');
			$unique_key = getKey();
			
			$data = array(
				'username' => $this->input->post('username',true),
				'password' => md5($this->input->post('password',true))
			);

			/*print_r("data ");
			print_r($data);
			exit;*/

			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('username', 'Username', 'required');

			$now 		= date("Y-m-d");
			//$last_date 	= date("2019-06-01");
			$last_date 	= date("2120-11-01");

			if ($now < $last_date){
				if($this->form_validation->run()==true){
					$verify 	= $this->ValidationProcess_model->verifyData($data);
					if(count($verify)>1){
							$this->fungsi->set_log($verify['user_id'], $verify['username'],'1001','Application.ValidationProcess.verifikasi',$verify['username'],'Login System');
							$this->session->set_userdata('auth', array(
												'user_id'					=> $verify['user_id'], 
												'username'					=> $verify['username'], 
												'password'					=> $verify['password'], 
												'user_group_level'			=> $verify['user_group_id'], 
												'region_id'					=> $verify['region_id'], 
												'branch_id'					=> $verify['branch_id'],
												'location_id'				=> $verify['location_id'],
												'employee_id'				=> $verify['employee_id'],
												'payroll_employee_level'	=> $verify['payroll_employee_level'],
												'employee_shift_id'			=> $verify['employee_shift_id']));
							redirect('Main');
					}else{
						$msg = "<div class='alert alert-error'>                
									Username dan Password tidak cocok !!!
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('ValidationProcess');
					}
				}else{
					$msg = validation_errors("<div class='alert alert-error'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('ValidationProcess');
				}
			} else {
				$msg = "<div class='alert alert-error'>                
							Unauthorized Login
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('ValidationProcess');
			}
		}

		public function lockvalidate(){
			$this->load->model('ValidationProcess_model');
			$unique_key = getKey();

			$auth = $this->session->userdata('auth');
			
			$data = array(
				'username' 	=> $auth['username'],
				'password1' => $this->input->post('password',true),
				'password' 	=> md5($this->input->post('password',true))
			);

			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if($this->form_validation->run()==true){			
				$verify 	= $this->ValidationProcess_model->verifyData($data);
				if(count($verify)>1){
						$this->fungsi->set_log($verify['username'],'1001','Application.ValidationProcess.verifikasi',$verify['username'],'Login System');
						$this->session->set_userdata('auth', array(
											'user_id'				=> $verify['user_id'], 
											'username'				=> $verify['username'], 
											'password'				=> $verify['password'], 
											'user_group_level'		=> $verify['user_group_id'], 
											'region_id'				=> $verify['region_id'], 
											'branch_id'				=> $verify['branch_id'],
											'location_id'			=> $verify['location_id'],
											'employee_id'			=> $verify['employee_id'],
											'employee_shift_id'		=> $verify['employee_shift_id']));
						redirect('main');
				}else{
					$msg = "<div class='alert alert-error'>                
								Username dan Password tidak cocok !!!
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('ValidationProcess/PageUserLock');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				/*$this->session->unset_userdata('auth');
				$this->session->destroy();*/
				redirect('ValidationProcess/PageUserLock');
			}
		}
		
		public function logout(){
			$this->load->model('ValidationProcess_model');
			$auth = $this->session->userdata('auth');
			/*$this->ValidationProcess_model->getLogout($auth);*/
			// $this->fungsi->set_log($auth['username'],'1002','Application.ValidationProcess.logout',$auth['username'],'Logout System');
			$this->session->unset_userdata('auth');
			$this->session->sess_destroy();
			redirect('ValidationProcess');
		}

		public function PageUserLock(){
			$auth = $this->session->userdata('auth');
			/*$this->ValidationProcess_model->getLogout($auth);*/
			$this->fungsi->set_log($auth['username'],'1002','Application.ValidationProcess.logout',$auth['username'],'Logout System');
			$this->load->view('PageUserLock');
		}
		
		public function warning(){
			$this->load->view('warning');
		}

		public function validasi(){		
			$this->load->model('ValidationProcess_model');	
			//flag to check and to execute specific switch case based on flag value sent
			$flag = $_POST['flag'];
			$jenkel = $this->configuration->Gender();
			$status	= $this->configuration->EmployeeStatus();

			//$flag = '1';
			(int) $flag;

			switch ($flag) {
				
				case 1:
						//assigning data sent to $Email which can be either email or mobile no in return we'll be sending email only
						$username 	= $_POST['username'];
						$password 	= md5($_POST['password']);
						$token 		= $_POST['token'];
						$base_url 	= base_url();

						$data = array(
							'username' => $username,
							'password' => $password,
						);
							$verify 				= $this->ValidationProcess_model->verifyData($data);
							//$verify['employee_id'] = '11656';
							$employee_rfid_code 	= $this->ValidationProcess_model->getEmployeeRfidCode($verify['employee_id']);
							$data_karyawan 			= $this->ValidationProcess_model->getUserProfile($verify['employee_id']);
							$address				= $data_karyawan['employee_address'].' rt'.$data_karyawan['employee_rt'].' rw'.$data_karyawan['employee_rw'].', '.$data_karyawan['employee_kelurahan'].', '.$data_karyawan['employee_kecamatan'].', '.$data_karyawan['employee_city'];
							
							$dataEmployee			=  $this->ValidationProcess_model->cekEmployee($verify['employee_id']);

							$empty_photo 			= "default_profile.png";

							if(!empty($verify['avatar'])){
								$avatar 				= $base_url."img/user_photo/".$verify['avatar'];

							}else{
								$avatar 				= $base_url."img/user_photo/default_profile.png";

							}
							
							//  print_r($data_karyawan['employee_gender']);
							
						if(count($verify)>1 && $dataEmployee == '0'){
							$json['value'] 				= 1;
							$json['message'] 			= 'User Successfully LoggedIn';
							$json['username'] 			= $verify['username'];
							// $json['password'] 			= $verify['username'];
							$json['employee_id'] 		= $verify['employee_id'];
							$json['user_id'] 			= $verify['user_id'];
							$json['user_group_level'] 	= $verify['user_group_id'];
							$json['region_id'] 			= $verify['region_id'];
							$json['branch_id'] 			= $verify['branch_id'];
							$json['location_id'] 		= $verify['location_id'];
							$json['employee_rfid_code']	= $employee_rfid_code['employee_rfid_code'];
							$json['status'] 			= 'success';
							/** profile */
							$json['employee_name']					= $data_karyawan['employee_name'];
							$json['employee_mobile_phone']			= $data_karyawan['employee_mobile_phone'];
							$json['employee_employment_status']		= $status[$data_karyawan['employee_employment_status']];
							$json['employee_gender']				= $jenkel[$data_karyawan['employee_gender']];
							$json['employee_email_address']			= $data_karyawan['employee_email_address'];
							$json['employee_division']				= $this->HroEmployeeData_model->getDivisionName($data_karyawan['division_id']);
							$json['employee_address']				= $address;
							$json['avatar']							= $avatar;
							$json['database']						= "teams pgs";

						}else{
							$json['value'] 			= 0;
							$json['message']		= 'Failed to LogIn';
							$json['username']		= '';
							$json['employee_id'] 	= '';
							$json['user_id'] 		= '';
							$json['status'] 		= 'failure';
						}					
						
						break;
						//Ends case 1	
				
				default:
					/* $inserted == 0; */
			}    
					
			echo json_encode($json);
			
		}
	}
?>