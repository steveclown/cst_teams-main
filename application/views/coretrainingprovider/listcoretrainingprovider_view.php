
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
						<a href="<?php echo base_url();?>coretrainingprovider">
							Training Provider List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Training Provider List <small>Manage Training Provider</small>
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
						<a href="<?php echo base_url();?>coretrainingprovider/addCoreTrainingProvider" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add Training Provider
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									Provider Name
								</th>
								<th>
									Provider Address
								</th>
								<th>
									Provider City
								</th>
								<th>
									Provider Mobile Phone
								</th>
								<th width="120px">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coretrainingprovider as $key=>$val){
									
									echo"
										<tr>	
											<td>".$val['training_provider_name']."</td>
											<td>".$val['training_provider_address']."</td>
											<td>".$val['training_provider_city']."</td>
											<td>".$val['training_provider_mobile_phone']."</td>
											<td>
												<a href='".$this->config->item('base_url').'coretrainingprovider/editCoreTrainingProvider/'.$val['training_provider_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'coretrainingprovider/deleteCoreTrainingProvider/'.$val['training_provider_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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