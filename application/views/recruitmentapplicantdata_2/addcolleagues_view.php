<script>
	mappia = "<?php echo site_url('item/add'); ?>";
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
	<div class="col-md-6">
		<div class="form-group">
			<label>Colleagues Name</label>
			<input type="text" class="form-control" id="applicant_work_colleagues_name" name="applicant_work_colleagues_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_colleagues_name'];?>" placeholder="Name">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Section</label>
			<input type="text" class="form-control" id="applicant_work_colleagues_section" name="applicant_work_colleagues_section" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_colleagues_section'];?>" placeholder="Section">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Relationship</label>
			<input type="text" class="form-control" id="applicant_work_colleagues_relatioship" name="applicant_work_colleagues_relatioship" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_work_colleagues_relatioship'];?>" placeholder="Relationship">
		</div>
	</div>
</div>