
<?php
		$this->load->view('HroEmployeeAbsence/FormAddHroEmployeeAbsence_view');

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
											<th>Absence Date</th>
											<th>Absence Name</th>
											<th>Absence Description</th>
											<th>Absence Start Date</th>
											<th>Absence End Date</th>
											<th>Absence Duration</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(empty($HroEmployeeAbsence_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($HroEmployeeAbsence_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['employee_absence_date'])."</td>
														<td>".$this->HroEmployeeAbsence_model->getAbsenceName($val['absence_id'])."</td>
														<td>".$val['employee_absence_description']."</td>
														<td>".$val['employee_absence_duration']."</td>
														<td>".tgltoview($val['employee_absence_start_date'])."</td>
														<td>".tgltoview($val['employee_absence_end_date'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'HroEmployeeAbsence/deleteHroEmployeeAbsence_Data/'.$val['employee_id']."/".$val['employee_absence_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


