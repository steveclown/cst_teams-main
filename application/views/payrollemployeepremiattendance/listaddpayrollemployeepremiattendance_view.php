
<?php
		$this->load->view('payrollemployeepremiattendance/formaddpayrollemployeepremiattendance_view');

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
											<th>Premi Attendance Period</th>
											<th>Premi Attendance Name</th>
											<th>Premi Attendance Description</th>
											<th>Premi Attendance Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeepremiattendance_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeepremiattendance_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_premi_attendance_period']."</td>
														<td>".$this->payrollemployeepremiattendance_model->getPremiAttendanceName($val['premi_attendance_id'])."</td>
														<td>".$val['employee_premi_attendance_description']."</td>
														<td>".nominal($val['employee_premi_attendance_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeepremiattendance/deletePayrollEmployeePremiAttendance_Data/'.$val['employee_id']."/".$val['employee_premi_attendance_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


