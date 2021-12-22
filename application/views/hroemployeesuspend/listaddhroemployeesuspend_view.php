
<?php
		$this->load->view('hroemployeesuspend/formaddhroemployeesuspend_view');

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
											<th>Suspend Date</th>
											<th>Suspend Name</th>
											<th>Suspend Description</th>
											<th>Salary Percentage</th>
											<th>Suspend Status</th>
											<th>Suspend Status Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeesuspend_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeesuspend_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['employee_suspend_date'])."</td>
														<td>".$this->hroemployeesuspend_model->getSuspendName($val['suspend_id'])."</td>
														<td>".$val['employee_suspend_description']."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeesuspend/deleteHROEmployeeSuspend_Data/'.$val['employee_id']."/".$val['employee_suspend_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


