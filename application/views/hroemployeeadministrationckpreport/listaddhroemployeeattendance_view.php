
<?php
		$this->load->view('hroemployeeasset/formaddhroemployeeasset_view');
		 
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
											<th>Asset Name</th>
											<th>Sub Asset Name</th>
											<th>Asset Receipt Date</th>
											<th>Asset Description</th>
											<th>Asset Retuned Date</th>
											<th>Asset Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeeasset_data)){
											echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeeasset_data as $key=>$val){
												echo"
													<tr>
														<td>".$this->hroemployeeasset_model->getAssetName($val['asset_id'])."</td>
														<td>".$this->hroemployeeasset_model->getSubAssetName($val['sub_asset_id'])."</td>
														<td>".tgltoview($val['employee_asset_receipt_date'])."</td>
														<td>".$val['employee_asset_description']."</td>
														<td>".$val['employee_asset_returned_date']."</td>
														<td>".$this->configuration->AssetStatus[$val['employee_asset_status']]."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeeasset/deleteHROEmployeeAsset_Data/'.$val['employee_id']."/".$val['employee_asset_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


