<script>
	base_url = '<?php echo base_url()?>';

	function reset_add(){
		document.location = base_url+"hroemployeepermit/reset_add/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeepermit/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeepermit/function_state_add');?>",
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
								<a href="<?php echo base_url();?>hroemployeepermit">
									Employee Permit List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>hroemployeepermit/addHROEmployeePermit/<?php echo $hroemployeedata['employee_id']?>">
									Add Employee Permit
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Add Employee Permit - <?php echo $hroemployeedata['employee_name'];?> -
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
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->hroemployeepermit_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Division</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->hroemployeepermit_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Department</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->hroemployeepermit_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
					<a href="<?php echo base_url();?>hroemployeepermit" class="btn btn-default sm">
						<i class="fa fa-angle-left"></i>
						Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('hroemployeepermit/processAddHROEmployeePermit',array('id' => 'myform', 'class' => 'horizontal-form')); 

						$unique 	= $this->session->userdata('unique');

						$data		= $this->session->userdata('addhroemployeepermit-'.$unique['unique']);

						if (empty($data)){
							$data['employee_permit_date'] 		= date("Y-m-d");
							$data['employee_permit_start_date'] = date("Y-m-d");
							$data['employee_permit_end_date'] 	= date("Y-m-d");
						}

					?>
					<div class = "row">		
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_permit_date" id="employee_permit_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_permit_date']);?>"/>
								<label class="control-label">Permit Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('permit_id', $corepermit ,set_value('permit_id',$data['permit_id']),'id="permit_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Permit Name</label>
							</div>
						</div>
					</div>

					<div class = "row">		
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_permit_start_date" id="employee_permit_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_permit_start_date']);?>"/>
								<label class="control-label">Permit Start Date
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_permit_end_date" id="employee_permit_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_permit_end_date']);?>"/>
								<label class="control-label">Permit End Date
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
								<input type="text" class="form-control" id="employee_permit_description" name="employee_permit_description" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_permit_description'];?>">
								<label class="control-label">Permit Description </label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="text" class="form-control" id="employee_permit_duration" name="employee_permit_duration" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_permit_duration'];?>">
								<label class="control-label">Permit Duration </label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="employee_permit_remark" id="employee_permit_remark" onChange="function_elements_add(this.name, this.value);" class="form-control"><?php echo $data['employee_permit_remark'];?></textarea>
								<label class="control-label">Remark</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="reset" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
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
											<th>Permit Date</th>
											<th>Permit Name</th>
											<th>Permit Description</th>
											<th>Permit Start Date</th>
											<th>Permit End Date</th>
											<th>Permit Duration</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if(!is_array($hroemployeepermit_data)){
											echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeepermit_data as $key=>$val){
												echo"
													<tr>
														<td>".tgltoview($val['employee_permit_date'])."</td>
														<td>".$this->hroemployeepermit_model->getPermitName($val['permit_id'])."</td>
														<td>".$val['employee_permit_description']."</td>
														<td>".tgltoview($val['employee_permit_start_date'])."</td>
														<td>".tgltoview($val['employee_permit_end_date'])."</td>
														<td>".$val['employee_permit_duration']."</td>
														<td>
															<a href='".$this->config->item('base_url').'hroemployeepermit/deleteHROEmployeePermit_Data/'.$val['employee_id']."/".$val['employee_permit_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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


