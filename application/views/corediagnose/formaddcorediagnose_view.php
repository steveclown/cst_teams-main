<script>
	function ulang(){
		document.getElementById("diagnose_id").value = "";
		document.getElementById("diagnose_name").value = "";
		document.getElementById("diagnose_code").value = "";
		document.getElementById("diagnose_remark").value = "";
	}
</script>
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb ">
							<li>
								<a href="<?php echo base_url();?>">
									Master
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corediagnose">
									Diagnose List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corediagnose/addCoreDiagnose">
									Add Diagnose
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Diagnose
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
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>corediagnose" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corediagnose/processAddCoreDiagnose',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddDiagnose');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="diagnose_code" id="diagnose_code" class="form-control" value="<?php echo $data['diagnose_code']?>">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Diagnose Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="diagnose_name" id="diagnose_name" class="form-control" value="<?php echo $data['diagnose_name']?>">
												<label class="control-label">Diagnose Name</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="diagnose_remark" id="diagnose_remark" class="form-control"><?php echo $data['diagnose_remark']?></textarea>
												<label class="control-label">Diagnose Remark</label>
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
