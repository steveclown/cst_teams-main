
<?php
		$this->load->view('hroemployeemedicalcoverage/formaddhroemployeemedicalcoverage_view');
		 
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
											<th style='text-align:center' width="30%">Medical Coverage Name</th>
											<th style='text-align:center' width="15%">Period</th>
											<th style='text-align:center' width="15%">Medical Coverage Amount</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!empty($hroemployeemedicalcoverage_data)){
											foreach($hroemployeemedicalcoverage_data as $key=>$val){
												echo"
													<tr class='odd gradeX'>
														<td style='text-align:center'>$no.</td>
														<td>".$this->hroemployeemedicalcoverage_model->getMedicalCoverageName($val['medical_coverage_id'])."</td>
														<td>".$val['medical_coverage_period']."</td>
														<td>".nominal($val['medical_coverage_amount'])."</td>
														<td style='text-align  : center !important;'>
															<a href='".$this->config->item('base_url').'hroemployeemedicalcoverage/deleteHROEmployeeMedicalCoverage_Data/'.$val['employee_id']."/".$val['employee_medical_coverage_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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

