<script>
	// mappia = "<?php echo site_url('transactionalapplicantdata/add'); ?>";
	base_url = '<?php echo base_url();?>';
	mappia = "<?php echo site_url('recruitmentapplicantdata/addRecruitmentApplicantData'); ?>";
	function deletesessionarrays(value,session_name){
//			alert(array_name);
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('transactionalapplicantdata/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
			}
		});
	}
	
	function formaddarrayeducation(){
		var education_id 						= document.getElementById("education_id").value;
		var applicant_education_type	 		= document.getElementById("applicant_education_type").value;
		var applicant_education_name 			= document.getElementById("applicant_education_name").value;
		var applicant_education_city			= document.getElementById("applicant_education_city").value;
		var applicant_education_from_period		= document.getElementById("applicant_education_from_period").value;
		var applicant_education_to_period		= document.getElementById("applicant_education_to_period").value;
		var applicant_education_duration		= document.getElementById("applicant_education_duration").value;
		var applicant_education_passed			= document.getElementById("applicant_education_passed").value;
		var applicant_education_certificate		= document.getElementById("applicant_education_certificate").value;
		var applicant_education_remark			= document.getElementById("applicant_education_remark").value;
		
		/* alert(education_id); */
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarrayeducation');?>",
			  data: {
						'education_id' 						: education_id, 
						'applicant_education_type' 			: applicant_education_type, 
						'applicant_education_name' 			: applicant_education_name, 
						'applicant_education_city'			: applicant_education_city,
						'applicant_education_from_period' 	: applicant_education_from_period, 
						'applicant_education_to_period' 	: applicant_education_to_period, 
						'applicant_education_duration' 		: applicant_education_duration,
						'applicant_education_passed' 		: applicant_education_passed, 
						'applicant_education_certificate' 	: applicant_education_certificate, 
						'applicant_education_remark' 		: applicant_education_remark, 
						'session_name' 						: "addarrayeducation-"
					},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
			});
	}
	
	
	function formaddarraylanguage(){
		var language_id 					= document.getElementById("language_id").value;
		var applicant_language_listen	 	= document.getElementById("applicant_language_listen").value;
		var applicant_language_read 		= document.getElementById("applicant_language_read").value;
		var applicant_language_write		= document.getElementById("applicant_language_write").value;
		var applicant_language_speak		= document.getElementById("applicant_language_speak").value;
		
		/* alert(language_id); */
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarraylanguage');?>",
			  data: {
						'language_id' 						: language_id, 
						'applicant_language_listen' 		: applicant_language_listen, 
						'applicant_language_read' 			: applicant_language_read, 
						'applicant_language_write'			: applicant_language_write,
						'applicant_language_speak' 			: applicant_language_speak, 
						'session_name' 						: "addarraylanguage-"
					},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
			});
	}
	
	function formaddarraysubject(){
		var applicant_subjects_status 	= document.getElementById("applicant_subjects_status").value;
		var applicant_subjects_name	 	= document.getElementById("applicant_subjects_name").value;
		var applicant_subjects_remark 	= document.getElementById("applicant_subjects_remark").value;
		
		/* alert(applicant_subjects_status); */
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarraysubject');?>",
			  data: {
						'applicant_subjects_status' 	: applicant_subjects_status, 
						'applicant_subjects_name' 		: applicant_subjects_name, 
						'applicant_subjects_remark' 	: applicant_subjects_remark,
						'session_name' 					: "addarraysubjects-"
					},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
			});
	}
	
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	
	/* $status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	); */
	
	$EducationType 	= array (
			0 => "Formal", 
			1 => "Non Formal"
	);
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_id', $coreeducation,set_value('education_id',$data['education_id']),'id="education_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Education</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_type', $educationtype,set_value('applicant_education_type',$data['applicant_education_type']),'id="applicant_education_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Education Type</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_name" name="applicant_education_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_name'];?>">
			<label>Education Name</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_city" name="applicant_education_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_city'];?>">
			<label>City</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_from_period" name="applicant_education_from_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_from_period'];?>">
			<label>From Period</label>
			<span class="help-block">yyyymm</span>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_to_period" name="applicant_education_to_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_to_period'];?>">
			<label>To Period</label>
			<span class="help-block">yyyymm</span>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_duration" name="applicant_education_duration" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_duration'];?>">
			<label>Duration</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_passed', $status,set_value('applicant_education_passed',$data['applicant_education_passed']),'id="applicant_education_passed" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Passed</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_certificate', $status,set_value('applicant_education_certificate',$data['applicant_education_certificate']),'id="applicant_education_certificate" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Certificate</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_education_remark" id="applicant_education_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_education_remark'];?></textarea>
			<label class="control-label">Education Remark</label>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayEducation" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayeducation();">
	</div>
</div>
<br>
<br>
<?php 
	$sesi 							= $this->session->userdata('unique');
	$recruitmentapplicanteducation	= $this->session->userdata('addarrayeducation-'.$sesi['unique']);
