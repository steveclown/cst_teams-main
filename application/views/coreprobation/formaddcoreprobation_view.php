<script>
	function ulang(){
		document.getElementById("probation_id").value = "";
		document.getElementById("probation_code").value = "";
		document.getElementById("probation_name").value = "";
		document.getElementById("probation_remark").value = "";
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
								<a href="<?php echo base_url();?>coreprobation">
									Probation List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>coreprobation/addCoreProbation">
									Add Probation
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Probation 
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
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>coreprobation" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('coreprobation/processAddCoreProbation',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addprobation');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="probation_code" id="probation_code" value="<?php echo $data['probation_code'];?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Probation Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="probation_name" id="probation_name" value="<?php echo $data['probation_name'];?>" class="form-control" >
												<label class="control-label">Probation Name
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
												<textarea rows="3" name="probation_remark" id="probation_remark" class="form-control"><?php echo $data['probation_remark'];?></textarea>
												<label class="control-label">Remark</label>
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