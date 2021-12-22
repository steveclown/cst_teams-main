<style>
	input[type="text"] {
		height:30px !important; 
		width:50% !important;
		margin : 0 auto;
	}
	th{
		font-size:12px  !important;
		font-weight: normal !important;
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
	
	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
</style>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<h3 class="page-title">
			Paid Long Leave List
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li class="btn-group">
					<div class="actions">
						<a href="<?php echo base_url();?>trpaidlongleave/Add" class="btn green yellow-stripe">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
								 Add Paid Long Leave
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
					<a href="<?php echo base_url();?>trpaidlongleave">
						Paid Long Leave List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
</div>
<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
					<thead>
					<tr>
						<th width="25%">
							Employee Name
						</th>
						<th width="25%">
							Annual Leave Balance
						</th>
						<th width="25%">
							Total
						</th>
						<th width="25%">
							Date
						</th>
						<th width="25%">
							Remark
						</th>
						<th width="25%">
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach ($trpaidlongleave as $key=>$val){
							
							echo"
								<tr>									
									<td>".$this->trpaidlongleave_model->getemployeename($val[employee_id])."</td>
									<td>$val[annual_leave_balance]</td>
									<td>$val[paid_long_leave_total]</td>
									<td>$val[paid_long_leave_date]</td>
									<td>$val[paid_long_leave_remark]</td>
									<td>
										<a href='".$this->config->item('base_url').'trpaidlongleave/Edit/'.$val[paid_long_leave_id]."' class='btn default btn-xs yellow'>
											<i class='fa fa-edit'></i> Edit
										</a>
										<a href='".$this->config->item('base_url').'trpaidlongleave/delete/'.$val[paid_long_leave_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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