?>

<!--div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">-->
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
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
								$no = 1;
								if(!empty($recruitmentapplicanteducation)){
									foreach($recruitmentapplicanteducation as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->recruitmentapplicantdata_model->getEducationName($val['education_id'])."</td>
												<td>".$this->configuration->EducationType[$val['applicant_education_type']]."</td>
												<td>".$val['applicant_education_name']."</td>
												<td>".$val['applicant_education_city']."</td>
												<td>".$val['applicant_education_from_period']."</td>
												<td>".$val['applicant_education_to_period']."</td>
												<td>".$val['applicant_education_duration']."</td>
												<td>".$this->configuration->Status[$val['applicant_education_passed']]."</td>
												<td>".$this->configuration->Status[$val['applicant_education_certificate']]."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantEducation/'.$val['applicant_education_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
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

<br>
<br>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('language_id', $corelanguage,set_value('language_id',$data['language_id']),'id="language_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Language</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_listen', $listeningskill,set_value('applicant_language_listen',$data['applicant_language_listen']),'id="applicant_language_listen" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Listening Skill</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_read', $readingskill,set_value('applicant_language_read',$data['applicant_language_read']),'id="applicant_language_read" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Reading Skill</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_write', $writingskill,set_value('applicant_language_write',$data['applicant_language_write']),'id="applicant_language_write" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Writing Skill</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_language_speak', $speakingskill,set_value('applicant_language_speak',$data['applicant_language_speak']),'id="applicant_language_speak" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Speaking Skill</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayLanguage" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraylanguage();">
	</div>
</div>
<br>
<br>
<?php 
	$sesi 							= $this->session->userdata('unique');
	$recruitmentapplicantlanguage	= $this->session->userdata('addarraylanguage-'.$sesi['unique']);
?>

<!--div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">-->
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
								if(!empty($recruitmentapplicantlanguage)){
									foreach($recruitmentapplicantlanguage as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->recruitmentapplicantdata_model->getLanguageName($val['language_id'])."</td>
												<td>".$this->configuration->ListeningSkill[$val['applicant_language_listen']]."</td>
												<td>".$this->configuration->ReadingSkill[$val['applicant_language_read']]."</td>
												<td>".$this->configuration->WritingSkill[$val['applicant_language_write']]."</td>
												<td>".$this->configuration->SpeakingSkill[$val['applicant_language_speak']]."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantLanguage/'.$val['applicant_language_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
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

<br>
<br>

<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_cost" name="applicant_education_cost" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_education_cost'];?>">
			<label>Education Cost</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_been_champion', $status,set_value('applicant_been_champion',$data['applicant_been_champion']),'id="applicant_been_champion" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Been Champion ?</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_champion_major" name="applicant_champion_major" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_champion_major'];?>" >
			<label>Have you ever be a champion</label>
		</div>
	</div>
</div>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_grade_fail', $status,set_value('applicant_grade_fail',$data['applicant_grade_fail']),'id="applicant_grade_fail" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Grade Fail</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_grade_fail_period" name="applicant_grade_fail_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_grade_fail_period'];?>">
			<label>Fail Period</label>
			<span class="help-block">201701</span>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_grade_fail_reason" id="applicant_grade_fail_reason" class="form-control" ><?php echo $data['applicant_grade_fail_reason'];?></textarea>
			<label for="form-control">Fail Reason</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_further_study', $status,set_value('applicant_further_study',$data['applicant_further_study']),'id="applicant_further_study" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Futher Study</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_further_study_major" id="applicant_further_study_major" class="form-control" ><?php echo $data['applicant_further_study_major'];?></textarea>
			<label for="form-control">Further Study Major</label>
		</div>
	</div>
</div>

<br>
<br>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_subjects_status', $subjectsstatus,set_value('applicant_subjects_status',$data['applicant_subjects_status']),'id="applicant_subjects_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Subjects Status</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_subjects_name" name="applicant_subjects_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_subjects_name'];?>" >
			<label>Subjects Name</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_subjects_remark" id="applicant_subjects_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_subjects_remark'];?></textarea>
			<label for="form-control">Subjects Remark</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArraySubject" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraysubject();">
	</div>
</div>
<br>
<br>
<?php 
	$sesi 							= $this->session->userdata('unique');
	$recruitmentapplicantsubject	= $this->session->userdata('addarraysubject-'.$sesi['unique']);
?>

<!--div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">-->
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="25%">Subjects Status</th>
									<th style='text-align:center' width="35%">Subjects Name</th>
									<th style='text-align:center' width="35%">Subjects Remark</th>
									<th style='text-align:center'>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantsubject)){
									foreach($recruitmentapplicantsubject as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->configuration->SubjectsStatus[$val['applicant_subjects_status']]."</td>
												<td>".$val['applicant_subjects_name']."</td>
												<td>".$val['applicant_subjects_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantSubject/'.$val['applicant_subjects_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
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