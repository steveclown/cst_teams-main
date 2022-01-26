<script>
	base_url = '<?php base_url()?>';

	mappia = "	<?php 
					$site_url = 'corededuction/editCoreDeduction/'.$corededuction['deduction_id'];
					echo site_url($site_url); 
				?>";

	function reset_data(){
	 	document.getElementById("deduction_id").value = "<?php echo $corededuction['deduction_id'] ?>";
		document.getElementById("deduction_name").value = "<?php echo $corededuction['deduction_name'] ?>";
		document.getElementById("deduction_code").value = "<?php echo $corededuction['deduction_code'] ?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('corededuction/function_elements_add');?>",
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
				url : "<?php echo site_url('corededuction/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb ">
				<li>
					<a href="<?php echo base_url();?>">
						Home
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>corededuction">
						Deduction List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>corededuction/editCoreDeduction/<?php echo $corededuction['deduction_id']; ?>">
						Edit Deduction
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
		Form Edit Deduction 
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>corededuction" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('corededuction/processEditArrayCoreDeduction',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_code" id="deduction_code" class="form-control" value="<?php echo $corededuction['deduction_code']?>">
									<span class="help-block">
										Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Deduction Code
										<span class="required">
										*
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_name" id="deduction_name" class="form-control" value="<?php echo $corededuction['deduction_name']?>" >
									<label class="control-label">Deduction Name</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('deduction_type', $deductiontype, $corededuction['deduction_type'], 'id ="deduction_type", class="form-control select2me"');?>
									<label class="control-label">Deduction Type
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_amount" id="deduction_amount" class="form-control" value="<?php echo $corededuction['deduction_amount']?>">
									<label class="control-label">Deduction Amount</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_premi_attendance_ratio" id="deduction_premi_attendance_ratio" class="form-control" value="<?php echo $corededuction['deduction_premi_attendance_ratio']?>" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Deduction Premi Attendance Ratio</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_basic_salary_ratio" id="deduction_basic_salary_ratio" class="form-control" value="<?php echo $corededuction['deduction_basic_salary_ratio']?>" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Deduction Basic Salary Ratio</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_late_start_duration" id="deduction_late_start_duration" class="form-control" value="<?php echo $corededuction['deduction_late_start_duration']?>" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Deduction Late Start</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="deduction_late_end_duration" id="deduction_late_end_duration" class="form-control" value="<?php echo $corededuction['deduction_late_end_duration']?>" onChange="function_elements_add(this.name, this.value);">
									<label class="control-label">Deduction Late End</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="deduction_remark" id="deduction_remark" class="form-control"><?php echo $corededuction['deduction_remark']?></textarea>
									<label class="control-label">Deduction Remark</label>
								</div>
							</div>
						</div>

						<h4>Allowance </h4>
						<br>

						<div class = "row">
							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<?php echo form_dropdown('allowance_id', $coreallowance ,set_value('allowance_id',$data['allowance_id']),'id="allowance_id", class="form-control select2me"');?>
									<label class="control-label">Allowance Name </label>
								</div>	
							</div>

							<div class = "col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  class="form-control" id="deduction_allowance_ratio" name="deduction_allowance_ratio" value="<?php echo $data['deduction_allowance_ratio'];?>">
									<label class="control-label">Allowance Ratio </label>
								</div>	
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12" style='text-align:right'>
								<input type="submit" name="add2" id="buttonEditArrayCoreDeductionAllowance" value="Add" class="btn blue" title="Simpan Data">
							</div>
						</div>
						<br>
						<input type="hidden" name="deduction_id" value="<?php echo $corededuction['deduction_id']; ?>"/>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	
