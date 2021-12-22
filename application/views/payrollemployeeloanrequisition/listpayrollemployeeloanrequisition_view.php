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
<?php
$sesi	= 	$this->session->userdata('filter-payrollemployeeloanrequisition');
if(!is_array($sesi)){
	$sesi['division_id']		= '';
	$sesi['department_id']		= '';
	$sesi['section_id']			= '';
	$sesi['status']				= '';	
}
$statusfilter	= array(""=>"All", 0=>"Draft", 2=>"Reject");
?>
<!-- END PAGE TITLE & BREADCRUMB-->		
<?php echo form_open('payrollemployeeloanrequisition/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Division</label>
							</div>	
						</div>
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('department_id', $coredepartment, set_value('department_id',$data['department_id']),'id="department_id" class="form-control select2me" ');
								?>
								<label class="control-label">Department</label>
							</div>	
						</div>
					</div>
					
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me" ');
								?>
								<label class="control-label">Section </label>
							</div>	
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('status', $statusfilter,$sesi['status'],'id="status" class="form-control select2me"');
								?>
								<label class="control-label">Status </label>
							</div>	
						</div> 
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeeloanrequisition/searchHroEmployeeData" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Add Employee Loan Requisition</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Employee Name</th>
							<th>Division Name</th>
							<th>Department Name</th>
							<th>Section Name</th>
							<th>Employee Loan Requisition Date</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach ($payrollemployeeloanrequisition as $key=>$val){
								echo"
									<tr>	
										<td>".$no."</td>							
										<td>$val[employee_name]</td>
										<td>$val[division_name]</td>
										<td>$val[department_name]</td>
										<td>$val[section_name]</td>
										<td>$val[employee_loan_requisition_date]</td>
										<td>";
										if($val['employee_loan_requisition_status']==0){
											echo "
											<a href='".$this->config->item('base_url').'payrollemployeeloanrequisition/approvedPayrollEmployeeLoanRequisition/'.$val[employee_loan_requisition_id]."' class='btn default btn-xs blue'>
												<i class='fa fa-list'></i> Approve
											</a>
										</td>";
										}
										echo "
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