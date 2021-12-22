<script>
	mappia = "<?php echo site_url('recruitmentapplicantdata/addRecruitmentApplicantData'); ?>";
	function ngawur(value){
	// alert(value);
	// document.getElementById("3").style.display = "none";
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('item/saveitemtype');?>",
				data: {'item_type' : value},
				success: function(data){
				window.location.replace(mappia);
			}
		});
	}
	
	function deletesessionarrays(value,session_name){
//			alert(array_name);
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('transactionalapplicantdata/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace(mappia);
			}
		});
	}
	
	
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	
	$status = array(
		'0'	=> 'Dislike',
		'1'	=> 'Like'
	);
	
?>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_motivation" id="applicant_question_motivation" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_motivation'];?></textarea>
			<label>Motivation</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_expectation" id="applicant_question_expectation" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_expectation'];?></textarea>
			<label>Expectation</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_work_group" id="applicant_question_work_group" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_work_group'];?></textarea>
			<label>Work Group</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_head_character" id="applicant_question_head_character" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_head_character'];?></textarea>
			<label>Head Character</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_head_appreciate" id="applicant_question_head_appreciate" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_head_appreciate'];?></textarea>
			<label>Head Appreciate</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_make_mistake" id="applicant_question_make_mistake" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_question_make_mistake'];?></textarea>
			<label>Make Mistake</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_responsibility" id="applicant_question_responsibility" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_responsibility'];?></textarea>
			<label>Responsibility</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_easy_influence" id="applicant_question_easy_influence" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_easy_influence'];?></textarea>
			<label>Easy Influence</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_inappropriate_condition" id="applicant_question_inappropriate_condition" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_inappropriate_condition'];?></textarea>
			<label>Inappropriate Condition</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_question_working_expectation" id="applicant_question_working_expectation" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_question_working_expectation'];?></textarea>
			<label>Working Expectation</label>
		</div>
	</div>
</div>