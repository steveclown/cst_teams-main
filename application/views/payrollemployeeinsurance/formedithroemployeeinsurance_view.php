<script>
function ulang(){
		document.getElementById("employee_insurance_id").value = "<?php echo $result['employee_insurance_id'] ?>";
		document.getElementById("insurance_id").value = "<?php echo $result['insurance_id'] ?>";
		document.getElementById("insurance_premi_id").value = "<?php echo $result['insurance_premi_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_insurance_period").value = "<?php echo $result['employee_insurance_period'] ?>";
		document.getElementById("employee_insurance_premi_amount").value = "<?php echo $result['employee_insurance_premi_amount'] ?>";
		document.getElementById("employee_insurance_remark").value = "<?php echo $result['employee_insurance_remark'] ?>";
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Insurance Data
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeinsurance" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeeinsurance">
							Employee Insurance Data List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeinsurance/edit/<?php echo $result['employee_insurance_id'];?>">
							Edit Employee Insurance Data
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Form Add
								</div>
							</div>
							<div class="portlet-body">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeinsurance/processEdithroemployeeinsurance',array('id' => 'myform', 'class' => 'form-horizontal')); 
										$employee_id =  $this->session->userdata('employee_id');
									?>
										<div class="form-group">
											<label class="col-md-3 control-label">Insurance Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('insurance_id', $insurance ,set_value('insurance_id',$result['insurance_id']),'id="insurance_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Premi Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<?php echo form_dropdown('insurance_premi_id', $insurancepremi ,set_value('insurance_premi_id',$result['insurance_premi_id']),'id="insurance_premi_id", class="form-control select2me"');?>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Employee Name
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeinsurance_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Period
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_insurance_period" id="employee_insurance_period" value="<?php echo $result['employee_insurance_period']?>" class="form-control" placeholder="Period">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Amount
											<span class="required">
											*
											</span></label>
											<div class="col-md-8">
												<input type="text" autocomplete="off"  name="employee_insurance_premi_amount" id="employee_insurance_premi_amount" value="<?php echo $result['employee_insurance_premi_amount']?>" class="form-control" placeholder="Amount">
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="employee_insurance_remark" id="employee_insurance_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_insurance_remark'];?></textarea>
											</div>
										</div>
										<input type="hidden" name="employee_insurance_id" value="<?php echo $result['employee_insurance_id']; ?>"/>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				
