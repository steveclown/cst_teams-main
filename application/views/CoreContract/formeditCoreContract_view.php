<script>
	function ulang(){
		document.getElementById("contract_id").value = "<?php echo $corecontract['contract_id'] ?>";
		document.getElementById("contract_code").value = "<?php echo $corecontract['contract_code'] ?>";
		document.getElementById("contract_name").value = "<?php echo $corecontract['contract_name'] ?>";
		document.getElementById("contract_remark").value = "<?php echo $corecontract['contract_remark'] ?>";
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
								<a href="<?php echo base_url();?>corecontract">
									Contract List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corecontract/editCoreContract/<?php echo $corecontract['contract_id']?>">
									Edit Contract
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Contract 
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<?php
					echo $this->session->userdata('message');
					$this->session->unset_userdata('message');
					?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box red-flamingo">
							<div class="portlet-title">
								<div class="caption">
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>corecontract" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
									echo form_open('corecontract/processEditCoreContract',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="contract_code" id="contract_code" value="<?php echo $corecontract['contract_code'];?>" class="form-control" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Contract Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="contract_name" id="contract_name" value="<?php echo $corecontract['contract_name'];?>" class="form-control" >
												
												<label class="control-label">Contract Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="4" name="contract_remark" id="contract_remark" class="form-control"><?php echo $corecontract['contract_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="contract_id" value="<?php echo $corecontract['contract_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>