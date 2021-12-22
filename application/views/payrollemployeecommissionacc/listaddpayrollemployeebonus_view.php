
<?php
		$this->load->view('payrollemployeeinsurance/formaddpayrollemployeeinsurance_view');

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
											<th>Insurance Period</th>
											<th>Insurance Name</th>
											<th>Insurance Premi Code</th>
											<th>Insurance Description</th>
											<th>Insurance Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeeinsurance_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeeinsurance_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_insurance_period']."</td>
														<td>".$this->payrollemployeeinsurance_model->getInsuranceName($val['insurance_id'])."</td>
														<td>".$this->payrollemployeeinsurance_model->getInsurancePremiCode($val['insurance_premi_id'])."</td>
														<td>".$val['employee_insurance_description']."</td>
														<td>".nominal($val['employee_insurance_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeeinsurance/deletePayrollEmployeeInsurance_Data/'.$val['employee_id']."/".$val['employee_insurance_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


