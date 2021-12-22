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
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalselectionemployee']		= $this->transactionalselectionemployee_model->get_list();
			$data['main_view']['content']	= 'transactionalselectionemployee/listtransactionalselectionemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function listrequest(){
			$data['main_view']['transactionalrequestemployee']		= $this->transactionalselectionemployee_model->get_listrequest();
			$data['main_view']['content']	= 'transactionalselectionemployee/listtransactionalrequestemployee_view';
			$this->load->view('mainpage_view',$data);
		}

		function add(){
			$request_id 				= $this->uri->segment(3);
			$data['main_view']['requestemployee_item']	= $this->transactionalselectionemployee_model->get_detailrequest($request_id);
			$data['main_view']['region']		= create_double($this->transactionalselectionemployee_model->getregion(),'region_id','region_name');
			$data['main_view']['branch']		= create_double($this->transactionalselectionemployee_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['division']		= create_double($this->transactionalselectionemployee_model->getdivision(),'division_id','division_name');
			$data['main_view']['department']	= create_double($this->transactionalselectionemployee_model->getdepartment(),'department_id','department_name');
			$data['main_view']['section']		= create_double($this->transactionalselectionemployee_model->getsection(),'section_id','section_name');
			$data['main_view']['location']		= create_double($this->transactionalselectionemployee_model->getlocation(),'location_id','location_name');
			$data['main_view']['jobtitle']		= create_double($this->transactionalselectionemployee_model->getjobtitle(),'job_title_id','job_title_name');
			$data['main_view']['grade']			= create_double($this->transactionalselectionemployee_model->getgrade(),'grade_id','grade_name');
			$data['main_view']['class']			= create_double($this->transactionalselectionemployee_model->getclasss(),'class_id','class_name');
			$data['main_view']['request']		= $this->configuration->RequestStatus2;
			$data['main_view']['request_id']		= $this->uri->segment(3);
			$data['main_view']['content']	= 'transactionalselectionemployee/formaddtransactionalselectionemployee_view';
			// $data['main_view']['selectionstatus']		= $this->configuration->SelectionStatus;
			$this->load->view('mainpage_view',$data);
		}
		
		public function processaddtransactionalselectionemployee(){
			$data_header = array(
								'applicant_request_id'					=> $this->input->post('applicant_request_id',true),
								'applicant_selection_date'				=> $this->input->post('applicant_selection_date',true),
								'applicant_selection_interview_date'	=> $this->input->post('applicant_selection_interview_date',true),
								'applicant_selection_remark'			=> $this->input->post('applicant_selection_remark',true),
								'created_on'							=> $this->input->post('created_on',true),
								'created_by'							=> $this->input->post('created_by',true),
								);
			$this->form_validation->set_rules('applicant_request_id', 'Request ID', 'required');
			$this->form_validation->set_rules('applicant_selection_date', 'Selection Date', 'required');
			$this->form_validation->set_rules('applicant_selection_interview_date', 'Interview Date', 'required');
			$this->form_validation->set_rules('applicant_selection_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			$this->form_validation->set_rules('created_by', 'Created By', 'required');
			
			// print_r($data_header);exit;
			
			if($this->form_validation->run()==true){
				if($this->transactionalselectionemployee_model->saveselection($data_header)){
					$applicant_selection_id 	= $this->transactionalselectionemployee_model->getselectionid($data_header[created_on],$data_header[created_by]);
					$request_id 				= $data_header[applicant_request_id];
					$list_request 				= $this->transactionalselectionemployee_model->get_detailrequest($request_id);
					foreach($list_request as $key=>$val){
						$data_item = array(
											'applicant_selection_id'		=>	$applicant_selection_id,
											'applicant_id'					=>	$this->input->post('applicant_id_'.$val[applicant_id],true),
											'region_id'						=>	$this->input->post('region_id_'.$val[applicant_id],true),
											'branch_id'						=>	$this->input->post('branch_id_'.$val[applicant_id],true),
											'division_id'					=>	$this->input->post('division_id_'.$val[applicant_id],true),
											'department_id'					=>	$this->input->post('department_id_'.$val[applicant_id],true),
											'section_id'					=>	$this->input->post('section_id_'.$val[applicant_id],true),
											'location_id'					=>	$this->input->post('location_id_'.$val[applicant_id],true),
											'job_title_id'					=>	$this->input->post('job_title_id_'.$val[applicant_id],true),
											'grade_id'						=>	$this->input->post('grade_id_'.$val[applicant_id],true),
											'class_id'						=>	$this->input->post('class_id_'.$val[applicant_id],true),
											'applicant_selection_status'	=>	'0',
						);
						if($this->transactionalselectionemployee_model->saveselectionitem($data_item)){
							$data_update = array(
											'applicant_request_status'		=>	$this->input->post('applicant_request_status_'.$val[applicant_id],true),
							);
							$this->transactionalselectionemployee_model->updaterequestitem($data_update,$val[applicant_id],$request_id);
							continue;
						}else{
							$msg = "<div class='alert alert-danger'>                
										Add Selection Applicant Unsuccessful
									<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
							$this->session->set_userdata('message',$msg);
							redirect('transactionalselectionemployee/add/'.$data_header[applicant_request_id]);
							break;
						}
					}
					$data_update_header = array(
											'applicant_request_status'		=>	'1',
					);
					if($this->transactionalselectionemployee_model->updaterequest($data_update_header,$request_id)){
						$msg = "<div class='alert alert-success'>
									Data Added Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalselectionemployee/listrequest');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Selection Applicant Unsuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalselectionemployee/add/'.$data_header[applicant_request_id]);
					}
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Selection Applicant Unsuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalselectionemployee/add/'.$data_header[applicant_request_id]);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee/add/'.$data_header[applicant_request_id]);
			}
		}
		
		public function detail(){
			$selection_id 									= $this->uri->segment(3);
			$data['main_view']['detail']					= $this->transactionalselectionemployee_model->get_detailselection($selection_id);
			$data['main_view']['item']						= $this->transactionalselectionemployee_model->get_detailitem($selection_id);
			$data['main_view']['selectionstatus']			= $this->configuration->SelectionStatus;
			$data['main_view']['headerselectionstatus']		= $this->configuration->HeaderSelectionStatus;
			$data['main_view']['content']					= 'transactionalselectionemployee/detailtransactionalselectionemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function delete(){
			$applicant_selection_id = $this->input->post('applicant_selection_id',true);
			$applicant_request_id = $this->input->post('applicant_request_id',true);
			$list_selection = $this->transactionalselectionemployee_model->get_detailitemdelete($applicant_selection_id);
			if($this->transactionalselectionemployee_model->delete($applicant_selection_id)){
				if($this->transactionalselectionemployee_model->revertrequest($applicant_request_id)){
					foreach($list_selection as $key=>$val){
						$this->transactionalselectionemployee_model->revertrequestitem($applicant_request_id, $val[applicant_id]);
					}
					$auth = $this->session->userdata('auth');
					$this->fungsi->set_log($auth['username'],'1005','Application.selectionemployee.delete',$auth['username'],'Delete Request Employee');
					$msg = "<div class='alert alert-success'>                
								Delete Data Request Employee Successfully
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalselectionemployee');
				}
				$msg = "<div class='alert alert-danger'>                
							Delete Data Request Employee UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee');
			}else{
				$msg = "<div class='alert alert-danger'>                
							Delete Data Request Employee UnSuccessful
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
				$this->session->set_userdata('message',$msg);
				redirect('transactionalselectionemployee');
			}
		}
	}
?>