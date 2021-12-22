<?php
	Class ValidationProcess extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('ValidationProcess_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
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
			
			$this->load->view('loginForm');
		}
		
		public function loginValidate(){
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
			$last_date 	= date("2019-04-01");

			if ($now < $last_date){
				if($this->form_validation->run()==true){
					$verify 	= $this->ValidationProcess_model->verifyData($data);
					if(count($verify)>1){
							$this->fungsi->set_log($verify['username'],'1001','Application.validationprocess.verifikasi',$verify['username'],'Login System');
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
												'employee_shift_id'			=> $verify['employee_shift_id'],
												'branch_status'				=> $verify['branch_status']));
							redirect('main');
					}else{
						$msg = "<div class='alert alert-error'>                
									Username dan Password tidak cocok !!!
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('validationprocess');
					}
				}else{
					$msg = validation_errors("<div class='alert alert-error'>", '</div>');
					$this->session->set_userdata('message',$msg);
					redirect('validationprocess');
				}
			} else {
				$msg = "<div class='alert alert-error'>                
							Unauthorized Login
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('validationprocess');
			}
		}

		public function lockvalidate(){
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
						$this->fungsi->set_log($verify['username'],'1001','Application.validationprocess.verifikasi',$verify['username'],'Login System');
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
					redirect('validationprocess/pageuserlock');
				}
			}else{
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				/*$this->session->unset_userdata('auth');
				$this->session->destroy();*/
				redirect('validationprocess/pageuserlock');
			}
		}
		
		public function logout(){
			$auth = $this->session->userdata('auth');
			/*$this->ValidationProcess_model->getLogout($auth);*/
			$this->fungsi->set_log($auth['username'],'1002','Application.validationprocess.logout',$auth['username'],'Logout System');
			$this->session->unset_userdata('auth');
			$this->session->destroy();
			redirect('validationprocess');
		}

		public function pageuserlock(){
			$auth = $this->session->userdata('auth');
			/*$this->ValidationProcess_model->getLogout($auth);*/
			$this->fungsi->set_log($auth['username'],'1002','Application.validationprocess.logout',$auth['username'],'Logout System');
			$this->load->view('pageuserlock');
		}
		
		public function warning(){
			$this->load->view('warning');
		}
	}
?>