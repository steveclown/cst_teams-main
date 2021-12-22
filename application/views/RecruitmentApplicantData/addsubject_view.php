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
	
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Subject Status</label>
			<?php
				echo form_dropdown('applicant_subjects_status', $subjectsstatus,set_value('applicant_subjects_status',$data['applicant_subjects_status']),'id="applicant_subjects_status" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Name</label>
			<input type="text" class="form-control" id="applicant_subjects_name" name="applicant_subjects_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_subjects_name'];?>" placeholder="Name">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Remark</label>
			<textarea rows="3" name="applicant_subjects_remark" id="applicant_subjects_remark" class="form-control" placeholder="Remark"><?php echo $data['applicant_subjects_remark'];?></textarea>
		</div>
	</div>
</div>