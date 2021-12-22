<?php
	Class CoreSaving extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreSaving_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreSaving']		= $this->CoreSaving_model->getCoreSaving();
			$data['main_view']['content']			= 'CoreSaving/listCoreSaving_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreSaving-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreSaving-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreSaving-'.$sesi['unique']);	
			redirect('CoreSaving/addCoreSaving');
		}
		
		public function addCoreSaving(){
			$data['main_view']['content']			= 'CoreSaving/formaddCoreSaving_view';

			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddCoreSaving(){
			$data = array(
				'saving_code' 			=> $this->input->post('saving_code',true),
				'saving_name' 			=> $this->input->post('saving_name',true),
				'saving_amount' 		=> $this->input->post('saving_amount',true),
				'data_state'			=> 0
				
			);
			
			$this->form_validation->set_rules('saving_code', 'Saving Code', 'required');
			$this->form_validation->set_rules('saving_name', 'Saving Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreSaving_model->insertCoreSaving($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreSaving.processAddCoreSaving',$auth['username'],'Add New Saving');
					$msg = "<div class='alert alert-success'>                
								Add Data Saving Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreSaving');
					redirect('CoreSaving/addCoreSaving');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Saving UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreSaving',$data);
					redirect('CoreSaving/addCoreSaving');
				}
			}else{
				$this->session->set_userdata('addCoreSaving',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreSaving/addCoreSaving');
			}
		}
		
		public function editCoreSaving(){
			$saving_id = $this->uri->segment(3);
			$data['main_view']['CoreSaving']		= $this->CoreSaving_model->getCoreSaving_Detail($saving_id);

			$data['main_view']['content']			= 'CoreSaving/formeditCoreSaving_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreSaving(){
			
			$data = array(
				'saving_id' 			=> $this->input->post('saving_id',true),
				'saving_code' 			=> $this->input->post('saving_code',true),
				'saving_name' 			=> $this->input->post('saving_name',true),
				'saving_amount' 		=> $this->input->post('saving_amount',true),
				'data_state'			=> 0
			);

			$this->form_validation->set_rules('saving_code', 'Section Code', 'required');
			$this->form_validation->set_rules('saving_name', 'Section Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreSaving_model->updateCoreSaving($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreSaving.edit',$auth['username'],'Edit CoreSaving');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreSaving_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Section Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSaving/editCoreSaving/'.$data['saving_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Edit Section UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreSaving/editCoreSaving/'.$data['saving_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreSaving/editCoreSaving/'.$data['saving_id']);
			}
		}

		public function deleteCoreSaving(){
			$saving_id = $this->uri->segment(3);
			if($this->CoreSaving_model->deleteCoreSaving($saving_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreSaving.delete',$auth['username'],'Delete Saving');
				$msg = "<div class='alert alert-success'>                
							Delete Data Saving Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreSaving');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Saving UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreSaving');
			}
		}
	}
?>