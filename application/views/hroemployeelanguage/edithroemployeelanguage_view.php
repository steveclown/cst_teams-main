<script>
	function ulang(){
		document.getElementById("language_id").value = "<?php echo $result['language_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_language_listen").value = "<?php echo $result['employee_language_listen'] ?>";
		document.getElementById("employee_language_read").value = "<?php echo $result['employee_language_read'] ?>";
		document.getElementById("employee_language_skill_write").value = "<?php echo $result['employee_language_skill_write'] ?>";
		document.getElementById("employee_language_skill_speak").value = "<?php echo $result['employee_language_skill_speak'] ?>";
		document.getElementById("employee_language_remark").value = "<?php echo $result['employee_language_remark'] ?>";
	}
	
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Language
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeelanguage" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeelanguage">
							Employee Language List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeelanguage/edit/<?php echo $result['employee_language_id'];?>">
							Edit Employee Language
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
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
							<div class="portlet-body">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeelanguage/processEdithroemployeelanguage',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$employee_id =  $this->session->userdata('employee_id');
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Language Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('language_id', $language ,set_value('language_id',$result['language_id']),'id="language_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeelanguage_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Listening
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_language_listen', $listeningskill ,set_value('employee_language_listen',$result['employee_language_listen']),'id="employee_language_listen", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Reading
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_language_read', $readingskill ,set_value('employee_language_read',$result['employee_language_read']),'id="employee_language_read", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Writing
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_language_skill_write', $writingskill ,set_value('employee_language_skill_write',$result['employee_language_skill_write']),'id="employee_language_skill_write", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3">Speaking
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('employee_language_skill_speak', $speakingskill ,set_value('employee_language_skill_speak',$result['employee_language_skill_speak']),'id="employee_language_skill_speak", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_language_remark" id="employee_language_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_language_remark'];?></textarea>
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
				<input type="hidden" name="employee_language_id" value="<?php echo $result['employee_language_id']; ?>"/>
