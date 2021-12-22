<?php
	class PreferenceRfid_model extends CI_Model {
		var $table = "preference_rfid";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();

			// $this->CI->load->model('Connection_model');
			// $this->CI->load->dbforge();

			// $auth 			= $this->session->userdata('auth');			
			// $db_user 		= $this->Connection_model->define_database($auth['database']);
			// $this->db_user 	= $this->load->database($db_user, true);
		}
			 
		public function getPreferenceRfid()
		{
			//Build contents query
			$this->db->select('*');
			$this->db->from('preference_rfid');
			$this->db->where('data_state', '0');
			
			//Get contents
			return $this->db->get()->result_array();
			
		}
		
		// public function getPreferenceRfid(){
		// 	$this->db->select('preference_rfid.preference_rfid_id, preference_rfid.preference_rfid_device_id,preference_rfid.preference_rfid_mode');
		// 	$this->db->from('preference_rfid');
		// 	$this->db->where('preference_rfid.data_state', 0);
		// 	//$this->db->where('preference_rfid.rfid_device_id', $deviceid);			
		// 	$result = $this->db->get()->result_array();
		// 	return $result;
		// }

		public function getPreferenceRfidMode($deviceid){
			$this->db->select('preference_rfid.preference_rfid_id,preference_rfid.preference_rfid_mode');
			$this->db->from('preference_rfid');
			$this->db->where('preference_rfid.data_state', 0);
			$this->db->where('preference_rfid.rfid_device_id', $deviceid);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function insertPreferenceRfid($data){
			return $this->db->insert('preference_rfid', $data);
		}

		
		public function updatePreferenceRfid($data){
			$this->db->where('preference_rfid.preference_rfid_id', $data['preference_rfid_id']);
			$query = $this->db->update('preference_rfid', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>