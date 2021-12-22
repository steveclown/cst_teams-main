
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
								<a href="<?php echo base_url();?>">
									Realization Percentage List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
					Realization Percentage List <small>Manage Realization Percentage</small>
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
	<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
	?>
		<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>List
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>incentiverealizationpercentage/addIncentiveRealizationPercentage" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Add New Realization Percentage
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th>
											No
										</th>
										<th>
											Realization Percentage Min
										</th>
										<th>
											Realization Percentage Max
										</th>
										<th>
											Realization Percentage Omzet
										</th>
										<th>
											Realization Percentage Share
										</th>
										<th width="20%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
										foreach ($incentiverealizationpercentage as $key=>$val){
											echo"
												<tr>						
													<td>".$no."</td>			
													<td>".$val['realization_percentage_min']."</td>
													<td>".$val['realization_percentage_max']."</td>
													<td>".$val['realization_percentage_omzet']."</td>
													<td>".$val['realization_percentage_share']."</td>
													<td>
														<a href='".$this->config->item('base_url').'incentiverealizationpercentage/editIncentiveRealizationPercentage/'.$val['realization_percentage_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'incentiverealizationpercentage/deleteIncentiveRealizationPercentage/'.$val['realization_percentage_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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