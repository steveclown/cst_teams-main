<?php
	Class CoreLocation extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreLocation_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreLocation']		= $this->CoreLocation_model->getCoreLocation();
			$data['main_view']['content']			= 'CoreLocation/listCoreLocation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addCoreLocation(){
			$data['main_view']['content']			= 'CoreLocation/formaddCoreLocation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processAddCoreLocation(){
			$data = array(
				'location_code' 		=> $this->input->post('location_code',true),
				'location_name' 		=> $this->input->post('location_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('location_code', 'Location Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('location_name', 'Location Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreLocation_model->saveNewCoreLocation($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreLocation.processAddCoreLocation',$auth['username'],'Add New Location');
					$msg = "<div class='alert alert-success'>                
								Add New Location Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddLocation');
					redirect('CoreLocation/addCoreLocation');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add New Location UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddLocation',$data);
					redirect('CoreLocation/addCoreLocation');
				}
			}else{
				$this->session->set_userdata('AddLocation',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('addCoreLocation/addCoreLocation');
			}
		}
		
		function editCoreLocation(){
			$data['main_view']['CoreLocation']	= $this->CoreLocation_model->getCoreLocation_Detail($this->uri->segment(3));
			$data['main_view']['content']		= 'CoreLocation/formeditCoreLocation_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditCoreLocation(){
			$data = array(
				'location_id' 			=> $this->input->post('location_id',true),
				'location_code' 		=> $this->input->post('location_code',true),
				'location_name' 		=> $this->input->post('location_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('location_code', 'Location Code', 'required|alpha-numeric');
			$this->form_validation->set_rules('location_name', 'Location Name', 'required');
			$this->session->set_userdata('Edit',$data);
			
			if($this->form_validation->run()==true){
				if($this->CoreLocation_model->saveEditCoreLocation($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreLocation.Edit',$auth['username'],'Edit Location');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreLocation_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Location Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLocation/editCoreLocation/'.$data['location_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Location UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLocation/editCoreLocation/'.$data['location_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLocation/editCoreLocation'.$data['location_id']);
			}
		}
		
		function deleteCoreLocation(){
			if($this->CoreLocation_model->deleteCoreLocation($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreLocation.delete',$auth['username'],'Delete Location');
				$msg = "<div class='alert alert-success'>                
							Delete Location Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLocation');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Location Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLocation');
			}
		}
	}
?>