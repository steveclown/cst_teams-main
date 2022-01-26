
<?php
	$unique 		= $this->session->userdata('unique');
	$datapersonal 	= $this->session->userdata('recruitRecruitmentApplicantData-'.$unique['unique']);

	if (empty($datapersonal['bank_id'])) {
		# code...
		$datapersonal['bank_id']="";
	}
	if (empty($datapersonal['applicant_bank_acct_no'])) {
		# code...
		$datapersonal['applicant_bank_acct_no']="";
	}
	if (empty($datapersonal['applicant_bank_acct_name'])) {
		# code...
		$datapersonal['applicant_bank_acct_name']="";
	}
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_name" id="applicant_name" value="<?php echo $RecruitmentApplicantData['applicant_name'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);" >

			<label class="control-label">Nama Karyawan
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
			<textarea rows="3" name="applicant_address" id="applicant_address" class="form-control" onChange="function_elements_recruit(this.name, this.value);" ><?php echo $RecruitmentApplicantData['applicant_address'];?></textarea>
			<label class="control-label">Alamat</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_city" id="applicant_city" value="<?php echo $RecruitmentApplicantData['applicant_city'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_postal_code" id="applicant_postal_code" value="<?php echo $RecruitmentApplicantData['applicant_postal_code'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kode Pos</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_rt" id="applicant_rt" value="<?php echo $RecruitmentApplicantData['applicant_rt'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_rw" id="applicant_rw" value="<?php echo $RecruitmentApplicantData['applicant_rw'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_kelurahan" id="applicant_kelurahan" value="<?php echo $RecruitmentApplicantData['applicant_kelurahan'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_kecamatan" id="applicant_kecamatan" value="<?php echo $RecruitmentApplicantData['applicant_kecamatan'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_home_phone" id="applicant_home_phone" value="<?php echo $RecruitmentApplicantData['applicant_home_phone'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Telp Rumah</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_mobile_phone" id="applicant_mobile_phone" value="<?php echo $RecruitmentApplicantData['applicant_mobile_phone'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">No Hp</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_email_address" id="applicant_email_address" value="<?php echo $RecruitmentApplicantData['applicant_email_address'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Email</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('applicant_gender', $gender, set_value('applicant_gender',$RecruitmentApplicantData['applicant_gender']),'id="applicant_gender", class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
			?>
			<label class="control-label">Jenis Kelamin</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_date_of_birth" id="applicant_date_of_birth" onChange="function_elements_recruit(this.name, this.value);" value="<?php echo tgltoview($RecruitmentApplicantData['applicant_date_of_birth']);?>"/>
			<label class="control-label">Tanggal Lahir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_place_of_birth" id="applicant_place_of_birth" value="<?php echo $RecruitmentApplicantData['applicant_place_of_birth'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Tempat Lahir</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('applicant_id_type', $idtype, set_value('applicant_id_type',$RecruitmentApplicantData['applicant_id_type']),'id="applicant_id_type", class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
			?>
			<label class="control-label">Tipe ID</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_id_number" id="applicant_id_number" value="<?php echo $RecruitmentApplicantData['applicant_id_number'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Nomor ID</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('applicant_religion', $religion, set_value('applicant_religion',$RecruitmentApplicantData['applicant_religion']),'id="applicant_religion", class="form-control select2me"  onChange="function_elements_recruit(this.name, this.value);"');?>
			<label class="control-label">Agama</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('applicant_blood_type', $bloodtype, set_value('applicant_blood_type',$RecruitmentApplicantData['applicant_blood_type']),'id="applicant_blood_type", class="form-control select2me"  onChange="function_elements_recruit(this.name, this.value);"');?>
			<label class="control-label">Golongan Darah</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_residence_address" id="applicant_residence_address" class="form-control" onChange="function_elements_recruit(this.name, this.value);" ><?php echo $RecruitmentApplicantData['applicant_residence_address'];?></textarea>
			<label class="control-label">Alamat tinggal</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_residence_city" id="applicant_residence_city" value="<?php echo $RecruitmentApplicantData['applicant_residence_city'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kota tinggal</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_residence_postal_code" id="applicant_residence_postal_code" value="<?php echo $RecruitmentApplicantData['applicant_residence_postal_code'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kode Pos </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_residence_rt" id="applicant_residence_rt" value="<?php echo $RecruitmentApplicantData['applicant_residence_rt'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_residence_rw" id="applicant_residence_rw" value="<?php echo $RecruitmentApplicantData['applicant_residence_rw'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_residence_kelurahan" id="applicant_residence_kelurahan" value="<?php echo $RecruitmentApplicantData['applicant_residence_kelurahan'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kelurahan tempat tinggal</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_residence_kecamatan" id="applicant_residence_kecamatan" value="<?php echo $RecruitmentApplicantData['applicant_residence_kecamatan'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Kecamatan tempat tinggal</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$RecruitmentApplicantData['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');?>
			<label class="control-label">Status Pernikahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_heir_name" id="applicant_heir_name" value="<?php echo $RecruitmentApplicantData['applicant_heir_name'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Nama Pewaris </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('bank_id', $corebank ,set_value('bank_id', $datapersonal['bank_id']), 'id="bank_id", class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
			?>
			<label class="control-label">Nama Bank</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_bank_acct_no" id="applicant_bank_acct_no" value="<?php echo $datapersonal['applicant_bank_acct_no'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">No Bank Acct</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_bank_acct_name" id="applicant_bank_acct_name" value="<?php echo $datapersonal['applicant_bank_acct_name'];?>" class="form-control" onChange="function_elements_recruit(this.name, this.value);">
			<label class="control-label">Nama Bank Acct</label>
		</div>
	</div>
</div>
<!-- 
<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_remark" id="applicant_remark" class="form-control" onChange="function_elements_recruit(this.name, this.value);" ><?php echo $RecruitmentApplicantData['applicant_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div> -->
