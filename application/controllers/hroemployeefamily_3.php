<?php
	Class hroemployeefamily extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeefamily_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeefamily');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeefamily_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeefamily_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeefamily_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeefamily_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');
			$data['main_view']['hroemployeedata_family']	= $this->hroemployeefamily_model->getHROEmployeeData_Family($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']				= 'hroemployeefamily/listhroemployeefamily_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeefamily',$data);
			redirect('hroemployeefamily');
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeefamily-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeefamily-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeefamily-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeefamily-'.$unique['unique'],$sessions);
			// echo $name;
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeefamily');
			$this->session->unset_userdata('filter-hroemployeefamily');
			redirect('hroemployeefamily');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('hroemployeefamily-'.$sesi['unique']);	
			redirect('hroemployeefamily');
		}
		
		function addHROEmployeeFamily(){
			$employee_id = $this->uri->segment(3);	

			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$data['main_view']['gender']					= $this->configuration->Gender;
			$data['main_view']['status']					= $this->configuration->Status;
			$data['main_view']['corefamilyrelation']		= create_double($this->hroemployeefamily_model->getCoreFamilyRelation(),'family_relation_id','family_relation_name');
			$data['main_view']['coremaritalstatus']			= create_double($this->hroemployeefamily_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');
			$data['main_view']['hroemployeedata']			= $this->hroemployeefamily_model->getHROEmployeeData($employee_id);
			$data['main_view']['content']	= 'hroemployeefamily/listaddhroemployeefamily_view';
			$this->load->view('mainpage_view',$data);
		}

		public function insertArrayAddHROEmployeeFamily(){
			$sesi 	= $this->session->userdata('unique');
			$auth	= $this->session->userdata('auth');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>$this->hroemployeefamily_model->get_unique()));
			}
			$sesi 	= $this->session->userdata('unique');
			
			$header = $this->session->userdata('addhroemployeefamily-'.$sesi['unique']);

			$employee_id 	= $this->input->post('employee_id',true);
			$created_id 	= $auth['user_id'];

			if(empty($header)){
				
				$data_header = array (
					'employee_id'					=> $employee_id,
					'created_id' 					=> $created_id,
					'created_on'					=> date('Y-m-d h:i:s'),			
				);
				
				print_r($data_header);
				
				$this->session->set_userdata('addhroemployeefamily',$data);
				$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			}else{
				$data_header = array (
					'employee_id'					=> $header['employee_id'],
					'created_id' 					=> $header['created_id'],
					'created_on'					=> $header['created_on'],
				);
				
			}
			
			
			$data_family = array(
				'record_id'								=> date("YmdHis"),
				'family_relation_id' 					=> $this->input->post('family_relation_id',true),
				'employee_id' 							=> $this->input->post('employee_id',true),
				'marital_status_id' 					=> $this->input->post('marital_status_id',true),
				'employee_family_name' 					=> $this->input->post('employee_family_name',true),
				'employee_family_address' 				=> $this->input->post('employee_family_address',true),
				'employee_family_city' 					=> $this->input->post('employee_family_city',true),
				'employee_family_postal_code' 			=> $this->input->post('employee_family_postal_code',true),
				'employee_family_rt' 					=> $this->input->post('employee_family_rt',true),
				'employee_family_rw' 					=> $this->input->post('employee_family_rw',true),
				'employee_family_kecamatan' 			=> $this->input->post('employee_family_kecamatan',true),
				'employee_family_kelurahan' 			=> $this->input->post('employee_family_kelurahan',true),
				'employee_family_home_phone' 			=> $this->input->post('employee_family_home_phone',true),
				'employee_family_mobile_phone' 			=> $this->input->post('employee_family_mobile_phone',true),
				'employee_family_gender' 				=> $this->input->post('employee_family_gender',true),
				'employee_family_date_of_birth' 		=> tgltodb($this->input->post('employee_family_date_of_birth',true)),
				'employee_family_place_of_birth' 		=> $this->input->post('employee_family_place_of_birth',true),
				'employee_family_education' 			=> $this->input->post('employee_family_education',true),
				'employee_family_occupation' 			=> $this->input->post('employee_family_occupation',true),
				'employee_family_has_coverage_claim'	=> $this->input->post('employee_family_has_coverage_claim',true),
				'employee_family_coverage_ratio' 		=> $this->input->post('employee_family_coverage_ratio',true),
				'employee_family_remark' 				=> $this->input->post('employee_family_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $created_id,
				'created_on'							=> date("Y-m-d H:i:s")
			);
			print_r("data header ");
			print_r($data_header);
				print_r("<BR>");

			$this->form_validation->set_rules('family_relation_id', 'Family Relation', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			$this->form_validation->set_rules('employee_family_name', 'Family Name', 'required');
			$this->form_validation->set_rules('employee_family_address', 'Family Address', 'required');
			$this->form_validation->set_rules('employee_family_city', 'Family City', 'required');
			$this->form_validation->set_rules('employee_family_kecamatan', 'Family Kecamatan', 'required');
			$this->form_validation->set_rules('employee_family_kelurahan', 'Family Kelurahan', 'required');
			$this->form_validation->set_rules('employee_family_mobile_phone', 'Mobile Phone', 'required');
				
			if($this->form_validation->run()==true){
				/*$unique 			= $this->session->userdata('unique');
				$session_name 		= $this->input->post('session_name',true);
				$dataArrayHeader	= $this->session->userdata('addhroemployeefamily-'.$unique['unique']);
				// $dataArrayHeader[$data['item_id'].'-'.$data['quantity'].'-'.$data['item_unit_id']] = $data;
				$dataArrayHeader[$data_header['employee_id']] = $data_header;
				
				$this->session->set_userdata('addhroemployeefamily-'.$unique['unique'],$dataArrayHeader);
				$sesi 	= $this->session->userdata('unique');
				$data_family = $this->session->userdata('addhroemployeefamily-'.$sesi['unique']);*/
				
				
				$header = $this->session->userdata('addhroemployeefamily-'.$sesi['unique']);
				if(!is_array($header)){
					$this->session->set_userdata('addhroemployeefamily-'.$sesi['unique'],$data_header);
					
					print_r("header empty");
				}
				$dataArray 	= $this->session->userdata($data_header['created_on']);
				
				/* print_r("header bawah");
				print_r('<BR>');
				print_r($header);
				print_r('<BR>'); */
				/* print_r("data_header bawah");
				print_r('<BR>');
				print_r($data_header);
				print_r('<BR>');*/
				/* print_r("dataArray");
				print_r('<BR>');
				print_r($dataArray);
				print_r('<BR>');  */
				/* exit; */
				
				$dataArray[$data_family['record_id']] = $data_family;
				$this->session->set_userdata($data_header['created_on'],$dataArray);
				/*redirect('transactiontestingresult/result/'.$testing_id);*/

				/* print_r("dataArrayHeader ");
				print_r($dataArrayHeader);
				print_r("<BR>");
				print_r("data_family ");
				print_r($data_header);
				exit; */
				
				/*$data_family['family_relation_id'] = '';
				$data_family['marital_status_id_family'] = '';
				$data_family['applicant_family_name'] = '';
				$data_family['applicant_family_gender'] = '';
				$data_family['applicant_family_age'] = '';
				$data_family['applicant_family_education'] = '';
				$data_family['applicant_family_occupation'] = '';
				$data_family['applicant_family_sibling'] = '';
				$data_family['applicant_family_remark'] = '';*/
				
				/*$this->session->set_userdata('addhroemployeefamily-'.$sesi['unique'],$data_header);*/
				redirect('hroemployeefamily/addHROEmployeeFamily/'.$data_header['employee_id']);
			}else{
				$msg = validation_errors("<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeefamily/addHROEmployeeFamily/'.$data_header['employee_id']);
			}
		}
		
		function processAddHROEmployeeFamily(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>$this->hroemployeefamily_model->get_unique()));
			}
			
			$data 					= $this->session->userdata('addhroemployeefamily-'.$sesi['unique']);
			$dataArray 				= $this->session->userdata($data['created_on']);

			$auth					= $this->session->userdata('auth');

			print_r("dataArray ");
			print_r($dataArray);
			print_r("<BR>");
			

			/*if(!empty($dataArray)){
				foreach($dataArray as $key=>$val){
					$data_family = array(
						'family_relation_id' 					=> $val['family_relation_id'],
						'employee_id' 							=> $val['employee_id'],
						'marital_status_id' 					=> $val['marital_status_id'],
						'employee_family_name' 					=> $val['employee_family_name'],
						'employee_family_address' 				=> $val['employee_family_address'],
						'employee_family_city' 					=> $val['employee_family_city'],
						'employee_family_postal_code' 			=> $val['employee_family_postal_code'],
						'employee_family_rt' 					=> $val['employee_family_rt'],
						'employee_family_rw' 					=> $val['employee_family_rw'],
						'employee_family_kecamatan' 			=> $val['employee_family_kecamatan'],
						'employee_family_kelurahan' 			=> $val['employee_family_kelurahan'],
						'employee_family_home_phone' 			=> $val['employee_family_home_phone'],
						'employee_family_mobile_phone' 			=> $val['employee_family_mobile_phone'],
						'employee_family_gender' 				=> $val['employee_family_gender'],
						'employee_family_date_of_birth' 		=> tgltodb($val['employee_family_date_of_birth']),
						'employee_family_place_of_birth' 		=> $val['employee_family_place_of_birth'],
						'employee_family_education' 			=> $val['employee_family_education'],
						'employee_family_occupation' 			=> $val['employee_family_occupation'],
						'employee_family_has_coverage_claim'	=> $val['employee_family_has_coverage_claim'],
						'employee_family_coverage_ratio' 		=> $val['employee_family_coverage_ratio'],
						'employee_family_remark' 				=> $val['employee_family_remark'],
						'data_state'							=> $val['data_state'],
						'created_id'							=> $val['created_id'],
						'created_on'							=> $val['created_on']
					);
				}
			}*/

			print_r("<BR>");
			print_r("<BR>");
			print_r("data_family ");
			print_r($data_family);
			print_r("<BR>");


			if(is_array($dataArray)){
				foreach($dataArray as $key=>$val){
					if($this->hroemployeefamily_model->saveNewHROEmployeeFamily($val)){
						$auth = $this->session->userdata('auth');
						$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeFamily.processAddHROEmployeeFamily',$auth['username'],'Add New Employee Family');
						$msg = "<div class='alert alert-success'>                
									Add Data Employee Family Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						continue;
					}else {
						$msg = "<div class='alert alert-success'>                
							Add Data Employee Family Unsuccessfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('hroemployeefamily/addHROEmployeeFamily/'.$val['employee_id']);
						break;
					}
				} 
			}else {
				$msg = "<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>	                
							Add Data Employee Family UnSuccessful Because Data Family is Empty
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeefamily/addHROEmployeeFamily/'.$val['employee_id']);
			}

			$this->session->unset_userdata('addhroemployeefamily');
			$this->session->unset_userdata('addhroemployeefamily-'.$sesi['unique']);
			$this->session->unset_userdata($data['created_on']);
			redirect('hroemployeefamily');
		}
		
		function editHROEmployeeFamily(){
			$employee_id = $this->uri->segment(3);	

			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];

			$employee_family_id = $this->uri->segment(3);

			$data['main_view']['gender']					= $this->configuration->Gender;
			$data['main_view']['status']					= $this->configuration->Status;
			$data['main_view']['corefamilyrelation']		= create_double($this->hroemployeefamily_model->getCoreFamilyRelation(),'family_relation_id','family_relation_name');
			$data['main_view']['coremaritalstatus']			= create_double($this->hroemployeefamily_model->getCoreMaritalStatus(),'marital_status_id','marital_status_name');
			$data['main_view']['hroemployeedata']			= $this->hroemployeefamily_model->getHROEmployeeData($employee_id);

			$data['main_view']['hroemployeefamily']			= $this->hroemployeefamily_model->getHROEmployeeFamily_Detail($employee_family_id);
			$data['main_view']['content']					= 'hroemployeefamily/formedithroemployeefamily_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function processEditHROEmployeeFamily(){
			
			$data = array(
				'employee_family_id' 					=> $this->input->post('employee_family_id',true),	
				'family_relation_id' 					=> $this->input->post('family_relation_id',true),
				'employee_id' 							=> $this->input->post('employee_id',true),
				'marital_status_id' 					=> $this->input->post('marital_status_id',true),
				'employee_family_name' 					=> $this->input->post('employee_family_name',true),
				'employee_family_address' 				=> $this->input->post('employee_family_address',true),
				'employee_family_city' 					=> $this->input->post('employee_family_city',true),
				'employee_family_postal_code' 			=> $this->input->post('employee_family_postal_code',true),
				'employee_family_rt' 					=> $this->input->post('employee_family_rt',true),
				'employee_family_rw' 					=> $this->input->post('employee_family_rw',true),
				'employee_family_kecamatan' 			=> $this->input->post('employee_family_kecamatan',true),
				'employee_family_kelurahan' 			=> $this->input->post('employee_family_kelurahan',true),
				'employee_family_home_phone' 			=> $this->input->post('employee_family_home_phone',true),
				'employee_family_mobile_phone' 			=> $this->input->post('employee_family_mobile_phone',true),
				'employee_family_gender' 				=> $this->input->post('employee_family_gender',true),
				'employee_family_date_of_birth' 		=> tgltodb($this->input->post('employee_family_date_of_birth',true)),
				'employee_family_place_of_birth' 		=> $this->input->post('employee_family_place_of_birth',true),
				'employee_family_education' 			=> $this->input->post('employee_family_education',true),
				'employee_family_occupation' 			=> $this->input->post('employee_family_occupation',true),
				'employee_family_has_coverage_claim'	=> $this->input->post('employee_family_has_coverage_claim',true),
				'employee_family_coverage_ratio' 		=> $this->input->post('employee_family_coverage_ratio',true),
				'employee_family_remark' 				=> $this->input->post('employee_family_remark',true),
				'data_state'							=> 0,
				'created_id'							=> $created_id,
				'created_on'							=> date("Y-m-d H:i:s")
			);

			/*print_r($data);
			exit;*/
			
			$this->form_validation->set_rules('family_relation_id', 'Family Relation', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('marital_status_id', 'Marital Status', 'required');
			$this->form_validation->set_rules('employee_family_name', 'Family Name', 'required');
			$this->form_validation->set_rules('employee_family_address', 'Family Address', 'required');
			$this->form_validation->set_rules('employee_family_city', 'Family City', 'required');
			$this->form_validation->set_rules('employee_family_kecamatan', 'Family Kecamatan', 'required');
			$this->form_validation->set_rules('employee_family_kelurahan', 'Family Kelurahan', 'required');
			$this->form_validation->set_rules('employee_family_mobile_phone', 'Mobile Phone', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeefamily_model->saveEditHROEmployeeFamily($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.HROEmployeeFamily.Edit',$auth['username'],'Edit Employee Family');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_family_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Family Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeefamily/editHROEmployeeFamily/'.$data['employee_family_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Family  UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeefamily/editHROEmployeeFamily/'.$data['employee_family_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeefamily/editHROEmployeeFamily/'.$data['employee_family_id']);
			}
		}
		
				
		function deleteHROEmployeeFamily(){
			$employee_family_id = $this->uri->segment(3);	
			/*print_r("employee_family_id ".$employee_family_id);
			exit;*/
			if($this->hroemployeefamily_model->deleteHROEmployeeFamily($employee_family_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeFamily.deleteHROEmployeeFamily',$auth['username'],'Delete HROEmployeeFamily');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Family Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeefamily');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Family UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeefamily');
			}
		}
	}
?>