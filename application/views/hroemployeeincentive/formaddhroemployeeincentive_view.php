<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeincentive/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeincentive/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeincentive/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#region_id").change(function(){
            var region_id 	= $("#region_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreBranch",
               data : {region_id: region_id},
               success: function(data){
                   $("#branch_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id 	= $("#branch_id").val();
 
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeincentive/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });


</script>
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
			<a href="<?php echo base_url();?>hroemployeeincentive">
				Employee Incentive List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>hroemployeeincentive/addHROEmployeeIncentive/<?php echo $hroemployeedata['employee_id']?>">
				Add Employee Incentive
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Form Add Employee Incentive - <?php echo $hroemployeedata['employee_name']?> -
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
								<input type="text" name="division_id_data" id="division_id_data" value="<?php echo $this->hroemployeeincentive_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id_data" id="department_id_data" value="<?php echo $this->hroemployeeincentive_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id_data" id="section_id_data" value="<?php echo $this->hroemployeeincentive_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
					<a href="<?php echo base_url();?>hroemployeeincentive" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<?php
				$unique 	= $this->session->userdata('unique');
				$auth		= $this->session->userdata('auth');
				$data 		= $this->session->userdata('addhroemployeeincentive-'.$unique['unique']);

				echo $this->session->userdata('message');
				$this->session->unset_userdata('message');
			?>

			<div class="portlet-body form">
				<div class="form-body">
					<div class="tabbable-line boxless tabbable-reversed ">
						<ul class="nav nav-tabs">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeorganization"){
									$tabemployeeorganization = "<li class='active'><a href='#tabemployeeorganization' name='employeeorganization' data-toggle='tab' onClick='function_state_add(this.name);'><b>Employee Organization</b></a></li>";
								}else{
									$tabemployeeorganization = "<li><a href='#tabemployeeorganization' data-toggle='tab' name='employeeorganization' onClick='function_state_add(this.name);'><b>Employee Organization</b></a></li>";
								}

								if($data['active_tab']=="payrolllostitem"){
									$tabpayrolllostitem = "<li class='active'><a href='#tabpayrolllostitem' name='payrolllostitem' data-toggle='tab' onClick='function_state_add(this.name)'><b>Lost Item</b></a></li>";
								}else{
									$tabpayrolllostitem = "<li><a href='#tabpayrolllostitem' data-toggle='tab' name='payrolllostitem' onClick='function_state_add(this.name)'><b>Lost Item</b></a></li>";
								}

								if($data['active_tab']=="payrollbonus"){
									$tabpayrollbonus = "<li class='active'><a href='#tabpayrollbonus' name='payrollbonus' data-toggle='tab' onClick='function_state_add(this.name)'><b>Payroll Bonus</b></a></li>";
								}else{
									$tabpayrollbonus = "<li><a href='#tabpayrollbonus' data-toggle='tab' name='payrollbonus' onClick='function_state_add(this.name)'><b>Payroll Bonus</b></a></li>";
								}

								if($data['active_tab']=="payrollcommission"){
									$tabpayrollcommission = "<li class='active'><a href='#tabpayrollcommission' name='payrollcommission' data-toggle='tab' onClick='function_state_add(this.name)'><b>Payroll Commission</b></a></li>";
								}else{
									$tabpayrollcommission = "<li><a href='#tabpayrollcommission' name='payrollcommission' data-toggle='tab' onClick='function_state_add(this.name)'><b>Payroll Commission</b></a></li>";
								}
								
								echo $tabemployeeorganization;
								echo $tabpayrolllostitem;
								echo $tabpayrollbonus;
								echo $tabpayrollcommission;
							?>
						</ul>
						<div class="tab-content">
							<?php
								if($data['active_tab']=="" || $data['active_tab']=="employeeorganization"){
									$statemployeeorganization = "active";
								}else{
									$statemployeeorganization = "";
								}

								if($data['active_tab']=="payrolllostitem"){
									$statpayrolllostitem = "active";
								}else{
									$statpayrolllostitem = "";
								}

								if($data['active_tab']=="payrollbonus"){
									$statpayrollbonus = "active";
								}else{
									$statpayrollbonus = "";
								}

								if($data['active_tab']=="payrollcommission"){
									$statpayrollcommission = "active";
								}else{
									$statpayrollcommission = "";
								}
								
								echo"<div class='tab-pane ".$statemployeeorganization."' id='tabemployeeorganization'>";
									$this->load->view("hroemployeeincentive/formedithroemployeeorganization_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrolllostitem."' id='tabpayrolllostitem'>";
									$this->load->view("hroemployeeincentive/formaddpayrollemployeelostitem_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollbonus."' id='tabpayrollbonus'>";
									$this->load->view("hroemployeeincentive/formaddpayrollemployeebonus_view");
								echo"</div>";

								echo"<div class='tab-pane ".$statpayrollcommission."' id='tabpayrollcommission'>";
									$this->load->view("hroemployeeincentive/formaddpayrollemployeecommission_view");
								echo"</div>";
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
