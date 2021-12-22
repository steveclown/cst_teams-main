<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"payrollemployeeadditionalilufa/reset_add/";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalilufa/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalilufa/function_state_add');?>",
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
								<a href="<?php echo base_url();?>payrollemployeeadditionalilufa">
									Payroll Employee Additional List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeeadditionalilufa/addPayrollEmployeeAdditional/<?php echo $hroemployeedata['employee_id']?>">
									Add Payroll Employee Additional
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Payroll Employee Additional - <?php echo $hroemployeedata['employee_name'];?> -
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->



<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Employee Additional
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
								<input type="text" name="division_name" id="division_name" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
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

	$data 		= $this->session->userdata('addpayrollemployeeadditionalilufa-'.$unique['unique']);
?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollemployeeadditionalilufa" class="btn btn-default sm">
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

								if($data['active_tab']=="" || $data['active_tab']=="payrollbonus"){
									$tabpayrollbonus = "<li class='active'><a href='#tabpayrollbonus' name='payrollbonus' data-toggle='tab' onClick='function_state_add(this.name)'><b>Bonus</b></a></li>";
								}else{
									$tabpayrollbonus = "<li><a href='#tabpayrollbonus' data-toggle='tab' name='payrollbonus' onClick='function_state_add(this.name)'><b>Bonus</b></a></li>";
								}

								if($data['active_tab']=="payrollcommission"){
									$tabpayrollcommission = "<li class='active'><a href='#tabpayrollcommission' name='payrollcommission' data-toggle='tab' onClick='function_state_add(this.name)'><b>Commission</b></a></li>";
								}else{
									$tabpayrollcommission = "<li><a href='#tabpayrollcommission' data-toggle='tab' name='payrollcommission' onClick='function_state_add(this.name)'><b>Commission</b></a></li>";
								}

								if($data['active_tab']=="payrollincentive"){
									$tabpayrollincentive = "<li class='active'><a href='#tabpayrollincentive' name='payrollincentive' data-toggle='tab' onClick='function_state_add(this.name)'><b>Incentive</b></a></li>";
								}else{
									$tabpayrollincentive = "<li><a href='#tabpayrollincentive' data-toggle='tab' name='payrollincentive' onClick='function_state_add(this.name)'><b>Incentive</b></a></li>";
								}

								if($data['active_tab']=="payrolllostitem"){
									$tabpayrolllostitem = "<li class='active'><a href='#tabpayrolllostitem' name='payrolllostitem' data-toggle='tab' onClick='function_state_add(this.name)'><b>Lost Item</b></a></li>";
								}else{
									$tabpayrolllostitem = "<li><a href='#tabpayrolllostitem' data-toggle='tab' name='payrolllostitem' onClick='function_state_add(this.name)'><b>Lost Item</b></a></li>";
								}

								if($data['active_tab']=="payrollpremi"){
									$tabpayrollpremi = "<li class='active'><a href='#tabpayrollpremi' name='payrollpremi' data-toggle='tab' onClick='function_state_add(this.name)'><b>Premi</b></a></li>";
								}else{
									$tabpayrollpremi = "<li><a href='#tabpayrollpremi' data-toggle='tab' name='payrollpremi' onClick='function_state_add(this.name)'><b>Premi</b></a></li>";
								}
								
								echo $tabpayrollbonus;
								echo $tabpayrollcommission;
								echo $tabpayrollincentive;
								echo $tabpayrolllostitem;
								echo $tabpayrollpremi;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="payrollbonus"){
									$statpayrollbonus = "active";
								}else{
									$statpayrollbonus = "";
								}

								if($data['active_tab']=="payrollcommission"){
									$statpayrollcommission = "active";
								}else{
									$statpayrollcommission = "";
								}

								if($data['active_tab']=="payrollincentive"){
									$statpayrollincentive = "active";
								}else{
									$statpayrollincentive = "";
								}

								if($data['active_tab']=="payrolllostitem"){
									$statpayrolllostitem = "active";
								}else{
									$statpayrolllostitem = "";
								}

								if($data['active_tab']=="payrollpremi"){
									$statpayrollpremi = "active";
								}else{
									$statpayrollpremi = "";
								}
								
								echo"<div class='tab-pane ".$statpayrollbonus."' id='tabpayrollbonus'>";
									$this->load->view("payrollemployeeadditionalilufa/formaddpayrollemployeebonus_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollcommission."' id='tabpayrollcommission'>";
									$this->load->view("payrollemployeeadditionalilufa/formaddpayrollemployeecommission_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollincentive."' id='tabpayrollincentive'>";
									$this->load->view("payrollemployeeadditionalilufa/formaddpayrollemployeeincentive_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrolllostitem."' id='tabpayrolllostitem'>";
									$this->load->view("payrollemployeeadditionalilufa/formaddpayrollemployeelostitem_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollpremi."' id='tabpayrollpremi'>";
									$this->load->view("payrollemployeeadditionalilufa/formaddpayrollemployeepremi_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			