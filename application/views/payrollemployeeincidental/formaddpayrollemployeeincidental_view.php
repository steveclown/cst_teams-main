<script>
	base_url = '<?php echo base_url();?>';

	function reset_session(){
		document.location = base_url+"payrollemployeeincidental/reset_session";
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeincidental/function_state_add');?>",
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
					<a href="<?php echo base_url();?>payrollemployeeincidental">
						Incidental Allowance List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>payrollemployeeincidental/addPayrollEmployeeIncidental/<?php echo $hroemployeedata['employee_id']?>">
						Add Employee Incidental
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Add Employee Incidental - <?php echo $hroemployeedata['employee_name']?> -
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
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->payrollemployeeincidental_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->payrollemployeeincidental_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->payrollemployeeincidental_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
					<a href="<?php echo base_url();?>payrollemployeeincidental" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="incidentalallowance"){
									$tabincidentalallowance = "<li class='active'><a href='#tabincidentalallowance' name='incidentalallowance' data-toggle='tab' onClick='function_state_add(this.name);'><b>Incidental Allowance</b></a></li>";
								}else{
									$tabincidentalallowance = "<li><a href='#tabincidentalallowance' data-toggle='tab' name='incidentalallowance' onClick='function_state_add(this.name);'><b>Incidental Allowance</b></a></li>";
								}

								if($data['active_tab']=="incidentaldeduction"){
									$tabincidentaldeduction = "<li class='active'><a href='#tabincidentaldeduction' name='incidentaldeduction' data-toggle='tab' onClick='function_state_add(this.name)'><b>Incidental Deduction</b></a></li>";
								}else{
									$tabincidentaldeduction = "<li><a href='#tabincidentaldeduction' data-toggle='tab' name='incidentaldeduction' onClick='function_state_add(this.name)'><b>Incidental Deduction</b></a></li>";
								}
								
								echo $tabincidentalallowance;
								echo $tabincidentaldeduction;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="incidentalallowance"){
									$statincidentalallowance = "active";
								}else{
									$statincidentalallowance = "";
								}

								if($data['active_tab']=="incidentaldeduction"){
									$statincidentaldeduction = "active";
								}else{
									$statincidentaldeduction = "";
								}
								
								echo"<div class='tab-pane ".$statincidentalallowance."' id='tabincidentalallowance'>";
									$this->load->view("payrollemployeeincidental/formaddpayrollincidentalallowance_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statincidentaldeduction."' id='tabincidentaldeduction'>";
									$this->load->view("payrollemployeeincidental/formaddpayrollincidentaldeduction_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

