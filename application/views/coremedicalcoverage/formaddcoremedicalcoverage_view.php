<script>
	function ulang(){
		document.getElementById("medical_coverage_code").value = "";
		document.getElementById("grade_id").value = "";
		document.getElementById("class_id").value = "";
		document.getElementById("job_title_id").value = "";
		document.getElementById("medical_coverage_name").value = "";
		document.getElementById("medical_coverage_ratio").value = "";
		document.getElementById("medical_coverage_amount").value = "";
		document.getElementById("medical_coverage_remark").value = "";
	}
</script>
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
								<a href="<?php echo base_url();?>coremedicalcoverage">
									Medical Coverage List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coremedicalcoverage/addCoreMedicalCoverage">
									Add Medical Coverage
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
					Form Add Medical Coverage 
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
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>coremedicalcoverage" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coremedicalcoverage/processAddCoreMedicalCoverage',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddMedicalCoverage');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('grade_id', $coregrade, $data['grade_id'], 'id ="grade_id", class="form-control select2me"');?>
												<label class="control-label">Grade Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
															
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('class_id', $coreclass, $data['class_id'], 'id ="class_id", class="form-control select2me"');?>
												<label class="control-label">Class Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('job_title_id', $corejobtitle, $data['job_title_id'], 'id ="job_title_id", class="form-control select2me"');?>
												<label class="control-label">Job Title Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="medical_coverage_code" id="medical_coverage_code" value="<?php echo $data['medical_coverage_code']?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Medical Coverage Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="medical_coverage_name" id="medical_coverage_name" value="<?php echo $data['medical_coverage_name']?>" class="form-control">
												<label class="control-label">Medical Coverage Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
										
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="medical_coverage_ratio" id="medical_coverage_ratio" value="<?php echo $data['medical_coverage_ratio']?>" class="form-control" >
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Medical Coverage Ratio
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="medical_coverage_amount" id="medical_coverage_amount" value="<?php echo $data['medical_coverage_amount']?>" class="form-control">
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Medical Coverage Amount
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="medical_coverage_remark" id="medical_coverage_remark" class="form-control" ><?php echo $data['medical_coverage_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
