<script>
function ulang(){
	document.getElementById("sub_asset_code").value = "";
	document.getElementById("sub_asset_name").value = "";
	document.getElementById("asset_id").value = "";
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
							<a href="<?php echo base_url();?>coresubasset">
								Sub Asset List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>coresubasset/addCoreSubAsset">
								Add Sub Asset 
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Add Sub Asset 
				</h1>
				<!-- END PAGE TITLE & BREADCRUMB-->
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$data = $this->session->userdata('addsubasset');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>coresubasset" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php echo form_open('coresubasset/processAddCoreSubAsset',array('class' => 'horizontal-form')); ?>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('asset_id', $coreasset,$data['asset_id'],'id="asset_id", class="form-control select2me"');?>
								<label class="control-label">Asset Name<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="sub_asset_code" id="sub_asset_code"  value="<?php echo set_value('sub_asset_code',$data['sub_asset_code']);?>"/>
								<span class="help-block">
									Please input only alpha-numerical characters.
								</span>
								<label class="control-label">Sub Asset Code<span class="required">*</span></label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  class="form-control" name="sub_asset_name" id="sub_asset_name" value="<?php echo set_value('sub_asset_name',$data['sub_asset_name']);?>"/>
								<label class="control-label">Sub Asset Name<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
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