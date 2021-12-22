<?php
	Class incentiveomzettarget extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('incentiveomzettarget_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];

			$sesi	= 	$this->session->userdata('filter-incentiveomzettarget');
			if(!is_array($sesi)){
				$sesi['omzet_target_period']	= '';
			}

			$data['main_view']['monthlist']				= $this->configuration->Month;

			$data['main_view']['incentiveomzettarget']	= $this->incentiveomzettarget_model->getIncentiveOmzetTarget($region_id, $sesi['omzet_target_period']);

			$data['main_view']['content']				= 'incentiveomzettarget/listincentiveomzettarget_view';
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$month_period 	= $this->input->post('month_period',true);
			$year_period 	= $this->input->post('year_period',true);

			$omzet_target_period = $year_period.$month_period;

			$data = array (
				'omzet_target_period'	=> $omzet_target_period,
			);
			$this->session->set_userdata('filter-incentiveomzettarget',$data);
			redirect('incentiveomzettarget');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addincentiveomzettarget-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addincentiveomzettarget-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addincentiveomzettarget-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addincentiveomzettarget-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-incentiveomzettarget');
			$this->session->unset_userdata('filter-incentiveomzettarget');
			redirect('incentiveomzettarget');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addincentiveomzettarget-'.$sesi['unique']);	
			$this->session->unset_userdata('addarrayincentiveomzettargetitem-'.$sesi['unique']);	
			redirect('incentiveomzettarget/addIncentiveOmzetTarget');
		}

		public function getCoreLocation(){
			$branch_id = $this->input->post('branch_id');

			/*$branch_id = 1;*/
			
			$item = $this->incentiveomzettarget_model->getCoreLocation($branch_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[location_id]'>$mp[location_name]</option>\n";	
			}
			echo $data;
		}
		
		public function addIncentiveOmzetTarget(){	
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];

			$data['main_view']['monthlist']				= $this->configuration->Month;

			$data['main_view']['corebranch']			= create_double($this->incentiveomzettarget_model->getCoreBranch($region_id),'branch_id','branch_name');

			$data['main_view']['content']				= 'incentiveomzettarget/formaddincentiveomzettarget_view';
			$this->load->view('mainpage_view',$data);
		}

		public function processAddArrayIncentiveOmzetTarget(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];

			$data_omzettargetitem = array(
				'region_id'					=> $region_id,
				'branch_id'					=> $this->input->post('branch_id', true),
				'location_id'				=> $this->input->post('location_id', true),
				'omzet_target_amount'		=> $this->input->post('omzet_target_amount', true),
				'omzet_achievement_amount'	=> $this->input->post('omzet_achievement_amount', true),
			);

			$this->form_validation->set_rules('branch_id', 'Branch Name', 'required');
			$this->form_validation->set_rules('location_id', 'Location Name', 'required');
			$this->form_validation->set_rules('omzet_target_amount', 'Omzet Target Amount', 'required');
			$this->form_validation->set_rules('omzet_achievement_amount', 'Omzet Achievement Amount', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayincentiveomzettargetitem-'.$unique['unique']);
				
				$dataArrayHeader[$data_omzettargetitem['location_id']] = $data_omzettargetitem;
				
				$this->session->set_userdata('addarrayincentiveomzettargetitem-'.$unique['unique'], $dataArrayHeader);

				$sesi 	= $this->session->userdata('unique');
				$data_omzettargetitem = $this->session->userdata('addomzettarget-'.$sesi['unique']);
				
				$data_omzettargetitem['branch_id'] 					= '';
				$data_omzettargetitem['location_id'] 				= '';
				$data_omzettargetitem['omzet_target_amount'] 		= '';
				$data_omzettargetitem['omzet_target_amount1'] 		= '';
				$data_omzettargetitem['omzet_achievement_amount'] 	= '';
				$data_omzettargetitem['omzet_achievement_amount1'] 	= '';
				
				$this->session->set_userdata('addomzettarget-'.$sesi['unique'],$data_omzettargetitem);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayIncentiveOmzetTargetItem(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayincentiveomzettargetitem-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayincentiveomzettargetitem-'.$unique['unique'],$arrayBaru);
			
			redirect('incentiveomzettarget/addIncentiveOmzetTarget/');
		}
		
		public function processAddIncentiveOmzetTarget(){
			$auth 		= $this->session->userdata('auth');
			$unique 	= $this->session->userdata('unique');

			$month_period 	= $this->input->post('month_period',true);
			$year_period 	= $this->input->post('year_period',true);

			$omzet_target_period = $year_period.$month_period;

			$session_omzettargetitem	= $this->session->userdata('addarrayincentiveomzettargetitem-'.$unique['unique']);
			
			

			print_r("data ");
			print_r($data);
			/*exit;*/

			if(!empty($session_omzettargetitem)){
				$omzet_target_total_amount 		= 0;
				$omzet_achievement_total_amount = 0;
				foreach($session_omzettargetitem as $key => $val){
					$omzet_achievement_total_amount 	= $omzet_achievement_total_amount + $val['omzet_achievement_amount'];
					$omzet_target_total_amount 			= $omzet_target_total_amount + $val['omzet_target_amount'];
				}
			}

			$omzet_achievement_total_percentage	= $omzet_achievement_total_amount / $omzet_target_total_amount * 100;

			$incentiverealizationpercentage = $this->incentiveomzettarget_model->getIncentiveRealizationPercentage($omzet_achievement_total_percentage);

			$omzet_incentive_total_percentage 	= $incentiverealizationpercentage['realization_percentage_omzet'];
			$omzet_target_percentage_share 		= $incentiverealizationpercentage['realization_percentage_share'];

			$omzet_incentive_total_omzet_amount	= $omzet_incentive_total_percentage * $omzet_achievement_total_amount / 100;

			$omzet_incentive_total_amount 		= $omzet_target_percentage_share * $omzet_incentive_total_omzet_amount / 100;

			$data = array(
				'region_id'								=> $auth['region_id'],
				'omzet_target_period'					=> $omzet_target_period,
				'omzet_target_total_amount'				=> $this->input->post('omzet_target_total_amount',true),
				'omzet_achievement_total_amount'		=> $this->input->post('omzet_achievement_total_amount',true),
				'omzet_achievement_total_percentage'	=> $omzet_achievement_total_percentage,
				'omzet_target_percentage_share'			=> $omzet_target_percentage_share,
				'omzet_incentive_total_percentage'		=> $omzet_incentive_total_percentage,
				'omzet_incentive_total_amount'			=> $omzet_incentive_total_amount,
				'data_state'							=> 0,
				'created_id'							=> $auth['user_id'],
				'created_on'							=> date("Y-m-d H:i:s")	
			);

			/*print_r("data ");
			print_r($data);
			exit;*/
			
			if(!empty($session_omzettargetitem)){
				foreach($session_omzettargetitem as $key => $val){
					$omzet_achievement_percentage 	= $val['omzet_achievement_amount'] / $val['omzet_target_amount'] * 100;

					$omzet_incentive_percentage 	= $val['omzet_achievement_amount'] / $omzet_achievement_total_amount * 100;
					$omzet_incentive_amount			= $omzet_incentive_percentage * $omzet_incentive_total_amount / 100;

					if ($omzet_achievement_percentage >= 100){
						$omzet_incentive_share_amount 	= $omzet_incentive_amount;
						$omzet_incentive_pending_amount = 0;
					} else {
						$omzet_incentive_share_amount 	= 0;
						$omzet_incentive_pending_amount = $omzet_incentive_amount;
					}

					$data_incentiveomzettargetitem[$key] = array(
						'omzet_target_id'					=> $omzet_target_id,
						'branch_id'							=> $val['branch_id'],
						'location_id'						=> $val['location_id'],
						'omzet_target_amount'				=> $val['omzet_target_amount'],
						'omzet_achievement_amount'			=> $val['omzet_achievement_amount'],
						'omzet_achievement_percentage'		=> $omzet_achievement_percentage,
						'omzet_incentive_percentage'		=> $omzet_incentive_percentage,
						'omzet_incentive_amount'			=> $omzet_incentive_amount,
						'omzet_incentive_share_amount'		=> $omzet_incentive_share_amount,
						'omzet_incentive_pending_amount'	=> $omzet_incentive_pending_amount,
					);

					/*$this->incentiveomzettarget_model->insertIncentiveOmzetTargetItem($data_incentiveomzettargetitem);*/
				}
			}

			/*print_r("data_incentiveomzettargetitem ");
			print_r($data_incentiveomzettargetitem);
			exit;*/

			$this->form_validation->set_rules('omzet_target_period', 'Omzet Target Period', 'required');
			
			
			if($this->incentiveomzettarget_model->insertIncentiveOmzetTarget($data)){

				$omzet_target_id = $this->incentiveomzettarget_model->getOmzetTargetID($data['created_id']);

				if(!empty($session_omzettargetitem)){
					$omzet_target_total_amount 		= 0;
					$omzet_achievement_total_amount = 0;
					foreach($session_omzettargetitem as $key => $val){
						$omzet_achievement_total_amount 	= $omzet_achievement_total_amount + $val['omzet_achievement_amount'];
						$omzet_target_total_amount 			= $omzet_target_total_amount + $val['omzet_target_amount'];
					}
				}

				$omzet_achievement_total_percentage	= $omzet_achievement_total_amount / $omzet_target_total_amount * 100;

				$incentiverealizationpercentage = $this->incentiveomzettarget_model->getIncentiveRealizationPercentage($omzet_achievement_total_percentage);

				$omzet_incentive_total_percentage 	= $incentiverealizationpercentage['realization_percentage_omzet'];
				$omzet_target_percentage_share 		= $incentiverealizationpercentage['realization_percentage_share'];

				$omzet_incentive_total_omzet_amount	= $omzet_incentive_total_percentage * $omzet_achievement_total_amount / 100;

				$omzet_incentive_total_amount 		= $omzet_target_percentage_share * $omzet_incentive_total_omzet_amount / 100;
				
				if(!empty($session_omzettargetitem)){
					foreach($session_omzettargetitem as $key => $val){
						$omzet_achievement_percentage 	= $val['omzet_achievement_amount'] / $val['omzet_target_amount'] * 100;

						$omzet_incentive_percentage 	= $val['omzet_achievement_amount'] / $omzet_achievement_total_amount * 100;
						$omzet_incentive_amount			= $omzet_incentive_percentage * $omzet_incentive_total_amount / 100;

						if ($omzet_achievement_percentage >= 100){
							$omzet_incentive_share_amount 	= $omzet_incentive_amount;
							$omzet_incentive_pending_amount = 0;
						} else {
							$omzet_incentive_share_amount 	= 0;
							$omzet_incentive_pending_amount = $omzet_incentive_amount;
						}

						$data_incentiveomzettargetitem = array(
							'omzet_target_id'					=> $omzet_target_id,
							'branch_id'							=> $val['branch_id'],
							'location_id'						=> $val['location_id'],
							'omzet_target_amount'				=> $val['omzet_target_amount'],
							'omzet_achievement_amount'			=> $val['omzet_achievement_amount'],
							'omzet_achievement_percentage'		=> $omzet_achievement_percentage,
							'omzet_incentive_percentage'		=> $omzet_incentive_percentage,
							'omzet_incentive_amount'			=> $omzet_incentive_amount,
							'omzet_incentive_share_amount'		=> $omzet_incentive_share_amount,
							'omzet_incentive_pending_amount'	=> $omzet_incentive_pending_amount,
						);

						$this->incentiveomzettarget_model->insertIncentiveOmzetTargetItem($data_incentiveomzettargetitem);
					}
				}

				/*print_r("data_incentiveomzettargetitem ");
				print_r($data_incentiveomzettargetitem);
				exit;*/
				/*Process Calculate Omzet Target*/



				$auth = $this->session->userdata('auth');

				/*$this->fungsi->set_log($auth['user_id'], $auth['username'],'32212','Application.invtWarehouseTransferRequisition.processAddCoreAnalysis',$warehouse_transfer_requisition_id,'Add New Invt Warehouse Transfer Requisition');*/

				$msg = "<div class='alert alert-success'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
							Add Data Incentive Omzet Target Successfully
						</div> ";
				$this->session->set_userdata('message',$msg);
				$this->session->unset_userdata('addincentiveomzettarget-'.$unique['unique']);
				$this->session->unset_userdata('addarrayincentiveomzettargetitem-'.$unique['unique']);
				redirect('incentiveomzettarget/addIncentiveOmzetTarget/');
			}else{
				$msg = "<div class='alert alert-danger'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
							Add Data Incentive Omzet Target Fail
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiveomzettarget/addIncentiveOmzetTarget/');
			}
		}

		public function showdetail(){
			$omzet_target_id 	= $this->uri->segment(3);

			$data['main_view']['incentiveomzettarget']		= $this->incentiveomzettarget_model->getIncentiveOmzetTarget_Detail($omzet_target_id);

			$data['main_view']['incentiveomzettargetitem']	= $this->incentiveomzettarget_model->getIncentiveOmzetTargetItem_Detail($omzet_target_id);

			$data['main_view']['content']					='incentiveomzettarget/formdetailincentiveomzettarget_view';
			$this->load->view('mainpage_view',$data);
		}




		
		function Edit(){
			$data['main_view']['result']		= $this->incentiveomzettarget_model->getDetail($this->uri->segment(3));
			$data['main_view']['content']		= 'incentiveomzettarget/editincentiveomzettarget_view';
			$data['main_view']['employee']		= create_double($this->incentiveomzettarget_model->getemployee(),'employee_id','employee_name');
			$data['main_view']['absence']			= create_double($this->incentiveomzettarget_model->getabsence(),'absence_id','absence_name');
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditincentiveomzettarget(){
			
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
				if($this->incentiveomzettarget_model->saveEditincentiveomzettarget($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.incentiveomzettarget.Edit',$auth['username'],'Edit Employee Absence');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_absence_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Absence Successfully
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiveomzettarget/Edit/'.$data['employee_absence_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Absence UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('incentiveomzettarget/Edit/'.$data['employee_absence_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('incentiveomzettarget/Edit/'.$data['employee_absence_id']);
			}
		}
		
		public function deleteIncentiveOmzetTarget(){
			$employee_id = $this->uri->segment(3);

			if($this->incentiveomzettarget_model->deleteIncentiveOmzetTarget($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.IncentiveOmzetTarget.delete',$auth['user_id'],'Delete Employee Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiveomzettarget');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiveomzettarget');
			}
		}

		public function deleteIncentiveOmzetTarget_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_absence_id = $this->uri->segment(4);

			if($this->incentiveomzettarget_model->deleteIncentiveOmzetTarget_Data($employee_absence_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['user_id'],'1005','Application.IncentiveOmzetTarget_Data.delete',$auth['user_id'],'Delete Employee Absence');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Absence Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiveomzettarget/addIncentiveOmzetTarget/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Absence UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('incentiveomzettarget/addIncentiveOmzetTarget/'.$employee_id);
			}
		}
	}
?>