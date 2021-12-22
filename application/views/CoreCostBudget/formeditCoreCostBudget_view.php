<script>
	function ulang(){
		document.getElementById("cost_budget_code").value = "<?php echo $corecostbudget['cost_budget_code'] ?>";
		document.getElementById("cost_budget_name").value = "<?php echo $corecostbudget['cost_budget_name'] ?>";
		document.getElementById("cost_budget_amount").value = "<?php echo $corecostbudget['cost_budget_amount'] ?>";
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
								<a href="<?php echo base_url();?>corecostbudget">
									Cost Budget List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corecostbudget/editCoreCostBudget/<?php echo $corecostbudget['cost_budget_id']?>">
									Edit Cost Budget
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
					Form Edit Cost Budget 
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
									<a href="<?php echo base_url();?>corecostbudget" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('corecostbudget/processEditCoreCostBudget',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="cost_budget_code" id="cost_budget_code" value="<?php echo $corecostbudget['cost_budget_code'];?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Cost Budget Code
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="cost_budget_name" id="cost_budget_name" value="<?php echo $corecostbudget['cost_budget_name'];?>" class="form-control" >
												<label class="control-label">Cost Budget Name
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
												<input type="text" name="cost_budget_amount" id="cost_budget_amount" value="<?php echo $corecostbudget['cost_budget_amount'];?>" class="form-control" >
												<label class="control-label">Cost Budget Amount
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
										
									<input type="hidden" name="cost_budget_id" value="<?php echo $corecostbudget['cost_budget_id']; ?>"/>
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
				
