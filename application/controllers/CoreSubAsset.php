<?php
	Class CoreSubAsset extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreSubAsset_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreSubAsset']		= $this->CoreSubAsset_model->getCoreSubAsset();
			$data['main_view']['content']			= 'CoreSubAsset/listCoreSubAsset_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreSubAsset(){
			$data['main_view']['coreasset']			= create_double($this->CoreSubAsset_model->getCoreAsset(),'asset_id','asset_name');
			$data['main_view']['content']			= 'CoreSubAsset/formaddCoreSubAsset_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreSubAsset(){
			$data = array(
				'sub_asset_code' 		=> $this->input->post('sub_asset_code',true),
				'sub_asset_name' 		=> $this->input->post('sub_asset_name',true),
				'asset_id' 				=> $this->input->post('asset_id',true),
				'data_state'			=> '0'
			);
			$this->form_validation->set_rules('sub_asset_code', 'Sub Asset Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('sub_asset_name', 'Sub Asset Name', 'required');
			$this->form_validation->set_rules('asset_id', 'Asset Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreSubAsset_model->saveNewCoreSubAsset($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreSubAsset.processaddCoreSubAsset',$auth['username'],'Add New Sub asset');
					$msg = "<div class='alert alert-success'>                
								Add Data Sub Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreSubAsset');
					redirect('CoreSubAsset/addCoreSubAsset');
				}else{
					$msg = "<div class='alert alert-danger'>
								Add Data Sub Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSubAsset/addCoreSubAsset');
				}
			}else{
				$this->session->set_userdata('addCoreSubAsset',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreSubAsset/addCoreSubAsset');
			}
		}
		
		function editCoreSubAsset(){
			$data['main_view']['coreasset']			= create_double($this->CoreSubAsset_model->getCoreAsset(),'asset_id','asset_name');
			$data['main_view']['CoreSubAsset']		= $this->CoreSubAsset_model->getCoreSubAsset_Detail($this->uri->segment(3));
			$data['main_view']['content']			= 'CoreSubAsset/formeditCoreSubAsset_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreSubAsset(){
			
			$data = array(
				'sub_asset_id' 			=> $this->input->post('sub_asset_id',true),
				'sub_asset_code' 		=> $this->input->post('sub_asset_code',true),
				'sub_asset_name' 		=> $this->input->post('sub_asset_name',true),
				'asset_id' 				=> $this->input->post('asset_id',true),
				'data_state'			=> '0'
			);
			$this->session->set_userdata('edit',$data);
			$this->form_validation->set_rules('sub_asset_code', 'Sub Asset Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('sub_asset_name', 'Sub Asset Name', 'required');
			$this->form_validation->set_rules('asset_id', 'Asset Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreSubAsset_model->saveEditCoreSubAsset($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreSubAsset.edit',$auth['username'],'Edit Sub Asset');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['sub_asset_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Sub Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSubAsset/editCoreSubAsset/'.$data['sub_asset_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Sub Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSubAsset/editCoreSubAsset/'.$data['sub_asset_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreSubAsset/editCoreSubAsset/'.$data['sub_asset_id']);
			}
		}
				
		function deleteCoreSubAsset(){
			if($this->CoreSubAsset_model->deleteCoreSubAsset($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreSubAsset.delete',$auth['username'],'Delete Sub Asset');
				$msg = "<div class='alert alert-success'>                
							Delete Data Sub Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreSubAsset');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Sub Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreSubAsset');
			}
		}
	}
?>