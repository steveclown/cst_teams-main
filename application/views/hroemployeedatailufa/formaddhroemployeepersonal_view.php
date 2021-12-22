<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addhroemployeedatailufa-'.$unique['unique']);
?>

					

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_code" id="employee_code" value="<?php echo $data['employee_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<span class="help-block">
				 Please input only alpha-numerical characters.
			</span>

			<label class="control-label">Employee Code
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_name" id="employee_name" value="<?php echo $data['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >

			<label class="control-label">Employee Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_address" id="employee_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_address'];?></textarea>
			<label class="control-label">Address</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_city" id="employee_city" value="<?php echo $data['employee_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">City</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_postal_code" id="employee_postal_code" value="<?php echo $data['employee_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Postal Code</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_rt" id="employee_rt" value="<?php echo $data['employee_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_rw" id="employee_rw" value="<?php echo $data['employee_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_kelurahan" id="employee_kelurahan" value="<?php echo $data['employee_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_kecamatan" id="employee_kecamatan" value="<?php echo $data['employee_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_home_phone" id="employee_home_phone" value="<?php echo $data['employee_home_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Home Phone</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $data['employee_mobile_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Mobile Phone</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $data['employee_email_address'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Email Address</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_gender', $gender, set_value('employee_gender',$data['employee_gender']),'id="employee_gender", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Gender</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_date_of_birth" id="employee_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_date_of_birth']);?>"/>
			<label class="control-label">Date Of Birth
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_place_of_birth" id="employee_place_of_birth" value="<?php echo $data['employee_place_of_birth'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Place Of Birth</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_id_type', $idtype, set_value('employee_id_type',$data['employee_id_type']),'id="employee_id_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">ID Type</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $data['employee_id_number'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">ID Number</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_religion', $religion, set_value('employee_religion',$data['employee_religion']),'id="employee_religion", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
			<label class="control-label">Religion</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_blood_type', $bloodtype, set_value('employee_blood_type',$data['employee_blood_type']),'id="employee_blood_type", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
			<label class="control-label">Blood Type</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_residential_address" id="employee_residential_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_residential_address'];?></textarea>
			<label class="control-label">Residential Address</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_city" id="employee_residential_city" value="<?php echo $data['employee_residential_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Residential City</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_postal_code" id="employee_residential_postal_code" value="<?php echo $data['employee_residential_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Residential Postal Code</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_rt" id="employee_residential_rt" value="<?php echo $data['employee_residential_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Residential RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_rw" id="employee_residential_rw" value="<?php echo $data['employee_residential_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Residential RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_kelurahan" id="employee_residential_kelurahan" value="<?php echo $data['employee_residential_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Residential Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_kecamatan" id="employee_residential_kecamatan" value="<?php echo $data['employee_residential_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Residential Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
			<label class="control-label">Marital Status</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $data['employee_heir_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Heir Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_remark" id="employee_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_remark'];?></textarea>
			<label class="control-label">Employee Remark</label>
		</div>
	</div>
</div>