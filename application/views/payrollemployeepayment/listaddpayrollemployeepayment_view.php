
<?php
		$this->load->view('payrollemployeepayment/formaddpayrollemployeepayment_view');

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
											<th>Payment Period</th>
											<th>Basic Salary</th>
											<th>Basic Overtime</th>
											<th>Bank Name</th>
											<th>Bank Acct Name</th>
											<th>Bank Acct No</th>
											<th>Home Early Status</th>
											<th>Home Early Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeepayment_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeepayment_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_payment_period']."</td>
														<td>".nominal($val['payment_basic_salary'])."</td>
														<td>".nominal($val['payment_basic_overtime'])."</td>
														<td>".$this->payrollemployeepayment_model->getBankName($val['bank_id'])."</td>
														<td>".$val['payment_bank_acct_name']."</td>
														<td>".$val['payment_bank_acct_no']."</td>
														<td>".$this->configuration->HomeEarlyStatus[$val['payment_home_early_status']]."</td>
														<td>".nominal($val['payment_home_early_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeepayment/deletePayrollEmployeePayment_Data/'.$val['employee_id']."/".$val['employee_payment_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


