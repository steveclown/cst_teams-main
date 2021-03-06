<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeemployment/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeemployment/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeemployment/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>


<?php 
	date_default_timezone_set('Asia/Jakarta');
	echo form_open('hroemployeeemployment/processAddHroEmployeeEmployment',array('id' => 'myform', 'class' => 'horizontal-form')); 

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	
	$unique 		= $this->session->userdata('unique');
	$data 			= $this->session->userdata('addHroEmployeeEmployment-'.$unique['unique']);
	$employee_employment_token	= $this->session->userdata('HroEmployeeEmploymentToken-'.$unique['unique']);

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
								<a href="<?php echo base_url();?>hroemployeeemployment">
									Employment List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hro-employee-employment/add/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Data
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Employment - <?php echo $hroemployeedata['employee_name']?> -
					</h1>

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
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->HroEmployeeEmployment_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->HroEmployeeEmployment_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->HroEmployeeEmployment_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hro-employee-employment" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_working_status', $workingstatus ,set_value('employee_employment_working_status',$hroemployeedata['employee_employment_working_status']),'id="employee_employment_working_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Kerja</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_overtime_status', $overtimestatus ,set_value('employee_employment_overtime_status',$hroemployeedata['employee_employment_overtime_status']),'id="employee_employment_overtime_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Lembur</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<?php echo form_dropdown('employee_employment_status', $employeestatus ,set_value('employee_employment_status',$hroemployeedata['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
													<label class="control-label">Status Pegawai</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_hire_date" id="employee_hire_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_hire_date']);?>"/>
													
													<input type="hidden" name="employee_employment_token" id="employee_employment_token" class="form-control" value="<?php echo $employee_employment_token?>" onChange="function_elements_add(this.name, this.value);">

													<label class="control-label">Tanggal Mendaftar
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
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_date" id="employee_employment_status_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_employment_status_date']);?>"/>
													<label class="control-label">Tanggal Satatus Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_employment_status_duedate" id="employee_employment_status_duedate" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($hroemployeedata['employee_employment_status_duedate']);?>"/>
													<label class="control-label">Tanggal Akhir Status Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>

<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $hroemployeedata['employee_id']?>" class="form-control" readonly>
<?php echo form_close(); ?>