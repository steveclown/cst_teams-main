
<?php
	$this->load->view('hroemployeeemployment/FormAddHroEmployeeEmployment_view');
		 
/*	print_r("hroemployeeemployment_data ");
	print_r($hroemployeeemployment_data); */
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
											<th>Working Status</th>
											<th>Hire Date</th>
											<th>Employment Status</th>
											<th>Employment Status Date</th>
											<th>Employment Status Due Date</th>
											<th>Oveertme Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeeemployment_data)){
											echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeemployment_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->configuration->WorkingStatus()[$val['employee_employment_working_status']]."</td>
														<td>".tgltoview($val['employee_hire_date'])."</td>
														<td>".$this->configuration->EmployeeStatus()[$val['employee_employment_status']]."</td>
														<td>".tgltoview($val['employee_employment_status_date'])."</td>
														<td>".tgltoview($val['employee_employment_status_duedate'])."</td>
														<td>".$this->configuration->OvertimeStatus()[$val['employee_employment_overtime_status']]."</td>
														<td>
														<a href='".$this->config->item('base_url').'hro-employee-employment/delete/'.$val['employee_employment_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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

