<script>
	function ulang(){
		document.getElementById("employee_overtime_status").value = "<?php echo $result['employee_overtime_status'] ?>";
	}
</script>
<?php 
	date_default_timezone_set('Asia/Jakarta');
	echo form_open('attendanceregistration/processeditattendanceregistration',array('id' => 'myform', 'class' => 'form-horizontal')); 
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Attendance Registration : <?php echo $this->attendanceregistration_model->getemployeename($this->session->userdata('employee_id'));?>
					</h3>
				</div>
			</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Edit
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<div class="form-group">
											<label class="control-label col-md-3">Overtime Status
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php
												// $overtimestatus = $this->configuration->OvertimeStatus;
												echo form_dropdown('attendance_employee_id', $attendanceemployee, $attendance_employee_id['nama'], 'id ="attendance_employee_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<input type="hidden" name="employee_id" value="<?php echo $result['employee_id']; ?>"/>
<?php echo form_close(); ?>