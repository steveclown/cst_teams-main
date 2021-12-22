
<?php
		$this->load->view('hroemployeehospitalcoverage/formaddhroemployeehospitalcoverage_view');
		 
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
											<th style='text-align:center' width="30%">Hospital Coverage Name</th>
											<th style='text-align:center' width="15%">Period</th>
											<th style='text-align:center' width="15%">Hospital Coverage Amount</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!empty($hroemployeehospitalcoverage_data)){
											foreach($hroemployeehospitalcoverage_data as $key=>$val){
												echo"
													<tr class='odd gradeX'>
														<td style='text-align:center'>$no.</td>
														<td>".$this->hroemployeehospitalcoverage_model->getHospitalCoverageName($val['hospital_coverage_id'])."</td>
														<td>".$val['hospital_coverage_period']."</td>
														<td>".nominal($val['hospital_coverage_amount'])."</td>
														<td style='text-align  : center !important;'>
															<a href='".$this->config->item('base_url').'hroemployeehospitalcoverage/deleteHROEmployeeHospitalCoverage_Data/'.$val['employee_id']."/".$val['employee_hospital_coverage_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
													<td colspan='12' style='text-align:center;'>
														<b>No Data</b>
													</td>
												</tr>
											";
										}
									?>		
									<tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

