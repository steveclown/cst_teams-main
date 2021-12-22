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

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"payrollemployeemonthlyilufa/reset_search";
	}
</script>

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
						<a href="<?php echo base_url();?>payrollemployeemonthlyilufa">
							Payroll Employee Monthly Period List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Payroll Employee Monthly Period List <small>Manage Payroll Employee Monthly Period</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->



<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th>
									Monthly Period
								</th>
								<th>
									Start Date
								</th>
								<th>
									End Date
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($payrollemployeemonthlyperiod as $key=>$val){
									/*<a href='".$this->config->item('base_url').'payrollemployeemonthly/editPayrollEmployeeAllowance/'.$val['employee_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>*/
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_monthly_period']."</td>
											<td>".tgltoview($val['employee_monthly_start_date'])."</td>
											<td>".tgltoview($val['employee_monthly_end_date'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'payrollemployeemonthlyilufa/printSalaryReceipt/'.$val['employee_monthly_period']."' class='btn default btn-xs grey-gallery'>
													<i class='fa fa-print'></i> Print Receipt
												</a>
												<a href='".$this->config->item('base_url').'payrollemployeemonthlyilufa/showdetail/'.$val['employee_monthly_period']."' class='btn default btn-xs yellow'>
													<i class='fa fa-bars'></i> Detail
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