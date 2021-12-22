<script>
	base_url = '<?php echo base_url();?>';

	function reset_add(){
		document.location = base_url+"payrollemployeecommission/reset_add/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeecommission/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
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
								<a href="<?php echo base_url();?>payrollemployeecommission">
									Employee Commission Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeecommission/addPayrollEmployeeCommission/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Commission Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Employee Commission Data - <?php echo $hroemployeedata['employee_name'];?> -
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	
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
								<input type="text" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_name']?>" class="form-control" readonly>
								<label class="control-label">Division Name</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_name']?>" class="form-control" readonly>
								<label class="control-label">Department Name</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_name']?>" class="form-control" readonly>
								<label class="control-label">Section Name</label>
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
									<a href="<?php echo base_url();?>payrollemployeecommission" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('payrollemployeecommission/processAddPayrollEmployeeCommission',array('id' => 'myform', 'class' => 'horizontal-form')); 
										
										$unique 	= $this->session->userdata('unique');
										$data 		= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('month_period', $monthperiod, set_value('month_period',$data['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year, set_value('year_period',$data['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Period</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_commission_omzet_mmc" id="employee_commission_omzet_mmc" value="<?php echo $data['employee_commission_omzet_mmc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Omzet 
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_commission_quantity_mmc" id="employee_commission_quantity_mmc" value="<?php echo $data['employee_commission_quantity_mmc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
												<input type="text" name="employee_commission_omzet_acc" id="employee_commission_omzet_acc" value="<?php echo $data['employee_commission_omzet_acc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Omzet Acc
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_commission_total_omzet" id="employee_commission_total_omzet" value="<?php echo $data['employee_commission_total_omzet']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
												<input type="text" name="employee_commission_amount_mmc" id="employee_commission_amount_mmc" value="<?php echo $data['employee_commission_amount_mmc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label"> Commission
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_commission_amount_acc" id="employee_commission_amount_acc" value="<?php echo $data['employee_commission_amount_acc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
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
												<input type="text" name="employee_commission_total_amount" id="employee_commission_total_amount" value="<?php echo $data['employee_commission_total_amount']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Total Commission
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								</div>

								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<input type="hidden" name="job_title_id" value="<?php echo $hroemployeedata['job_title_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>

<div class="row">
	<div class="col-md-12">	
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
			</div>
			<div class="portlet-body ">
				<!-- BEGIN FORM-->
				<div class="form-body">
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
															<a href='".$this->config->item('base_url').'payrollemployeecommission/deletePayrollEmployeeCommission_Data/'.$val['employee_id']."/".$val['employee_commission_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
				</div>
			</div>
		</div>
	</div>
</div>
