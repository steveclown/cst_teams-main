<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('payrollperioddata/addPayrollPeriodData'); ?>";

	function reset_add_attendance(){
		document.location = base_url+"payrollperioddata/reset_add_attendance";
	}

	function function_elements_add_attendance(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollperioddata/function_elements_add_attendance');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processAddArrayPayrollPeriodAttendance(){
		var premi_attendance_id						= document.getElementById("premi_attendance_id").value;
		var period_attendance_working_start			= document.getElementById("period_attendance_working_start").value;
		var period_attendance_working_end			= document.getElementById("period_attendance_working_end").value;
		var period_attendance_amount_monthly		= document.getElementById("period_attendance_amount_monthly").value;
		var period_attendance_amount_daily			= document.getElementById("period_attendance_amount_daily").value;
		var period_attendance_description			= document.getElementById("period_attendance_description").value;
		var employee_employment_status				= document.getElementById("employee_employment_status_attendance").value;

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('payrollperioddata/processAddArrayPayrollPeriodAttendance');?>",
			  data: {
					'premi_attendance_id'			 	: premi_attendance_id,	
					'period_attendance_working_start'	: period_attendance_working_start,	
					'period_attendance_working_end'		: period_attendance_working_end,	
					'period_attendance_amount_monthly'	: period_attendance_amount_monthly,	
					'period_attendance_amount_daily'	: period_attendance_amount_daily,	
					'period_attendance_description'		: period_attendance_description,	
					'employee_employment_status'		: employee_employment_status,	
					'session_name' 						: "addarraypurchaseorderitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});

	}
</script>

<?php 
	$year_now 	=	date('Y');
	// if(!is_array($sesi)){
	// 	$sesi['month']			= date('m');
	// 	$sesi['year']			= $year_now;
	// }
	
	for($i = ($year_now-1); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
				
<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollperiodattendance-'.$unique['unique']);
	$payrollperiodattendance	= $this->session->userdata('addarraypayrollperiodattendance-'.$unique['unique']);

	if(empty($data['premi_attendance_id'])){
		$data['premi_attendance_id']								= '';
	} 

	if(empty($data['period_attendance_working_start'])){
		$data['period_attendance_working_start']				= '';
	} 

	if(empty($data['period_attendance_working_end'])){
		$data['period_attendance_working_end']				= '';
	} 

	if(empty($data['period_attendance_amount_monthly'])){
		$data['period_attendance_amount_monthly']			= '';
	} 

	if(empty($data['period_attendance_amount_daily'])){
		$data['period_attendance_amount_daily']				= '';
	} 

	if(empty($data['period_attendance_description'])){
		$data['period_attendance_description']				= '';
	} 

	if(empty($data['employee_employment_status_attendance'])){
		$data['employee_employment_status_attendance']					= '';
	}

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('premi_attendance_id', $corepremiattendance ,set_value('premi_attendance_id', $data['premi_attendance_id']),'id="premi_attendance_id", class="form-control select2me" onChange="function_elements_add_attendance(this.name, this.value);"');?>
			<label class="control-label">Nama Kehadiran
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
			<input type="text" class="form-control" id="period_attendance_working_start" name="period_attendance_working_start" onChange="function_elements_add_attendance(this.name, this.value);" value="<?php echo $data['period_attendance_working_start'];?>">
			<label class="control-label">Mulai Bekerja </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="period_attendance_working_end" name="period_attendance_working_end" onChange="function_elements_add_attendance(this.name, this.value);" value="<?php echo $data['period_attendance_working_end'];?>">
			<label class="control-label">Selesai Bekerja </label>
		</div>	
	</div>
</div>
	
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="period_attendance_amount_monthly" id="period_attendance_amount_monthly" value="<?php echo $data['period_attendance_amount_monthly']?>" class="form-control" onChange="function_elements_add_attendance(this.name, this.value);">
			<label class="control-label">Jumlah Kehadiran Bulanan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="period_attendance_amount_daily" id="period_attendance_amount_daily" value="<?php echo $data['period_attendance_amount_daily']?>" class="form-control" onChange="function_elements_add_attendance(this.name, this.value);">
			<label class="control-label">Jumlah Kehadiran Harian
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
			<input type="text" name="period_attendance_description" id="period_attendance_description" value="<?php echo $data['period_attendance_description']?>" class="form-control" onChange="function_elements_add_attendance(this.name, this.value);">
			<label class="control-label">Deskripsi</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_employment_status_attendance', $employeeemploymentstatus, set_value('employee_employment_status_attendance', $data['employee_employment_status_attendance']), 'id="employee_employment_status_attendance" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>

			<label for="form_control">Status Karyawan
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>
								
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayPayrollPeriodAttendance" value="Reset" class="btn red" title="Reset" onClick="reset_add_attendance();">
		<input type="button" name="Add2" id="buttonAddArrayPayrollPeriodAttendance" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayPayrollPeriodAttendance();">
	</div>
</div>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Nama Kehadiran</th>
						<th>Mulai Bekerja</th>
						<th>Selesai Bekerja</th>
						<th>Jumlah Kehadiran Bulanan</th>
						<th>Jumlah Kehadiran Harian</th>
						<th>Deskripsi</th>
						<th>Status Karyawan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollperiodattendance)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
					} else {
						foreach ($payrollperiodattendance as $key => $val){
							echo"
								<tr>
									<td>".$this->PayrollPeriodData_model->getPremiAttendanceName($val['premi_attendance_id'])."</td>
									<td style='text-align  : right !important;'>".$val['period_attendance_working_start']."</td>
									<td style='text-align  : right !important;'>".$val['period_attendance_working_end']."</td>
									<td style='text-align  : right !important;'>".nominal($val['period_attendance_amount_monthly'])."</td>
									<td style='text-align  : right !important;'>".nominal($val['period_attendance_amount_daily'])."</td>
									<td>".$val['period_attendance_description']."</td>
									<td>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollperioddata/deleteArrayPayrollPeriodAttendance/'.$val['record_id']."' onClick='javascript:return confirm(\"Apakah Anda yakin akan menghapus data ini ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
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