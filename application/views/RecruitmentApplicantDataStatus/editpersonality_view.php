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
		'0'	=> 'Not Active',
		'1'	=> 'Active'
	);
	
?>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Strength Remark</label>
			<textarea rows="3" name="applicant_strength_remark" id="applicant_strength_remark" class="form-control" placeholder="Remark"><?php echo $data['applicant_strength_remark'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Weakness Remark</label>
			<textarea rows="3" name="applicant_weakness_remark" id="applicant_weakness_remark" class="form-control" placeholder="Remark"><?php echo $data['applicant_weakness_remark'];?></textarea>
		</div>
	</div>
</div>