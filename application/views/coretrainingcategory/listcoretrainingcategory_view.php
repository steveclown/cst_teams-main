
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
								<a href="#">
									Training Category List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Training Category List <small>Manage Training Category</small>
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
								<a href="<?php echo base_url();?>coretrainingcategory/addCoreTrainingCategory" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i>Add Training Category
								</a>
							</div>
						</li>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
								<thead>
									<tr>
										<th >
											Training Category Code
										</th>
										<th>
											Training Category Name
										</th>
										<th width="30%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($coretrainingcategory as $key=>$val){
											
											echo"
												<tr>									
													<td>$val[training_category_code]</td>
													<td>$val[training_category_name]</td>
													<td>
														<a href='".$this->config->item('base_url').'coretrainingcategory/editCoreTrainingCategory/'.$val[training_category_id]."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'coretrainingcategory/deleteCoreTrainingCategory/'.$val[training_category_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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