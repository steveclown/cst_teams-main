<?php
	Class CoreLate extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreLate_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['Main_view']['CoreLate']			= $this->CoreLate_model->getCoreLate();
			$data['Main_view']['content']			= 'CoreLate/listCoreLate_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreLate(){
			$data['Main_view']['corededuction']		= create_double($this->CoreLate_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['Main_view']['content']			= 'CoreLate/formaddCoreLate_view';
			$this->load->view('MainPage_view',$data);
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreLate-'.$sesi['unique']);	
			redirect('CoreLate/addCoreLate');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLate-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreLate-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLate-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreLate-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function processAddCoreLate(){
			$data = array(
				'deduction_id'			=> $this->input->post('deduction_id',true),
				'late_code' 			=> $this->input->post('late_code',true),
				'late_name' 			=> $this->input->post('late_name',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('late_code', 'Late Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('late_name', 'Late Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreLate_model->saveNewCoreLate($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.CoreLate.processAddCoreLate',$auth['user_id'],'Add New Late');
					$msg = "<div class='alert alert-success'>                
								Add Data Late Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreLate');
					redirect('CoreLate/addCoreLate');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Late UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreLate',$data);
					redirect('CoreLate/addCoreLate');
				}
			}else{
				$this->session->set_userdata('addCoreLate',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreLate/addCoreLate');
			}
		}
		
		public function editCoreLate(){
			$late_id = $this->uri->segment(3);
			$data['Main_view']['corededuction']		= create_double($this->CoreLate_model->getCoreDeduction(),'deduction_id','deduction_name');
			$data['Main_view']['CoreLate']		= $this->CoreLate_model->getCoreLate_Detail($late_id);
			$data['Main_view']['content']			= 'CoreLate/formeditCoreLate_view';
			$this->load->view('MainPage_view',$data);
		}
		public function processEditCoreLate(){
			
			$data = array(
				'late_id' 				=> $this->input->post('late_id',true),
				'deduction_id' 			=> $this->input->post('deduction_id',true),
				'late_code' 			=> $this->input->post('late_code',true),
				'late_name' 			=> $this->input->post('late_name',true),
				'data_state'			=> 0
			);

			$this->form_validation->set_rules('deduction_id', 'Deduction Name', 'required');
			$this->form_validation->set_rules('late_code', 'Late Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('late_name', 'Late Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreLate_model->saveEditCoreLate($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['user_id'],'1077','Application.CoreLate.editCoreLate',$auth['user_id'],'Edit Late');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['late_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Late Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLate/editCoreLate/'.$data['late_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Edit Late UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLate/editCoreLate/'.$data['late_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreLate/editCoreLate/'.$data['late_id']);
			}
		}

		public function deleteCoreLate(){
			$deduction_id = $this->uri->segment(3);
			if($this->CoreLate_model->deleteCoreLate($deduction_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.CoreLate.deleteCoreLate',$auth['user_id'],'Delete Late');
				$msg = "<div class='alert alert-success'>                
							Delete Data Late Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLate');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Late UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLate');
			}
		}
	}
?>