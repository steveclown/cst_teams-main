<script>
	function ulang(){
		document.getElementById("expertise_code").value = "<?php echo $result['expertise_code'] ?>";
		document.getElementById("expertise_name").value = "<?php echo $result['expertise_name'] ?>";
		document.getElementById("expertise_id").value = "<?php echo $result['expertise_id'] ?>";
	}
</script>
<?php 
echo form_open('expertise/processeditexpertise',array('id' => 'myform', 'class' => 'form-horizontal')); 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit expertise
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
							Expertise List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>expertise/edit/<?php echo $result['expertise_id'];?>">
							Edit expertise
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
								</span></label>
								<div class="col-md-8">
									<input type="text" name="expertise_code" id="expertise_code" value="<?php echo $result['expertise_code'];?>" class="form-control" placeholder="Expertise Code">
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Expertise Name
								<span class="required">
								*
								</span></label>
								<div class="col-md-8">
									<input type="text" name="expertise_name" id="expertise_name" value="<?php echo $result['expertise_name'];?>" class="form-control" placeholder="Expertise Name">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Expertise Remark
								<span class="required">
								*
								</span></label>
								<div class="col-md-8">
									<textarea class="form-control" name="expertise_remark" id="expertise_remark"><?php echo set_value('expertise_remark',$data['expertise_remark']);?></textarea>
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
				<input type="hidden" name="expertise_id" value="<?php echo $result['expertise_id']; ?>"/>
<?php echo form_close(); ?>