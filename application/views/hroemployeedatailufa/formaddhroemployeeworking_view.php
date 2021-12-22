<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addhroemployeedatailufa-'.$unique['unique']);
?>		

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$data['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Working Status</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$data['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Overtime Status</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_employment_status', $employeestatus ,set_value('employee_employment_status',$data['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label class="control-label">Employment Status</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_hire_date']);?>"/>
			<label class="control-label">Hire Date
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
			<label class="control-label">Employment Status Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_employment_status_duedate']);?>"/>
			<label class="control-label">Employement Status Due Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

										
