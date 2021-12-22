
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
						<a href="<?php echo base_url();?>coretrainingprovideritem">
							Training Provider Item List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Training Provider Item List <small>Manage Training Provider Item</small>
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
						<a href="<?php echo base_url();?>coretrainingprovideritem/addCoreTrainingProviderItem" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add Training Provider Item
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="15%">
									Provider Name
								</th>
								<th width="25%">
									Title Name
								</th>
								<th width="20%">
									Item Name
								</th>
								<th width="15%">
									Item Cost
								</th>
								<th width="10%">
									Item Duration
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coretrainingprovideritem as $key=>$val){
									
									echo"
										<tr>	
											<td>".$this->coretrainingprovideritem_model->getTrainingProviderName($val['training_provider_id'])."</td>
											<td>".$this->coretrainingprovideritem_model->getTrainingTitleName($val['training_title_id'])."</td>
											<td>".$val['training_provider_item_name']."</td>
											<td>".nominal($val['training_provider_item_cost'])."</td>
											<td>".$val['training_provider_item_cost']."</td>
											<td>
												<a href='".$this->config->item('base_url').'coretrainingprovideritem/editCoreTrainingProviderItem/'.$val['training_provider_item_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'coretrainingprovideritem/deleteCoreTrainingProviderItem/'.$val['training_provider_item_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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