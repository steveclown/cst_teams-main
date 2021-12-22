

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
							Training Title List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Training Title List <small>Manage Title List</small>
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
						<a href="<?php echo base_url();?>coretrainingtitle/addCoreTrainingTitle" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add Training Title
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									Training Category Name
								</th>
								<th>
									Training Title Code
								</th>
								<th>
									Training Title Name
								</th>
								<th width="120px">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coretrainingtitle as $key=>$val){
									echo"
										<tr>	
											<td>".$this->coretrainingtitle_model->getTrainingCategoryName($val['training_category_id'])."</td>								
											<td>".$val['training_title_code']."</td>
											<td>".$val['training_title_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'coretrainingtitle/editCoreTrainingTitle/'.$val['training_title_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'coretrainingtitle/deleteCoreTrainingTitle/'.$val['training_title_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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