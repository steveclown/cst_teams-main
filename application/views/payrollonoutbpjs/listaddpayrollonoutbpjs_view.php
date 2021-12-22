
<?php
		$this->load->view('payrollonoutbpjs/formaddpayrollonoutbpjs_view');

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
											<th>In Date</th>
											<th>Reported Salary</th>
											<th>BPJS Total</th>
											<th>BPJS Kesehatan Status</th>
											<th>BPJS Kesehatan Amount</th>
											<th>BPJS Tenaga Kerja Status</th>
											<th>BPJS Tenaga Kerja Amount</th>
											<th>Status</th>
											<th>Out Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollonoutbpjs_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollonoutbpjs_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['bpjs_in_date'])."</td>
														<td>".nominal($val['bpjs_reported_salary'])."</td>
														<td>".nominal($val['bpjs_total_amount'])."</td>
														<td>".$this->configuration->BPJSStatus[$val['bpjs_kesehatan_status']]."</td>
														<td>".nominal($val['bpjs_kesehatan_amount'])."</td>
														<td>".$this->configuration->BPJSStatus[$val['bpjs_tenagakerja_status']]."</td>
														<td>".nominal($val['bpjs_tenagakerja_amount'])."</td>
														<td>".$this->configuration->BPJSStatus[$val['bpjs_out_status']]."</td>
														<td>".tgltoview($val['bpjs_out_date'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollonoutbpjs/deletePayrollOnOutBPJS_Data/'.$val['employee_id']."/".$val['employee_bpjs_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


