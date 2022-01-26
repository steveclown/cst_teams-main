<script>
	function reset_session(){
		document.location = base_url+"payrollbasicsalary/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollbasicsalary/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollbasicsalary/function_state_add');?>",
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
								<a href="<?php echo base_url();?>payrollbasicsalary">
									Basic Salary List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollbasicsalary/addPayrollBasicSalary">
									Add Basic Salary
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Basic Salary
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	// print_r($data);exit;
?>			

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

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollbasicsalary" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('payrollbasicsalary/processAddPayrollBasicSalary',array('id' => 'myform', 'class' => 'horizontal-form'));
						$data = $this->session->userdata('addpayrollbasicsalary');
					?>		

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('basic_salary_period', $year,set_value('basic_salary_period',$data['basic_salary_period']),'id="basic_salary_period" class="form-control select2me"');
								?>
								<label></label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="basic_salary_total" id="basic_salary_total" value="<?php echo $data['basic_salary_total'];?>" class="form-control">
								<label class="control-label">Basic Salary Total
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="basic_salary_amount" id="basic_salary_amount" value="<?php echo $data['basic_salary_amount'];?>" class="form-control">
								<label class="control-label">Basic Salary Amount
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
								<input type="text" autocomplete="off"  name="meal_allowance_amount" id="meal_allowance_amount" value="<?php echo $data['meal_allowance_amount'];?>" class="form-control">
								<label class="control-label">Meal Allowance Amount
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="transport_allowance_amount" id="transport_allowance_amount" value="<?php echo $data['transport_allowance_amount'];?>" class="form-control">
								<label class="control-label">Transport Allowance Amount
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
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
