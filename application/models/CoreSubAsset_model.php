<?php
	class CoreSubAsset_model extends CI_Model {
		var $table = "core_sub_asset";
		
		public function __construct(){
			parent::__construct();
			$this->CI = get_instance();
		}
		
		public function getCoreSubAsset()
		{
			$this->db->select('core_sub_asset.sub_asset_id, core_sub_asset.sub_asset_code, core_sub_asset.sub_asset_name, core_sub_asset.asset_id');
			$this->db->from('core_sub_asset');
			$this->db->where('core_sub_asset.data_state', 0);
			return $this->db->get()->result_array();
		}
		
		public function getCoreAsset(){
			$this->db->select('core_asset.asset_id, core_asset.asset_name');
			$this->db->from('core_asset');
			$this->db->where('core_asset.data_state',0);
			$result = $this->db->get();
			return $result->result_array();
		}
		
		public function getAssetName($AssetID){
			$this->db->select('core_asset.asset_name');
			$this->db->from('core_asset');
			$this->db->where('core_asset.asset_id',$AssetID);
			$result=$this->db->get()->row_array();
			return $result['asset_name'];
		}
		
		public function saveNewCoreSubAsset($data){
			return $this->db->insert('core_sub_asset',$data);
		}
		
		public function getCoreSubAsset_Detail($SubAssetID){
			$this->db->select('core_sub_asset.sub_asset_id, core_sub_asset.sub_asset_code, core_sub_asset.sub_asset_name, core_sub_asset.asset_id, core_sub_asset.data_state, core_sub_asset.last_update');
			$this->db->from('core_sub_asset');
			$this->db->where('sub_asset_id',$SubAssetID);
			return $this->db->get()->row_array();
		}
		
		public function saveEditCoreSubAsset($data){
			$this->db->where('sub_asset_id',$data['sub_asset_id']);
			$query = $this->db->update($this->table, $data);
			if($query){
				return true;
			}else{
				return false;
			}
		}

		public function deleteCoreSubAsset($SubAssetID){
			$this->db->where("sub_asset_id",$SubAssetID);
			$query = $this->db->update($this->table, array("data_state"=>1));
			if($query){
				return true;
			}else{
				return false;
			}
		}
	}
?>