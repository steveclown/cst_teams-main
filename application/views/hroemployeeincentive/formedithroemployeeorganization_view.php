<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_incentive(){
		document.location = base_url+"hroemployeeincentive/reset_add_incentive/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add_incentive(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeincentive/function_elements_add_incentive');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id 	= $("#region_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreBranch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id 	= $("#branch_id").val();
 
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });


</script>
		
<?php 
	echo form_open('hroemployeeincentive/processAddHROEmployeeIncentive',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 			= $this->session->userdata('unique');
	
	$dataorganization	= $this->session->userdata('addhroemployeeorganization-'.$unique['unique']);

	if (empty($dataorganization)){
		$dataorganization['employee_incentive_date']	= date("Y-m-d");
	}
?>
<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_incentive_date" id="employee_incentive_date" onChange="function_elements_add_incentive(this.name, this.value);" value="<?php echo tgltoview($dataorganization['employee_incentive_date']);?>"/>
			<label class="control-label">Incentive Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="region_id_last" id="region_id_last" value="<?php echo $this->hroemployeeincentive_model->getRegionName($hroemployeeincentive_last['region_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Region </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('region_id', $coreregion, $dataorganization['region_id'], 'id ="region_id", class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);"');?>
			<label class="control-label">Region
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="branch_id_last" id="branch_id_last" value="<?php echo $this->hroemployeeincentive_model->getBranchName($hroemployeeincentive_last['branch_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Branch </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<select name="branch_id" id="branch_id" class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);">
				<option value="">--Choose Item--</option>
			</select>
			<label class="control-label">Branch
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="location_id_last" id="location_id_last" value="<?php echo $this->hroemployeeincentive_model->getLocationName($hroemployeeincentive_last['location_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Region </label>
		</div>
	</div>	

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<select name="location_id" id="location_id" class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);">
				<option value="">--Choose Item--</option>
			</select>
			<label class="control-label">Location
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="division_id_last" id="division_id_last" value="<?php echo $this->hroemployeeincentive_model->getSectionName($hroemployeeincentive_last['division_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Division</label>
		</div>
	</div>	

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('division_id', $coredivision, $dataorganization['division_id'], 'id ="division_id", class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);"');?>
			<label class="control-label">Division
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="department_id_last" id="department_id_last" value="<?php echo $this->hroemployeeincentive_model->getDepartmentName($hroemployeeincentive_last['department_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Department</label>
		</div>
	</div>		

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);">
				<option value="">--Choose Item--</option>
			</select>
			<label class="control-label">Department
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="section_id_last" id="section_id_last" value="<?php echo $this->hroemployeeincentive_model->getSectionName($hroemployeeincentive_last['section_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Section</label>
		</div>
	</div>	

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);">
				<option value="">--Choose Item--</option>
			</select>
			<label class="control-label">Section
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="job_title_id_last" id="job_title_id_last" value="<?php echo $this->hroemployeeincentive_model->getJobTitleName($hroemployeeincentive_last['job_title_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Job Title</label>
		</div>
	</div>	

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('job_title_id', $corejobtitle, $dataorganization['job_title_id'], 'id ="job_title_id", class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);"');?>
			<label class="control-label">Job Title
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="grade_id_last" id="grade_id_last" value="<?php echo $this->hroemployeeincentive_model->getGradeName($hroemployeeincentive_last['grade_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Grade</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('grade_id', $coregrade, $dataorganization['grade_id'], 'id ="grade_id_incentive", class="form-control select2me " onChange="function_elements_add_incentive(this.name, this.value);"');?>
			<label class="control-label">Grade
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class ="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="class_id_last" id="class_id_last" value="<?php echo $this->hroemployeeincentive_model->getClassName($hroemployeeincentive_last['class_id'])?>" class="form-control" readonly>
			<label class="control-label">Last Class</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('class_id', $coreclass, $dataorganization['class_id'], 'id ="class_id", class="form-control select2me " onChange="function_elements_add_incentive(this.name, this.value);"');?>
			<label class="col-md-3 control-label">Class
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
			<textarea rows="3" name="employee_incentive_remark" id="employee_incentive_remark" onChange="function_elements_add_incentive(this.name, this.value);" class="form-control"><?php echo $dataorganization['employee_incentive_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_incentive();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>
							
<table class="table table-bordered table-advance table-hover">
	<thead>
		<tr>
			<th style='text-align:center' width="5%">No.</th>
			<th style='text-align:center' width="9%">Region Name</th>
			<th style='text-align:center' width="9%">Branch Name</th>
			<th style='text-align:center' width="9%">Location Name</th>
			<th style='text-align:center' width="9%">Division Name</th>
			<th style='text-align:center' width="9%">Department Name</th>
			<th style='text-align:center' width="9%">Section Name</th>
			<th style='text-align:center' width="9%">Job Title Name</th>
			<th style='text-align:center' width="9%">Grade Name</th>
			<th style='text-align:center' width="9%">Class Name</th>
			<!-- <th style='text-align:center'>Action</th> -->
		</tr>
	</thead>
	<tbody>
		<?php
			$no = 1;
			if(!empty($hroemployeeincentive_data)){
				foreach($hroemployeeincentive_data as $key=>$val){
					echo"
						<tr class='odd gradeX'>
							<td style='text-align:center'>$no.</td>
							<td>".$this->hroemployeeincentive_model->getRegionName($val['region_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getBranchName($val['branch_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getLocationName($val['location_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getDivisionName($val['division_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getDepartmentName($val['department_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getSectionName($val['section_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getJobTitleName($val['job_title_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getGradeName($val['grade_id'])."</td>
							<td>".$this->hroemployeeincentive_model->getClassName($val['class_id'])."</td>
							
						</tr>
					";
					$no++;
				}
			}else{
				echo"
					<tr class='odd gradeX'>
						<td colspan='12' style='text-align:center;'>
							<b>No Data</b>
						</td>
					</tr>
				";
			}
		?>		
	<tbody>
</table>