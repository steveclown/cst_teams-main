
<?php
		$this->load->view('hroemployeeworking/formaddhroemployeeworking_view');
		 
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
											<th style='text-align:center' width="5%">No.</th>
											<th style='text-align:center' width="10%">Name</th>
											<th style='text-align:center' width="10%">Address</th>
											<th style='text-align:center' width="10%">Job Title</th>
											<th style='text-align:center' width="10%">From Period</th>
											<th style='text-align:center' width="10%">To Period</th>
											<th style='text-align:center' width="10%">Last Salary</th>
											<th style='text-align:center' width="10%">Separation Reason</th>
											<th style='text-align:center' width="10%">Separation Letter</th>
											<th style='text-align:center' width="10%">Remark</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!empty($hroemployeeworking_data)){
											foreach($hroemployeeworking_data as $key=>$val){
												echo"
													<tr class='odd gradeX'>
														<td style='text-align:center'>$no.</td>
														<td>".$val['working_company_name']."</td>
														<td>".$val['working_company_address']."</td>
														<td>".$val['working_job_title']."</td>
														<td>".$val['working_from_period']."</td>
														<td>".$val['working_to_period']."</td>
														<td>".$val['working_last_salary']."</td>
														<td>".$val['working_separation_reason']."</td>
														<td>".$this->configuration->SeparationLetter[$val['working_separation_letter']]."</td>
														<td>".$val['working_experience_remark']."</td>
														<td style='text-align  : center !important;'>
															<a href='".$this->config->item('base_url').'hroemployeeworking/deleteHROEmployeeWorking_Data/'.$val['employee_id']."/".$val['employee_working_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>";
														echo "
														</td>
													</tr>
												";
												$no++;
											}
										}else{
											echo"
												<tr class='odd gradeX'>
													<td colspan='11' style='text-align:center;'>
														<b>No Data</b>
													</td>
												</tr>
											";
										}
									?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

