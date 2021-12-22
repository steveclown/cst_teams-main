<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_lostitem(){
		document.location = base_url+"hroemployeeincentive/reset_add_lostitem/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_lostitem(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeincentive/function_elements_add_lostitem');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
		
					
<?php 
	echo form_open('hroemployeeincentive/processAddPayrollEmployeeLostItem',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$unique 			= $this->session->userdata('unique');
	
	$datalostitem	= $this->session->userdata('addpayrollemployeelostitem-'.$unique['unique']);
?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('month_period', $monthperiod, set_value('month_period', $datalostitem['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add_lostitem(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('year_period', $year, set_value('year_period',$datalostitem['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add_lostitem(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('lost_item_id', $corelostitem, $datalostitem['lost_item_id'], 'id ="class_id", class="form-control select2me " onChange="function_elements_add_lostitem(this.name, this.value);"');
			?>
			<label class="control-label">Lost Item Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_lost_item_amount" id="employee_lost_item_amount" value="<?php echo $datalostitem['employee_lost_item_amount']?>" class="form-control" onChange="function_elements_add_lostitem(this.name, this.value);">
			<label class="control-label">Amount
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
		<input type="text" name="employee_lost_item_description" id="employee_lost_item_description" value="<?php echo $datalostitem['employee_lost_item_description']?>" class="form-control" onChange="function_elements_add_lostitem(this.name, this.value);">
			<label class="control-label">Description
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_lostitem();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>

<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>
				

<table class="table table-bordered table-advance table-hover">
	<thead>
		<tr>
			<th>Lost Item Period</th>
			<th>Lost Item Name</th>
			<th>Lost Item Description</th>
			<th>Lost Item Amount</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(!is_array($payrollemployeelostitem)){
			echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
		} else {
			foreach ($payrollemployeelostitem as $key => $val){
				echo"
					<tr>
						<td>".$this->configuration->Month[substr(trim($val['employee_lost_item_period']), 4, 2)]." ".substr(trim($val['employee_lost_item_period']), 0, 4)."</td>
						<td>".$val['lost_item_name']."</td>
						<td>".$val['employee_lost_item_description']."</td>
						<td>".nominal($val['employee_lost_item_amount'])."</td>
						<td>
							<a href='".$this->config->item('base_url').'hroemployeeincentive/deletePayrollEmployeeLostItem/'.$val['employee_id']."/".$val['employee_lost_item_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
								<i class='fa fa-trash-o'></i> Delete
							</a>";
						echo"
					</tr>
					
				";
			}
		}
	?>	
	</tbody>
</table>
							
