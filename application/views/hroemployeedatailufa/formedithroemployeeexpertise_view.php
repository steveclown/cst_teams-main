<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_edit_expertise(){
		document.location = base_url+"hroemployeedatailufa/reset_edit_expertise/<?php echo $hroemployeedatailufa['employee_id']?>";
	}

	function function_elements_edit_expertise(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedatailufa/function_elements_edit_expertise');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

</script>

					

<?php
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('edithroemployeeexpertise-'.$unique['unique']);

?>			
								
<?php 
	echo $this->session->userdata('message_expertise');
	$this->session->unset_userdata('message_expertise');
?>	

<?php 
	echo form_open('hroemployeedatailufa/processAddHROEmployeeExpertise',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>
									
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('expertise_id', $coreexpertise ,set_value('expertise_id',$data['expertise_id']),'id="expertise_id", class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>

			<label class="control-label">Expertise Name
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
			<input type="text" autocomplete="off"  name="employee_expertise_name" id="employee_expertise_name" value="<?php echo $data['employee_expertise_name']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">
			<label class="control-label">Expertise Name</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_expertise_city" id="employee_expertise_city" value="<?php echo $data['employee_expertise_city']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">
			<label class="control-label">City</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_month_from', $monthlist,set_value('expertise_month_from',$data['expertise_month_from']),'id="expertise_month_from" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_year_from', $year,set_value('expertise_year_from',$data['expertise_year_from']),'id="expertise_year_from" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_month_to', $monthlist,set_value('expertise_month_to',$data['expertise_month_to']),'id="expertise_month_to" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label>To Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_year_to', $year,set_value('expertise_year_to',$data['expertise_year_to']),'id="expertise_year_to" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_expertise_duration" id="employee_expertise_duration" value="<?php echo $data['employee_expertise_duration']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">
			<label class="control-label">Duration</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_expertise_passed', $status ,set_value('employee_expertise_passed',$data['employee_expertise_passed']),'id="employee_expertise_passed", class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label class="control-label">Passed</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_expertise_certificate', $status ,set_value('employee_expertise_certificate',$data['employee_expertise_certificate']),'id="employee_expertise_certificate", class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label class="control-label">Certificate</label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_expertise_remark" id="employee_expertise_remark" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);"><?php echo $data['employee_expertise_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeExpertise" value="Reset" class="btn red" title="Reset" onClick="reset_edit_education();">
		<input type="submit" name="Add2" id="buttonAddArrayHROEmployeeExpertise" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>

<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $hroemployeedatailufa['employee_id']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">

<?php echo form_close(); ?>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th style='text-align:center' width="10%">Expertise</th>
						<th style='text-align:center' width="10%">Name</th>
						<th style='text-align:center' width="10%">City</th>
						<th style='text-align:center' width="10%">From Period</th>
						<th style='text-align:center' width="10%">To Period</th>
						<th style='text-align:center' width="10%">Duration</th>
						<th style='text-align:center' width="10%">Passed</th>
						<th style='text-align:center' width="10%">Certificate</th>
						<th style='text-align:center'>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeexpertise)){
						echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeexpertise as $key=>$val){
							echo"
								<tr>
									<td>".$val['expertise_name']."</td>
									<td>".$val['employee_expertise_name']."</td>
									<td>".$val['employee_expertise_city']."</td>
									<td>".$val['employee_expertise_from_period']."</td>
									<td>".$val['employee_expertise_to_period']."</td>
									<td>".$val['employee_expertise_duration']."</td>
									<td>".$this->configuration->Status[$val['employee_expertise_passed']]."</td>
									<td>".$this->configuration->Status[$val['employee_expertise_certificate']]."</td>
									<td>
									<a href='".$this->config->item('base_url').'hroemployeedatailufa/deleteHROEmployeeExpertise/'.$hroemployeedatailufa['employee_id'].'/'.$val['employee_expertise_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
		</div>
	</div>
</div>