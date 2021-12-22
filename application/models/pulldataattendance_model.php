<?php
class pulldataattendance_model extends CI_Model {
	
	public function pulldataattendance_model(){
		parent::__construct();
		$this->CI = get_instance();
	}
	
	function checkifexistbyindex($attendance_employee_id, $index){
		$this->db->select('*')->from("attendance_log");
		$this->db->where('attendance_employee_id', $attendance_employee_id);
		$this->db->where('index', $index);
		$num = $this->db->get()->num_rows();
		if($num > 0){
			return true;
		}else{
			return false;
		}
	}

	function checkifexistbydatetime($attendance_employee_id, $date, $time){
		$this->db->select('*')->from("attendance_log");
		$this->db->where('attendance_employee_id', $attendance_employee_id);
		$this->db->where('date', $date);
		$this->db->where('time', $time);
		$num = $this->db->get()->num_rows();
		if($num > 0){
			return true;
		}else{
			return false;
		}
	}

	function getattendanceemployeeid($machine_id, $id){
		$this->db->select('attendance_employee_id')->from("attendance_employee");
		$this->db->where('machine_id', $machine_id);
		$this->db->where('id', $id);
		$num = $this->db->get()->row_array();
		// print_r($num);exit;
		if($num == ""){
			return array();
		}else{
			return $num[attendance_employee_id];
		}
	}

	public function insertdata($data){
		return $this->db->insert("attendance_log",$data);
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