
	<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
	?>

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coresubasset">
									Sub Asset List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Sub Asset <small>Manage Sub Asset</small>
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
		
		<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>List
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>coresubasset/addCoreSubAsset" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Add New Sub asset
								</a>
							</div>
						</li>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th>
											Asset Name
										</th>
										<th>
											Sub Asset Code
										</th>
										<th>
											Sub Asset Name
										</th>
										
										<th width="25%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($coresubasset as $key=>$val){
											echo"
												<tr>	
													<td>".$this->coresubasset_model->getAssetName($val[asset_id])."</td>								
													<td>$val[sub_asset_code]</td>
													<td>$val[sub_asset_name]</td>
													
													<td>
														<a href='".$this->config->item('base_url').'coresubasset/editCoreSubAsset/'.$val[sub_asset_id]."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'coresubasset/deleteCoreSubAsset/'.$val[sub_asset_id]."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
															<i class='fa fa-trash-o'></i> Delete
														</a>
													</td>
												</tr>
											";
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		<?php echo form_close(); ?>	