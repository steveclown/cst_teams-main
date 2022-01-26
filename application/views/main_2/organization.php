<div class="form-body form">
	<div class="form-body">
		<h3 class="form-section">Organization</h3>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Region</label>
					<input type="text" autocomplete="off"  name="region_id" id="region_id" class="form-control" value="<?php echo $this->main_model->getRegionName($hroemployeeorganization[region_id]); ?>" readonly>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Branch:</label>
					<input type="text" autocomplete="off"  name="branch_id" id="branch_id" class="form-control" value="<?php echo $this->main_model->getBranchName($hroemployeeorganization[branch_id]); ?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Division:</label>
					<input type="text" autocomplete="off"  name="division_id" id="division_id" class="form-control" value="<?php echo $this->main_model->getDivisionName($hroemployeeorganization[division_id])?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Department:</label>
					<input type="text" autocomplete="off"  name="department_id" id="department_id" class="form-control" value="<?php echo $this->main_model->getDepartmentName($hroemployeeorganization[department_id]);?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Section:</label>
					<input type="text" autocomplete="off"  name="section_id" id="section_id" class="form-control" value="<?php echo $this->main_model->getSectionName($hroemployeeorganization[section_id])?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Job Title:</label>
					<input type="text" autocomplete="off"  name="job_title_id" id="job_title_id" class="form-control" value="<?php echo $this->main_model->getJobTitleName($hroemployeeorganization[job_title_id])?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Grade:</label>
					<input type="text" autocomplete="off"  name="grade_id" id="grade_id" class="form-control" value="<?php echo $this->main_model->getGradeName($hroemployeeorganization[grade_id])?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Class:</label>
					<input type="text" autocomplete="off"  name="class_id" id="class_id" class="form-control" value="<?php echo $this->main_model->getClassName($hroemployeeorganization[class_id])?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Location:</label>
					<input type="text" autocomplete="off"  name="location_id" id="location_id" class="form-control" value="<?php echo $this->main_model->getLocationName($hroemployeeorganization[location_id])?>" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Shift:</label>
					<input type="text" autocomplete="off"  name="shift_id" id="shift_id" class="form-control" value="<?php echo $this->main_model->getShiftName($hroemployeeorganization[shift_id])?>" readonly >
				</div>
			</div>
		</div>
	</div>
</div>