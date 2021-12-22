<?php
	class CoreLocation_model extends CI_Model {
		var $table = "core_location";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreLocation()
		{
			$this->db->select('core_location.location_id, core_location.location_code, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreLocation($data){
			return $this->db->insert('core_location',$data);
		}
		
		public function getCoreLocation_Detail($LocationID){
			$this->db->select('core_location.location_id, core_location.location_code, core_location.location_name');
			$this->db->from('core_location');
			$this->db->where('core_location.location_id',$LocationID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreLocation($data){
			$this->db->where('core_location.location_id',$data['location_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLocation($LocationID){
			$this->db->where("core_location.location_id",$LocationID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>