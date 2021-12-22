<script>
	base_url 	= '<?php echo base_url();?>';
	
	function reset_edit_bpjs(){
		document.location = base_url+"PayrollPeriodData/reset_edit_bpjs";
	}

	function function_elements_edit_bpjs(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollPeriodData/function_elements_edit_bpjs');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processEditArrayPayrollPeriodBPJS(){
		var period_bpjs_working_start			= document.getElementById("period_bpjs_working_start").value;
		var period_bpjs_working_end				= document.getElementById("period_bpjs_working_end").value;
		var period_bpjs_kesehatan_amount		= document.getElementById("period_bpjs_kesehatan_amount").value;
		var period_bpjs_tenagakerja_amount		= document.getElementById("period_bpjs_tenagakerja_amount").value;
		var bpjs_tenagakerja_subvention_monthly	= document.getElementById("bpjs_tenagakerja_subvention_monthly").value;
		var bpjs_tenagakerja_subvention_daily	= document.getElementById("bpjs_tenagakerja_subvention_daily").value;
		var employee_employment_status			= document.getElementById("employee_employment_status_bpjs").value;

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('PayrollPeriodData/processEditArrayPayrollPeriodBPJS');?>",
			  data: {
					'period_bpjs_working_start'				: period_bpjs_working_start,	
					'period_bpjs_working_end'				: period_bpjs_working_end,	
					'period_bpjs_kesehatan_amount'			: period_bpjs_kesehatan_amount,	
					'period_bpjs_tenagakerja_amount'		: period_bpjs_tenagakerja_amount,	
					'bpjs_tenagakerja_subvention_monthly'	: bpjs_tenagakerja_subvention_monthly,	
					'bpjs_tenagakerja_subvention_daily'		: bpjs_tenagakerja_subvention_daily,
					'employee_employment_status'			: employee_employment_status,
					'session_name' 							: "editarraypurchaseorderitem-"
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
	
	// for($i = ($year_now-1); $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// }  
?>
				
<?php 
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('editpayrollperiodbpjs-'.$unique['unique']);
	$payrollperiodbpjs		= $this->session->userdata('editarraypayrollperiodbpjs-'.$unique['unique']);

	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_employment_status_bpjs', $employeeemploymentstatus, set_value('employee_employment_status_bpjs', $data['employee_employment_status_bpjs']), 'id="employee_employment_status_bpjs" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
			?>

			<label for="form_control">Employee Status
				<span class="required">*</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="period_bpjs_working_start" name="period_bpjs_working_start" onChange="function_elements_edit_bpjs(this.name, this.value);" value="<?php echo $data['period_bpjs_working_start'];?>">
			<label class="control-label">Working Start </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="period_bpjs_working_end" name="period_bpjs_working_end" onChange="function_elements_edit_bpjs(this.name, this.value);" value="<?php echo $data['period_bpjs_working_end'];?>">
			<label class="control-label">Working End </label>
		</div>	
	</div>
</div>
	
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="period_bpjs_kesehatan_amount" id="period_bpjs_kesehatan_amount" value="<?php echo $data['period_bpjs_kesehatan_amount']?>" class="form-control" onChange="function_elements_edit_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Kesehatan Amount
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="period_bpjs_tenagakerja_amount" id="period_bpjs_tenagakerja_amount" value="<?php echo $data['period_bpjs_tenagakerja_amount']?>" class="form-control" onChange="function_elements_edit_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Tenaga Kerja Amount
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
			<input type="text" name="bpjs_tenagakerja_subvention_monthly" id="bpjs_tenagakerja_subvention_monthly" value="<?php echo $data['bpjs_tenagakerja_subvention_monthly']?>" class="form-control" onChange="function_elements_edit_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Tenaga Kerja Subvention Monthly
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerja_subvention_daily" id="bpjs_tenagakerja_subvention_daily" value="<?php echo $data['bpjs_tenagakerja_subvention_daily']?>" class="form-control" onChange="function_elements_edit_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Tenaga Kerja Subvention Daily
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>
					
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonEditArrayPayrollPeriodBPJS" value="Reset" class="btn red" title="Reset" onClick="reset_edit_bpjs();">
		<input type="button" name="Edit2" id="buttonEditArrayPayrollPeriodBPJS" value="Edit" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayPayrollPeriodBPJS();">
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
						<th>Working Start</th>
						<th>Working End</th>
						<th>BPJS Kesehatan Amount</th>
						<th>BPJS Tenaga Kerja Amount</th>
						<th>Tenaga Kerja Subvention Monthly</th>
						<th>Tenaga Kerja Subvention Daily</th>
						<th>Employee Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollperiodbpjs)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollperiodbpjs as $key => $val){
							if ($val['item_status'] <> 2){
								echo"
									<tr>
										<td style='text-align  : right !important;'>".$val['period_bpjs_working_start']."</td>
										<td style='text-align  : right !important;'>".$val['period_bpjs_working_end']."</td>
										<td style='text-align  : right !important;'>".nominal($val['period_bpjs_kesehatan_amount'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['period_bpjs_kesehatan_amount'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['bpjs_tenagakerja_subvention_monthly'])."</td>
										<td style='text-align  : right !important;'>".nominal($val['bpjs_tenagakerja_subvention_daily'])."</td>
										<td>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
										<td>
											<a href='".$this->config->item('base_url').'PayrollPeriodData/deleteEditArrayPayrollPeriodBPJS/'.$val['record_id']."/".$payrollperiod['payroll_period_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Delete
											</a>";
										echo"
									</tr>
									
								";
							}
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>