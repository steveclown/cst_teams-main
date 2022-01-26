<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeehomeearly/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeehomeearly/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeehomeearly/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeehomeearly">
									Employee Home Early List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeehomeearly/addHROEmployeeHomeEarly/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Home Early 
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Home Early  - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->hroemployeehomeearly_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->hroemployeehomeearly_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->hroemployeehomeearly_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeehomeearly" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeehomeearly/processAddHROEmployeeHomeEarly',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhroemployeehomeearly');
									?>
									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('home_early_id', $corehomeearly,set_value('home_early_id',$data['home_early_id']),'id="home_early_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Home Early Name
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
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_home_early_date" id="employee_home_early__date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_home_early_date']);?>"/>
												<label class="control-label">Home Early Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_hour" name="employee_home_early_hour" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_home_early_hour'];?>">
												<label class="control-label">Home Early Hour </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_description" name="employee_home_early_description" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_home_early_description'];?>">
												<label class="control-label">Home Early Description </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="employee_home_early_reason" name="employee_home_early_reason" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_home_early_reason'];?>">
												<label class="control-label">Home Early Reason </label>
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
