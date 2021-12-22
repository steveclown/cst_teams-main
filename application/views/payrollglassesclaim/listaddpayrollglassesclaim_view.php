
<?php
		$this->load->view('payrollglassesclaim/formaddpayrollglassesclaim_view');

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
											<th>Glasses Coverage Name</th>
											<th>Claim Date</th>
											<th>Claim Opening Balance</th>
											<th>Claim Amount</th>
											<th>Claim Last Balance</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollglassesclaim_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollglassesclaim_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->payrollglassesclaim_model->getGlassesCoverageName($val['glasses_coverage_id'])."</td>
														<td>".tgltoview($val['glasses_claim_date'])."</td>
														<td>".nominal($val['glasses_claim_opening_balance'])."</td>
														<td>".nominal($val['glasses_claim_amount'])."</td>
														<td>".nominal($val['glasses_claim_last_balance'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollglassesclaim/deletePayrollGlassesClaim_Data/'.$val['employee_id']."/".$val['glasses_claim_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


