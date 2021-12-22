<script>
	function reset_data(){
		/**
		document.getElementById("employee_id").value = "<?php echo $HroEmployeeData['employee_id'] ?>";
		document.getElementById("employee_code").value = "<?php echo $HroEmployeeData['employee_code'] ?>";
		document.getElementById("employee_absence_id").value = "";
		document.getElementById("region_id").value = "";
		document.getElementById("branch_id").value = "";
		document.getElementById("division_id").value = "<?php echo $HroEmployeeData['division_id'] ?>";
		document.getElementById("department_id").value = "<?php echo $HroEmployeeData['department_id'] ?>";
		document.getElementById("section_id").value = "<?php echo $HroEmployeeData['section_id'] ?>";
		document.getElementById("job_title_id").value = "<?php echo $HroEmployeeData['job_title_id'] ?>";
		document.getElementById("grade_id").value = "<?php echo $HroEmployeeData['grade_id'] ?>";
		document.getElementById("class_id").value = "<?php echo $HroEmployeeData['class_id'] ?>";
		document.getElementById("location_id").value = "";
		document.getElementById("employee_name").value = "<?php echo $HroEmployeeData['employee_name'] ?>";
		document.getElementById("employee_nick_name").value = "";
		document.getElementById("employee_address").value = "<?php echo $HroEmployeeData['employee_address'] ?>";
		document.getElementById("employee_city").value = "<?php echo $HroEmployeeData['employee_city'] ?>";
		document.getElementById("employee_zip_code").value = "";
		document.getElementById("employee_rt").value = "<?php echo $HroEmployeeData['employee_rt'] ?>";
		document.getElementById("employee_rw").value = "<?php echo $HroEmployeeData['employee_rw'] ?>";
		document.getElementById("employee_kecamatan").value = "<?php echo $HroEmployeeData['employee_kecamatan'] ?>";
		document.getElementById("employee_kelurahan").value = "<?php echo $HroEmployeeData['employee_kelurahan'] ?>";
		document.getElementById("employee_home_phone").value = "<?php echo $HroEmployeeData['employee_home_phone'] ?>";
		document.getElementById("employee_mobile_phone").value = "<?php echo $HroEmployeeData['employee_mobile_phone'] ?>";
		document.getElementById("employee_email_address").value = "<?php echo $HroEmployeeData['employee_email_address'] ?>";
		document.getElementById("employee_gender").value = "<?php echo $HroEmployeeData['employee_gender'] ?>";
		document.getElementById("date_of_birth").value = "";
		document.getElementById("place_of_birth").value = "";
		document.getElementById("employee_religion").value = "<?php echo $HroEmployeeData['employee_religion'] ?>";
		document.getElementById("employee_id_number").value = "<?php echo $HroEmployeeData['employee_id_number'] ?>";
		document.getElementById("employee_residence_address").value = "";
		document.getElementById("employee_residence_city").value = "";
		document.getElementById("employee_residence_zip_code").value = "";
		document.getElementById("employee_residence_rt").value = "";
		document.getElementById("employee_residence_rw").value = "";
		document.getElementById("employee_bank_id").value = "<?php echo $HroEmployeeData['employee_bank_id'] ?>";
		document.getElementById("employee_bank_acct_no").value = "";
		document.getElementById("employee_bank_acct_name").value = "";
		**/
		document.getElementById("employee_remark").value = "<?php echo $HroEmployeeData['employee_remark'] ?>";
	}
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeData/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeData/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>

<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
	

