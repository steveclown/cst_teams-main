<script>
function ulang(){
	document.getElementById("overtime_rounded_id").value = "<?php echo $coreovertimerounded['overtime_rounded_id'] ?>";
	document.getElementById("overtime_minute_range1").value = "<?php echo $coreovertimerounded['overtime_minute_range1'] ?>";
	document.getElementById("overtime_minute_range2").value = "<?php echo $coreovertimerounded['overtime_minute_range2'] ?>";
	document.getElementById("overtime_minute_rounded").value = "<?php echo $coreovertimerounded['overtime_minute_rounded'] ?>";
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
					<a href="<?php echo base_url();?>coreovertimerounded">
						Overtime Rounded List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coreovertimerounded/editCoreOvertimeRounded/<?php echo $coreovertimerounded['overtime_rounded_id']; ?>">
						Edit Overtime Rounded
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Overtime Rounded 
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
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>coreovertimerounded" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('coreovertimerounded/processEditCoreOvertimeRounded',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="overtime_minute_range1" id="overtime_minute_range1" class="form-control" value="<?php echo $coreovertimerounded['overtime_minute_range1']?>" >
									<label class="control-label">Overtime Minute Range 1</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="overtime_minute_range2" id="overtime_minute_range2" class="form-control" value="<?php echo $coreovertimerounded['overtime_minute_range2']?>">
									<label class="control-label">Overtime Minute Range 2</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="overtime_minute_rounded" id="overtime_minute_rounded" class="form-control" value="<?php echo $coreovertimerounded['overtime_minute_rounded']?>">
									<label class="control-label">Overtime Minute Rounded</label>
								</div>
							</div>
						</div>
							<input type="hidden" name="overtime_rounded_id" value="<?php echo $coreovertimerounded['overtime_rounded_id']; ?>"/>
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
	
