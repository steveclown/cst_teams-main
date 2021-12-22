


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
						<a href="<?php echo base_url();?>coreinsurancepremi">
							Insurance Premi List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Insurance Premi List <small>Manage Insurance Premi</small>
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
						<a href="<?php echo base_url();?>coreinsurancepremi/addCoreInsurancePremi" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Insurance Premi
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
						<thead>
							<tr>
								<th>
									Insurance Premi Code
								</th>
								<th>
									Insurance Name
								</th>
								<th>
									Insurance Premi Amount
								</th>
								<th width="120px">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coreinsurancepremi as $key=>$val){
									
									echo"
										<tr>									
											<td>$val[insurance_premi_code]</td>
											<td>".$this->coreinsurancepremi_model->getInsuranceName($val[insurance_id])."</td>
											<td>".nominal($val[insurance_premi_amount])."</td>
											<td>
												<a href='".$this->config->item('base_url').'coreinsurancepremi/editCoreInsurancePremi/'.$val[insurance_premi_id]."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'coreinsurancepremi/deleteCoreInsurancePremi/'.$val[insurance_premi_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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