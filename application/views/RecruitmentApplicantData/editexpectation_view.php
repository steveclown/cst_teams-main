<script>
	// mappia = "<?php echo site_url('item/add'); ?>";
	
	mappia = "<?php echo site_url('recruitmentapplicantdata/addRecruitmentApplicantData'); ?>";
	function deletesessionarrays(value,session_name){
//			alert(array_name);
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('transactionalapplicantdata/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
			}
		});
	}
	
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
	
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_application_position" name="applicant_application_position" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_application_position'];?>">
			<label>Application Position</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_expected_salary" name="applicant_expected_salary" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_expected_salary'];?>">
			<label>Expected Salary</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_out_town', $status,set_value('applicant_working_out_town',$data['applicant_working_out_town']),'id="applicant_working_out_town" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Out of Town</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_working_out_town_reason" id="applicant_working_out_town_reason" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_working_out_town_reason'];?></textarea>
			<label>Out of Town Reason </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_immediately', $status,set_value('applicant_working_immediately',$data['applicant_working_immediately']),'id="applicant_working_immediately" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Immediately Work</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_working_immediately_reason" id="applicant_working_immediately_reason" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_working_immediately_reason'];?></textarea>
			<label>Immediately Work Reason </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_overtime', $status,set_value('applicant_working_overtime',$data['applicant_working_overtime']),'id="applicant_working_overtime" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Willing to Overtime</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_working_overtime_reason" id="applicant_working_overtime_reason" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_working_overtime_reason'];?></textarea>
			<label>Willing to Overtime Reason </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_business_trip', $status,set_value('applicant_business_trip',$data['applicant_business_trip']),'id="applicant_business_trip" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Willing to Business Trip</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_business_trip_reason" id="applicant_business_trip_reason" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_business_trip_reason'];?></textarea>
			<label>Willing to Business Trip Reason</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_environment', $workingenvironment,set_value('applicant_working_environment',$data['applicant_working_environment']),'id="applicant_working_environment" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Working Environment</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_working_environment_other" name="applicant_working_environment_other" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_working_environment_other'];?>">
			<label>Working Environment Other </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_working_like" name="applicant_working_like" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_working_like'];?>">
			<label>Most Favorit Job</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_working_dislike" name="applicant_working_dislike" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_working_dislike'];?>">
			<label>Most Unpopular Job </label>
		</div>
	</div>
</div>