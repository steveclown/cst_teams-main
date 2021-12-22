<script>
function ulang(){
	document.getElementById("premi_attendance_id").value = "";
	document.getElementById("premi_attendance_code").value = "";
	document.getElementById("premi_attendance_name").value = "";
	document.getElementById("premi_attendance_range1").value = "";
	document.getElementById("premi_attendance_range2").value = "";
	document.getElementById("premi_attendance_amount").value = "";
	document.getElementById("premi_attendance_remark").value = "";
}
</script>

					<div class = "page-bar">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corepremiattendance">
									Premi Attendance List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corepremiattendance/addCorePremiAttendance">
									Add Premi Attendance
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Premi Attendance 
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
									<a href="<?php echo base_url();?>corepremiattendance" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corepremiattendance/processAddCorePremiAttendance',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addpremiattendance');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="premi_attendance_code" id="premi_attendance_code" class="form-control" value="<?php echo $data['premi_attendance_code']?>">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Premi Attendance Code
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="premi_attendance_name" id="premi_attendance_name" class="form-control" value="<?php echo $data['premi_attendance_name']?>" >
												<label class="control-label">Premi Attendance Name</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="premi_attendance_range1" id="premi_attendance_range1" class="form-control" value="<?php echo $data['premi_attendance_range1']?>" >
												<label class="control-label">Premi Attendance Range 1</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="premi_attendance_range2" id="premi_attendance_range2" class="form-control" value="<?php echo $data['premi_attendance_range2']?>">
												<label class="control-label">Premi Attendance Range 2</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="premi_attendance_amount" id="premi_attendance_amount" class="form-control" value="<?php echo $data['premi_attendance_amount']?>" >
												<label class="control-label">Premi Attendance Amount</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="premi_attendance_remark" id="premi_attendance_remark" class="form-control"><?php echo $data['premi_attendance_remark']?></textarea>
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
