<?php
	Class CoreLostItem extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreLostItem_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreLostItem']		= $this->CoreLostItem_model->getCoreLostItem();
			$data['main_view']['content']			= 'CoreLostItem/listCoreLostItem_view';
			$this->load->view('mainpage_view',$data);
		}

		public function addCoreLostItem(){
			$data['main_view']['content']		= 'CoreLostItem/formaddCoreLostItem_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLostItem-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreLostItem-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreLostItem-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreLostItem-'.$unique['unique'],$sessions);
		}

		public function reset_add(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreLostItem-'.$unique['unique']);	
			redirect('CoreLostItem/addCoreLostItem');
		}
		
		public function processAddCoreLostItem(){
			$data = array(
				'lost_item_code' 		=> $this->input->post('lost_item_code',true),
				'lost_item_name' 		=> $this->input->post('lost_item_name',true),
				'data_state'		=> 0
				
			);
			
			$this->form_validation->set_rules('lost_item_code', 'Lost Item Code', 'required');
			$this->form_validation->set_rules('lost_item_name', 'Lost Item Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreLostItem_model->insertCoreLostItem($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreLostItem.processAddlanguage',$auth['username'],'Add New coreCoreLostItem');
					$msg = "<div class='alert alert-success'>                
								Add Data Lost Item Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreLostItem');
					redirect('CoreLostItem/addCoreLostItem');
				}else{
					$msg = "<div class='alert alert-success'>                
								Add Data Lost Item UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLostItem/addCoreLostItem');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreLostItem',$data);
				$msg = validation_errors("<div class='alert alert-error'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLostItem/addCoreLostItem');
			}
		}
		
		public function editCoreLostItem(){
			$lost_item_id = $this->uri->segment(3);
			$data['main_view']['CoreLostItem']		= $this->CoreLostItem_model->getCoreLostItem_Detail($lost_item_id);
			$data['main_view']['content']			= 'CoreLostItem/formeditCoreLostItem_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreLostItem(){
			
			$data = array(
				'lost_item_id' 			=> $this->input->post('lost_item_id',true),
				'lost_item_code' 		=> $this->input->post('lost_item_code',true),
				'lost_item_name' 		=> $this->input->post('lost_item_name',true),
				'data_state'			=> '0'
			);
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('lost_item_code', 'Lost Item Code', 'required');
			$this->form_validation->set_rules('lost_item_name', 'Lost Item Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreLostItem_model->updateCoreLostItem($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreLostItem.Edit',$auth['username'],'Edit Core Bonus');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreLostItem_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Lost Item Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLostItem/editCoreLostItem/'.$data['lost_item_id']);
				}else{		
					$msg = "<div class='alert alert-success'>                
								Edit Lost Item UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreLostItem/editCoreLostItem/'.$data['lost_item_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreLostItem/editCoreLostItem'.$data['lost_item_id']);
			}
		}
		
				
		public function deleteCoreLostItem(){
			$lost_item_id = $this->uri->segment(3);
			if($this->CoreLostItem_model->deleteCoreLostItem($lost_item_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreLostItem.delete',$auth['username'],'Delete coreCoreLostItem');
				$msg = "<div class='alert alert-success'>                
							Delete Data Lost Item Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLostItem');
			}else{
				$msg = "<div class='alert alert-error'>                
							Delete Data Lost Item UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreLostItem');
			}
		}
	}
?>