</style>


					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeData">
									Daftar Data Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeData/editHROEmployeeData/<?php echo $HroEmployeeData['employee_id']; ?>">
									Edit Data Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<h1 class="page-title">
						Form Edit Data Karyawan
					</h1>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										Form Edit
									</div>
									
									<div class = "actions">
										<div class="actions">
											<a href="<?php echo base_url();?>HroEmployeeData" class="btn btn-default btn-sm">
											<i class="fa fa-angle-left"></i> Kembali</a>
										</div>
									</div>
								</div>
								<div class="portlet-body form">
									<div class="form-body">
										<?php 
											echo form_open('HroEmployeeData/processEditHROEmployeeData',array('id' => 'myform', 'class' => 'horizontal-form')); 
											/*$HroEmployeeData = $this->session->userdata('addHroEmployeeData');*/
										?>
				
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('division_id', $coredivision,set_value('division_id',$HroEmployeeData['division_id']),'id="division_id" class="form-control select2me" ');
													?>
													<label class="control-label">Nama Devisi
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('department_id', $coredepartment, set_value('department_id', $HroEmployeeData['department_id']),'id="department_id" class="form-control select2me" ');
													?>

													<label class="control-label">Nama Departemen
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('section_id', $coresection,set_value('section_id',$HroEmployeeData['section_id']),'id="section_id" class="form-control select2me" ');
													?>
													<label class="control-label">Nama Bagian
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('unit_id', $coreunit,set_value('unit_id',$HroEmployeeData['unit_id']),'id="unit_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Nama Satuan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$HroEmployeeData['job_title_id']),'id="job_title_id" class="form-control select2me" ');
													?>
													<label class="control-label">Nama Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										<!-- </div>

										<div class = "row"> -->
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $HroEmployeeData['grade_id']),'id="grade_id" class="form-control select2me" ');
													?>

													<label class="control-label">Nama Tingkat
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('class_id', $coreclass,set_value('class_id',$HroEmployeeData['class_id']),'id="class_id" class="form-control select2me" ');
													?>
													<label class="control-label">Nama Kelas 
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_code" id="employee_code" value="<?php echo $HroEmployeeData['employee_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<span class="help-block">
														 Mohon hanya diisi karakter huruf dan angka.
													</span>

													<label class="control-label">Kode Karyawan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rfid_code" id="employee_rfid_code" value="<?php echo $HroEmployeeData['employee_rfid_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kode Rfid
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_name" id="employee_name" value="<?php echo $HroEmployeeData['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >

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
													<textarea rows="3" name="employee_address" id="employee_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $HroEmployeeData['employee_address'];?></textarea>
													<label class="control-label">Alamat</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_city" id="employee_city" value="<?php echo $HroEmployeeData['employee_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kota</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_postal_code" id="employee_postal_code" value="<?php echo $HroEmployeeData['employee_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kode Pos</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rt" id="employee_rt" value="<?php echo $HroEmployeeData['employee_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RT</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_rw" id="employee_rw" value="<?php echo $HroEmployeeData['employee_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RW</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_kelurahan" id="employee_kelurahan" value="<?php echo $HroEmployeeData['employee_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kelurahan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_kecamatan" id="employee_kecamatan" value="<?php echo $HroEmployeeData['employee_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kecamatan</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_home_phone" id="employee_home_phone" value="<?php echo $HroEmployeeData['employee_home_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Telp Rumah</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $HroEmployeeData['employee_mobile_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">No Hp</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $HroEmployeeData['employee_email_address'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Email </label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_gender', $gender, set_value('employee_gender',$HroEmployeeData['employee_gender']),'id="employee_gender", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Jenis Kelamin</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_date_of_birth" id="employee_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeData['employee_date_of_birth']);?>"/>
													<label class="control-label">Tanggal Lahir
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_place_of_birth" id="employee_place_of_birth" value="<?php echo $HroEmployeeData['employee_place_of_birth'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Tempat Lahir</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_id_type', $idtype, set_value('employee_id_type',$HroEmployeeData['employee_id_type']),'id="employee_id_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Jenis ID</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $HroEmployeeData['employee_id_number'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Nomor ID</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_religion', $religion, set_value('employee_religion',$HroEmployeeData['employee_religion']),'id="employee_religion", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Agama</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_blood_type', $bloodtype, set_value('employee_blood_type',$HroEmployeeData['employee_blood_type']),'id="employee_blood_type", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Golongan Darah</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-12">
												<div class="form-group form-md-line-input">
													<textarea rows="3" name="employee_residential_address" id="employee_residential_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $HroEmployeeData['employee_residential_address'];?></textarea>
													<label class="control-label">Alamat tinggal</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_city" id="employee_residential_city" value="<?php echo $HroEmployeeData['employee_residential_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kota Tempat tinggal</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_postal_code" id="employee_residential_postal_code" value="<?php echo $HroEmployeeData['employee_residential_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kode Pos Tempat tinggal</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rt" id="employee_residential_rt" value="<?php echo $HroEmployeeData['employee_residential_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label"> RT Tempat tinggal</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rw" id="employee_residential_rw" value="<?php echo $HroEmployeeData['employee_residential_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label"> RW Tempat tinggal</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kelurahan" id="employee_residential_kelurahan" value="<?php echo $HroEmployeeData['employee_residential_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kelurahan Tempat tinggal</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kecamatan" id="employee_residential_kecamatan" value="<?php echo $HroEmployeeData['employee_residential_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label"> Kecamatan Tempat tinggal</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$HroEmployeeData['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Pernikahan </label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $HroEmployeeData['employee_heir_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Nama Ahli Waris</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$HroEmployeeData['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Kerja</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$HroEmployeeData['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Lembur</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_status', $employeestatus ,set_value('employee_employment_status',$HroEmployeeData['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Pegawai</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeData['employee_hire_date']);?>"/>
													<label class="control-label">Tanggal Diterima
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_date" id="employee_employment_status_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeData['employee_employment_status_date']);?>"/>
													<label class="control-label">Tanggal Status Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeData['employee_employment_status_duedate']);?>"/>
													<label class="control-label">Tanggal akhir Status Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('payroll_employee_level', $payrollemployeelevel ,set_value('payroll_employee_level',$HroEmployeeData['payroll_employee_level']),'id="payroll_employee_level", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Level Daftar gaji Karyawan</label>
												</div>
											</div>
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('bank_id', $corebank ,set_value('bank_id', $HroEmployeeData['bank_id']), 'id="bank_id", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
													?>
													<label class="control-label">Nama Bank
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
													<textarea rows="3" name="employee_remark" id="employee_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $HroEmployeeData['employee_remark'];?></textarea>
													<label class="control-label">Keterangan Karyawan</label>
												</div>
											</div>
										</div>



										<div class="form-actions right">
											<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
										</div>
										<input type="hidden" name="employee_id" value="<?php echo $HroEmployeeData['employee_id']; ?>"/>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
