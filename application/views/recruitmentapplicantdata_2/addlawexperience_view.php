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
				window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
			}
		});
	}
	
	function formaddarraymlaw(){
		var applicant_law_experience_period 			= document.getElementById("applicant_law_experience_period").value;
		var applicant_law_location 	= document.getElementById("applicant_law_location").value;
		var applicant_law_remark		= document.getElementById("applicant_law_remark").value;
		// var applicant_id		= document.getElementById("applicant_id").value;
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('transactionalapplicantdata/addarraylawexperience');?>",
			  data: {'applicant_law_experience_period' : applicant_law_experience_period, 'applicant_law_location' : applicant_law_location, 'applicant_law_remark':applicant_law_remark,
					'session_name' : "addarraylawexperience-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
			 }
		});
	}
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data = $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
	
?>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label>Period ASasdasdas</label>
			<input type="text" class="form-control" id="applicant_law_experience_period" name="applicant_law_experience_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_law_experience_period'];?>" placeholder="Period">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Location</label>
			<input type="text" class="form-control" id="applicant_law_location" name="applicant_law_location" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_law_location'];?>" placeholder="Location">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Remark</label>
			<textarea rows="3" name="applicant_law_remark" id="applicant_law_remark" class="form-control" placeholder="Remark"><?php echo $data['applicant_law_remark'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
		<input type="submit" name="add2" id="add2" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraymlaw();">
	</div>
</div>
<?php echo form_close(); ?>
<?php 
	$sesi 	= $this->session->userdata('unique');
	$lawexperience	= $this->session->userdata('addarraylawexperience-'.$sesi['unique']);	
?>
<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Period</th>
									<th style='text-align:center' width="10%">Location</th>
									<th style='text-align:center' width="10%">Remark</th>
									<th style='text-align:center' width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($lawexperience)){
									foreach($lawexperience as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['applicant_law_experience_period']."</td>
												<td>".$val[applicant_law_location]."</td>
												<td>".$val[applicant_law_remark]."</td>
												<td>";
												?>															
													<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php echo $val[applicant_law_experience_period].'-'.$val[applicant_law_location].'-'.$val[applicant_law_remark]
													; ?>","addarraylawexperience-");'>
															<i class='fa fa-trash-o'></i> Delete </button>
													<?php
												echo"
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='5' style='text-align:center;'>
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
<label></label>