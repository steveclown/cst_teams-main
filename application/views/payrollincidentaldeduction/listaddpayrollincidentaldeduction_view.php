
<?php
		$this->load->view('payrollincidentaldeduction/formaddpayrollincidentaldeduction_view');

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
											<th>Deduction Name</th>
											<th>Incidental Description</th>
											<th>Incidental Period</th>
											<th>Incidental Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollincidentaldeduction_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollincidentaldeduction_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->payrollincidentaldeduction_model->getDeductionName($val['deduction_id'])."</td>
														<td>".$val['incidental_deduction_description']."</td>
														<td>".$val['incidental_deduction_period']."</td>
														<td>".nominal($val['incidental_deduction_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollincidentaldeduction/deletePayrollIncidentalDeduction_Data/'.$val['employee_id']."/".$val['incidental_deduction_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>
														</td>";
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


