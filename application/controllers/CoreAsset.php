<?php
	Class CoreAsset extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreAsset_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreAsset']		= $this->CoreAsset_model->getCoreAsset();
			$data['main_view']['content']		= 'CoreAsset/listCoreAsset_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreAsset(){
			$data['main_view']['content']		= 'CoreAsset/formaddCoreAsset_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreAsset(){
			$data = array(
				'asset_code' 		=> $this->input->post('asset_code',true),
				'asset_name' 		=> $this->input->post('asset_name',true),
				'data_state'		=> '0'
				
			);
			
			$this->form_validation->set_rules('asset_code', 'Asset Code', 'required');
			$this->form_validation->set_rules('asset_name', 'Asset Name', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreAsset_model->saveNewCoreAsset($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreAsset.processaddCoreAsset',$auth['username'],'Add NewAsset');
					$msg = "<div class='alert alert-success'>                
								Add Data Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreAsset');
					redirect('CoreAsset/addCoreAsset');
				}else{
					$msg = "<div class='alert alert-error'>                
								Add Data Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAsset/addCoreAsset');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreAsset',$data);
				$msg = validation_errors("<div class='alert alert-error'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreAsset/addCoreAsset');
			}
		}
		
		function editCoreAsset(){
			$data['main_view']['CoreAsset']		= $this->CoreAsset_model->getCoreAsset_Detail($this->uri->segment(3));
			$data['main_view']['content']		= 'CoreAsset/formeditCoreAsset_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreAsset(){
			
			$data = array(
				'asset_id' 			=> $this->input->post('asset_id',true),
				'asset_code' 		=> $this->input->post('asset_code',true),
				'asset_name' 		=> $this->input->post('asset_name',true),
				'data_state'		=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('asset_code', 'Asset Code', 'required');
			$this->form_validation->set_rules('asset_name', 'Asset Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreAsset_model->saveEditCoreAsset($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreAsset.Edit',$auth['username'],'EditAsset');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreAsset_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAsset/editCoreAsset/'.$data['asset_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreAsset/editCoreAsset/'.$data['asset_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreAsset/editCoreAsset/'.$data['asset_id']);
			}
		}
		
				
		function deleteCoreAsset(){
			if($this->CoreAsset_model->deleteCoreAsset($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreAsset.delete',$auth['username'],'DeleteAsset');
				$msg = "<div class='alert alert-success'>                
							Delete Data Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAsset');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreAsset');
			}
		}
	}
?>