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
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"hroemployeeattendancediscrepancyckp/reset_add/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendancediscrepancyckp/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeeattendancediscrepancyckp">
									Employee Administration List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeattendancediscrepancyckp/addHROEmployeeAttendanceDiscrepancy/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Administration
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Discrepancy - <?php echo $hroemployeedata['employee_name'];?> -
					</h1>
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
								<label class="control-label">Division Name</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department Name</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section Name</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="unit_id" id="unit_id" value="<?php echo $hroemployeedata['unit_name']?>" class="form-control" readonly>
								<label class="control-label">Unit Name</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="job_title_name" id="job_title_name" value="<?php echo $hroemployeedata['job_title_name']?>" class="form-control" readonly>
								<label class="control-label">Job Title Name </label>
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
					<a href="<?php echo base_url();?>hroemployeeattendancediscrepancyckp" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								$unique 	= $this->session->userdata('unique');

								$data 		= $this->session->userdata('addhroemployeeattendancediscrepancyckp-'.$unique['unique']);

								if($data['active_tab']=="" || $data['active_tab']=="employeepermit"){
									$tabemployeepermit = "<li class='active'><a href='#tabemployeepermit' name='employeepermit' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Permit</b></a></li>";
								}else{
									$tabemployeepermit = "<li><a href='#tabemployeepermit' data-toggle='tab' name='employeepermit' onClick='function_state_add(this.name)'><b>Employee Permit</b></a></li>";
								}

								if($data['active_tab']=="employeeabsence"){
									$tabemployeeabsence = "<li class='active'><a href='#tabemployeeabsence' name='employeeabsence' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Absence</b></a></li>";
								}else{
									$tabemployeeabsence = "<li><a href='#tabemployeeabsence' data-toggle='tab' name='employeeabsence' onClick='function_state_add(this.name)'><b>Employee Absence</b></a></li>";
								}

								if($data['active_tab']=="employeeovertime"){
									$tabemployeeovertime = "<li class='active'><a href='#tabemployeeovertime' name='employeeovertime' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Overtime</b></a></li>";
								}else{
									$tabemployeeovertime = "<li><a href='#tabemployeeovertime' name='employeeovertime' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Overtime</b></a></li>";
								}

								if($data['active_tab']=="employeehomeearly"){
									$tabemployeehomeearly = "<li class='active'><a href='#tabemployeehomeearly' name='employeehomeearly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Home Early</b></a></li>";
								}else{
									$tabemployeehomeearly = "<li><a href='#tabemployeehomeearly' name='employeehomeearly' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Home Early</b></a></li>";
								}

								if($data['active_tab']=="employeecanceloff"){
									$tabemployeecanceloff = "<li class='active'><a href='#tabemployeecanceloff' name='employeecanceloff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Cancel Off</b></a></li>";
								}else{
									$tabemployeecanceloff = "<li><a href='#tabemployeecanceloff' name='employeecanceloff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Cancel Off</b></a></li>";
								}

								if($data['active_tab']=="employeeswapoff"){
									$tabemployeeswapoff = "<li class='active'><a href='#tabemployeeswapoff' name='employeeswapoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Swap Off</b></a></li>";
								}else{
									$tabemployeeswapoff = "<li><a href='#tabemployeeswapoff' name='employeeswapoff' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Swap Off</b></a></li>";
								}

								if($data['active_tab']=="employeeattendancestatus"){
									$tabemployeeattendancestatus = "<li class='active'><a href='#tabemployeeattendancestatus' name='employeeattendancestatus' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Attendance Status</b></a></li>";
								}else{
									$tabemployeeattendancestatus = "<li><a href='#tabemployeeattendancestatus' name='employeeattendancestatus' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Attendance Status</b></a></li>";
								}
								
								echo $tabemployeepermit;
								echo $tabemployeeabsence;
								echo $tabemployeeovertime;
								echo $tabemployeehomeearly;
								echo $tabemployeecanceloff;
								echo $tabemployeeswapoff;
								echo $tabemployeeattendancestatus;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeepermit"){
									$statemployeepermit = "active";
								}else{
									$statemployeepermit = "";
								}

								if($data['active_tab']=="employeeabsence"){
									$statemployeeabsence = "active";
								}else{
									$statemployeeabsence = "";
								}

								if($data['active_tab']=="employeeovertime"){
									$statemployeeovertime = "active";
								}else{
									$statemployeeovertime = "";
								}

								if($data['active_tab']=="employeehomeearly"){
									$statemployeehomeearly = "active";
								}else{
									$statemployeehomeearly = "";
								}

								if($data['active_tab']=="employeecanceloff"){
									$statemployeecanceloff = "active";
								}else{
									$statemployeecanceloff = "";
								}

								if($data['active_tab']=="employeeswapoff"){
									$statemployeeswapoff = "active";
								}else{
									$statemployeeswapoff = "";
								}

								if($data['active_tab']=="employeeattendancestatus"){
									$statemployeeattendancestatus = "active";
								}else{
									$statemployeeattendancestatus = "";
								}


								echo"<div class='tab-pane ".$statemployeepermit."' id='tabemployeepermit'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddhroemployeepermit_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeabsence."' id='tabemployeeabsence'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddhroemployeeabsence_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeovertime."' id='tabemployeeovertime'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddpayrollovertimerequest_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeehomeearly."' id='tabemployeehomeearly'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddhroemployeehomeearly_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeecanceloff."' id='tabemployeecanceloff'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddhroemployeecanceloff_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeswapoff."' id='tabemployeeswapoff'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddhroemployeeswapoff_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeattendancestatus."' id='tabemployeeattendancestatus'>";
									$this->load->view("hroemployeeattendancediscrepancyckp/formaddhroemployeeattendancestatus_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
