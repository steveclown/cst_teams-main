<?php
		$this->load->view('payrollemployeeloan/formaddpayrollemployeeloan_view');

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
											<th>Loan Type Name</th>
											<th>Loan Date</th>
											<th>Loan Description</th>
											<th>Loan Start Period</th>
											<th>Loan Amount Total</th>
											<th>Loan Amount</th>
											<th>Loan Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeeloan_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeeloan_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['loan_type_name']."</td>
														<td>".tgltoview($val['employee_loan_date'])."</td>
														<td>".$val['employee_loan_description']."</td>
														<td>".$val['employee_loan_start_period']."</td>
														<td>".nominal($val['employee_loan_amount_total'])."</td>
														<td>".nominal($val['employee_loan_amount'])."</td>
														<td>".$this->configuration->EmployeeLoanStatus[$val['employee_loan_status']]."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeeloan/deletePayrollEmployeeLoan_Data/'.$val['employee_id']."/".$val['employee_loan_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>";
														echo"
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
