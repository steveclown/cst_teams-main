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
</style>

<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">
		Add Recruitment Applicant
		</h3>
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Add Recruitment Applicant
				</div>
			</div>
			<div class="portlet-body">
				<?php 
					echo form_open('transactionalrecruitmentemployee/processaddtransactionalrecruitmentemployee', array('id' => 'myform', 'class' => 'form-horizontal'));
					$auth	= $this->session->userdata('auth');
				?>
				<div class="form-group">
					<label class="col-md-3 control-label">Recruitment Date</label>
					<div class="col-md-8">
						<div class='input-group input-medium date date-picker' data-date='<?php echo date('Y-m-d');?>' data-date-format='yyyy-mm-dd' data-date-viewmode='years'>
								<input type='text' name='applicant_recruitment_date' id='applicant_recruitment_date' class='form-control'readonly>
								<span class='input-group-btn'>
									<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
								</span>
						</div>
						<span class='help-block'>
							 Select date
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Due Date</label>
					<div class="col-md-8">
						<div class='input-group input-medium date date-picker' data-date='<?php echo date('Y-m-d');?>' data-date-format='yyyy-mm-dd' data-date-viewmode='years'>
								<input type='text' name='applicant_recruitment_due_date' id='applicant_recruitment_due_date' class='form-control'readonly>
								<span class='input-group-btn'>
									<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
								</span>
						</div>
						<span class='help-block'>
							 Select date
						</span>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-3 control-label">Remark</label>
					<div class="col-md-8">
						<textarea rows='5' name='applicant_recruitment_remark' id='applicant_recruitment_remark' class='form-control' placeholder='Remark' ></textarea>
					</div>
				</div>
			<h3 class="form-section">Detail Selection Applicant</h3>
				<div class="table-scrollable">
					<table class="table table-striped table-bordered table-hover table-full-width">
						<thead>
							<tr>
								<th>
									Applicant Name
								</th>
								<th>
									Region
								</th>
								<th>
									Branch
								</th>
								<th>
									Division
								</th>												
								<th>
									Department
								</th>												
								<th>
									Section
								</th>
								<th>
									Location
								</th>
								<th>
									Jobtitle
								</th>
								<th>
									Grade
								</th>
								<th>
									Class
								</th>
								<th>
									Shift
								</th>
								<th>
									Date
								</th>
								<th>
									Due Date
								</th>
								<th>
									Employee Status
								</th>
								<th>
									Recruited
								</th>
							</tr>
						</thead>   
						<tbody>
						<?php
							if(!empty($selectionemployee_item)){
								// print_r($selectionemployee_item);exit;
								foreach ($selectionemployee_item as $key=>$val){
									
									echo"
										<tr class='odd gradeX'>
											<td><input type='text' name='applicant_name' value='".$this->transactionalrecruitmentemployee_model->getapplicantname($val[applicant_id])."' class='form-control' readonly><input type='hidden' name='applicant_id_".$val[applicant_id]."' value='".$val[applicant_id]."' readonly></td>
											<td>".form_dropdown('region_id_'.$val['applicant_id'], $region, $val['region_id'], 'id ="region_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('branch_id_'.$val['applicant_id'], $branch, $val['branch_id'], 'id ="branch_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('division_id_'.$val['applicant_id'], $division, $val['division_id'], 'id ="division_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('department_id_'.$val['applicant_id'], $department, $val['department_id'], 'id ="department_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('section_id_'.$val['applicant_id'], $section, $val['section_id'], 'id ="section_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('location_id_'.$val['applicant_id'], $location, $val['location_id'], 'id ="location_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('job_title_id_'.$val['applicant_id'], $location, $val['job_title_id'], 'id ="job_title_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('grade_id_'.$val['applicant_id'], $location, $val['grade_id'], 'id ="grade_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('class_id_'.$val['applicant_id'], $location, $val['class_id'], 'id ="class_id", class="form-control select2me"')."</td>
											<td>".form_dropdown('shift_id_'.$val['applicant_id'], $shift, $val['shift_id'], 'id ="shift_id", class="form-control select2me"')."</td>
											<td>
											<div class='input-group input-medium date date-picker' data-date='".date('Y-m-d')."' data-date-format='yyyy-mm-dd' data-date-viewmode='years'>
													<input type='text' name='applicant_recruitment_date_".$val['applicant_id']."' id='applicant_recruitment_date' class='form-control'readonly>
													<span class='input-group-btn'>
														<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
													</span>
											</div>
											</td>
											<td>
											<div class='input-group input-medium date date-picker' data-date='".date('Y-m-d')."' data-date-format='yyyy-mm-dd' data-date-viewmode='years'>
													<input type='text' name='applicant_recruitment_due_date_".$val['applicant_id']."' id='applicant_recruitment_due_date' class='form-control'readonly>
													<span class='input-group-btn'>
														<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
													</span>
											</div>
											</td>
											<td>".form_dropdown('employee_status_'.$val['applicant_id'], $employeestatus, $val['employee_status'], 'id ="employee_status", class="form-control select2me"')."</td>
											<td>".form_dropdown('recruitment_status_'.$val['applicant_id'], $recruitmentstatus, '1', 'id ="recruitmentstatus", class="form-control select2me"')."</td>
										</tr>
									";
								} 
							}else{
								echo "	<tr class='odd gradeX'>
											<td colspan='13' style='text-align:center;'>No Data Available</td>
										</tr>
									";						
							}
							?>
						</tbody>
					</table>
				</div>
				<div class="form-actions right">
					<a href='#confirm' class="btn blue" data-toggle="modal">
						<i class="fa fa-check"></i> Save
					</a>
					<!--<button type="submit" class="btn green"></i><i class="fa fa-plus"></i> Add</button>-->
					<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
				</div>
				<input type="hidden" name="applicant_selection_id" value="<?php echo $selection_id;?>">
				<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
				<input type="hidden" name="created_by" value="<?php echo $auth[username];?>">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="confirm" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Action Confirmation</h4>
			</div>
			<div class="modal-body">
				Are you sure this data is valid to be saved ???
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn blue"></i><i class="fa fa-check"></i> Save</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
