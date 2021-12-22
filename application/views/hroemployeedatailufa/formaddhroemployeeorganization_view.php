<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addhroemployeedatailufa-'.$unique['unique']);
?>

<script>
	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeedatailufa/getCoreDepartment",
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
               url  : "<?php echo base_url(); ?>hroemployeedatailufa/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeedatailufa/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);				   
               }
            });
        });
    });

</script>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('branch_id', $corebranch, set_value('branch_id', $data['branch_id']), 'id="branch_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Branch Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class="col-md-6 ">
		<div class="form-group form-md-line-input">
			<?php
				if (!empty($data['branch_id'])){
					$corelocation = create_double($this->hroemployeedatailufa_model->getCoreLocation($data['branch_id']), 'location_id', 'location_name');

					echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
				} else {
			?>
				<select name="location_id" id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
					<option value="">--Choose Item--</option>
				</select>
			<?php
				}
			?>
			
			<label class="control-label">Location Name</label>
		</div>
	</div>
</div>				
				
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Division Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class="col-md-6 ">
		<div class="form-group form-md-line-input">
			<?php
				if (!empty($data['division_id'])){
					$coredepartment = create_double($this->hroemployeedatailufa_model->getCoreDepartment($data['division_id']), 'department_id', 'department_name');

					echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']), 'id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
				} else {
			?>
				<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
					<option value="">--Choose Item--</option>
				</select>
			<?php
				}
			?>
			
			<label class="control-label">Department Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-6 ">
		<div class="form-group form-md-line-input">
			<?php
				if (!empty($data['department_id'])){
					$coresection = create_double($this->hroemployeedatailufa_model->getCoreSection($data['department_id']), 'section_id', 'section_name');

					echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
				} else {
			?>
				<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
					<option value="">--Choose Item--</option>
				</select>
			<?php
				}
			?>
			
			<label class="control-label">Section Name</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('job_title_id', $corejobtitle,set_value('job_title_id',$data['job_title_id']),'id="job_title_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);" ');
			?>
			<label class="control-label">Job Title Name
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

			<label class="control-label">Grade Name
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
			<label class="control-label">Class Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

										