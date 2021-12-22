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
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;	
		border-radius: 3px;
	}
</style>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	echo form_open('transactionalrequestemployee/confirmvoid', array('id' => 'myform', 'class' => 'form-horizontal')); 
?>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">
		Detail Void Request Applicant
		</h3>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Request Details
				</div>
			</div>
			<div class="portlet-body">
				<div class="row static-info">
					<div class="col-md-5 name">
						 Region
					</div>
					<div class="col-md-7 value">
						 <?php echo $this->transactionalrequestemployee_model->getregionname($detail[region_id]);?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Branch
					</div>
					<div class="col-md-7 value">
						 <?php echo $this->transactionalrequestemployee_model->getbranchname($detail[branch_id]);?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Division
					</div>
					<div class="col-md-7 value">
						 <?php echo $this->transactionalrequestemployee_model->getdivisionname($detail[division_id]);?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Department
					</div>
					<div class="col-md-7 value">
						 <?php echo $this->transactionalrequestemployee_model->getdepartmentname($detail[department_id]);?>
					</div>
				</div>				
				<div class="row static-info">
					<div class="col-md-5 name">
						 Section
					</div>
					<div class="col-md-7 value">
						 <?php echo $this->transactionalrequestemployee_model->getsectionname($detail[section_id]);?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Location
					</div>
					<div class="col-md-7 value">
						 <?php echo $this->transactionalrequestemployee_model->getlocationname($detail[location_id]);?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Request Date
					</div>
					<div class="col-md-7 value">
						 <?php echo $detail[applicant_request_date];?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Request Due Date
					</div>
					<div class="col-md-7 value">
						 <?php echo $detail[applicant_request_due_date];?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Title
					</div>
					<div class="col-md-7 value">
						 <?php echo $detail[applicant_request_title];?>
					</div>
				</div>
				<div class="row static-info">
					<div class="col-md-5 name">
						 Remark
					</div>
					<div class="col-md-7 value">
						 <?php echo $detail[applicant_request_remark];?>
					</div>
				</div>
				<h3 class="form-section">Detail Applicants</h3>
				<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
					<thead>
						<tr>
							<th>
								Applicant Name
							</th>
							<th>
								Status
							</th>
						</tr>
					</thead>
					<tbody>
					<?php
						// print_r($item);exit;
						foreach ($item as $key=>$val){
							
							echo"
								<tr>									
									<td>".$this->transactionalrequestemployee_model->getapplicantname($val[applicant_id])."</td>
									<td>".$requeststatus[($val[applicant_request_status])]."</td>
								</tr>
							";
					} ?>
					</tbody>
				</table>
				<div class="form-actions right">
					<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
					<a href="#void" class="btn red" data-toggle="modal">
						<i class="fa fa-times"></i> Void
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="applicant_request_id" value="<?php echo $detail[applicant_request_id];?>">

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
<?php echo form_close(); ?>