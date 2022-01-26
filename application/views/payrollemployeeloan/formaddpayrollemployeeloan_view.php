<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollemployeeloan/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeloan/function_elements_add');?>",
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
				url : "<?php echo site_url('payrollemployeeloan/function_state_add');?>",
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
								<a href="<?php echo base_url();?>payrollemployeeloan">
									Employee Loan Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeeloan/addPayrollEmployeeLoan/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Loan Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Employee Loan Data - <?php echo $hroemployeedata['employee_name'];?> -
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->



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
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>payrollemployeeloan" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('payrollemployeeloan/processAddPayrollEmployeeLoan',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhroemployeeloan');
										$employee_id =  $this->session->userdata('employee_id');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('loan_type_id', $coreloantype ,set_value('loan_type_id',$data['loan_type_id']),'id="loan_type_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Loan Type Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_loan_date" id="employee_loan_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_loan_date']);?>"/>
												<label class="control-label">Loan Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_loan_description" id="employee_loan_description" value="<?php echo $data['employee_loan_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Description</label>
											</div>
										</div>
									
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('loan_month_start', $monthlist,set_value('loan_month_start',$data['loan_month_start']),'id="loan_month_start" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Start Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('loan_year_start', $year,set_value('loan_year_start',$data['loan_year_start']),'id="loan_year_start" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
									</div>
										
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_loan_amount_total" id="employee_loan_amount_total" value="<?php echo $data['employee_loan_amount_total']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Loan Amount Total
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_loan_amount" id="employee_loan_amount" value="<?php echo $data['employee_loan_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Loan Amount Per Period
													<span class="required">
														*
													</span>
												</label>
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
