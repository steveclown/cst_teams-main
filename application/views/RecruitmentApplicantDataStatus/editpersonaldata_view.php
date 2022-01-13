<script>
	mappia = "<?php echo site_url('recruitmentapplicantdata/addRecruitmentApplicantData'); ?>";
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

	/* $residence_status = array(
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
	); */
	/* print_r($data); */
	
?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_name" name="applicant_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_name'];?>">
			<label for="form-control">Name
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input name="applicant_application_date" id="applicant_application_date" type="text" class="form-control" value="<?php if (empty($recruitmentapplicantdata['applicant_application_date'])){
				echo tgltoview(date('d-m-Y'));
			}else{
				echo tgltoview($recruitmentapplicantdata['applicant_application_date']);
			}?>" readonly>
				
			<label for="form-control">Application Date</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_place_of_birth" name="applicant_place_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_place_of_birth'];?>">
			<label for="form-control">Place of Birth
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_date_of_birth" id="applicant_date_of_birth" onChange="function_elements_add(this.name, this.value);" value = "<?php echo tgltoview($recruitmentapplicantdata['applicant_date_of_birth']);?>"/>
			<label class="control-label">Date of Birth
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_last_education" name="applicant_last_education" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_last_education'];?>">
			<label for="form-control">Last Education
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_address" id="applicant_address" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $recruitmentapplicantdata['applicant_address'];?></textarea>
			<label for="form-control">Address</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_city" name="applicant_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_city'];?>">
			<label for="form-control">City
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_postal_code" name="applicant_postal_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_postal_code'];?>">
			<label for="form-control">Postal Code</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_rt" name="applicant_rt" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_rt'];?>" >
			
			<label for="form-control">RT</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input ">
			<input type="text" class="form-control" id="applicant_rw" name="applicant_rw" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_rw'];?>" >
			<label for="form-control">RW</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input ">
			<input type="text" class="form-control" id="applicant_kelurahan" name="applicant_kelurahan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_kelurahan'];?>">
			<label for="form-control">Kelurahan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_kecamatan" name="applicant_kecamatan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_kecamatan'];?>" >
			<label for="form-control">Kecamatan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_home_phone" name="applicant_home_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_home_phone'];?>" >
			<label for="form-control">Home Phone</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_mobile_phone" name="applicant_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_mobile_phone'];?>" >
			<label for="form-control">Mobile Phone</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_email_address" name="applicant_email_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_email_address'];?>">
			<label for="form-control">Email</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_residence_address" id="applicant_residence_address" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $recruitmentapplicantdata['applicant_residence_address'];?></textarea>
			<label for="form-control">Residence Address</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_city" name="applicant_residence_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_residence_city'];?>">
			<label for="form-control">Residence City</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_postal_code" name="applicant_residence_postal_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_residence_postal_code'];?>">
			<label for="form-control">Residence Postal Code</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_rt" name="applicant_residence_rt" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_residence_rt'];?>">
			<label for="form-control">Residence RT</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_rw" name="applicant_residence_rw" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_residence_rw'];?>">
			<label for="form-control">Residence RW</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_kelurahan" name="applicant_residence_kelurahan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_residence_kelurahan'];?>">
			<label for="form-control">Residence Kelurahan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_kecamatan" name="applicant_residence_kecamatan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_residence_kecamatan'];?>">
			<label for="form-control">Residence Kecamatan</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_residence_status', $residencestatus,set_value('applicant_residence_status',$recruitmentapplicantdata['applicant_residence_status']),'id="applicant_residence_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Residence Status</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group ">
			<div class="form-group form-md-line-input">
				<?php
					echo form_dropdown('applicant_gender', $gender,set_value('applicant_gender',$recruitmentapplicantdata['applicant_residence_status']),'id="applicant_gender" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
				?>
				<label for="form-control">Gender</label>
			</div>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_religion', $religion,set_value('applicant_religion',$recruitmentapplicantdata['applicant_religion']),'id="applicant_religion" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Religion</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_nationality', $nationality,set_value('applicant_nationality',$recruitmentapplicantdata['applicant_nationality']),'id="applicant_nationality" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Nationality</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_blood_type', $bloodtype,set_value('applicant_blood_type',$recruitmentapplicantdata['applicant_blood_type']),'id="applicant_blood_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Blood Type</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_heir_name" name="applicant_heir_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_heir_name'];?>">
			<label for="form-control">Heir Name</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('marital_status_id', $coremaritalstatus,set_value('marital_status_id',$recruitmentapplicantdata['marital_status_id']),'id="marital_status_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Marital Status</label>
		</div>
	</div>
</div>
<div class = "row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_id_type', $idtype,set_value('applicant_id_type',$recruitmentapplicantdata['applicant_id_type']),'id="applicant_id_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">ID Type</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_id_number" name="applicant_id_number" onChange="function_elements_add(this.name, this.value);" value="<?php echo $recruitmentapplicantdata['applicant_id_number'];?>" >
			<label for="form-control">ID Number</label>
		</div>
	</div>
</div>
