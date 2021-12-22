<?php
	Class pulldataemployee extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('pulldataemployee_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['pulldataemployee']		= $this->pulldataemployee_model->get_list();
			$data['main_view']['content']	= 'pulldataemployee/listpulldataemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function add(){
			$data['main_view']['content']	= 'pulldataemployee/formaddpulldataemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processaddpulldataemployee(){
			$data = array(
				'pulldataemployee_code' 		=> $this->input->post('pulldataemployee_code',true),
				'pulldataemployee_name' 		=> $this->input->post('pulldataemployee_name',true),
				'data_state'		=> '0'
			);
			
			$this->form_validation->set_rules('pulldataemployee_code', 'Pull Data Employee Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('pulldataemployee_name', 'Pull Data Employee Name', 'required');
			if($this->form_validation->run()==true){
				if($this->pulldataemployee_model->savenewpulldataemployee($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.pulldataemployee.processaddpulldataemployee',$auth['username'],'Add New pulldataemployee');
					$msg = "<div class='alert alert-success'>                
								Add Data Pull Data Employee Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpulldataemployee');
					redirect('pulldataemployee/add');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Pull Data Employee UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addpulldataemployee',$data);
					redirect('pulldataemployee/add');
				}
			}else{
				$this->session->set_userdata('addpulldataemployee',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('pulldataemployee/add');
			}
		}
		
		function edit(){
			$data['main_view']['result']	= $this->pulldataemployee_model->getdetail($this->uri->segment(3));
			$data['main_view']['content']	= 'pulldataemployee/formeditpulldataemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processeditpulldataemployee(){
			$data = array(
				'pulldataemployee_id' 			=> $this->input->post('pulldataemployee_id',true),
				'pulldataemployee_code' 		=> $this->input->post('pulldataemployee_code',true),
				'pulldataemployee_name' 		=> $this->input->post('pulldataemployee_name',true),
				'data_state'		=> '0'
			);
			$this->form_validation->set_rules('pulldataemployee_code', 'Pull Data Employee Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('pulldataemployee_name', 'Pull Data Employee Name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->pulldataemployee_model->saveeditpulldataemployee($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.pulldataemployee.edit',$auth['username'],'Edit pulldataemployee');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['pulldataemployee_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Pull Data Employee Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('pulldataemployee/edit/'.$data['pulldataemployee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Pull Data Employee UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('pulldataemployee/edit/'.$data['pulldataemployee_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('pulldataemployee/edit/'.$data['pulldataemployee_id']);
			}
		}

				
		function delete(){
			if($this->pulldataemployee_model->delete($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.pulldataemployee.delete',$auth['username'],'Delete pulldataemployee');
				$msg = "<div class='alert alert-success'>                
							Delete Data Pull Data Employee Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('pulldataemployee');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Pull Data Employee UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('pulldataemployee');
			}
		}
	}
?>