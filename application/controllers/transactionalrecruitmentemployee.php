<?php
	Class transactionalrecruitmentemployee extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model('transactionalrecruitmentemployee_model');
			$this->load->helper('sistem');
			$this->load->library('fungsi');
			$this->load->library('configuration');
		}
		
		public function index(){
			$this->lists();
		}
		
		public function lists(){
			$data['main_view']['transactionalrecruitmentemployee']		= $this->transactionalrecruitmentemployee_model->get_list();
			$data['main_view']['content']	= 'transactionalrecruitmentemployee/listtransactionalrecruitmentemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
		function listselection(){
			$data['main_view']['transactionalselectionemployee']		= $this->transactionalrecruitmentemployee_model->get_listselection();
			$data['main_view']['content']	= 'transactionalrecruitmentemployee/listtransactionalselectionemployee_view';
			$this->load->view('mainpage_view',$data);
		}

		function add(){
			$selection_id 				= $this->uri->segment(3);
			$data['main_view']['selectionemployee_item']	= $this->transactionalrecruitmentemployee_model->get_detailselection($selection_id);
			$data['main_view']['region']		= create_double($this->transactionalrecruitmentemployee_model->getregion(),'region_id','region_name');
			$data['main_view']['branch']		= create_double($this->transactionalrecruitmentemployee_model->getbranch(),'branch_id','branch_name');
			$data['main_view']['division']		= create_double($this->transactionalrecruitmentemployee_model->getdivision(),'division_id','division_name');
			$data['main_view']['department']	= create_double($this->transactionalrecruitmentemployee_model->getdepartment(),'department_id','department_name');
			$data['main_view']['section']		= create_double($this->transactionalrecruitmentemployee_model->getsection(),'section_id','section_name');
			$data['main_view']['location']		= create_double($this->transactionalrecruitmentemployee_model->getlocation(),'location_id','location_name');
			$data['main_view']['jobtitle']		= create_double($this->transactionalrecruitmentemployee_model->getjobtitle(),'job_title_id','job_title_name');
			$data['main_view']['grade']			= create_double($this->transactionalrecruitmentemployee_model->getgrade(),'grade_id','grade_name');
			$data['main_view']['class']			= create_double($this->transactionalrecruitmentemployee_model->getclasss(),'class_id','class_name');
			$data['main_view']['shift']			= create_double($this->transactionalrecruitmentemployee_model->getshift(),'shift_id','shift_name');
			$data['main_view']['employeestatus']	= $this->configuration->EmployeeStatus;
			$data['main_view']['selection_id']		= $this->uri->segment(3);
			$data['main_view']['content']			= 'transactionalrecruitmentemployee/formaddtransactionalrecruitmentemployee_view';
			$data['main_view']['recruitmentstatus']			= $this->configuration->RecruitmentStatus;
			$this->load->view('mainpage_view',$data);
		}
		
		public function processaddtransactionalrecruitmentemployee(){
			$data_header = array(
								'applicant_selection_id'					=> $this->input->post('applicant_selection_id',true),
								'applicant_recruitment_date'				=> $this->input->post('applicant_recruitment_date',true),
								'applicant_recruitment_due_date'	=> $this->input->post('applicant_recruitment_due_date',true),
								'applicant_recruitment_remark'			=> $this->input->post('applicant_recruitment_remark',true),
								'created_on'							=> $this->input->post('created_on',true),
								'created_by'							=> $this->input->post('created_by',true),
								);
			$this->form_validation->set_rules('applicant_selection_id', 'Selection ID', 'required');
			$this->form_validation->set_rules('applicant_recruitment_date', 'Recruitment Date', 'required');
			$this->form_validation->set_rules('applicant_recruitment_due_date', 'Due Date', 'required');
			$this->form_validation->set_rules('applicant_recruitment_remark', 'Remark', 'filterspecialchar');
			$this->form_validation->set_rules('created_on', 'Created On', 'required');
			$this->form_validation->set_rules('created_by', 'Created By', 'required');
			
			// print_r($data_header);exit;
			
			if($this->form_validation->run()==true){
				// $shit = 'yes';
				// if($shit=='yes'){
				if($this->transactionalrecruitmentemployee_model->saverecruitment($data_header)){
					$applicant_recruitment_id 	= $this->transactionalrecruitmentemployee_model->getrecruitmentid($data_header[created_on],$data_header[created_by]);
					$selection_id 				= $data_header[applicant_selection_id];
					$list_selection 				= $this->transactionalrecruitmentemployee_model->get_detailselectioninsert($selection_id);
					foreach($list_selection as $key=>$val){
						$recruitment_status = $this->input->post('recruitment_status_'.$val[applicant_id],true);
						if($recruitment_status=='0'){
							$data_update = array(
											'applicant_selection_status'		=>	'1',
							);
							$this->transactionalrecruitmentemployee_model->updateselectionitem($data_update,$val[applicant_id],$selection_id);
							continue;
						}else if($recruitment_status=='1'){
							$data_item = array(
												'applicant_recruitment_id'		=>	$applicant_recruitment_id,
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
												'applicant_recruitment_date'		=>	$this->input->post('applicant_recruitment_date_'.$val[applicant_id],true),
												'applicant_recruitment_due_date'	=>	$this->input->post('applicant_recruitment_due_date_'.$val[applicant_id],true),
												'employee_status'				=>	$this->input->post('employee_status_'.$val[applicant_id],true),
							);
							//save tabel transaction recruitment
							if($this->transactionalrecruitmentemployee_model->saverecruitmentitem($data_item)){
								//update tabel transaction selection item
								$data_update = array(
												'applicant_selection_status'		=>	'3',
								);
								$this->transactionalrecruitmentemployee_model->updateselectionitem($data_update,$val[applicant_id],$selection_id);
								//-------------------------------------------transaction begins here------------------------------------------------
								//memindahkan ke table hro employee data
								$applicant_data = $this->transactionalrecruitmentemployee_model->getapplicantdata($val[applicant_id]);
								$applicant_data_entry = array(
												'region_id'						=>	$this->input->post('region_id_'.$val[applicant_id],true),
												'branch_id'						=>	$this->input->post('branch_id_'.$val[applicant_id],true),
												'division_id'					=>	$this->input->post('division_id_'.$val[applicant_id],true),
												'department_id'					=>	$this->input->post('department_id_'.$val[applicant_id],true),
												'section_id'					=>	$this->input->post('section_id_'.$val[applicant_id],true),
												'job_title_id'					=>	$this->input->post('job_title_id_'.$val[applicant_id],true),
												'grade_id'						=>	$this->input->post('grade_id_'.$val[applicant_id],true),
												'class_id'						=>	$this->input->post('class_id_'.$val[applicant_id],true),
												'location_id'					=>	$this->input->post('location_id_'.$val[applicant_id],true),
												'shift_id'						=>	$this->input->post('shift_id_'.$val[applicant_id],true),
												'employee_name'					=>	$applicant_data[applicant_name],
												'employee_address'				=>	$applicant_data[applicant_address],
												'employee_city'					=>	$applicant_data[applicant_city],
												'employee_zip_code'				=>	$applicant_data[applicant_zip_code],
												'employee_kecamatan'			=>	$applicant_data[applicant_kelurahan],
												'employee_home_phone'			=>	$applicant_data[applicant_home_phone],
												'employee_mobile_phone'			=>	$applicant_data[applicant_mobile_phone],
												'employee_email_address'		=>	$applicant_data[applicant_email_address],
												'employee_gender'				=>	'',
												'date_of_birth'					=>	'',
												'place_of_birth'					=>	'',
												'employee_religion'					=>	$applicant_data[applicant_religion],
												'employee_id_number'					=>	$applicant_data[applicant_id_number],
												'employee_residence_address'					=>	$applicant_data[applicant_residence_address],
												'employee_residence_city'					=>	$applicant_data[applicant_residence_city],
												'employee_residence_zip_code'					=>	$applicant_data[applicant_residence_zip_code],
												'employee_residence_rt'					=>	$applicant_data[applicant_residence_rt],
												'employee_residence_rw'					=>	$applicant_data[applicant_residence_rw],
												'employee_residence_kecamatan'					=>	$applicant_data[applicant_residence_kecamatan],
												'employee_residence_kelurahan'					=>	$applicant_data[applicant_residence_kelurahan],
												'employee_bank_name'					=>	'',
												'employee_bank_acct_no'					=>	'',
												'employee_bank_acct_name'					=>	'',
												'marital_status_id'					=>	$applicant_data[marital_status_id],
												'number_of_children'					=>	'',
												'employee_heir_name'					=>	'',
												'employee_heir_occupation'					=>	'',
												'employee_blood_type'					=>	'',
												'employee_driving_licenseA'					=>	'',
												'employee_driving_licenseB'					=>	'',
												'employee_driving_licenseB1'					=>	'',
												'employee_picture'					=>	'',
												'employee_probation_date'					=>	'',
												'employee_probation_remark'					=>	'',
												'employee_effective_date'					=>	'',
												'employee_effective_remark'					=>	'',
												'employee_status'					=>	$data_item[employee_status],
												'employee_status_date'					=>	date("Y-m-d"),
												'employee_status_count'					=>	'0',
												'employee_status_due_date'					=>	'',
												'employee_working_status'					=>	'',
												'employee_overtime_status'					=>	'',
												'has_leave_permission'					=>	'',
												'annual_leave_days'					=>	'',
												'extra_leave_days'					=>	'',
												'leave_due_date'					=>	'',
												'vacation_days_balance'					=>	'',
												'employee_remark'					=>	'',
												'created_by'					=>	$data_header[created_by],
												'created_on'					=>	$data_header[created_on],
								);
								$this->transactionalrecruitmentemployee_model->saveemployeedata($applicant_data_entry);
								//get employee id
								$employee_id = $this->transactionalrecruitmentemployee_model->getemployeeid($applicant_data_entry[created_by],$applicant_data_entry[created_on]);
								//memindahkan tabel transaction education ke hro empoloyee education
								$applicant_education = $this->transactionalrecruitmentemployee_model->getapplicanteducation($val[applicant_id]);
								foreach($applicant_education as $key2=>$val2){
									$applicant_education_entry = array(
												'education_id'					=>	$val2[education_id],
												'employee_id'					=>	$employee_id,
												'education_type'					=>	$val2[education_type],
												'education_name'					=>	$val2[education_name],
												'education_city'					=>	$val2[education_city],
												'education_from_period'					=>	$val2[education_from_period],
												'education_to_period'					=>	$val2[education_to_period],
												'education_duration'					=>	$val2[education_duration],
												'education_passed'					=>	$val2[education_passed],
												'education_certificate'					=>	$val2[education_certificate],
												'education_remark'					=>	$val2[education_remark],
									);
									$this->transactionalrecruitmentemployee_model->saveemployeeeducation($applicant_education_entry);
								}
								//memindahkan tabel transaction applicant family ke tabel employee family
								$applicant_family = $this->transactionalrecruitmentemployee_model->getapplicantfamily($val[applicant_id]);
								foreach($applicant_family as $key3=>$val3){
									$applicant_family = array(
												'family_status_id'				=>	$val3[family_status_id],
												'employee_id'					=>	$employee_id,
												'employee_family_name'			=>	$val3[applicant_family_name],
												'employee_family_address'		=>	$val3[applicant_family_address],
												'employee_family_city'			=>	$val3[applicant_family_city],
												'employee_family_zip_code'		=>	$val3[applicant_family_zip_code],
												'employee_family_rt'			=>	$val3[applicant_family_rt],
												'employee_family_rw'			=>	$val3[applicant_family_rw],
												'employee_family_kecamatan'		=>	$val3[applicant_family_kecamatan],
												'employee_family_kelurahan'		=>	$val3[applicant_family_kelurahan],
												'employee_family_home_phone'		=>	$val3[applicant_family_home_phone],
												'employee_family_mobile_phone1'		=>	$val3[applicant_family_mobile_phone1],
												'employee_family_mobile_phone2'		=>	$val3[applicant_family_mobile_phone2],
												'employee_family_gender'		=>	$val3[applicant_family_gender],
												'employee_family_date_of_birth'		=>	$val3[applicant_family_date_of_birth],
												'employee_family_place_of_birth'		=>	$val3[applicant_family_place_of_birth],
												'employee_family_education'		=>	$val3[applicant_family_education],
												'employee_family_occupation'		=>	$val3[applicant_family_occupation],
												'marital_status_id'		=>	$val3[marital_status_id],
												'has_coverage_claim'		=>	'0',
												'employee_family_coverage_ratio'		=>	'0',
												'employee_family_remark'		=>	$val3[applicant_family_remark],
									);
									$this->transactionalrecruitmentemployee_model->saveemployeefamily($applicant_family_entry);
								}
								//voiding semua entry di tabel transaction applicant
								$this->transactionalrecruitmentemployee_model->voidapplicantdata($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantaccidentexperience($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicanteducation($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantfamily($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantinterviewexperience($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantlawexperience($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantmedicalrecord($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantorganizationexperience($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantpersonality($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantsubjects($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantworkingexperience($val[applicant_id]);
								$this->transactionalrecruitmentemployee_model->voidapplicantworkcolleagues($val[applicant_id]);
								continue;
							}else{
								$msg = "<div class='alert alert-danger'>                
											Add Recruitment Applicant Unsuccessful
										<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
								$this->session->set_userdata('message',$msg);
								redirect('transactionalrecruitmentemployee/add/'.$data_header[applicant_recruitment_id]);
								break;
							}
						}
					}
					//update tabel selection
					$data_update_header = array(
											'applicant_selection_status'		=>	'1',
					);
					if($this->transactionalrecruitmentemployee_model->updateselection($data_update_header,$selection_id)){
						$msg = "<div class='alert alert-success'>
									Data Added Successfully
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalrecruitmentemployee/listselection');
					}else{
						$msg = "<div class='alert alert-danger'>                
									Add Recruitment Applicant Unsuccessful
								<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
						$this->session->set_userdata('message',$msg);
						redirect('transactionalrecruitmentemployee/add/'.$data_header[applicant_recruitment_id]);
					}
				}else{
					$msg = "<div class='alert alert-danger'>                
								Add Recruitment Applicant Unsuccessful
							<button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button></div> ";
					$this->session->set_userdata('message',$msg);
					redirect('transactionalrecruitmentemployee/add/'.$data_header[applicant_recruitment_id]);
				}
			}else{
				$msg = validation_errors("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'></button>", '</div>');
				$this->session->set_userdata('message',$msg);
				redirect('transactionalrecruitmentemployee/add/'.$data_header[applicant_recruitment_id]);
			}
		}
		
		public function detail(){
			$recruitment_id 									= $this->uri->segment(3);
			$data['main_view']['detail']					= $this->transactionalrecruitmentemployee_model->get_detailrecruitment($recruitment_id);
			$data['main_view']['item']						= $this->transactionalrecruitmentemployee_model->get_detailitem($recruitment_id);
			$data['main_view']['employeestatus']		= $this->configuration->EmployeeStatus;
			$data['main_view']['content']					= 'transactionalrecruitmentemployee/detailtransactionalrecruitmentemployee_view';
			$this->load->view('mainpage_view',$data);
		}
		
	}
?>