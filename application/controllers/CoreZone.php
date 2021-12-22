<?php
	Class CoreZone extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreZone_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreZone']		= $this->CoreZone_model->getCoreZone();
			$data['main_view']['content']		= 'CoreZone/listCoreZone_view';
			$this->load->view('mainpage_view',$data);
		}
			
		public function addCoreZone(){
			$data['main_view']['content']			= 'CoreZone/formaddCoreZone_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreZone-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreZone-'.$unique['unique'],$sessions);
		}

		public function reset_data(){
			$this->session->unset_userdata('addCoreZone');
			redirect('CoreZone/addCoreZone');
		}
		
		public function processAddCoreZone(){
			$data = array(
				'zone_code' 				=> $this->input->post('zone_code',true),
				'zone_name' 				=> $this->input->post('zone_name',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('zone_code', 'Zone Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('zone_name', 'Zone Name', 'required|filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->CoreZone_model->saveNewCoreZone($data)){
					$zone_id = $this->CoreZone_model->getZoneID();

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8122','Application.coreZone.processAddCoreZone', $zone_id,'Add New Core Zone');

					$msg = "<div class='alert alert-success'>                
								Add Data Zone Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreZone');
					redirect('CoreZone/addCoreZone');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Zone UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreZone',$data);
					redirect('CoreZone/addCoreZone');
				}
			}else{
				$this->session->set_userdata('addCoreZone',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreZone/addCoreZone');
			}
		}
		
		public function editCoreZone(){
			$zone_id = $this->uri->segment(3);
			$data['main_view']['CoreZone']		= $this->CoreZone_model->getCoreZone_Detail($zone_id);
			$data['main_view']['content']		= 'CoreZone/formeditCoreZone_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreZone(){
			$data = array(
				'zone_id' 				=> $this->input->post('zone_id',true),
				'zone_code' 			=> $this->input->post('zone_code',true),
				'zone_name' 			=> $this->input->post('zone_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('zone_code', 'Zone Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('zone_name', 'Zone Name', 'required|filterspecialchar');

			$old_data = $this->CoreZone_model->getCoreZone_Detail($data['zone_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreZone_model->saveEditCoreZone($data)==true){
					$auth 	= $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8123','Application.coreZone.processEditCoreZone', $zone_id,'Edit Core Zone');

					$this->fungsi->set_change_log($old_data, $data, $auth['user_id'], $data['zone_id']);

					$msg = "<div class='alert alert-success'>                
								Edit Zone Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreZone/editCoreZone/'.$data['zone_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Zone UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreZone/editCoreZone/'.$data['zone_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreZone/editCoreZone/'.$data['zone_id']);
			}
		}
		public function deleteCoreZone(){
			$zone_id = $this->uri->segment(3);
			if($this->CoreZone_model->deleteCoreZone($zone_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'],'8124','Application.coreZone.processDeleteCoreZone', $zone_id,'Delete Core Zone');

				$msg = "<div class='alert alert-success'>                
							Delete Data Zone Profile Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreZone');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Zone Profile UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreZone');
			}
		}
	}
?>