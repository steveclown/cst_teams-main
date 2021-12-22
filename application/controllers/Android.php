<?php
	Class Android extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('Android_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}

		public function index(){
			echo "index";
		}
		
		public function getImage(){
			// $this->model->Android_model();

			$image = $_POST['image'];
			$name = $_POST['name'];
		
			$realImage = base64_decode($image);
		
			// file_put_contents($name, $realImage);
		
			// echo "Image Uploaded yey yey.";

			$data = array(
				'image' =>$realImage,
				'name'  =>$name
			);

			if($data != null){
				$this->Android_model->saveData($data);
			};

		}

		public function getUserProfile(){
			$employee_id 	= $_POST['id_karyawan'];

			$data_karyawan 	= $this->Android_model->getUserProfile($employee_id);
			
			if(!empty($data_karyawan)){
				$json['employee_name']					= $data_karyawan['employee_name'];
				$json['employee_mobile_phone']			= $data_karyawan['employee_mobile_phone'];
				$json['employee_place_of_birth']		= $data_karyawan['employee_place_of_birth'];
				$json['employee_date_of_birth']			= $data_karyawan['employee_date_of_birth'];
				$json['employee_code']					= $data_karyawan['employee_code'];

				echo json_encode($json);

			}else{
				echo 'Silahkan re-login';
			}			
		}

		public function getEmployeeAttendanceHistory(){
			$employee_id 	= $_POST['employee_id'];

			 //$employee_id 	='11658';
			$date_now 		= date('Y-m-d');
			$date_last 		= date('Y-m-d', strtotime('-7 days', strtotime($date_now)));

			$data 	= $this->Android_model->getEmployeeAttendanceHistory($employee_id,$date_now,$date_last);
			
			if(!empty($data)){
				$json['history'] = $data;

				echo json_encode($json);

			}else{
				echo "";
			}
		}

		public function UpdatePassUser(){
			$this->load->model('Android_model');

			$user_id			= $_POST['user_id'];			
			$password_old		= $_POST['password_old'];
			$password_new		= $_POST['password_new'];
			$password_renew		= $_POST['password_renew'];

			$user_pass = $this->Android_model->getUserPass($user_id);
			$user_pass_old = md5($password_old);

			$data = array(
				'user_id'	=> $user_id,
				'password'	=> md5($password_new),				
			);
			if($password_renew == $password_new ){
				if($user_pass_old == $user_pass){
					if($this->Android_model->updateUserPass($data)){
						$json['value'] 			= 0;
						$json['message']		= 'Kata sandi berhasil diubah';
					}else{
						$json['value'] 			= 1;
						$json['message']		= 'Kata sandi gagal diubah';
						// $msg = "password gagal diubah";
					}
				}else{
					$json['value'] 			= 9;
					$json['message']		= 'Kata sandi Salah';
					// $msg = "Password Tidak Sesuai";
				}	
			}else{
				$json['value'] 			= 3;
				$json['message']		= 'Kata sandi Tidak Sesuai';
			}
			
			echo json_encode($json);		
		}

		public function editUserAvatar(){
			$this->load->model('Android_model');
			
			$image 				= $_POST['image'];
			$user_id			= $_POST['user_id'];
			$date_now			= date('YmdHis');
			$base_url 			= base_url();

			$realImage 			= base64_decode($image);

			if($user_id != '' || !empty($user_id)){
				$dataUser 		= $this->Android_model->getUserData($user_id);

				$photoname 		= $date_now.$dataUser['user_id'].$dataUser['employee_id']."ava".".jpg";	
				$uploads_dir 	= get_root_path()."/img/user_photo/";

				$data = array(
					'user_id'		=> $dataUser['user_id'],
					'avatar'		=> $photoname,
				);
				

				if($this->Android_model->SaveEditUserAvatar($data)){
					file_put_contents($uploads_dir.$photoname, $realImage);	
					
					$_NewDataUser 		= $this->Android_model->getUserData($dataUser['user_id']);

					if(!empty($_NewDataUser['avatar'])){
						$avatar 				= $base_url."img/user_photo/".$_NewDataUser['avatar'];
	
					}else{
						$avatar 				= $base_url."img/user_photo/default_profile.png";
	
					}
					
					$json['value'] 				= 1;
					$json['message'] 			= 'Foto profil diperbarui';
					$json['avatar']				= $avatar;
				}else{
					$json['value'] 				= 0;
					$json['message'] 			= 'Foto profil gagal diperbarui';
				}
	
			}else{
				$json['message'] 				= 'Terjadi masalah, coba lagi nanti';
			}

			echo json_encode($json);
		}

		
	}
?>