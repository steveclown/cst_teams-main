<?php
	Class payrolldailyperiod extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('payrolldailyperiod_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$data['main_view']['payrolldailyperiod']	= $this->payrolldailyperiod_model->getPayrollDailyPeriod();
			$data['main_view']['content']				= 'payrolldailyperiod/listpayrolldailyperiod_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function addPayrollDailyPeriod(){
			$data['main_view']['content']				= 'payrolldailyperiod/formaddpayrolldailyperiod_view';
			$data['main_view']['includebpjs']			= $this->configuration->IncludeBPJS;
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrolldailyperiod-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrolldailyperiod-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrolldailyperiod-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrolldailyperiod-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		public function processAddPayrollDailyPeriod(){
			$auth = $this->session->userdata('auth');
			$daily_period_start_date = date_create(tgltodb($this->input->post('daily_period_start_date',true)));
			$daily_period_end_date = date_create(tgltodb($this->input->post('daily_period_end_date',true)));

			$daily_period_start = date_format($daily_period_start_date, 'Ymd');
			$daily_period_end = date_format($daily_period_end_date, 'Ymd');

			$daily_period = $daily_period_start.$daily_period_end;

			$data = array(
				'daily_period'				=> $daily_period,
				'daily_period_start_date'	=> tgltodb($this->input->post('daily_period_start_date',true)),
				'daily_period_end_date' 	=> tgltodb($this->input->post('daily_period_end_date',true)),
				'daily_period_working_days' => $this->input->post('daily_period_working_days',true),
				'daily_period_include_bpjs' => $this->input->post('daily_period_include_bpjs',true),
				'data_state'				=> 0,
				'created_id'				=> $auth['user_id'],
				'created_on'				=> date("YmdHis"),
			);

			$this->form_validation->set_rules('daily_period_start_date', 'Daily Period Start Date', 'required|');
			$this->form_validation->set_rules('daily_period_end_date', 'Daily Period End Name', 'required');
			$this->form_validation->set_rules('daily_period_working_days', 'Working Days', 'required');
			$this->form_validation->set_rules('daily_period_include_bpjs', 'Include BPJS', 'required');

			if($this->form_validation->run()==true){
				if($this->payrolldailyperiod_model->saveNewPayrollDailyPeriod($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollDailyPeriod.processAddPayrollDailyPeriod',$auth['user_id'],'Add New Training Job Title');
					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Daily Period Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addpayrolldailyperiod');
					redirect('payrolldailyperiod/addPayrollDailyPeriod');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Training Jobtitle UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddTrainingJobTitle',$data);
					redirect('payrolldailyperiod/addPayrollDailyPeriod');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddTrainingJobTitle',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrolldailyperiod/addPayrollDailyPeriod');
			}
		}
		
		function editPayrollDailyPeriod(){
			$data['main_view']['payrolldailyperiod']	= $this->payrolldailyperiod_model->getPayrollDailyPeriod_Detail($this->uri->segment(3));
			$data['main_view']['coretrainingtitle']		= create_double($this->payrolldailyperiod_model->getCoreTrainingTitle(),'training_title_id','training_title_name');
			$data['main_view']['corejobtitle']			= create_double($this->payrolldailyperiod_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['content']				= 'payrolldailyperiod/formeditpayrolldailyperiod_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditPayrollDailyPeriod(){
			$data = array(
				'training_job_title_id' 		=> $this->input->post('training_job_title_id',true),
				'training_title_id' 			=> $this->input->post('training_title_id',true),
				'job_title_id'	 				=> $this->input->post('job_title_id',true),
				'training_job_title_code' 		=> $this->input->post('training_job_title_code',true),
				'training_job_title_name' 		=> $this->input->post('training_job_title_name',true),
				'training_job_title_remark' 	=> $this->input->post('training_job_title_remark',true),
				'data_state'					=> 0
			);
			// print_r ($data); exit;
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('training_job_title_code', 'Training Job Title Code', 'required|alpha_numeric');
			$this->form_validation->set_rules('training_job_title_name', 'Training Job Title Name', 'required');
			$this->form_validation->set_rules('training_title_id', 'Training Title Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');

			if($this->form_validation->run()==true){
				if($this->payrolldailyperiod_model->saveEditPayrollDailyPeriod($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.PayrollDailyPeriod.processEditPayrollDailyPeriod',$auth['user_id'],'Edit Training Job Title');
					$this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['training_job_title_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Job Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrolldailyperiod/editPayrollDailyPeriod/'.$data['training_job_title_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Training Job Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrolldailyperiod/editPayrollDailyPeriod/'.$data['training_job_title_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrolldailyperiod/editPayrollDailyPeriod/'.$data['training_job_title_id']);
			}
		}
		

		function deletePayrollDailyPeriod(){
			if($this->payrolldailyperiod_model->deletePayrollDailyPeriod($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollDailyPeriod.deletePayrollDailyPeriod',$auth['user_id'],'Delete Training Job Title');
				$msg = "<div class='alert alert-success'>                
							Delete Data Daily Period Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrolldailyperiod');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Daily Period UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrolldailyperiod');
			}
		}
	}
?>