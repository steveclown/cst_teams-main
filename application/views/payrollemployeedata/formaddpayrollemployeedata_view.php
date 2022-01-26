<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"payrollemployeedata/reset_add/";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedata/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedata/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

</script>

<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>


		
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
								<a href="<?php echo base_url();?>payrollemployeedata">
									Payroll Employee Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeedata/addPayrollEmployeeData/<?php echo $hroemployeedata['employee_id']?>">
									Add Payroll Employee Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Payroll Employee Data - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
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

<?php
	$unique 	= $this->session->userdata('unique');

	$data 		= $this->session->userdata('addpayrollemployeedata-'.$unique['unique']);
?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeedata" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					
					<?php 
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>	
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="payrollpayment"){
									$tabpayrollpayment = "<li class='active'><a href='#tabpayrollpayment' name='payrollpayment' data-toggle='tab' onClick='function_state_add(this.name);'><b>Payment</b></a></li>";
								}else{
									$tabpayrollpayment = "<li><a href='#tabpayrollpayment' data-toggle='tab' name='payrollpayment' onClick='function_state_add(this.name);'><b>Payment</b></a></li>";
								}

								if($data['active_tab']=="payrollallowance"){
									$tabpayrollallowance = "<li class='active'><a href='#tabpayrollallowance' name='payrollallowance' data-toggle='tab' onClick='function_state_add(this.name)'><b>Allowance</b></a></li>";
								}else{
									$tabpayrollallowance = "<li><a href='#tabpayrollallowance' data-toggle='tab' name='payrollallowance' onClick='function_state_add(this.name)'><b>Allowance</b></a></li>";
								}

								if($data['active_tab']=="payrolldeduction"){
									$tabpayrolldeduction = "<li class='active'><a href='#tabpayrolldeduction' name='payrolldeduction' data-toggle='tab' onClick='function_state_add(this.name)'><b>Deduction</b></a></li>";
								}else{
									$tabpayrolldeduction = "<li><a href='#tabpayrolldeduction' data-toggle='tab' name='payrolldeduction' onClick='function_state_add(this.name)'><b>Deduction</b></a></li>";
								}

								if($data['active_tab']=="payrollpremiattendance"){
									$tabpayrollpremiattendance = "<li class='active'><a href='#tabpayrollpremiattendance' name='payrollpremiattendance' data-toggle='tab' onClick='function_state_add(this.name)'><b>Premi Attendance</b></a></li>";
								}else{
									$tabpayrollpremiattendance = "<li><a href='#tabpayrollpremiattendance' name='payrollpremiattendance' data-toggle='tab' onClick='function_state_add(this.name)'><b>Premi Attendance</b></a></li>";
								}

								if($data['active_tab']=="payrollbpjs"){
									$tabpayrollbpjs = "<li class='active'><a href='#tabpayrollbpjs' name='payrollbpjs' data-toggle='tab' onClick='function_state_add(this.name)'><b>BPJS</b></a></li>";
								}else{
									$tabpayrollbpjs = "<li><a href='#tabpayrollbpjs' name='payrollbpjs' data-toggle='tab' onClick='function_state_add(this.name)'><b>BPJS</b></a></li>";
								}

								if($data['active_tab']=="payrollloan"){
									$tabpayrollloan = "<li class='active'><a href='#tabpayrollloan' name='payrollloan' data-toggle='tab' onClick='function_state_add(this.name)'><b>Loan</b></a></li>";
								}else{
									$tabpayrollloan = "<li><a href='#tabpayrollloan' name='payrollloan' data-toggle='tab' onClick='function_state_add(this.name)'><b>Loan</b></a></li>";
								}
								
								echo $tabpayrollpayment;
								echo $tabpayrollallowance;
								echo $tabpayrolldeduction;
								echo $tabpayrollpremiattendance;
								echo $tabpayrollbpjs;
								echo $tabpayrollloan;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="payrollpayment"){
									$statpayrollpayment = "active";
								}else{
									$statpayrollpayment = "";
								}

								if($data['active_tab']=="payrollallowance"){
									$statpayrollallowance = "active";
								}else{
									$statpayrollallowance = "";
								}

								if($data['active_tab']=="payrolldeduction"){
									$statpayrolldeduction = "active";
								}else{
									$statpayrolldeduction = "";
								}

								if($data['active_tab']=="payrollpremiattendance"){
									$statpayrollpremiattendance = "active";
								}else{
									$statpayrollpremiattendance = "";
								}

								if($data['active_tab']=="payrollbpjs"){
									$statpayrollbpjs = "active";
								}else{
									$statpayrollbpjs = "";
								}

								if($data['active_tab']=="payrollloan"){
									$statpayrollloan = "active";
								}else{
									$statpayrollloan = "";
								}
								
								echo"<div class='tab-pane ".$statpayrollpayment."' id='tabpayrollpayment'>";
									$this->load->view("payrollemployeedata/formaddpayrollemployeepayment_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollallowance."' id='tabpayrollallowance'>";
									$this->load->view("payrollemployeedata/formaddpayrollemployeeallowance_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrolldeduction."' id='tabpayrolldeduction'>";
									$this->load->view("payrollemployeedata/formaddpayrollemployeededuction_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollpremiattendance."' id='tabpayrollpremiattendance'>";
									$this->load->view("payrollemployeedata/formaddpayrollemployeepremiattendance_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollbpjs."' id='tabpayrollbpjs'>";
									$this->load->view("payrollemployeedata/formaddpayrollemployeebpjs_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollloan."' id='tabpayrollloan'>";
									$this->load->view("payrollemployeedata/formaddpayrollemployeeloan_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			