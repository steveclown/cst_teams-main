
<?php
		$this->load->view('hroemployeepermit/formaddhroemployeepermit_view');

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
											<th>Permit Date</th>
											<th>Permit Name</th>
											<th>Permit Description</th>
											<th>Permit Start Date</th>
											<th>Permit End Date</th>
											<th>Permit Duration</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeepermit_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeepermit_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['employee_permit_date'])."</td>
														<td>".$this->hroemployeepermit_model->getPermitName($val['permit_id'])."</td>
														<td>".$val['employee_permit_description']."</td>
														<td>".tgltoview($val['employee_permit_start_date'])."</td>
														<td>".tgltoview($val['employee_permit_end_date'])."</td>
														<td>".$val['employee_permit_duration']."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeepermit/deleteHROEmployeePermit_Data/'.$val['employee_id']."/".$val['employee_permit_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


