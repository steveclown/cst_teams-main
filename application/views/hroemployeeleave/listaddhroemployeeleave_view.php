
<?php
		$this->load->view('hroemployeeleave/formaddhroemployeeleave_view');
		 
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
											<th>Leave Name</th>
											<th>Leave Description</th>
											<th>Leave Period</th>
											<th>Leave Balance</th>
											<th>Leave Taken</th>
											<th>Leave Last Balance</th>
											<th>Leave Due Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeeleave_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeleave_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->hroemployeeleave_model->getAnnualLeaveName($val['annual_leave_id'])."</td>
														<td>".$val['employee_leave_description']."</td>
														<td>".$val['employee_leave_period']."</td>
														<td>".$val['employee_leave_balance']."</td>
														<td>".$val['employee_leave_taken']."</td>
														<td>".$val['employee_leave_last_balance']."</td>
														<td>".tgltoview($val['employee_asset_status'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeeleave/deleteHROEmployeeLeave_Data/'.$val['employee_id']."/".$val['employee_leave_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


