<style>
	th{
		font-size: 12px  !important;
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
?>

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<div class = "page-bar">
					<ul class="page-breadcrumb">
						<li>
							<a href="<?php echo base_url();?>">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>coreovertimerounded">
								Overtime Rounded List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Overtime Rounded List <small>Manage Overtime Rouded</small>
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
							<a href="<?php echo base_url();?>coreovertimerounded/addCoreOvertimeRounded" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add New Overtime Rounded
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
							<thead>
								<tr>
									<th>
										Overtime Minute Range 1
									</th>
									<th>
										Overtime Minute Range 2
									</th>
									<th>
										Overtime Minute Rounded 
									</th>
									<th width="120px">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($coreovertimerounded as $key=>$val){
										
										echo"
											<tr>									
												<td>$val[overtime_minute_range1]</td>
												<td>$val[overtime_minute_range2]</td>
												<td>$val[overtime_minute_rounded]</td>
												<td>
													<a href='".$this->config->item('base_url').'coreovertimerounded/editCoreOvertimeRounded/'.$val[overtime_rounded_id]."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'coreovertimerounded/deleteCoreOvertimeRounded/'.$val[overtime_rounded_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
													</a>
												</td>
											</tr>
										";
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
	<?php echo form_close(); ?>	