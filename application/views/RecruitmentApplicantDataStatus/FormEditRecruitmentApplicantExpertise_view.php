

<script>
	base_url 	= '<?php echo base_url();?>';


	function reset_edit_expertise(){
		document.location = base_url+"RecruitmentApplicantData/reset_edit_expertise";
	}

	function function_elements_edit_expertise(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_edit_expertise');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

</script>

					

<?php
	echo form_open('RecruitmentApplicantData/processAddRecruitmentApplicantExpertise', array('id' => 'myform', 'class' => 'horizontal-form'));

	$unique 				= $this->session->userdata('unique');
	$data_expertise			= $this->session->userdata('editrecruitmentapplicantexpertise-'.$unique['unique']);

	$year_now 	=	date('Y');
	if(!is_array($data_expertise)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 

	echo $this->session->userdata('message_expertise');
	$this->session->unset_userdata('message_expertise');

	if (empty($data_expertise['expertise_id'])) {
		$data_expertise['expertise_id']="";
		# code...
	}
	if (empty($data_expertise['applicant_expertise_name'])) {
		$data_expertise['applicant_expertise_name']="";
		# code...
	}
	if (empty($data_expertise['applicant_expertise_city'])) {
		$data_expertise['applicant_expertise_city']="";
		# code...
	}
	if (empty($data_expertise['expertise_month_from'])) {
		$data_expertise['expertise_month_from']="";
		# code...
	}
	if (empty($data_expertise['expertise_year_from'])) {
		$data_expertise['expertise_year_from']="";
		# code...
	}
	if (empty($data_expertise['expertise_month_to'])) {
		$data_expertise['expertise_month_to']="";
		# code...
	}
	if (empty($data_expertise['expertise_year_to'])) {
		$data_expertise['expertise_year_to']="";
		# code...
	}
	if (empty($data_expertise['applicant_expertise_duration'])) {
		$data_expertise['applicant_expertise_duration']="";
		# code...
	}
	if (empty($data_expertise['applicant_expertise_passed'])) {
		$data_expertise['applicant_expertise_passed']="";
		# code...
	}
	if (empty($data_expertise['applicant_expertise_certificate'])) {
		$data_expertise['applicant_expertise_certificate']="";
		# code...
	}
	if (empty($data_expertise['applicant_expertise_remark'])) {
		$data_expertise['applicant_expertise_remark']="";
		# code...
	}
?>	
									
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('expertise_id', $coreexpertise ,set_value('expertise_id',$data_expertise['expertise_id']),'id="expertise_id", class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');?>

			<label class="control-label">Nama Keahlian
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
			<input type="text" name="applicant_expertise_name" id="applicant_expertise_name" value="<?php echo $data_expertise['applicant_expertise_name']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">
			<label class="control-label">Nama Keahlian Name</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_expertise_city" id="applicant_expertise_city" value="<?php echo $data_expertise['applicant_expertise_city']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_month_from', $monthlist,set_value('expertise_month_from',$data_expertise['expertise_month_from']),'id="expertise_month_from" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label>Dari Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_year_from', $year,set_value('expertise_year_from',$data_expertise['expertise_year_from']),'id="expertise_year_from" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_month_to', $monthlist,set_value('expertise_month_to',$data_expertise['expertise_month_to']),'id="expertise_month_to" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label>Sampai Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_year_to', $year,set_value('expertise_year_to',$data_expertise['expertise_year_to']),'id="expertise_year_to" class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_expertise_duration" id="applicant_expertise_duration" value="<?php echo $data_expertise['applicant_expertise_duration']?>" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);">
			<label class="control-label">Durasi</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('applicant_expertise_passed', $status ,set_value('applicant_expertise_passed',$data_expertise['applicant_expertise_passed']),'id="applicant_expertise_passed", class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');?>
			<label class="control-label">Lulus</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('applicant_expertise_certificate', $status ,set_value('applicant_expertise_certificate',$data_expertise['applicant_expertise_certificate']),'id="applicant_expertise_certificate", class="form-control select2me" onChange="function_elements_edit_expertise(this.name, this.value);"');?>
			<label class="control-label">Sertifikat</label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_expertise_remark" id="applicant_expertise_remark" class="form-control" onChange="function_elements_edit_expertise(this.name, this.value);"><?php echo $data_expertise['applicant_expertise_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantExpertise" value="Reset" class="btn red" title="Reset" onClick="reset_edit_expertise();">
		<input type="submit" name="Add2" id="buttonAddArrayRecruitmentApplicantExpertise" value="Add" class="btn green-jungle" title="Simpan Data">
	</div>
</div>

<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $RecruitmentApplicantData['applicant_id']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">

<?php echo form_close(); ?>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th style='text-align:center' width="10%">Keahlian</th>
						<th style='text-align:center' width="10%">Nama</th>
						<th style='text-align:center' width="10%">Kota</th>
						<th style='text-align:center' width="10%">Dari tahun </th>
						<th style='text-align:center' width="10%">Sampai tahun </th>
						<th style='text-align:center' width="10%">Durasi</th>
						<th style='text-align:center' width="10%">Lulus</th>
						<th style='text-align:center' width="10%">Sertifikat</th>
						<th style='text-align:center'>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php

				if (!empty($recruitmentapplicantexpertise)) {					
					if(!is_array($recruitmentapplicantexpertise)){
						echo "<tr><th colspan='9' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($recruitmentapplicantexpertise as $key=>$val){
							echo"
								<tr>
									<td>".$this->RecruitmentApplicantData_model->getExpertiseName($val['expertise_id'])."</td>
									<td>".$val['applicant_expertise_name']."</td>
									<td>".$val['applicant_expertise_city']."</td>
									<td>".$val['applicant_expertise_from_period']."</td>
									<td>".$val['applicant_expertise_to_period']."</td>
									<td>".$val['applicant_expertise_duration']."</td>
									<td>".$status[$val['applicant_expertise_passed']]."</td>
									<td>".$status[$val['applicant_expertise_certificate']]."</td>
									<td>
									<a href='".$this->config->item('base_url').'RecruitmentApplicantData/deleteRecruitmentApplicantExpertise/'.$val['applicant_id'].'/'.$val['applicant_expertise_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Delete
										</a>";
									echo"
								</tr>
								
							";
						}
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
				</tbody>
			</table>
		</div>
	</div>
</div>