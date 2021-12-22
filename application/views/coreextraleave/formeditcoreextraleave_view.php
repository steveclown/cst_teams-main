<script>
	function ulang(){
		document.getElementById("extra_leave_id").value = "<?php echo $coreextraleave['extra_leave_id'] ?>";
		document.getElementById("extra_leave_name").value = "<?php echo $coreextraleave['extra_leave_name'] ?>";
		document.getElementById("extra_leave_code").value = "<?php echo $coreextraleave['extra_leave_code'] ?>";
		document.getElementById("extra_leave_range1").value = "<?php echo $coreextraleave['extra_leave_range1'] ?>";
		document.getElementById("extra_leave_range2").value = "<?php echo $coreextraleave['extra_leave_range2'] ?>";
		document.getElementById("extra_leave_days").value = "<?php echo $coreextraleave['extra_leave_days'] ?>";
		document.getElementById("extra_leave_remark").value = "<?php echo $coreextraleave['extra_leave_remark'] ?>";
	}
</script>


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
					<a href="<?php echo base_url();?>coreextraleave">
						Extra Leave List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coreextraleave/editCoreExtraLeave/<?php echo $coreextraleave['extra_leave_id']?>">
						Edit Extra Leave
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Extra Leave 
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
						<a href="<?php echo base_url();?>coreextraleave" class="btn btn-default btn-sm`">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('coreextraleave/processEditCoreExtraLeave',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="extra_leave_code" id="extra_leave_code" class="form-control" value="<?php echo $coreextraleave['extra_leave_code']?>">
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Extra Leave Code</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="extra_leave_name" id="extra_leave_name" class="form-control" value="<?php echo $coreextraleave['extra_leave_name']?>" >
									<label class="control-label">Extra Leave Name</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="extra_leave_range1" id="extra_leave_range1" class="form-control" value="<?php echo $coreextraleave['extra_leave_range1']?>" >
									<span class="help-block">
										Please input only numbers.
									</span>
									<label class="control-label">Extra Leave Range 1</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="extra_leave_range2" id="extra_leave_range2" class="form-control" value="<?php echo $coreextraleave['extra_leave_range2']?>" >
									<span class="help-block">
										Please input only numbers.
									</span>
									<label class="control-label">Extra Leave Range 2</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="extra_leave_days" id="extra_leave_days" class="form-control" value="<?php echo $coreextraleave['extra_leave_days']?>" >
									<span class="help-block">
										Please input only numbers.
									</span>
									<label class="col-md-3 control-label">Extra Leave Days</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="extra_leave_remark" id="extra_leave_remark" class="form-control"><?php echo $coreextraleave['extra_leave_remark']?></textarea>
									<label class="col-md-3 control-label">Remark</label>
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="extra_leave_id" value="<?php echo $coreextraleave['extra_leave_id']; ?>"/>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>