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
	
	function formaddorganization(){
		var organization_experience_name 		= document.getElementById("organization_experience_name").value;
		var organization_experience_scope 		= document.getElementById("organization_experience_scope").value;
		var organization_experience_period		= document.getElementById("organization_experience_period").value;
		var organization_experience_title		= document.getElementById("organization_experience_title").value;
		var organization_experience_status		= document.getElementById("organization_experience_status").value;
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('transactionalapplicantdata/addarrayorganization');?>",
			  data: {'organization_experience_name' : organization_experience_name, 'applicant_medical_disease' : applicant_medical_disease, 'organization_experience_period':organization_experience_period,
					'organization_experience_title' : organization_experience_title,'organization_experience_status':organization_experience_status,
					'session_name' : "addarrayorganization-"},
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
			<label>Organization Name</label>
			<input type="text" autocomplete="off"  class="form-control" id="organization_experience_name" name="organization_experience_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['organization_experience_name'];?>" placeholder="Name">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Scope</label>
			<input type="text" autocomplete="off"  class="form-control" id="organization_experience_scope" name="organization_experience_scope" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['organization_experience_scope'];?>" placeholder="Scope">
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group">
			<label>Period</label>
			<input type="text" autocomplete="off"  class="form-control" id="organization_experience_period" name="organization_experience_period" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['organization_experience_period'];?>" placeholder="201501">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Title</label>
			<input type="text" autocomplete="off"  class="form-control" id="organization_experience_title" name="organization_experience_title" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['organization_experience_title'];?>" placeholder="Title">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Status</label>
			<?php
				echo form_dropdown('organization_experience_status', $status,set_value('organization_experience_status',$data['organization_experience_status']),'id="organization_experience_status" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
		<input type="submit" name="add2" id="add2" value="Add" class="btn blue" title="Simpan Data" onClick="formaddorganization();">
	</div>
</div>
<?php echo form_close(); ?>
<?php 
	$sesi 	= $this->session->userdata('unique');
	$organization	= $this->session->userdata('addarrayorganization-'.$sesi['unique']);
?>
<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Name</th>
									<th style='text-align:center' width="10%">Period</th>
									<th style='text-align:center' width="10%">Title</th>
									<th style='text-align:center' width="10%">Status</th>
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
												<td>".$val['organization_experience_name']."</td>
												<td>".$val[organization_experience_scope]."</td>
												<td>".$val[organization_experience_period]."</td>
												<td>".$val[organization_experience_title]."</td>
												<td>".$val[organization_experience_status]."</td>
												<td>";
												?>															
													<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php echo $val[organization_experience_name].'-'.$val[organization_experience_scope].'-'.$val[organization_experience_period]
													.'-'.$val[organization_experience_title].'-'.$val[organization_experience_title]; ?>","addarrayorganization-");'>
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
											<td colspan='6' style='text-align:center;'>
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