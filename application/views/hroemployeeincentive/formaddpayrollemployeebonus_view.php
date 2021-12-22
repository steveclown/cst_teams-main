<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_bonus(){
		document.location = base_url+"hroemployeeincentive/reset_add_bonus/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_bonus(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeeincentive/function_elements_add_bonus');?>",
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
	echo form_open('hroemployeeincentive/processAddPayrollEmployeeBonus',array('id' => 'myform', 'class' => 'horizontal-form')); 
	$unique 	= $this->session->userdata('unique');
	
	$databonus	= $this->session->userdata('addpayrollemployeebonus-'.$unique['unique']);
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('month_period', $monthperiod, set_value('month_period', $databonus['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add_bonus(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('year_period', $year, set_value('year_period',$databonus['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add_bonus(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('bonus_id', $corebonus, $databonus['bonus_id'], 'id ="class_id", class="form-control select2me " onChange="function_elements_add_bonus(this.name, this.value);"');
			?>
			<label class="control-label">Bonus Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_bonus_amount" id="employee_bonus_amount" value="<?php echo $databonus['employee_bonus_amount']?>" class="form-control" onChange="function_elements_add_bonus(this.name, this.value);">
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
		<input type="text" name="employee_bonus_description" id="employee_bonus_description" value="<?php echo $databonus['employee_bonus_description']?>" class="form-control" onChange="function_elements_add_bonus(this.name, this.value);">
			<label class="control-label">Description
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_bonus();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
</div>

<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>
	


<table class="table table-bordered table-advance table-hover">
	<thead>
		<tr>
			<th>Bonus Period</th>
			<th>Bonus Name</th>
			<th>Bonus Description</th>
			<th>Bonus Amount</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
		if(!is_array($payrollemployeebonus)){
			echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
		} else {
			foreach ($payrollemployeebonus as $key=>$val){
				echo"
					<tr>
						<td>".$this->configuration->Month[substr(trim($val['employee_bonus_period']), 4, 2)]." ".substr(trim($val['employee_bonus_period']), 0, 4)."</td>
						<td>".$val['bonus_name']."</td>
						<td>".$val['employee_bonus_description']."</td>
						<td>".nominal($val['employee_bonus_amount'])."</td>
						<td>
							<a href='".$this->config->item('base_url').'hroemployeeincentive/deletePayrollEmployeeBonus/'.$val['employee_id']."/".$val['employee_bonus_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
							
