<script>
	mappia = "<?php echo site_url('item/add'); ?>";
	function ngawur(value){
	// alert(value);
	// document.getElementById("3").style.display = "none";
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('item/saveitemtype');?>",
				data: {'item_type' : value},
				success: function(data){
				window.location.replace(mappia);
			}
		});
	}
	
	function deletesessionarrays(value,session_name){
//			alert(array_name);
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('transactionalapplicantdata/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace(mappia);
			}
		});
	}
	
	
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	$residence_status = array(
		'0'	=> 'Private',
		'1'	=> 'Family',
		'2'	=> 'Rent',
		'3'	=> 'Boarding'
	);
	
	$religion = array(
		'0'	=> 'Islam',
		'1'	=> 'Katholik',
		'2'	=> 'Kristen',
		'3' => 'Hindu',
		'4'	=> 'Budha',
		'5'	=> 'Kong Hucu',
	);
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Name</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_name" name="applicant_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_name'];?>" placeholder="Name">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Application Date</label>
			<div class="input-group">
				<input name="applicant_application_date" id="applicant_application_date" type="text" class="form-control" value="<?php if (empty($data['applicant_application_date'])){
					echo date('d-m-Y');
				}else{
					echo $data['applicant_application_date'];
				}?>" readonly>
				<span class="input-group-btn">
					<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Address</label>
			<textarea rows="3" name="applicant_address" id="applicant_address" class="form-control" placeholder="Remark"><?php echo $data['applicant_address'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>City</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_city" name="applicant_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_city'];?>" placeholder="Name">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>ZIP Code</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_zip_code" name="applicant_zip_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_zip_code'];?>" placeholder="Name">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>RT</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_rt" name="applicant_rt" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_rt'];?>" placeholder="RT">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>RW</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_rw" name="applicant_rw" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_rw'];?>" placeholder="RW">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kelurahan</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_kelurahan" name="applicant_kelurahan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_kelurahan'];?>" placeholder="Kelurahan">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Kecamatan</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_kecamatan" name="applicant_kecamatan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_kecamatan'];?>" placeholder="Kecamatan">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Home Phone</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_home_phone" name="applicant_home_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_home_phone'];?>" placeholder="Home Phone">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Mobile Phone</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_mobile_phone" name="applicant_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_mobile_phone'];?>" placeholder="Mobile Phone">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Email</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_email_address" name="applicant_email_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_email_address'];?>" placeholder="Email">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence Address</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_address" name="applicant_residence_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_address'];?>" placeholder="Residence">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence City</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_city" name="applicant_residence_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_city'];?>" placeholder="Residence City">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence ZIP Code</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_zip_code" name="applicant_residence_zip_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_zip_code'];?>" placeholder="Residence ZIP Code">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence RT</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_rt" name="applicant_residence_rt" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_rt'];?>" placeholder="Residence RT">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence RW</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_rw" name="applicant_residence_rw" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_rw'];?>" placeholder="Residence RW">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence Kelurahan</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_kelurahan" name="applicant_residence_kelurahan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_kelurahan'];?>" placeholder="Residence Kelurahan">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence Kecamatan</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_kecamatan" name="applicant_residence_kecamatan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_residence_kecamatan'];?>" placeholder="Residence Kecamatan">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Residence Status</label>
			<?php
				echo form_dropdown('applicant_residence_status', $residence_status,set_value('applicant_residence_status',$data['applicant_residence_status']),'id="applicant_residence_status" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Religion</label>
			<?php
				echo form_dropdown('applicant_religion', $religion,set_value('applicant_religion',$data['applicant_religion']),'id="applicant_religion" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Nationality</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_nationality" name="applicant_nationality" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_nationality'];?>" placeholder="Nationality">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Marital Status</label>
			<?php
				echo form_dropdown('marital_status_id', $marital,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>ID Number</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_id_number" name="applicant_id_number" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_id_number'];?>" placeholder="ID Number">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Education Cost</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_education_cost" name="applicant_education_cost" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_cost'];?>" placeholder="Education Cost">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label>Winner Status</label>
			<?php
				echo form_dropdown('applicant_winner_status', $status,set_value('applicant_winner_status',$data['applicant_winner_status']),'id="applicant_winner_status" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Winner Remark</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_winner_remark" name="applicant_winner_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_winner_remark'];?>" placeholder="Remark">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label>Grade Fail</label>
			<?php
				echo form_dropdown('applicant_grade_fail', $status,set_value('applicant_grade_fail',$data['applicant_grade_fail']),'id="applicant_grade_fail" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Fail Remark</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_grade_fail_remark" name="applicant_grade_fail_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_grade_fail_remark'];?>" placeholder="Remark">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Fail Reason</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_grade_fail_reason" name="applicant_grade_fail_reason" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_grade_fail_reason'];?>" placeholder="Reason">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Futher Study</label>
			<?php
				echo form_dropdown('applicant_further_study', $status,set_value('applicant_further_study',$data['applicant_further_study']),'id="applicant_further_study" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Further Study Field</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_further_study_field" name="applicant_further_study_field" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_further_study_field'];?>" placeholder="Field">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Period </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_further_study_period" name="applicant_further_study_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_further_study_period'];?>" placeholder="Period">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label>Has Team Member</label>
			<?php
				echo form_dropdown('applicant_has_team_member', $status,set_value('applicant_has_team_member',$data['applicant_has_team_member']),'id="applicant_has_team_member" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Team Member</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_team_member" name="applicant_team_member" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_team_member'];?>" placeholder="Team Member">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group">
			<label>How to Manage Member</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_how_manage_team_member" name="applicant_how_manage_team_member" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_how_manage_team_member'];?>" placeholder="Manage Team Member">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group">
			<label>Head Expectation</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_head_expectation" name="applicant_head_expectation" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_head_expectation'];?>" placeholder="Expectation">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group">
			<label>New Ideas</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_new_ideas" name="applicant_new_ideas" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_new_ideas'];?>" placeholder="New Ideas">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group">
			<label>Achievement</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_achievement" name="applicant_achievement" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_achievement'];?>" placeholder="Achievement">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group">
			<label class="col-md-3 control-label">Achievement Satisfaction</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_achievement_satisfaction" name="applicant_achievement_satisfaction" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_achievement_satisfaction'];?>" placeholder="Achievement Satisfication">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Application Position</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_application_position" name="applicant_application_position" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_application_position'];?>" placeholder="Position">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Period </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_expected_salary" name="applicant_expected_salary" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_expected_salary'];?>" placeholder="Salary">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Out of Town</label>
			<?php
				echo form_dropdown('applicant_out_of_town', $status,set_value('applicant_out_of_town',$data['applicant_out_of_town']),'id="applicant_out_of_town" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Remark </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_out_of_town_remark" name="applicant_out_of_town_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_out_of_town_remark'];?>" placeholder="Remark">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Imidiately Work</label>
			<?php
				echo form_dropdown('applicant_immediately_work', $status,set_value('applicant_immediately_work',$data['applicant_immediately_work']),'id="applicant_immediately_work" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Remark </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_immediately_work_remark" name="applicant_immediately_work_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_immediately_work_remark'];?>" placeholder="Remark">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Overtime Ready</label>
			<?php
				echo form_dropdown('applicant_overtime_ready', $status,set_value('applicant_overtime_ready',$data['applicant_overtime_ready']),'id="applicant_overtime_ready" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Remark </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_overtime_ready_remark" name="applicant_overtime_ready_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_overtime_ready_remark'];?>" placeholder="Remark">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Business Trip</label>
			<?php
				echo form_dropdown('applicant_business_trip', $status,set_value('applicant_business_trip',$data['applicant_business_trip']),'id="applicant_business_trip" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Remark </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_business_trip_remark" name="applicant_business_trip_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_business_trip_remark'];?>" placeholder="Remark">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Work Environment</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_environment" name="applicant_work_environment" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_environment'];?>" placeholder="Work Environment">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Work Environment Other </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_environment_other" name="applicant_work_environment_other" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_environment_other'];?>" placeholder="Work Environment Other">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Most Like Work</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_most_like_work" name="applicant_most_like_work" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_most_like_work'];?>" placeholder="Most Like Work">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Dislike Work </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_most_dislike_work" name="applicant_most_dislike_work" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_most_dislike_work'];?>" placeholder="Dislike Work">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Hobby</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_hobby" name="applicant_hobby" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_hobby'];?>" placeholder="Hobby">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Hobby Active</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_hobby_active" name="applicant_hobby_active" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_hobby_active'];?>" placeholder="Hobby">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Interest Other Work</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_interest_other_work" name="applicant_interest_other_work" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_interest_other_work'];?>" placeholder="Insterest Work Other">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Good Book</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_good_book" name="applicant_good_book" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_good_book'];?>" placeholder="Good Book">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Dream of Life</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_dream_of_life" name="applicant_dream_of_life" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_dream_of_life'];?>" placeholder="Dream of Life">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Dream Achieve</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_dream_achieve" name="applicant_dream_achieve" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_dream_achieve'];?>" placeholder="Dream Achieve">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Weight</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_weight" name="applicant_weight" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_weight'];?>" placeholder="Weight">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Dream Achieve</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_height" name="applicant_height" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_height'];?>" placeholder="Height">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Sick Opname</label>
			<?php
				echo form_dropdown('applicant_sick_opname', $status,set_value('applicant_sick_opname',$data['applicant_sick_opname']),'id="applicant_sick_opname" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Disease </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_disease" name="applicant_sick_disease" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_disease'];?>" placeholder="Disease">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Duration</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_duration" name="applicant_sick_duration" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_duration'];?>" placeholder="Duration">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Sick Year</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_year" name="applicant_sick_year" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_year'];?>" placeholder="Year">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label>Hospital</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_hospital" name="applicant_sick_hospital" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_hospital'];?>" placeholder="Hospital">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Colour Blind</label>
			<?php
				echo form_dropdown('applicant_colour_blind', $status,set_value('applicant_colour_blind',$data['applicant_colour_blind']),'id="applicant_colour_blind" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Friend Name 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_name1" name="applicant_work_friend_name1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_name1'];?>" placeholder="Friend 1">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Friend Section 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_section1" name="applicant_work_friend_section1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_section1'];?>" placeholder="Section">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Relationship 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_relationship1" name="applicant_work_friend_relationship1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_relationship1'];?>" placeholder="Relationship 1">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Friend Name 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_name2" name="applicant_work_friend_name2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_name2'];?>" placeholder="Friend 1">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Friend Section 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_relationship1" name="applicant_work_friend_relationship1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_relationship1'];?>" placeholder="Relationship 1">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Friend Name 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_section2" name="applicant_work_friend_section2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_section2'];?>" placeholder="Section">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Relationship 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_relationship2" name="applicant_work_friend_relationship2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_relationship2'];?>" placeholder="Relationship 2">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Emergency Name </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_name" name="applicant_emergency_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_name'];?>" placeholder="Emergency Name">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Address</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_address" name="applicant_emergency_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_address'];?>" placeholder="Emergency Address">
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group">
			<label>Relationship</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_relationship" name="applicant_emergency_relationship" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_relationship'];?>" placeholder="Relationship">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Home Phone</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_work_friend_relationship2" name="applicant_work_friend_relationship2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_friend_relationship2'];?>" placeholder="Relationship 2">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Mobile Phone </label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_mobile_phone" name="applicant_emergency_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_mobile_phone'];?>" placeholder="Mobile Phone">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Transportation 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_name1" name="applicant_daily_transportation_name1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_name1'];?>" placeholder="Transportation 1">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Year</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_year1" name="applicant_daily_transportation_year1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_year1'];?>" placeholder="Year 1">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Owned 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_owned1" name="applicant_daily_transportation_owned1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_owned1'];?>" placeholder="Owned 1">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Transportation 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_name2" name="applicant_daily_transportation_name2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_name2'];?>" placeholder="Transportation 1">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Year 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_year2" name="applicant_daily_transportation_year2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_year2'];?>" placeholder="Year 2">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Owned 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_owned2" name="applicant_daily_transportation_owned2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_owned2'];?>" placeholder="Owned 2">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Colour Blind</label>
			<?php
				echo form_dropdown('applicant_ready_no_married', $status,set_value('applicant_ready_no_married',$data['applicant_ready_no_married']),'id="applicant_ready_no_married" class="form-control"');
			?>
		</div>
	</div>
</div>