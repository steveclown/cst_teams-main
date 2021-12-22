<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeeworkingdayoff/reset_search";
	}
</script>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
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
						<a href="<?php echo base_url();?>hroemployeeworkingdayoff">
							Employee Home Early Daily List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Employee Working Day Off List <small>Manage Employee Working Day Off</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('hroemployeeworkingdayoff/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
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
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Division</label>
							</div>	
						</div>
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('department_id', $coredepartment, set_value('department_id',$data['department_id']),'id="department_id" class="form-control select2me" ');
								?>
								<label class="control-label">Department</label>
							</div>	
						</div>
					</div>
					
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me" ');
								?>
								<label class="control-label">Section </label>
							</div>	
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_id', $hroemployeedata, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" ');
								?>
								<label class="control-label">Employee </label>
							</div>	
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th>
									Employee Name
								</th>
								<th>
									Division Name
								</th>
								<th>
									Department Name
								</th>
								<th>
									Section Name
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeedata_workingdayoff as $key=>$val){
									/*<a href='".$this->config->item('base_url').'hroemployeeworkingdayoff/editHROEmployeeAbsence/'.$val['employee_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>*/
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$this->hroemployeeworkingdayoff_model->getEmployeeName($val['employee_id'])."</td>
											<td>".$this->hroemployeeworkingdayoff_model->getDivisionName($val['division_id'])."</td>
											<td>".$this->hroemployeeworkingdayoff_model->getDepartmentName($val['department_id'])."</td>
											<td>".$this->hroemployeeworkingdayoff_model->getSectionName($val['section_id'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'hroemployeeworkingdayoff/addHROEmployeeWorkingDayOff/'.$val['employee_id']."' class='btn default btn-xs green-jungle'>
													<i class='fa fa-plus'></i> Add
												</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>