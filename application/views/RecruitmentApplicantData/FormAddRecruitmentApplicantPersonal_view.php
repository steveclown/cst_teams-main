<script>
	mappia = "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data 	= $this->session->userdata('addRecruitmentApplicantData-'.$sesi['unique']);	

	if (empty($data['applicant_name'])) {
		$data['applicant_name']="";
	}
	if (empty($data['applicant_place_of_birth'])) {
		$data['applicant_place_of_birth']="";
		# code...
	}
	if (empty($data['applicant_address'])) {
		$data['applicant_address']="";
		# code...
	}
	if (empty($data['applicant_city'])) {
		$data['applicant_city']="";
		# code...
	}
	if (empty($data['applicant_application_date'])) {
		$data['applicant_application_date']="";
	}
	if (empty($data['applicant_rt'])) {
		$data['applicant_rt']="";
	}
	if (empty($data['applicant_rw'])) {
		$data['applicant_rw']="";
	}
	if (empty($data['applicant_kelurahan'])) {
		$data['applicant_kelurahan']="";
	}
	if (empty($data['applicant_kecamatan'])) {
		$data['applicant_kecamatan']="";
	}
	if (empty($data['applicant_last_education'])) {
		$data['applicant_last_education']="";
	}
	if (empty($data['applicant_nationality'])) {
		$data['applicant_nationality']="";
	}
	if (empty($data['applicant_gender'])) {
		$data['applicant_gender']="";
	}
	if (empty($data['applicant_religion'])) {
		$data['applicant_religion']="";
	}
	if (empty($data['applicant_residence_status'])) {
		$data['applicant_residence_status']="";
	}
	if (empty($data['applicant_postal_code'])) {
		$data['applicant_postal_code']="";
	}
	if (empty($data['applicant_home_phone'])) {
		$data['applicant_home_phone']="";
	}
	if (empty($data['applicant_mobile_phone'])) {
		$data['applicant_mobile_phone']="";
	}
	if (empty($data['applicant_email_address'])) {
		$data['applicant_email_address']="";
	}
	if (empty($data['applicant_residence_address'])) {
		$data['applicant_residence_address']="";
	}
	if (empty($data['applicant_residence_city'])) {
		$data['applicant_residence_city']="";
	}
	if (empty($data['applicant_residence_rt'])) {
		$data['applicant_residence_rt']="";
	}
	if (empty($data['applicant_residence_rw'])) {
		$data['applicant_residence_rw']="";
	}
	if (empty($data['applicant_residence_kelurahan'])) {
		$data['applicant_residence_kelurahan']="";
	}
	if (empty($data['applicant_residence_kecamatan'])) {
		$data['applicant_residence_kecamatan']="";
	}
	if (empty($data['applicant_residence_postal_code'])) {
		$data['applicant_residence_postal_code']="";
	}
	if (empty($data['applicant_blood_type'])) {
		$data['applicant_blood_type']="";
	}
	if (empty($data['applicant_heir_name'])) {
		$data['applicant_heir_name']="";
	}
	if (empty($data['marital_status_id'])) {
		$data['marital_status_id']="";
	}
	if (empty($data['applicant_id_type'])) {
		$data['applicant_id_type']="";
	}
	if (empty($data['applicant_id_number'])) {
		$data['applicant_id_number']="";
	}

?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_name" name="applicant_name" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Nama
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input name="applicant_application_date" id="applicant_application_date" type="text" class="form-control" value="<?php if (empty($data['applicant_application_date'])){
				echo date('d-m-Y');
			}else{
				echo $data['applicant_application_date'];
			}?>" readonly>
				
			<label for="form-control">Tanggal Melamar</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_place_of_birth" name="applicant_place_of_birth" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Tempat Lahir
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_date_of_birth" id="applicant_date_of_birth" onChange="function_elements_add(this.name, this.value);"/>
			<label class="control-label">Tanggal Lahir
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
			<input type="text" class="form-control" id="applicant_last_education" name="applicant_last_education" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Pendidikan Terakhir
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_address" id="applicant_address" class="form-control" onChange="function_elements_add(this.name, this.value);"></textarea>
			<label for="form-control">Alamat</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_city" name="applicant_city" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kota
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_postal_code" name="applicant_postal_code" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kode Pos</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_rt" name="applicant_rt" onChange="function_elements_add(this.name, this.value);">
			
			<label for="form-control">RT</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input ">
			<input type="text" class="form-control" id="applicant_rw" name="applicant_rw" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">RW</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input ">
			<input type="text" class="form-control" id="applicant_kelurahan" name="applicant_kelurahan" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kelurahan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_kecamatan" name="applicant_kecamatan" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kecamatan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_home_phone" name="applicant_home_phone" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">No Telp Rumah</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_mobile_phone" name="applicant_mobile_phone" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">No HP</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_email_address" name="applicant_email_address" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Email</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_residence_address" id="applicant_residence_address" class="form-control" onChange="function_elements_add(this.name, this.value);"></textarea>
			<label for="form-control">Alamat Tinggal </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_city" name="applicant_residence_city" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kota Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_postal_code" name="applicant_residence_postal_code" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kode Pos Tempat Tinggal</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_rt" name="applicant_residence_rt" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">RT</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_rw" name="applicant_residence_rw" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">RW</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_kelurahan" name="applicant_residence_kelurahan" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kelurahan Tempat Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_residence_kecamatan" name="applicant_residence_kecamatan" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Kecamatan Tempat Tinggal</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_residence_status', $residencestatus,set_value('applicant_residence_status',$data['applicant_residence_status']),'id="applicant_residence_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Status Tempat Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group ">
			<div class="form-group form-md-line-input">
				<?php
					echo form_dropdown('applicant_gender', $gender,set_value('applicant_gender',$data['applicant_residence_status']),'id="applicant_gender" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
				?>
				<label for="form-control">Jenis Kelamin</label>
			</div>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_religion', $religion,set_value('applicant_religion',$data['applicant_religion']),'id="applicant_religion" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Agama</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_nationality', $nationality,set_value('applicant_nationality',$data['applicant_nationality']),'id="applicant_nationality" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Kewarganegaraan</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_blood_type', $bloodtype,set_value('applicant_blood_type',$data['applicant_blood_type']),'id="applicant_blood_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Golongan Darah</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_heir_name" name="applicant_heir_name" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Nama Pewaris</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('marital_status_id', $coremaritalstatus,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Status Pernikahan</label>
		</div>
	</div>
</div>
<div class = "row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_id_type', $idtype,set_value('applicant_id_type',$data['applicant_id_type']),'id="applicant_id_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Jenis ID </label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_id_number" name="applicant_id_number" onChange="function_elements_add(this.name, this.value);">
			<label for="form-control">Nomor ID </label>
		</div>
	</div>
</div>
