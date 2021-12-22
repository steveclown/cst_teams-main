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

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<div class = "page-bar">
					<ul class="page-breadcrumb ">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>">
								Master
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">
								Extra Leave List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Extra Leave List <small>Manage Extra Leave</small>
				</h1>
				<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i>List
						</div>
						<div class="actions">
							<a href="<?php echo base_url();?>coreextraleave/addCoreExtraLeave" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add New Extra Leave
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
							<thead>
								<tr>
									<th>
										Extra Leave Code
									</th>
									<th>
										Extra Leave Name
									</th>
									<th>
										Extra Leave Range 1
									</th>
									<th>
										Extra Leave Range 2
									</th>
									<th>
										Extra Leave Days
									</th>
									<th width="120px">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($coreextraleave as $key=>$val){
										
										echo"
											<tr>									
												<td>$val[extra_leave_code]</td>
												<td>$val[extra_leave_name]</td>
												<td>$val[extra_leave_range1]</td>
												<td>$val[extra_leave_range2]</td>
												<td>$val[extra_leave_days]</td>
												<td>
													<a href='".$this->config->item('base_url').'coreextraleave/editCoreExtraLeave/'.$val[extra_leave_id]."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'coreextraleave/deleteCoreExtraLeave/'.$val[extra_leave_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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