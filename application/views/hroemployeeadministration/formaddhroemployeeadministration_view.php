<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"hroemployeeadministration/reset_add/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministration/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeadministration/function_state_add');?>",
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

	$unique 	= $this->session->userdata('unique');

	$data_tab	= $this->session->userdata('addhroemployeeadministrationtab-'.$unique['unique']);
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
								<a href="<?php echo base_url();?>hroemployeeadministration">
									Employee Late List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeadministration/addHROEmployeeAdministration/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Late
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Late - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division Name</label>
							</div>	
						</div>
					</div>

					<div class = "row">	
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department Name</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section Name</label>
							</div>	
						</div>
					</div>

					<div class = "row">	
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="branch_id" id="branch_id" value="<?php echo $hroemployeedata['branch_name']?>" class="form-control" readonly>
								<label class="control-label">Branch Name</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="location_id" id="location_id" value="<?php echo $hroemployeedata['location_name']?>" class="form-control" readonly>
								<label class="control-label">Location Name</label>
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
					<a href="<?php echo base_url();?>hroemployeeadministration" class="btn btn-default sm">
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
								if($data_tab['active_tab']=="" || $data_tab['active_tab']=="employeelate"){
									$tabemployeelate = "<li class='active'><a href='#tabemployeelate' name='employeelate' data-toggle='tab' onClick='function_state_add(this.name);'><b>Employee Late</b></a></li>";
								}else{
									$tabemployeelate = "<li><a href='#tabemployeelate' data-toggle='tab' name='employeelate' onClick='function_state_add(this.name);'><b>Employee Late</b></a></li>";
								}

								if($data_tab['active_tab']=="employeepermit"){
									$tabemployeepermit = "<li class='active'><a href='#tabemployeepermit' name='employeepermit' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Permit</b></a></li>";
								}else{
									$tabemployeepermit = "<li><a href='#tabemployeepermit' data-toggle='tab' name='employeepermit' onClick='function_state_add(this.name)'><b>Employee Permit</b></a></li>";
								}

								if($data_tab['active_tab']=="employeeabsence"){
									$tabemployeeabsence = "<li class='active'><a href='#tabemployeeabsence' name='employeeabsence' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Absence</b></a></li>";
								}else{
									$tabemployeeabsence = "<li><a href='#tabemployeeabsence' data-toggle='tab' name='employeeabsence' onClick='function_state_add(this.name)'><b>Employee Absence</b></a></li>";
								}

								if($data_tab['active_tab']=="employeeovertime"){
									$tabemployeeovertime = "<li class='active'><a href='#tabemployeeovertime' name='employeeovertime' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Overtime</b></a></li>";
								}else{
									$tabemployeeovertime = "<li><a href='#tabemployeeovertime' name='employeeovertime' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Overtime</b></a></li>";
								}

								if($data_tab['active_tab']=="employeeleave"){
									$tabemployeeleave = "<li class='active'><a href='#tabemployeeleave' name='employeeleave' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Leave</b></a></li>";
								}else{
									$tabemployeeleave = "<li><a href='#tabemployeeleave' name='employeeleave' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee Leave</b></a></li>";
								}
								
								echo $tabemployeelate;
								echo $tabemployeepermit;
								echo $tabemployeeabsence;
								echo $tabemployeeovertime;
								echo $tabemployeeleave;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data_tab['active_tab']=="" || $data_tab['active_tab']=="employeelate"){
									$statemployeelate = "active";
								}else{
									$statemployeelate = "";
								}

								if($data_tab['active_tab']=="employeepermit"){
									$statemployeepermit = "active";
								}else{
									$statemployeepermit = "";
								}

								if($data_tab['active_tab']=="employeeabsence"){
									$statemployeeabsence = "active";
								}else{
									$statemployeeabsence = "";
								}

								if($data_tab['active_tab']=="employeeovertime"){
									$statemployeeovertime = "active";
								}else{
									$statemployeeovertime = "";
								}

								if($data_tab['active_tab']=="employeeleave"){
									$statemployeeleave = "active";
								}else{
									$statemployeeleave = "";
								}
								
								echo"<div class='tab-pane ".$statemployeelate."' id='tabemployeelate'>";
									$this->load->view("hroemployeeadministration/formaddhroemployeelate_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeepermit."' id='tabemployeepermit'>";
									$this->load->view("hroemployeeadministration/formaddhroemployeepermit_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeabsence."' id='tabemployeeabsence'>";
									$this->load->view("hroemployeeadministration/formaddhroemployeeabsence_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeovertime."' id='tabemployeeovertime'>";
									$this->load->view("hroemployeeadministration/formaddpayrollovertimerequest_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statemployeeleave."' id='tabemployeeleave'>";
									$this->load->view("hroemployeeadministration/formaddpayrollleaverequest_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
