<script>
	base_url = '<?php echo base_url();?>';
	
	function reset_edit_language(){
		document.location = base_url+"RecruitmentApplicantData/reset_edit_language";
	}

	function function_elements_edit_language(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_edit_language');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	
</script>
<?php
	echo form_open('RecruitmentApplicantData/processAddRecruitmentApplicantLanguage', array('id' => 'myform', 'class' => 'horizontal-form'));


	echo $this->session->userdata('message_language');
	$this->session->unset_userdata('message_language');

	$unique 		= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_language  = $this->session->userdata('editrecruitmentapplicantlanguage-'.$unique['unique']);	

	if (empty($data_language['applicant_language_speak'])) {
		$data_language['applicant_language_speak']= "";
		# code...
	}
	if (empty($data_language['applicant_language_write'])) {
		$data_language['applicant_language_write']= "";
		# code...
	}
	if (empty($data_language['applicant_language_listen'])) {
		$data_language['applicant_language_listen']= "";
		# code...
	}
	if (empty($data_language['applicant_language_read'])) {
		$data_language['applicant_language_read']= "";
		# code...
	}
?>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('language_id', $corelanguage,set_value('language_id',$data_language['language_id']),'id="language_id" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label>Bahasa</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_listen', $listeningskill,set_value('applicant_language_listen',$data_language['applicant_language_listen']),'id="applicant_language_listen" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Mendengar</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_read', $readingskill,set_value('applicant_language_read',$data_language['applicant_language_read']),'id="applicant_language_read" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Membaca </label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_write', $writingskill,set_value('applicant_language_write',$data_language['applicant_language_write']),'id="applicant_language_write" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Menulis </label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_speak', $speakingskill,set_value('applicant_language_speak',$data_language['applicant_language_speak']),'id="applicant_language_speak" class="form-control select2me" onChange="function_elements_edit_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Berbicara</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantLanguage" value="Reset" class="btn red" title="Reset" onClick="reset_edit_language();">
		<input type="submit" name="Add2" id="buttonAddArrayRecruitmentApplicantLanguage" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>
<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $RecruitmentApplicantData['applicant_id']?>" class="form-control" onChange="function_elements_edit_language(this.name, this.value);">

<?php echo form_close(); ?>

<br>
<br>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="30%">Bahasa</th>
									<th style='text-align:center' width="15%">Kemampuan Mendengar</th>
									<th style='text-align:center' width="15%">Kemampuan Membaca</th>
									<th style='text-align:center' width="15%">Kemampuan Menulis</th>
									<th style='text-align:center' width="15%">Kemampuan Berbicara</th>
									<th style='text-align:center'>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantlanguage)){
									foreach($recruitmentapplicantlanguage as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>".$no."</td>
												<td>".$this->RecruitmentApplicantData_model->getLanguageName($val['language_id'])."</td>
												<td>".$listeningskill[$val['applicant_language_listen']]."</td>
												<td>".$readingskill[$val['applicant_language_read']]."</td>
												<td>".$writingskill[$val['applicant_language_write']]."</td>
												<td>".$speakingskill[$val['applicant_language_speak']]."</td>
												
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteArrayRecruitmentApplicantLanguage/'.$val['applicant_id'].'/'.$val['applicant_language_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Hapus
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='12' style='text-align:center;'>
												<b>Tidak Ada Data</b>
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

<br>
<br>

