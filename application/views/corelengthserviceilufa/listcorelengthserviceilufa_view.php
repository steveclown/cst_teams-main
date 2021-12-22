


				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<div class = "page-bar">
					<ul class="page-breadcrumb ">
						<li>
							<a href="<?php echo base_url();?>">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>corelengthserviceilufa">
								Length of Service List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Length of Service List <small>Manage Length of Service </small>
				</h1>
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
							<a href="<?php echo base_url();?>corelengthserviceilufa/addCoreLengthService" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add New Length of Service
							</a>
						</div>
					</li>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th width="15%">
										Code
									</th>
									<th width="30%">
										Length of Service Name
									</th>
									<th width="15%">
										Length of Service Range 1
									</th>
									<th width="15%">
										Length of Service Range 2
									</th>
									<th width="10%">
										Length of Service Amount
									</th>
									<th width="20%">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($corelengthservice as $key=>$val){
										
										echo"
											<tr>									
												<td>".$val['length_service_code']."</td>
												<td>".$val['length_service_name']."</td>
												<td>".$val['length_service_range1']."</td>
												<td>".$val['length_service_range2']."</td>
												<td>".nominal($val['length_service_amount'])."</td>
												<td>
													<a href='".$this->config->item('base_url').'corelengthserviceilufa/editCoreLengthService/'.$val[length_service_id]."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'corelengthserviceilufa/deleteCoreLengthService/'.$val[length_service_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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