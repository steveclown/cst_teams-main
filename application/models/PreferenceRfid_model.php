<?php
	class PreferenceRfid_model extends CI_Model {
		var $table = "preference_rfid";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
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
		

		public function getPreferenceRfidMode($deviceid){
			$this->db->select('preference_rfid.preference_rfid_id,preference_rfid.preference_rfid_mode');
			$this->db->from('preference_rfid');
			$this->db->where('preference_rfid.data_state', 0);
			$this->db->where('preference_rfid.preference_rfid_device_id', $deviceid);
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