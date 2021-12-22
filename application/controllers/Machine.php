<?php
	Class Machine extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('Machine_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['Main_view']['Machine']		= $this->Machine_model->get_list();
			$data['Main_view']['content']		= 'Machine/ListMachine_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function addMachine(){
			$data['Main_view']['content']	= 'Machine/FormAddMachine_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processaddMachine(){
			$auth = $this->session->userdata("auth");
			
			$data = array(
				'machine_code' 			=> $this->input->post('machine_code',true),
				'machine_name' 			=> $this->input->post('machine_name',true),
				'machine_ip_address' 	=> $this->input->post('machine_ip_address',true),
				'machine_port' 			=> $this->input->post('machine_port',true),
				'machine_remark' 		=> $this->input->post('machine_remark',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('machine_code', 'Code', 'required');
			$this->form_validation->set_rules('machine_name', 'Name', 'required');
			$this->form_validation->set_rules('machine_ip_address', 'Ip Address', 'required');
			// $this->form_validation->set_rules('machine_port', 'Port', 'required|numeric');
			// $this->form_validation->set_rules('machine_remark', 'Remark', 'required');
			
			if($this->form_validation->run()==true){
				if($this->Machine_model->savenewmachine($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.Machine.processaddMachine',$auth['username'],'Add New Machine');
					$msg = "<div class='alert alert-success'>                
								Add Data Machine Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('add');
					redirect('Machine/addMachine');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Machine UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('add',$data);
					redirect('Machine/addMachine');
				}
			}else{
				$this->session->set_userdata('addMachine',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('Machine/addMachine');
			}
		}
		
		function editMachine(){
			$data['Main_view']['result']	= $this->Machine_model->getdetail($this->uri->segment(3));
			$data['Main_view']['content']	= 'Machine/FormEditMachine_view';
			$this->load->view('MainPage_view',$data);
		}
		
		function processeditMachine(){
			$auth = $this->session->userdata("auth");
			$data = array(
				'machine_id' 			=> $this->input->post('machine_id',true),
				'machine_code' 			=> $this->input->post('machine_code',true),
				'machine_name' 			=> $this->input->post('machine_name',true),
				'machine_ip_address' 	=> $this->input->post('machine_ip_address',true),
				'machine_port' 			=> $this->input->post('machine_port',true),
				'machine_remark' 		=> $this->input->post('machine_remark',true),
				'data_state'			=> 0
			);
			$this->form_validation->set_rules('machine_code', 'Code', 'required');
			$this->form_validation->set_rules('machine_name', 'Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->Machine_model->saveeditmachine($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.Machine.edit',$auth['username'],'Edit Machine');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['machine_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Machine Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('Machine/editMachine/'.$data['machine_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Machine UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('Machine/editMachine/'.$data['machine_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('Machine/editMachine/'.$data['machine_id']);
			}
		}

				
		function deleteMachine(){
			if($this->Machine_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.Machine.delete',$auth['username'],'Delete Machine');
				$msg = "<div class='alert alert-success'>                
							Delete Data Machine Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('Machine');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Machine UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('Machine');
			}
		}
	}
?>