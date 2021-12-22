<?php
	class hroemployeeperformance extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeperformance_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 					= $auth['region_id'];
			$branch_id 					= $auth['branch_id'];
			$location_id 				= $auth['location_id'];
			$payroll_employee_level 	= $auth['payroll_employee_level'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeperformance');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeperformance_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeperformance_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeperformance_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeperformance_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id, $payroll_employee_level),'employee_id','employee_name');
			$data['main_view']['hroemployeedata_asset']		= $this->hroemployeeperformance_model->getHROEmployeeData_Performance($region_id, $branch_id, $location_id, $payroll_employee_level, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']					= 'hroemployeeperformance/listhroemployeeperformance_view';
			$this->load->view('mainpage_view',$data);
		}

		public function detailHROEmployeePerformance(){
			$sesi	= 	$this->session->userdata('filter-hroemployeeperformancedetail');
			if(!is_array($sesi)){
				$sesi['start_date']		= date('d-m-Y');
				$sesi['end_date']		= date('d-m-Y');
			}
			
			$start_date = tgltodb($sesi['start_date']);
			$end_date 	= tgltodb($sesi['end_date']);

			$employee_id = $this->uri->segment(3);	

			$data['main_view']['hroemployeedata']			= $this->hroemployeeperformance_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeelate']			= $this->hroemployeeperformance_model->getHROEmployeeLate($start_date, $end_date, $employee_id);
			$data['main_view']['hroemployeepermit']			= $this->hroemployeeperformance_model->getHROEmployeePermit($start_date, $end_date, $employee_id);
			$data['main_view']['hroemployeeabsence']		= $this->hroemployeeperformance_model->getHROEmployeeAbsence($start_date, $end_date, $employee_id);
			$data['main_view']['hroemployeehomeearly']		= $this->hroemployeeperformance_model->getHROEmployeeHomeEarly($start_date, $end_date, $employee_id);
			$data['main_view']['hroemployeeworkingdayoff']	= $this->hroemployeeperformance_model->getHROEmployeeWorkingDayOff($start_date, $end_date, $employee_id);
			$data['main_view']['payrollovertimerequest']	= $this->hroemployeeperformance_model->getPayrollOvertimeRequest($start_date, $end_date, $employee_id);
			$data['main_view']['payrollleaverequest']		= $this->hroemployeeperformance_model->getPayrollLeaveRequest($start_date, $end_date, $employee_id);
			$data['main_view']['hroemployeetransfer']		= $this->hroemployeeperformance_model->getHROEmployeeTransfer($start_date, $end_date, $employee_id);
			$data['main_view']['payrollemployeemonthly']	= $this->hroemployeeperformance_model->getPayrollEmployeeMonthly($start_date, $end_date, $employee_id);

			$data['main_view']['content']					= 'hroemployeeperformance/formdetailhroemployeeperformance_view';			
			$this->load->view('mainpage_view',$data);
		}

		public function filter(){
			$data = array (
				'start_date'	=> $this->input->post('start_date',true),
				'end_date'		=> $this->input->post('end_date',true),
				'employee_id'	=> $this->input->post('employee_id',true),
			);

			$this->session->set_userdata('filter-hroemployeeperformancedetail',$data);
			redirect('hroemployeeperformance/detailHROEmployeePerformance/'.$data['employee_id']);
		}






		function receiptdate(){
			$data = array(
				'receipt_date' 		=> $this->input->post('receipt_date',true),
				'receipt_time' 		=> $this->input->post('receipt_time',true)
			);
			
			$stringgabung=$data['receipt_date'].' '.$data['receipt_time'];
			return $stringgabung;
		}
		
		function returndate(){
			$data = array(
				'return_date' 		=> $this->input->post('return_date',true),
				'return_time' 		=> $this->input->post('return_time',true)
			);
			
			$stringgabung=$data['return_date'].' '.$data['return_time'];
			//print_r($stringgabung);exit;
			return $stringgabung;
		}

		

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeperformance');
			$this->session->unset_userdata('filter-hroemployeeperformance');
			redirect('hroemployeeperformance');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeperformance-'.$sesi['unique']);	
			redirect('hroemployeeperformance');
		}
		
		

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeperformance-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeperformance-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeperformance-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeperformance-'.$unique['unique'],$sessions);
			// echo $name;
		}
		
		function processAddHroEmployeeAsset(){
		$auth = $this->session->userdata('auth');

			$data = array(
				'employee_id'					=> $this->input->post('employee_id',true),
				'asset_id'						=> $this->input->post('asset_id',true),
				'sub_asset_id'					=> $this->input->post('sub_asset_id',true),
				'employee_asset_receipt_date'	=> tgltodb($this->input->post('employee_asset_receipt_date',true)),
				'employee_asset_description'	=> $this->input->post('employee_asset_description',true),
				'employee_asset_remark'			=> $this->input->post('employee_asset_remark',true),
				'data_state'					=> 0,
				'created_id'					=> $auth['user_id'],
				'created_on'					=> date("Y-m-d H:i:s")
			);

			$this->form_validation->set_rules('asset_id', 'Asset Name', 'required');
			$this->form_validation->set_rules('sub_asset_id', 'Sub Asset Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_asset_receipt_date', 'Asset Receipt Date', 'required');
			$this->form_validation->set_rules('employee_asset_description', 'Asset Description', 'required');

			if($this->form_validation->run()==true){
				if($this->hroemployeeperformance_model->saveNewHROEmployeeAsset($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeAsset.processAddHROEmployeeAsset',$auth['username'],'Add New Employee Asset');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeAsset');
					redirect('hroemployeeperformance/AddHroEmployeeAsset/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeAsset',$data);
					redirect('hroemployeeperformance/AddHroEmployeeAsset/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddHroEmployeeAsset',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeperformance/AddHroEmployeeAsset/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['result']	= $this->hroemployeeperformance_model->getDetail($this->uri->segment(3));
			$data['main_view']['asset']		= create_double($this->hroemployeeperformance_model->getasset(),'asset_id','asset_name');
			$data['main_view']['subasset']	= create_double($this->hroemployeeperformance_model->getsubasset(),'sub_asset_id','sub_asset_name');
			
			$data['main_view']['content']	= 'hroemployeeperformance/formedithroemployeeperformance_view';
			
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeperformance(){
			$data = array(
				'employee_asset_id'				=> $this->input->post('employee_asset_id',true),
				'asset_id'						=> $this->input->post('asset_id',true),
				'sub_asset_id'					=> $this->input->post('sub_asset_id',true),
				'employee_id'					=> $this->input->post('employee_id',true),
				'employee_asset_receipt_date'	=> tgltodb($this->input->post('receipt_date',true)),
				'employee_asset_return_date'	=> tgltodb($this->input->post('return_date',true)),
				'employee_asset_remark'			=> $this->input->post('employee_asset_remark',true),
				'data_state'					=> '0'
			);
			
			$this->session->set_userdata('Edit',$data);
			$this->form_validation->set_rules('asset_id', 'Asset Name', 'required');
			$this->form_validation->set_rules('sub_asset_id', 'Sub Asset Name', 'required');
			$this->form_validation->set_rules('employee_id', 'Employee Name', 'required');
			$this->form_validation->set_rules('employee_asset_remark', 'Remark', 'filterspecialchar');
			
			if($this->form_validation->run()==true){
				if($this->hroemployeeperformance_model->saveEdithroemployeeperformance($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeperformance.Edit',$auth['username'],'Edit hroemployeeperformance');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_asset_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					// redirect('hroemployeeperformance/Edit/'.$data['employee_asset_id']);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeperformance/Edit/'.$data['employee_asset_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeperformance/Edit/'.$data['employee_asset_id']);
			}
		}

		function deleteHROEmployeeAsset(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeperformance_model->deleteHROEmployeeAsset($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeAsset.delete',$auth['username'],'Delete HROEmployeeAsset');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeperformance');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeperformance');
			}
		}

		function deleteHROEmployeeAsset_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_asset_id = $this->uri->segment(4);

			if($this->hroemployeeperformance_model->deleteHROEMployeeAsset_Data($employee_asset_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeAsset_Data.delete',$auth['username'],'Delete HROEmployeeAsset_Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeperformance/AddHROemployeeAsset/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeperformance/AddHroEmployeeAsset/'.$employee_id);
			}
		}
	}
?>