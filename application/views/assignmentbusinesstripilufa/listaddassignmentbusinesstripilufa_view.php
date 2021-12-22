
<?php
		$this->load->view('assignmentbusinesstripspa/formaddassignmentbusinesstripspa_view');
		 
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
											<th>Destination</th>
											<th>Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$no = 1;
										if(!is_array($assignmentbusinesstripspa_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($assignmentbusinesstripspa_data as $key=>$val){
												echo"
													<tr>
														<td>".$no."</td>
														<td>".tgltoview($val['business_trip_date'])."</td>
														<td>".$val['business_trip_destination']."</td>
														<td>".nominal($val['business_trip_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'assignmentbusinesstripspa/deleteAssignmentBusinessTrip_Data/'.$val['employee_id']."/".$val['business_trip_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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

