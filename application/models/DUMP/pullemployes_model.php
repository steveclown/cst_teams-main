<?php
	Class PullEmployes_model extends CI_Model{
		var $table = "att_employe";
		
		public function PullEmployes_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function saveEmployesData($data){
			$this->db->select('name,group')->from('att_employe');
			$this->db->where('user_id',$data['user_id']);
			$exist = $this->db->get()->row_array();
			if(empty($exist)){
				// $this->db->set('employed_id', 'getNewEmployesID()', FALSE);
				if($this->db->insert($this->table, $data)){
					return true;
				}else{
					return false;
				}
			}else{
				$this->db->where('user_id',$data['user_id']);
				if($this->db->update($this->table, $data)){
					return true;
				}else{
					return false;
				}
			}
		}
		public function saveEmployesDatatoHro($employee){
			$this->db->select('employee_name')->from('hro_employee_data');
			$this->db->where('user_id',$employee['user_id']);
			$exist = $this->db->get()->row_array();
			if(empty($exist)){
				// $this->db->set('employed_id', 'getNewEmployesID()', FALSE);
				if($this->db->insert('hro_employee_data', $employee)){
					return true;
				}else{
					return false;
				}
			}else{
				$this->db->where('user_id',$employee['user_id']);
				if($this->db->update('hro_employee_data', $employee)){
					return true;
				}else{
					return false;
				}
			}
		}
		public function getAlamatEmployee($data){
			$this->db->select('employee_address')->from('att_employe');
			$this->db->where('user_id',$data['user_id']);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_address'])){
				return '-';
			}else{
				return $result['employee_address'];
			}
		}
		public function getEmployeeKTP($data){
			$this->db->select('employee_ktp')->from('att_employe');
			$this->db->where('user_id',$data['user_id']);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_ktp'])){
				return '-';
			}else{
				return $result['employee_ktp'];
			}
		}
		public function getTTL($data){
			$this->db->select('employee_ttl')->from('att_employe');
			$this->db->where('user_id',$data['user_id']);
			$result = $this->db->get()->row_array();
			if(!isset($result['employee_ttl'])){
				return '-';
			}else{
				return $result['employee_ttl'];
			}
		}
		public function getdetail($user_id){
				$this->db->select('user_id, name, password, employee_address, employee_ktp, employee_ttl');
				$this->db->from('att_employe');
				$this->db->where('user_id',$user_id);
				return $this->db->get()->row_array();
			
		}
		public function saveEditEmployee($data){
			$this->db->where('user_id',$data['user_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>