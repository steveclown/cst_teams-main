
<?php
		$this->load->view('hroemployeeworkingdayoff/formaddhroemployeeworkingdayoff_view');

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
											<th>Working Day Off Date</th>
											<th>Day Off Name</th>
											<th>Working Day Off Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeeworkingdayoff_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeworkingdayoff_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['employee_working_dayoff_date'])."</td>
														<td>".$this->hroemployeeworkingdayoff_model->getDayOffName($val['dayoff_id'])."</td>
														<td>".$val['employee_working_dayoff_description']."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeeworkingdayoff/deleteHROEmployeeWorkingDayOff_Data/'.$val['employee_id']."/".$val['employee_working_dayoff_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


