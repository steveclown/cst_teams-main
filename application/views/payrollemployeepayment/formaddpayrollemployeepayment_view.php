<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollemployeepayment/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeepayment/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeepayment/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

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
								<a href="<?php echo base_url();?>payrollemployeepayment">
									Employee Payment List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeepayment/addPayrollEmployeePayment/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Payment
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Payment - <?php echo $hroemployeedata['employee_name'];?> -
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
					Employee Data
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->payrollemployeepayment_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->payrollemployeepayment_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->payrollemployeepayment_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
								<label class="control-label">Section </label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>payrollemployeepayment" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('payrollemployeepayment/processAddPayrollEmployeePayment',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('Addpayrollemployeepayment');
									?>
									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_payment_period', $year,set_value('employee_payment_period',$data['employee_payment_period']),'id="employee_payment_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="payment_basic_salary" name="payment_basic_salary" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['payment_basic_salary'];?>">
												<label class="control-label">Basic Salary </label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="payment_basic_overtime" name="payment_basic_overtime" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['payment_basic_overtime'];?>">
												<label class="control-label">Basic Overtime </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('bank_id', $corebank ,set_value('bank_id',$data['bank_id']),'id="bank_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Bank Name</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="payment_bank_acct_name" name="payment_bank_acct_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['payment_bank_acct_name'];?>">
												<label class="control-label">Bank Account Name </label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="payment_bank_acct_no" name="payment_bank_acct_no" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['payment_bank_acct_no'];?>">
												<label class="control-label">Bank Account No </label>
											</div>	
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_home_early_status', $homeearlystatus,set_value('employee_home_early_status',$data['employee_home_early_status']),'id="employee_home_early_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Home Early Status</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_amount" name="employee_home_early_amount" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_home_early_amount'];?>">
												<label class="control-label">Home Early Amount </label>
											</div>	
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
