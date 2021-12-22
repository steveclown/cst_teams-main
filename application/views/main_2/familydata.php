<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterfamilydata_view'); 
?>
	<div class="form-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeefamilydata">
						<thead>
							<tr>
								<th>
									 Name
								</th>
								<th>
									 Status
								</th>
								<th>
									 Has Coverage Claim
								</th>
								<th>
									 Ratio
								</th>
								<th>
									 Detail
								</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								foreach ($hroemployeefamily as $key=>$val){
									echo "
											<tr class='odd gradeX'>
												<td>
													$val[employee_family_name]
												</td>
												<td>
													".$this->main_model->getFamilyStatus($val[family_status_id])."
												</td>												
												<td>
													".$this->configuration->HasCoverageClaim[($val[has_coverage_claim])]."
												</td>
												<td>
													".nominal($val[employee_family_coverage_ratio])."
												</td>
												<td>
													<a href='".$this->config->item('base_url').'hroemployeefamilydata/Edit/'.$val[employee_family_id]."' class='btn default btn-xs black'>
													<i class='fa fa-edit'></i> Detail
													</a>
												</td>
											</tr>
									";
								}
							?>
						</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>