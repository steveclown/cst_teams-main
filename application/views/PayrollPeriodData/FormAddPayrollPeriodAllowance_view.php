<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('payrollperioddata/addPayrollPeriodData'); ?>";

	function reset_add_allowance(){
		document.location = base_url+"payrollperioddata/reset_add_allowance";
	}

	function function_elements_add_allowance(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollperioddata/function_elements_add_allowance');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processAddArrayPayrollPeriodAllowance(){
		var allowance_id						= document.getElementById("allowance_id").value;
		var period_allowance_working_start		= document.getElementById("period_allowance_working_start").value;
		var period_allowance_working_end		= document.getElementById("period_allowance_working_end").value;
		var period_allowance_amount_monthly		= document.getElementById("period_allowance_amount_monthly").value;
		var period_allowance_amount_daily		= document.getElementById("period_allowance_amount_daily").value;
		var period_allowance_description		= document.getElementById("period_allowance_description").value;
		var employee_employment_status			= document.getElementById("employee_employment_status_allowance").value;
		
		// alert(employee_employment_status);

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('payrollperioddata/processAddArrayPayrollPeriodAllowance');?>",
			  data: {
					'allowance_id'			 			: allowance_id,	
					'period_allowance_working_start'	: period_allowance_working_start,	
					'period_allowance_working_end'		: period_allowance_working_end,	
					'period_allowance_amount_monthly'	: period_allowance_amount_monthly,	
					'period_allowance_amount_daily'		: period_allowance_amount_daily,	
					'period_allowance_description'		: period_allowance_description,	
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
	$data 					= $this->session->userdata('addpayrollperiodallowance-'.$unique['unique']);
	$payrollperiodallowance	= $this->session->userdata('addarraypayrollperiodallowance-'.$unique['unique']);

	if(empty($data['allowance_id'])){
		$data['allowance_id'] 											= '';
	}

	if(empty($data['period_allowance_working_start'])){
		$data['period_allowance_working_start'] 						= '';
	}

	if(empty($data['period_allowance_working_end'])){
		$data['period_allowance_working_end'] 							= '';
	}

	if(empty($data['period_allowance_amount_monthly'])){
		$data['period_allowance_amount_monthly'] 						= '';
	}

	if(empty($data['period_allowance_amount_daily'])){
		$data['period_allowance_amount_daily'] 							= '';
	}

	if(empty($data['period_allowance_description'])){
		$data['period_allowance_description'] 							= '';
	}

	if(empty($data['employee_employment_status_allowance'])){
		$data['employee_employment_status_allowance'] 					= '';
	}

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('allowance_id', $coreallowance ,set_value('allowance_id', $data['allowance_id']),'id="allowance_id", class="form-control select2me" onChange="function_elements_add_allowance(this.name, this.value);"');?>
			<label class="control-label">Nama Tunjangan
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
			<input type="text" autocomplete="off"  class="form-control" id="period_allowance_working_start" name="period_allowance_working_start" onChange="function_elements_add_allowance(this.name, this.value);" value="<?php echo $data['period_allowance_working_start'];?>">
			<label class="control-label">Mulai Bekerja </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="period_allowance_working_end" name="period_allowance_working_end" onChange="function_elements_add_allowance(this.name, this.value);" value="<?php echo $data['period_allowance_working_end'];?>">
			<label class="control-label">Selesai Bekerja </label>
		</div>	
	</div>
</div>
	
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="period_allowance_amount_monthly" id="period_allowance_amount_monthly" value="<?php echo $data['period_allowance_amount_monthly']?>" class="form-control" onChange="function_elements_add_allowance(this.name, this.value);">
			<label class="control-label">Jumlah Tunjangan Bulanan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="period_allowance_amount_daily" id="period_allowance_amount_daily" value="<?php echo $data['period_allowance_amount_daily']?>" class="form-control" onChange="function_elements_add_allowance(this.name, this.value);">
			<label class="control-label">Jumlah Tunjangan Harian
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
			<input type="text" autocomplete="off"  name="period_allowance_description" id="period_allowance_description" value="<?php echo $data['period_allowance_description']?>" class="form-control" onChange="function_elements_add_allowance(this.name, this.value);">
			<label class="control-label">Deskripsi</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_employment_status_allowance', $employeeemploymentstatus, set_value('employee_employment_status_allowance', $data['employee_employment_status_allowance']), 'id="employee_employment_status_allowance" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>

			<label for="form_control">Status Karyawan
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>
								
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayPayrollPeriodAllowance" value="Batal" class="btn red" title="Reset" onClick="reset_add_allowance();">
		<input type="button" name="Add2" id="buttonAddArrayPayrollPeriodAllowance" value="Tambah" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayPayrollPeriodAllowance();">
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
						<th>Nama Tunjangan</th>
						<th>Mulai Bekerja</th>
						<th>Selesai Bekerja</th>
						<th>Jumlah Tunjangan Bulanan</th>
						<th>Jumlah Tunjangan Harian</th>
						<th>Deskripsi</th>
						<th>Status Karyawan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollperiodallowance)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data Kosong</th></tr>";
					} else {
						foreach ($payrollperiodallowance as $key => $val){
							echo"
								<tr>
									<td>".$this->PayrollPeriodData_model->getAllowanceName($val['allowance_id'])."</td>
									<td style='text-align  : right !important;'>".$val['period_allowance_working_start']."</td>
									<td style='text-align  : right !important;'>".$val['period_allowance_working_end']."</td>
									<td style='text-align  : right !important;'>".nominal($val['period_allowance_amount_monthly'])."</td>
									<td style='text-align  : right !important;'>".nominal($val['period_allowance_amount_daily'])."</td>
									<td>".$val['period_allowance_description']."</td>
									<td>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollperioddata/deleteArrayPayrollPeriodAllowance/'.$val['record_id']."' onClick='javascript:return confirm(\"Apakah Anda yakin akan menghapus data ini ?\")' class='btn default btn-xs red'>
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