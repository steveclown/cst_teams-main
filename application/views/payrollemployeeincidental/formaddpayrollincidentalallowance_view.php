<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollincidentalallowance/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollincidentalallowance/function_elements_add');?>",
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
				url : "<?php echo site_url('payrollincidentalallowance/function_state_add');?>",
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
					<a href="<?php echo base_url();?>payrollincidentalallowance">
						Incidental Allowance List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>payrollincidentalallowance/addPayrollIncidentalAllowance/<?php echo $hroemployeedata['employee_id']?>">
						Add Transactional Incidental Allowance
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Add Transactional Incidental Allowance - <?php echo $hroemployeedata['employee_name']?> -
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
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->payrollincidentalallowance_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->payrollincidentalallowance_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->payrollincidentalallowance_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
					<a href="<?php echo base_url();?>payrollincidentalallowance" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('payrollincidentalallowance/processAddPayrollIncidentalAllowance',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addpayrollincidentalallowance');
					?>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('allowance_id', $coreallowance ,set_value('allowance_id',$data['allowance_id']),'id="allowance_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Allowance Name</label>
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('incidental_allowance_month', $monthlist,set_value('incidetal_allowance_month',$data['incidetal_allowance_month']),'id="incidetal_allowance_month" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>To Period</label>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('incidental_allowance_year', $year,set_value('incidetal_allowance_year',$data['incidetal_allowance_year']),'id="incidetal_allowance_year" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label></label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="incidental_allowance_description" id="incidental_allowance_description" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['incidental_allowance_description'];?></textarea>
								<label class="control-label">Description</label>
							</div>
						</div>	
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="incidental_allowance_amount" id="incidental_allowance_amount" onChange="warningamount(this.value);" value="<?php echo $data['incidental_allowance_amount'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Allowance Amount</label>
							</div>
						</div>
					</div>
						
							
					<div class="form-actions right">
						<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
						<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
						<button type="submit" name="Save" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

