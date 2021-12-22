<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"payrollemployeecommission/reset_search";
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
						<a href="<?php echo base_url();?>payrollemployeecommission">
							Employee Bonus List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Employee Bonus List <small>Manage Employee Bonus</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('payrollemployeecommission/filter',array('id' => 'myform', 'class' => '')); ?>
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
									echo form_dropdown('employee_id', $hroemployeedata, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" ');
								?>
								<label class="control-label">Employee </label>
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
						<i class="fa fa-reorder"></i>List
					</div>

					<div class="actions">
						<a href="<?php echo base_url();?>payrollemployeecommission/addPayrollEmployeeCommission" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Payroll Employee Commission
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th>Period</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Division Name</th>
								<th>Department Name</th>
								<th>Section Name</th>
								<th>Omzet MMC</th>
								<th>Quantity MMC</th>
								<th>Omzet Acc</th>
								<th>Total Omzet</th>
								<th>Amount MMC</th>
								<th>Amount Acc</th>
								<th>Total Amount</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($payrollemployeecommission as $key => $val){
									/*<a href='".$this->config->item('base_url').'payrollemployeecommission/editPayrollEmployeeBonus/'.$val['employee_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>*/
									echo"
										<tr>			
											<td>".$no."</td>
											<td>".$val['employee_commission_period']."</td>
											<td>".$val['employee_commisison_start_date']."</td>
											<td>".$val['employee_commission_end_date']."</td>
											<td>".$val['division_name']."</td>
											<td>".$val['department_name']."</td>
											<td>".$val['section_name']."</td>
											<td>".nominal($val['employee_commission_omzet_mmc'])."</td>
											<td>".nominal($val['employee_commission_quantity_mmc'])."</td>
											<td>".nominal($val['employee_commission_omzet_acc'])."</td>
											<td>".nominal($val['employee_commission_total_omzet'])."</td>
											<td>".nominal($val['employee_commission_amount_mmc'])."</td>
											<td>".nominal($val['employee_commission_amount_acc'])."</td>
											<td>".nominal($val['employee_commission_total_amount'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'payrollemployeecommission/addPayrollEmployeeCommissionMMC/'.$val['employee_id']."' class='btn default btn-xs green-jungle'>
													<i class='fa fa-plus'></i> Add
												</a>
												<a href='".$this->config->item('base_url').'payrollemployeecommission/deletePayrollEmployeeCommissionMMC/'.$val['employee_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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