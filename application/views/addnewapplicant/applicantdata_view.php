<?php
$residencestatus = array(0 => "Private", 1 => "Family", 2  => "Rent", 3  => "Boarding");
$religion = array(0 => "Moslem", 1 => "Christian", 2  => "Catholic", 3  => "Hindhu", 4  => "Buddha");
$winnerstatus = array(0 => "No", 1 => "Yes");
$gradefail = array(0 => "No", 1 => "Yes");
$furtherstudy = array(0 => "No", 1 => "Yes");
$hasteammember = array(0 => "No", 1 => "Yes");
$outoftown = array(0 => "No", 1 => "Yes");
$immediatelywork = array(0 => "No", 1 => "Yes");
$overtimeready = array(0 => "No", 1 => "Yes");
$sickopname = array(0 => "No", 1 => "Yes");
$colourblind = array(0 => "No", 1 => "Yes");
$readynomarried = array(0 => "No", 1 => "Yes");
?>
<script>
function ulang(){
	document.getElementById("applicant_name").value = "";
	document.getElementById("applicant_application_date").value = "";
	document.getElementById("applicant_address").value = "";
	document.getElementById("applicant_city").value = "";
	document.getElementById("applicant_zip_code").value = "";
	document.getElementById("applicant_rt").value = "";
	document.getElementById("applicant_rw").value = "";
	document.getElementById("applicant_kecamatan").value = "";
	document.getElementById("applicant_kelurahan").value = "";
	document.getElementById("applicant_home_phone").value = "";
	document.getElementById("applicant_mobile_phone").value = "";
	document.getElementById("applicant_email_address").value = "";
	document.getElementById("applicant_residence_address").value = "";
	document.getElementById("applicant_residence_city").value = "";
	document.getElementById("applicant_residence_zip_code").value = "";
	document.getElementById("applicant_residence_rt").value = "";
	document.getElementById("applicant_residence_rw").value = "";
	document.getElementById("applicant_residence_kecamatan").value = "";
	document.getElementById("applicant_residence_kelurahan").value = "";
	document.getElementById("applicant_residence_status").value = "";
	document.getElementById("applicant_religion").value = "";
	document.getElementById("applicant_nationality").value = "";
	document.getElementById("marital_status_id").value = "";
	document.getElementById("applicant_id_number").value = "";
	document.getElementById("applicant_education_cost").value = "";
	document.getElementById("applicant_winner_status").value = "";
	document.getElementById("applicant_winner_remark").value = "";
	document.getElementById("applicant_grade_fail").value = "";
	document.getElementById("applicant_grade_fail_remark").value = "";
	document.getElementById("applicant_grade_fail_reason").value = "";
	document.getElementById("applicant_further_study").value = "";
	document.getElementById("applicant_further_study_field").value = "";
	document.getElementById("applicant_further_study_period").value = "";
	document.getElementById("applicant_has_team_member").value = "";
	document.getElementById("applicant_team_member").value = "";
	document.getElementById("applicant_how_manage_team_member").value = "";
	document.getElementById("applicant_head_expectation").value = "";
	document.getElementById("applicant_new_ideas").value = "";
	document.getElementById("applicant_achievement").value = "";
	document.getElementById("applicant_achievement_satisfaction").value = "";
	document.getElementById("applicant_application_position").value = "";
	document.getElementById("applicant_expected_salary").value = "";
	document.getElementById("applicant_out_of_town").value = "";
	document.getElementById("applicant_out_of_town_remark").value = "";
	document.getElementById("applicant_immediately_work").value = "";
	document.getElementById("applicant_immediately_work_remark").value = "";
	document.getElementById("applicant_overtime_ready").value = "";
	document.getElementById("applicant_overtime_ready_remark").value = "";
	document.getElementById("applicant_business_trip").value = "";
	document.getElementById("applicant_business_trip_remark").value = "";
	document.getElementById("applicant_work_environment").value = "";
	document.getElementById("applicant_work_environment_other").value = "";
	document.getElementById("applicant_most_like_work").value = "";
	document.getElementById("applicant_most_dislike_work").value = "";
	document.getElementById("applicant_hobby").value = "";
	document.getElementById("applicant_hobby_active").value = "";
	document.getElementById("applicant_interest_other_work").value = "";
	document.getElementById("applicant_good_book").value = "";
	document.getElementById("applicant_dream_of_life").value = "";
	document.getElementById("applicant_dream_achieve").value = "";
	document.getElementById("applicant_weight").value = "";
	document.getElementById("applicant_height").value = "";
	document.getElementById("applicant_sick_opname").value = "";
	document.getElementById("applicant_sick_disease").value = "";
	document.getElementById("applicant_sick_duration").value = "";
	document.getElementById("applicant_sick_year").value = "";
	document.getElementById("applicant_sick_hospital").value = "";
	document.getElementById("applicant_colour_blind").value = "";
	document.getElementById("applicant_work_friend_name1").value = "";
	document.getElementById("applicant_work_friend_section1").value = "";
	document.getElementById("applicant_work_friend_relationship1").value = "";
	document.getElementById("applicant_work_friend_name2").value = "";
	document.getElementById("applicant_work_friend_section2").value = "";
	document.getElementById("applicant_work_friend_relationship2").value = "";
	document.getElementById("applicant_emergency_name").value = "";
	document.getElementById("applicant_emergency_address").value = "";
	document.getElementById("applicant_emergency_mobile_phone").value = "";
	document.getElementById("applicant_emergency_home_phone").value = "";
	document.getElementById("applicant_emergency_relationship").value = "";
	document.getElementById("applicant_daily_transportation_name1").value = "";
	document.getElementById("applicant_daily_transportation_year1").value = "";
	document.getElementById("applicant_daily_transportation_owned1").value = "";
	document.getElementById("applicant_daily_transportation_name2").value = "";
	document.getElementById("applicant_daily_transportation_year2").value = "";
	document.getElementById("applicant_daily_transportation_owned2").value = "";
	document.getElementById("applicant_ready_no_married").value = "";
}
</script>
<?php 
	echo form_open('addnewapplicant/processaddapplicantdata',array('id' => 'myform', 'class' => 'horizontal-form')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$auth = $this->session->userdata('auth');
	$sesi 	= $this->session->userdata('unique');
	if($sesi['unique']==''){
		$this->session->set_userdata('unique',array('unique'=>get_unique()));
	}
	$data = $this->session->userdata('addnewapplicant-'.$sesi['unique']);
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Add New Applicant Wizard > Personal Data
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="#" class='btn default btn-xs yellow'>
							Personal
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicanteducation">
							Education
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantfamily">
							Family
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantaccidentexperience">
							Accident
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantworkingexperience">
							Working
						</a>
						<i class="fa fa-angle-right"></i>
					</li>					
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantinterviewexperience">
							Interview
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantlawexperience">
							Law
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantorganizationexperience">
							Organization
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantmedicalrecord">
							Medical Record
						</a>
						<i class="fa fa-angle-right"></i>
					</li>					
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantpersonality">
							Personality
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantsubjects">
							Subjects
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/applicantworkcolleagues">
							Colleagues
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>addnewapplicant/confirm">
							Confirm
						</a>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Personal Data
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Applicant Name</label>
											
												<input type="text" name="applicant_name" id="applicant_name" value="<?php echo $data['applicant_name'];?>" class="form-control" placeholder="Applicant Name">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Application Date</label>
											
												<div class="input-group input-medium date date-picker" data-date="<?php echo date("Y-m-d");?>" data-date-format="yyyy-mm-dd" data-date-viewmode="years">
													<input type="text" name="applicant_application_date" id="applicant_application_date" class="form-control" value="<?php echo $data['applicant_application_date']?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
												<span class="help-block">
													 Select date
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Address</label>
												
												<textarea rows="3" name="applicant_address" id="applicant_address" class="form-control" placeholder="address"><?php echo $data['applicant_address'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">City</label>
											
												<input type="text" name="applicant_city" id="applicant_city" value="<?php echo $data['applicant_city'];?>" class="form-control" placeholder="City">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Zip Code</label>
											
												<input type="text" name="applicant_zip_code" id="applicant_zip_code" value="<?php echo $data['applicant_zip_code'];?>" class="form-control" placeholder="Zip Code">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">RT</label>
												
												<input type="text" name="applicant_rt" id="applicant_rt" value="<?php echo $data['applicant_rt'];?>" class="form-control" placeholder="RT">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">RW</label>
											
												<input type="text" name="applicant_rw" id="applicant_rw" value="<?php echo $data['applicant_rw'];?>" class="form-control" placeholder="RW">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Kelurahan</label>
												
												<input type="text" name="applicant_kelurahan" id="applicant_kelurahan" value="<?php echo $data['applicant_kelurahan'];?>" class="form-control" placeholder="Kelurahan">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Kecamatan</label>
											
												<input type="text" name="applicant_kecamatan" id="applicant_kecamatan" value="<?php echo $data['applicant_kecamatan'];?>" class="form-control" placeholder="Kecamatan">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Home Phone</label>
											
												<input type="text" name="applicant_home_phone" id="applicant_home_phone" value="<?php echo $data['applicant_home_phone'];?>" class="form-control" placeholder="Home Phone">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Mobile Phone</label>
											
												<input type="text" name="applicant_mobile_phone" id="applicant_mobile_phone" value="<?php echo $data['applicant_mobile_phone'];?>" class="form-control" placeholder="Mobile Phone">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Email Address</label>
											
												<input type="text" name="applicant_email_address" id="applicant_email_address" value="<?php echo $data['applicant_email_address'];?>" class="form-control" placeholder="Email Address">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Residence Address</label>
												
												<textarea rows="3" name="applicant_residence_address" id="applicant_residence_address" class="form-control" placeholder="Residence Address"><?php echo $data['applicant_residence_address'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence City</label>
											
												<input type="text" name="applicant_residence_city" id="applicant_residence_city" value="<?php echo $data['applicant_residence_city'];?>" class="form-control" placeholder="Residence City">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence Zip Code</label>
											
												<input type="text" name="applicant_residence_zip_code" id="applicant_residence_zip_code" value="<?php echo $data['applicant_residence_zip_code'];?>" class="form-control" placeholder="Residence Zip Code">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence RT</label>
											
												<input type="text" name="applicant_residence_rt" id="applicant_residence_rt" value="<?php echo $data['applicant_residence_rt'];?>" class="form-control" placeholder="Residence RT">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence RW</label>
											
												<input type="text" name="applicant_residence_rw" id="applicant_residence_rw" value="<?php echo $data['applicant_residence_rw'];?>" class="form-control" placeholder="Residence RW">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence Kelurahan</label>
											
												<input type="text" name="applicant_residence_kelurahan" id="applicant_residence_kelurahan" value="<?php echo $data['applicant_residence_kelurahan'];?>" class="form-control" placeholder="Residence Kelurahan">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence Kecamatan</label>
											
												<input type="text" name="applicant_residence_kecamatan" id="applicant_residence_kecamatan" value="<?php echo $data['applicant_residence_kecamatan'];?>" class="form-control" placeholder="Residence Kecamatan">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Residence Status</label>
											
												<?php echo form_dropdown('applicant_residence_status', $residencestatus ,set_value('applicant_residence_status',$data['applicant_residence_status']),'id="applicant_residence_status", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Religion</label>
											
												<?php echo form_dropdown('applicant_religion', $religion ,set_value('applicant_religion',$data['applicant_religion']),'id="applicant_religion", class="form-control select2me"');?>
											</div>
										</div>
											
										<div class="col-md-6">	
											<div class="form-group">
												<label class="control-label">Nationality</label>
											
												<input type="text" name="applicant_nationality" id="applicant_nationality" value="<?php echo $data['applicant_nationality'];?>" class="form-control" placeholder="Nationality">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Marital Status</label>
												
												<?php echo form_dropdown('marital_status_id', $maritalstatus, $data['marital_status_id'], 'id ="marital_status_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">ID Number</label>
											
												<input type="text" name="applicant_id_number" id="applicant_id_number" value="<?php echo $data['applicant_id_number'];?>" class="form-control" placeholder="ID Number">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Education Cost</label>
												
												<input type="text" name="applicant_education_cost" id="applicant_education_cost" value="<?php echo $data['applicant_education_cost'];?>" class="form-control" placeholder="Education Cost">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Winner Status</label>
											
												<?php echo form_dropdown('applicant_winner_status', $winnerstatus ,set_value('applicant_winner_status',$data['applicant_winner_status']),'id="applicant_winner_status", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Winner Remark</label>
											
											<textarea rows="3" name="applicant_winner_remark" id="applicant_winner_remark" class="form-control" placeholder="Winner Remark"><?php echo $data['applicant_winner_remark'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Grade Fail</label>
											
												<?php echo form_dropdown('applicant_grade_fail', $gradefail ,set_value('applicant_grade_fail',$data['applicant_grade_fail']),'id="applicant_grade_fail", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Grade Remark</label>
											
												<textarea rows="3" name="applicant_grade_fail_remark" id="applicant_grade_fail_remark" class="form-control" placeholder="Grade Remark"><?php echo $data['applicant_grade_fail_remark'];?></textarea>
											</div>
										</div>
																
										<div class="col-md-6">						
											<div class="form-group">
												<label class="control-label">Grade Fail Reason</label>
											
											<textarea rows="3" name="applicant_grade_fail_reason" id="applicant_grade_fail_reason" class="form-control" placeholder="Grade Fail Reason"><?php echo $data['applicant_grade_fail_reason'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Further Study</label>
											
												<?php echo form_dropdown('applicant_further_study', $furtherstudy ,set_value('applicant_further_study',$data['applicant_further_study']),'id="applicant_further_study", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Further Study Period</label>
											
												<input type="text" name="applicant_further_study_period" id="applicant_further_study_period" value="<?php echo $data['applicant_further_study_period'];?>" class="form-control" placeholder="Further Study Period">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Further Study Remark</label>
												
												<textarea rows="3" name="applicant_further_study_field" id="applicant_further_study_field" class="form-control" placeholder="Further Study Remark"><?php echo $data['applicant_further_study_field'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Has Team Member</label>
											
												<?php echo form_dropdown('applicant_has_team_member', $hasteammember ,set_value('applicant_has_team_member',$data['applicant_has_team_member']),'id="applicant_has_team_member", class="form-control select2me"');?>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Team Member</label>
											
												<input type="text" name="applicant_team_member" id="applicant_team_member" value="<?php echo $data['applicant_team_member'];?>" class="form-control" placeholder="Team Member">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">How Manage Team Member</label>
												
												<textarea rows="3" name="applicant_how_manage_team_member" id="applicant_how_manage_team_member" class="form-control" placeholder="How Manage Team Member"><?php echo $data['applicant_how_manage_team_member'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Head Expectation</label>
												
												<textarea rows="3" name="applicant_head_expectation" id="applicant_head_expectation" class="form-control" placeholder="Head Expectation"><?php echo $data['applicant_head_expectation'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">New Ideas</label>
												
											<textarea rows="3" name="applicant_new_ideas" id="applicant_new_ideas" class="form-control" placeholder="New Ideas"><?php echo $data['applicant_new_ideas'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Achievement</label>
											
												<textarea rows="3" name="applicant_achievement" id="applicant_achievement" class="form-control" placeholder="Achievement"><?php echo $data['applicant_achievement'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Achievement Satisfaction</label>
												
												<textarea rows="3" name="applicant_achievement_satisfaction" id="applicant_achievement_satisfaction" class="form-control" placeholder="Achievement Satisfaction"><?php echo $data['applicant_achievement_satisfaction'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Application Position</label>
											
												<input type="text" name="applicant_application_position" id="applicant_application_position" value="<?php echo $data['applicant_application_position'];?>" class="form-control" placeholder="Application Position">
											</div>
										</div>
								
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Expected Salary</label>
											
												<input type="text" name="applicant_expected_salary" id="applicant_expected_salary" value="<?php echo $data['applicant_expected_salary'];?>" class="form-control" placeholder="Application Position">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Out Of Town</label>
											
												<?php echo form_dropdown('applicant_out_of_town', $outoftown ,set_value('applicant_out_of_town',$data['applicant_out_of_town']),'id="applicant_out_of_town", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Out Of Town Remark</label>
												
												<textarea rows="3" name="applicant_out_of_town_remark" id="applicant_out_of_town_remark" class="form-control" placeholder="Out Of Town Remark"><?php echo $data['applicant_out_of_town_remark'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Immediately Work</label>
											
												<?php echo form_dropdown('applicant_immediately_work', $immediatelywork ,set_value('applicant_immediately_work',$data['applicant_immediately_work']),'id="applicant_immediately_work", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Immediately Work Remark</label>
												
												<textarea rows="3" name="applicant_immediately_work_remark" id="applicant_immediately_work_remark" class="form-control" placeholder="Immediately Work Remark"><?php echo $data['applicant_immediately_work_remark'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Overtime Ready</label>
											
												<?php echo form_dropdown('applicant_overtime_ready', $overtimeready ,set_value('applicant_overtime_ready',$data['applicant_overtime_ready']),'id="applicant_overtime_ready", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Overtime Ready Remark</label>
												
												<textarea rows="3" name="applicant_overtime_ready_remark" id="applicant_overtime_ready_remark" class="form-control" placeholder="Overtime Ready Remark"><?php echo $data['applicant_overtime_ready_remark'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Business Trip</label>
											
												<?php echo form_dropdown('applicant_business_trip', $overtimeready ,set_value('applicant_business_trip',$data['applicant_business_trip']),'id="applicant_business_trip", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Business Trip Remark</label>
												
												<textarea rows="3" name="applicant_business_trip_remark" id="applicant_business_trip_remark" class="form-control" placeholder="Business Trip Remark"><?php echo $data['applicant_business_trip_remark'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Work Environment</label>
											
												<input type="text" name="applicant_work_environment" id="applicant_work_environment" value="<?php echo $data['applicant_work_environment'];?>" class="form-control" placeholder="Work Environment">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Work Environment Other</label>
											
												<input type="text" name="applicant_work_environment_other" id="applicant_work_environment_other" value="<?php echo $data['applicant_work_environment_other'];?>" class="form-control" placeholder="Work Environment Other">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Most Like Work</label>
												
												<textarea rows="3" name="applicant_most_like_work" id="applicant_most_like_work" class="form-control" placeholder="Most Like Work"><?php echo $data['applicant_most_like_work'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Most Dislike Work</label>
												
												<textarea rows="3" name="applicant_most_dislike_work" id="applicant_most_dislike_work" class="form-control" placeholder="Most Dislike Work"><?php echo $data['applicant_most_dislike_work'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Hobby</label>
												
												<textarea rows="3" name="applicant_hobby" id="applicant_hobby" class="form-control" placeholder="Hobby"><?php echo $data['applicant_hobby'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Hobby Active</label>
												
												<textarea rows="3" name="applicant_hobby_active" id="applicant_hobby_active" class="form-control" placeholder="Hobby Active"><?php echo $data['applicant_hobby_active'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Interest Other Work</label>
												
												<textarea rows="3" name="applicant_interest_other_work" id="applicant_interest_other_work" class="form-control" placeholder="Interest Other Work"><?php echo $data['applicant_interest_other_work'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Good Book</label>
												
												<textarea rows="3" name="applicant_good_book" id="applicant_good_book" class="form-control" placeholder="Good Book"><?php echo $data['applicant_good_book'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Dream Of Life</label>
												
												<textarea rows="3" name="applicant_dream_of_life" id="applicant_dream_of_life" class="form-control" placeholder="Dream Of Life"><?php echo $data['applicant_dream_of_life'];?></textarea>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Dream Achieve</label>
												
												<textarea rows="3" name="applicant_dream_achieve" id="applicant_dream_achieve" class="form-control" placeholder="Dream Achieve"><?php echo $data['applicant_dream_achieve'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Weight</label>
												
												<input type="text" name="applicant_weight" id="applicant_weight" value="<?php echo $data['applicant_weight'];?>" class="form-control" placeholder="Weight">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Height</label>
											
												<input type="text" name="applicant_height" id="applicant_height" value="<?php echo $data['applicant_height'];?>" class="form-control" placeholder="Height">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sick Opname</label>
												
												<?php echo form_dropdown('applicant_sick_opname', $sickopname ,set_value('applicant_sick_opname',$data['applicant_sick_opname']),'id="applicant_sick_opname", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sick Disease</label>
											
												<input type="text" name="applicant_sick_disease" id="applicant_sick_disease" value="<?php echo $data['applicant_sick_disease'];?>" class="form-control" placeholder="Sick Disease">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sick Duration</label>
											
												<input type="text" name="applicant_sick_duration" id="applicant_sick_duration" value="<?php echo $data['applicant_sick_duration'];?>" class="form-control" placeholder="Sick Duration">
												<span class="help-block">
													 Please input only numbers.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sick Year</label>
											
												<input type="text" name="applicant_sick_year" id="applicant_sick_year" value="<?php echo $data['applicant_sick_year'];?>" class="form-control" placeholder="Sick Year">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sick Hospital</label>
											
												<input type="text" name="applicant_sick_hospital" id="applicant_sick_hospital" value="<?php echo $data['applicant_sick_hospital'];?>" class="form-control" placeholder="Sick Hospital">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Colour Blind</label>
											
												<?php echo form_dropdown('applicant_colour_blind', $colourblind ,set_value('applicant_colour_blind',$data['applicant_colour_blind']),'id="applicant_colour_blind", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Friend Name 1</label>
											
												<input type="text" name="applicant_work_friend_name1" id="applicant_work_friend_name1" value="<?php echo $data['applicant_work_friend_name1'];?>" class="form-control" placeholder="Friend Name 1">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Friend Section 1</label>
											
												<input type="text" name="applicant_work_friend_section1" id="applicant_work_friend_section1" value="<?php echo $data['applicant_work_friend_section1'];?>" class="form-control" placeholder="Friend Section 1">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Friend Relationship 1</label>
											
												<input type="text" name="applicant_work_friend_relationship1" id="applicant_work_friend_relationship1" value="<?php echo $data['applicant_work_friend_relationship1'];?>" class="form-control" placeholder="Friend Relationship 1">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Friend Name 2</label>
											
												<input type="text" name="applicant_work_friend_name2" id="applicant_work_friend_name2" value="<?php echo $data['applicant_work_friend_name2'];?>" class="form-control" placeholder="Friend Name 2">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Friend Section 2</label>
											
												<input type="text" name="applicant_work_friend_section2" id="applicant_work_friend_section2" value="<?php echo $data['applicant_work_friend_section2'];?>" class="form-control" placeholder="Friend Section 2">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Friend Relationship 2</label>
											
												<input type="text" name="applicant_work_friend_relationship2" id="applicant_work_friend_relationship2" value="<?php echo $data['applicant_work_friend_relationship2'];?>" class="form-control" placeholder="Friend Relationship 2">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Emergency Name</label>
											
												<input type="text" name="applicant_emergency_name" id="applicant_emergency_name" value="<?php echo $data['applicant_emergency_name'];?>" class="form-control" placeholder="Emergency Name">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Emergency Address</label>
											
											<textarea rows="3" name="applicant_emergency_address" id="applicant_emergency_address" class="form-control" placeholder="Emergency Address"><?php echo $data['applicant_emergency_address'];?></textarea>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Emergency Mobile Phone</label>
											
												<input type="text" name="applicant_emergency_mobile_phone" id="applicant_emergency_mobile_phone" value="<?php echo $data['applicant_emergency_mobile_phone'];?>" class="form-control" placeholder="Emergency Mobile Phone">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Emergency Home Phone</label>
											
												<input type="text" name="applicant_emergency_home_phone" id="applicant_emergency_home_phone" value="<?php echo $data['applicant_emergency_home_phone'];?>" class="form-control" placeholder="Emergency Home Phone">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Emergency Relationship</label>
											
												<input type="text" name="applicant_emergency_relationship" id="applicant_emergency_relationship" value="<?php echo $data['applicant_emergency_relationship'];?>" class="form-control" placeholder="Emergency Relationship">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Daily Transportation Name 1</label>
											
												<input type="text" name="applicant_daily_transportation_name1" id="applicant_daily_transportation_name1" value="<?php echo $data['applicant_daily_transportation_name1'];?>" class="form-control" placeholder="Daily Transportation Name 1">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Daily Transportation Year 1</label>
											
												<input type="text" name="applicant_daily_transportation_year1" id="applicant_daily_transportation_year1" value="<?php echo $data['applicant_daily_transportation_year1'];?>" class="form-control" placeholder="Daily Transportation Year 1">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Daily Transportation Owned 1</label>
											
												<input type="text" name="applicant_daily_transportation_owned1" id="applicant_daily_transportation_owned1" value="<?php echo $data['applicant_daily_transportation_owned1'];?>" class="form-control" placeholder="Daily Transportation Owned 1">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Daily Transportation Name 2</label>
											
												<input type="text" name="applicant_daily_transportation_name2" id="applicant_daily_transportation_name2" value="<?php echo $data['applicant_daily_transportation_name2'];?>" class="form-control" placeholder="Daily Transportation Name 2">
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Daily Transportation Year 2</label>
											
												<input type="text" name="applicant_daily_transportation_year2" id="applicant_daily_transportation_year2" value="<?php echo $data['applicant_daily_transportation_year2'];?>" class="form-control" placeholder="Daily Transportation Year 2">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Daily Transportation Owned 2</label>
											
												<input type="text" name="applicant_daily_transportation_owned2" id="applicant_daily_transportation_owned2" value="<?php echo $data['applicant_daily_transportation_owned2'];?>" class="form-control" placeholder="Daily Transportation Owned 2">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Ready No Married</label>
											
												<?php echo form_dropdown('applicant_ready_no_married', $readynomarried ,set_value('applicant_ready_no_married',$data['applicant_ready_no_married']),'id="applicant_ready_no_married", class="form-control select2me"');?>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn green"></i> Next <i class="m-icon-swapright m-icon-white"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="created_by" value="<?php echo $auth['username'];?>">
				<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
<?php echo form_close(); ?>