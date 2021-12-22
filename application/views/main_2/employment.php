<div class="form-body form">
	<div class="form-body">
		<h3 class="form-section">Employment</h3>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Probation Date</label>
					<input type="text" name="employee_probation_date" id="employee_probation_date" class="form-control" value="<?php echo tgltoview($hroemployeeemployment[employee_probation_date]);?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Probation Remark</label>
					<textarea name="employee_probation_remark" id="employee_probation_remark" class="form-control" readonly><?php echo $hroemployeeemployment[employee_probation_remark];?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Effective Date</label>
					<input type="text" name="employee_effective_date" id="employee_effective_date" class="form-control" value="<?php echo tgltoview($hroemployeeemployment[employee_effective_date]);?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Effective Remark</label>
					<textarea name="employee_effective_remark" id="employee_effective_remark" class="form-control" readonly><?php echo $hroemployeeemployment[employee_effective_remark];?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Employee Status</label>
					<input type="text" name="employee_status" id="employee_status" class="form-control" value="<?php echo $this->configuration->employeestatus[($hroemployeeemployment[employee_status])];?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Status Date</label>
					<input type="text" name="employee_status_date" id="employee_status_date" class="form-control" value="<?php echo tgltoview($hroemployeeemployment[employee_status_date]);?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Status Count</label>
					<input type="text" name="employee_status_count" id="employee_status_count" class="form-control" value="<?php echo $hroemployeeemployment[employee_status_count];?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Status Due Date</label>
					<input type="text" name="employee_status_due_date" id="employee_status_due_date" class="form-control" value="<?php echo tgltoview($hroemployeeemployment[employee_status_due_date]);?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Working Status</label>
					<input type="text" name="employee_working_status" id="employee_working_status" class="form-control" value="<?php echo $this->configuration->WorkingStatus[($hroemployeeemployment[employee_working_status])];?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Overtime Status</label>
					<input type="text" name="employee_overtime_status" id="employee_overtime_status" class="form-control" value="<?php echo $this->configuration->OvertimeStatus[($hroemployeeemployment[employee_overtime_status])];?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Has Leave Permission</label>
					<input type="text" name="has_leave_permission" id="has_leave_permission" class="form-control" value="<?php echo $this->configuration->HasLeavePermission[($hroemployeeemployment[has_leave_permission])];?>" readonly >
				</div>
			</div>
		</div>
	</div>
</div>