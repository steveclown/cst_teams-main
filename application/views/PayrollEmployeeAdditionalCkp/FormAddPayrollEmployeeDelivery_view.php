<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add_delivery(){
		document.location = base_url+"payrollemployeeadditionalckp/reset_add_delivery/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_delivery(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalckp/function_elements_add_delivery');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
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
	
	// for($i = $year_now; $i<($year_now+2); $i++){
	// 	$year[$i] = $i;
	// } 
?>
				
<?php 
	echo form_open('PayrollEmployeeAdditionalCkp/processAddPayrollEmployeeDelivery',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	$data_delivery	= $this->session->userdata('addpayrollemployeedelivery-'.$unique['unique']);

	if (empty($data_delivery['employee_delivery_date'])){
		$data_delivery['employee_delivery_date'] = date('Y-m-d');
	}

	if (empty($data_delivery['employee_delivery_days'])) {
		$data_delivery['employee_delivery_days']="";
	}
	if (empty($data_delivery['employee_delivery_status'])) {
		$data_delivery['employee_delivery_status']="";
	}
	if (empty($data_delivery['employee_delivery_description'])) {
		$data_delivery['employee_delivery_description']="";
	}

	echo $this->session->userdata('message_delivery');
	$this->session->unset_userdata('message_delivery');
?>

<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
           <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_delivery_date" id="employee_delivery_date" value="<?php echo tgltoview($data_delivery['employee_delivery_date']); ?>">
			<label for="form_control">Tanggal Pengiriman </label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<!-- <input type="text" name="employee_delivery_days" id="employee_delivery_days" value="<?php echo $data_delivery['employee_delivery_days']?>" class="form-control" onChange="function_elements_add_delivery(this.name, this.value);"> -->
			<?php
				echo form_dropdown('employee_delivery_days', $deliverydays, set_value('employee_delivery_days', $data_delivery['employee_delivery_days']),'id="employee_delivery_days" class="form-control select2me" ');
			?>
			<label for="form_control">Hari Pengiriman </label>
		</div>
	</div>
</div>
	
<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
           <?php
				echo form_dropdown('employee_delivery_status', $employeedeliverystatus, set_value('employee_delivery_status', $data_delivery['employee_delivery_status']),'id="employee_delivery_status" class="form-control select2me" ');
			?>
			<label for="form_control"> Status Pengiriman</label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_delivery_description" id="employee_delivery_description" value="<?php echo $data_delivery['employee_delivery_description']?>" class="form-control" onChange="function_elements_add_delivery(this.name, this.value);">
			<label class="control-label">Deskripsi Pengiriman 
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>
								
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_delivery();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>
							
<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Tanggal Pengiriman</th>
						<th>Hari Pengiriman </th>
						<th>Deskripsi Pengiriman </th>
						<th> Status Pengiriman</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeedelivery)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeedelivery as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_delivery_date'])."</td>
									<td>".$deliverydays[$val['employee_delivery_days']]."</td>
									<td>".$val['employee_delivery_description']."</td>
									<td>".$employeedeliverystatus[$val['employee_delivery_status']]."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeeadditionalckp/deletePayrollEmployeeDelivery/'.$val['employee_id']."/".$val['employee_delivery_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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