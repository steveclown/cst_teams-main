<script>
	function ulang(){
		document.getElementById("expertise_code").value = "";
		document.getElementById("expertise_name").value = "";
	}
</script>
<?php echo form_open('expertise/processaddexpertise',array('class' => 'form-horizontal')); ?>

	<?php
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
		$data = $this->session->userdata('addexpertise');
	?>
	<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Expertise <small>Add</small>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<div class="actions">
							<a href="<?php echo base_url();?>expertise" class="btn green yellow-stripe">
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
							<a href="<?php echo base_url();?>expertise">
								expertise
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>expertise/Add">
								Add
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
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
							<div class="form-group">
								<label class="col-md-3 control-label">Expertise Code
								<span class="required">
								*
								</span>
								</label>
								
								<div class="col-md-4">
									<div class="input-icon right">
										<i class="fa"></i>
										<input type="text" class="form-control" name="expertise_code" id="expertise_code"  value="<?php echo set_value('expertise_code',$data['expertise_code']);?>"/>
									</div>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Expertise Name
								<span class="required">
								*
								</span>
								</label>
								<div class="col-md-4">
									<div class="input-icon right">
										<i class="fa"></i>
										<input type="text" class="form-control" name="expertise_name" id="expertise_name" value="<?php echo set_value('expertise_name',$data['expertise_name']);?>"/>
									</div>	
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Expertise Remark
								</label>
								<div class="col-md-4">
									<div class="input-icon right">
										<i class="fa"></i>
										<textarea class="form-control" name="expertise_remark" id="expertise_remark"><?php echo set_value('expertise_remark',$data['expertise_remark']);?></textarea>
									</div>	
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
<?php echo form_close(); ?>