
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

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
							<a href="<?php echo base_url();?>corededuction">
								Deduction List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Deduction List <small>Manage Deduction</small>
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
							<a href="<?php echo base_url();?>corededuction/addCoreDeduction" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add New Deduction
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th>
										Code
									</th>
									<th>
										Deduction Name
									</th>
									<th>
										Deduction Amount
									</th>
									<th>
										Deduction Type
									</th>
									<th width="120px">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($corededuction as $key=>$val){
										
										echo"
											<tr>									
												<td>".$val['deduction_code']."</td>
												<td>".$val['deduction_name']."</td>
												<td>".$val['deduction_amount']."</td>
												<td>".$this->configuration->DeductionType[($val['deduction_type'])]."</td>
												<td>
													<a href='".$this->config->item('base_url').'corededuction/editCoreDeduction/'.$val['deduction_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'corededuction/deleteCoreDeduction/'.$val['deduction_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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