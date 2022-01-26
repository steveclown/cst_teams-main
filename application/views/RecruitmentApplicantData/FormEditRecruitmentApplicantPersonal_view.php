<?php
	echo form_open('RecruitmentApplicantData/processEditRecruitmentApplicantData', array('id' => 'myform', 'class' => 'horizontal-form')); 
?>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_name" name="applicant_name" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_name'];?>">
			<label for="form-control">Nama
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input name="applicant_application_date" id="applicant_application_date" type="text" class="form-control" value="<?php if (empty($RecruitmentApplicantData['applicant_application_date'])){
				echo date('d-m-Y');
			}else{
				echo $RecruitmentApplicantData['applicant_application_date'];
			}?>" readonly>
				
			<label for="form-control">Tanggal Melamar</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_place_of_birth" name="applicant_place_of_birth" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_place_of_birth'];?>">
			<label for="form-control">Tempat Lahir
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_date_of_birth" id="applicant_date_of_birth" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_date_of_birth'];?>">
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
			<input type="text" autocomplete="off"  class="form-control" id="applicant_last_education" name="applicant_last_education" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_last_education'];?>">
			<label for="form-control">Pendidikan Terakhir
			</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_address" id="applicant_address" class="form-control" onChange="function_elements_edit(this.name, this.value);"><?php echo $RecruitmentApplicantData['applicant_address'];?></textarea>
			<label for="form-control">Alamat</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_city" name="applicant_city" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_city'];?>">
			<label for="form-control">Kota
				<span class="required">*</span>
			</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_postal_code" name="applicant_postal_code" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_postal_code'];?>">
			<label for="form-control">Kode Pos</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_rt" name="applicant_rt" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_rt'];?>" >
			
			<label for="form-control">RT</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input ">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_rw" name="applicant_rw" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_rw'];?>" >
			<label for="form-control">RW</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input ">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_kelurahan" name="applicant_kelurahan" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_kelurahan'];?>">
			<label for="form-control">Kelurahan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_kecamatan" name="applicant_kecamatan" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_kecamatan'];?>" >
			<label for="form-control">Kecamatan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_home_phone" name="applicant_home_phone" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_home_phone'];?>" >
			<label for="form-control"> Telp Rumah</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_mobile_phone" name="applicant_mobile_phone" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_mobile_phone'];?>" >
			<label for="form-control">No HP</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_email_address" name="applicant_email_address" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_email_address'];?>">
			<label for="form-control">Email</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_residence_address" id="applicant_residence_address" class="form-control" onChange="function_elements_edit(this.name, this.value);"><?php echo $RecruitmentApplicantData['applicant_residence_address'];?></textarea>
			<label for="form-control">Alamat Tinggal </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_city" name="applicant_residence_city" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_residence_city'];?>">
			<label for="form-control">Kota Tempat Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_postal_code" name="applicant_residence_postal_code" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_residence_postal_code'];?>">
			<label for="form-control">Kode Pos Tempat Tinggal </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_rt" name="applicant_residence_rt" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_residence_rt'];?>">
			<label for="form-control">RT Tempat Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_rw" name="applicant_residence_rw" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_residence_rw'];?>">
			<label for="form-control">RW Tempat Tinggal</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_kelurahan" name="applicant_residence_kelurahan" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_residence_kelurahan'];?>">
			<label for="form-control">Kelurahan Tempat Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_residence_kecamatan" name="applicant_residence_kecamatan" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_residence_kecamatan'];?>">
			<label for="form-control"> Kecamatan Tempat Tinggal</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_residence_status', $residencestatus,set_value('applicant_residence_status',$RecruitmentApplicantData['applicant_residence_status']),'id="applicant_residence_status" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label for="form-control"> Status Tempat Tinggal</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group ">
			<div class="form-group form-md-line-input">
				<?php
					echo form_dropdown('applicant_gender', $gender,set_value('applicant_gender',$RecruitmentApplicantData['applicant_residence_status']),'id="applicant_gender" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
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
				echo form_dropdown('applicant_religion', $religion,set_value('applicant_religion',$RecruitmentApplicantData['applicant_religion']),'id="applicant_religion" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label for="form-control">Agama</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_nationality', $nationality,set_value('applicant_nationality',$RecruitmentApplicantData['applicant_nationality']),'id="applicant_nationality" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label for="form-control">Kewarganegaraan</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_blood_type', $bloodtype,set_value('applicant_blood_type',$RecruitmentApplicantData['applicant_blood_type']),'id="applicant_blood_type" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label for="form-control">Golongan Darah</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_heir_name" name="applicant_heir_name" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_heir_name'];?>">
			<label for="form-control">Nama Ahli Waris</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('marital_status_id', $coremaritalstatus,set_value('marital_status_id',$RecruitmentApplicantData['marital_status_id']),'id="marital_status_id" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label for="form-control">Status Pernikahan</label>
		</div>
	</div>
</div>
<div class = "row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_id_type', $idtype,set_value('applicant_id_type',$RecruitmentApplicantData['applicant_id_type']),'id="applicant_id_type" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label for="form-control">Jenis ID</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_id_number" name="applicant_id_number" onChange="function_elements_edit(this.name, this.value);" value="<?php echo $RecruitmentApplicantData['applicant_id_number'];?>" >
			<label for="form-control">Nomor ID</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_edit()"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Simpan</button>	
	</div>
</div>

<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $RecruitmentApplicantData['applicant_id'];?>">
<?php echo  form_close(); ?>