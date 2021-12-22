
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
						<a href="<?php echo base_url();?>payrolldailyperiod">
							Daily Period List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daily Period List <small>Manage Daily Period Title</small>
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
						<a href="<?php echo base_url();?>payrolldailyperiod/addPayrollDailyPeriod" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add Daily Period
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width = "20%">
									Daily Period Start Date
								</th>
								<th width = "20%">
									Daily Period End Date
								</th>
								<th width = "20%">
									Daily Period Working Days
								</th>
								<th width = "20%">
									Daily Period Include BPJS
								</th>
								<th  width = "20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($payrolldailyperiod as $key=>$val){
									
									echo"
										<tr>	
											<td>".tgltoview($val['daily_period_start_date'])."</td>
											<td>".tgltoview($val['daily_period_end_date'])."</td>
											<td>".$val['daily_period_working_days']."</td>
											<td>".$this->configuration->IncludeBPJS[$val['daily_period_include_bpjs']]."</td>
											<td>
												<a href='".$this->config->item('base_url').'payrolldailyperiod/deletePayrollDailyPeriod/'.$val['daily_period_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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