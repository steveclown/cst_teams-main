<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";

	function function_elements_add_expectation(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_expectation');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
</script>
<?php
	$unique 			= $this->session->userdata('unique');
	$auth				= $this->session->userdata('auth');
	$data_expectation 	= $this->session->userdata('addrecruitmentapplicantexpectation-'.$unique['unique']);	
	
	if (empty($data_expectation)) {
		$data_expectation['applicant_application_position']			="";
		$data_expectation['applicant_expected_salary']				="";
		$data_expectation['applicant_working_out_town']				="";
		$data_expectation['applicant_working_out_town_reason']		="";
		$data_expectation['applicant_working_immediately']			="";
		$data_expectation['applicant_working_immediately_reason']	="";
		$data_expectation['applicant_working_overtime']				="";
		$data_expectation['applicant_working_overtime_reason']		="";
		$data_expectation['applicant_business_trip']				="";	
		$data_expectation['applicant_business_trip_reason']			="";
		$data_expectation['applicant_working_environment']			="";
		$data_expectation['applicant_working_environment_other']	="";
		$data_expectation['applicant_working_like']					="";
		$data_expectation['applicant_working_dislike']				="";
	}
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_application_position" name="applicant_application_position" onChange="function_elements_add_expectation(this.name, this.value);" value="<?php echo $data_expectation['applicant_application_position'];?>">
			<label>Posisi Yang Diinginkan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_expected_salary" name="applicant_expected_salary" onChange="function_elements_add_expectation(this.name, this.value);" value="<?php echo $data_expectation['applicant_expected_salary'];?>">
			<label>Gaji Yang Diharapkan</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_out_town', $status,set_value('applicant_working_out_town',$data_expectation['applicant_working_out_town']),'id="applicant_working_out_town" class="form-control select2me" onChange="function_elements_add_expectation(this.name, this.value);"');
			?>
			<label>Bersedia Bekerja Di Luar Kota</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_working_out_town_reason" id="applicant_working_out_town_reason" class="form-control" onChange="function_elements_add_expectation(this.name, this.value);"><?php echo $data_expectation['applicant_working_out_town_reason'];?></textarea>
			<label>Alasan Bersedia Bekerja Keluar Kota </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_immediately', $status,set_value('applicant_working_immediately',$data_expectation['applicant_working_immediately']),'id="applicant_working_immediately" class="form-control select2me" onChange="function_elements_add_expectation(this.name, this.value);"');
			?>
			<label>Bersedia Langsung Bekerja</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_working_immediately_reason" id="applicant_working_immediately_reason" class="form-control" onChange="function_elements_add_expectation(this.name, this.value);"><?php echo $data_expectation['applicant_working_immediately_reason'];?></textarea>
			<label>Alasan Bersedia Langsung Bekerja</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_overtime', $status,set_value('applicant_working_overtime',$data_expectation['applicant_working_overtime']),'id="applicant_working_overtime" class="form-control select2me" onChange="function_elements_add_expectation(this.name, this.value);"');
			?>
			<label>Bersedia Lembur </label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_working_overtime_reason" id="applicant_working_overtime_reason" class="form-control" onChange="function_elements_add_expectation(this.name, this.value);"><?php echo $data_expectation['applicant_working_overtime_reason'];?></textarea>
			<label>Alasan Bersedia Lembur </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_business_trip', $status,set_value('applicant_business_trip',$data_expectation['applicant_business_trip']),'id="applicant_business_trip" class="form-control select2me" onChange="function_elements_add_expectation(this.name, this.value);"');
			?>
			<label>Bersedia Untuk Perjalanan bisnis</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_business_trip_reason" id="applicant_business_trip_reason" class="form-control" onChange="function_elements_add_expectation(this.name, this.value);" ><?php echo $data_expectation['applicant_business_trip_reason'];?></textarea>
			<label>Alasan Bersedia Untuk Perjalanan bisnis</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_working_environment', $workingenvironment,set_value('applicant_working_environment',$data_expectation['applicant_working_environment']),'id="applicant_working_environment" class="form-control select2me" onChange="function_elements_add_expectation(this.name, this.value);"');
			?>
			<label>Lingkungan kerja</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_working_environment_other" name="applicant_working_environment_other" onChange="function_elements_add_expectation(this.name, this.value);" value="<?php echo $data_expectation['applicant_working_environment_other'];?>">
			<label>Lingkungan kerja Lain </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_working_like" name="applicant_working_like" onChange="function_elements_add_expectation(this.name, this.value);" value="<?php echo $data_expectation['applicant_working_like'];?>">
			<label>Pekerjaan Yang Disukai</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_working_dislike" name="applicant_working_dislike" onChange="function_elements_add_expectation(this.name, this.value);" value="<?php echo $data_expectation['applicant_working_dislike'];?>">
			<label>Pekerjaan Yang Tidak Disukai</label>
		</div>
	</div>
</div>