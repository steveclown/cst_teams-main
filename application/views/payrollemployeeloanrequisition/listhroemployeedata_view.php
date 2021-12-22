<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>payrollemployeeloanrequisition">Employee Loan Requisition</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Employee Loan Requisition List <small>Manage Employee Loan Requisition</small>
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeeloanrequisition" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Employee Name</th>
							<th>Employee Status</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach ($hroemployeedata as $key=>$val){
								echo"
									<tr>	
										<td>".$no."</td>							
										<td>".$val['employee_name']."</td>
										<td>".$this->configuration->EmployeeStatus[$val['employee_employment_status']]."</td>
										<td>
											<a href='".$this->config->item('base_url').'payrollemployeeloanrequisition/addPayrollEmployeeLoanRequisition/'.$val[employee_id]."' class='btn default btn-xs green-jungle'>
												<i class='fa fa-plus'></i> Add
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