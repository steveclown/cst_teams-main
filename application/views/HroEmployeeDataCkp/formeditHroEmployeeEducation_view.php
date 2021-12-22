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


<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_edit_education(){
		document.location = base_url+"HroEmployeeDataCkp/reset_edit_education/<?php echo $HroEmployeeDataCkp['employee_id']?>";
	}

	function function_elements_edit_education(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeDataCkp/function_elements_edit_education');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

</script>		

<?php
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('edithroemployeeeducation-'.$unique['unique']);

?>			
		
<?php 
	$year_now 	=	date('Y');
	if(!is_array($data)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>	

<?php 
	echo $this->session->userdata('message_education');
	$this->session->unset_userdata('message_education');
?>				
		
<?php 
	echo form_open('HroEmployeeDataCkp/processAddHROEmployeeEducation',array('id' => 'myform', 'class' => 'horizontal-form'));

	if (empty($data['education_month_from'])) {
		$data['education_month_from']="";
	 } 
	if (empty($data['education_year_from'])) {
		$data['education_year_from']="";
	 } 

	if (empty($data['education_month_to'])) {
		$data['education_month_to']="";
	 } 

	if (empty($data['education_year_to'])) {
		$data['education_year_to']="";
	 } 

	if (empty($data['employee_education_remark'])) {
		$data['employee_education_remark']="";
	 } 

	if (empty($data['employee_education_passed'])) {
		$data['employee_education_passed']="";
	 } 

	if (empty($data['education_id'])) {
		$data['education_id']="";
	 } 

	if (empty($data['employee_education_type'])) {
		$data['employee_education_type']="";
	 } 

	if (empty($data['employee_education_name'])) {
		$data['employee_education_name']="";
	 }
	if (empty($data['employee_education_city'])) {
		$data['employee_education_city']="";
	 }
	if (empty($data['employee_education_certificate'])) {
		$data['employee_education_certificate']="";
	 }   
	if (empty($data['employee_education_duration'])) {
		$data['employee_education_duration']="";
	 } 


?>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('education_id', $coreeducation ,set_value('education_id',$data['education_id']),'id="education_id", class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>

			<label class="control-label">Education Name
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('employee_education_type', $educationtype ,set_value('employee_education_type',$data['employee_education_type']),'id="employee_education_type", class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>

			<label class="control-label">Education Type
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
			<input type="text" name="employee_education_name" id="employee_education_name" value="<?php echo $data['employee_education_name']?>" class="form-control" onChange="function_elements_edit_education(this.name, this.value);">
			<label class="control-label">Education Name</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_education_city" id="employee_education_city" value="<?php echo $data['employee_education_city']?>" class="form-control" onChange="function_elements_edit_education(this.name, this.value);">
			<label class="control-label">City</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_from', $monthlist,set_value('education_month_from',$data['education_month_from']),'id="education_month_from" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_from', $year,set_value('education_year_from',$data['education_year_from']),'id="education_year_from" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_to', $monthlist,set_value('education_month_to',$data['education_month_to']),'id="education_month_to" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>To Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_to', $year,set_value('education_year_to',$data['education_year_to']),'id="education_year_to" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_education_duration" id="employee_education_duration" value="<?php echo $data['employee_education_duration']?>" class="form-control" onChange="function_elements_edit_education(this.name, this.value);">
			<label class="control-label">Duration</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_education_passed', $status ,set_value('employee_education_passed',$data['employee_education_passed']),'id="employee_education_passed", class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');?>
			<label class="control-label">Passed</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_education_certificate', $status ,set_value('employee_education_certificate',$data['employee_education_certificate']),'id="employee_education_certificate", class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');?>
			<label class="control-label">Certificate</label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_education_remark" id="employee_education_remark" class="form-control" onChange="function_elements_edit_education(this.name, this.value);"><?php echo $data['employee_education_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>
							
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeEducation" value="Reset" class="btn red" title="Reset" onClick="reset_edit_education();">
		<input type="submit" name="Add2" id="buttonAddArrayHROEmployeeEducation" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>

<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $HroEmployeeDataCkp['employee_id']?>" class="form-control" onChange="function_elements_edit_education(this.name, this.value);">

<?php echo form_close(); ?>
<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th style='text-align:center' width="10%">Education</th>
						<th style='text-align:center' width="10%">Type</th>
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
					if(!is_array($hroemployeeeducation)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeeducation as $key=>$val){
							echo"
								<tr>
									<td>".$val['education_name']."</td>
									<td>".$educationtype[$val['employee_education_type']]."</td>
									<td>".$val['employee_education_name']."</td>
									<td>".$val['employee_education_city']."</td>
									<td>".$val['employee_education_from_period']."</td>
									<td>".$val['employee_education_to_period']."</td>
									<td>".$val['employee_education_duration']."</td>
									<td>".$status[$val['employee_education_passed']]."</td>
									<td>".$status[$val['employee_education_certificate']]."</td>
									<td>
									<a href='".$this->config->item('base_url').'HroEmployeeDataCkp/deleteHROEmployeeEducation/'.$HroEmployeeDataCkp['employee_id'].'/'.$val['employee_education_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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