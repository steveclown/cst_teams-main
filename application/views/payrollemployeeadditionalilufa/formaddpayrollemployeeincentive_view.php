<script>
	base_url = '<?php echo base_url();?>';

	function reset_add_incentive(){
		document.location = base_url+"payrollemployeeadditionalilufa/reset_add_incentive/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_incentive(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalilufa/function_elements_add_incentive');?>",
				data : {'name' : name, 'value' : value},
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
										echo form_open('payrollemployeeadditionalilufa/processAddPayrollEmployeeIncentive',array('id' => 'myform', 'class' => 'horizontal-form'));

										$unique 			= $this->session->userdata('unique');
										$data_incentive 	= $this->session->userdata('addpayrollemployeeincentive-'.$unique['unique']);

										$year_now 			= date('Y');

										if(!is_array($data_incentive['month_period'])){
											$data_incentive['month_period']	= date('m');
										}

										if(!is_array($data_incentive['year_period'])){
											$data_incentive['year_period']		= $year_now;
										}

										for($i=($year_now-1); $i<($year_now+2); $i++){
											$year[$i] = $i;
										} 

										echo $this->session->userdata('message_incentive');
										$this->session->unset_userdata('message_incentive');
									?>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('month_period', $monthperiod, set_value('month_period',$data_incentive['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year, set_value('year_period',$data_incentive['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('incentive_id', $coreincentive ,set_value('incentive_id',$data_incentive['incentive_id']),'id="incentive_id", class="form-control select2me" onChange="function_elements_add_incentive(this.name, this.value);');?>
												<label class="control-label">Incentive Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_incentive_amount" id="employee_incentive_amount" value="<?php echo $data_incentive['employee_incentive_amount']?>" class="form-control" onChange="function_elements_add_incentive(this.name, this.value);">
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
											<input type="text" autocomplete="off"  name="employee_incentive_description" id="employee_incentive_description" value="<?php echo $data_incentive['employee_incentive_description']?>" class="form-control" onChange="function_elements_add_incentive(this.name, this.value);">
												<label class="control-label">Description
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_add_incentive();"><i class="fa fa-times"></i> Reset</button>
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
											<th>Incentive Period</th>
											<th>Incentive Name</th>
											<th>Incentive Description</th>
											<th>Incentive Amount</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeeincentive)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeeincentive as $key=>$val){
												echo"
													<tr>
														<td>".$val['employee_incentive_period']."</td>
														<td>".$this->payrollemployeeadditionalilufa_model->getIncentiveName($val['incentive_id'])."</td>
														<td>".$val['employee_incentive_description']."</td>
														<td>".nominal($val['employee_incentive_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeeadditionalilufa/deletePayrollEmployeeIncentive_Data/'.$val['employee_id']."/".$val['employee_incentive_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				
