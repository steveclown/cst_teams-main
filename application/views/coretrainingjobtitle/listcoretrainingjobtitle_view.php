
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
						<a href="<?php echo base_url();?>coretrainingjobtitle">
							Training Job Title List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Training Job Title List <small>Manage Training Job Title</small>
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
						<a href="<?php echo base_url();?>coretrainingjobtitle/addCoreTrainingJobTitle" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add Training Job Title
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									Job Title Name
								</th>
								<th>
									Training Title Name
								</th>
								<th>
									Training Job Title Code
								</th>
								<th>
									Training Job Title Name
								</th>
								
								
								<th width="120px">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coretrainingjobtitle as $key=>$val){
									
									echo"
										<tr>	
											<td>".$this->coretrainingjobtitle_model->getJobTitleName($val['job_title_id'])."</td>
											<td>".$this->coretrainingjobtitle_model->getTrainingTitleName($val['training_title_id'])."</td>
											<td>".$val['training_job_title_code']."</td>
											<td>".$val['training_job_title_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'coretrainingjobtitle/editCoreTrainingJobTitle/'.$val['training_job_title_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'coretrainingjobtitle/deleteCoreTrainingJobTitle/'.$val['training_job_title_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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