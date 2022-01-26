<script>
	base_url = '<?php echo base_url();?>';

	function reset_add_commission(){
		document.location = base_url+"payrollemployeeadditionalilufa/reset_add_commission/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_commission(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalilufa/function_elements_add_commission');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>

		 			
									<?php 
										echo form_open('payrollemployeeadditionalilufa/processAddPayrollEmployeeCommission',array('id' => 'myform', 'class' => 'horizontal-form')); 
										
										$unique 			= $this->session->userdata('unique');
										$data_commission 	= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);
										$year_now 			= date('Y');

										if(!is_array($data_commission['month_period'])){
											$data_commission['month_period']	= date('m');
										}

										if(!is_array($data_commission['year_period'])){
											$data_commission['year_period']		= $year_now;
										}

										for($i=($year_now-1); $i<($year_now+2); $i++){
											$year[$i] = $i;
										} 

										echo $this->session->userdata('message_commission');
										$this->session->unset_userdata('message_commission');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('month_period', $monthperiod, set_value('month_period', $data_commission['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add_commission(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year, set_value('year_period',$data_commission['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add_commission(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_commission_omzet_mmc" id="employee_commission_omzet_mmc" value="<?php echo $data_commission['employee_commission_omzet_mmc']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label">Omzet 
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_commission_quantity_mmc" id="employee_commission_quantity_mmc" value="<?php echo $data_commission['employee_commission_quantity_mmc']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label">Quantity 
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
												<input type="text" autocomplete="off"  name="employee_commission_omzet_acc" id="employee_commission_omzet_acc" value="<?php echo $data_commission['employee_commission_omzet_acc']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label">Omzet Acc
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_commission_total_omzet" id="employee_commission_total_omzet" value="<?php echo $data_commission['employee_commission_total_omzet']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label">Total Omzet
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
												<input type="text" autocomplete="off"  name="employee_commission_amount_mmc" id="employee_commission_amount_mmc" value="<?php echo $data_commission['employee_commission_amount_mmc']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label"> Commission
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_commission_amount_acc" id="employee_commission_amount_acc" value="<?php echo $data_commission['employee_commission_amount_acc']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label">Acc Commission
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
												<input type="text" autocomplete="off"  name="employee_commission_total_amount" id="employee_commission_total_amount" value="<?php echo $data_commission['employee_commission_total_amount']?>" class="form-control" onChange="function_elements_add_commission(this.name, this.value);">
												<label class="control-label">Total Commission
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								

								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_add_commission();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<input type="hidden" name="job_title_id" value="<?php echo $hroemployeedata['job_title_id']; ?>"/>
								<?php echo form_close(); ?>
							

					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Commission  Period</th>
											<th>Omzet </th>
											<th>Quantity </th>
											<th>Omzet Acc</th>
											<th>Total Omzet</th>
											<th> Commission</th>
											<th>Acc Commission</th>
											<th>Total Commission</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeecommission)){
											echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeecommission as $key=>$val){
												echo"
													<tr>
														<td>".$this->configuration->Month[substr(trim($val['employee_commission_period']), 4, 2)]." ".substr(trim($val['employee_commission_period']), 0, 4)."</td>
														<td>".nominal($val['employee_commission_omzet_mmc'])."</td>
														<td>".nominal($val['employee_commission_quantity_mmc'])."</td>
														<td>".nominal($val['employee_commission_omzet_acc'])."</td>
														<td>".nominal($val['employee_commission_total_omzet'])."</td>
														<td>".nominal($val['employee_commission_amount_mmc'])."</td>
														<td>".nominal($val['employee_commission_amount_acc'])."</td>
														<td>".nominal($val['employee_commission_total_amount'])."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeeadditionalilufa/deletePayrollEmployeeCommission_Data/'.$val['employee_id']."/".$val['employee_commission_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				