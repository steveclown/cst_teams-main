<script>
	mappia = "<?php echo site_url('assignmentovertimerate/addAssignmentOvertimeRate'); ?>";

	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('assignmentovertimerate/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('assignmentovertimerate/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function reset_data(){
		document.location = "<?php echo base_url();?>assignmentovertimerate/reset_data";
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>assignmentovertimerate/getCoreDepartment",
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
               url  : "<?php echo base_url(); ?>assignmentovertimerate/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });

    function processAddArrayAssignmentOvertimeRateTitle(){
		
		var division_id 			= document.getElementById("division_id").value;
		var department_id 			= document.getElementById("department_id").value;
		var section_id 				= document.getElementById("section_id").value;
		var job_title_id 			= document.getElementById("job_title_id").value;
		var overtime_rate_amount 	= document.getElementById("overtime_rate_amount").value;

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('assignmentovertimerate/processAddArrayAssignmentOvertimeRateTitle');?>",
			  data: {
					'division_id' 				: division_id,
					'department_id' 			: department_id, 
					'section_id' 				: section_id, 
					'job_title_id' 				: job_title_id, 
					'overtime_rate_amount' 		: overtime_rate_amount, 
					'session_name'				: "addarrayassignmentovertimerateitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
</script>

<?php 
	$sesi 	= $this->session->userdata('unique');
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	if($this->uri->segment(3)!=''){
		$uri = $this->uri->segment(3);
	}else{
		$uri = '';
	}
	$data 	= $this->session->userdata('addassignmentovertimerate-'.$sesi['unique']);	


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
							<a href="<?php echo base_url();?>assignmentovertimerate">
								Overtime Rate List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>assignmentovertimerate/addAssignmentOvertimeRate">
								Add Overtime Rate
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Add Overtime Rate
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
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>assignmentovertimerate" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('assignmentovertimerate/processAddAssignmentOvertimeRate',array('id' => 'myform', 'class' => 'horizontal-form')); 

									?>
									<div class="row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('zone_id', $corezone, $data['zone_id'], 'id ="zone_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value)"');?>

												<label class="control-label">Zone Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="overtime_rate_effective_date" id="overtime_rate_effective_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['overtime_rate_effective_date']);?>"/>
												<label class="control-label">Effective Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_rate_description" id="overtime_rate_description" value="<?php echo $data['overtime_rate_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Overtime Rate Description<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<h4>Overtime Rate Allowance </h4>
									<br>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('division_id', $coredivision ,set_value('division_id',$data['division_id']),'id="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
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
												<?php echo form_dropdown('job_title_id', $corejobtitle ,set_value('job_title_id',$data['job_title_id']),'id="job_title_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Job Title Name
													<span class="required">
														*
													</span>
												</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_rate_amount" id="overtime_rate_amount" value="<?php echo $data['overtime_rate_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" >
												<label class="control-label">Overtime Rate Amount<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<input name="created_on" id="created_on" type="hidden" value="<?php if (empty($data['created_on'])){echo date('Ymdhis');}else{echo $data['created_on'];}?>" />

									<div class="row">
										<div class="col-md-12" style='text-align:right'>
											<input type="button" name="add2" id="buttonAddArrayAssignmentOvertimeRate" value="Add" class="btn blue" title="Simpan Data" onClick="processAddArrayAssignmentOvertimeRateTitle();">
										</div>
									</div>
									<br>
								</div>
							</div>
						</div>
					</div>
				</div>

<?php 
	$assignmentovertimeratetitle	= $this->session->userdata('addarrayassignmentovertimeratetitle-'.$sesi['unique']);
?>
				
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
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
									<th>No.</th>
									<th>Division Name</th>
									<th>Department Name</th>
									<th>Section Name</th>
									<th>Job Title Name</th>
									<th>Overtime Rate Amount</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;

								if(!empty($assignmentovertimeratetitle)){
									foreach($assignmentovertimeratetitle as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->assignmentovertimerate_model->getDivisionName($val['division_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getDepartmentName($val['department_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getSectionName($val['section_id'])."</td>
												<td>".$this->assignmentovertimerate_model->getJobTitleName($val['job_title_id'])."</td>
												<td>".nominal($val['overtime_rate_amount'])."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'assignmentovertimerate/deleteArrayAssignmentOvertimeRateTitle/'.$val['job_title_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
			<div class="row">
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>