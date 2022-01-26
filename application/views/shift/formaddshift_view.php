<script>
	function ulang(){
		document.getElementById("shift_id").value = "";
		document.getElementById("shift_name").value = "";
		document.getElementById("shift_code").value = "";
		document.getElementById("start_working_hour").value = "";
		document.getElementById("end_working_hour").value = "";
		document.getElementById("start_rest_hour").value = "";
		document.getElementById("end_rest_hour").value = "";
		document.getElementById("due_time_late").value = "";
		document.getElementById("shift_remark").value = "";
	}
</script>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Shift
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>shift" class="btn green yellow-stripe">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
									 Back
								</span>
							</a>
						</div>
					</li>
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Master
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>shift">
							Shift List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>shift/add">
							Add Shift
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
<?php
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
<?php 
echo form_open('shift/processaddshift',array('id' => 'myform', 'class' => 'horizontal-form')); 
$data = $this->session->userdata('addshift');
?>					
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Shift Code</label>
											
												<input type="text" autocomplete="off"  name="shift_code" id="shift_code" class="form-control" value="<?php echo $data['shift_code']?>" placeholder="Shift Code">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Shift Name</label>
												
												<input type="text" autocomplete="off"  name="shift_name" id="shift_name" class="form-control" value="<?php echo $data['shift_name']?>" placeholder="Shift Name">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label ">Start Working Hour</label>
												
												<div class="input-group">
													<input type="text" autocomplete="off"  name="start_working_hour" id="start_working_hour" value="<?php echo $data['start_working_hour']?>" class="form-control timepicker timepicker-24">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">End Working Hour</label>
											
												<div class="input-group">
													<input type="text" autocomplete="off"  name="end_working_hour" id="end_working_hour" value="<?php echo $data['end_working_hour']?>" class="form-control timepicker timepicker-24">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Start Rest Hour</label>
											
												<div class="input-group">
													<input type="text" autocomplete="off"  name="start_rest_hour" id="start_rest_hour" value="<?php echo $data['start_rest_hour']?>" class="form-control timepicker timepicker-24">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">End Rest Hour</label>
											
												<div class="input-group">
													<input type="text" autocomplete="off"  name="end_rest_hour" id="end_rest_hour" value="<?php echo $data['end_rest_hour']?>" class="form-control timepicker timepicker-24">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Due Time Late</label>
											
												<input type="text" autocomplete="off"  name="due_time_late" id="due_time_late" class="form-control" value="<?php echo $data['due_time_late']?>" placeholder="Due Time Late">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label">Remark</label>
											
												<textarea rows="3" name="shift_remark" id="shift_remark" class="form-control"><?php echo $data['shift_remark']?></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>