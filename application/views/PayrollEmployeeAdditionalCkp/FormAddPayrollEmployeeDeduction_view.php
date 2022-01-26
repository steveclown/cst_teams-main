<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add_deduction(){
		document.location = base_url+"payrollemployeeadditionalckp/reset_add_deduction/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add_deduction(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalckp/function_elements_add_deduction');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function toRp(number) {
		var number = number.toString(), 
		rupiah = number.split('.')[0], 
		cents = (number.split('.')[1] || '') +'00';
		rupiah = rupiah.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
		return rupiah + '.' + cents.slice(0, 2);
	}

	$(document).ready(function(){
        $("#employee_additional_deduction_amount_view").change(function(){
            var amount 		= $("#employee_additional_deduction_amount_view").val();
         	
         	var amount_view 	= toRp(amount);
			document.getElementById('employee_additional_deduction_amount').value		= amount;
			document.getElementById('employee_additional_deduction_amount_view').value 	= amount_view;
		
        });
    });
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
	echo form_open('payrollemployeeadditionalckp/processAddPayrollEmployeeAdditionalDeduction',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	$data_deduction	= $this->session->userdata('addpayrollemployeeadditionaldeduction-'.$unique['unique']);

	if (empty($data_deduction['employee_additional_deduction_date'])){
		$data_deduction['employee_additional_deduction_date'] = date('Y-m-d');
	}
	if (empty($data_deduction['deduction_id'])) {
		$data_deduction['deduction_id']=9;
	}
	if (empty($data_deduction['employee_additional_deduction_amount'])) {
		$data_deduction['employee_additional_deduction_amount']="";
	}
	if (empty($data_deduction['employee_additional_deduction_amount_view'])) {
		$data_deduction['employee_additional_deduction_amount_view']="";
	}
	if (empty($data_deduction['employee_additional_deduction_description'])) {
		$data_deduction['employee_additional_deduction_description']="";
	}

	echo $this->session->userdata('message_delivery');
	$this->session->unset_userdata('message_delivery');
?>
<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
           <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_additional_deduction_date" id="employee_additional_deduction_date" value="<?php echo tgltoview($data_deduction['employee_additional_deduction_date']); ?>">
			<label for="form_control">Tanggal Potongan Tambahan</label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('deduction_id', $corededuction ,set_value('deduction_id', $data_deduction['deduction_id']),'id="deduction_id", class="form-control select2me" onChange="function_elements_add_deduction(this.name, this.value);"');?>
			<label class="control-label">Nama Potongan
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
			<input type="text" autocomplete="off"  name="employee_additional_deduction_amount_view" id="employee_additional_deduction_amount_view" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">

			<input type="hidden" name="employee_additional_deduction_amount" id="employee_additional_deduction_amount" value="<?php echo $data_deduction['employee_additional_deduction_amount']?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Total Potongan Tambahan
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
			<input type="text" autocomplete="off"  name="employee_additional_deduction_description" id="employee_additional_deduction_description" value="<?php echo $data_deduction['employee_additional_deduction_description']?>" class="form-control" onChange="function_elements_add_deduction(this.name, this.value);">
			<label class="control-label">Deskripsi tambahan potongan </label>
		</div>
	</div>
</div>
								
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_deduction();"><i class="fa fa-times"></i> Batal</button>
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
						<th>Tanggal Potongan Tambahan</th>
						<th>Nama Potongan</th>
						<th>Deskripsi Potongan Tambahan</th>
						<th>Total Tambhan Potongan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeeadditionaldeduction)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeeadditionaldeduction as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_additional_deduction_date'])."</td>
									<td>".$val['deduction_name']."</td>
									<td>".$val['employee_additional_deduction_description']."</td>
									<td>".nominal($val['employee_additional_deduction_amount'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeeadditionalckp/deletePayrollEmployeeAdditionalDeduction/'.$val['employee_id']."/".$val['employee_additional_deduction_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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