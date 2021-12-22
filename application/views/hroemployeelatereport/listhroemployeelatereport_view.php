<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeelatereport/reset_search";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeelatereport/function_elements_add');?>",
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
				url : "<?php echo site_url('hroemployeelatereport/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
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
						<a href="<?php echo base_url();?>hroemployeelatereport">
							Employee Late Report List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Employee Late Report List <small>Manage Employee Late Report</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('hroemployeelatereport/filter',array('id' => 'myform', 'class' => '')); ?>
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
								<?php if($data['start_date'] != ''){?>
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['start_date']);?>"/>
									<label class="control-label">Start Date
										<span class="required">
											*
										</span>
									</label>
								<?php }else { ?>
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo date('d-m-Y');?>"/>
									<label class="control-label">Start Date
										<span class="required">
											*
										</span>
									</label>
								<?php } ?>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php if($data['end_date'] != ''){?>
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['end_date']);?>"/>
									<label class="control-label">End Date
										<span class="required">
											*
										</span>
									</label>
								<?php }else { ?>
									<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo date('d-m-Y');?>"/>
									<label class="control-label">End Date
										<span class="required">
											*
										</span>
									</label>
								<?php } ?>
							</div>
						</div>
					</div>

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
									echo form_dropdown('late_id', $corelate, set_value('late_id', $data['late_id']), 'id="late_id" class="form-control select2me" ');
								?>
								<label class="control-label">Late</label>
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
								<th>
									Late Name
								</th>
								<th>
									Late Date
								</th>
								<th>
									Late Duration
								</th>
								<th width="10%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeelate_report as $key=>$val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_name']."</td>
											<td>".$val['division_name']."</td>
											<td>".$val['department_name']."</td>
											<td>".$val['section_name']."</td>
											<td>".$val['late_name']."</td>
											<td>".tgltoview($val['employee_late_date'])."</td>
											<td>".$val['employee_late_duration']."</td>
											<td>
												<a href='".$this->config->item('base_url').'hroemployeelatereport/detailHROEmployeeLate/'.$val['employee_late_id']."' class='btn default btn-xs yellow-saffron'>
													<i class='fa fa-bars'></i> Detail
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