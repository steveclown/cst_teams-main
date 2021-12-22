<?php
class pulldataemployee_model extends CI_Model {
	
	public function pulldataemployee_model(){
		parent::__construct();
		$this->CI = get_instance();
	}
	
	function checkifexist($machine_id, $id){
		$this->db->select('*')->from("attendance_employee");
		$this->db->where('machine_id', $machine_id);
		$this->db->where('id', $id);
		$num = $this->db->get()->num_rows();
		if($num > 0){
			return true;
		}else{
			return false;
		}
	}

	public function insertdata($data){
		return $this->db->insert("attendance_employee",$data);
	}

	public function updatedata($data){
		$this->db->where("machine_id",$data['machine_id']);
		$this->db->where("id",$data['id']);
		$query = $this->db->update("attendance_employee", $data);
		if($query){
			return true;
		}else{
			return false;
		}
	}
	
	function getmachine(){
		$this->db->select('machine_id, machine_name')->from("core_machine");
		$num = $this->db->get()->result_array();
		if($num == ""){
			return array();
		}else{
			return $num;
		}
	}

	function getmachineinfo($id){
		$this->db->select('machine_ip_address, machine_port')->from("core_machine");
		$this->db->select('machine_id', $id);
		$num = $this->db->get()->row_array();
		if($num == ""){
			return array();
		}else{
			return $num;
		}
	}
}