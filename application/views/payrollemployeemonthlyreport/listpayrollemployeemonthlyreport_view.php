<script type="text/javascript">
	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>payrollemployeemonthlyreport/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>payrollemployeemonthlyreport/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
        	var division_id = $("#division_id").val();
        	var department_id = $("#department_id").val();
            var section_id = $("#section_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>payrollemployeemonthlyreport/getHroEmployeeData",
               data : {division_id: division_id, department_id: department_id, section_id: section_id},
               success: function(data){
                   $("#employee_id").html(data);				   
               }
            });
        });
    });
</script>

<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');

$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
<?php
$data=$this->session->userdata('filter-payrollemployeemonthlyreport');
if(!is_array($data)){
		$sesi['monthly_period'] 	= '';
		$sesi['year_period'] 		= '';			
		$sesi['start_date']			= date('d-m-Y');
		// $sesi['end_date']			= date('d-m-Y');
		// $sesi['division_id']		= '';
		// $sesi['department_id']		= '';
		// $sesi['section_id']			= '';
		$sesi['employee_id']		= '';
	}
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>payrollemployeemonthlyreport">Payroll Employee Monthly</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Payroll Employee Monthly Report
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		
<?php echo form_open('payrollemployeemonthlyreport/filter_payrollemployeemonthlyreport',array('id' => 'myform', 'class' => '')); ?>
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
				<div class="form-body">
					<div class = "row">
						<div class="col-md-3">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('month_period', $monthlist,set_value('month_period',$data['month_period']),'id="month_period" class="form-control select2me" ');
								?>
								<label>From Period</label>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('year_period', $year,set_value('year_period',$data['year_period']),'id="year_period" class="form-control select2me" ');
								?>
								<label></label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-3">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date">
								<label for="form_control">Start Date</label>
							</div>	
						</div>
						
						<div class="col-md-3">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" >
								<label for="form_control">End Date</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision, set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me"');
								?>
								<label>Division Name</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<select name="department_id" id="department_id" class="form-control select2me">
									<option value="">--Choose One--</option>
								</select>
								<label>Department Name</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<select name="section_id" id="section_id" class="form-control select2me">
									<option value="">--Choose One--</option>
								</select>
								<label>Section Name</label>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<select name="employee_id" id="employee_id" class="form-control select2me">
									<option value="">--Choose One--</option>
								</select>
								<label>Employee Name</label>
							</div>
						</div>
					</div>

					<div class="form-group">
						<div class="form-action" style="text-align: right !important;">
							<button type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_all();"><i class="fa fa-times"></i>Reset</button>
							<button type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data"><i class="fa fa-search"></i>Find</button>
							<a href='javascript:void(window.open("<?php echo base_url(); ?>payrollemployeemonthlyreport/export","_blank","top=100,left=200,width=300,height=300"));' title="Export to Excel"> Export Data  <img src='<?php echo base_url(); ?>img/Excel.png' height="32" width="32"></a>
						</div>
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
					List
				</div>
			</div>
			<div class="portlet-body">
				<?php
					echo form_open('payrollemployeemonthlyreport/previewreport'); 
				?>
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Employee Name</th>
							<th>Monthly Period</th>
							<th>Monthly Period Start Date</th>
							<th>Monthly Period End Date</th>
							<th>Bank Acct Name</th>
							<th width="20%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							// print_r($payrollemployeemonthlyreport);
							foreach ($payrollemployeemonthlyreport as $key=>$val){
								echo"
									<tr>	
										<td>".$no."</td>
										<td>$val[employee_name]</td>							
										<td>".$this->configuration->Month[substr($val['employee_monthly_period'], -2, 2)]." ".substr($val['employee_monthly_period'], 0, 4)."</td>
										<td>".tgltoview($val[employee_monthly_start_date])."</td>
										<td>".tgltoview($val[employee_monthly_end_date])."</td>
										<td>$val[employee_monthly_bank_acct_name]</td>
										<td>
											<a href='".$this->config->item('base_url').'payrollemployeemonthlyreport/showdetail/'.$val[employee_monthly_id]."' class='btn default btn-xs yellow-lemon'>
												<i class='fa fa-list'></i> Detail
											</a>
										</td>
									</tr>
								";
								$no++;
						} ?>
					</tbody>
				</table>
				<div class="row">
					<div class="col-md-12 " style="text-align  : right !important;">
						<input type="submit" name="Preview" id="Preview" value="Preview" class="btn blue" title="Preview">
					</div>
				</div>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>