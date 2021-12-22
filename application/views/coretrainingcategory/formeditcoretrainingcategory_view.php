<script>
	function ulang(){
		document.getElementById("training_category_id").value = "<?php echo $coretrainingcategory['training_category_id'] ?>";
		document.getElementById("training_category_code").value = "<?php echo $coretrainingcategory['training_category_code'] ?>";
		document.getElementById("training_category_name").value = "<?php echo $coretrainingcategory['training_category_name'] ?>";
		document.getElementById("training_category_remark").value = "<?php echo $coretrainingcategory['training_category_remark'] ?>";
	}
	
</script>
<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb ">
				<li>
					<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Home
						</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coretrainingcategory">
						Training Category List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coretrainingcategory/editCoreTrainingCategory/<?php echo $coretrainingcategory['training_category_id'];?>">
						Edit Training Category
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Training Category 
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Edit
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>coretrainingcategory" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('coretrainingcategory/processEditCoreTrainingCategory',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$logstat = array('off'=>'off','on'=>'on');
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="training_category_code" id="training_category_code" value="<?php echo $coretrainingcategory['training_category_code'];?>" class="form-control" >
								<span class="help-block">
									 Please input only alpha-numerical characters.
								</span>
								<label class="control-label">Training Category Code<span class="required">*</span></label>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="training_category_name" id="training_category_name" value="<?php echo $coretrainingcategory['training_category_name'];?>" class="form-control" >
								<label class="control-label">Training Category Name<span class="required">*</span></label>
							</div>
						</div>
					</div>
					<input type="hidden" name="training_category_id" value="<?php echo $coretrainingcategory['training_category_id']; ?>"/>
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

