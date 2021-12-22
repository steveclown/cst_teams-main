


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
							<a href="<?php echo base_url();?>coreservicepay">
								Service Pay List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Service Pay List <small>Manage Service Pay </small>
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
							<a href="<?php echo base_url();?>coreservicepay/addCoreServicePay" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add New Service Pay
							</a>
						</div>
					</li>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th width="10%">
										Code
									</th>
									<th width="25%">
										Service Pay Name
									</th>
									<th width="15%">
										Service Pay Range 1
									</th>
									<th width="15%">
										Service Pay Range 2
									</th>
									<th width="10%">
										Service Pay Ratio
									</th>
									<th width="10%">
										Service Pay Type
									</th>
									<th width="20%">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($coreservicepay as $key=>$val){
										
										echo"
											<tr>									
												<td>$val[service_pay_code]</td>
												<td>$val[service_pay_name]</td>
												<td>$val[service_pay_range1]</td>
												<td>$val[service_pay_range2]</td>
												<td>".nominal($val[service_pay_ratio])."</td>
												<td>".$this->configuration->$val[service_pay_ratio]."</td>
												<td>
													<a href='".$this->config->item('base_url').'coreservicepay/editCoreServicePay/'.$val[service_pay_id]."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'coreservicepay/deleteCoreServicePay/'.$val[service_pay_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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