


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
						<a href="<?php echo base_url();?>corehospitalcoverage">
							Hospital Coverage List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Hospital Coverage List <small>Manage Hospital Coverage</small>
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
						<a href="<?php echo base_url();?>corehospitalcoverage/addCoreHospitalCoverage" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Hospital Coverage
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
									Hospital Coverage Name
								</th>
								<th>
									Medicine Amount
								</th>
								<th>
									Room Amount
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($corehospitalcoverage as $key=>$val){
									
									echo"
										<tr>				
											<td>".$this->corehospitalcoverage_model->getGradeName($val[grade_id])."</td>
											<td>".$this->corehospitalcoverage_model->getClassName($val[class_id])."</td>
											<td>".$this->corehospitalcoverage_model->getJobTitleName($val[job_title_id])."</td>
											<td>$val[hospital_coverage_name]</td>
											<td>".nominal($val[hospital_coverage_medicine_amount])."</td>
											<td>".nominal($val[hospital_coverage_room_amount])."</td>
											<td>
												<a href='".$this->config->item('base_url').'corehospitalcoverage/editCoreHospitalCoverage/'.$val[hospital_coverage_id]."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'corehospitalcoverage/deleteCoreHospitalCoverage/'.$val[hospital_coverage_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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