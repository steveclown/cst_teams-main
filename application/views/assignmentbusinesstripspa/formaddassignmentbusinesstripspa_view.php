<script>
	mappia = "	<?php 
					$site_url = 'assignmentbusinesstripspa/addAssignmentBusinessTrip/'.$hroemployeedata['employee_id'];
					echo site_url($site_url); 
				?>";

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"assignmentbusinesstripspa/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('assignmentbusinesstripspa/function_elements_add');?>",
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
				url : "<?php echo site_url('assignmentbusinesstripspa/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function getCostBudgetAmount(value) {
		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>assignmentbusinesstripspa/getCostBudgetAmount",
		   data: {'cost_budget_id' : value},
		   success: function(msg){
				document.getElementById("business_trip_cost_amount").value = msg;
		   }
		});	
	}

	function getOvertimeRateAmount(value) {
    	var overtime_rate_id 	= $("#overtime_rate_id").val();
    	var division_id 		= $("#division_id").val();
       	var department_id 		= $("#department_id").val();
     	var section_id 			= $("#section_id").val();
    	var job_title_id 		= $("#job_title_id").val();

    	/*alert(overtime_rate_id);
    	alert(division_id);
    	alert(department_id);
    	alert(section_id);
    	alert(job_title_id);*/

		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>assignmentbusinesstripspa/getOvertimeRateAmount",
		   data: {'overtime_rate_id' : value, division_id: division_id, department_id: department_id, section_id: section_id, job_title_id: job_title_id},
		   success: function(msg){
				alert(msg);
				document.getElementById("business_trip_amount").value = msg;
		   }
		});	
	}

	$(document).ready(function(){
        $("#overtime_rate_id").change(function(){
            var overtime_rate_id 	= $("#overtime_rate_id").val();
            var division_id 		= $("#division_id").val();
            var department_id 		= $("#department_id").val();
            var section_id 			= $("#section_id").val();
            var job_title_id 		= $("#job_title_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>assignmentbusinesstripspa/getAssignmentOvertimeRateTitle",
               data : {overtime_rate_id: overtime_rate_id, division_id: division_id, department_id: department_id, section_id: section_id, job_title_id: job_title_id},
               success: function(data){
                   $("#job_title_id_allowance").html(data);
               }
            });
        });
    });
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
								<a href="<?php echo base_url();?>assignmentbusinesstripspa">
									Business Trip List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>assignmentbusinesstripspa/addAssignmentBusinessTrip/<?php echo $hroemployeedata['employee_id']?>">
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
								<input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division</label>

								<input type="hidden" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_id']?>" class="form-control" readonly>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_name" id="department_name" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department</label>

								<input type="hidden" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_id']?>" class="form-control" readonly>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_name" id="section_name" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section </label>

								<input type="hidden" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_id']?>" class="form-control" readonly>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="job_title_name" id="job_title_name" value="<?php echo $hroemployeedata['job_title_name']?>" class="form-control" readonly>
								<label class="control-label">Job Title</label>

								<input type="hidden" name="job_title_id" id="job_title_id" value="<?php echo $hroemployeedata['job_title_id']?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>assignmentbusinesstripspa" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('assignmentbusinesstripspa/processAddAssignmentBusinessTrip',array('id' => 'myform', 'class' => 'horizontal-form')); 

										$sesi 	= $this->session->userdata('unique');
										$data 	= $this->session->userdata('addassignmentbusinesstripspa-'.$sesi['unique']);	
										$data['business_trip_date'] = date("Y-m-d");
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
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="business_trip_destination" name="business_trip_destination" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['business_trip_destination'];?>">
												<label class="control-label">Business Trip Destination </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('overtime_rate_id', $assignmentovertimerate ,set_value('overtime_rate_id',$data['overtime_rate_id']),'id="overtime_rate_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value); getOvertimeRateAmount(this.value);"');?>
												<label class="control-label">Overtime Rate
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="business_trip_amount" name="business_trip_amount" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['business_trip_amount'];?>">
												<label class="control-label">Business Trip Amount </label>
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
