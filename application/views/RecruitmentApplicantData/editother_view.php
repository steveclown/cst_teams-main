<script>
	// mappia = "<?php echo site_url('transactionalapplicantdata/add'); ?>";
	mappia = "<?php echo site_url('recruitmentapplicantdata/addRecruitmentApplicantData'); ?>";
	base_url = '<?php echo base_url();?>';
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
	
	function formaddarrayorganization(){
		var organization_name 		= document.getElementById("organization_name").value;
		var organization_type	 	= document.getElementById("organization_type").value;
		var organization_period 	= document.getElementById("organization_period").value;
		var organization_title		= document.getElementById("organization_title").value;
		var organization_status		= document.getElementById("organization_status").value;
		
		alert(organization_name);
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarrayorganization');?>",
			  data: {
					'organization_name' 	: organization_name, 
					'organization_type' 	: organization_type, 
					'organization_period' 	: organization_period, 
					'organization_title'	: organization_title,
					'organization_status' 	: organization_status, 
					'session_name' 			: "addarrayorganization-"
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
	
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
	
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
	
?>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_hobby" id="applicant_hobby" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_hobby'];?></textarea>
			<label>Hobby</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_hobby_active" id="applicant_hobby_active" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_hobby_active'];?></textarea>
			<label>Active Hobby</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_reading_type" id="applicant_reading_type" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_reading_type'];?></textarea>
			<label>Type of Reading</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_good_book" id="applicant_good_book" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_good_book'];?></textarea>
			<label>Good Book</label>
		</div>
	</div>
</div>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="organization_name" name="organization_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['organization_name'];?>">
			<label>Organization Name</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('organization_type', $organizationtype,set_value('organization_type',$data['organization_type']),'id="organization_type" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Organization Type</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('organization_period', $year,set_value('organization_period',$data['organization_period']),'id="organization_period" class="form-control  select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Period</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="organization_title" name="organization_title" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['organization_title'];?>">
			<label>Title</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('organization_status', $organizationstatus,set_value('organization_status',$data['organization_status']),'id="organization_status" class="form-control  select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Status</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayOther" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayorganization();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 								= $this->session->userdata('unique');
	$recruitmentapplicantorganization	= $this->session->userdata('addarrayorganization-'.$sesi['unique']);
?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="25%">Name</th>
									<th style='text-align:center' width="10%">Type</th>
									<th style='text-align:center' width="10%">Period</th>
									<th style='text-align:center' width="20%">Title</th>
									<th style='text-align:center' width="20%">Status</th>
									<th style='text-align:center' width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($recruitmentapplicantorganization)){
									foreach($recruitmentapplicantorganization as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['organization_name']."</td>
												<td>".$this->configuration->OrganizationType[$val['organization_type']]."</td>
												<td>".$val['organization_period']."</td>
												<td>".$val['organization_title']."</td>
												<td>".$this->configuration->OrganizationStatus[$val['organization_status']]."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantOrganization/'.$val['applicant_organization_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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