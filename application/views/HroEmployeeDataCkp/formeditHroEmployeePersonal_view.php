<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_code" id="employee_code" value="<?php echo $HroEmployeeDataCkp['employee_code'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<span class="help-block">
				Mohon hanya diisi karakter huruf dan angka
			</span>

			<label class="control-label">Kode Karyawan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_name" id="employee_name" value="<?php echo $HroEmployeeDataCkp['employee_name'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" >

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
			<textarea rows="3" name="employee_address" id="employee_address" class="form-control" onChange="function_elements_edit(this.name, this.value);" ><?php echo $HroEmployeeDataCkp['employee_address'];?></textarea>
			<label class="control-label">Alamat</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_city" id="employee_city" value="<?php echo $HroEmployeeDataCkp['employee_city'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Kota </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_postal_code" id="employee_postal_code" value="<?php echo $HroEmployeeDataCkp['employee_postal_code'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Kode Pos</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_rt" id="employee_rt" value="<?php echo $HroEmployeeDataCkp['employee_rt'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_rw" id="employee_rw" value="<?php echo $HroEmployeeDataCkp['employee_rw'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_kelurahan" id="employee_kelurahan" value="<?php echo $HroEmployeeDataCkp['employee_kelurahan'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_kecamatan" id="employee_kecamatan" value="<?php echo $HroEmployeeDataCkp['employee_kecamatan'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_home_phone" id="employee_home_phone" value="<?php echo $HroEmployeeDataCkp['employee_home_phone'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Telp Rumah</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $HroEmployeeDataCkp['employee_mobile_phone'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">No Hp</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $HroEmployeeDataCkp['employee_email_address'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Email </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_gender', $gender, set_value('employee_gender',$HroEmployeeDataCkp['employee_gender']),'id="employee_gender", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label class="control-label">Jenis Kelamin</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" HroEmployeeDataCkp-date-format="dd-mm-yyyy" type="text" name="employee_date_of_birth" id="employee_date_of_birth" onChange="function_elements_edit(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeDataCkp['employee_date_of_birth']);?>"/>
			<label class="control-label">Tanggal Lahir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_place_of_birth" id="employee_place_of_birth" value="<?php echo $HroEmployeeDataCkp['employee_place_of_birth'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Tempat Lahir</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_id_type', $idtype, set_value('employee_id_type',$HroEmployeeDataCkp['employee_id_type']),'id="employee_id_type", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label class="control-label">Jenis ID</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $HroEmployeeDataCkp['employee_id_number'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Nomor ID</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_religion', $religion, set_value('employee_religion',$HroEmployeeDataCkp['employee_religion']),'id="employee_religion", class="form-control select2me"  onChange="function_elements_edit(this.name, this.value);"');?>
			<label class="control-label">Agama </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_blood_type', $bloodtype, set_value('employee_blood_type',$HroEmployeeDataCkp['employee_blood_type']),'id="employee_blood_type", class="form-control select2me"  onChange="function_elements_edit(this.name, this.value);"');?>
			<label class="control-label">Golongan Darah</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_residential_address" id="employee_residential_address" class="form-control" onChange="function_elements_edit(this.name, this.value);" ><?php echo $HroEmployeeDataCkp['employee_residential_address'];?></textarea>
			<label class="control-label">Alamat Tinggal</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_city" id="employee_residential_city" value="<?php echo $HroEmployeeDataCkp['employee_residential_city'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Kota Tempat Tinggal</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_postal_code" id="employee_residential_postal_code" value="<?php echo $HroEmployeeDataCkp['employee_residential_postal_code'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Kode Pos Tempat Tinggal</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_rt" id="employee_residential_rt" value="<?php echo $HroEmployeeDataCkp['employee_residential_rt'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label"> RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_rw" id="employee_residential_rw" value="<?php echo $HroEmployeeDataCkp['employee_residential_rw'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label"> RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_kelurahan" id="employee_residential_kelurahan" value="<?php echo $HroEmployeeDataCkp['employee_residential_kelurahan'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label"> Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_residential_kecamatan" id="employee_residential_kecamatan" value="<?php echo $HroEmployeeDataCkp['employee_residential_kecamatan'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label"> Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$HroEmployeeDataCkp['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label class="control-label">Status Pernikahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $HroEmployeeDataCkp['employee_heir_name'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Nama Ahli Waris </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('bank_id', $corebank ,set_value('bank_id', $HroEmployeeDataCkp['bank_id']), 'id="bank_id", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>
			<label class="control-label">Nama Bank</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_bank_acct_no" id="employee_bank_acct_no" value="<?php echo $HroEmployeeDataCkp['employee_bank_acct_no'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">No Rek Bank</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_bank_acct_name" id="employee_bank_acct_name" value="<?php echo $HroEmployeeDataCkp['employee_bank_acct_name'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);">
			<label class="control-label">Nama Akun Bank</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_remark" id="employee_remark" class="form-control" onChange="function_elements_edit(this.name, this.value);" ><?php echo $HroEmployeeDataCkp['employee_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>

