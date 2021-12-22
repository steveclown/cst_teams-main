<?php
	Class payrollmonthlyperiod extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('MainPage_model');
			$this->load->model('payrollmonthlyperiod_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');

		}
		
		public function index(){
			$data['Main_view']['payrollmonthlyperiod']	= $this->payrollmonthlyperiod_model->getPayrollMonthlyPeriod();
			$data['Main_view']['monthlist']				= $this->configuration->Month();
			$data['Main_view']['content']				= 'payrollmonthlyperiod/listpayrollmonthlyperiod_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addPayrollMonthlyPeriod(){
			$data['Main_view']['monthlist']				= $this->configuration->Month();
			$data['Main_view']['content']				= 'payrollmonthlyperiod/formaddpayrollmonthlyperiod_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollmonthlyperiod-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addpayrollmonthlyperiod-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addpayrollmonthlyperiod-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addpayrollmonthlyperiod-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addpayrollmonthlyperiod-'.$unique['unique']);
			redirect('payrollmonthlyperiod/addPayrollMonthlyPeriod');
		}
		
		public function processAddPayrollMonthlyPeriod(){
			$unique 	= $this->session->userdata('unique');
			$auth = $this->session->userdata('auth');
			$month_period 	= $this->input->post('month_period',true);
			$year_period 	= $this->input->post('year_period',true);

			$monthly_period = $year_period.$month_period;

			/*$monthly_period_start_date1 = date_create($year_period.'-'.$month_period.'-01');
			$monthly_period_start_date = date_format($monthly_period_start_date1,"Y-m-d");
			$monthly_period_end_date = date_format($monthly_period_start_date1, "Y-m-t");*/

			$data = array(
				'monthly_period'				=> $monthly_period,
				'monthly_period_start_date'		=> tgltodb($this->input->post('monthly_period_start_date',true)),
				'monthly_period_end_date' 		=> tgltodb($this->input->post('monthly_period_end_date',true)),
				'monthly_period_working_days' 	=> $this->input->post('monthly_period_working_days',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("YmdHis"),
			);

			$this->form_validation->set_rules('monthly_period_working_days', 'Working Days', 'required');

			if($this->form_validation->run()==true){
				if($this->payrollmonthlyperiod_model->saveNewPayrollMonthlyPeriod($data)){
					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'],'1003','Application.PayrollMonthlyPeriod.processAddPayrollMonthlyPeriod',$auth['user_id'],'Add New Training Job Title');

					$msg = "<div class='alert alert-success'>                
								Add Data Payroll Monthly Period Success
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);

					$this->session->unset_userdata('addpayrollmonthlyperiod-'.$unique['unique']);
					redirect('payrollmonthlyperiod/addPayrollMonthlyPeriod');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Payroll Monthly Period Fail
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddTrainingJobTitle',$data);
					redirect('payrollmonthlyperiod/addPayrollMonthlyPeriod');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddTrainingJobTitle',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollmonthlyperiod/addPayrollMonthlyPeriod');
			}
		}
		
		public function editPayrollMonthlyPeriod(){
			$data['Main_view']['payrollmonthlyperiod']	= $this->payrollmonthlyperiod_model->getPayrollMonthlyPeriod_Detail($this->uri->segment(3));
			$data['Main_view']['coretrainingtitle']		= create_double($this->payrollmonthlyperiod_model->getCoreTrainingTitle(),'training_title_id','training_title_name');
			$data['Main_view']['corejobtitle']			= create_double($this->payrollmonthlyperiod_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['Main_view']['content']				= 'payrollmonthlyperiod/formeditpayrollmonthlyperiod_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function processEditPayrollMonthlyPeriod(){
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
				if($this->payrollmonthlyperiod_model->saveEditPayrollMonthlyPeriod($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['user_id'],'1077','Application.PayrollMonthlyPeriod.processEditPayrollMonthlyPeriod',$auth['user_id'],'Edit Training Job Title');
					$this->fungsi->set_change_log($old_data,$data,$auth['user_id'],$data['training_job_title_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Training Job Title Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollmonthlyperiod/editPayrollMonthlyPeriod/'.$data['training_job_title_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Training Job Title UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('payrollmonthlyperiod/editPayrollMonthlyPeriod/'.$data['training_job_title_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('payrollmonthlyperiod/editPayrollMonthlyPeriod/'.$data['training_job_title_id']);
			}
		}
		

		public function deletePayrollMonthlyPeriod(){
			if($this->payrollmonthlyperiod_model->deletePayrollMonthlyPeriod($this->uri->segment(3))){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.PayrollMonthlyPeriod.deletePayrollMonthlyPeriod',$auth['user_id'],'Delete Training Job Title');
				$msg = "<div class='alert alert-success'>                
							Delete Data Monthly Period Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollmonthlyperiod');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Monthly Period UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('payrollmonthlyperiod');
			}
		}
	}
?>