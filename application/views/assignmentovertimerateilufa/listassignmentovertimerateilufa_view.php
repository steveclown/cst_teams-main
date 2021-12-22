
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	<div class = "page-bar">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<ul class="page-breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">
					Home
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>assignmentovertimerateilufa">
					Overtime Rate List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h1 class="page-title">
		Overtime Rate List <small>Manage Overtime Rate</small>
	</h1>
	<!-- END PAGE TITLE & BREADCRUMB-->

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>assignmentovertimerateilufa/addAssignmentOvertimeRate" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Overtime Rate
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th width="10%">
									Job Title
								</th>
								<th width="15%">
									Overtime Rate Description
								</th>
								<th width="10%">
									Effective Date
								</th>
								<th width="10%">
									Overtime Rate Amount (Day)
								</th>
								<th width="10%">
									Overtime Rate Amount
								</th>
								<th width="15%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($assignmentovertimerateilufa as $key=>$val){
									
									echo"
										<tr>		
											<td>".$no."</td>
											<td>".$val['job_title_name']."</td>
											<td>".$val['overtime_rate_description']."</td>
											<td>".tgltoview($val['overtime_rate_effective_date'])."</td>
											<td>".nominal($val['overtime_rate_amount'])."</td>
											<td>".nominal($val['overtime_rate_trip_amount'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'assignmentovertimerateilufa/editAssignmentOvertimeRate/'.$val['overtime_rate_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'assignmentovertimerateilufa/deleteAssignmentOvertimeRate/'.$val['overtime_rate_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Delete
												</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>