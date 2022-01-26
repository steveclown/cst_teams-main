<script>
	base_url = '<?php echo base_url();?>';

	function reset_add_premi(){
		document.location = base_url+"payrollemployeeadditionalilufa/reset_add_premi/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_premi(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalilufa/function_elements_add_premi');?>",
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
				url : "<?php echo site_url('payrollemployeeadditionalilufa/function_state_add');?>",
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
		
				
									<?php 
										echo form_open('payrollemployeeadditionalilufa/processAddPayrollEmployeeDeductionPremi',array('id' => 'myform', 'class' => 'horizontal-form')); 

										$unique 			= $this->session->userdata('unique');
										$data_premi 		= $this->session->userdata('addpayrollemployeedeductionpremi-'.$unique['unique']);

										$year_now 			= date('Y');

										if(!is_array($data_premi['month_period'])){
											$data_premi['month_period']	= date('m');
										}

										if(!is_array($data_premi['year_period'])){
											$data_premi['year_period']		= $year_now;
										}

										for($i=($year_now-1); $i<($year_now+2); $i++){
											$year[$i] = $i;
										} 

										echo $this->session->userdata('message_premi');
										$this->session->unset_userdata('message_premi');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('month_period', $monthperiod, set_value('month_period',$data_premi['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add_premi(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year, set_value('year_period',$data_premi['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add_premi(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('premi_attendance_id', $corepremiattendance ,set_value('premi_attendance_id',$data_premi['premi_attendance_id']),'id="premi_attendance_id", class="form-control select2me" onChange="function_elements_add_premi(this.name, this.value);');?>
												<label class="control-label">Premi Attendance Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_deduction_premi_amount" id="employee_deduction_premi_amount" value="<?php echo $data_premi['employee_deduction_premi_amount']?>" class="form-control" onChange="function_elements_add_premi(this.name, this.value);">
												<label class="control-label">Amount
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
											<input type="text" autocomplete="off"  name="employee_deduction_premi_description" id="employee_deduction_premi_description" value="<?php echo $data_premi['employee_deduction_premi_description']?>" class="form-control" onChange="function_elements_add_premi(this.name, this.value);">
												<label class="control-label">Description
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_add_premi();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Premi Attendance Period</th>
											<th>Premi Attendance Name</th>
											<th>Premi Attendance Description</th>
											<th>Premi Attendance Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeedeductionpremi)){
											echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeedeductionpremi as $key=>$val){
												echo"
													<tr>
														<td>".$this->configuration->Month[substr(trim($val['employee_deduction_premi_period']), 4, 2)]." ".substr(trim($val['employee_deduction_premi_period']), 0, 4)."</td>
														<td>".$val['premi_attendance_name']."</td>
														<td>".$val['employee_deduction_premi_description']."</td>
														<td>".nominal($val['employee_deduction_premi_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeeadditionalilufa/deletePayrollEmployeeDeductionPremi_Data/'.$val['employee_id']."/".$val['employee_deduction_premi_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																<i class='fa fa-trash-o'></i> Delete
															</a>";
														echo"
													</tr>
													
												";
											}
										}
									?>	
									</tbody>
								</table>
							</div>
						</div>
					</div>
				
