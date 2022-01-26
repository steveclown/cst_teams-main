<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_rfid_code" id="employee_rfid_code" value="<?php echo $HroEmployeeDataCkp['employee_rfid_code'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" readonly>
			<label class="control-label"> Kode RFID Karyawan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_last_day_off" id="employee_last_day_off" onChange="function_elements_edit(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeDataCkp['employee_last_day_off']);?>" readonly/>
			<label class="control-label">Employee Last Day Off</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_day_off_cycle" id="employee_day_off_cycle" value="<?php echo $HroEmployeeDataCkp['employee_day_off_cycle'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" readonly>
			<label class="control-label">Employee Day Off Cycle</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_day_off_status" id="employee_day_off_status" value="<?php echo $dayoffstatus[$HroEmployeeDataCkp['employee_day_off_status']];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" readonly>

			<label class="control-label">Employee Day Off Status</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_employment_working_status" id="employee_employment_working_status" value="<?php echo $HroEmployeeDataCkp['employee_employment_working_status'];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" readonly>
			<label class="control-label">Status Bekerja</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_employment_overtime_status" id="employee_employment_overtime_status" value="<?php echo $overtimestatus[$HroEmployeeDataCkp['employee_employment_overtime_status']];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" readonly>
			<label class="control-label">Status Lembur</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_employment_status" id="employee_employment_status" value="<?php echo $employeestatus[$HroEmployeeDataCkp['employee_employment_status']];?>" class="form-control" onChange="function_elements_edit(this.name, this.value);" readonly>
			<label class="control-label">Status pekerjaan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_edit(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeDataCkp['employee_hire_date']);?>" />
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
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_date" id="employee_employment_status_date" onChange="function_elements_edit(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeDataCkp['employee_employment_status_date']);?>" readonly/>
			<label class="control-label">Employment Status Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_edit(this.name, this.value);" value="<?php echo tgltoview($HroEmployeeDataCkp['employee_employment_status_duedate']);?>" readonly/>
			<label class="control-label">Employement Status Due Date
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

										
