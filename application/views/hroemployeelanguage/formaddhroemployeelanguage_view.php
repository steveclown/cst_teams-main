<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"hroemployeeleave/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeleave/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeeleave/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeelanguage">
									Employee Language List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeelanguage/AddHROEmployeeLanguage/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Language
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Language - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->hroemployeelanguage_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->hroemployeelanguage_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->hroemployeelanguage_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>hroemployeelanguage" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>

							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('hroemployeelanguage/processAddHROEmployeeLanguage',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddHroEmployeeLanguage');
									?>
									<div class="row">	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('language_id', $corelanguage,set_value('language_id',$data['language_id']),'id="language_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Language</label>
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_language_listen', $listeningskill,set_value('employee_language_listen',$data['employee_language_listen']),'id="employee_language_listen" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label for="form-control">Listening Skill</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_language_read', $readingskill,set_value('employee_language_read',$data['employee_language_read']),'id="employee_language_read" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label for="form-control">Reading Skill</label>
											</div>
										</div>
									</div>

									<div class="row">	
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_language_write', $writingskill,set_value('employee_language_write',$data['employee_language_write']),'id="employee_language_write" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label for="form-control">Writing Skill</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('employee_language_speak', $speakingskill,set_value('employee_language_speak',$data['employee_language_speak']),'id="employee_language_speak" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label for="form-control">Speaking Skill</label>
											</div>
										</div>
									</div>

									<div class = "row">	
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="employee_language_remark" id="employee_language_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['employee_language_remark'];?></textarea>
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
