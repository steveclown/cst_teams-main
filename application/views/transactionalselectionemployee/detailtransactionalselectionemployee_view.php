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
					<a href="<?php echo base_url();?>transactionalselectionemployee" class="btn green yellow-stripe">
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
				<a href="<?php echo base_url();?>transactionalselectionemployee">
					Selection List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Detail Selection
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
					<i class="fa fa-cogs"></i>Selection Details
				</div>
			</div>
			<div class="portlet-body">
				<?php 
					echo form_open('transactionalselectionemployee/delete', array('id' => 'myform', 'class' => 'form-horizontal')); 
				?>
					<div class="form-group">
						<label class="col-md-3 control-label">Date</label>
						<div class="col-md-8">
							<input type="text" name="applicant_selection_date" id="applicant_selection_date" value="<?php echo $detail['applicant_selection_date'];?>" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Interview Date</label>
						<div class="col-md-8">
							<input type="text" name="applicant_selection_interview_date" id="applicant_selection_interview_date" value="<?php echo $detail['applicant_selection_interview_date'];?>" class="form-control" readonly>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Remark</label>
						<div class="col-md-8">
							<textarea rows="5" name="applicant_selection_remark" id="applicant_selection_remark" class="form-control" readonly><?php echo $detail['applicant_selection_remark'];?></textarea>
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
									Interview Date
								</th>
								<th>
									Status
								</th>
								<th>
									Recruited Date
								</th>
							</tr>
						</thead>
						<tbody>
						<?php
							// print_r($item);exit;
							foreach ($item as $key=>$val){
								
								echo"
									<tr>									
										<td>".$this->transactionalselectionemployee_model->getapplicantname($val[applicant_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getregionname($val[region_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getbranchname($val[branch_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getdivisionname($val[division_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getdepartmentname($val[department_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getsectionname($val[section_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getlocationname($val[location_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getjobtitlename($val[job_title_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getgradename($val[grade_id])."</td>
										<td>".$this->transactionalselectionemployee_model->getclassname($val[class_id])."</td>
										<td>$val[applicant_selection_interview_date]</td>
										<td>".$selectionstatus[($val[applicant_selection_status])]."</td>
										<td>$val[applicant_selection_recruited_date]</td>
									</tr>
								";
						} ?>
						</tbody>
					</table>
				</div>
				<div class="form-actions right">
					<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
					<a <?php if($detail['applicant_selection_status']=='0'){echo"href='#void'";}else if($detail['applicant_selection_status']=='1'){echo"href='#cannotvoid'";} ?> class="btn red" data-toggle="modal">
						<i class="fa fa-times"></i> Void
					</a>
				</div>
				<input type="hidden" name="applicant_selection_id" value="<?php echo $detail[applicant_selection_id];?>">
				<input type="hidden" name="applicant_request_id" value="<?php echo $detail[applicant_request_id];?>">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="void" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Action Confirmation</h4>
			</div>
			<div class="modal-body">
				Are you sure you want to void this entry ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn red"></i><i class="fa fa-times"></i> Void</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="cannotvoid" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Action Impossible</h4>
			</div>
			<div class="modal-body">
				This selection is already recruited. You cannot void this entry, you have to void the corresponding recruitment applicant first !!!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
