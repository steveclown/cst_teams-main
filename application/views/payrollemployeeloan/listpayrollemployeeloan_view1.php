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
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Employee Loan List <small>Manage Employee Loan</small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeeloan/add" class="btn green yellow-stripe">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							 Add Employee Loan
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
				<a href="#">
					Employee Loan List
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
							<th>Employee</th>
							<th>Loan Description</th> 
							<th>Address</th>
							<th>Installment Payment Period</th>
							<th>Installment Payment Total</th>
							<th>Loan Amount Total</th>
							<th>Loan Amount</th>
							<th width="120px">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($hroemployeeloan as $key=>$val){								
								echo"
									<tr>									
										<td>".$this->hroemployeeloan_model->getemployeename($val['employee_id'])."</td>
										<td>".$val['employee_loan_period']."</td>
										<td>".$val['installment_payment_period']."</td>
										<td>".nominal($val['installment_payment_total'])."</td>
										<td>".nominal($val['employee_loan_amount_total'])."</td>
										<td>".nominal($val['employee_loan_amount'])."</td>
										<td>
											<a href='".$this->config->item('base_url').'hroemployeeloan/Edit/'.$val[employee_loan_id]."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
											<a href='".$this->config->item('base_url').'hroemployeeloan/delete/'.$val[employee_loan_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Delete
											</a>
										</td>
									</tr>
								";
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
			<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<?php echo form_close(); ?>	