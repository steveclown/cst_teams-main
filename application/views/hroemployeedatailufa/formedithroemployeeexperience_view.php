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

	function reset_edit_experience(){
		document.location = base_url+"hroemployeedatailufa/reset_edit_experience";
	}

	function function_elements_edit_experience(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedatailufa/function_elements_edit_experience');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

</script>

					

<?php
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('edithroemployeeexperience-'.$unique['unique']);

?>			
								
<?php 
	echo $this->session->userdata('message_experience');
	$this->session->unset_userdata('message_experience');
?>	
								
<?php 
	echo form_open('hroemployeedatailufa/processAddHROEmployeeExperience',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>

<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_month_from', $monthlist,set_value('experience_month_from',$data['experience_month_from']),'id="experience_month_from" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_year_from', $year,set_value('experience_year_from',$data['experience_year_from']),'id="experience_year_from" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_month_to', $monthlist,set_value('experience_month_to',$data['experience_month_to']),'id="experience_month_to" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label>To Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_year_to', $year,set_value('experience_year_to',$data['experience_year_to']),'id="experience_year_to" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_company_name" name="experience_company_name" onChange="function_elements_edit_experience(this.name, this.value);" value="<?php echo $data['experience_company_name'];?>">
			<label>Company Name</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_company_editress" id="experience_company_editress" onChange="function_elements_edit_experience(this.name, this.value);"class="form-control" ><?php echo $data['experience_company_editress'];?></textarea>
			<label class="control-label">Company Address</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_job_title" name="experience_job_title" onChange="function_elements_edit_experience(this.name, this.value);" value="<?php echo $data['experience_job_title'];?>" >
			<label>Job Title</label>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_last_salary" name="experience_last_salary" onChange="function_elements_edit_experience(this.name, this.value);" value="<?php echo $data['experience_last_salary'];?>">
			<label>Last Salary</label>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_separation_reason" id="experience_separation_reason" class="form-control" onChange="function_elements_edit_experience(this.name, this.value);"><?php echo $data['experience_separation_reason'];?></textarea>
			<label class="control-label">Separation Reason</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_separation_letter', $separationletter,set_value('experience_separation_letter',$data['experience_separation_letter']),'id="experience_separation_letter" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label>Separation Letter</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_remark" id="experience_remark" class="form-control" onChange="function_elements_edit_experience(this.name, this.value);"><?php echo $data['experience_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeExperience" value="Reset" class="btn red" title="Reset" onClick="reset_edit_education();">
		<input type="submit" name="Add2" id="buttonAddArrayHROEmployeeExperience" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>

<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $hroemployeedatailufa['employee_id']?>" class="form-control" onChange="function_elements_edit_experience(this.name, this.value);">

<?php echo form_close(); ?>

<BR>
<BR>					

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th style='text-align:center' width="5%">No.</th>
						<th style='text-align:center' width="10%">Name</th>
						<th style='text-align:center' width="10%">Address</th>
						<th style='text-align:center' width="10%">Job Title</th>
						<th style='text-align:center' width="10%">From Period</th>
						<th style='text-align:center' width="10%">To Period</th>
						<th style='text-align:center' width="10%">Last Salary</th>
						<th style='text-align:center' width="10%">Separation Reason</th>
						<th style='text-align:center' width="10%">Separation Letter</th>
						<th style='text-align:center' width="10%">Remark</th>
						<th style='text-align:center'>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					if(!empty($hroemployeeexperience)){
						foreach($hroemployeeexperience as $key => $val){
							echo"
								<tr class='odd gradeX'>
									<td style='text-align:center'>$no.</td>
									<td>".$val['experience_company_name']."</td>
									<td>".$val['experience_company_editress']."</td>
									<td>".$val['experience_job_title']."</td>
									<td>".$val['experience_from_period']."</td>
									<td>".$val['experience_to_period']."</td>
									<td>".$val['experience_last_salary']."</td>
									<td>".$val['experience_separation_reason']."</td>
									<td>".$this->configuration->SeparationLetter[$val['experience_separation_letter']]."</td>
									<td>".$val['experience_experience_remark']."</td>
									<td style='text-align  : center !important;'>
										<a href='".$this->config->item('base_url').'hroemployeedatailufa/deleteHROEmployeeExperience/'.$hroemployeedatailufa['employee_id'].'/'.$val['employee_experience_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>";
									echo "
									</td>
								</tr>
							";
							$no++;
						}
					}else{
						echo"
							<tr class='odd gradeX'>
								<td colspan='11' style='text-align:center;'>
									<b>No Data</b>
								</td>
							</tr>
						";
					}
				?>
			</table>
		</div>
	</div>
</div>