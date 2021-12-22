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
		Detail Selected Applicant
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionalrecruitmentemployee" class="btn green yellow-stripe">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							 Back
						</span>
					</a>
				</div>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="<?php echo base_url();?>">
					Master
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionalrecruitmentemployee">
					Recruitment List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Detail Recruitment
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
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
					<i class="fa fa-cogs"></i>Recruitment Details
				</div>
			</div>
			<div class="portlet-body">
				<?php 
					echo form_open('transactionalrecruitmentemployee/delete', array('id' => 'myform', 'class' => 'form-horizontal')); 
				?>		
					<div class="form-group">
						<label class="col-md-3 control-label">Date</label>
						<div class="col-md-8">
							<input type="text" name="applicant_recruitment_date" id="applicant_recruitment_date" value="<?php echo tgltoview($detail['applicant_recruitment_date']);?>" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Due Date</label>
						<div class="col-md-8">
							<input type="text" name="applicant_recruitment_due_date" id="applicant_recruitment_due_date" value="<?php echo tgltoview($detail['applicant_recruitment_due_date']);?>" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Remark</label>
						<div class="col-md-8">
							<textarea rows="5" name="applicant_recruitment_remark" id="applicant_recruitment_remark" class="form-control" readonly><?php echo $detail['applicant_recruitment_remark'];?></textarea>
						</div>
					</div>
				<h3 class="form-section">Detail Applicants</h3>
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
									Job Title
								</th>
								<th>
									Grade
								</th>
								<th>
									Class
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
							</tr>
						</thead>
						<tbody>
						<?php
							// print_r($item);exit;
							foreach ($item as $key=>$val){
								
								echo"
									<tr>									
										<td>".$this->transactionalrecruitmentemployee_model->getapplicantname($val[applicant_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getregionname($val[region_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getbranchname($val[branch_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getdivisionname($val[division_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getdepartmentname($val[department_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getsectionname($val[section_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getlocationname($val[location_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getjobtitlename($val[job_title_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getgradename($val[grade_id])."</td>
										<td>".$this->transactionalrecruitmentemployee_model->getclassname($val[class_id])."</td>
										<td>$val[applicant_recruitment_date]</td>
										<td>$val[applicant_recruitment_due_date]</td>
										<td>".$employeestatus[($val[employee_status])]."</td>
									</tr>
								";
						} ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>