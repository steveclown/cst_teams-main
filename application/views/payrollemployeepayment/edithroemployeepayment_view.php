<script>
function ulang(){
	document.getElementById("employee_bank_name").value = "<?php echo $result['employee_bank_name'] ?>";
	document.getElementById("employee_bank_acct_name").value = "<?php echo $result['employee_bank_acct_name'] ?>";
	document.getElementById("employee_bank_acct_no").value = "<?php echo $result['employee_bank_acct_no'] ?>";
}
</script>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Payment
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>" class="btn green yellow-stripe">
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
						<a href="#">
							Edit Employee Payment
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Edit
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
<?php 
	echo form_open('hroemployeepayment/processedithroemployeepayment',array('id' => 'myform', 'class' => 'form-horizontal')); 
?>
										<div class="form-group">
											<label class="col-md-3 control-label">Bank Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" name="employee_bank_name" id="employee_bank_name" value="<?php echo $result['employee_bank_name'];?>" class="form-control" placeholder="Bank Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Account Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" name="employee_bank_acct_name" id="employee_bank_acct_name" value="<?php echo $result['employee_bank_acct_name'];?>" class="form-control" placeholder="Account Name">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Account Number
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" name="employee_bank_acct_no" id="employee_bank_acct_no" value="<?php echo $result['employee_bank_acct_no'];?>" class="form-control" placeholder="Account Number">
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
				<input type="hidden" name="employee_id" value="<?php echo $result['employee_id']; ?>"/>
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
