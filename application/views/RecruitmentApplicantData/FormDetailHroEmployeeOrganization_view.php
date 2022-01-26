<script>
	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id = $("#region_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>RecruitmentApplicantData/getCoreBranch",
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
               url  : "<?php echo base_url(); ?>RecruitmentApplicantData/getCoreLocation",
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
               url  : "<?php echo base_url(); ?>RecruitmentApplicantData/getCoreDepartment",
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
               url  : "<?php echo base_url(); ?>RecruitmentApplicantData/getCoreSection",
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
               url  : "<?php echo base_url(); ?>RecruitmentApplicantData/getCoreUnit",
               data : {section_id: section_id},
               success: function(data){
                   $("#unit_id").html(data);                
               }
            });
        });
    });
</script>

<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('recruitRecruitmentApplicantData-'.$unique['unique']);

	if (empty($data['region_id'])) {
		$data['region_id']="";
	}
	if (empty($data['division_id'])) {
		$data['division_id']="";
	}
	if (empty($data['branch_id'])) {
		$data['branch_id']="";
	}
	if (empty($data['job_title_id'])) {
		$data['job_title_id']="";
	}
	if (empty($data['grade_id'])) {
		$data['grade_id']="";
	}
	if (empty($data['class_id'])) {
		$data['class_id']="";
	}
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('region_id', $coreregion, set_value('region_id', $data['region_id']),'id="region_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
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
					$corebranch = create_double($this->RecruitmentApplicantData_model->getCoreBranch($data['region_id']), 'branch_id', 'branch_name');

					echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $data['branch_id']), 'id="branch_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');	
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
</div>	

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				if (!empty($data['branch_id'])){
					$corelocation = create_double($this->RecruitmentApplicantData_model->getCoreLocation($data['branch_id']), 'location_id', 'location_name');

					echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');	
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
</div>							
				
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
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
					$coredepartment = create_double($this->RecruitmentApplicantData_model->getCoreDepartment($data['division_id']), 'department_id', 'department_name');

					echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
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
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				if (!empty($data['department_id'])){
					$coresection = create_double($this->RecruitmentApplicantData_model->getCoreSection($data['department_id']), 'section_id', 'section_name');

					echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" 
						class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
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
					$coreunit = create_double($this->RecruitmentApplicantData_model->getCoreUnit($data['section_id']), 'unit_id', 'unit_name');

					echo form_dropdown('unit_id', $coreunit,set_value('unit_id',$data['unit_id']),'id="unit_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
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
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);" ');
			?>
			<label class="control-label">Nama Jabatan
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
				echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $data['grade_id']),'id="grade_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
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
			<input type="hidden" id="applicant_status_remark" name="applicant_status_remark" value="<?php echo $RecruitmentApplicantData['applicant_status_remark'];?>">
			
			<input type="hidden" id="applicant_status_remark_date" name="applicant_status_remark_date" value="<?php echo $RecruitmentApplicantData['applicant_status_remark_date'];?>">
			
			<?php
				echo form_dropdown('class_id', $coreclass,set_value('class_id',$data['class_id']),'id="class_id" class="form-control select2me" onChange="function_elements_recruit(this.name, this.value);"');
			?>
			<label class="control-label">Nama Kelas
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>
<br>
<br>
<div class="row">
	<div class = "col-md-3">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_code" id="employee_code" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Kode Karyawan
			<span class="required">*</span>
			</label>
		</div>
	</div>

	<div class = "col-md-3">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_rfid_code" id="employee_rfid_code" class="form-control" onChange="function_elements_add(this.name, this.value);">
			<label class="control-label">Kode Rfid
			<span class="required">*</span>
			</label>
		</div>
	</div>
	
	<div class = "col-md-3">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_employment_status', $workingstatus ,set_value('employee_employment_status',$data['employee_employment_status']),'id="employee_employment_status", class="form-control select2me"');?>
			<label class="control-label">Status Pegawai
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-3">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$data['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me"');?>
			<label class="control-label">Status Pekerjaan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$data['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me"');?>
			<label class="control-label">Status Lembur
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate"/>
			<label class="control-label">Tanggal Berakhir
			</label>
		</div>
	</div>
</div>

										