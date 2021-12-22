<script>
	function toRp(number) {
		var number = number.toString(), 
		rupiah = number.split('.')[0], 
		cents = (number.split('.')[1] || '') +'00';
		rupiah = rupiah.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
		return rupiah + '.' + cents.slice(0, 2);
	}

	function calculateHospitalClaimAmount(value) {
		var opening_balance = document.getElementById("hospital_claim_opening_balance").value;
		/*alert(opening_balance);
		alert(value);*/

		if(value>opening_balance){
			alert("Value amount must not exceed opening balance");
			document.getElementById("hospital_claim_amount_view").value = "0";
			document.getElementById("hospital_claim_amount").value = "0";
			document.getElementById("hospital_claim_last_balance_view").value = toRp(opening_balance);
			document.getElementById("hospital_claim_last_balance").value = opening_balance;
		}else{
			document.getElementById("hospital_claim_amount_view").value = toRp(value);
			document.getElementById("hospital_claim_amount").value = value;
			document.getElementById("hospital_claim_last_balance_view").value = toRp(opening_balance-value);
			document.getElementById("hospital_claim_last_balance").value = opening_balance-value;
		}
	}

	function getHospitalCoverageLastBalance(value) {
		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>payrollhospitalclaim/getHospitalCoverageLastBalance",
		   data: {'employee_hospital_coverage_id' : value},
		   success: function(msg){
				// alert(msg);
				document.getElementById("hospital_claim_opening_balance_view").value = toRp(msg);
				document.getElementById("hospital_claim_opening_balance").value = msg;
		   }
		});	
	}


	function reset_session(){
		document.location = base_url+"payrollhospitalclaim/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollhospitalclaim/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollhospitalclaim/function_state_add');?>",
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
								<a href="<?php echo base_url();?>payrollhospitalclaim">
									Hospital Claim List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollhospitalclaim/listpayrollhospitalclaim">
									Hospital Coverage List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollhospitalclaim/addPayrollHospitalClaim/<?php echo $hroemployeedata['employee_id']?>">
									Add Transactional Hospital Claim
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Hospital Claim - <?php echo $hroemployeedata['employee_name']?> -
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
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->payrollhospitalclaim_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->payrollhospitalclaim_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->payrollhospitalclaim_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
					<a href="<?php echo base_url();?>payrollhospitalclaim" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('payrollhospitalclaim/processAddPayrollHospitalClaim',array('id' => 'myform', 'class' => 'horizontal-form'));
						$data = $this->session->userdata('addpayrollhospitalclaim');
					?>		
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="hospital_claim_date" id="hospital_claim_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['hospital_claim_date']);?>">
								<label class="control-label">Claim Date
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
								<input type="text" name="hospital_claim_description" id="hospital_claim_description" value="<?php echo $data[hospital_claim_description];?>" class="form-control">
								<label class="control-label">Hospital Claim Description
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
								<?php echo form_dropdown('employee_hospital_coverage_id', $hroemployeehospitalcoverage ,set_value('employee_hospital_coverage_id',$data['employee_hospital_coverage_id']),'id="employee_hospital_coverage_id", class="form-control select2me" onChange="getHospitalCoverageLastBalance(this.value)"');?>
								<label class="control-label">Hospital Coverage Name
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="hospital_claim_opening_balance_view" id="hospital_claim_opening_balance_view" value="<?php echo nominal($data[hospital_coverage_last_balance]);?>" class="form-control" readonly>
								<input type="hidden" name="hospital_claim_opening_balance" id="hospital_claim_opening_balance" value="<?php echo $data[hospital_coverage_last_balance];?>" class="form-control" placeholder="Opening Balance" readonly>
								<label class="control-label">Opening Balance</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="hospital_claim_amount_view" id="hospital_claim_amount_view" value="<?php echo $data['hospital_claim_amount_view'];?>" class="form-control" onchange="calculateHospitalClaimAmount(this.value)">
								<input type="hidden" name="hospital_claim_amount" id="hospital_claim_amount" value="<?php echo $data['hospital_claim_amount'];?>" class="form-control">
								<span class="help-block">
									 Please input only numbers.
								</span>
								<label class="control-label">Amount</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="hospital_claim_last_balance_view" id="hospital_claim_last_balance_view" value="<?php echo nominal($data[hospital_coverage_last_balance]);?>" class="form-control" readonly>
								<input type="hidden" name="hospital_claim_last_balance" id="hospital_claim_last_balance" value="<?php echo $data[hospital_coverage_last_balance];?>" class="form-control" placeholder="Last Balance">
								<label class="control-label">Last Balance</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="hospital_claim_remark" id="hospital_claim_remark" class="form-control"><?php echo $data['hospital_claim_remark'];?></textarea>
								<label class="control-label">Remark</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id'] ?>">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
