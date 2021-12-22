
<?php
		$this->load->view('payrollovertimerequest/formaddpayrollovertimerequest_view');

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
											<th>Overtime Type</th>
											<th>Overtime Description</th>
											<th>Overtime Date</th>
											<th>Overtime Duration</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollovertimerequest_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollovertimerequest_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->payrollovertimerequest_model->getOvertimeTypeName($val['overtime_type_id'])."</td>
														<td>".$val['overtime_request_description']."</td>
														<td>".tgltoview($val['overtime_request_date'])."</td>
														<td>".$val['overtime_request_duration']."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollovertimerequest/deletePayrollOvertimeRequest_Data/'.$val['employee_id']."/".$val['overtime_request_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


