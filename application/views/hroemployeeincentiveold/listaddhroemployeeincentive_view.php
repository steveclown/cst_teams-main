
<?php
		$this->load->view('hroemployeeincentive/formaddhroemployeeincentive_view');
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
											<th style='text-align:center' width="9%">Region Name</th>
											<th style='text-align:center' width="9%">Branch Name</th>
											<th style='text-align:center' width="9%">Location Name</th>
											<th style='text-align:center' width="9%">Division Name</th>
											<th style='text-align:center' width="9%">Department Name</th>
											<th style='text-align:center' width="9%">Section Name</th>
											<th style='text-align:center' width="9%">Job Title Name</th>
											<th style='text-align:center' width="9%">Grade Name</th>
											<th style='text-align:center' width="9%">Class Name</th>
											<!-- <th style='text-align:center'>Action</th> -->
										</tr>
									</thead>
									<tbody>
										<?php
											$no = 1;
											if(!empty($hroemployeeincentive_data)){
												foreach($hroemployeeincentive_data as $key=>$val){
													echo"
														<tr class='odd gradeX'>
															<td style='text-align:center'>$no.</td>
															<td>".$this->hroemployeeincentive_model->getRegionName($val['region_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getBranchName($val['branch_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getLocationName($val['location_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getDivisionName($val['division_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getDepartmentName($val['department_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getSectionName($val['section_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getJobTitleName($val['job_title_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getGradeName($val['grade_id'])."</td>
															<td>".$this->hroemployeeincentive_model->getClassName($val['class_id'])."</td>
															
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

