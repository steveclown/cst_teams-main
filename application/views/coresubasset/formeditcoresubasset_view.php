<script>
function ulang(){
	document.getElementById("subasset_code").value = "<?php echo $coresubasseet['subasset_code'] ?>";
	document.getElementById("subasset_name").value = "<?php echo $coresubasseet['subasset_name'] ?>";
	document.getElementById("subasset_id").value = "<?php echo $coresubasseet['subasset_id'] ?>";
	document.getElementById("asset_id").value = "<?php echo $coresubasseet['assset_id'] ?>";
}
</script>
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<i class="fa fa-home"></i>
								<a href="<?php echo base_url();?>">
									Master
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
								<a href="<?php echo base_url();?>coresubasset/editCoreSubAsset/<?php echo $coresubasseet['sub_asset_id']?>">
									Edit Sub asset
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Asset 
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
									<a href="<?php echo base_url();?>coresubasset" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('coresubasset/processEditCoreSubAsset',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('asset_id', $coreasset,$coresubasset['asset_id'],'id="asset_id", class="form-control"');?>
												<label class="control-label">Asset Name 
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="sub_asset_code" id="sub_asset_code" value="<?php echo $coresubasset['sub_asset_code'];?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Sub Asset Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="sub_asset_name" id="sub_asset_name" value="<?php echo $coresubasset['sub_asset_name'];?>" class="form-control">
												<label class="control-label">Sub Asset Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
										
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="sub_asset_id" value="<?php echo $coresubasset['sub_asset_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
