<?php
	Class CoreUnit extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreUnit_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}

		public function index(){
			$data['Main_view']['CoreUnit']		= $this->CoreUnit_model->getCoreUnit();
			$data['Main_view']['content']		= 'CoreUnit/listCoreUnit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreUnit(){
			$data['Main_view']['coresection']			= create_double($this->CoreUnit_model->getCoreSection(),'section_id','section_name');
			$data['Main_view']['content']				= 'CoreUnit/formaddCoreUnit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processAddCoreUnit(){
			
			$data = array(
				'unit_code' 		=> $this->input->post('unit_code',true),
				'unit_name' 		=> $this->input->post('unit_name',true),
				'section_id'		=> $this->input->post('section_id',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('unit_code', 'Unit Code', 'required');
			$this->form_validation->set_rules('unit_name', 'Unit name', 'required');
			$this->form_validation->set_rules('section_id', 'Section name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreUnit_model->insertCoreUnit($data)){
					$auth = $this->session->userdata('auth');

					/*$this->fungsi->set_log($auth['username'],'1003','Application.CoreUnit.processaddCoreUnit',$auth['username'],'Add New Department');*/

					$msg = "<div class='alert alert-success'>                
								Add Data Unit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreUnit');
					redirect('CoreUnit/addCoreUnit');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Department UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreUnit',$data);
					redirect('CoreUnit/addCoreUnit');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreUnit',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreUnit/addCoreUnit');
			}
		}
		
		public function editCoreUnit(){
			$unit_id 							= $this->uri->segment(3);
			$data['Main_view']['coresection']	= create_double($this->CoreUnit_model->getCoreSection(),'section_id','section_name');
			$data['Main_view']['CoreUnit']		= $this->CoreUnit_model->getCoreUnit_Detail($unit_id);
			$data['Main_view']['content']		= 'CoreUnit/formeditCoreUnit_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditCoreUnit(){
			
			$data = array(
				'unit_id' 		=> $this->input->post('unit_id',true),
				'unit_code' 	=> $this->input->post('unit_code',true),
				'unit_name' 	=> $this->input->post('unit_name',true),
				'section_id'	=> $this->input->post('section_id',true),
				'data_state'	=> 0
			);
			
			$this->session->set_userdata('edit',$data);
			$this->form_validation->set_rules('unit_code', 'Unit Code', 'required');
			$this->form_validation->set_rules('unit_name', 'Unit name', 'required');
			
			if($this->form_validation->run()==true){
				if($this->CoreUnit_model->updateCoreUnit($data)==true){
					$auth 	= $this->session->userdata('auth');
					// $this->fungsi->set_log($auth['username'],'1077','Application.CoreUnit.edit',$auth['username'],'Edit CoreUnit');
					// $this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreUnit_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Unit Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreUnit/editCoreUnit/'.$data['unit_id']);
				}else{
					$msg = "<div class='alert alert-danger'>
								Edit Unit UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreUnit/editCoreUnit/'.$data['unit_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreUnit/editCoreUnit/'.$data['unit_id']);
			}
		}

		public function deleteCoreUnit(){
			$unit_id = $this->uri->segment(3);
			if($this->CoreUnit_model->deleteCoreUnit($unit_id)){
				$auth = $this->session->userdata('auth');
				/*$this->fungsi->set_log($auth['username'],'1005','Application.CoreUnit.delete',$auth['username'],'Delete CoreUnit');*/
				$msg = "<div class='alert alert-success'>                
							Delete Data Unit Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreUnit');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Unit UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreUnit');
			}
		}
	}
?>