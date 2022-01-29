<?php
$this->load->view('payrollemployeemonthly/formaddpayrollemployeemonthly_view');

?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>

			</div>
			<div class="portlet-body ">
				<!-- BEGIN FORM-->
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Payroll Monthly Period</th>
											<th>Working Days</th>
											<th>Basic Salary</th>
											<th>Allowance Total</th>
											<th>Deduction Total</th>
											<th>Overtime Total</th>
											<th>Home Early Total</th>
											<th>BPJS Amount</th>
											<th>Allowance Other</th>
											<th>Deduction Other</th>
											<th>Total Salary</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if (!is_array($payrollemployeemonthly_data)) {
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeemonthly_data as $key => $val) {
												echo "
													<tr>
														<td>" . $val['employee_monthly_period'] . "</td>
														<td>" . $val['employee_monthly_working_days'] . "</td>
														<td>" . nominal($val['employee_monthly_basic_salary']) . "</td>
														<td>" . nominal($val['employee_monthly_allowance_total']) . "</td>
														<td>" . nominal($val['employee_monthly_deduction_total']) . "</td>
														<td>" . nominal($val['employee_monthly_overtime_total']) . "</td>
														<td>" . nominal($val['employee_monthly_early_total']) . "</td>
														<td>" . nominal($val['employee_monthly_bpjs_amount']) . "</td>
														<td>" . nominal($val['employee_monthly_allowance_other']) . "</td>
														<td>" . nominal($val['employee_monthly_deduction_other']) . "</td>
														<td>" . nominal($val['employee_monthly_salary_total']) . "</td>
														<td>
															<a href='" . $this->config->item('base_url') . 'payrollemployeemonthly/deletePayrollEmployeeMonthly_Data/' . $val['employee_id'] . "/" . $val['employee_monthly_id'] . "' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>

															<a href='" . $this->config->item('base_url') . 'payrollemployeemonthly/detailPayrollEmployeeMonthly_Data/' . $val['employee_monthly_id'] . "'class='btn default btn-xs yellow'>
																<i class='fa fa-bars'></i> Detail
															</a>";
												echo "
													</tr>
													
												";
											}
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>