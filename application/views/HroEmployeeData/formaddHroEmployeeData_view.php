<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"HroEmployeeData/reset_session";
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
		margin-bottom: 12px !important;
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
					Daftar data karyawan
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Tambah Data Karyawan
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h1 class="page-title">
		Form Tambah Data Karyawan
	</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

?>

					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue">
								<div class="portlet-title">
									<div class="caption">
										Form Tambah
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
											echo form_open('HroEmployeeData/processAddHROEmployeeData',array('id' => 'myform', 'class' => 'horizontal-form')); 

											echo $this->session->userdata('message');
											$this->session->unset_userdata('message');
											
											$unique 		= $this->session->userdata('unique');
											$data 			= $this->session->userdata('addHroEmployeeData-'.$unique['unique']);
											$employee_token	= $this->session->userdata('HroEmployeeDataToken-'.$unique['unique']);


											if(empty($data['employee_code']))
											{
												$data['employee_code'] 					= '';
											}

											if(empty($data['employee_name'])){
											$data['employee_name'] 					= '';
											}

											if(empty($data['employee_date_of_birth'])){
												$data['employee_date_of_birth']= date('Y-m-d');
											}

											if(empty($data['employee_hire_date'])){
												$data['employee_hire_date']= date('Y-m-d');
											}
											
											if(empty($data['employee_employment_status_date'])){
												$data['employee_employment_status_date']= date('Y-m-d');
											}

											if(empty($data['employee_employment_status_duedate'])){
												$data['employee_employment_status_duedate']= date('Y-m-d');
											}

											if(empty($data['marital_status_id'])){
												$data['marital_status_id']= 1;
											}

											if(empty($data['division_id'])){
												$data['division_id']="";
											}
											if(empty($data['department_id'])){
												$data['department_id']="";
											}
											if(empty($data['section_id'])){
												$data['section_id']="";
											}
											if(empty($data['unit_id'])){
												$data['unit_id']="";
											}
											if(empty($data['job_title_id'])){
												$data['job_title_id']="";
											}
											if(empty($data['grade_id'])){
												$data['grade_id']="";
											}
											if(empty($data['class_id'])){
												$data['class_id']="";
											}
											if(empty($data['employee_code'])){
												$data['employee_code']="";
											}  

											if(empty($data['employee_name'])){
												$data['employee_name']="";
											}
											if(empty($data['employee_address'])){
												$data['employee_address']="";
											}
											if(empty($data['employee_city'])){
												$data['employee_city']="";
											}
											if(empty($data['employee_postal_code'])){
												$data['employee_postal_code']="";
											}
											if(empty($data['employee_rt'])){
												$data['employee_rt']="";
											}  

											if(empty($data['employee_rw'])){
												$data['employee_rw']="";
											}
											if(empty($data['employee_kelurahan'])){
												$data['employee_kelurahan']="";
											}
											if(empty($data['employee_kecamatan'])){
												$data['employee_kecamatan']="";
											}
											if(empty($data['employee_home_phone'])){
												$data['employee_home_phone']="";
											}
											if(empty($data['employee_mobile_phone'])){
												$data['employee_mobile_phone']="";
											} 

											if(empty($data['employee_email_address'])){
												$data['employee_email_address']="";
											}
											if(empty($data['employee_gender'])){
												$data['employee_gender']="";
											}
											if(empty($data['employee_place_of_birth'])){
												$data['employee_place_of_birth']="";
											}
											if(empty($data['employee_id_type'])){
												$data['employee_id_type']=0;
											}
											if(empty($data['employee_id_number'])){
												$data['employee_id_number']="";
											} 

											if(empty($data['employee_religion'])){
												$data['employee_religion']="";
											}
											if(empty($data['employee_blood_type'])){
												$data['employee_blood_type']="";
											}
											if(empty($data['employee_residential_address'])){
												$data['employee_residential_address']="";
											}
											if(empty($data['employee_residential_city'])){
												$data['employee_residential_city']="";
											}
											if(empty($data['employee_residential_postal_code'])){
												$data['employee_residential_postal_code']="";
											} 

											if(empty($data['employee_residential_rt'])){
												$data['employee_residential_rt']="";
											}
											if(empty($data['employee_residential_rw'])){
												$data['employee_residential_rw']="";
											}
											if(empty($data['employee_residential_kelurahan'])){
												$data['employee_residential_kelurahan']="";
											}
											if(empty($data['employee_residential_kecamatan'])){
												$data['employee_residential_kecamatan']="";
											}
											if(empty($data['employee_heir_name'])){
												$data['employee_heir_name']="";
											} 

											if(empty($data['employee_employment_working_status'])){
												$data['employee_employment_working_status']="";
											}
											if(empty($data['employee_employment_overtime_status'])){
												$data['employee_employment_overtime_status']="";
											}
											if(empty($data['employee_employment_status'])){
												$data['employee_employment_status']="";
											}
											if(empty($data['payroll_employee_level'])){
												$data['payroll_employee_level']=0;
											}
											if(empty($data['employee_remark'])){
												$data['employee_remark']="";
											}
											if(empty($data['bank_id'])){
												$data['bank_id']=0;
											}
											if(empty($data['employee_rfid_code'])){
												$data['employee_rfid_code']="";
											}
											
										?>
				
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
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
														echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me" ');
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
														echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" class="form-control select2me" ');
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
														echo form_dropdown('unit_id', $coreunit,set_value('unit_id',$data['unit_id']),'id="unit_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
														echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me" ');
													?>
													<label class="control-label">Nama Judul Pekerjaan
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
														echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $data['grade_id']),'id="grade_id" class="form-control select2me" ');
													?>

													<label class="control-label">Nama Peringkat
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php
														echo form_dropdown('class_id', $coreclass,set_value('class_id',$data['class_id']),'id="class_id" class="form-control select2me" ');
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
													<input type="text" name="employee_code" id="employee_code" value="<?php echo $data['employee_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">

													<input type="hidden" name="employee_token" id="employee_token" class="form-control" value="<?php echo $employee_token?>" onChange="function_elements_add(this.name, this.value);">
													
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
													<input type="text" name="employee_rfid_code" id="employee_rfid_code" value="<?php echo $data['employee_rfid_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kode Rfid
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_name" id="employee_name" value="<?php echo $data['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >

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
													<textarea rows="3" name="employee_address" id="employee_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_address'];?></textarea>
													<label class="control-label">Alamat</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_city" id="employee_city" value="<?php echo $data['employee_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kota</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_postal_code" id="employee_postal_code" value="<?php echo $data['employee_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kode Pos</label>
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
													<label class="control-label">No Telp Rumah</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_mobile_phone" id="employee_mobile_phone" value="<?php echo $data['employee_mobile_phone'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">No Hp</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_email_address" id="employee_email_address" value="<?php echo $data['employee_email_address'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Email</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_gender', $gender, set_value('employee_gender',$data['employee_gender']),'id="employee_gender", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Jenis Kelamin</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_date_of_birth" id="employee_date_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_date_of_birth']);?>"/>													
													<label class="control-label">Tanggal Lahir
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_place_of_birth" id="employee_place_of_birth" value="<?php echo $data['employee_place_of_birth'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Tampat Lahir</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('employee_id_type', $idtype, set_value('employee_id_type',$data['employee_id_type']),'id="employee_id_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													?>
													<label class="control-label">Jenis ID</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_id_number" id="employee_id_number" value="<?php echo $data['employee_id_number'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Nomor ID</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_religion', $religion, set_value('employee_religion',$data['employee_religion']),'id="employee_religion", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Agama</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_blood_type', $bloodtype, set_value('employee_blood_type',$data['employee_blood_type']),'id="employee_blood_type", class="form-control select2me"  onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Golongan Darah</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-12">
												<div class="form-group form-md-line-input">
													<textarea rows="3" name="employee_residential_address" id="employee_residential_address" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_residential_address'];?></textarea>
													<label class="control-label">Ralamat tempat tinggal</label>
												</div>
											</div>
										</div>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_city" id="employee_residential_city" value="<?php echo $data['employee_residential_city'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kota tempat tinggal</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_postal_code" id="employee_residential_postal_code" value="<?php echo $data['employee_residential_postal_code'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kode Pos tempat tinggal</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rt" id="employee_residential_rt" value="<?php echo $data['employee_residential_rt'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RT tempat tinggal</label>
												</div>
											</div>
										
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_rw" id="employee_residential_rw" value="<?php echo $data['employee_residential_rw'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">RW tempat tinggal</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kelurahan" id="employee_residential_kelurahan" value="<?php echo $data['employee_residential_kelurahan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kelurahan tempat tinggal</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_residential_kecamatan" id="employee_residential_kecamatan" value="<?php echo $data['employee_residential_kecamatan'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Kecamatan tempat tinggal</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('marital_status_id', $coremaritalstatus ,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Pernikahan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_heir_name" id="employee_heir_name" value="<?php echo $data['employee_heir_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
													<label class="control-label">Nama Pewaris</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$data['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Berkerja</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$data['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Lembur</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_status', $employeestatus ,set_value('employee_employment_status',$data['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Pekerjaan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_hire_date']);?>"/>
													<label class="control-label">Tanggal perekrutan
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
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_date" id="employee_employment_status_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_employment_status_date']);?>"/>
													<label class="control-label">Tanggal Status Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_employment_status_duedate']);?>"/>
													<label class="control-label">Tanggal Putus Kontrak
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
													<?php echo form_dropdown('payroll_employee_level', $payrollemployeelevel ,set_value('payroll_employee_level',$data['payroll_employee_level']),'id="payroll_employee_level", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Tingkat Penggajian karyawan</label>
												</div>
											</div>											
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php 
														echo form_dropdown('bank_id', $corebank ,set_value('bank_id', $data['bank_id']), 'id="bank_id", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
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
													<textarea rows="3" name="employee_remark" id="employee_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['employee_remark'];?></textarea>
													<label class="control-label">Keterangan Karyawan</label>
												</div>
											</div>
										</div>

										<div class="form-actions right">
											<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Batal</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
										</div>
									</div>
									<?php echo form_close(); ?>
								</div>
							</div>
						</div>
					</div>
