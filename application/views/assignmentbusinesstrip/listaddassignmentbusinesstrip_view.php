
<?php
		$this->load->view('assignmentbusinesstrip/formaddassignmentbusinesstrip_view');
		 
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
											<th>No.</th>
											<th>Business Trip Date</th>
											<th>Start Date</th>
											<th>End Date</th>
											<th>Purpose</th>
											<th>Status</th>
											<th>Approved</th>
											<th>Returned</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($assignmentbusinesstrip_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($assignmentbusinesstrip_data as $key=>$val){
												echo"
													<tr>
														<td>".$no."</td>
														<td>".tgltoview($val['business_trip_date'])."</td>
														<td>".tgltoview($val['business_trip_start_date'])."</td>
														<td>".tgltoview($val['business_trip_end_date'])."</td>
														<td>".$val['business_trip_purpose']."</td>
														<td>".$val['business_trip_status']."</td>
														<td>".$val['business_trip_approved']."</td>
														<td>".$val['business_trip_returned']."</td>
														<td>
															<a href='".$this->config->item('base_url').'assignmentbusinesstrip/deleteAssignmentBusinessTrip_Data/'.$val['employee_id']."/".$val['business_trip_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>";
														echo"
													</tr>
												";

												$no++;
											}
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

