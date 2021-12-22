<?php
	class attendanceregistration_model extends CI_Model {
		var $table = "attendance_employee";
		
		public function attendanceregistration_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function get_list($sesi){
			//Select table name
			$table_name = "attendance_employee";
			
			//Build contents query
			$this->db->select('*')->from($table_name);
				if($sesi[machine_id] != ''){
					$this->db->where('machine_id', $sesi[machine_id]);
				}
				if($sesi[attendance_status] != '' && $sesi[attendance_status] == 'assigned'){
					$this->db->where('employee_id != "0"');
				}
				if($sesi[attendance_status] != '' && $sesi[attendance_status] == 'unassigned'){
					$this->db->where('employee_id = "0"');
				}
			return $this->db->get()->result_array();
		}
		
		public function getattendanceemployee(){
			$this->db->select('attendance_employee_id, name')->from("attendance_employee");
			return $this->db->get()->result_array();
		}

		public function saveeditattendanceregistration($data){
			$this->db->where('attendance_employee_id',$data['attendance_employee_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function getemployeename($id){
			$this->db->select('employee_name')->from('hro_employee_data');
			$this->db->where('employee_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_name'])){
				return '-';
			}else{
				return $result['employee_name'];
			}
		}

		public function getmachinename($id){
			$this->db->select('machine_name')->from('core_machine');
			$this->db->where('machine_id',$id);
			$result = $this->db->get()->row_array();
			if(!isset($result['machine_name'])){
				return '-';
			}else{
				return $result['machine_name'];
			}
		}

		public function getmachine(){
			$this->db->select('machine_id, machine_name')->from('core_machine');
			$this->db->where('data_state', '0');
			return $this->db->get()->result_array();
		}
	}
?>