<?php
	class CoreEducation_model extends CI_Model {
		var $table = "core_education";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreEducation()
		{
			//Build contents query
			$this->db->select('core_education.education_id, core_education.education_code, core_education.education_name, core_education.education_type, core_education.education_remark');
			$this->db->from('core_education');
			$this->db->where('data_state', 0);			
			//Get contents
			$result = $this->db->get()->result_array();
			return $result;		
			
		}
		
		public function saveNewCoreEducation($data){
			return $this->db->insert('core_education',$data);
		}
		
		public function getCoreEducation_Detail($education_id){
			$this->db->select('core_education.education_id, core_education.education_code, core_education.education_name, core_education.education_type, core_education.education_remark');
			$this->db->from('core_education');
			$this->db->where('core_education.education_id',$education_id);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreEducation($data){
			$this->db->where('education_id',$data['education_id']);
			$query = $this->db->update('core_education', $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreEducation($education_id){
			if($this->db->delete('core_education',array('education_id'=>$education_id))){
				return true;
			}else{
				return false;
			}
		}

		public function getEducationType($education_id){
			$this->db->select('core_education.education_type');
			$this->db->from('core_education');
			$this->db->where('core_education.education_id', $education_id);
			$result = $this->db->get()->row_array();
			return $result['education_type'];
		}

	}
?>