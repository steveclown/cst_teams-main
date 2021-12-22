<script>
	function ulang(){
		document.getElementById("shift_group_code").value = "";
		document.getElementById("shift_id").value = "";
		document.getElementById("shift_group_name").value = "";
		document.getElementById("shift_group_remark").value = "";
	}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Shift Group
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>shiftgroup" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>shiftgroup">
							Shift Group List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Shift Group
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
										echo form_open('shiftgroup/processAddShiftGroup',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddShiftGroup');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Shift Name
												<span class="required">
												*
												</span></label>
											
												<?php echo form_dropdown('shift_id', $shift, $data['shift_id'], 'id ="shift_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Shift Group Code
												<span class="required">
												*
												</span></label>
											
												<input type="text" name="shift_group_code" id="shift_group_code" value="<?php echo $data['shift_group_code']?>" class="form-control" placeholder="Shift Group Code">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Shift Group Name
												<span class="required">
												*
												</span></label>
											
												<input type="text" name="shift_group_name" id="shift_group_name" value="<?php echo $data['shift_group_name']?>" class="form-control" placeholder="Shift Group Name">
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Shift Group Remark
												<span class="required">
												*
												</span></label>
											
												<textarea rows="3" name="shift_group_remark" id="shift_group_remark" class="form-control"><?php echo $data['shift_group_remark']?></textarea>
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
