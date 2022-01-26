<script>
	function ulang(){
		document.getElementById("region_id").value = "";
		document.getElementById("region_name").value = "";
		document.getElementById("region_code").value = "";
	}
</script>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Form Add Working Hour 
		</h3>
		<ul class="page-breadcrumb breadcrumb">
		<li class="btn-group">
			<div class="actions">
				<a href="<?php echo base_url();?>workhours" class="btn green yellow-stripe">
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
			<a href="<?php echo base_url();?>workhours">
				Working Hour List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">
				Add Working Hour
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
						echo form_open('workhours/processaddworkhours',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addworkhours');
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Shift Code<span class="required">*</span></label>
							
								<input type="text" autocomplete="off"  name="shift_code" id="shift_code" class="form-control" value="<?php echo $data['shift_code']?>" placeholder="Shift Code">
								<span class="help-block">
									Please input only alpha-numerical characters.
								</span>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Shift Name<span class="required">*</span></label>
							
								<input type="text" autocomplete="off"  name="shift_name" id="shift_name" class="form-control" value="<?php echo $data['shift_name']?>" placeholder="Shift Name">
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Start Working Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="start_working_hour" name="start_working_hour" value="<?php echo $data['start_working_hour'];?>" class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">End Working Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="end_working_hour" name="end_working_hour" value="<?php echo $data['end_working_hour'];?>" class="form-control timepicker timepicker-24">
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
								<label class="control-label">Start Rest Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="start_rest_hour" name="start_rest_hour" value="<?php echo $data['start_rest_hour'];?>" class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">End Rest Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="end_rest_hour" name="end_rest_hour" value="<?php echo $data['end_rest_hour'];?>" class="form-control timepicker timepicker-24">
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
								<label class="control-label">Due Time Late<span class="required">*</span></label>
							
								<input type="text" autocomplete="off"  name="due_time_late" id="due_time_late" value="<?php echo $data['due_time_late'];?>" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Due Time Late">
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Working Hour Remark</label>
							
								<textarea rows="3" name="shift_remark" id="shift_remark" class="form-control" placeholder="Remark"><?php echo $data['shift_remark'];?></textarea>
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
