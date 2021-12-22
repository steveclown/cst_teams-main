hroemployeedatackp<style>

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

	function reset_edit_language(){
		document.location = base_url+"hroemployeedatailufa/reset_edit_language";
	}

	function function_elements_edit_language(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedatailufa/function_elements_edit_language');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

</script>

					

<?php
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('edithroemployeelanguage-'.$unique['unique']);

?>			
								
<?php 
	echo $this->session->userdata('message_language');
	$this->session->unset_userdata('message_language');
?>	

<?php 
	echo form_open('hroemployeedatailufa/processAddHROEmployeeLanguage',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>
									
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('language_id', $corelanguage,set_value('language_id',$data['language_id']),'id="language_id" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label>Language</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_listen', $listeningskill,set_value('employee_language_listen',$data['employee_language_listen']),'id="employee_language_listen" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Listening Skill</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_read', $readingskill,set_value('employee_language_read',$data['employee_language_read']),'id="employee_language_read" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Reading Skill</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_write', $writingskill,set_value('employee_language_write',$data['employee_language_write']),'id="employee_language_write" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Writing Skill</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_speak', $speakingskill,set_value('employee_language_speak',$data['employee_language_speak']),'id="employee_language_speak" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Speaking Skill</label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_language_remark" id="employee_language_remark" class="form-control" onChange="function_elements_edit_language(this.name, this.value);"><?php echo $data['employee_language_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>
								

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeLanguage" value="Reset" class="btn red" title="Reset" onClick="reset_edit_education();">
		<input type="submit" name="Add2" id="buttonAddArrayHROEmployeeLanguage" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>

<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $hroemployeedatailufa['employee_id']?>" class="form-control" onChange="function_elements_edit_language(this.name, this.value);">

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
						<th style='text-align:center' width="30%">Language</th>
						<th style='text-align:center' width="15%">Listening Skill</th>
						<th style='text-align:center' width="15%">Reading Skill</th>
						<th style='text-align:center' width="15%">Writing Skill</th>
						<th style='text-align:center' width="15%">Speaking Skill</th>
						<th style='text-align:center'>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;

					if(!empty($hroemployeelanguage)){
						foreach($hroemployeelanguage as $key => $val){
							echo"
								<tr class='odd gradeX'>
									<td style='text-align:center'>$no.</td>
									<td>".$val['language_name']."</td>
									<td>".$this->configuration->ListeningSkill[$val['employee_language_listen']]."</td>
									<td>".$this->configuration->ReadingSkill[$val['employee_language_read']]."</td>
									<td>".$this->configuration->WritingSkill[$val['employee_language_write']]."</td>
									<td>".$this->configuration->SpeakingSkill[$val['employee_language_speak']]."</td>
									<td style='text-align  : center !important;'>
										<a href='".$this->config->item('base_url').'hroemployeedatailufa/deleteHROEmployeeLanguage/'.$hroemployeedatailufa['employee_id'].'/'.$val['employee_language_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
								<td colspan='12' style='text-align:center;'>
									<b>No Data</b>
								</td>
							</tr>
						";
					}
				?>		
				<tbody>
			</table>
		</div>
	</div>
</div>