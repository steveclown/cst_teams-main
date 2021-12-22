
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
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeemonthly)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeemonthly as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_monthly_period']."</td>
														<td>".$val['employee_monthly_working_days']."</td>
														<td>".nominal($val['employee_monthly_basic_salary'])."</td>
														<td>".nominal($val['employee_monthly_allowance_total'])."</td>
														<td>".nominal($val['employee_monthly_deduction_total'])."</td>
														<td>".nominal($val['employee_monthly_overtime_total'])."</td>
														<td>".nominal($val['employee_monthly_early_total'])."</td>
														<td>".nominal($val['employee_monthly_bpjs_amount'])."</td>
														<td>".nominal($val['employee_monthly_allowance_other'])."</td>
														<td>".nominal($val['employee_monthly_deduction_other'])."</td>
														<td>".nominal($val['employee_monthly_salary_total'])."</td>
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
			


