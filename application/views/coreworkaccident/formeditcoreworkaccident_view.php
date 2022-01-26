
<script>
function ulang(){
	document.getElementById("work_accident_name").value = "<?php echo $coreworkaccident['work_accident_name'] ?>";
	document.getElementById("work_accident_id").value = "<?php echo $coreworkaccident['work_accident_id'] ?>";
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
								<a href="<?php echo base_url();?>coreworkaccident">
									Work Accident List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreworkaccident/editCoreWorkAccident/<?php echo $coreworkaccident['work_accident_id']?>">
									Edit Work Accident
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
					Form Edit Work Accident 
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
									<a href="<?php echo base_url();?>coreworkaccident" class="btn btn-default btn-sm`">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coreworkaccident/processEditCoreWorkAccident',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="work_accident_name" id="work_accident_name" value="<?php echo $coreworkaccident['work_accident_name']?>" class="form-control">
												<label class="control-label">Work Accident Name</label>
											</div>
										</div>
									</div>	

									<input type="hidden" name="work_accident_id" value="<?php echo $coreworkaccident['work_accident_id']; ?>"/>
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
				
