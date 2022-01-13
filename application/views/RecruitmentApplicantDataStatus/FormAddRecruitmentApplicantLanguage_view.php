<script>
	base_url = '<?php echo base_url();?>';
	mappia = "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";
	
	function reset_add_language(){
		document.location = base_url+"RecruitmentApplicantData/reset_add_language";
	}

	function function_elements_add_language(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_language');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	
	
	function processAddArrayRecruitmentApplicantLanguage(){
		var language_id 					= document.getElementById("language_id").value;
		var applicant_language_listen	 	= document.getElementById("applicant_language_listen").value;
		var applicant_language_read 		= document.getElementById("applicant_language_read").value;
		var applicant_language_write		= document.getElementById("applicant_language_write").value;
		var applicant_language_speak		= document.getElementById("applicant_language_speak").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentApplicantData/processAddArrayRecruitmentApplicantLanguage');?>",
			  data: {
						'language_id' 						: language_id, 
						'applicant_language_listen' 		: applicant_language_listen, 
						'applicant_language_read' 			: applicant_language_read, 
						'applicant_language_write'			: applicant_language_write,
						'applicant_language_speak' 			: applicant_language_speak, 
						'session_name' 						: "addarraylanguage-"
					},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
	
	
</script>
<?php
	$unique 		= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_language = $this->session->userdata('addrecruitmentapplicantlanguage-'.$unique['unique']);	
?>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('language_id', $corelanguage,set_value('language_id',$data_language['language_id']),'id="language_id" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label>Bahasa</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_listen', $listeningskill,set_value('applicant_language_listen',$data_language['applicant_language_listen']),'id="applicant_language_listen" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Mendengar</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_read', $readingskill,set_value('applicant_language_read',$data_language['applicant_language_read']),'id="applicant_language_read" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Membaca</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_write', $writingskill,set_value('applicant_language_write',$data_language['applicant_language_write']),'id="applicant_language_write" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Menulis</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_speak', $speakingskill,set_value('applicant_language_speak',$data_language['applicant_language_speak']),'id="applicant_language_speak" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Berbicara</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantLanguage" value="Reset" class="btn red" title="Reset" onClick="reset_add_language();">
		<input type="button" name="Add2" id="buttonAddArrayRecruitmentApplicantLanguage" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayRecruitmentApplicantLanguage();">
	</div>
</div>


<br>
<br>
<?php 
	$unique							= $this->session->userdata('unique');
	$recruitmentapplicantlanguage	= $this->session->userdata('addarrayrecruitmentapplicantlanguage-'.$unique['unique']);
?>


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
									<th style='text-align:center'>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantlanguage)){
									foreach($recruitmentapplicantlanguage as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->RecruitmentApplicantData_model->getLanguageName($val['language_id'])."</td>
												<td>".$listeningskill[$val['applicant_language_listen']]."</td>
												<td>".$readingskill[$val['applicant_language_read']]."</td>
												<td>".$writingskill[$val['applicant_language_write']]."</td>
												<td>".$speakingskill[$val['applicant_language_speak']]."</td>
												
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteArrayRecruitmentApplicantLanguage/'.$val['applicant_language_record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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

