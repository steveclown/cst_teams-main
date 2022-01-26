<script>
	function reset_session(){
		document.location = base_url+"payrollovertimeautomatic/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollovertimeautomatic/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollovertimeautomatic/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
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
								<a href="<?php echo base_url();?>payrollovertimeautomatic">
									Overtime Automatic List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollovertimeautomatic/listpayrollovertimeautomatic">
									Overtime Automatic List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollovertimeautomatic/addPayrollMedicalClaim">
									Add Overtime Automatic
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Overtime Automatic
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	// print_r($data);exit;
?>			

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>payrollovertimeautomatic" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('payrollovertimeautomatic/processAddPayrollOvertimeAutomatic',array('id' => 'myform', 'class' => 'horizontal-form'));
						$data = $this->session->userdata('addpayrollovertimeautomatic');
					?>		

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
								<?php echo form_dropdown('department_id', $coredepartment ,set_value('department_id',$data['department_id']),'id="department_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Department Name
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
								<?php echo form_dropdown('section_id', $coresection ,set_value('section_id',$data['section_id']),'id="section_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Section Name
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
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="overtime_automatic_start_date" id="overtime_automatic_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['overtime_automatic_start_date']);?>">
								<label class="control-label">Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="overtime_automatic_end_date" id="overtime_automatic_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['overtime_automatic_end_date']);?>">
								<label class="control-label">End Date
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
								<input type="text" autocomplete="off"  name="overtime_automatic_duration" id="overtime_automatic_duration" value="<?php echo $data[overtime_automatic_duration];?>" class="form-control">
								<label class="control-label">Duration
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('overtime_automatic_daily_name', $dailyname ,set_value('overtime_automatic_daily_name',$data['overtime_automatic_daily_name']),'id="overtime_automatic_daily_name", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Daily Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>	
				</div>
				<div class="form-actions right">
					<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
