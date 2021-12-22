<?php
	Class CoreCustomer extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreCustomer_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreCustomer']		= $this->CoreCustomer_model->getCoreCustomer();
			$data['main_view']['content']			= 'CoreCustomer/listCoreCustomer_view';
			$this->load->view('mainpage_view',$data);
		}
			
		public function addCoreCustomer(){
			$data['main_view']['content']			= 'CoreCustomer/formaddCoreCustomer_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreCustomer-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreCustomer-'.$unique['unique'],$sessions);
		}

		public function reset_data(){
			$this->session->unset_userdata('addCoreCustomer');
			redirect('CoreCustomer/addCoreCustomer');
		}
		
		public function processAddCoreCustomer(){
			$data = array(
				'customer_code' 		=> $this->input->post('customer_code',true),
				'customer_name' 		=> $this->input->post('customer_name',true),
				'customer_address' 		=> $this->input->post('customer_address',true),
				'customer_city' 		=> $this->input->post('customer_city',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('customer_code', 'Customer Code', 'required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
			$this->form_validation->set_rules('customer_address', 'Customer address', 'required');
			$this->form_validation->set_rules('customer_city', 'Customer City', 'required');
						
			if($this->form_validation->run()==true){
				if($this->CoreCustomer_model->saveNewCoreCustomer($data)){
					$customer_id = $this->CoreCustomer_model->getCustomerID();

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8132','Application.coreCustomer.processAddCoreCustomer', $customer_id,'Add New Core Customer');

					$msg = "<div class='alert alert-success'>                
								Add Data Customer Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreCustomer');
					redirect('CoreCustomer/addCoreCustomer');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Customer UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('addCoreCustomer',$data);
					redirect('CoreCustomer/addCoreCustomer');
				}
			}else{
				$this->session->set_userdata('addCoreCustomer',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreCustomer/addCoreCustomer');
			}
		}
		
		public function editCoreCustomer(){
			$customer_id = $this->uri->segment(3);
			$data['main_view']['CoreCustomer']	= $this->CoreCustomer_model->getCoreCustomer_Detail($customer_id);
			$data['main_view']['content']		= 'CoreCustomer/formeditCoreCustomer_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreCustomer(){
			$data = array(
				'customer_id' 			=> $this->input->post('customer_id',true),
				'customer_code' 		=> $this->input->post('customer_code',true),
				'customer_name' 		=> $this->input->post('customer_name',true),
				'customer_address' 		=> $this->input->post('customer_address',true),
				'customer_city'		 	=> $this->input->post('customer_city',true),
				'data_state'			=> 0
			);
			
			$this->form_validation->set_rules('customer_code', 'Customer Code', 'required');
			$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
			$this->form_validation->set_rules('customer_address', 'Customer address', 'required');
			$this->form_validation->set_rules('customer_city', 'Customer City', 'required');

			$old_data = $this->CoreCustomer_model->getCoreCustomer_Detail($data['customer_id']);
			
			if($this->form_validation->run()==true){
				if($this->CoreCustomer_model->saveEditCoreCustomer($data)==true){
					$auth 	= $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8133','Application.coreCustomer.processEditCoreCustomer', $zone_id,'Edit Core Customer');

					$this->fungsi->set_change_log($old_data, $data, $auth['user_id'], $data['customer_id']);

					$msg = "<div class='alert alert-success'>                
								Edit Customer Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCustomer/editCoreCustomer/'.$data['customer_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Customer UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCustomer/editCoreCustomer/'.$data['customer_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ");
				$this->session->set_userdata('message',$msg);
				redirect('CoreCustomer/editCoreCustomer/'.$data['customer_id']);
			}
		}
		
		public function deleteCoreCustomer(){
			$customer_id = $this->uri->segment(3);
			if($this->CoreCustomer_model->deleteCoreCustomer($customer_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'],'8134','Application.coreCustomer.processDeleteCoreCustomer', $customer_id,'Delete Core Customer');

				$msg = "<div class='alert alert-success'>                
							Delete Data Customer Profile Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCustomer');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Customer Profile UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCustomer');
			}
		}
	}
?>