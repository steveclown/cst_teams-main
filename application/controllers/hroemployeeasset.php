<?php
	class hroemployeeasset extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('hroemployeeasset_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$auth = $this->session->userdata('auth');
			$region_id 		= $auth['region_id'];
			$branch_id 		= $auth['branch_id'];
			$location_id 	= $auth['location_id'];


			$sesi	= 	$this->session->userdata('filter-hroemployeeasset');
			if(!is_array($sesi)){
				$sesi['division_id']		= '';
				$sesi['department_id']		= '';
				$sesi['section_id']			= '';
				$sesi['employee_id']		= '';	
			}

			$data['main_view']['coredivision']				= create_double($this->hroemployeeasset_model->getCoreDivision(),'division_id','division_name');
			$data['main_view']['coredepartment']			= create_double($this->hroemployeeasset_model->getCoreDepartment(),'department_id','department_name');
			$data['main_view']['coresection']				= create_double($this->hroemployeeasset_model->getCoreSection(),'section_id','section_name');
			$data['main_view']['hroemployeedata']			= create_double($this->hroemployeeasset_model->getHROEmployeeData_Filter($region_id, $branch_id, $location_id),'employee_id','employee_name');
			$data['main_view']['hroemployeedata_asset']		= $this->hroemployeeasset_model->getHROEmployeeData_Asset($region_id, $branch_id, $location_id, $sesi['employee_id'], $sesi['division_id'], $sesi['department_id'] , $sesi['section_id']);

			$data['main_view']['content']	= 'hroemployeeasset/listhroemployeeasset_view';
			$this->load->view('mainpage_view',$data);
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

		public function filter(){
			$data = array (
				'employee_id'		=> $this->input->post('employee_id',true),	
				'division_id'		=> $this->input->post('division_id',true),
				'department_id'		=> $this->input->post('department_id',true),
				'section_id'		=> $this->input->post('section_id',true),
			);
			$this->session->set_userdata('filter-hroemployeeasset',$data);
			redirect('hroemployeeasset');
		}

		public function reset_search(){
			$sesi= $this->session->userdata('filter-hroemployeeasset');
			$this->session->unset_userdata('filter-hroemployeeasset');
			redirect('hroemployeeasset');
		}

		public function reset_session(){
			$sesi 	= $this->session->userdata('unique');
			$this->session->unset_userdata('addhroemployeeasset-'.$sesi['unique']);	
			redirect('hroemployeeasset');
		}
		
		function AddHroEmployeeAsset(){
			$employee_id = $this->uri->segment(3);	

			$data['main_view']['asset']					= create_double($this->hroemployeeasset_model->getCoreAsset(),'asset_id','asset_name');
			$data['main_view']['subasset']				= create_double($this->hroemployeeasset_model->getCoreSubAsset(),'sub_asset_id','sub_asset_name');
			$data['main_view']['hroemployeedata']		= $this->hroemployeeasset_model->getHROEmployeeData($employee_id);
			$data['main_view']['hroemployeeasset_data']	= $this->hroemployeeasset_model->getHROEmployeeAsset_Data($employee_id);
			
			$data['main_view']['content']				= 'hroemployeeasset/listaddhroemployeeasset_view';			
			$this->load->view('mainpage_view',$data);
		}

		public function function_state_add(){
			$unique 	= $this->session->userdata('unique');
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeasset-'.$unique['unique']);
			$sessions['active_tab'] = $value;
			$this->session->set_userdata('addhroemployeeasset-'.$unique['unique'],$sessions);
		}
		
		public function function_elements_add(){
			$unique 	= $this->session->userdata('unique');
			$name 		= $this->input->post('name',true);
			$value 		= $this->input->post('value',true);
			$sessions	= $this->session->userdata('addhroemployeeasset-'.$unique['unique']);
			$sessions[$name] = $value;
			$this->session->set_userdata('addhroemployeeasset-'.$unique['unique'],$sessions);
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
				if($this->hroemployeeasset_model->saveNewHROEmployeeAsset($data)){
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1003','Application.HROEmployeeAsset.processAddHROEmployeeAsset',$auth['username'],'Add New Employee Asset');
					$msg = "<div class='alert alert-success'>                
								Add Data Employee Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->unset_userdata('AddHroEmployeeAsset');
					redirect('hroemployeeasset/AddHroEmployeeAsset/'.$data['employee_id']);
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Data Employee Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					$this->session->set_userdata('AddHroEmployeeAsset',$data);
					redirect('hroemployeeasset/AddHroEmployeeAsset/'.$data['employee_id']);
				}
			}else{
				$data['password']='';
				$this->session->set_userdata('AddHroEmployeeAsset',$data);
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeasset/AddHroEmployeeAsset/'.$data['employee_id']);
			}
		}
		
		function Edit(){
			$employee_id =  $this->session->userdata('employee_id');
			if ($employee_id ==""){
				$msg = "<div class='alert alert-danger'>Please Select Employee First !!!<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div>";
				$this->session->set_userdata('message',$msg);
				redirect('main');
			}
			$data['main_view']['result']	= $this->hroemployeeasset_model->getDetail($this->uri->segment(3));
			$data['main_view']['asset']		= create_double($this->hroemployeeasset_model->getasset(),'asset_id','asset_name');
			$data['main_view']['subasset']	= create_double($this->hroemployeeasset_model->getsubasset(),'sub_asset_id','sub_asset_name');
			
			$data['main_view']['content']	= 'hroemployeeasset/formedithroemployeeasset_view';
			
			$this->load->view('mainpage_view',$data);
		}
		
		function processEdithroemployeeasset(){
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
				if($this->hroemployeeasset_model->saveEdithroemployeeasset($data)==true){
					$auth 	= $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1077','Application.hroemployeeasset.Edit',$auth['username'],'Edit hroemployeeasset');
					$this->fungsi->set_change_log($old_data,$data,$auth['username'],$data['employee_asset_id']);
					$msg = "<div class='alert alert-success'>                
								Edit Employee Asset Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					// redirect('hroemployeeasset/Edit/'.$data['employee_asset_id']);
					redirect('main');
				}else{
					$msg = "<div class='alert alert-danger'>                
								Edit Employee Asset UnSuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('hroemployeeasset/Edit/'.$data['employee_asset_id']);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeasset/Edit/'.$data['employee_asset_id']);
			}
		}

		function deleteHROEmployeeAsset(){
			$employee_id = $this->uri->segment(3);

			if($this->hroemployeeasset_model->deleteHROEmployeeAsset($employee_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeAsset.delete',$auth['username'],'Delete HROEmployeeAsset');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeasset');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeasset');
			}
		}

		function deleteHROEmployeeAsset_Data(){
			$employee_id = $this->uri->segment(3);
			$employee_asset_id = $this->uri->segment(4);

			if($this->hroemployeeasset_model->deleteHROEMployeeAsset_Data($employee_asset_id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.HROEmployeeAsset_Data.delete',$auth['username'],'Delete HROEmployeeAsset_Data');
				$msg = "<div class='alert alert-success'>                
							Delete Data Employee Asset Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeasset/AddHROemployeeAsset/'.$employee_id);
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Employee Asset UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('hroemployeeasset/AddHroEmployeeAsset/'.$employee_id);
			}
		}
	}
?>