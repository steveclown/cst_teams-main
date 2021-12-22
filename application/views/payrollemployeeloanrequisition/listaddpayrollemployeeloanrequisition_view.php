<?php
	$this->load->view('payrollemployeeloanrequisition/formaddpayrollemployeeloanrequisition_view');
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
											<th>No. </th>
											<th>Loan Type</th>
											<th>Loan Requisition Date</th>
											<th>Salary Amount</th>
											<th>Loan Amount Total</th>
											<th>Total Period</th>
											<th>Loan Amount</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no=1;
										if(!is_array($payrollemployeeloanrequisition)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeeloanrequisition as $key=>$val){
												echo"
													<tr>
														<td>".$no."</td>
														<td>".$val['loan_type_name']."</td>
														<td>".tgltoview($val['employee_loan_requisition_date'])."</td>
														<td>".nominal($val['employee_total_salary_amount'])."</td>
														<td>".nominal($val['employee_loan_amount_total'])."</td>
														<td>".$val['employee_total_period']."</td>
														<td>".nominal($val['employee_loan_amount'])."</td>
														<td>";
															if($val['employee_loan_requisition_status']==0){
																echo"
																	<label class='btn btn-xs green-jungle'><i class='fa fa-list'></i> Draft</label>
																";
															}elseif ($val['employee_loan_requisition_status']==1) {
																echo"
																	<label class='btn btn-xs blue'><i class='fa fa-check'></i> Approved</label>
																";
															}else{
																echo"
																	<label class='btn btn-xs red'><i class='fa fa-times'></i> Reject</label>
																";
															}
														echo "
														</td>
													</tr>
													
												";
												$no++;
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