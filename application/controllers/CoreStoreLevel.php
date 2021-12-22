<?php
	Class CoreStoreLevel extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreStoreLevel_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreStoreLevel']	= $this->CoreStoreLevel_model->getCoreAllowance();
			$data['main_view']['content']			= 'CoreStoreLevel/listCoreStoreLevel_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreAllowance(){
			$data['main_view']['content']			= 'CoreStoreLevel/formaddCoreStoreLevel_view';
			$data['main_view']['allowancetype']		= $this->configuration->AllowanceType();
			$data['main_view']['allowancegroup']	= $this->configuration->AllowanceGroup();
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreStoreLevel-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreStoreLevel-'.$unique['unique'],$sessions);
		}
		
		public function processAddCoreAllowance(){
			$auth = $this->session->userdata('auth');

			$data = array(
				'allowance_code' 			=> $this->input->post('allowance_code',true),
				'allowance_name' 			=> $this->input->post('allowance_name',true),
				'allowance_type' 			=> $this->input->post('allowance_type',true),
				'allowance_group' 			=> $this->input->post('allowance_group',true),
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id']
			);
			
			$this->form_validation->set_rules('allowance_code', 'Allowance Code', 'required');
			$this->form_validation->set_rules('allowance_name', 'Allowance Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreStoreLevel_model->insertCoreAllowance($data)){
					$allowance_id = $this->CoreStoreLevel_model->getAllowanceID($data['created_id']);

					$data_allowanceamount = array(
						'allowance_id'				=> $allowance_id,
						'allowance_period'			=> $this->input->post('allowance_period',true),
						'allowance_amount' 			=> $this->input->post('allowance_amount',true),
						'data_state'				=> 0,
						'created_id'				=> $auth['user_id'],
						'created_on'				=> date("Y-m-d H:i:s"),
					);

					$this->CoreStoreLevel_model->insertCoreAllowanceAmount($data_allowanceamount);

					$this->fungsi->set_log($auth['username'],'1003','Application.CoreAllowance.processAddCoreStoreLevel',$auth['username'],'Add New Core Allowance');

					$msg = "<div class='alert alert-success'>                
								Add Data Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddAllowance');
					redirect('CoreStoreLevel/addCoreAllowance');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Allowance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddAllowance',$data);
					redirect('CoreStoreLevel/addCoreAllowance');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddAllowance',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreStoreLevel/addCoreAllowance');
			}
		}

		
		public function editCoreAllowance(){
			$allowance_id = $this->uri->segment(3);

			$data['main_view']['CoreStoreLevel']			= $this->CoreStoreLevel_model->getCoreAllowance_Detail($allowance_id);
			$data['main_view']['CoreStoreLevelamount']	= $this->CoreStoreLevel_model->getCoreAllowanceAmount_Detail($allowance_id);

			$data['main_view']['allowancetype']			= $this->configuration->AllowanceType();
			$data['main_view']['allowancegroup']		= $this->configuration->AllowanceGroup();
			$data['main_view']['content']				= 'CoreStoreLevel/formeditCoreStoreLevel_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreAllowance(){
			$auth 	= $this->session->userdata('auth');

			$data = array(
				'allowance_id' 				=> $this->input->post('allowance_id',true),
				'allowance_code' 			=> $this->input->post('allowance_code',true),
				'allowance_name' 			=> $this->input->post('allowance_name',true),
				'allowance_type' 			=> $this->input->post('allowance_type',true),
				'allowance_group' 			=> $this->input->post('allowance_group',true),
				'data_state'				=> 0
			);

			$data_allowanceamount = array(
				'allowance_id' 				=> $this->input->post('allowance_id',true),
				'allowance_period'			=> $this->input->post('allowance_period',true),
				'allowance_amount'			=> $this->input->post('allowance_amount',true),
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id'],
				'created_on'				=> date("Y-m-d H:i:s"),
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('allowance_code', 'Allowance Code', 'required');
			$this->form_validation->set_rules('allowance_name', 'Allowance Name', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreStoreLevel_model->updateCoreAllowance($data)==true){
					
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreAllowance.Edit',$auth['username'],'Edit Core Allowance');

					if ($data_allowanceamount['allowance_amount'] > 0){
						$this->CoreStoreLevel_model->insertCoreAllowanceAmount($data_allowanceamount);
					}


					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['CoreStoreLevel_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Allowance Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreStoreLevel/editCoreAllowance/'.$data['allowance_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Allowance UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreStoreLevel/editCoreAllowance/'.$data['allowance_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreStoreLevel/editCoreAllowance/'.$data['allowance_id']);
			}
		}
		
		function deleteCoreAllowance(){
			$allowance_id = $this->uri->segment(3);

			if($this->CoreStoreLevel_model->deleteCoreAllowance($allowance_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.CoreAllowance.delete',$auth['username'],'Delete Core Allowance');
				$msg = "<div class='alert alert-success'>                
							Delete Data Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreStoreLevel');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreStoreLevel');
			}
		}

		public function deleteCoreAllowanceAmount(){
			$allowance_id 			= $this->uri->segment(3);
			$allowance_amount_id 	= $this->uri->segment(4);

			if($this->CoreStoreLevel_model->deleteCoreAllowanceAmount($allowance_amount_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollEmployeeAllowance.delete',$auth['user_id'],'Delete Employee Allowance');

				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Allowance Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreStoreLevel/editCoreAllowance/'.$allowance_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Allowance UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreStoreLevel/editCoreAllowance/'.$allowance_id);
			}
		}

	}
?>