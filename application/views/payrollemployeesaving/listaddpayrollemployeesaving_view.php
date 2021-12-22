
<?php
		$this->load->view('payrollemployeesaving/formaddpayrollemployeesaving_view');

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
											<th>Saving Period</th>
											<th>Saving Name</th>
											<th>Saving Description</th>
											<th>Saving Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeesaving_data)){
											echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeesaving_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_saving_period']."</td>
														<td>".$val['saving_name']."</td>
														<td>".$val['employee_saving_description']."</td>
														<td>".nominal($val['employee_saving_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeesaving/deletePayrollEmployeeSaving_Data/'.$val['employee_id']."/".$val['employee_saving_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


