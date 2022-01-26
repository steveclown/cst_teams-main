<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeworking/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeworking/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeworking/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeeworking">
									Employee Working List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeeworking/addHROEmployeeWorking/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Working
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Working - <?php echo $hroemployeedata['employee_name'];?> -
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			

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
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->hroemployeeworking_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->hroemployeeworking_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->hroemployeeworking_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeeworking" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>

							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeworking/processAddHROEmployeeWorking',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddHroEmployeeWorking');
									?>
									
									<div class="row">
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('work_month_from', $monthlist,set_value('work_month_from',$data['work_month_from']),'id="work_month_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>From Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('work_year_from', $year,set_value('work_year_from',$data['work_year_from']),'id="work_year_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('work_month_to', $monthlist,set_value('work_month_to',$data['work_month_to']),'id="work_month_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>To Period</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('work_year_to', $year,set_value('work_year_to',$data['work_year_to']),'id="work_year_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
									</div>

									<div class="row">		
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="working_company_name" name="working_company_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_company_name'];?>">
												<label>Company Name</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 ">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="working_company_address" id="working_company_address" onChange="function_elements_add(this.name, this.value);"class="form-control" ><?php echo $data['working_company_address'];?></textarea>
												<label class="control-label">Company Address</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="working_job_title" name="working_job_title" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_job_title'];?>" >
												<label>Job Title</label>
											</div>
										</div>	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="working_last_salary" name="working_last_salary" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_last_salary'];?>">
												<label>Last Salary</label>
											</div>
										</div>	
									</div>
									<div class="row">
										<div class="col-md-12 ">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="working_separation_reason" id="working_separation_reason" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['working_separation_reason'];?></textarea>
												<label class="control-label">Separation Reason</label>
											</div>
										</div>
									</div>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('working_separation_letter', $separationletter,set_value('working_separation_letter',$data['working_separation_letter']),'id="working_separation_letter" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Separation Letter</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12 ">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="working_experience_remark" id="working_experience_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['working_experience_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
