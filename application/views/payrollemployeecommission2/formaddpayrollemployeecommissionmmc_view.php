<script>
	base_url = '<?= base_url()?>';
	mappia = "	<?php 
					$site_url = 'payrollemployeecommission/addPayrollEmployeeCommission/';
					echo site_url($site_url); 
				?>";

	function reset_add(){
	 	/*alert('asd');*/
		document.location = base_url+"payrollemployeecommission/reset_add";
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
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeecommission/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>payrollemployeecommission/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>payrollemployeecommission/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
            var division_id 	= $("#division_id").val();
            var department_id 	= $("#department_id").val();
            var section_id 		= $("#section_id").val();

            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>payrollemployeecommission/getHROEmployeeData",
               data : {division_id: division_id, department_id: department_id, section_id: section_id},
               success: function(data){
                   $("#employee_id").html(data);
               }
            });
        });
    });


    function processAddArrayPayrollEmployeeCommission(){
		
		var division_id 						= document.getElementById("division_id").value;
		var department_id 						= document.getElementById("department_id").value;
		var section_id 							= document.getElementById("section_id").value;
		var employee_id 						= document.getElementById("employee_id").value;
		var employee_commission_omzet_mmc 		= document.getElementById("employee_commission_omzet_mmc").value;
		var employee_commission_quantity_mmc 	= document.getElementById("employee_commission_quantity_mmc").value;
		var employee_commission_omzet_acc 		= document.getElementById("employee_commission_omzet_acc").value;
		var employee_commission_non_mmc 		= document.getElementById("employee_commission_non_mmc").value;
		var employee_commission_sales 			= document.getElementById("employee_commission_sales").value;

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('payrollemployeecommission/processAddArrayPayrollEmployeeCommission');?>",
			  data: {
					'division_id' 						: division_id,
					'department_id' 					: department_id, 
					'section_id' 						: section_id, 
					'employee_id' 						: employee_id, 
					'employee_commission_omzet_mmc' 	: employee_commission_omzet_mmc, 
					'employee_commission_quantity_mmc' 	: employee_commission_quantity_mmc, 
					'employee_commission_omzet_acc' 	: employee_commission_omzet_acc, 
					'employee_commission_non_mmc' 		: employee_commission_non_mmc, 
					'employee_commission_sales' 		: employee_commission_sales, 
					'session_name' 						: "addarraypurchaserequisitionitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
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
								<a href="<?php echo base_url();?>payrollemployeecommission">
									Employee Bonus Data List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollemployeecommission/addPayrollEmployeeCommission>">
									Add Employee Commission
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Add Employee Bonus Data
					</h3>
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
					<a href="<?php echo base_url();?>payrollemployeecommission" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<div class="portlet-body ">
				<div class="form-body form">
					<?php 
						echo form_open('payrollemployeecommission/processAddPayrollEmployeeCommission',array('id' => 'myform', 'class' => 'horizontal-form')); 

						$unique 	= $this->session->userdata('unique');

						$data		= $this->session->userdata('addpayrollemployeecommission-'.$unique['unique']);
					?>
					<div class = "row">
						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('monthly_period', $payrollmonthlyperiod, set_value('monthly_period', $data['monthly_period']),'id="monthly_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>Period</label>
							</div>
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_commission_mmc_omzet" id="employee_commission_mmc_omzet" value="<?php echo $data['employee_commission_mmc_omzet']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
								<label class="control-label">Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_commission_mmc_omzet" id="employee_commission_mmc_omzet" value="<?php echo $data['employee_commission_mmc_omzet']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
								<label class="control-label">End Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>

					<h4 class="form-section bold">Employee Sales Commission </h4>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision, set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>Division</label>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">			
								<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose Item--</option>
								</select>
								<label class="control-label">Department Name<span class="required">*</span></label>		
							</div>
						</div>		
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">			
								<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose Item--</option>
								</select>
								<label class="control-label">Section Name<span class="required">*</span></label>		
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">			
								<select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose Item--</option>
								</select>
								<label class="control-label">Employee Name<span class="required">*</span></label>		
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_commission_omzet_mmc" id="employee_commission_omzet_mmc" value="<?php echo $data['employee_commission_omzet_mmc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Omzet MMC
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_commission_quantity_mmc" id="employee_commission_quantity_mmc" value="<?php echo $data['employee_commission_quantity_mmc']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Quantity MMC
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

						<div class = "col-md-3">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_commission_non_mmc', $employeecommissionnonmmc, set_value('employee_commission_non_mmc',$data['employee_commission_non_mmc']),'id="employee_commission_non_mmc" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>Non MMC</label>
							</div>
						</div>

						<div class = "col-md-3">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_commission_sales', $employeecommissionsales, set_value('employee_commission_sales',$data['employee_commission_sales']),'id="employee_commission_sales" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
								<label>SPV</label>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12" style='text-align:right'>
						<input type="button" name="add2" id="buttonAddArrayPayrollEmployeeCommission" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayPayrollEmployeeCommission();">
					</div>
				</div>	
				
			</div>
		</div>
	</div>
</div>

<?php
	$unique 	= $this->session->userdata('unique');

	$payrollemployeecommissionitem	= $this->session->userdata('addarraypayrollemployeecommission-'.$unique['unique']);

	print_r("payrollemployeecommissionitem ");
	print_r($payrollemployeecommissionitem);

?>

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
				<div class="form-body form">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Division Name</th>
											<th>Department Name</th>
											<th>Section Name</th>
											<th>Employee Name</th>
											<th>Omzet MMC</th>
											<th>Quantity MMC</th>
											<th>Omzet Acc</th>
											<th>Total Omzet</th>
											<th>MMC</th>
											<th>SPV</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($payrollemployeecommissionitem)){
											echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($payrollemployeecommissionitem as $key=>$val){
												echo"
													<tr>
														<td>".$this->payrollemployeecommission_model->getDivisionName($val['division_id'])."</td>
														<td>".$this->payrollemployeecommission_model->getDepartmentName($val['department_id'])."</td>
														<td>".$this->payrollemployeecommission_model->getSectionName($val['section_id'])."</td>
														<td>".$this->payrollemployeecommission_model->getEmployeeName($val['employee_id'])."</td>
														<td>".nominal($val['employee_commission_omzet_mmc'])."</td>
														<td>".nominal($val['employee_commission_quantity_mmc'])."</td>
														<td>".nominal($val['employee_commission_omzet_acc'])."</td>
														<td>".nominal($val['employee_commission_total_omzet'])."</td>
														<td>".$this->configuration->EmployeeCommissionNonMMC[$val['employee_commission_non_mmc']]."</td>
														<td>".$this->configuration->EmployeeCommissionSales[$val['employee_commission_sales']]."</td>
														<td>
															<a href='".$this->config->item('base_url').'payrollemployeecommission/deletePayrollEmployeeCommission/'.$val['employee_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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

					<div class = "row">
						<div class="form-actions right">
							<button type="reset" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Reset</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>