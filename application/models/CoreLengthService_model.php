<?php
	class CoreLengthService_model extends CI_Model {
		var $table = "core_length_service";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreLengthService()
		{
			$this->db->select('core_length_service.length_service_id, core_length_service.length_service_code, core_length_service.length_service_name, core_length_service.length_service_range1, core_length_service.length_service_range2, core_length_service.length_service_amount, core_length_service.length_service_remark');
			$this->db->from('core_length_service');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreLengthService($data){
			return $this->db->insert('core_length_service',$data);
		}
		
		public function getCoreLengthService_Detail($LengthServiceID){
			$this->db->select('core_length_service.length_service_id, core_length_service.length_service_code, core_length_service.length_service_name, core_length_service.length_service_range1, core_length_service.length_service_range2, core_length_service.length_service_amount, core_length_service.length_service_remark');
			$this->db->from('core_length_service');
			$this->db->where('length_service_id',$LengthServiceID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreLengthService($data){
			$this->db->where('core_length_service.length_service_id',$data['length_service_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreLengthService($LengthServiceID){
			$this->db->where("length_service_id",$LengthServiceID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}

	}
?>