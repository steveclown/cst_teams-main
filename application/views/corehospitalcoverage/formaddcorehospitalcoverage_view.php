<script>
	function ulang(){
		document.getElementById("hospital_coverage_code").value = "";
		document.getElementById("grade_id").value = "";
		document.getElementById("class_id").value = "";
		document.getElementById("job_title_id").value = "";
		document.getElementById("hospital_coverage_name").value = "";
		document.getElementById("hospital_coverage_medicine_ratio").value = "";
		document.getElementById("hospital_coverage_medicine_amount").value = "";
		document.getElementById("hospital_coverage_room_ratio").value = "";
		document.getElementById("hospital_coverage_room_amount").value = "";
		document.getElementById("hospital_coverage_remark").value = "";
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
								<a href="<?php echo base_url();?>corehospitalcoverage">
									Hospital Coverage List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corehospitalcoverage/addCoreHospitalCoverage">
									Add Hospital Coverage
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Hospital Coverage
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
									<a href="<?php echo base_url();?>corehospitalcoverage" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corehospitalcoverage/processAddCoreHospitalCoverage',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddHospitalCoverage');
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
												<input type="text" autocomplete="off"  name="hospital_coverage_code" id="hospital_coverage_code" value="<?php echo $data['hospital_coverage_code']?>" class="form-control" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Hospital Coverage Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">									
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="hospital_coverage_name" id="hospital_coverage_name" value="<?php echo $data['hospital_coverage_name']?>" class="form-control" >
												<label class="control-label">Hospital Coverage Name
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
												<input type="text" autocomplete="off"  name="hospital_coverage_medicine_ratio" id="hospital_coverage_medicine_ratio" value="<?php echo $data['hospital_coverage_medicine_ratio']?>" class="form-control" >
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Medicine Ratio
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="hospital_coverage_medicine_amount" id="hospital_coverage_medicine_amount" value="<?php echo $data['hospital_coverage_medicine_amount']?>" class="form-control">
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Medicine Amount
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
												<input type="text" autocomplete="off"  name="hospital_coverage_room_ratio" id="hospital_coverage_room_ratio" value="<?php echo $data['hospital_coverage_room_ratio']?>" class="form-control" >
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Room Ratio
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="hospital_coverage_room_amount" id="hospital_coverage_room_amount" value="<?php echo $data['hospital_coverage_room_amount']?>" class="form-control" >
												<span class="help-block">
													 Please input only numbers.
												</span>
												<label class="control-label">Room Amount
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
												<textarea rows="3" name="hospital_coverage_remark" id="hospital_coverage_remark" class="form-control"><?php echo $data['hospital_coverage_remark'];?></textarea>
												<label class="control-label">Hospital Coverage Remark</label>
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
