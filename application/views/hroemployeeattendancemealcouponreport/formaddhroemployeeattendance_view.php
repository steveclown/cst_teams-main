<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeattendance/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeattendance/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeattendance/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeeattendance">
									Employee Attendance List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>hroemployeeattendance/AddHROEmployeeAttendance/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Attendance
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<h1 class="page-title">
						Employee Attendance
					</h1>

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
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeeattendance/processAddHROEmployeeAttendance',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_rfid_code" id="employee_rfid_code" value="<?php echo $data['employee_rfid_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" autofocus>
												<label class="control-label">Employee RFID Code</label>
											</div>	
										</div>
									</div>
								</div>
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
							Form Add
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue">
								<div class="portlet-body form">
									<div class="form-body">
										<?php
											$unique 	= $this->session->userdata('unique');
											$data 		= $this->session->userdata('addarrayhroemployeeattendance-'.$sesi['unique']);
										?>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  name="employee_code" id="employee_code" value="<?php echo $data['employee_code'];?>" class="form-control" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Employee Code</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $data['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Employee Name
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
													<input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $data['division_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Division Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  name="department_name" id="department_name" value="<?php echo $data['department_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Department Name
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
													<input type="text" autocomplete="off"  name="section_name" id="section_name" value="<?php echo $data['section_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Section Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" autocomplete="off"  name="unit_name" id="unit_name" value="<?php echo $data['unit_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Unit Name
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
													<input type="text" autocomplete="off"  name="job_title_name" id="job_title_name" value="<?php echo $data['job_title_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Please input only alpha-numerical characters.
													</span>

													<label class="control-label">Job Title Name
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>