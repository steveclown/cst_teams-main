<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"hroemployeeadministrationckpreport/reset_search";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeadministrationckpreport/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeadministrationckpreport/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeadministrationckpreport/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
            var section_id 	= $("#section_id").val();
            
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeeadministrationckpreport/getCoreUnit",
               data : {section_id: section_id},
               success: function(data){
                   $("#unit_id").html(data);
               }
            });
        });
    });

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
						<a href="hroemployeeadministrationckpreport">
							Employee Attendance Report List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Employee Attendance Report List
			</h1>

<?php 
	echo form_open('hroemployeeadministrationckpreport/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-hroemployeeadministrationckpreport');
	if(!is_array($data)){
		$data['monthly_period_id']		= 0;
		$data['employee_shift_id']		= 0;
		$data['division_id']			= 0;
		$data['department_id']			= 0;
		$data['section_id']				= 0;
		$data['unit_id']				= 0;
	}
?>
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

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_shift_id', $scheduleemployeeshift, set_value('employee_shift_id', $data['employee_shift_id']), 'id="employee_shift_id" class="form-control select2me" ');
								?>
								<label class="control-label">Employee Shift Code</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id', $data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Division</label>
							</div>	
						</div>
						
						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['division_id'])){
										$coredepartment = create_double($this->hroemployeeadministrationckpreport_model->getCoreDepartment($data['division_id']),'department_id','department_name');

										echo form_dropdown('department_id', $coredepartment,set_value('department_id',$data['department_id']),'id="department_id" class="form-control select2me"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" >
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Department Name</label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['department_id'])){
										$coresection = create_double($this->hroemployeeadministrationckpreport_model->getCoreSection($data['department_id']),'section_id','section_name');

										echo form_dropdown('section_id', $coresection,set_value('section_id',$data['section_id']),'id="section_id" class="form-control select2me" ');
									} else {
								?>
									<select name="section_id" id="section_id" class="form-control select2me" >
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Section Name</label>
							</div>
						</div>

						<div class="col-md-6 ">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['section_id'])){
										$coreunit = create_double($this->hroemployeeadministrationckpreport_model->getCoreUnit($data['section_id']), 'unit_id', 'unit_name');

										echo form_dropdown('unit_id', $coreunit, set_value('unit_id', $data['unit_id']),'id="unit_id" class="form-control select2me" ');
									} else {
								?>
									<select name="unit_id" id="unit_id" class="form-control select2me" >
										<option value="">--Choose Item--</option>
									</select>
								<?php
									}
								?>
								
								<label class="control-label">Unit Name</label>
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

	$unique 	= $this->session->userdata('unique');
	$employeeadministrationckp 			= $this->session->userdata('addArrayEmployeeAdministrationCKP-'.$unique['unique']);
	$employeeadministrationckp_week 	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Week-'.$unique['unique']);
	$employeeadministrationckp_period 	= $this->session->userdata('addArrayEmployeeAdministrationCKP_Period-'.$unique['unique']);
?>

<?php
	echo form_open('hroemployeeadministrationckpreport/processPrinting'); 
