<?php
	Class PullAttLog_model extends CI_Model{
		var $table = "att_log";
		
		public function PullAttLog_model(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function saveLogData($data){
			$this->db->select('user_id, date, time')->from('att_log');
			$this->db->where('user_id',$data['user_id']);
			$this->db->where('date',$data['date']);
			$this->db->where('time',$data['time']);
			$exist = $this->db->get()->row_array();
			if(empty($exist)){
				if($this->db->insert($this->table, $data)){
					return true;
				}else{
					return false;
				}
			}
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
	}
?>