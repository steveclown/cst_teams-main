<script>
	mappia = "	<?php 
					$site_url = 'assignmentbusinesstrip/addAssignmentBusinessTrip/'.$hroemployeedata['employee_id'];
					echo site_url($site_url); 
				?>";

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"assignmentbusinesstrip/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('assignmentbusinesstrip/function_elements_add');?>",
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
				url : "<?php echo site_url('assignmentbusinesstrip/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function getCostBudgetAmount(value) {
		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getCostBudgetAmount",
		   data: {'cost_budget_id' : value},
		   success: function(msg){
				document.getElementById("business_trip_cost_amount").value = msg;
		   }
		});	
	}

	$(document).ready(function(){
        $("#overtime_rate_id").change(function(){
            var overtime_rate_id = $("#overtime_rate_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getAssignmentOvertimeRateTitle",
               data : {overtime_rate_id: overtime_rate_id},
               success: function(data){
                   $("#job_title_id_allowance").html(data);
               }
            });
        });
    });

	function processAddArrayBusinessTripEmployee(){
		
		var division_id 		= document.getElementById("division_id").value;
		var department_id 		= document.getElementById("department_id").value;
		var section_id 			= document.getElementById("section_id").value;
		var job_title_id 		= document.getElementById("job_title_id").value;
		var employee_id 		= document.getElementById("employee_id").value;
		var employee_id_assign 	= <?php echo $hroemployeedata['employee_id']?>
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('assignmentbusinesstrip/processAddArrayBusinessTripEmployee');?>",
			  data: {
					'division_id' 			: division_id,
					'department_id' 		: department_id, 
					'section_id' 			: section_id, 
					'job_title_id' 			: job_title_id, 
					'employee_id' 			: employee_id, 
					'employee_id_assign' 	: employee_id_assign, 
					'session_name' 			: "addarraybusinesstripemployee-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}

	function processAddArrayBusinessTripAllowance(){
		
		var job_title_id 					= document.getElementById("job_title_id_allowance").value;
		var allowance_id 					= document.getElementById("allowance_id").value;
		var business_trip_allowance_amount 	= document.getElementById("business_trip_allowance_amount").value;
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('assignmentbusinesstrip/processAddArrayBusinessTripAllowance');?>",
			  data: {
					'job_title_id' 						: job_title_id,
					'allowance_id' 						: allowance_id, 
					'business_trip_allowance_amount' 	: business_trip_allowance_amount, 
					'session_name' 	: "addarraybusinesstripemployee-"
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
               url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getCoreDepartment_Detail",
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
               url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getCoreSection_Detail",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#job_title_id_allowance").change(function(){
            var job_title_id 			= $("#job_title_id_allowance").val();
            var overtime_rate_id 	= $("#overtime_rate_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getAssignmentOvertimeRateTitle_Allowance",
               data : {job_title_id: job_title_id, overtime_rate_id: overtime_rate_id},
               success: function(data){
                   $("#allowance_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#job_title_id").change(function(){
            var division_id 	= $("#division_id").val();
            var department_id 	= $("#department_id").val();
            var section_id 		= $("#section_id").val();
            var job_title_id 	= $("#job_title_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getHROEmployeeData_Detail",
               data : {division_id: division_id, department_id: department_id, section_id: section_id, job_title_id: job_title_id},
               success: function(data){
                   $("#employee_id").html(data);
               }
            });
        });
    });

    function getOvertimeRateAllowanceAmount(value) {
    	var overtime_rate_id 	= $("#overtime_rate_id").val();
    	var job_title_id 		= $("#job_title_id_allowance").val();

		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>assignmentbusinesstrip/getOvertimeRateAllowanceAmount",
		   data: {'allowance_id' : value, overtime_rate_id: overtime_rate_id, job_title_id: job_title_id},
		   success: function(msg){
				// alert(msg);
				document.getElementById("business_trip_allowance_amount").value = msg;
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
	$sesi 	= $this->session->userdata('unique');
	$businesstripallowance	= $this->session->userdata('addarraybusinesstripallowance-'.$sesi['unique']);
	$businesstripemployee	= $this->session->userdata('addarraybusinesstripemployee-'.$sesi['unique']);

	print_r("businesstripallowance ".$businesstripallowance);
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
								<a href="<?php echo base_url();?>assignmentbusinesstrip">
									Business Trip List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>assignmentbusinesstrip/addAssignmentBusinessTrip/<?php echo $hroemployeedata['employee_id']?>">
									Add Business Trip
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Business Trip - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" autocomplete="off"  name="division_id_detail" id="division_id_detail" value="<?php echo $this->assignmentbusinesstrip_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id_detail" id="department_id_detail" value="<?php echo $this->assignmentbusinesstrip_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id_detail" id="section_id_detail" value="<?php echo $this->assignmentbusinesstrip_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>assignmentbusinesstrip" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('assignmentbusinesstrip/processAddAssignmentBusinessTrip',array('id' => 'myform', 'class' => 'horizontal-form')); 

										$sesi 	= $this->session->userdata('unique');
										$data 	= $this->session->userdata('addassignmentbusinesstrip-'.$sesi['unique']);	
									?>
									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="business_trip_date" id="business_trip_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['business_trip_date']);?>"/>
												<label class="control-label">Business Trip Date
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
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="business_trip_start_date" id="business_trip_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['business_trip_start_date']);?>"/>
												<label class="control-label">Business Trip Start Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="business_trip_end_date" id="business_trip_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['business_trip_end_date']);?>"/>
												<label class="control-label">Business Trip End Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="business_trip_purpose" name="business_trip_purpose" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['business_trip_purpose'];?>">
												<label class="control-label">Business Trip Purpose </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('overtime_rate_id', $assignmentovertimerate ,set_value('overtime_rate_id',$data['overtime_rate_id']),'id="overtime_rate_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Overtime Rate
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="business_trip_remark" id="business_trip_remark" onChange="function_elements_add(this.name, this.value);" class="form-control"><?php echo $data['business_trip_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>

									<h4>Business Trip Attendance </h4>
									<br>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('division_id', $coredivision ,set_value('division_id',$data['division_id']),'id="division_id", class="form-control select2me"');?>
												<label class="control-label">Division Name
													<span class="required">
														*
													</span>
												</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="department_id" id="department_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
												<label class="control-label">Department Name </label>
											</div>	
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="section_id" id="section_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
												<label class="control-label">Section Name </label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('job_title_id', $corejobtitle ,set_value('job_title_id',$data['job_title_id']),'id="job_title_id", class="form-control select2me"');?>
												<label class="control-label">Job Title Name </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="employee_id" id="employee_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
												<label class="control-label">Employee Name </label>
											</div>	
										</div>
									</div>

									<div class="row">
										<div class="col-md-12" style='text-align:right'>
											<input type="button" name="add2" id="buttonAddArrayBusinessTripEmployee" value="Add" class="btn blue" title="Simpan Data" onClick="processAddArrayBusinessTripEmployee();">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-bordered table-advance table-hover">
													<thead>
														<tr>
															<th>No.</th>
															<th>Division Name</th>
															<th>Department Name</th>
															<th>Section Name</th>
															<th>Job Title Name</th>
															<th>Employee Name</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$no = 1;
														if(!empty($businesstripemployee)){
															foreach($businesstripemployee as $key=>$val){
																echo"
																	<tr class='odd gradeX'>
																		<td style='text-align:center'>$no.</td>
																		<td>".$this->assignmentbusinesstrip_model->getDivisionName($val['division_id'])."</td>
																		<td>".$this->assignmentbusinesstrip_model->getDepartmentName($val['department_id'])."</td>
																		<td>".$this->assignmentbusinesstrip_model->getSectionName($val['section_id'])."</td>
																		<td>".$this->assignmentbusinesstrip_model->getJobTitleName($val['job_title_id'])."</td>
																		<td>".$this->assignmentbusinesstrip_model->getEmployeeName($val['employee_id'])."</td>
																		<td style='text-align  : center !important;'>
																			<a href='".base_url().'assignmentBusinessTrip/deleteArrayBusinessTripEmployee/'.$hroemployeedata['employee_id'].'/'.$val['business_trip_employee_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																				<i class='fa fa-trash-o'></i> Delete
																			</a>
																		</td>
																	</tr>
																";
																$no++;
															}
														}else{
															echo"
																<tr class='odd gradeX'>
																	<td colspan='11' style='text-align:center;'>
																		<b>No Data</b>
																	</td>
																</tr>
															";
														}
													?>		
													<tbody>
												</table>
											</div>
										</div>
									</div>


									<h4>Business Trip Cost </h4>
									<br>
									<?php 
										print_r("businesstripallowance ".$businesstripallowance);
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['overtime_rate_id'])){
														$assignmentovertimeratetitle = create_double($this->assignmentbusinesstrip_model->getAssignmentOvertimeRateTitle($data['overtime_rate_id']),'job_title_id','job_title_name');

														echo form_dropdown('job_title_id_allowance', $assignmentovertimeratetitle ,set_value('job_title_id_allowance',$data['job_title_id']),'id="job_title_id_allowance" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
													} else {
													?>
														<select name="job_title_id_allowance" id="job_title_id_allowance" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
														<option value="">--Choose Item--</option>
												</select>
													<?php
													}
													?>
												<label class="control-label">Section Name
													<span class="required">
														*
													</span>
												</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<select name="allowance_id" id="allowance_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value); getOvertimeRateAllowanceAmount(this.value);">
													<option value="">--Choose Item--</option>
												</select>
												<label class="control-label">Allowance Name </label>
											</div>	
										</div>
									</div>
									
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="business_trip_allowance_amount" name="business_trip_allowance_amount" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['business_trip_allowance_amount'];?>">
												<label class="control-label">Allowance Amount </label>
											</div>	
										</div>
									</div>

									<div class="row">
										<div class="col-md-12" style='text-align:right'>
											<input type="button" name="add2" id="buttonAddArrayBusinessTripAllowance" value="Add" class="btn blue" title="Simpan Data" onClick="processAddArrayBusinessTripAllowance();">
										</div>
									</div>
									<br>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-bordered table-advance table-hover">
													<thead>
														<tr>
															<th>No.</th>
															<th>Job Title Name</th>
															<th>Allowance Name</th>
															<th>Allowance Amount</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$no = 1;
														if(!empty($businesstripallowance)){
															foreach($businesstripallowance as $key=>$val){
																echo"
																	<tr class='odd gradeX'>
																		<td style='text-align:center'>$no.</td>
																		<td>".$this->assignmentbusinesstrip_model->getJobTitleName($val['job_title_id'])."</td>
																		<td>".$this->assignmentbusinesstrip_model->getAllowanceName($val['allowance_id'])."</td>
																		<td>".nominal($val['business_trip_allowance_amount'])."</td>
																		<td style='text-align  : center !important;'>
																			<a href='".$this->config->item('base_url').'assignmentbusinesstrip/deleteArrayBusinessTripAllowance/'.$hroemployeedata['employee_id']."/".$val['business_trip_allowance_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																				<i class='fa fa-trash-o'></i> Delete
																			</a>
																		</td>
																	</tr>
																";
																$no++;
															}
														}else{
															echo"
																<tr class='odd gradeX'>
																	<td colspan='11' style='text-align:center;'>
																		<b>No Data</b>
																	</td>
																</tr>
															";
														}
													?>		
													<tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id_assign" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
