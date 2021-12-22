
<?php
		$this->load->view('payrollemployeeallowance/formaddpayrollemployeeallowance_view');

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
											<th>Allowance Period</th>
											<th>Allowance Name</th>
											<th>Allowance Description</th>
											<th>Allowance Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeeallowance_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeeallowance_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_allowance_period']."</td>
														<td>".$this->payrollemployeeallowance_model->getAllowanceName($val['allowance_id'])."</td>
														<td>".$val['employee_allowance_description']."</td>
														<td>".nominal($val['employee_allowance_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeeallowance/deletePayrollEmployeeAllowance_Data/'.$val['employee_id']."/".$val['employee_allowance_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


