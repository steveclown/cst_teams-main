
<?php
		$this->load->view('hroemployeeeducation/formaddhroemployeeeducation_view');
		 
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
											<th style='text-align:center' width="10%">Education</th>
											<th style='text-align:center' width="10%">Type</th>
											<th style='text-align:center' width="10%">Name</th>
											<th style='text-align:center' width="10%">City</th>
											<th style='text-align:center' width="10%">From Period</th>
											<th style='text-align:center' width="10%">To Period</th>
											<th style='text-align:center' width="10%">Duration</th>
											<th style='text-align:center' width="10%">Passed</th>
											<th style='text-align:center' width="10%">Certificate</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeeeducation_data)){
											echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeeducation_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->hroemployeeeducation_model->getEducationName($val['education_id'])."</td>
														<td>".$this->configuration->EducationType[$val['employee_education_type']]."</td>
														<td>".$val['employee_education_name']."</td>
														<td>".$val['employee_education_city']."</td>
														<td>".$val['employee_education_from_period']."</td>
														<td>".$val['employee_education_to_period']."</td>
														<td>".$val['employee_education_duration']."</td>
														<td>".$this->configuration->Status[$val['employee_education_passed']]."</td>
														<td>".$this->configuration->Status[$val['employee_education_certificate']]."</td>
														<td>
														<a href='".$this->config->item('base_url').'hroemployeeeducation/deleteHROEmployeeEducation_Data/'.$val['employee_id']."/".$val['employee_education_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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

