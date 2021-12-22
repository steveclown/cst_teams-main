<?php
	class CoreOvertimeCategory_model extends CI_Model {
		var $table = "core_overtime_category";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreOvertimeCategory()
		{
			$this->db->select('core_overtime_category.overtime_category_id, core_overtime_category.overtime_name');
			$this->db->from('core_overtime_category');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function saveNewCoreOvertimeCategory($data){
			return $this->db->insert('core_overtime_category',$data);
		}
		
		public function getCoreOvertimeCategory_Detail($OvertimeCategoryID){
			$this->db->select('core_overtime_category.overtime_category_id, core_overtime_category.overtime_name');
			$this->db->from('core_overtime_category');
			$this->db->where('core_overtime_category.overtime_category_id',$OvertimeCategoryID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreOvertimeCategory($data){
			$this->db->where('overtime_category_id',$data['overtime_category_id']);
			$query = $this->db->update('core_overtime_category', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreOvertimeCategory($OvertimeCategoryID){
			$this->db->where("overtime_category_id",$OvertimeCategoryID);
			$query = $this->db->update('core_overtime_category', array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>