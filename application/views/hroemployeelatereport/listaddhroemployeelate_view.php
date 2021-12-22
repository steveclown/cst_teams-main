
<?php
		$this->load->view('hroemployeelate/formaddhroemployeelate_view');

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
											<th>Late Date</th>
											<th>Late Name</th>
											<th>Late Description</th>
											<th>Late Duration</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeelate_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeelate_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['employee_late_date'])."</td>
														<td>".$this->hroemployeelate_model->getLateName($val['late_id'])."</td>
														<td>".$val['employee_late_description']."</td>
														<td>".$val['employee_late_duration']."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeelate/deleteHROEmployeeLate_Data/'.$val['employee_id']."/".$val['employee_late_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


