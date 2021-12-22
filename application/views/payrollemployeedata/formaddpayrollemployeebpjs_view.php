<script>
	function reset_add_bpjs(){
		document.location = base_url+"payrollemployeedata/reset_add_bpjs";
	}

	function function_elements_add_bpjs(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('payrollemployeedata/function_elements_add_bpjs');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>

					

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	// print_r($data);exit;
?>		

<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now-1; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>	


<?php 
	echo form_open('payrollemployeedata/processAddPayrollOnOutBPJS',array('id' => 'myform', 'class' => 'horizontal-form'));

	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollemployeebpjs-'.$unique['unique']);
?>		
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="bpjs_in_date" id="bpjs_in_date" onChange="function_elements_add_bpjs(this.name, this.value);" value="<?php echo tgltoview($data['bpjs_in_date']);?>">
			<label class="control-label">BPJS In Date
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
			<input type="text" name="bpjs_reported_salary" id="bpjs_reported_salary" value="<?php echo $data['bpjs_reported_salary'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Reported Salary
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_total_amount" id="bpjs_total_amount" value="<?php echo $data['bpjs_total_amount'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Total Amount
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
			<?php echo form_dropdown('bpjs_kesehatan_status', $bpjsstatus ,set_value('bpjs_kesehatan_status',$data['bpjs_kesehatan_status']),'id="bpjs_kesehatan_status", class="form-control select2me" onChange="function_elements_add_bpjs(this.name, this.value);"');?>
			<label class="control-label">BPJS Kesehatan Status
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_kesehatan_no" id="bpjs_kesehatan_no" value="<?php echo $data['bpjs_kesehatan_no'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Kesehatan No</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_kesehatan_percentage" id="bpjs_kesehatan_percentage" value="<?php echo $data['bpjs_kesehatan_percentage'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Kesehatan Percentage</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_kesehatan_amount" id="bpjs_kesehatan_amount" value="<?php echo $data['bpjs_kesehatan_amount'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);" >
			<label class="control-label">BPJS Kesehatan Amount</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('bpjs_tenagakerja_status', $bpjsstatus ,set_value('bpjs_tenagakerja_status',$data['bpjs_tenagakerja_status']),'id="bpjs_tenagakerja_status", class="form-control select2me" onChange="function_elements_add_bpjs(this.name, this.value);"');?>
			<label class="control-label">BPJS Tenaga Kerja Status
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerja_no" id="bpjs_tenagakerja_no" value="<?php echo $data['bpjs_tenagakerja_no'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Tenaga Kerja No</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerjan_percentage" id="bpjs_tenagakerja_percentage" value="<?php echo $data['bpjs_tenagakerja_percentage'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Tenaga Kerja Percentage</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerja_amount" id="bpjs_tenagakerja_amount" value="<?php echo $data['bpjs_tenagakerja_amount'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);" >
			<label class="control-label">BPJS Tenaga Kerja Amount</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('bpjs_out_status', $bpjsstatus ,set_value('bpjs_out_status',$data['bpjs_out_status']),'id="bpjs_out_status", class="form-control select2me" onChange="function_elements_add_bpjs(this.name, this.value);"');?>
			<label class="control-label">BPJS Status
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="bpjs_out_date" id="bpjs_out_date" onChange="function_elements_add_bpjs(this.name, this.value);" value="<?php echo tgltoview($data['bpjs_out_date']);?>">
			<label class="control-label">BPJS Out Date
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
			<textarea rows="3" name="bpjs_remark" id="bpjs_remark" class="form-control"><?php echo $data['bpjs_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>
				
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_bpjs();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id'] ?>">
<?php echo form_close(); ?>
			
<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>In Date</th>
						<th>Reported Salary</th>
						<th>BPJS Total</th>
						<th>BPJS Kesehatan Status</th>
						<th>BPJS Kesehatan Amount</th>
						<th>BPJS Tenaga Kerja Status</th>
						<th>BPJS Tenaga Kerja Amount</th>
						<th>Status</th>
						<th>Out Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeebpjs)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeebpjs as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['bpjs_in_date'])."</td>
									<td>".nominal($val['bpjs_reported_salary'])."</td>
									<td>".nominal($val['bpjs_total_amount'])."</td>
									<td>".$this->configuration->BPJSStatus[$val['bpjs_kesehatan_status']]."</td>
									<td>".nominal($val['bpjs_kesehatan_amount'])."</td>
									<td>".$this->configuration->BPJSStatus[$val['bpjs_tenagakerja_status']]."</td>
									<td>".nominal($val['bpjs_tenagakerja_amount'])."</td>
									<td>".$this->configuration->BPJSStatus[$val['bpjs_out_status']]."</td>
									<td>".tgltoview($val['bpjs_out_date'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'payrollemployeedata/deletePayrollEmployeeBPJS/'.$val['employee_id']."/".$val['employee_bpjs_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>
									</td>";
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