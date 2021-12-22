<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add_overtime(){
		document.location = base_url+"payrollemployeeadditionalckp/reset_add_overtime/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add_overtime(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeeadditionalckp/function_elements_add_overtime');?>",
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
        $("#employee_additional_overtime_amount_view").change(function(){
            var amount 		= $("#employee_additional_overtime_amount_view").val();
         	
         	var amount_view 	= toRp(amount);
			document.getElementById('employee_additional_overtime_amount').value		= amount;
			document.getElementById('employee_additional_overtime_amount_view').value 	= amount_view;
		
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
	echo form_open('payrollemployeeadditionalckp/processAddPayrollEmployeeAdditionalOvertime',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	$data_overtime	= $this->session->userdata('addpayrollemployeeadditionalovertime-'.$unique['unique']);

	if (empty($data_overtime['employee_additional_overtime_date'])){
		$data_overtime['employee_additional_overtime_date'] = date('Y-m-d');
	}
	if (empty($data_overtime['overtime_type_id'])) {
		$data_overtime['overtime_type_id']=9;
	}
	if (empty($data_overtime['employee_additional_overtime_amount'])) {
		$data_overtime['employee_additional_overtime_amount']="";
	}
	if (empty($data_overtime['employee_additional_overtime_description'])) {
		$data_overtime['employee_additional_overtime_description']="";
	}

	echo $this->session->userdata('message_overtime');
	$this->session->unset_userdata('message_overtime');
?>
<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
           <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_additional_overtime_date" id="employee_additional_overtime_date" value="<?php echo tgltoview($data_overtime['employee_additional_overtime_date']); ?>">
			<label for="form_control">Tanggal Lembur Tambahan</label>
		</div>	
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('overtime_type_id', $coreovertimetype ,set_value('overtime_type_id', $data_overtime['overtime_type_id']),'id="overtime_type_id", class="form-control select2me" onChange="function_elements_add_overtime(this.name, this.value);"');?>
			<label class="control-label">Nama Lembur
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
			<input type="text" name="employee_additional_overtime_amount_view" id="employee_additional_overtime_amount_view" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">

			<input type="hidden" name="employee_additional_overtime_amount" id="employee_additional_overtime_amount" value="<?php echo $data_overtime['employee_additional_overtime_amount']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">
			<label class="control-label">Total Lembur Tambahan
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
			<input type="text" name="employee_additional_overtime_description" id="employee_additional_overtime_description" value="<?php echo $data_overtime['employee_additional_overtime_description']?>" class="form-control" onChange="function_elements_add_overtime(this.name, this.value);">
			<label class="control-label">Deskripsi Tambahan Lembur</label>
		</div>
	</div>
</div>
								
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_overtime();"><i class="fa fa-times"></i> Batal</button>
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
						<th>Tanggal Tambahan Lembur</th>
						<th>Nama Lembur</th>
						<th>Deskripsi Tambahan Lembur</th>
						<th>Total Tambahan Lembur</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeeadditionalovertime)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeeadditionalovertime as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['employee_additional_overtime_date'])."</td>
									<td>".$val['overtime_type_name']."</td>
									<td>".$val['employee_additional_overtime_description']."</td>
									<td>".nominal($val['employee_additional_overtime_amount'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeeadditionalckp/deletePayrollEmployeeAdditionalOvertime/'.$val['employee_id']."/".$val['employee_additional_overtime_type_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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