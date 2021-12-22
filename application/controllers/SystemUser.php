<?php
	Class SystemUser extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('SystemUser_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$auth   		= $this->session->userdata('auth');

			$region_id 		= $auth['region_id'];
			$branch_id		= $auth['branch_id'];
			$location_id	= $auth['location_id'];
			$user_group_id	= $auth['user_group_level'];

			$data['Main_view']['systemuser']	= $this->SystemUser_model->getSystemUser($region_id, $branch_id, $location_id, $user_group_id);
			$data['Main_view']['content']		= 'SystemUser/ListSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addsystemuser-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addsystemuser-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addsystemuser-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addsystemuser-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function userprofile(){
    		$auth   = $this->session->userdata('auth');
			// $data['Main_view']['hroemployeedata']	= $this->SystemUser_model->getHROEmployeeData_Detail($auth['employee_id']);
			$data['Main_view']['systemuser']		= $this->SystemUser_model->getSystemUser_Detail($auth['user_id']);
			$data['Main_view']['content']			= 'SystemUser/formuserprofile_view';
			$this->load->view('MainPage_view',$data);
		}

		public function processChangeUserProfile(){
			$data_user = array(
				'user_id'				=> $this->input->post('user_id', true),
				'username'				=> $this->input->post('username', true),
			);

			$data_employee = array(
				'employee_id'			=> $this->input->post('employee_id', true),
				'employee_mobile_phone'	=> $this->input->post('employee_mobile_phone', true),
			);

			$this->form_validation->set_rules('username', 'Username', 'required');
			
			if($this->form_validation->run()==true){
				if($this->SystemUser_model->editSystemUser($data_user)){
					$this->SystemUser_model->editHROEmployeeData($data_employee);
					$auth = $this->session->userdata('auth');
					/*$this->fungsi->set_log($auth['user_id'], $auth['username'],'3102','Application.coreTicketingType.processAddCoreTicketingType', $ticketing_type_id,'Add New Core Ticketing Type');*/
					$msg = "<div class='alert alert-success alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Update Data User Successfully
							</div> ";
					$this->session->unset_userdata('addcoreticketingtype');
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/userprofile');
				}else{
					$this->session->set_userdata('addcoreticketingtype',$data);
					$msg = "<div class='alert alert-danger alert-dismissable'>
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>					
								Update Data User UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/userprofile');
				}
			}else{
				$this->session->set_userdata('addcoreticketingtype',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/userprofile');
			}
		}

		public function processChangePassword(){
			$data_user = array(
				'user_id'				=> $this->input->post('user_id', true),
				'current_password'		=> $this->input->post('current_password', true),
				'new_password1'			=> $this->input->post('new_password', true),
				'retype_password1'		=> $this->input->post('retype_password', true),
				'new_password'			=> md5($this->input->post('new_password', true)),
				'retype_password'		=> md5($this->input->post('retype_password', true)),
			);

			/*print_r("data_user ");
			print_r($data_user);
			exit;*/

			$this->form_validation->set_rules('current_password', 'Current Password', 'required');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
			$this->form_validation->set_rules('retype_password', 'Re-Type Password', 'required');
			
			if($this->form_validation->run()==true){
				if($data_user['new_password1'] == $data_user['retype_password1']){
					if($this->SystemUser_model->getCheckUserName($data_user)){
						if($this->SystemUser_model->changeUserPassword($data_user)){
							$auth = $this->session->userdata('auth');
							/*$this->fungsi->set_log($auth['user_id'], $auth['username'],'3102','Application.coreTicketingType.processAddCoreTicketingType', $ticketing_type_id,'Add New Core Ticketing Type');*/
							$msg = "<div class='alert alert-success alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>
										Change User Password Successfully
									</div> ";
							$this->session->unset_userdata('addcoreticketingtype');
							$this->session->set_userdata('message',$msg);
							redirect('SystemUser/userprofile');
						}else{
							$this->session->set_userdata('addcoreticketingtype',$data);
							$msg = "<div class='alert alert-danger alert-dismissable'>
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
										Change User Password UnSuccessful
									</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('SystemUser/userprofile');
						}
					}else{
						$msg = "<div class='alert alert-danger'>                
							Username Does Not Exist !!!
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('SystemUser/userprofile');
					}
				}else{
					$msg = "<div class='alert alert-danger'>                
						Password do not Match!
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/userprofile');
				}
			}else{
				$this->session->set_userdata('addcoreticketingtype',$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/userprofile');
			}
		}

		public function changeEmployeePhoto(){
			$auth   		= $this->session->userdata('auth');
			$default_folder = $this->configuration->PhotoDirectory;
			$employee_id 	= $auth['employee_id'];

			$employeelocation = $this->SystemUser_model->getEmployeeLocation($employee_id);

			$region_code = $employeelocation['region_code'];
			$branch_code = $employeelocation['branch_code'];
			$location_code = $employeelocation['location_code'];
			$employee_code = $employeelocation['employee_code'];

			$photo_folder = $default_folder.$region_code.'/'.$branch_code.'/'.$location_code.'/';

			$employee_photo1 = $_FILES['employee_photo']['name'];
			$employee_photo = $employee_code.'_'.$employee_photo1;

			$data = array (
				'employee_id'		=> $employee_id,
				'employee_photo'	=> $employee_photo,
			);

			/*$newfilename = md5_file($_FILES['employee_photo']['tmp_name']);*/

			/*print_r("employeelocation ");
			print_r($employeelocation);
			print_r("<BR>");

			print_r("region_code ");
			print_r($region_code);
			print_r("<BR>");

			print_r("branch_code ");
			print_r($branch_code);
			print_r("<BR>");

			print_r("location_code ");
			print_r($location_code);
			print_r("<BR>");

			print_r("photo_folder ");
			print_r($photo_folder);
			print_r("<BR>");

			print_r("employee_photo ");
			print_r($employee_photo);
			print_r("<BR>");	
			exit;*/

			// if( !is_dir($tempat) ) {
			// mkdir($tempat, DIR_WRITE_MODE);
			// }
			
			if($_FILES['employee_photo']['error'] == 0 && $_FILES['employee_photo']['size']>0){
				$config['upload_path'] 		= $photo_folder;
				$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
				$config['overwrite'] 		= false;
				$config['remove_spaces'] 	= true;
				$config['file_name'] 		= $employee_photo;
				$this->load->library('upload', $config);
				if( $_POST AND $this->upload->do_upload('employee_photo') ) {
					$config['source_image'] 	= $this->upload->upload_path.$this->upload->file_name;
					$config['maintain_ratio'] 	= TRUE;
					$this->load->library('image_lib', $config);
					if ( ! $this->image_lib->resize()){
						$msg = "<div class='alert alert-danger'>                
							".$this->upload->display_errors('', '')."
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('SystemUser/userprofile');
					} else {
						$data = array(
							'employee_id' 		=> $auth['employee_id'],
							'employee_photo'	=> $this->upload->file_name
						);
					}
				}
			}else{
				$msg = "<div class='alert alert-success'>                
							Add Data User Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('adduser');
				redirect('SystemUser/userprofile');
			}

			
			if($this->SystemUser_model->changeEmployeePhoto($data)){
				$auth = $this->session->userdata('auth');
				/*$this->fungsi->set_log($auth['username'],'1003','Application.user.processadduser',$auth['username'],'Add New User Account');*/
					$msg = "<div class='alert alert-success'>                
						Change Employee Photo Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('adduser');
				redirect('SystemUser/userprofile');
			}else{
				$msg = "<div class='alert alert-danger'>                
						Add Data User UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/userprofile');
			}
		}

		public function addSystemUser(){
			$data['Main_view']['systemusergroup']	= create_double($this->SystemUser_model->getSystemUserGroup(),'user_group_id','user_group_name');
			$data['Main_view']['coreregion']		= create_double($this->SystemUser_model->getCoreRegion(),'region_id','region_name');
			$data['Main_view']['coredivision']		= create_double($this->SystemUser_model->getCoreDivision(),'division_id','division_name');
			$data['Main_view']['content']			= 'SystemUser/FormAddSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->SystemUser_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->SystemUser_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreBranch(){
			$region_id = $this->input->post('region_id');
			
			$item = $this->SystemUser_model->getCoreBranch($region_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[branch_id]'>$mp[branch_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreLocation(){
			$branch_id = $this->input->post('branch_id');
			
			$item = $this->SystemUser_model->getCoreLocation($branch_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[location_id]'>$mp[location_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData(){
			$auth = $this->session->userdata('auth');

			if ($auth['user_group_level'] == 1){
				$region_id 		= $this->input->post('region_id');
				$branch_id 		= $this->input->post('branch_id');
				$location_id 	= $this->input->post('location_id');
			}else {
				$region_id 		= $auth['region_id'];
				$branch_id		= $auth['branch_id'];
				$section_id		= $auth['section_id'];
			}

			$division_id 	= $this->input->post('division_id');
			$department_id 	= $this->input->post('department_id');
			$section_id 	= $this->input->post('section_id');
			
			$item = $this->SystemUser_model->getHROEmployeeData($region_id, $branch_id, $location_id, $division_id, $department_id, $section_id);

			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}


		public function processAddSystemUser(){
			$auth = $this->session->userdata('auth');

			$file			= $_FILES['user_photo']['name'];
			$file_size		= $_FILES['user_photo']['size'];
			$fileError 		= $_FILES['user_photo']['error'];
			
			if($file_size > 0){
				$parse			= explode('.',$file);
				$image_types 	= array('jpg','jpeg','png');

				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('SystemUser/addSystemUser');
				}
			}
			
			if (round($file_size/ 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
							filesize <b>".$file."</b> not allowed, max file 1 MB!!!
							</div>
				";
				$this->session->set_userdata('message',$message);
				redirect('SystemUser/addSystemUser');
			}				
			/*nama-nama file foto*/
			$num_str = sprintf("%06d", mt_rand(1, 999999));
			$avatarname 			= $num_str."ava".$_FILES['user_photo']['name'];			
			/*end nama-nama */

			// if ($auth['user_group_level'] == 1){
				$region_id		= $this->input->post('region_id',true);
				$branch_id		= $this->input->post('branch_id',true);
				$location_id	= $this->input->post('location_id',true);
			// }else {
			// 	$region_id 		= $auth['region_id'];
			// 	$branch_id		= $auth['branch_id'];
			// 	$section_id		= $auth['section_id'];
			// }

			if(empty($_FILES['user_photo']['name'])){
				$data = array(
					'region_id'		=> $region_id,
					'branch_id'		=> $branch_id,
					'location_id'	=> $location_id,
					'division_id'	=> $this->input->post('division_id',true),
					'department_id'	=> $this->input->post('department_id',true),
					'section_id'	=> $this->input->post('section_id',true),
					'employee_id'	=> $this->input->post('employee_id',true),
					'username' 		=> str_replace(";","",$this->input->post('username',true)),
					'password' 		=> md5($this->input->post('password',true)),
					'password_default_char' => "e10adc3949ba59abbe56e057f20f883e",
					'user_group_id' => $this->input->post('user_group_id',true),					
				);
			}else{
				$data = array(
					'region_id'		=> $region_id,
					'branch_id'		=> $branch_id,
					'location_id'	=> $location_id,
					'division_id'	=> $this->input->post('division_id',true),
					'department_id'	=> $this->input->post('department_id',true),
					'section_id'	=> $this->input->post('section_id',true),
					'employee_id'	=> $this->input->post('employee_id',true),
					'username' 		=> str_replace(";","",$this->input->post('username',true)),
					'password' 		=> md5($this->input->post('password',true)),
					'password_default_char' 		=>  "e10adc3949ba59abbe56e057f20f883e",
					'user_group_id' => $this->input->post('user_group_id',true),
					'avatar'		=> $avatarname
				);
			}
			

			$this->form_validation->set_rules('username', 'Username', 'required|is_unique[system_user.username]');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('user_group_id', 'Group Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');

			if($this->form_validation->run()==true){
				if($this->SystemUser_model->saveSystemUser($data)){
					$auth = $this->session->userdata('auth');
					$uploads_dir = get_root_path()."/img/user_photo/";
					$tmp_name = $_FILES["user_photo"]["tmp_name"];
					if(!empty($tmp_name)|| $tmp_name ==''){
						move_uploaded_file($tmp_name, $uploads_dir . $avatarname);						
					}

					// $this->fungsi->set_log($auth['username'],'1003','Application.user.processadduser',$auth['username'],'Add New User Account');
					$msg = "<div class='alert alert-success'>                
								Add Data User Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('adduser');
					redirect('SystemUser/addSystemUser');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data User UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/addSystemUser');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('adduser',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/addSystemUser');
			}
		}
		
		public function editSystemUser(){
			$user_id = $this->uri->segment(3);
			$data['Main_view']['systemusergroup']		= create_double($this->SystemUser_model->getSystemUserGroup(),'user_group_id','user_group_name');
			$data['Main_view']['systemuser']			= $this->SystemUser_model->getSystemUser_DetailEdit($user_id);
			$data['Main_view']['userstatus']			= $this->configuration->UserStatus();
			$data['Main_view']['workingstatus']			= $this->configuration->WorkingStatus();
			$data['Main_view']['content']				= 'SystemUser/FormEditSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditSystemUser(){
			$user_id 		=  $this->input->post('user_id');

			$file			= $_FILES['user_photo']['name'][$key];
			$file_size		= $_FILES['user_photo']['size'][$key];
			$fileError 		= $_FILES['user_photo']['error'][$key];
			
			if($file_size > 0){
				$parse			= explode('.',$file);
				$image_types 	= array('jpg','jpeg','png');

				if (!in_array($parse[count($parse)-1], $image_types)){
					$message = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                        
							filetype <b>".$parse[count($parse)-1]."</b> not allowed !!!
						</div> ";
					$this->session->set_userdata('message',$message);
					redirect('SystemUser/editSystemUser/'.$user_id);
				}
			}
			
			if (round($file_size/ 1024, 2) > 1024){
				$message = "<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                 
							filesize <b>".$file."</b> not allowed, max file 1 MB!!!
							</div>
				";
				$this->session->set_userdata('message',$message);
				redirect('SystemUser/editSystemUser/'.$user_id);
			}				
			/*nama-nama file foto*/
			$num_str = sprintf("%06d", mt_rand(1, 999999));
			$avatarname 			= $num_str."ava".$_FILES['user_photo']['name'];			
			/*end nama-nama */

			$data = array(
				'user_id' 								=> $this->input->post('user_id',true),
				'user_group_id' 						=> $this->input->post('user_group_id',true),
				'employee_employment_working_status'	=> $this->input->post('employee_employment_working_status',true),
				'user_status'							=> $this->input->post('user_status',true),
				'avatar'								=> $avatarname
			);

			$this->form_validation->set_rules('user_group_id', 'User Group Name', 'required');

			if($this->form_validation->run()==true){
				if($this->SystemUser_model->saveEditSystemUser($data)){
					$uploads_dir = get_root_path()."/img/user_photo/";
					$tmp_name = $_FILES["user_photo"]["tmp_name"];
					if(!empty($tmp_name)|| $tmp_name ==''){
						move_uploaded_file($tmp_name, $uploads_dir . $avatarname);						
					}

					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1004','Application.user.processedituser',$auth['username'],'Edit User Account');
					$msg = "<div class='alert alert-success'>                
								Edit Data User Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/editSystemUser/'.$data['user_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Data User UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/editSystemUser/'.$data['user_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/editSystemUser/'.$data['user_id']);
			}
		}

		public function resetPasswordSystemUser(){
			$user_id = $this->uri->segment(3);
			$data['Main_view']['systemusergroup']		= create_double($this->SystemUser_model->getSystemUserGroup(),'user_group_id','user_group_name');
			$data['Main_view']['systemuser']			= $this->SystemUser_model->getSystemUser_DetailEdit($user_id);
			$data['Main_view']['userstatus']			= $this->configuration->UserStatus;
			$data['Main_view']['workingstatus']			= $this->configuration->WorkingStatus;
			$data['Main_view']['content']				= 'SystemUser/FormResetPasswordSystemUser_view';
			$this->load->view('MainPage_view',$data);
		}

		public function processResetPasswordSystemUser(){
			$reset_password_default_char	= random_string('alnum', 8);

			$data_user = array(
				'user_id' 								=> $this->input->post('user_id',true),
				'password_default_char'					=> $reset_password_default_char,
				'password'								=> md5($reset_password_default_char),
			);

			$data_reset_password = array(
				'user_id' 								=> $this->input->post('user_id',true),
				'employee_id' 							=> $this->input->post('employee_id',true),
				'reset_password_default_char'			=> $reset_password_default_char,
				'reset_password_remark'					=> $this->input->post('reset_password_remark',true),
			);

			$this->form_validation->set_rules('user_id', 'User Name', 'required');

			if($this->form_validation->run()==true){
				if($this->SystemUser_model->saveEditResetPasswordSystemUser($data_user)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1004','Application.user.processedituser',$auth['username'],'Edit User Account');

					$this->SystemUser_model->saveNewResetPasswordSystemUser($data_reset_password);

					$msg = "<div class='alert alert-success'>                
								Reset Password User Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/resetPasswordSystemUser/'.$data['user_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Reset Password User UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('SystemUser/resetPasswordSystemUser/'.$data['user_id']);
				}
			}else{
				$data['password']='';
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('SystemUser/resetPasswordSystemUser/'.$data['user_id']);
			}
		}
		
		function delete(){
			if($this->user_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.user.delete',$auth['username'],'Delete User Account');
				$msg = "<div class='alert alert-success'>                
							Delete Data User Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('user');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data User UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('user');
			}
		}
		
		function test(){
			echo $this->user_model->isThisMenuInGroup('1','99');
		}
	}
?>