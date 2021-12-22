<?php
	Class CoreCostBudget extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('CoreCostBudget_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$data['main_view']['CoreCostBudget']		= $this->CoreCostBudget_model->getCoreCostBudget();
			$data['main_view']['content']				= 'CoreCostBudget/listCoreCostBudget_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function addCoreCostBudget(){
			$data['main_view']['content']			= 'CoreCostBudget/formaddCoreCostBudget_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAddCoreCostBudget(){
			$data = array(
				'cost_budget_code' 			=> $this->input->post('cost_budget_code',true),
				'cost_budget_name' 			=> $this->input->post('cost_budget_name',true),
				'cost_budget_amount' 		=> $this->input->post('cost_budget_amount',true),
				'data_state'				=> 0
			);
			
			$this->form_validation->set_rules('cost_budget_code', 'Cost Budget Code', 'required');
			$this->form_validation->set_rules('cost_budget_name', 'Cost Budget Name', 'required');
			$this->form_validation->set_rules('cost_budget_amount', 'Cost Budget Amount', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreCostBudget_model->saveNewCoreCostBudget($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.CoreCostBudget.processAddCorCostBudget',$auth['username'],'Add New Core Cost Budget');
					$msg = "<div class='alert alert-success'>                
								Add Data Cost Budget Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddCostBudget');
					redirect('CoreCostBudget/addCoreCostBudget');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Cost Budget UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddCostBudget',$data);
					redirect('CoreCostBudget/addCoreCostBudget');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddAllowance',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreCostBudget/addCoreCostBudget');
			}
		}
		
		public function editCoreCostBudget(){
			$data['main_view']['CoreCostBudget']		= $this->CoreCostBudget_model->getCoreCostBudget_Detail($this->uri->segment(3));
			$data['main_view']['content']				= 'CoreCostBudget/formeditCoreCostBudget_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processEditCoreCostBudget(){
			$data = array(
				'cost_budget_id' 				=> $this->input->post('cost_budget_id',true),
				'cost_budget_code' 				=> $this->input->post('cost_budget_code',true),
				'cost_budget_name' 				=> $this->input->post('cost_budget_name',true),
				'cost_budget_amount' 			=> $this->input->post('cost_budget_amount',true),
				'data_state'					=> 0
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('cost_budget_code', 'Cost Budget Code', 'required');
			$this->form_validation->set_rules('cost_budget_name', 'Cost Budget Name', 'required');
			$this->form_validation->set_rules('cost_budget_amount', 'Cost Budget Amount', 'required');
			if($this->form_validation->run()==true){
				if($this->CoreCostBudget_model->saveEditCoreCostBudget($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.CoreCostBudget.processEditCoreCostBudget',$auth['username'],'Edit Core Cost Budget');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['coreallowance_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Cost Budget Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCostBudget/editCoreCostBudget/'.$data['cost_budget_id']);
				}else{
					$msg = "<div class='alert alert-error'>                
								Edit Cost Budget UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreCostBudget/editCoreCostBudget/'.$data['cost_budget_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
				redirect('CoreCostBudget/editCoreCostBudget/'.$data['cost_budget_id']);
			}
		}
		
		function deleteCoreCostBudget(){
			if($this->CoreCostBudget_model->deleteCoreCostBudget($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.coreCostBudget.deleteCoreCostBudget',$auth['username'],'Delete Core Cost Budget');
				$msg = "<div class='alert alert-success'>                
							Delete Data Cost Budget Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('coreCostBudget');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Cost Budget UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreCostBudget');
			}
		}
	}
?>