<script>
	function reset_session(){
		document.location = base_url+"hroemployeestatusalteration/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeestatusalteration/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeestatusalteration/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeecontractextending">
									Contract Extending List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeecontractextending/AddHROEmployeeContractExtending/<?php echo $hroemployeedata['employee_id']?>">
									Add Contract Extending
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Contract Extending - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->hroemployeecontractextending_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->hroemployeecontractextending_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->hroemployeecontractextending_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeecontractextending" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeecontractextending/processAddHROEmployeeContractExtending',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhroemployeecontractextending');
									?>
									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="contract_extending_date" id="contract_extending_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['contract_extending_date']);?>">
												<label class="control-label">Contract Extending Date</label>
											</div>
										</div>


										<div class = "col-md-6">
											<div class = "form-group form-md-line-input">
												<?php echo form_dropdown('contract_id', $corecontract ,set_value('contract_id',$data['contract_id']),'id="contract_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Contract Name
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
												<input type="text" autocomplete="off"  name="contract_extending_description" id="contract_extending_description" value="<?php echo $data['contract_extending_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Description</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="contract_extending_last_date" id="contract_extending_last_date" value="<?php echo tgltoview($hroemployeedata['employee_employment_status_duedate'])?>" class="form-control" readonly>
												<label class="control-label">Contract Extending Last Date</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="contract_extending_next_date" id="contract_extending_next_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['contract_extending_next_date']);?>">
												<label class="control-label">Contract Extending Next Date</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="contract_extending_remark" id="contract_extending_remark" onChange="function_elements_add(this.name, this.value);" class="form-control"><?php echo $data['contract_extending_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id'] ?>">
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
