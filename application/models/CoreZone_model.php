<?php
	class CoreZone_model extends CI_Model {
		var $table = "core_zone";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreZone()
		{
			$this->db->select('core_zone.zone_id, core_zone.zone_code, core_zone.zone_name');
			$this->db->from('core_zone');
			$this->db->where('core_zone.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreZone($data){
			return $this->db->insert('core_zone',$data);
		}

		public function getZoneID(){
			$this->db->select('core_zone.zone_id');
			$this->db->from('core_zone');
			$this->db->order_by('core_zone.zone_id', 'DESC');
			$this->db->limit(1);
			$result = $this->db->get()->row_array();
			return $result['zone_id'];
		}
		
		public function getCoreZone_Detail($ZoneID){
			$this->db->select('core_zone.zone_id, core_zone.zone_code, core_zone.zone_name');
			$this->db->from('core_zone');
			$this->db->where('core_zone.zone_id', $ZoneID);
			$result = $this->db->get()->row_array();
			return $result;
		}
		
		public function saveEditCoreZone($data){
			$this->db->where("zone_id",$data['zone_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		public function deleteCoreZone($ZoneID){
			$this->db->where("zone_id",$ZoneID);
			$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>