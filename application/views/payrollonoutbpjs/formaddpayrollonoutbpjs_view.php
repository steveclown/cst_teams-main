<script>
	function reset_session(){
		document.location = base_url+"payrollonoutbpjs/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollonoutbpjs/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollonoutbpjs/function_state_add');?>",
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
								<a href="<?php echo base_url();?>payrollonoutbpjs">
									Medical Claim List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>payrollonoutbpjs/addPayrollOnOutBPJS/<?php echo $hroemployeedata['employee_id']?>">
									Add On Out BPJS
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add On Out BPJS - <?php echo $hroemployeedata['employee_name']?> -
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
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->payrollonoutbpjs_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->payrollonoutbpjs_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->payrollonoutbpjs_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
					<a href="<?php echo base_url();?>payrollonoutbpjs" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('payrollonoutbpjs/processAddPayrollOnOutBPJS',array('id' => 'myform', 'class' => 'horizontal-form'));
						$data = $this->session->userdata('addpayrollonoutbpjs');
					?>		
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="bpjs_in_date" id="bpjs_in_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['bpjs_in_date']);?>">
								<label class="control-label">BPJS In Date
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
								<input type="text" name="bpjs_reported_salary" id="bpjs_reported_salary" value="<?php echo $data['bpjs_reported_salary'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">BPJS Reported Salary
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_total_amount" id="bpjs_total_amount" value="<?php echo $data['bpjs_total_amount'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">BPJS Total Amount
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
								<?php echo form_dropdown('bpjs_kesehatan_status', $bpjsstatus ,set_value('bpjs_kesehatan_status',$data['bpjs_kesehatan_status']),'id="bpjs_kesehatan_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">BPJS Kesehatan Status
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_kesehatan_no" id="bpjs_kesehatan_no" value="<?php echo $data['bpjs_kesehatan_no'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">BPJS Kesehatan No</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_kesehatan_percentage" id="bpjs_kesehatan_percentage" value="<?php echo $data['bpjs_kesehatan_percentage'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">BPJS Kesehatan Percentage</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_kesehatan_amount" id="bpjs_kesehatan_amount" value="<?php echo $data['bpjs_kesehatan_amount'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >
								<label class="control-label">BPJS Kesehatan Amount</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('bpjs_tenagakerja_status', $bpjsstatus ,set_value('bpjs_tenagakerja_status',$data['bpjs_tenagakerja_status']),'id="bpjs_tenagakerja_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">BPJS Tenaga Kerja Status
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_tenagakerja_no" id="bpjs_tenagakerja_no" value="<?php echo $data['bpjs_tenagakerja_no'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">BPJS Tenaga Kerja No</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_tenagakerjan_percentage" id="bpjs_tenagakerja_percentage" value="<?php echo $data['bpjs_tenagakerja_percentage'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">BPJS Tenaga Kerja Percentage</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="bpjs_tenagakerja_amount" id="bpjs_tenagakerja_amount" value="<?php echo $data['bpjs_tenagakerja_amount'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" >
								<label class="control-label">BPJS Tenaga Kerja Amount</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('bpjs_out_status', $bpjsstatus ,set_value('bpjs_out_status',$data['bpjs_out_status']),'id="bpjs_out_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">BPJS Status
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="bpjs_out_date" id="bpjs_out_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['bpjs_out_date']);?>">
								<label class="control-label">BPJS Out Date
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
								<textarea rows="3" name="bpjs_remark" id="bpjs_remark" class="form-control"><?php echo $data['bpjs_remark'];?></textarea>
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
