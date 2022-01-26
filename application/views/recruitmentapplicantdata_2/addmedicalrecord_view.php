<script>
	
	
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
	
	function formaddarraymedical(){
		var family_status_id 			= document.getElementById("family_status_id2").value;
		var applicant_medical_disease 	= document.getElementById("applicant_medical_disease").value;
		var applicant_medical_name		= document.getElementById("applicant_medical_name").value;
		
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('transactionalapplicantdata/addarraymedical');?>",
			  data: {'family_status_id' : family_status_id, 'applicant_medical_disease' : applicant_medical_disease, 'applicant_medical_name':applicant_medical_name,
					'session_name' : "addarrayfamily-"},
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
		'0'	=> 'Not Active',
		'1'	=> 'Active'
	);
	
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Family Status</label>
			<?php
				echo form_dropdown('family_status_id2', $familystatus,set_value('family_status_id',$data['family_status_id']),'id="family_status_id2" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Disease</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_medical_disease" name="applicant_medical_disease" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_medical_disease'];?>" placeholder="Disease">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Name</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_medical_name" name="applicant_medical_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_medical_name'];?>" placeholder="Name">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
		<input type="submit" name="add2" id="add2" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraymedical();">
	</div>
</div>
<?php echo form_close(); ?>
<?php 
	$sesi 	= $this->session->userdata('unique');
	$medical	= $this->session->userdata('addarraymedical-'.$sesi['unique']);
?>
<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Family Status</th>
									<th style='text-align:center' width="10%">Disease</th>
									<th style='text-align:center' width="10%">Medical Name</th>
									<th style='text-align:center' width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($medical)){
									foreach($medical as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->transactionalapplicantdata_model->getfamilystatusname($val['family_status_id'])."</td>
												<td>".$val[applicant_medical_disease]."</td>
												<td>".$val[applicant_medical_name]."</td>
												<td>";
												?>															
													<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php echo $val[family_status_id].'-'.$val[applicant_medical_disease].'-'.$val[applicant_medical_name]
													; ?>","addarraymedical-");'>
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