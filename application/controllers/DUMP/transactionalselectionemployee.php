<?php
	Class transactionalselectionemployee extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalselectionemployee_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->void();
		}
		
		public function confirmvoid(){
			$id = $this->input->post('applicant_selection_id',true);
			if($this->transactionalselectionemployee_model->delete($id)){
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.selectionemployee.delete',$auth['username'],'Delete Selection Employee');
				$msg = "<div class='alert alert-success'>                
							Delete Data Selection Employee Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee/void');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Selection Employee UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee/void');
			}
		}
		
		public function void(){
			$data['main_view']['transactionalselectionemployee']		= $this->transactionalselectionemployee_model->get_listvoid();
			$data['main_view']['content']	= 'transactionalselectionemployee/listvoidselectionemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function detailvoid(){
			$selection_id 				= $this->uri->segment(3);
			$data['main_view']['content']	= 'transactionalselectionemployee/detailvoidselectionemployee_view';
			$data['main_view']['detail']	= $this->transactionalselectionemployee_model->get_detailselection($selection_id);
			$data['main_view']['item']		= $this->transactionalselectionemployee_model->get_detailitem($selection_id);
			$data['main_view']['selectionstatus']		= $this->configuration->SelectionStatus2;
			$this->load->view('mainpage_view',$data);
		}
		
		public function listdata(){
			$data['main_view']['transactionalselectionemployee']		= $this->transactionalselectionemployee_model->get_list();
			$data['main_view']['content']	= 'transactionalselectionemployee/listtransactionalselectionemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		public function detail(){
			$request_id 				= $this->uri->segment(3);
			$data['main_view']['content']	= 'transactionalselectionemployee/detailtransactionalselectionemployee_view';
			$data['main_view']['detail']	= $this->transactionalselectionemployee_model->get_detail($request_id);
			$data['main_view']['region']	= create_double($this->transactionalselectionemployee_model->getregion(),'region_id','region_name');
			$data['main_view']['branch']	= create_double($this->transactionalselectionemployee_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['division']	= create_double($this->transactionalselectionemployee_model->getdivision(),'division_id','division_name');
			$data['main_view']['department']	= create_double($this->transactionalselectionemployee_model->getdepartment(),'department_id','department_name');
			$data['main_view']['section']	= create_double($this->transactionalselectionemployee_model->getsection(),'section_id','section_name');
			$data['main_view']['location']	= create_double($this->transactionalselectionemployee_model->getlocation(),'location_id','location_name');
			$data['main_view']['item']		= create_double($this->transactionalselectionemployee_model->get_detailitem($request_id),'applicant_id','applicant_name');
			$data['main_view']['request']		= $this->configuration->RequestStatus;
			// $data['main_view']['selectionstatus']		= $this->configuration->SelectionStatus;
			$this->load->view('mainpage_view',$data);
		}
		
		public function resetselectionemployee(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addselectionemployee-'.$sesi['unique']);
			$wax = $this->uri->segment(3);
			// print_r($wax);exit;
			$this->session->unset_userdata("dataitemaddselectionemployee-".$header['created_by']);
			$this->session->unset_userdata('addselectionemployee-'.$sesi['unique']);
			redirect('transactionalselectionemployee/detail/'.$wax);
		}

		public function resetall(){
			$sesi 		= $this->session->userdata('unique');
			$header = $this->session->userdata('addselectionemployee-'.$sesi['unique']);
			// $wax = $header[appplicant_];
			// $wax = $this->uri->segment(3);
			// print_r($wax);exit;
			$this->session->unset_userdata("dataitemaddselectionemployee-".$header['created_by']);
			$this->session->unset_userdata('addselectionemployee-'.$sesi['unique']);
			redirect('transactionalselectionemployee');
		}
		
		public function deletearrayselectionemployeeitem(){
			$arrayBaru			= array();
			$keyZ 				= $this->uri->segment(3);
			$sesi 				= $this->session->userdata('unique');
			$header				= $this->session->userdata('addselectionemployee-'.$sesi['unique']);
			$selectionemployee	= $this->session->userdata("dataitemaddselectionemployee-".$header[created_by]);
			// print_r($selectionemployee); exit;
			foreach($selectionemployee as $key=>$val){
				if($key!=$keyZ){
					$arrayBaru[$key] = $val;
				}
			}
				
			$a = count($arrayBaru);
			if ($a==0){ 
				$sesi = $this->session->userdata('unique');
				$data3 = $this->session->userdata('addselectionemployee-'.$sesi['unique']);
				$this->session->unset_userdata('addselectionemployee-'.$sesi['unique']);
			}
			$this->session->set_userdata('dataitemaddselectionemployee-'.$header[created_by],$arrayBaru);
			redirect('transactionalselectionemployee/detail/'.$header[applicant_request_id]);
		}
		
		function arrayaddselectionemployee(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			$auth	= $this->session->userdata('auth');
			
			$data_header = array(
								'applicant_request_id'			=> $this->input->post('applicant_request_id',true),
								'region_id'						=> $this->input->post('region_id',true),
								'branch_id'						=> $this->input->post('branch_id',true),
								'division_id'					=> $this->input->post('division_id',true),
								'department_id'					=> $this->input->post('department_id',true),
								'section_id'					=> $this->input->post('section_id',true),
								'location_id'					=> $this->input->post('location_id',true),
								'applicant_selection_date'		=> $this->input->post('applicant_selection_date',true),
								'applicant_selection_interview_date'	=> $this->input->post('applicant_selection_interview_date',true),
								'applicant_selection_remark'	=> $this->input->post('applicant_selection_remark',true),
								'created_on'					=> $this->input->post('created_on',true),
								'created_by'					=> $this->input->post('created_by',true),
			);
			$this->form_validation->set_rules('applicant_request_id', 'Applicant Request', 'required');
			$this->form_validation->set_rules('region_id', 'Region', 'required');
			$this->form_validation->set_rules('branch_id', 'Branch', 'required');
			$this->form_validation->set_rules('division_id', 'Division', 'required');
			$this->form_validation->set_rules('department_id', 'Department', 'required');
			$this->form_validation->set_rules('section_id', 'Section', 'required');
			$this->form_validation->set_rules('location_id', 'Location', 'required');
			$this->form_validation->set_rules('applicant_selection_date', 'Selection', 'required');
			$this->form_validation->set_rules('applicant_selection_interview_date', 'Interview Date', 'required');
			$this->form_validation->set_rules('applicant_selection_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			$this->form_validation->set_rules('created_by', 'Created By', 'required');
			
			$data_item = array(
				'applicant_id'		=> $this->input->post('applicant_id',true),
				'applicant_request_status'	=> $this->input->post('applicant_request_status',true),
				'created_by'		=> $this->input->post('created_by',true),
				'created_on'		=> $this->input->post('created_on',true),
			);
			
			$this->form_validation->set_rules('applicant_id', 'Applicant Name', 'required');
			$this->form_validation->set_rules('applicant_request_status', 'Request Status', 'required');
			// print_r($data_item);exit;
			
			if($this->form_validation->run()==true){
				$header = $this->session->userdata('addselectionemployee-'.$sesi['unique']);
				$this->session->set_userdata('addselectionemployee-'.$sesi['unique'],$data_header);
				if(!is_array($header)){
					$this->session->set_userdata('addselectionemployee-'.$sesi['unique'],$data_header);
				}
				$dataArray 	= $this->session->userdata("dataitemaddselectionemployee-".$data_header['created_by']);
				
				// $dataArray[$data_item['education_id'].$data_item['education_type']] = $data_item;
				$dataArray[$data_item['applicant_id']] = $data_item;
				$this->session->set_userdata("dataitemaddselectionemployee-".$data_header['created_by'],$dataArray);
				// $this->session->unset_userdata('addselectionemployee');
				$this->session->set_userdata('addselectionemployee',$data_header);				
				$msg = "<div class='alert alert-success'>                
							Data Added Successfully
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee/detail/'.$data_header[applicant_request_id]);
			}else{
				$this->session->set_userdata('addselectionemployee',$data_item);
				$this->session->set_userdata('addselectionemployee-'.$sesi['unique'],$data_header);
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee/detail/'.$data_header[applicant_request_id]);
			}
		}
		
		public function processaddtransactionalselectionemployee(){
			$sesi 	= $this->session->userdata('unique');
			if($sesi['unique']==''){
				$this->session->set_userdata('unique',array('unique'=>get_unique()));
			}
			
			$headerselectionemployee = $this->session->userdata('addselectionemployee-'.$sesi['unique']);
			$arrayeselectionemployee = $this->session->userdata("dataitemaddselectionemployee-".$headerselectionemployee['created_by']);
			
			// print_r($headerselectionemployee);exit;
			// print_r($arrayeselectionemployee);exit;
			
			if($this->transactionalselectionemployee_model->saveselectionemployee($headerselectionemployee)){
				$selection_id = $this->transactionalselectionemployee_model->getselectionid($headerselectionemployee[created_on],$headerselectionemployee[created_by]);
				foreach($arrayeselectionemployee as $key=>$val){
					$data_item = array(
										'applicant_selection_id'			=> $selection_id,
										'applicant_id'					=> $val[applicant_id],
										'applicant_selection_status' 		=> '0',
					);
					$data_update = array(
										'applicant_request_id'			=> $headerselectionemployee[applicant_request_id],
										'applicant_id'					=> $val[applicant_id],
										'applicant_request_status' 		=> $val[applicant_request_status],
					);
					if($this->transactionalselectionemployee_model->saveselectionemployeeitem($data_item)){
						if($this->transactionalselectionemployee_model->updaterequest($data_update) && $this->transactionalselectionemployee_model->updaterequest2($data_update[applicant_request_id])){
							$msg = "<div class='alert alert-success'>                
										Save Data Applicant Successful
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							continue;
						}else{
						$msg = "<div class='alert alert-danger'>                
									Save Data Request Applicant Unsuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalselectionemployee');
						}
					}else{
						$msg = "<div class='alert alert-danger'>                
									Save Data Request Applicant Unsuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalselectionemployee');
					}
				}
				$auth = $this->session->userdata('auth');
				$this->fungsi->set_log($auth['username'],'1005','Application.selectionemployee.add',$auth['username'],'Add Request Employee');
				$msg = "<div class='alert alert-success'>
							Save Data Applicant Successful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				// $this->reset_search();
				$this->resetall();
				redirect('transactionalselectionemployee');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Save Data Request Applicant Unsuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee');
			}
		}
		
	}
?>