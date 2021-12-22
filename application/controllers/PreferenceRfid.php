<?php

	Class PreferenceRfid extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('PreferenceRfid_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['RfidMode']			= $this->configuration->RfidMode();
			$data['Main_view']['PreferenceRfid']	= $this->PreferenceRfid_model->getPreferenceRfid();
			$data['Main_view']['content']			= 'PreferenceRfid/ListPreferenceRfid_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function editPreferenceRfidScan(){
			$this->load->model('PreferenceRfid_model');

			$preference_rfid_id = $this->uri->segment(3);

			$data = [
				"preference_rfid_id" 	=> $preference_rfid_id,
				"preference_rfid_mode"	=> 1  //MENGUBAH DEVICE KE MODE ADD
			];

			if($this->PreferenceRfid_model->updatePreferenceRfid($data)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3124','Application.CoreClass.deleteCoreClass', $class_id,'Delete Core Class');

				$msg = "<div class='alert alert-success alert-dismissable'>                  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Ganti mode device berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('PreferenceRfid');
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>    
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Ganti mode device gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('PreferenceRfid');
			}
		}

		public function editPreferenceRfidAdd(){
			$this->load->model('PreferenceRfid_model');

			$preference_rfid_id = $this->uri->segment(3);

			$data = [
				"preference_rfid_id" 	=> $preference_rfid_id,
				"preference_rfid_mode"	=> 0    //MENGUBAH DEVICE KE MODE SCAN
			];

			if($this->PreferenceRfid_model->updatePreferenceRfid($data)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'], '3124','Application.CoreClass.deleteCoreClass', $class_id,'Delete Core Class');

				$msg = "<div class='alert alert-success alert-dismissable'>                  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
							Ganti mode device berhasil
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('PreferenceRfid');

			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>    
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                
						Ganti mode device gagal
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('PreferenceRfid');
			}
		}

		function ModeDevice(){	
			$this->load->model('PreferenceRfid_model');		
			$iddev 	= $this->input->get('iddev');
			$preference_mode_rfid 	= $this->PreferenceRfid_model->getPreferenceRfidMode($iddev);

			if(!empty($preference_mode_rfid['preference_rfid_id'])){
				if ($preference_mode_rfid['preference_rfid_mode'] == 0) {
					$msg_to_client = array(
						'status' 	=> "ok",
						'mode'		=> "SCAN",
						'ket' 		=> "device mode scan"
					);
				}else{
					$msg_to_client = array(
						'status' 	=> "ok",
						'mode'		=> "ADD",
						'ket' 		=> "device mode add"
					);
				}		
			}else{
				$msg_to_client = array(
					'status' 	=> "ERROR",
					'mode'		=> "null",
					'ket' 		=> "device tidak terdafatar"
				);
			}

			$json_msg_to_client = json_encode($msg_to_client);
			echo $json_msg_to_client;	
		}	

		function ModeAdd(){	
			$this->load->model('PreferenceRfid_model');		
			$iddev 	= $this->input->get('iddev');
			$rfid 	= $this->input->get('rfid');

			$msg_to_client = array(
				'status' 	=> "rfid no",
				'mode'		=> $rfid,
				'ket' 		=> "new card found"
			);
		

			$json_msg_to_client = json_encode($msg_to_client);
			echo $json_msg_to_client;	
		}

		function getTime(){	
			$this->load->model('PreferenceRfid_model');		
			$iddev 	= $this->input->get('iddev');
			$preference_mode 	= $this->PreferenceRfid_model->getPreferenceRfidMode($iddev);
			
			$day	= date('D');
			
			$date 	= date('d-m-y');
			$time 	= date('H:i:s');
			$hari	= "";
			if($day == "Mon"){
				$hari = "Senin";
			}else if($day == "Tue"){
				$hari = "Selasa";
			}else if($day == "Wed"){
				$hari = "Rabu";
			}else if($day == "Thu"){
				$hari = "Kamis";
			}else if($day == "Fri"){
				$hari = "Jumat";
			}else if($day == "Sat"){
				$hari = "Sabtu";
			}else if($day == "Sun"){
				$hari = "Minggu";
			}else{
				$hari = "Unknown";
			}
			
			if(!empty($preference_mode['preference_rfid_id'])){
				$msg_to_client = array(
					'date' 		=> $hari.", ".$date,
					'time'		=> $time,
					'status' 	=> "get time ok"
				);
			}else{
				$msg_to_client = array(
					'date' 		=> "HARI, DD-MM-YY",
					'time'		=> "00:00:00",
					'status' 	=> "device unknown"
				);
			}

			$json_msg_to_client = json_encode($msg_to_client);
			echo $json_msg_to_client;	
		}
	}
?>