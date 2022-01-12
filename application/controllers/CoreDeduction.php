<?php
	Class CoreDeduction extends MY_Controller{
		public function __construct(){
			parent::__construct();

			$menu = 'deduction';

			$this->cekLogin();
			$this->accessMenu($menu);
			$this->load->model('MainPage_model');
			$this->load->model('CoreDeduction_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
			$this->load->database('default');
		}
		
		public function index(){
			$unique 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreDeduction-'.$unique['unique']);	
			$this->session->unset_userdata('addarrayCoreDeductionallowance-'.$unique['unique']);
			$this->session->unset_userdata('editCoreDeduction-'.$unique['unique']);	
			$this->session->unset_userdata('editCoreDeductionfirst-'.$unique['unique']);	
			$this->session->unset_userdata('editarrayCoreDeductionallowance-'.$unique['unique']);	
			$this->session->unset_userdata('editarrayCoreDeductionallowancefirst-'.$unique['unique']);

			$data['main_view']['corededuction']		= $this->CoreDeduction_model->getCoreDeduction();
			$data['main_view']['deductiontype']		= $this->configuration->DeductionType();
			$data['main_view']['content']			= 'CoreDeduction/ListCoreDeduction_view';
			$this->load->view('MainPage_view',$data);
		}
		
		public function addCoreDeduction(){
			$data['main_view']['deductiontype']						= $this->configuration->DeductionType();
			$data['main_view']['deductionpremiattendancestatus']	= $this->configuration->WorkingStatus();
			$data['main_view']['coreallowance']						= create_double($this->CoreDeduction_model->getCoreAllowance(),'allowance_id','allowance_name');
			$data['main_view']['content']							= 'CoreDeduction/FormAddCoreDeduction_view';
			
			$this->load->view('MainPage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreDeduction-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addCoreDeduction-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addCoreDeduction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addCoreDeduction-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_data(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addCoreDeduction-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayCoreDeductionallowance-'.$sesi['unique']);	
			redirect('CoreDeduction/addCoreDeduction');
		}

		// public function processAddArrayCoreDeductionAllowance(){

		// 	$data_deductionallowance = array(
		// 		'allowance_id'					=> $this->input->post('allowance_id', true),
		// 		'deduction_allowance_ratio'		=> $this->input->post('deduction_allowance_ratio', true),
		// 	);
			
		// 	$this->form_validation->set_rules('allowance_id', 'Allowance Name', 'required');
		// 	$this->form_validation->set_rules('deduction_allowance_ratio', 'Deduction Allowance Ratio', 'required');
	
		// 	if($this->form_validation->run()==true){
		// 		$unique 			= $this->session->userdata('unique');
		// 		$session_name 		= $this->input->post('session_name',true);
		// 		$dataArrayHeader	= $this->session->userdata('addarrayCoreDeductionallowance-'.$unique['unique']);
				
		// 		$dataArrayHeader[$data_deductionallowance['allowence_id']] = $data_deductionallowance;
				
		// 		$this->session->set_userdata('addarrayCoreDeductionallowance-'.$unique['unique'],$dataArrayHeader);
		// 		$sesi 	= $this->session->userdata('unique');
		// 		$data_deductionallowance = $this->session->userdata('addCoreDeduction-'.$sesi['unique']);
				
		// 		$data_deductionallowance['allowance_id'] 								= '';
		// 		$data_deductionallowance['deduction_allowance_ratio'] 					= '';
				
				
		// 		$this->session->set_userdata('addCoreDeduction-'.$sesi['unique'],$data_deductionallowance);
		// 	}else{
		// 		$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
		// 		$this->session->set_userdata('message',$msg);
		// 	}
		// }

		// public function deleteArrayCoreDeductionAllowance(){
		// 	$arrayBaru			= array();
		// 	$allowance_id 		= $this->uri->segment(3);
		// 	$session_name		= "addarrayCoreDeductionallowance-";
		// 	$unique 			= $this->session->userdata('unique');
		// 	$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
		// 	$unique 			= $this->session->userdata('unique');
			
		// 	foreach($dataArrayHeader as $key=>$val){
		// 		/*print_r("key ");
		// 		print_r($key);
		// 		print_r("<BR>");*/
		// 		if($key != $allowance_id){
		// 			$arrayBaru[$key] = $val;
		// 		}
		// 	}

		// 	/*print_r("arrayBaru ");
		// 	print_r($arrayBaru);
		// 	exit;*/
			
		// 	$this->session->set_userdata('addarrayCoreDeductionallowance-'.$unique['unique'],$arrayBaru);
			
		// 	redirect('CoreDeduction/addCoreDeduction/');
		// }

		public function processAddCoreDeduction(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$session_CoreDeductionallowance		= $this->session->userdata('addarrayCoreDeductionallowance-'.$unique['unique']);

			$data_deduction = array(
				'deduction_code'					=> $this->input->post('deduction_code',true),
				'allowance_id'						=> $this->input->post('allowance_id',true),
				'deduction_code'					=> $this->input->post('deduction_code',true),
				'deduction_name'					=> $this->input->post('deduction_name',true),
				'deduction_type'					=> $this->input->post('deduction_type',true),
				'deduction_amount'					=> $this->input->post('deduction_amount',true),
				'deduction_premi_attendance_ratio'	=> $this->input->post('deduction_premi_attendance_ratio',true),
				// 'deduction_premi_attendance_status'	=> $this->input->post('deduction_premi_attendance_status',true),
				'deduction_basic_salary_ratio'		=> $this->input->post('deduction_basic_salary_ratio',true),
				'deduction_late_start_duration'		=> $this->input->post('deduction_late_start_duration',true),
				'deduction_late_end_duration'		=> $this->input->post('deduction_late_end_duration',true),
				'deduction_remark'					=> $this->input->post('deduction_remark',true),
				'data_state'						=> 0,
				'created_id' 						=> $auth['user_id'],
				'created_on' 						=> date('Y-m-d-h-i-s'),
			);
						
			$this->form_validation->set_rules('deduction_code', 'Deduction Code', 'required');
			$this->form_validation->set_rules('deduction_name', 'Supplier Name', 'required');
			$this->form_validation->set_rules('deduction_type', 'Deduction Type', 'required');
						
			if($this->form_validation->run()==true){
				if($this->CoreDeduction_model->insertCoreDeduction($data_deduction)){
					$deduction_id = $this->CoreDeduction_model->getDeductionID();

					if(!empty($session_CoreDeductionallowance)){
						foreach($session_CoreDeductionallowance as $key=>$val){
							$data_deductionallowance = array(
								'deduction_id'					=> $deduction_id,
								'allowance_id'					=> $val['allowance_id'],
								'deduction_allowance_ratio'		=> $val['deduction_allowance_ratio'],
							);
							$this->CoreDeduction_model->insertCoreDeductionAllowance($data_deductionallowance);
						}
					}

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'3122','Application.coreDeduction.processAddCoreDeduction',$supplier_id,'Add New Core Deduction');

					$msg = "<div class='alert alert-success'>                
							Add Data Core Deduction Success
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";

					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addCoreDeduction-');
					$this->session->unset_userdata('addCoreDeductionallowance-');
					$this->session->unset_userdata('addarrayCoreDeductionallowance-'.$unique['unique']);
					redirect('CoreDeduction/addCoreDeduction/');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Core Deduction Fail
							button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreDeduction/addCoreDeduction/');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addCoreDeductionallowance',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreDeduction/addCoreDeduction/');
			}
		}
		
		public function showdetail(){
			$overtime_rate_id									= $this->uri->segment(3);
			$data['main_view']['assignmentovertimerate']		= $this->assignmentovertimerate_model->getAssignmentOvertimeRate_Detail($overtime_rate_id);
			$data['main_view']['assignmentovertimeratetitle']	= $this->assignmentovertimerate_model->getAssignmentOvertimeRateTitle_Detail($overtime_rate_id);
			$data['main_view']['content']						= 'assignmentovertimerate/formdetailassignmentovertimerate_view';
			$this->load->view('MainPage_view',$data);
		}

		public function function_elements_edit(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('editCoreDeduction-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('editCoreDeduction-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_edit(){
			$deduction_id 	= $this->uri->segment(3);
			$sesi 			= $this->session->userdata('unique');

			$this->session->unset_userdata('editCoreDeduction-'.$sesi['unique']);	
			$this->session->unset_userdata('editCoreDeductionfirst-'.$sesi['unique']);	
			$this->session->unset_userdata('editarrayCoreDeductionallowance-'.$sesi['unique']);	
			$this->session->unset_userdata('editarrayCoreDeductionallowancefirst-'.$sesi['unique']);	
			redirect('CoreDeduction/editCoreDeduction/'.$deduction_id);
		}

		public function editCoreDeduction(){
			$deduction_id 				= $this->uri->segment(3);
			$unique						= $this->session->userdata('unique');			
			$CoreDeduction 				= $this->CoreDeduction_model->getCoreDeduction_Detail($deduction_id);
			$CoreDeductionallowance 	= $this->CoreDeduction_model->getCoreDeductionAllowance_Detail($deduction_id);
			$header 					= $this->session->userdata('CoreDeductionedit-'.$deduction_id.$unique['unique']);

			$dataArrayHeader			= $this->session->userdata('editarrayCoreDeductionallowancefirst-'.$unique['unique']);

			if (empty($dataArrayHeader)){
				foreach ($CoreDeductionallowance as $keyDeductionAllowance => $valDeductionAllowance) {
					$data_deductionallowance = array(
						'deduction_id'				=> $valDeductionAllowance['deduction_id'],
						'allowance_id'				=> $valDeductionAllowance['allowance_id'],
						'deduction_allowance_ratio'	=> $valDeductionAllowance['deduction_allowance_ratio'],
					);

					$unique 			= $this->session->userdata('unique');
					$session_name 		= $this->input->post('session_name',true);
					$dataArrayHeader	= $this->session->userdata('editarrayCoreDeductionallowance-'.$unique['unique']);

					$dataArrayHeader[$data_deductionallowance['allowance_id']] = $data_deductionallowance;
					
					$this->session->set_userdata('editarrayCoreDeductionallowancefirst-'.$unique['unique'],$dataArrayHeader);

					$this->session->set_userdata('editarrayCoreDeductionallowance-'.$unique['unique'],$dataArrayHeader);

					$sesi 	= $this->session->userdata('unique');
					$data_deductionallowance = $this->session->userdata('editCoreDeduction-'.$sesi['unique']);
				}
			}

			$dataheader	= $this->session->userdata('editCoreDeductionfirst-'.$unique['unique']);

			if (empty($dataheader)){
				$data_deduction = array (
					'deduction_id'						=> $CoreDeduction['deduction_id'],
					'allowance_id'						=> $CoreDeductionallowance['allowance_id'],
					'deduction_code'					=> $CoreDeduction['deduction_code'],
					'deduction_name'					=> $CoreDeduction['deduction_name'],
					'deduction_amount'					=> $CoreDeduction['deduction_amount'],
					'deduction_type'					=> $CoreDeduction['deduction_type'],
					'deduction_premi_attendance_ratio'	=> $CoreDeduction['deduction_premi_attendance_ratio'],
					// 'deduction_premi_attendance_status'	=> $CoreDeduction['deduction_premi_attendance_status'],
					'deduction_basic_salary_ratio'		=> $CoreDeduction['deduction_basic_salary_ratio'],
					'deduction_late_start_duration'		=> $CoreDeduction['deduction_late_start_duration'],
					'deduction_late_end_duration'		=> $CoreDeduction['deduction_late_end_duration'],
				);

				$unique 			= $this->session->userdata('unique');
				$dataheader 		= $this->session->userdata('editCoreDeduction-'.$unique['unique']);

				$dataheader = $data_deduction;

				$this->session->set_userdata('editCoreDeductionfirst-'.$unique['unique'],$dataheader);

				$this->session->set_userdata('editCoreDeduction-'.$unique['unique'],$dataheader);
			}

			$data['main_view']['CoreDeduction']						= $this->session->userdata('CoreDeductionedit-'.$deduction_id.$unique['unique']);

			$data['main_view']['coreallowance']						= create_double($this->CoreDeduction_model->getCoreAllowance(),'allowance_id','allowance_name');

			$data['main_view']['deductiontype']						= $this->configuration->DeductionType();

			$data['main_view']['deductionpremiattendancestatus']	= $this->configuration->WorkingStatus();

			$data['main_view']['content']							= 'CoreDeduction/formeditCoreDeduction_view';
			$this->load->view('MainPage_view',$data);
		}

		// public function processEditArrayCoreDeductionAllowance(){

		// 	$data_deductionallowance = array(
		// 		'allowance_id'					=> $this->input->post('allowance_id', true),
		// 		'deduction_allowance_ratio'		=> $this->input->post('deduction_allowance_ratio', true)
		// 	);

		// 	$this->form_validation->set_rules('allowance_id', 'Allowance Name', 'required');
		// 	$this->form_validation->set_rules('deduction_allowance_ratio', 'Deduction Allowance Ratio', 'required');
	
		// 	if($this->form_validation->run()==true){
		// 		$unique 			= $this->session->userdata('unique');
		// 		$session_name 		= $this->input->post('session_name',true);
		// 		$dataArrayHeader	= $this->session->userdata('editarrayCoreDeductionallowance-'.$unique['unique']);

		// 		$dataArrayHeader[$data_deductionallowance['allowance_id']] = $data_deductionallowance;
				
		// 		$this->session->set_userdata('editarrayCoreDeductionallowance-'.$unique['unique'],$dataArrayHeader);
		// 		$sesi 	= $this->session->userdata('unique');
		// 		$data_deductionallowance = $this->session->userdata('editCoreDeduction-'.$sesi['unique']);
				
		// 		$data_deductionallowance['allowance_id'] 				= '';
		// 		$data_deductionallowance['deduction_allowance_ratio'] 	= '';
				
		// 		$this->session->set_userdata('editCoreDeduction-'.$sesi['unique'],$data_deductionallowance);
		// 	}else{
		// 		$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
		// 		$this->session->set_userdata('message',$msg);
		// 	}
		// }

		// public function deleteEditArrayCoreDeductionAllowance(){
		// 	$arrayBaru			= array();
		// 	$deduction_id 		= $this->uri->segment(3);
		// 	$allowance_id 		= $this->uri->segment(4);
		// 	$session_name		= "editarrayCoreDeductionallowance-";
		// 	$unique 			= $this->session->userdata('unique');
		// 	$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
		// 	$unique 			= $this->session->userdata('unique');
			
		// 	foreach($dataArrayHeader as $key=>$val){
		// 		if($key != $allowance_id){
		// 			$arrayBaru[$key] = $val;
		// 		}
		// 	}

		// 	$this->session->set_userdata('editarrayCoreDeductionallowance-'.$unique['unique'],$arrayBaru);
			
		// 	redirect('CoreDeduction/editCoreDeduction/'.$deduction_id);
		// }
		
		public function processEditCoreDeduction(){			
			$unique 							= $this->session->userdata('unique');
			$session_CoreDeductionallowance 	= $this->session->userdata('editarrayCoreDeductionallowance-'.$unique['unique']);			
			
			$data_deduction = array(
				'deduction_id'						=> $this->input->post('deduction_id'),
				'deduction_code'					=> $this->input->post('deduction_code'),
				'deduction_name'					=> $this->input->post('deduction_name'),
				'deduction_type'					=> $this->input->post('deduction_type'),
				'deduction_amount'					=> $this->input->post('deduction_amount'),
				'deduction_premi_attendance_ratio'	=> $this->input->post('deduction_premi_attendance_ratio'),
				// 'deduction_premi_attendance_status'	=> $this->input->post('deduction_premi_attendance_status'),
				'deduction_basic_salary_ratio'		=> $this->input->post('deduction_basic_salary_ratio'),
				'deduction_late_start_duration'		=> $this->input->post('deduction_late_start_duration'),
				'deduction_late_end_duration'		=> $this->input->post('deduction_late_end_duration'),
				'deduction_remark'					=> $this->input->post('deduction_remark'),
			);

			$deduction_id = $data_deduction['deduction_id'];

			$this->form_validation->set_rules('deduction_code', 'Deduction Code', 'required');
			$this->form_validation->set_rules('deduction_name', 'Supplier Name', 'required');
			$this->form_validation->set_rules('deduction_type', 'Deduction Type', 'required');

			if($this->form_validation->run()==true){
				if($this->CoreDeduction_model->updateCoreDeduction($data_deduction)==true){
					if ($this->CoreDeduction_model->deleteCoreDeductionAllowance($deduction_id)){

						if (!empty($session_CoreDeductionallowance)){
							foreach($session_CoreDeductionallowance as $keyDeductionAllowance => $valDeductionAllowance){
								$data_deductionallowance = array (
									'deduction_id'				=> $data_deduction['deduction_id'],
									'allowance_id'				=> $valDeductionAllowance['allowance_id'],
									'deduction_allowance_ratio'	=> $valDeductionAllowance['deduction_allowance_ratio'],
								);

								$this->CoreDeduction_model->insertCoreDeductionAllowance($data_deductionallowance);
							}
						}

						$this->session->unset_userdata('editCoreDeduction-'.$unique['unique']);	
						$this->session->unset_userdata('editCoreDeductionfirst-'.$unique['unique']);	
						$this->session->unset_userdata('editarrayCoreDeductionallowance-'.$unique['unique']);	
						$this->session->unset_userdata('editarrayCoreDeductionallowancefirst-'.$unique['unique']);	

						$msg = "<div class='alert alert-success alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>        
								Update Data Deduction Success
							</div> ";
						$this->session->set_userdata('message',$msg);
						
						redirect('CoreDeduction/editCoreDeduction/'.$deduction_id);
					}					
					
				}else {
					$msg = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>        
								Update Data Deduction Fail
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('CoreDeduction/editCoreDeduction/'.$deduction_id);
				}
			} else {
				$data['password']='';
				$this->session->set_userdata('addCoreDeductionallowance',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('CoreDeduction/editCoreDeduction/'.$deduction_id);
			}
		}
				
		public function deleteCoreDeduction(){
			$deduction_id = $this->uri->segment(3);
			if($this->CoreDeduction_model->deleteCoreDeduction($deduction_id)){
				// $auth = $this->session->userdata('auth');
				// $this->fungsi->set_log($auth['username'],'1005','Application.CoreDeduction.delete',$auth['username'],'Delete Deduction');
				$msg = "<div class='alert alert-success'>                
							Delete Data Deduction Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDeduction');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Deduction UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('CoreDeduction');
			}
		}
	}
?>