<?php
	Class assignmentovertimerate extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('assignmentovertimerate_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$data['main_view']['assignmentovertimerate']	= $this->assignmentovertimerate_model->getAssignmentOvertimeRate();
			$data['main_view']['content']					= 'assignmentovertimerate/listassignmentovertimerate_view';
			$this->load->view('mainpage_view',$data);
		}
			
		public function addAssignmentOvertimeRate(){
			$data['main_view']['corezone']			= create_double($this->assignmentovertimerate_model->getCoreZone(),'zone_id','zone_name');
			$data['main_view']['coredivision']		= create_double($this->assignmentovertimerate_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['corejobtitle']		= create_double($this->assignmentovertimerate_model->getCoreJobTitle(),'job_title_id','job_title_name');
			$data['main_view']['content']			= 'assignmentovertimerate/formaddassignmentovertimerate_view';
			$this->load->view('mainpage_view',$data);
		}

		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addassignmentovertimerate-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addassignmentovertimerate-'.$unique['unique'],$sessions);
		}

		public function reset_data(){
			$unique 	= $this->session->userdata('unique');

			$this->session->unset_userdata('addassignmentovertimerate-'.$unique['unique']);
			$this->session->unset_userdata('addarrayassignmentovertimeratetitle-'.$unique['unique']);
			redirect('assignmentovertimerate/addAssignmentOvertimeRate');
		}

		public function reset_data_edit(){
			$unique 			= $this->session->userdata('unique');
			$overtime_rate_id 	= $this->uri->segment(3);


			$this->session->unset_userdata('editassignmentovertimerate-'.$unique['unique']);
			$this->session->unset_userdata('editarrayassignmentovertimeratetitle-'.$unique['unique']);
			redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_id);
		}

		public function getCoreDepartment(){
			$division_id = $this->input->post('division_id');
			
			$item = $this->assignmentovertimerate_model->getCoreDepartment($division_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[department_id]'>$mp[department_name]</option>\n";	
			}
			echo $data;
		}
		
		public function getCoreSection(){
			$department_id = $this->input->post('department_id');
			
			$item = $this->assignmentovertimerate_model->getCoreSection($department_id);
			$data .= "<option value=''>--Choose One--</option>";
			foreach ($item as $mp){
				$data .= "<option value='$mp[section_id]'>$mp[section_name]</option>\n";	
			}
			echo $data;
		}

		public function processAddArrayAssignmentOvertimeRateTitle(){
			$data_assignmentovertimerate = array(
				'division_id'				=> $this->input->post('division_id', true),
				'department_id'				=> $this->input->post('department_id', true),
				'section_id'				=> $this->input->post('section_id', true),
				'job_title_id'				=> $this->input->post('job_title_id', true),
				'overtime_rate_amount'		=> $this->input->post('overtime_rate_amount', true),
			);

			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('overtime_rate_amount', 'Overtime Rate Amount', 'required');
			
			if($this->form_validation->run()==true){
				$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addarrayassignmentovertimeratetitle-'.$unique['unique']);
				
				$dataArrayHeader[$data_assignmentovertimerate['job_title_id']] = $data_assignmentovertimerate;
				
				$this->session->set_userdata('addarrayassignmentovertimeratetitle-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_assignmentovertimerate = $this->session->userdata('addassignmentovertimerate-'.$sesi['unique']);
				
				$data_assignmentovertimerate['division_id'] 			= '';
				$data_assignmentovertimerate['department_id'] 			= '';
				$data_assignmentovertimerate['section_id'] 				= '';
				$data_assignmentovertimerate['job_title_id'] 			= '';
				$data_assignmentovertimerate['overtime_rate_amount'] 	= '';
				
				$this->session->set_userdata('addassignmentovertimerate-'.$sesi['unique'],$data_assignmentovertimerate);
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>");
				$this->session->set_userdata('message',$msg);
			}
		}

		public function deleteArrayAssignmentOvertimeRateTitle(){
			$arrayBaru			= array();
			$var_to 			= $this->uri->segment(3);
			$session_name		= "addarrayassignmentovertimeratetitle-";
			$unique 			= $this->session->userdata('unique');
			$dataArrayHeader	= $this->session->userdata($session_name.$unique['unique']);
			$unique 			= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $var_to){
					$arrayBaru[$key] = $val;
				}
			}
			
			$this->session->set_userdata('addarrayassignmentovertimeratetitle-'.$unique['unique'],$arrayBaru);
			
			redirect('assignmentovertimerate/addAssignmentOvertimeRate/');
		}

		public function processAddAssignmentOvertimeRate(){
			$auth = $this->session->userdata('auth');

			$session_assignmentovertimeratetitle	= $this->session->userdata('addarrayassignmentovertimeratetitle-'.$unique['unique']);

			$data_overtimerate = array(
				'zone_id'							=> $this->input->post('zone_id',true),
				'overtime_rate_description'			=> $this->input->post('overtime_rate_description',true),
				'overtime_rate_effective_date'		=> tgltodb($this->input->post('overtime_rate_effective_date',true)),
				'data_state'						=> 0,
				'created_id'						=> $auth['user_id'],
				'created_on'						=> date("Y-m-d H:i:s")	
			);

			$this->form_validation->set_rules('zone_id', 'Zone Name', 'required');
			$this->form_validation->set_rules('overtime_rate_description', 'Overtime Rate Description', 'required');
			$this->form_validation->set_rules('overtime_rate_effective_date', 'Overtime Rate Effective Date', 'required');
			
			if($this->form_validation->run()==true){
				if($this->assignmentovertimerate_model->insertAssignmentOvertimeRate($data_overtimerate)){		
					$overtime_rate_id = $this->assignmentovertimerate_model->getOvertimeRateID($data_overtimerate['created_id']);
					
					if(!empty($session_assignmentovertimeratetitle)){
						foreach($session_assignmentovertimeratetitle as $key=>$val){
							$data_assignmentovertimeratetitle = array(
								'overtime_rate_id'				=> $overtime_rate_id,
								'division_id'					=> $val['division_id'],
								'department_id'					=> $val['department_id'],
								'section_id'					=> $val['section_id'],
								'job_title_id'					=> $val['job_title_id'],
								'overtime_rate_amount'			=> $val['overtime_rate_amount'],
							);
							$this->assignmentovertimerate_model->insertAssignmentOvertimeRateTitle($data_assignmentovertimeratetitle);
						}
					}

					$auth = $this->session->userdata('auth');

					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8142','Application.assignmentOvertimeRate.processAddAssignmentOvertimeRate',$overtime_rate_id,'Add New Assignment Overtime Rate');

					$msg = "<div class='alert alert-success'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>                          
								Add Data Assignment Overtime Rate Successful
							</div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('addassignmentovertimerate-'.$unique['unique']);
					$this->session->unset_userdata('addarrayassignmentovertimeratetitle-'.$unique['unique']);
					redirect('assignmentovertimerate/addAssignmentOvertimeRate/');

				}else{
					$msg = "<div class='alert alert-danger'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>             
								Add Data Assignment Overtime Rate Fail
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentovertimerate/addAssignmentOvertimeRate/');
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('addassignmentbusinesstrip',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerate/addAssignmentOvertimeRate/');
			}
		}
		
		public function processAddAssignmentOvertimeRate2(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>$this->assignmentovertimerate_model->get_unique()));
			}
			$data 					= $this->session->userdata('assignmentovertimerate-'.$sesi['unique']);
			$dataArray 				= $this->session->userdata($data['created_on']);
			$auth 					= $this->session->userdata('auth');
			
			$data_overtimerate = array(
				'zone_id'						=> $data['zone_id'],
				'overtime_rate_effective_date'	=> tgltodb($data['overtime_rate_effective_date']),
				'overtime_rate_description'		=> $data['overtime_rate_description'],
				'created_on'					=> $data['created_on'],
				'created_id'					=> $auth['user_id']
			);
			
			if($data_overtimerate['created_on']!=''){
				if($this->assignmentovertimerate_model->saveNewAssignmentOvertimeRate($data_overtimerate)){		
					$overtime_rate_id = $this->assignmentovertimerate_model->getOvertimeRateID($data_overtimerate['created_id']);
					
					$this->fungsi->set_log($auth['user_id'], $auth['username'],'8142','Application.assignmentOvertimeRate.processAddAssignmentOvertimeRate',$overtime_rate_id,'Add New Assignment Overtime Rate');

					foreach($dataArray as $key=>$val){
						if($this->assignmentovertimerate_model->saveNewAssignmentOvertimeRateTitle($val, $overtime_rate_id)){
							$auth = $this->session->userdata('auth');

							$msg = "<div class='alert alert-success alert-dismissable'>   
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
										Add Data Overtime Rate Successfully
									</div> ";
							$this->session->set_userdata('message',$msg);
							continue;
						}else{
							$msg = "<div class='alert alert-danger alert-dismissable'>  
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>            
										Add Data Overtime Rate UnSuccessful
									</div> ";
							$this->session->set_userdata('message',$msg);
							redirect('assignmentovertimerate/addAssignmentOvertimeRate');
							break;
						}
					}
					$this->session->unset_userdata('assignmentovertimerate-'.$sesi['unique']);
					$this->session->unset_userdata($data['created_on']);
					redirect('assignmentovertimerate/addAssignmentOvertimeRate');
				}else{
					$msg = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>        
								Data Overtime Rate UnSuccessful
							</div> ";
					$this->session->set_userdata('message',$msg);
					redirect('assignmentovertimerate/addAssignmentOvertimeRate');
				}
			}else{
				$msg = "<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>          
							Data Overtime Rate Not Yet Completed
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerate/addAssignmentOvertimeRate');
			}
		}

		public function showdetail(){
			$overtime_rate_id									= $this->uri->segment(3);
			$data['main_view']['assignmentovertimerate']		= $this->assignmentovertimerate_model->getAssignmentOvertimeRate_Detail($overtime_rate_id);
			$data['main_view']['assignmentovertimeratetitle']	= $this->assignmentovertimerate_model->getAssignmentOvertimeRateTitle_Detail($overtime_rate_id);
			$data['main_view']['content']						= 'assignmentovertimerate/formdetailassignmentovertimerate_view';
			$this->load->view('mainpage_view',$data);
		}

		public function editAssignmentOvertimeRate(){
			$sesi 				= $this->session->userdata('unique');
			$unique 			= $this->session->userdata('unique');

			$overtime_rate_id 				= $this->uri->segment(3);

			$assignmentovertimerate 		= $this->assignmentovertimerate_model->getAssignmentOvertimeRate_Detail($overtime_rate_id);

			$assignmentovertimeratetitle 	= $this->assignmentovertimerate_model->getAssignmentOvertimeRateTitle_Detail($overtime_rate_id);

			$dataArrayHeaderEdit	= $this->session->userdata('editarrayassignmentovertimeratetitle-'.$unique['unique']);

			if (empty($dataArrayHeaderEdit)){
				foreach ($assignmentovertimeratetitle as $keyOvertimeTitle => $valOvertimeTitle) {
					$data_editassignmentovertimerate = array(
						'division_id'				=> $valOvertimeTitle['division_id'],
						'department_id'				=> $valOvertimeTitle['department_id'],
						'section_id'				=> $valOvertimeTitle['section_id'],
						'job_title_id'				=> $valOvertimeTitle['job_title_id'],
						'overtime_rate_amount'		=> $valOvertimeTitle['overtime_rate_amount'],
					);

					$session_name 			= $this->input->post('session_name',true);
					$dataArrayHeaderEdit	= $this->session->userdata('editarrayassignmentovertimeratetitle-'.$unique['unique']);
					
					$dataArrayHeaderEdit[$data_editassignmentovertimerate['job_title_id']] = $data_editassignmentovertimerate;
					
					$this->session->set_userdata('editarrayassignmentovertimeratetitle-'.$unique['unique'],$dataArrayHeaderEdit);
					$sesi 	= $this->session->userdata('unique');
					$data_editassignmentovertimerate = $this->session->userdata('editassignmentovertimerate-'.$sesi['unique']);
					
					$this->session->set_userdata('editassignmentovertimerate-'.$sesi['unique'],$data_assignmentovertimerate);
				}
			}
			
			$data['main_view']['assignmentovertimerate']		= $this->assignmentovertimerate_model->getAssignmentOvertimeRate_Detail($overtime_rate_id);

			$data['main_view']['corezone']						= create_double($this->assignmentovertimerate_model->getCoreZone(),'zone_id','zone_name');

			$data['main_view']['coredivision']					= create_double($this->assignmentovertimerate_model->getCoreDivision(),'division_id','division_name');

			$data['main_view']['corejobtitle']					= create_double($this->assignmentovertimerate_model->getCoreJobTitle(),'job_title_id','job_title_name');

			$data['main_view']['content']						= 'assignmentovertimerate/formeditassignmentovertimerate_view';
			$this->load->view('mainpage_view',$data);
		}

		public function deleteEditArrayAssignmentOvertimeRateTitle(){
			$arrayBaru					= array();
			$overtime_rate_id 			= $this->uri->segment(3);
			$job_title_id				= $this->uri->segment(4);
			$session_name				= "editarrayassignmentovertimeratetitle-";
			$dataArrayHeader			= $this->session->userdata($session_name.$unique['unique']);
			$unique 					= $this->session->userdata('unique');
			
			foreach($dataArrayHeader as $key=>$val){
				if($key != $job_title_id){
					$arrayBaru[$key] = $val;
				}
			}

			/*print_r("arrayBaru ");
			print_r($arrayBaru);
			exit;*/
			
			$this->session->set_userdata('editarrayassignmentovertimeratetitle-'.$unique['unique'],$arrayBaru);
			
			redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_id);
		}

		public function processEditArrayAssignmentOvertimeRate(){
			$sesi 				= $this->session->userdata('unique');
			$overtime_rate_id 	= $this->input->post('overtime_rate_id');

			$data = array(
				'overtime_rate_id'				=> $overtime_rate_id,
				'zone_id'						=> $this->input->post('zone_id', true),
				'overtime_rate_effective_date'	=> $this->input->post('overtime_rate_effective_date', true),
				'overtime_rate_description'		=> $this->input->post('overtime_rate_description', true),
			);
			
			$DivisionID		= $this->input->post('division_id', true);
			$departmentID	= $this->input->post('department_id', true);
			$sectionID		= $this->input->post('section_id', true);
			$jobTitleID		= $this->input->post('job_title_id', true);
			$allowanceID	= $this->input->post('allowance_id', true);

			$overtimeRateTitleID = $divisionID.$departmentID.$sectionID.$jobTitleID.$allowanceID;
			
			$data_item = array(
				'overtime_rate_title_id'			=> $overtimeRateTitleID,
				'overtime_rate_id'					=> $overtime_rate_id,
				'division_id'						=> $this->input->post('division_id', true),
				'department_id'						=> $this->input->post('department_id', true),
				'section_id'						=> $this->input->post('section_id', true),
				'job_title_id'						=> $this->input->post('job_title_id', true),
				'allowance_id'						=> $this->input->post('allowance_id', true),
				'overtime_rate_allowance_amount'	=> $this->input->post('overtime_rate_allowance_amount', true),
			);
			
			$this->form_validation->set_rules('division_id', 'Division Name', 'required');
			$this->form_validation->set_rules('department_id', 'Department Name', 'required');
			$this->form_validation->set_rules('section_id', 'Section Name', 'required');
			$this->form_validation->set_rules('job_title_id', 'Job Title Name', 'required');
			$this->form_validation->set_rules('allowance_id', 'Allowance Name', 'required');
			$this->form_validation->set_rules('overtime_rate_allowance_amount', 'Allowance Amount', 'required');

			if($this->form_validation->run()==true){
				// $header = $this->session->userdata('customerrouteedit-'.$customer_route_id.$sesi['unique']);
				// if(!is_array($header)){
					$this->session->set_userdata('assignmentovertimerateedit-'.$overtime_rate_id.$sesi['unique'], $data);
				// }
				$dataArray 	= $this->session->userdata($overtime_rate_id);
					
				$dataArray[$data_item['overtime_rate_title_id']] = $data_item;
				$this->session->set_userdata($overtime_rate_id,$dataArray);

				/*print_r("dataArray");
				print($dataArray);
				print_r("<BR>");

				exit;*/
				redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_id);	
			}else{
				$this->session->set_userdata('item',$data_item);
				$this->session->set_userdata('assignmentovertimerateedit-'.$sesi['unique'],$data);
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_id);		
			}	
		}
		
		public function processEditAssignmentOvertimeRate(){			
			$sesi 				= $this->session->userdata('unique');
			$overtime_rate_id 	= $this->input->post('overtime_rate_id2');
			$data 				= $this->session->userdata('assignmentovertimerateedit-'.$overtime_rate_id.$sesi['unique']);
			$dataawal 			= $this->session->userdata('assignmentovertimerateeditawal-'.$overtime_rate_id.$sesi['unique']);
			
			$data_overtimerate = array(
				'overtime_rate_id'					=> $overtime_rate_id,
				'division_id'						=> $data['division_id'],
				'department_id'						=> $data['department_id'],
				'section_id'						=> $data['section_id'],
				'job_title_id'						=> $data['job_title_id'],
				'allowance_id'						=> $data['allowance_id'],
				'overtime_rate_allowance_amount'	=> $data['overtime_rate_allowance_amount'],
			);
			
			$dataArray 	= $this->session->userdata($data_overtimerate['overtime_rate_id']);
			$dataArray2	= $this->session->userdata($data_overtimerate['overtime_rate_id'].'-awal');

			$this->fungsi->set_log($auth['user_id'], $auth['username'],'8143','Application.assignmentOvertimeRate.processEditAssignmentOvertimeRate',$overtime_rate_id,'Edit Assignment Overtime Rate');
			
			if ($this->assignmentovertimerate_model->deleteAssignmentOvertimeRateTitle($overtime_rate_id)){
				foreach($dataArray as $key=>$val){
					$created_on = date('Ymdhis');
					if($this->assignmentovertimerate_model->saveUpdateAssignmentOvertimeRateTitle($val, $overtime_rate_id)){
						$auth = $this->session->userdata('auth');
						//
						$msg = "<div class='alert alert-success alert-dismissable'>   
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	
									Update Data Overtime Rate Successfully
								</div> ";
						$this->session->set_userdata('message',$msg);
						continue;
					}else{
						$msg = "<div class='alert alert-danger alert-dismissable'>  
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>            
									Update Data Overtime Rate UnSuccessful
								</div> ";
						$this->session->set_userdata('message',$msg);
						redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_id);
						break;
					}
				}
				
				$this->session->unset_userdata('assignmentovertimerateedit-'.$overtime_rate_id.$sesi['unique']);
				$this->session->unset_userdata($overtime_rate_id);
				
				$this->session->unset_userdata('assignmentovertimerateeditawal-'.$overtime_rate_id.$sesi['unique']);
				$this->session->unset_userdata($overtime_rate_id.'-awal');

				redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_id);
			}else {
				$msg = "<div class='alert alert-danger alert-dismissable'>  
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>        
							Update Data Overtime Rate UnSuccessful
						</div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerate/editAssignmentOvertimeRate/'.$overtime_rate_title_id);
			}
		}
		
		public function deleteAssignmentOvertimeRate(){
			$overtime_rate_id = $this->uri->segment(3);
			if($this->assignmentovertimerate_model->deleteAssignmentOvertimeRate($overtime_rate_id)){
				$auth = $this->session->userdata('auth');

				$this->fungsi->set_log($auth['user_id'], $auth['username'],'8134','Application.assignmentOvertimeRate.processDeleteAssignmentOvertimeRate', $overtime_rate_id,'Delete Assignment Overtime Rate');

				$msg = "<div class='alert alert-success'>                
							Delete Data Overtime Rate Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerate');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Overtime Rate Profile UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('assignmentovertimerate');
			}
		}
	}
?>