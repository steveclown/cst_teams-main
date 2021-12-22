<?php
	class tax_model extends CI_Model {
		var $table = "core_tax";
		
		public function tax_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list()
		{
			//Select table name
			$table_name = "core_tax";
			
			//Build contents query
			$this->db->select('tax_id, tax_period, tax_type, tax_type')->from($table_name);
			$this->db->where('data_state', '0');
			// $this->db->where('u.user_group_id !=', '1');

			return $this->db->get()->result_array();
		}
		
		
		public function saveNewTax($data){
			return $this->db->insert('core_tax',$data);
		}
		
		public function getDetail($id){
			$this->db->select('tax_id, tax_period, tax_type, tax_type, data_state, last_update')->from($this->table);
			$this->db->where('tax_id',$id);
			return $this->db->get()->row_array();
		}
		
		
		public function saveEditTax($data){
			$this->db->where('tax_id',$data['tax_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function delete($id){
		$this->db->where("tax_id",$id);
		$query = $this->db->update($this->table, array("data_state"=>'1'));
			if($query){
			return true;
			}else{
			return false;
			}
		}

	}
?>