<?php
	Class incentiverealizationdistribution extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('incentiverealizationdistribution_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];

			$sesi	= 	$this->session->userdata('filter-incentiverealizationdistribution');
			if(!is_array($sesi)){
				$sesi['branch_id']							= '';
				$sesi['location_id']						= '';
				$sesi['realization_distribution_period']	= '';
			}


			$data['main_view']['monthlist']							= $this->configuration->Month;
			$data['main_view']['corebranch']						= create_double($this->incentiverealizationdistribution_model->getCoreBranch($region_id),'branch_id','branch_name');

			$data['main_view']['incentiverealizationdistribution']	= $this->incentiverealizationdistribution_model->getIncentiveRealizationDistribution($region_id, $sesi['branch_id'], $sesi['location_id'], $sesi['realization_distribution_period']);

			$data['main_view']['content']							= 'incentiverealizationdistribution/listincentiverealizationdistribution_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$month_period 	= $this->input->post('month_period',true);
			$year_period 	= $this->input->post('year_period',true);

			$realization_distribution_period = $year_period.$month_period;

			$data = array (
				'branch_id'							=> $this->input->post('branch_id',true),
				'location_id'						=> $this->input->post('location_id',true),
				'realization_distribution_period'	=> $realization_distribution_period,
			);

			$this->session->set_userdata('filter-incentiverealizationdistribution',$data);
			redirect('incentiverealizationdistribution');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addincentiverealizationdistribution-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addincentiverealizationdistribution-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addincentiverealizationdistribution-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addincentiverealizationdistribution-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-incentiverealizationdistribution');
			$this->session->unset_userdata('filter-incentiverealizationdistribution');
			redirect('incentiverealizationdistribution');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addincentiverealizationdistribution-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayincentivetitledistribution-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayincentiveemployeeomzet-'.$sesi['unique']);		
			redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution');
		}

		public function getCoreLocation(){
			$branch_id = $this->input->post('branch_id');
			
			$item = $this->incentiverealizationdistribution_model->getCoreLocation($branch_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[location_id]'>$mp[location_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->incentiverealizationdistribution_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}

		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->incentiverealizationdistribution_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function getHROEmployeeData(){
			$branch_id 		= $this->input->post('branch_id');
			$location_id 	= $this->input->post('location_id');
			$division_id 	= $this->input->post('division_id');
			$department_id 	= $this->input->post('department_id');
			$section_id 	= $this->input->post('section_id');
			$job_title_id 	= $this->input->post('job_title_id');
			
			$item = $this->incentiverealizationdistribution_model->getHROEmployeeData($branch_id, $location_id, $division_id, $department_id, $section_id, $job_title_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[employee_id]'>$mp[employee_name]</option>\n";	
			}
			echo $data;
		}
		
		public function addIncentiveRealizationDistribution(){	
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];

			$data['main_view']['monthlist']				= $this->configuration->Month;

			$data['main_view']['corebranch']			= create_double($this->incentiverealizationdistribution_model->getCoreBranch($region_id),'branch_id','branch_name');

			$data['main_view']['corejobtitle']			= create_double($this->incentiverealizationdistribution_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['coredivision']			= create_double($this->incentiverealizationdistribution_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['incentiveomzettarget']	= create_double($this->incentiverealizationdistribution_model->getIncentiveOmzetTarget(),'omzet_target_id','omzet_target_period');

			$data['main_view']['content']				= 'incentiverealizationdistribution/formaddincentiverealizationdistribution_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddArrayIncentiveTitleDistribution(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $this->input->post('branch_id', true);
			$location_id 	= $this->input->post('location_id', true);
			$job_title_id 	= $this->input->post('job_title_id', true);

			$data_titledistribution = array(
				'record_id'									=> $region_id.$branch_id.$location_id.$job_title_id,
				'region_id'									=> $region_id,
				'branch_id'									=> $this->input->post('branch_id', true),
				'location_id'								=> $this->input->post('location_id', true),
				'job_title_id'								=> $this->input->post('job_title_id', true),
				'title_distribution_branch_percentage'		=> $this->input->post('title_distribution_branch_percentage', true),
				'title_distribution_group_percentage'		=> $this->input->post('title_distribution_group_percentage', true),
				'title_distribution_individual_percentage'	=> $this->input->post('title_distribution_individual_percentage', true),
			);

			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('title_distribution_branch_percentage', 'Branch Percentage', 'required');
			$this->form_validation->set_rules('title_distribution_group_percentage', 'Group Percentage', 'required');
			$this->form_validation->set_rules('title_distribution_individual_percentage', 'Individual Percentage', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayincentivetitledistribution-'.$unique['unique']);
				
				$dataArrayHeader[$data_titledistribution['record_id']] = $data_titledistribution;
				
				$this->session->set_userdata('addarrayincentivetitledistribution-'.$unique['unique'], $dataArrayHeader);

				$sesi 	= $this->session->userdata('unique');
				$data_titledistribution = $this->session->userdata('addincentiverealizationdistribution-'.$sesi['unique']);
				

				$data_titledistribution['job_title_id'] 								= '';
				$data_titledistribution['title_distribution_branch_percentage'] 		= '';
				$data_titledistribution['title_distribution_group_percentage'] 			= '';
				$data_titledistribution['title_distribution_individual_percentage'] 	= '';
				
				
				$this->session->set_userdata('addincentiverealizationdistribution-'.$sesi['unique'],$data_titledistribution);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayIncentiveTitleDistribution(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayincentivetitledistribution-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayincentivetitledistribution-'.$unique['unique'],$arrayBaru);
			
			redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution/');
		}


		public function processAddArrayIncentiveEmployeeOmzet(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $this->input->post('branch_id', true);
			$location_id 	= $this->input->post('location_id', true);
			$job_title_id 	= $this->input->post('job_title_id', true);

			$data_employeeomzet = array(
				'region_id'						=> $region_id,
				'branch_id'						=> $this->input->post('branch_id', true),
				'location_id'					=> $this->input->post('location_id', true),
				'division_id'					=> $this->input->post('division_id', true),
				'department_id'					=> $this->input->post('department_id', true),
				'section_id'					=> $this->input->post('section_id', true),
				'job_title_id'					=> $this->input->post('job_title_id', true),
				'employee_id'					=> $this->input->post('employee_id', true),
				'employee_omzet_target'			=> $this->input->post('employee_omzet_target', true),
				'employee_omzet_achievement'	=> $this->input->post('employee_omzet_achievement', true),
			);

			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_omzet_target', 'Omzet Target', 'required');
			$this->form_validation->set_rules('employee_omzet_achievement', 'Omzet Achievement', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayincentiveemployeeomzet-'.$unique['unique']);
				
				$dataArrayHeader[$data_employeeomzet['employee_id']] = $data_employeeomzet;
				
				$this->session->set_userdata('addarrayincentiveemployeeomzet-'.$unique['unique'], $dataArrayHeader);

				$sesi 	= $this->session->userdata('unique');
				$data_employeeomzet = $this->session->userdata('addincentiverealizationdistribution-'.$sesi['unique']);
				

				$data_employeeomzet['division_id'] 					= '';
				$data_employeeomzet['department_id'] 				= '';
				$data_employeeomzet['section_id'] 					= '';
				$data_employeeomzet['job_title_id'] 				= '';
				$data_employeeomzet['employee_id'] 					= '';
				$data_employeeomzet['employee_omzet_target'] 		= '';
				$data_employeeomzet['employee_omzet_achievement']	= '';
				
				
				$this->session->set_userdata('addincentiverealizationdistribution-'.$sesi['unique'],$data_employeeomzet);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayIncentiveEmployeeOmzet(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayincentiveemployeeomzet-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayincentiveemployeeomzet-'.$unique['unique'],$arrayBaru);
			
			redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution/');
		}

		
		public function processAddIncentiveRealizationDistribution(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$month_period 	= $this->input->post('month_period',true);
			$year_period 	= $this->input->post('year_period',true);

			$realization_distribution_period 	= $year_period.$month_period;
			$title_distribution_period 			= $year_period.$month_period;
			$employee_omzet_period 				= $year_period.$month_period;

			$session_titledistribution	= $this->session->userdata('addarrayincentivetitledistribution-'.$unique['unique']);
			$session_employeeomzet		= $this->session->userdata('addarrayincentiveemployeeomzet-'.$unique['unique']);

			$branch_id 			= $this->input->post('branch_id',true);
			$location_id 		= $this->input->post('location_id',true);
			$omzet_target_id 	= $this->input->post('omzet_target_id',true);

			$realization_distribution_branch_percentage 	= $this->input->post('realization_distribution_branch_percentage',true);

			$realization_distribution_group_percentage 		= $this->input->post('realization_distribution_group_percentage',true);

			$realization_distribution_individual_percentage = $this->input->post('realization_distribution_individual_percentage',true);

			$omzet_incentive_share_amount = $this->incentiverealizationdistribution_model->getOmzetIncentiveShareAmount($omzet_target_id, $branch_id, $location_id);

			$realization_distribution_branch_amount 	= ($realization_distribution_branch_percentage / 100) * $omzet_incentive_share_amount;

			$realization_distribution_group_amount 		= ($realization_distribution_group_percentage / 100) * $omzet_incentive_share_amount;

			$realization_distribution_individual_amount = ($realization_distribution_individual_percentage / 100) * $omzet_incentive_share_amount;
			
			$data = array(
				'region_id'											=> $auth['region_id'],
				'omzet_target_id'									=> $this->input->post('omzet_target_id',true),
				'branch_id'											=> $this->input->post('branch_id',true),
				'location_id'										=> $this->input->post('location_id',true),
				'realization_distribution_period'								=> $realization_distribution_period,
				'realization_distribution_branch_percentage'		=> $this->input->post('realization_distribution_branch_percentage',true),
				'realization_distribution_group_percentage'			=> $this->input->post('realization_distribution_group_percentage',true),
				'realization_distribution_individual_percentage'	=> $this->input->post('realization_distribution_individual_percentage',true),
				'realization_distribution_branch_amount'			=> $realization_distribution_branch_amount,
				'realization_distribution_group_amount'				=> $realization_distribution_group_amount,
				'realization_distribution_individual_amount'		=> $realization_distribution_individual_amount,
				'data_state'										=> 0,
				'created_id'										=> $auth['user_id'],
				'created_on'										=> date("Y-m-d H:i:s")	
			);

			/*print_r("data ");
			print_r($data);
			exit;*/

			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('realization_distribution_branch_percentage', 'Branch Percentage', 'required');
			$this->form_validation->set_rules('realization_distribution_group_percentage', 'Group Percentage', 'required');
			$this->form_validation->set_rules('realization_distribution_individual_percentage', 'Individual Percentage', 'required');
			
			if($this->incentiverealizationdistribution_model->insertIncentiveRealizationDistribution($data)){

				$realization_distribution_id = $this->incentiverealizationdistribution_model->getRealizationDistributionID($data['created_id']);
				
				if(!empty($session_titledistribution)){
					foreach($session_titledistribution as $key => $val){
						$title_distribution_branch_percentage 		= $val['title_distribution_branch_percentage'];

						$title_distribution_group_percentage 		= $val['title_distribution_group_percentage'];

						$title_distribution_individual_percentage 	= $val['title_distribution_individual_percentage'];


						$title_distribution_branch_amount 			= ($title_distribution_branch_percentage / 100) * $realization_distribution_branch_amount;

						$title_distribution_group_amount 			= ($title_distribution_group_percentage / 100) * $realization_distribution_group_amount;

						$title_distribution_individual_amount 		= ($title_distribution_individual_percentage / 100) * $realization_distribution_individual_amount;


						$data_titledistribution = array(
							'realization_distribution_id'				=> $realization_distribution_id,
							'omzet_target_id'							=> $data['omzet_target_id'],
							'region_id'									=> $auth['region_id'],
							'branch_id'									=> $val['branch_id'],
							'location_id'								=> $val['location_id'],
							'job_title_id'								=> $val['job_title_id'],
							'title_distribution_period'					=> $title_distribution_period,
							'title_distribution_branch_percentage'		=> $val['title_distribution_branch_percentage'],
							'title_distribution_group_percentage'		=> $val['title_distribution_group_percentage'],
							'title_distribution_individual_percentage'	=> $val['title_distribution_individual_percentage'],
							'title_distribution_branch_amount'			=> $title_distribution_branch_amount,
							'title_distribution_group_amount'			=> $title_distribution_group_amount,
							'title_distribution_individual_amount'		=> $title_distribution_individual_amount,
							'data_state'								=> 0,
							'created_id'								=> $auth['user_id'],
							'created_on'								=> date("Y-m-d H:i:s")	

						);
						$this->incentiverealizationdistribution_model->insertIncentiveTitleDistribution($data_titledistribution);
					}
				}

				if(!empty($session_employeeomzet)){
					foreach($session_employeeomzet as $key => $val){
						$employee_omzet_target 		= $val['employee_omzet_target'];
						$employee_omzet_achievement = $val['employee_omzet_achievement'];

						$data_employeeomzet = array(
							'realization_distribution_id'				=> $realization_distribution_id,
							'omzet_target_id'							=> $data['omzet_target_id'],
							'region_id'									=> $auth['region_id'],
							'branch_id'									=> $val['branch_id'],
							'location_id'								=> $val['location_id'],
							'job_title_id'								=> $val['job_title_id'],
							'division_id'								=> $val['division_id'],
							'department_id'								=> $val['department_id'],
							'section_id'								=> $val['section_id'],
							'employee_id'								=> $val['employee_id'],
							'employee_omzet_period'						=> $employee_omzet_period,
							'employee_omzet_target'						=> $val['employee_omzet_target'],
							'employee_omzet_achievement'				=> $val['employee_omzet_achievement'],
							'data_state'								=> 0,
							'created_id'								=> $auth['user_id'],
							'created_on'								=> date("Y-m-d H:i:s")	
						);
						$this->incentiverealizationdistribution_model->insertIncentiveEmployeeOmzet($data_employeeomzet);
					}
				}

				$incentiveemployeeomzet = $this->incentiverealizationdistribution_model->getIncentiveEmployeeOmzet_Detail($realization_distribution_id);

				foreach($incentiveemployeeomzet as $keyOmzet => $valOmzet){
					$employee_omzet_target 		= $valOmzet['employee_omzet_target'];
					$employee_omzet_achievement = $valOmzet['employee_omzet_achievement'];
					$region_id 					= $valOmzet['region_id'];
					$branch_id 					= $valOmzet['branch_id'];
					$location_id				= $valOmzet['location_id'];
					$job_title_id 				= $valOmzet['job_title_id'];

					$total_group_target_percentage			= $this->incentiverealizationdistribution_model->getTotalGroupTargetPercentage($realization_distribution_id, $region_id, $branch_id, $location_id, $job_title_id);

					$total_group_achievement_percentage		= $this->incentiverealizationdistribution_model->getTotalGroupAchievementPercentage($realization_distribution_id, $region_id, $branch_id, $location_id, $job_title_id);

					$incentivetitledistribution 	 		= $this->incentiverealizationdistribution_model->getTitleDistributionGroupAmount($realization_distribution_id, $region_id, $branch_id, $location_id, $job_title_id);

					$employee_omzet_branch_amount 			= $employee_omzet_achievement / $incentivetitledistribution['title_distribution_branch_amount'];

					if ($total_group_achievement_percentage >= $total_group_target_percentage){
						$employee_omzet_group_amount 	= $employee_omzet_achievement / $total_group_achievement_percentage * $incentivetitledistribution['title_distribution_group_amount'];
					} else {
						$employee_omzet_group_amount 	= 0;
					}

					if ($employee_omzet_achievement >= $employee_omzet_target ){
						$employee_omzet_individual_amount 	= $employee_omzet_achievement / $total_group_achievement_percentage * $incentivetitledistribution['title_distribution_individual_amount'];
					} else {
						$employee_omzet_individual_amount 	= 0;	
					}

					$data_updateincentiveemployeeomzet = array (
						'employee_omzet_id'					=> $val['employee_omzet_id'],
						'employee_omzet_branch_amount'		=> $employee_omzet_branch_amount,
						'employee_omzet_group_amount'		=> $employee_omzet_group_amount,
						'employee_omzet_individual_amount'	=> $employee_omzet_individual_amount,
					);

					$this->incentiverealizationdistribution_model->updateIncentiveEmployeeOmzet($data_updateincentiveemployeeomzet);
				}

				$auth = $this->session->userdata('auth');

				/*$this->fungsi->set_log($auth['user_id'], $auth['username'],'32212','Application.invtWarehouseTransferRequisition.processAddCoreAnalysis',$warehouse_transfer_requisition_id,'Add New Invt Warehouse Transfer Requisition');*/

				$msg = "<div class='alert alert-success'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
							Add Data Incentive Realization Distribution Successful
						</div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('addincentiverealizationdistribution-'.$unique['unique']);	
				$this->session->unset_userdata('addarrayincentivetitledistribution-'.$unique['unique']);	
				$this->session->unset_userdata('addarrayincentiveemployeeomzet-'.$unique['unique']);	
				redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution/');
			}else{
				$msg = "<div class='alert alert-danger'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
							Add Data Incentive Realization Distribution Fail
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution/');
			}
		}

		public function showdetail(){
			$realization_distribution_id 	= $this->uri->segment(3);

			$data['main_view']['incentiverealizationdistribution']		= $this->incentiverealizationdistribution_model->getIncentiveRealizationDistribution_Detail($realization_distribution_id);

			$data['main_view']['incentiveemployeeomzet']				= $this->incentiverealizationdistribution_model->getIncentiveEmployeeOmzet_Detail($realization_distribution_id);

			$data['main_view']['incentivetitledistribution']			= $this->incentiverealizationdistribution_model->getIncentiveTitleDistribution_Detail($realization_distribution_id);

			$data['main_view']['content']								='incentiverealizationdistribution/formdetailincentiverealizationdistribution_view';
			$this->load->view('mainpage_view',$data);
		}

		public function achievementIncentiveRealizationDistribution(){
			$realization_distribution_id 	= $this->uri->segment(3);

			$data['main_view']['incentiverealizationdistribution']	= $this->incentiverealizationdistribution_model->getIncentiveRealizationDistribution_Detail($realization_distribution_id);

			$data['main_view']['incentivetitledistribution']		= $this->incentiverealizationdistribution_model->getIncentiveTitleDistribution_Detail($realization_distribution_id);

			$data['main_view']['incentiveemployeeomzet']			= $this->incentiverealizationdistribution_model->getIncentiveEmployeeOmzet_Detail($realization_distribution_id);

			$data['main_view']['content']							= 'incentiverealizationdistribution/formachievementincentiverealizationdistribution_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function processAchievementIncentiveRealizationDistribution(){
			$data = array(
				'omzet_target_id' 				=> $this->input->post('omzet_target_id',true),
				'realization_distribution_id'	=> $this->input->post('realization_distribution_id',true),
				'edited_id' 					=> $auth['user_id'],
				'edited_on'						=> date('Y-m-d H:i:s'),
			);

			print_r("data ");
			print_r($data);
			print_r("<BR>");
			print_r("<BR>");
			print_r("POST ");
			print_r($_POST);

			foreach ($_POST as $key => $val) {
				print_r("key ");
				print_r( $key);
				print_r("<BR>");
				print_r("<BR>");
				if(is_numeric($key)){			
					$data_item[$key] = array(
						'employee_id'					=> $_POST["employee_id_".$key],
						'employee_omzet_achievement'	=> $_POST["employee_omzet_achievement_".$key],
					);
					
				}
			}

			print_r("data_item ");
			print_r($data_item);
			print_r("<BR>");

			exit;

			$omzet_achievement_total_amount = 0;
			foreach ($data_item as $keyItem => $valItem) {
				$omzet_achievement_total_amount = $omzet_achievement_total_amount + $valItem['omzet_achievement_amount'];
			}




			
			$data = array(
				'employee_absence_id' 				=> $this->input->post('employee_absence_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'absence_id' 							=> $this->input->post('absence_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			
			if($this->form_validation->run()==true){
				if($this->incentiverealizationdistribution_model->saveEditincentiverealizationdistribution($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.incentiverealizationdistribution.Edit',$auth['username'],'Edit Employee Absence');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_absence_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Absence Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationdistribution/Edit/'.$data['employee_absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Absence UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationdistribution/Edit/'.$data['employee_absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution/Edit/'.$data['employee_absence_id']);
			}
		}

		public function editIncentiveRealizationDistribution(){
			$realization_distribution_id = $this->uri->segment(3);


			$data['main_view']['incentiverealizationdistribution']		= $this->incentiverealizationdistribution_model->getIncentiveRealizationDistribution_Detail($realization_distribution_id);

			$data['main_view']['employee']		= create_double($this->incentiverealizationdistribution_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['absence']			= create_double($this->incentiverealizationdistribution_model->getabsence(),'absence_id','absence_name');

			$data['main_view']['content']		= 'incentiverealizationdistribution/editincentiverealizationdistribution_view';
			$this->load->view('mainpage_view',$data);
		}

		function processEditincentiverealizationdistribution(){
			
			$data = array(
				'employee_absence_id' 				=> $this->input->post('employee_absence_id',true),
				'employee_id' 						=> $this->input->post('employee_id',true),
				'employee_absence_date'				=> tgltodb($this->input->post('employee_absence_date',true)),
				'employee_absence_remark' 			=> $this->input->post('employee_absence_remark',true),
				'absence_id' 							=> $this->input->post('absence_id',true),
				'data_state'						=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_absence_date', 'Date', 'required');
			$this->form_validation->set_rules('absence_id', 'Absence', 'required');
			
			if($this->form_validation->run()==true){
				if($this->incentiverealizationdistribution_model->saveEditincentiverealizationdistribution($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.incentiverealizationdistribution.Edit',$auth['username'],'Edit Employee Absence');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_absence_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Absence Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationdistribution/Edit/'.$data['employee_absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Absence UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiverealizationdistribution/Edit/'.$data['employee_absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution/Edit/'.$data['employee_absence_id']);
			}
		}

		
		
		public function deleteIncentiveRealizationDistribution(){
			$employee_id = $this->uri->segment(3);

			if($this->incentiverealizationdistribution_model->deleteIncentiveRealizationDistribution($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.IncentiveRealizationDistribution.delete',$auth['user_id'],'Delete Employee Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution');
			}
		}

		public function deleteIncentiveRealizationDistribution_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_absence_id = $this->uri->segment(4);

			if($this->incentiverealizationdistribution_model->deleteIncentiveRealizationDistribution_Data($employee_absence_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.IncentiveRealizationDistribution_Data.delete',$auth['user_id'],'Delete Employee Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiverealizationdistribution/addIncentiveRealizationDistribution/'.$employee_id);
			}
		}
	}
?>