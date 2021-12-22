<?php defined('BASEPATH') OR exit('No direct script access allowed');

	class PreferenceRfid extends CI_Controller{
		public function __construct(){
			parent::__construct();
			/*$menu = 'shift';
			$this->cekLogin();
			$this->accessMenu($menu);*/

			$this->load->model('MainPage_model');
			//$this->load->model('Connection_model');
			$this->load->model('PreferenceRfid_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
		}

		public function index(){
			//$this->load->model('PreferenceRfid_model');
			$auth = $this->session->userdata('auth');

			$unique 		= $this->session->userdata('unique');
			$segment = $this->uri->segment(3);

			$data['main_view']['RfidMode']			= $this->configuration->RfidMode();
			$data['main_view']['PreferenceRfid']	= $this->PreferenceRfid_model->getPreferenceRfid();
			
			$data['main_view']['content']			= 'PreferenceRfid/ListPreferenceRfid_view';
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
					'ket' 		=> "device mode scan"
				);
			}		

			$json_msg_to_client = json_encode($msg_to_client);
			echo $json_msg_to_client;	
		}		  
	}
?>