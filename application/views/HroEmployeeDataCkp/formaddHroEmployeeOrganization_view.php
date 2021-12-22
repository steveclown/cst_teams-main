<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addhroemployeedatackp-'.$unique['unique']);

	if (empty($data['division_id'])) {
		$data['division_id']="";
		# code...
	}
	if (empty($data['department_id'])) {
		$data['department_id']="";
		# code...
	}
	if (empty($data['section_id'])) {
		$data['section_id']="";
		# code...
	}
	if (empty($data['unit_id'])) {
		$data['unit_id']="";
		# code...
	}
	if (empty($data['job_title_id'])) {
		$data['job_title_id']="";
		# code...
	}
	if (empty($data['grade_id'])) {
		$data['grade_id']="";
		# code...
	}
	if (empty($data['class_id'])) {
		$data['class_id']="";
		# code...
	}
?>
				
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
				echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
				echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
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
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);" ');
			?>
			<label class="control-label">Nama Pekerjaan
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
				echo form_dropdown('grade_id', $coregrade, set_value('grade_id', $data['grade_id']),'id="grade_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>

			<label class="control-label">Nama Pangkat
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('class_id', $coreclass,set_value('class_id',$data['class_id']),'id="class_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Nama Kelas
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

										