<script>
	base_url = '<?= base_url()?>';	

	mappia = "	<?php 
					$site_url = 'incentiveomzettarget/addIncentiveOmzetTarget/';
					echo site_url($site_url); 
				?>";

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"incentiverealizationdistribution/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('incentiverealizationdistribution/function_elements_add');?>",
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
				url : "<?php echo site_url('incentiverealizationdistribution/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });

	function processAddArrayIncentiveTitleDistribution(){

		var branch_id 									= document.getElementById("branch_id").value;
		var location_id 								= document.getElementById("location_id").value;
		var job_title_id 								= document.getElementById("job_title_id").value;
		var title_distribution_branch_percentage 		= document.getElementById("title_distribution_branch_percentage").value;
		var title_distribution_group_percentage 		= document.getElementById("title_distribution_group_percentage").value;
		var title_distribution_individual_percentage 	= document.getElementById("title_distribution_individual_percentage").value;

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('incentiverealizationdistribution/processAddArrayIncentiveTitleDistribution');?>",
			  data: {
					'branch_id' 								: branch_id,
					'location_id' 								: location_id, 
					'job_title_id' 								: job_title_id, 
					'title_distribution_branch_percentage' 		: title_distribution_branch_percentage, 
					'title_distribution_group_percentage' 		: title_distribution_group_percentage, 
					'title_distribution_individual_percentage' 	: title_distribution_individual_percentage, 
					'session_name' 								: "addarrayincentiverealizationdistribution-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}


	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#job_title_id_employee").change(function(){
        	var branch_id 		= $("#branch_id").val();
        	var location_id 	= $("#location_id").val();
        	var division_id 	= $("#division_id").val();
        	var department_id 	= $("#department_id").val();
        	var section_id 		= $("#section_id").val();
            var job_title_id 	= $("#job_title_id_employee").val();


            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getHROEMployeeData",
               data : {branch_id : branch_id, location_id : location_id, division_id : division_id, department_id: department_id, section_id : section_id, job_title_id : job_title_id},
               success: function(data){
                   $("#employee_id").html(data);
               }
            });
        });
    });

    function processAddArrayIncentiveEmployeeOmzet(){

		var branch_id 					= document.getElementById("branch_id").value;
		var location_id 				= document.getElementById("location_id").value;
		var division_id 				= document.getElementById("division_id").value;
		var department_id 				= document.getElementById("department_id").value;
		var section_id 					= document.getElementById("section_id").value;
		var job_title_id 				= document.getElementById("job_title_id_employee").value;
		var employee_id 				= document.getElementById("employee_id").value;
		var employee_omzet_target 		= document.getElementById("employee_omzet_target").value;


		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('incentiverealizationdistribution/processAddArrayIncentiveEmployeeOmzet');?>",
			  data: {
					'branch_id' 					: branch_id,
					'location_id' 					: location_id, 
					'division_id' 					: division_id, 
					'department_id' 				: department_id, 
					'section_id' 					: section_id, 
					'job_title_id' 					: job_title_id,
					'employee_id' 					: employee_id,  
					'employee_omzet_target' 		: employee_omzet_target, 
					'session_name' 					: "addarrayincentiverealizationdistribution-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
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

					
									<?php 

										$sesi 	= $this->session->userdata('unique');

										if (empty($data)){
											$data['month_period']				= date("m");
											$data['year_period']				= date("Y");
										}

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('division_id', $coredivision ,set_value('job_title_id',$data['division_id']),'id="division_id", class="form-control select2me"');
												?>
												<label class="control-label">Division Name</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['department_id'])){
														$coredepartment = create_double($this->incentiverealizationdistribution_model->getCoreDepartment($data['division_id']),'department_id','department_name');

														echo form_dropdown('department_id', $coredepartment ,set_value('department_id',$data['department_id']),'id="department_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?> 
													<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose Item--</option>
													</select>
												<?php
													}
												?>
												<label class="control-label">Department Name</label>
											</div>
										</div>
									</div>


									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['section_id'])){
														$coresection = create_double($this->incentiverealizationdistribution_model->getCoreSection($data['section_id']),'section_id','section_name');

														echo form_dropdown('section_id', $coresection ,set_value('section_id',$data['section_id']),'id="section_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?> 
													<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose Item--</option>
													</select>
												<?php
													}
												?>
												<label class="control-label">Section Name</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('job_title_id_employee', $corejobtitle ,set_value('job_title_id_employee',$data['job_title_id_employee']),'id="job_title_id_employee", class="form-control select2me"');
												?>
												<label class="control-label">Job Title Name</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['employee_id'])){
														$hroemployeedata = create_double($this->incentiverealizationdistribution_model->getHROEMployeeData($data['branch_id'], $data['location_id'], $data['division_id'], $data['department_id'], $data['section_id'], $data['job_title_id_employee']),'employee_id','employee_name');

														echo form_dropdown('employee_id', $hroemployeedata ,set_value('employee_id',$data['employee_id']),'id="employee_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
												?> 
													<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose Item--</option>
													</select>
												<?php
													}
												?>
												<label class="control-label">Employee Name</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="employee_omzet_target" name="employee_omzet_target" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_omzet_target'];?>">
												<label class="control-label">Employee Omzet </label>
											</div>	
										</div>
									</div>

									<div class="row">
										<div class="col-md-12" style='text-align:right'>
											<input type="button" name="add2" id="buttonAddArrayIncentiveEmployeeOmzet" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayIncentiveEmployeeOmzet();">
										</div>
									</div>
								

<?php
	$sesi 						= $this->session->userdata('unique');
	$incentiveemployeeomzet	= $this->session->userdata('addarrayincentiveemployeeomzet-'.$sesi['unique']);

	/*print_r("incentivetitledistribution ");
	print_r($incentivetitledistribution);	
	print_r("<BR>");
	print_r("<BR>");*/
?>

<br>
<br>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="15%">Division Name</th>
									<th width="15%">Department Name</th>
									<th width="15%">Section Name</th>
									<th width="15%">Job Title Name</th>
									<th width="20%">Employee Name</th>
									<th width="10%">Omzet Target </th>
									<th width="5%">Action</th>					
								</tr>
							</thead>
							<tbody>
								<?php
									
									$no = 1;
									if(!is_array($incentiveemployeeomzet)){
										echo "<tr><th colspan='9'>Data is empty</th></tr>";
									} else {
										foreach ($incentiveemployeeomzet as $key=>$val){
											echo"
												<tr>
													<td style='text-align  : left !important;'>".$no."</td>
													<td style='text-align  : left !important;'>".$this->incentiverealizationdistribution_model->getDivisionName($val['division_id'])."</td>
													<td style='text-align  : left !important;'>".$this->incentiverealizationdistribution_model->getDepartmentName($val['department_id'])."</td>
													<td style='text-align  : left !important;'>".$this->incentiverealizationdistribution_model->getSectionName($val['section_id'])."</td>
													<td style='text-align  : left !important;'>".$this->incentiverealizationdistribution_model->getJobTitleName($val['job_title_id'])."</td>
													<td style='text-align  : left !important;'>".$this->incentiverealizationdistribution_model->getEmployeeName($val['employee_id'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['employee_omzet_target'])."</td>
													<td style='text-align  : center !important;'>
														<a href='".base_url().'incentiverealizationdistribution/deleteArrayIncentiveEmployeeOmzet/'.$val['employee_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																	<i class='fa fa-trash-o'></i> Delete
														</a>
													</td>
												</tr>								
											";	

											$no++;													
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>