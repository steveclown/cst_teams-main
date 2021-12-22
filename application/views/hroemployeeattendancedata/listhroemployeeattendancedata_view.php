<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeeattendancedata/reset_search";
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
						<a href="hroemployeeattendancedata">
							Employee Attendance Data List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Employee Attendance Data List
			</h1>

<?php echo form_open('hroemployeeattendancedata/filter',array('id' => 'myform', 'class' => '')); ?>
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
									echo form_dropdown('monthly_period_id', $payrollmonthlyperiod, set_value('monthly_period_id', $data['monthly_period_id']), 'id="monthly_period_id" class="form-control select2me" ');
								?>
								<label class="control-label">Payroll Monthly Period</label>
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

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						List
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>hroemployeeattendancedata/addHROEmployeeAttendanceData" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add Employee Attendance Data
						</a>
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
									Payroll Monthly Period
								</th>
								<th>
									Monthly Period Start Date
								</th>
								<th>
									Monthly Period End Date
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeeattendancedatalog as $key=>$val){
									
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['monthly_period']."</td>
											<td>".tgltoview($val['monthly_period_start_date'])."</td>
											<td>".tgltoview($val['monthly_period_end_date'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'hroemployeeattendancedata/showdetail/'.$val['employee_attendance_data_log_id']."' class='btn default btn-xs yellow-lemon'>
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