?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<div class = "row">
						<div class = "col-md-12">
							<table class="table table-bordered table-advance table-hover">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th width="10%">
											Unit Name
										</th>
										<th width="7%">
											Date
										</th>
										<th width="8%">
											Day Name
										</th>
										<th width="10%">
											Total Employee
										</th>
										<th colspan = "2" width="10%">
											Total Absence
										</th>
										<th colspan = "2" width="10%">
											Total Permit
										</th>
										<th colspan = "2" width="10%">
											Total SDR
										</th>
										<th width="10%">
											Total Off
										</th>
										<th width="10%">
											Total Attendance
										</th>
										<th width="10%">
											IMS
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;

										if(empty($employeeadministrationckp)){
											echo "<tr><td style='text-align:center' colspan='14'>Data Empty</td></tr>";
										} else {
											foreach ($employeeadministrationckp as $key => $val){
												echo"
													<tr>			
														<td>".$no."</td>						
														<td>".$val['unit_name']."</td>
														<td>".tgltoview($val['employee_attendance_date'])."</td>
														<td>".$val['employee_attendance_name']."</td>
														<td style='text-align:right'>".number_format($val['employee_attendance_total'], 2)."</td>
														<td style='text-align:right'>".$val['employee_absence_total']."</td>
														<td style='text-align:right'>".number_format($val['employee_absence_total_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['employee_permit_total']."</td>
														<td style='text-align:right'>".number_format($val['employee_permit_total_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['employee_sick_total']."</td>
														<td style='text-align:right'>".number_format($val['employee_sick_total_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['employee_off_total']."</td>
														<td style='text-align:right'>".$val['employee_attend_total']."</td>
														<td style='text-align:right'>".number_format($val['employee_administration_total_percentage'], 2)."</td>
													</tr>
												";
												$no++;
											} 
										}
									?>
								</tbody>
							</table>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<table class="table table-bordered table-advance table-hover">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th width="10%">
											Start Date
										</th>
										<th width="10%">
											End Date
										</th>
										<th width="10%">
											Avg Total Employee
										</th>
										<th colspan = "2" width="10%">
											Total Absence
										</th>
										<th colspan = "2" width="10%">
											Total Permit
										</th>
										<th colspan = "2" width="10%">
											Total SDR
										</th>
										<th width="10%">
											Total Off
										</th>
										<th width="10%">
											Total Attendance
										</th>
										<th width="10%">
											IMS
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;

										if(empty($employeeadministrationckp_week)){
											echo "<tr><td style='text-align:center' colspan='13'>Data Empty</td></tr>";
										} else {
											foreach ($employeeadministrationckp_week as $key => $val){
												echo"
													<tr>			
														<td>".$no."</td>						
														<td>".tgltoview($val['start_date'])."</td>
														<td>".tgltoview($val['end_date'])."</td>
														<td style='text-align:right'>".number_format($val['total_employee_week_average'], 2)."</td>
														<td style='text-align:right'>".$val['total_absence_week']."</td>
														<td style='text-align:right'>".number_format($val['total_absence_week_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['total_permit_week']."</td>
														<td style='text-align:right'>".number_format($val['total_permit_week_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['total_sick_week']."</td>
														<td style='text-align:right'>".number_format($val['total_sick_week_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['total_off_week']."</td>
														<td style='text-align:right'>".$val['total_attend_week']."</td>
														<td style='text-align:right'>".number_format($val['total_administration_week_percentage'], 2)."</td>
													</tr>
												";
												$no++;
											} 
										}
									?>
								</tbody>
							</table>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<table class="table table-bordered table-advance table-hover">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th width="10%">
											Start Date
										</th>
										<th width="10%">
											End Date
										</th>
										<th width="10%">
											Avg Total Employee
										</th>
										<th colspan = "2" width="10%">
											Total Absence
										</th>
										<th colspan = "2" width="10%">
											Total Permit
										</th>
										<th colspan = "2" width="10%">
											Total SDR
										</th>
										<th width="10%">
											Total Off
										</th>
										<th width="10%">
											Total Attendance
										</th>
										<th width="10%">
											IMS
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
										
										if(empty($employeeadministrationckp_period)){
											echo "<tr><td style='text-align:center' colspan='13'>Data Empty</td></tr>";
										} else {
											foreach ($employeeadministrationckp_period as $key => $val){
												echo"
													<tr>			
														<td>".$no."</td>						
														<td>".tgltoview($val['start_date'])."</td>
														<td>".tgltoview($val['end_date'])."</td>
														<td style='text-align:right'>".number_format($val['total_employee_period_average'], 2)."</td>
														<td style='text-align:right'>".$val['total_absence_period']."</td>
														<td style='text-align:right'>".number_format($val['total_absence_period_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['total_permit_period']."</td>
														<td style='text-align:right'>".number_format($val['total_permit_period_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['total_sick_period']."</td>
														<td style='text-align:right'>".number_format($val['total_sick_period_percentage'], 2)."</td>
														<td style='text-align:right'>".$val['total_off_period']."</td>
														<td style='text-align:right'>".$val['total_attend_period']."</td>
														<td style='text-align:right'>".number_format($val['total_administration_period_percentage'], 2)."</td>
													</tr>
												";
												$no++;
											} 
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<br>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<a href='javascript:void(window.open("<?php echo base_url(); ?>hroemployeeadministrationckpreport/exportHROEmployeeAddministrationCKPReport","_blank","top=100,left=200,width=300,height=300"));' class="btn green-jungle" title="Export to Excel">
	                            <i class="fa fa-file-excel-o"></i> Export Data
	                       	</a>
							<input type="submit" name="Preview" id="Preview" value="Preview" class="btn blue" title="Preview">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<input type="hidden" name="employee_shift_id" value="<?php echo $data['employee_shift_id']; ?>"/>
	<input type="hidden" name="monthly_period_id" value="<?php echo $data['monthly_period_id']; ?>"/>
	<input type="hidden" name="division_id" value="<?php echo $data['division_id']; ?>"/>
	<input type="hidden" name="department_id" value="<?php echo $data['department_id']; ?>"/>
	<input type="hidden" name="section_id" value="<?php echo $data['section_id']; ?>"/>
	<input type="hidden" name="unit_id" value="<?php echo $data['unit_id']; ?>"/>
<?php echo form_close(); ?>