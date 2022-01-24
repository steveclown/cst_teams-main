<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add(){
		document.location = base_url+"HroEmployeeStatusAlteration/reset_add/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeStatusAlteration/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeStatusAlteration/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>

<script>
	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id = $("#region_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeStatusAlteration/getCoreBranch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);                
               }
            });
        });
    });
	$(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeStatusAlteration/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);                
               }
            });
        });
    });
	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeStatusAlteration/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);                
               }
            });
        });
    });
	$(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeStatusAlteration/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);                
               }
            });
        });
    });
	$(document).ready(function(){
        $("#section_id").change(function(){
            var section_id = $("#section_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeStatusAlteration/getCoreUnit",
               data : {section_id: section_id},
               success: function(data){
                   $("#unit_id").html(data);                
               }
            });
        });
    });
</script>

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
								<a href="<?php echo base_url();?>transactionalstatusalterationbyemployee">
									Daftar Perubahan Status
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeStatusAlteration/addHROEmployeeStatusAlteration/<?php echo $hroemployeedata['employee_id']?>">
									Tambah Perubahan Status
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Perubahan Status - <?php echo $hroemployeedata['employee_name']?> - <?php echo $employeeemploymentstatus[$hroemployeedata['employee_employment_status']] ?>
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
<div class="col-md-5">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Data Karyawan
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 

						$unique = $this->session->userdata('unique');

						$data 	=  $this->session->userdata('addHroEmployeeStatusAlteration-'.$unique['unique']);	

						if (empty($data['status_alteration_date'])){
							$data['status_alteration_date'] = date('d-m-Y');
						}

						if (empty($data['status_alteration_last_date'])){
							$data['status_alteration_last_date'] = date('d-m-Y');
						}
						if (empty($data['status_alteration_description'])){
							$data['status_alteration_description'] = "";
						}
						if (empty($data['status_alteration_remark'])){
							$data['status_alteration_remark'] = "";
						}
						if (empty($data['employee_employment_status'])){
							$data['employee_employment_status'] = "";
						}

					?>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" class="form-control" value="<?php echo $hroemployeedata['employee_name']?>" readonly>
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_code" id="employee_code" class="form-control" value="<?php echo $hroemployeedata['employee_code']?>" readonly>
								<label class="control-label">Kode Karyawan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getRegionName($hroemployeestatusalteration_last['region_id']);?>" readonly>
								<label class="control-label">Wilayah</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getBranchName($hroemployeestatusalteration_last['branch_id']);?>" readonly>
								<label class="control-label">Branch</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getLocationName($hroemployeestatusalteration_last['location_id']);?>" readonly>
								<label class="control-label">Location</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getCompanyName($hroemployeestatusalteration_last['company_id']);?>" readonly>
								<label class="control-label">Company</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getDivisionName($hroemployeestatusalteration_last['division_id']);?>" readonly>
								<label class="control-label">Divisi</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getDepartmentName($hroemployeedata['department_id']);?>" readonly>
								<label class="control-label">Department</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getSectionName($hroemployeestatusalteration_last['section_id']);?>" readonly>
								<label class="control-label">Bagian</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getUnitName($hroemployeestatusalteration_last['unit_id']);?>" readonly>
								<label class="control-label">Unit</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getJobTitleName($hroemployeestatusalteration_last['job_title_id']);?>" readonly>
								<label class="control-label">Jabatan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getGradeName($hroemployeestatusalteration_last['grade_id']);?>" readonly>
								<label class="control-label">Grade</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $this->HroEmployeeStatusAlteration_model->getClassName($hroemployeestatusalteration_last['class_id']);?>" readonly>
								<label class="control-label">Class</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" value="<?php echo $employeeemploymentstatus[$hroemployeestatusalteration_last['employee_employment_status']];?>" readonly/>
								<!-- <?php 
								if ($hroemployeestatusalteration_last==true) {
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$hroemployeestatusalteration_last['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								} else{
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$hroemployeedata['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								}
								?> -->
								<label class="control-label">Status Pekerjaan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium" type="text" name="" id="" value="<?php echo tgltoview($hroemployeestatusalteration_last['status_alteration_date']);?>" readonly>
								<label class="control-label">Tanggal Perubahan Status</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium" type="text" name="" id="" value="<?php echo tgltoview($hroemployeestatusalteration_last['status_alteration_last_date']);?>" readonly>
								<label class="control-label">Perubahan Status Tanggal Terakhir</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $hroemployeestatusalteration_last['status_alteration_description'];?>" readonly />
								<label class="control-label">Deskripsi</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="text" name="" id="" class="form-control" value="<?php echo $hroemployeestatusalteration_last['status_alteration_remark'];?>" readonly/>
								<label class="control-label">Keterangan</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-7">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Perubahan Data Karyawan
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>hro-employee-status-alteration" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('HroEmployeeStatusAlteration/processAddHROEmployeeStatusAlteration',array('id' => 'myform', 'class' => 'horizontal-form')); 

						$unique = $this->session->userdata('unique');

						$data 	= $hroemployeestatusalteration_last;	

						if (empty($data['status_alteration_date'])){
							$data['status_alteration_date'] = date('d-m-Y');
						}

						if (empty($data['status_alteration_last_date'])){
							$data['status_alteration_last_date'] = date('d-m-Y');
						}
						if (empty($data['status_alteration_description'])){
							$data['status_alteration_description'] = "";
						}
						if (empty($data['status_alteration_remark'])){
							$data['status_alteration_remark'] = "";
						}
						if (empty($data['employee_employment_status'])){
							$data['employee_employment_status'] = "";
						}

					?>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" class="form-control" value="<?php echo $hroemployeedata['employee_name']?>">
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_code" id="employee_code" class="form-control" value="<?php echo $hroemployeedata['employee_code']?>">
								<label class="control-label">Kode Karyawan</label>
							</div>
						</div>
					</div>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('region_id', $coreregion, set_value('region_id', $data['region_id']),'id="region_id" class="form-control select2me"');
								?>
								<label class="control-label">Nama Wilayah
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['region_id'])){
										$corebranch = create_double($this->HroEmployeeStatusAlteration_model->getCoreBranchDD($data['region_id']), 'branch_id', 'branch_name');

										echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $data['branch_id']), 'id="branch_id" class="form-control select2me"');	
									} else {
								?>
									<select name="branch_id" id="branch_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);">
										<option value=""></option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Nama Cabang
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['branch_id'])){
										$corelocation = create_double($this->HroEmployeeStatusAlteration_model->getCoreLocationDD($data['branch_id']), 'location_id', 'location_name');

										echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me"');	
									} else {
								?>
									<select name="location_id" id="location_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);">
										<option value=""></option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Nama Lokasi
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('company_id', $corecompany,set_value('company_id',$data['company_id']),'id="company_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
								?>
								<label class="control-label">Nama Perusahaan
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me"');
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
									if (!empty($data['division_id'])){
										$coredepartment = create_double($this->HroEmployeeStatusAlteration_model->getCoreDepartmentDD($data['division_id']), 'department_id', 'department_name');

										echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);">
										<option value=""></option>
									</select>
								<?php
									}
								?>
								<label class="control-label">Nama Departemen
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['department_id'])){
										$coresection = create_double($this->HroEmployeeStatusAlteration_model->getCoreSectionDD($data['department_id']), 'section_id', 'section_name');

										echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" 
											class="form-control select2me"');
									} else {
								?>
									<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);">
										<option value=""></option>
									</select>
								<?php
									}
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
									if (!empty($data['section_id'])){
										$coreunit = create_double($this->HroEmployeeStatusAlteration_model->getCoreUnitDD($data['section_id']), 'unit_id', 'unit_name');

										echo form_dropdown('unit_id', $coreunit,set_value('unit_id',$data['unit_id']),'id="unit_id" class="form-control select2me"');
									} else {
								?>
									<select name="unit_id" id="unit_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);">
										<option value=""></option>
									</select>
								<?php
									}
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
										echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me"');
								?>
								<label class="control-label">Nama Jabatan
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>

					
					<div class="row">	
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $data['grade_id']),'id="grade_id" class="form-control select2me"');
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
									echo form_dropdown('class_id', $coreclass, set_value('class_id', $data['class_id']),'id="class_id" class="form-control select2me"');
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
								<?php 
								if ($data==true) {
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$data['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								} else{
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus,'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								}
								?>
								<label class="control-label">Status Pekerjaan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<!-- <?php print_r($data); ?> -->
								
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="status_alteration_date" id="status_alteration_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo date("d-m-Y");?>">
								<label class="control-label">Tanggal Perubahan Status</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">

								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="status_alteration_last_date" id="status_alteration_last_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo date("d-m-Y");?>">
								<label class="control-label">Perubahan Status Tanggal Terakhir</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="bank_id" id="bank_id" class="form-control" value="<?php echo $data['bank_id'];?>">
								<input type="hidden" name="marital_status_id" id="marital_status_id" class="form-control" value="<?php echo $data['marital_status_id'];?>">
								<input type="hidden" name="applicant_id" id="applicant_id" class="form-control" value="<?php echo $data['applicant_id'];?>">

								<input type="text" name="status_alteration_description" id="status_alteration_description" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Deskripsi</label>
							</div>
						</div>
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="text" name="status_alteration_remark" id="status_alteration_remark" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Keterangan</label>
							</div>
						</div>
						<div class="form-actions right">
							<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
						</div>
						<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id'] ?>">
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- TABLE RECORD -->

<div class="row">
	<div class="col-md-12">	
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
			</div>
			<div class="portlet-body ">
				<!-- BEGIN FORM-->
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Status Pekerjaan</th>
											<th>Tanggal Perubahan Status</th>
											<th>Tanggal Perubahan Status Terakhir</th>
											<th>Deskripsi</th>
											<th>Keterangan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									<?php
										if(!is_array($hroemployeestatusalteration)){
											echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeestatusalteration as $key=>$g){
												echo"
													<tr>
														<td>".$this->configuration->EmployeeStatus()[$g['employee_employment_status']]."</td>
														<td>".tgltoview($g['status_alteration_date'])."</td>
														<td>".tgltoview($g['status_alteration_last_date'])."</td>
														<td>".$g['status_alteration_description']."</td>
														<td>".$g['status_alteration_remark']."</td>
														<td>
														<a href='".$this->config->item('base_url').'hroemployeestatusalteration/deleteHROEmployeeStatusAlteration/'.$g['status_alteration_id'].'/'.$g['employee_employment_status'].'/'.$g['employee_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
															<i class='fa fa-trash-o'></i> Delete</a>";
														echo"
													</tr>
													
												";
											}
										}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

