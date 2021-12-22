


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
						<a href="<?php echo base_url();?>coremedicalcovarage">
							Medical Coverage List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Medical Coverage List <small>Manage Medical Coverage</small>
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
						<a href="<?php echo base_url();?>coremedicalcoverage/addCoreMedicalCoverage" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Medical Coverage
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
						<thead>
							<tr>
								<th>
									Grade Name
								</th>
								<th>
									Class Name
								</th>
								<th>
									Job Title Name
								</th>
								<th>
									Medical Coverage Name
								</th>
								
								<th>
									Medical Coverage Ratio
								</th>
								<th>
									Medical Covergae Amount
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($coremedicalcoverage as $key=>$val){
									
									echo"
										<tr>
											<td>".$this->coremedicalcoverage_model->getGradeName($val[grade_id])."</td>
											<td>".$this->coremedicalcoverage_model->getClassName($val[class_id])."</td>
											<td>".$this->coremedicalcoverage_model->getJobTitleName($val[job_title_id])."</td>									
											<td>$val[medical_coverage_name]</td>
											
											<td>".nominal($val[medical_coverage_ratio])."</td>
											<td>".nominal($val[medical_coverage_amount])."</td>
											<td>
												<a href='".$this->config->item('base_url').'coremedicalcoverage/editCoreMedicalCoverage/'.$val[medical_coverage_id]."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'coremedicalcoverage/deleteCoreMedicalCoverage/'.$val[medical_coverage_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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