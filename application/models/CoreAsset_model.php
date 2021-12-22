<?php
	class CoreAsset_model extends CI_Model {
		var $table = "core_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		public function getCoreAsset()
		{
			$this->db->select('core_asset.asset_id, core_asset.asset_code, core_asset.asset_name');
			$this->db->from('core_asset');
			$this->db->where('data_state', 0);
			return $this->db->get()->result_array();
		}
			
		public function saveNewCoreAsset($data){
			return $this->db->insert('core_asset',$data);
		}
		
		public function getCoreAsset_Detail($AssetID){
			$this->db->select('core_asset.asset_id, core_asset.asset_code, core_asset.asset_name , core_asset.data_state, core_asset.last_update');
			$this->db->from('core_asset');
			$this->db->where('core_asset.asset_id',$AssetID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreAsset($data){
			$this->db->where('asset_id',$data['asset_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}
		
		public function deleteCoreAsset($AssetID){
			$this->db->where("asset_id",$AssetID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
			return true;
			}else{
			return false;
			}
		}
	}
?>