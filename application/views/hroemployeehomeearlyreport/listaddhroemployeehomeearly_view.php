
<?php
		$this->load->view('hroemployeehomeearly/formaddhroemployeehomeearly_view');

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
											<th>Home Early Name</th>
											<th>Home Early Date</th>
											<th>Home Early Hour</th>
											<th>Home Early Description</th>
											<th>Home Early Reason</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeehomeearly_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeehomeearly_data as $key=>$val){
												echo"
													<tr>
														<td>".$val['home_early_name']."</td>
														<td>".tgltoview($val['employee_home_early_date'])."</td>
														<td>".$val['employee_home_early_hour']."</td>
														<td>".$val['employee_home_early_description']."</td>
														<td>".$val['employee_home_early_reason']."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeehomeearly/deleteHROEmployeeHomeEarly_Data/'.$val['employee_id']."/".$val['employee_home_early_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


