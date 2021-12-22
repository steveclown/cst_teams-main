<script>
function ulang(){
	document.getElementById("loan_type_code").value = "<?php echo $result['loan_type_code'] ?>";
	document.getElementById("loan_type_name").value = "<?php echo $result['loan_type_name'] ?>";
}
</script>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Loan Type
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>loantype" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>loantype">
							Loan Type List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>loantype/edit/<?php echo $result['loan_type_id'];?>">
							Edit Loan Type
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
									echo form_open('loantype/processEditLoanType',array('id' => 'myform', 'class' => 'horizontal-form')); 
								?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Loan Type Code
												<span class="required">
												*
												</span></label>
											
												<input type="text" name="loan_type_code" id="loan_type_code" value="<?php echo $result['loan_type_code'];?>" class="form-control" placeholder="Loan Type Code">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Loan Type Name
												<span class="required">
												*
												</span></label>
											
												<input type="text" name="loan_type_name" id="loan_type_name" value="<?php echo $result['loan_type_name'];?>" class="form-control" placeholder="Loan Type Name">
											</div>
										</div>
									</div>
								</div>
								<input type="hidden" name="loan_type_id" value="<?php echo $result['loan_type_id']; ?>"/>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				
