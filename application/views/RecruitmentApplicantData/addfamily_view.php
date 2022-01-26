<script>
	mappia = "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData/'); ?>";
	function deletesessionarrays(value, session_name){
		alert(value);
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('RecruitmentApplicantData/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace(mappia);
			}
		});
	}
	
	function formaddarrayfamily(){
		
		var family_relation_id 					= document.getElementById("family_relation_id").value;
		var applicant_family_name 				= document.getElementById("applicant_family_name").value;
		var applicant_family_gender				= document.getElementById("applicant_family_gender").value;
		var applicant_family_age				= document.getElementById("applicant_family_age").value;
		var applicant_family_education			= document.getElementById("applicant_family_education").value;
		var applicant_family_occupation			= document.getElementById("applicant_family_occupation").value;
		var marital_status_id_family			= document.getElementById("marital_status_id_family").value;
		var applicant_family_sibling			= document.getElementById("applicant_family_sibling").value;
		var applicant_family_remark				= document.getElementById("applicant_family_remark").value;
		
		/* alert(family_relation_id); */
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentApplicantData/addarrayfamily');?>",
			  data: {
						'family_relation_id' 				: family_relation_id, 
						'marital_status_id_family' 			: marital_status_id_family, 
						'applicant_family_name' 			: applicant_family_name, 
						'applicant_family_gender' 			: applicant_family_gender, 
						'applicant_family_age' 				: applicant_family_age, 
						'applicant_family_education' 		: applicant_family_education, 
						'applicant_family_occupation' 		: applicant_family_occupation, 
						'applicant_family_sibling'		 	: applicant_family_sibling, 
						'applicant_family_remark' 			: applicant_family_remark, 
						'session_name' 						: "addarrayfamily-"
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
	$data 	= $this->session->userdata('addapplicantdata-'.$sesi['unique']);	
	
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
	
	/* print_r($data); */
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('family_relation_id', $corefamilyrelation,set_value('family_relation_id',$data['family_relation_id']),'id="family_relation_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Family Relation</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_name" name="applicant_family_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_name'];?>">
			<label for = "form-control">Family Name</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_family_gender', $gender,set_value('applicant_family_gender',$data['applicant_family_gender']),'id="applicant_family_gender" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label for="form-control">Family Gender</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_age" name="applicant_family_age" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_age'];?>">
			<label for = "form-control">Family Age</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_education" name="applicant_family_education" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_education'];?>" >
			<label for = "form-control">Education</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_occupation" name="applicant_family_occupation" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_occupation'];?>">
			<label for = "form-control">Ocupation</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('marital_status_id_family', $coremaritalstatus,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id_family" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Marital Status</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_family_sibling', $status,set_value('applicant_family_sibling',$data['applicant_family_sibling']),'id="applicant_family_sibling" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
				
			?>
			<label>Family Sibling</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<label class="control-label">Family Remark</label>
			<textarea rows="3" name="applicant_family_remark" id="applicant_family_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_family_remark'];?></textarea>
		</div>
	</div>

</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayFamily" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayfamily();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 	= $this->session->userdata('unique');
	$recruitmentapplicantfamily	= $this->session->userdata('addarrayfamily-'.$sesi['unique']);
?>
<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="20%">Family Relation</th>
									<th style='text-align:center' width="30%">Family Name</th>
									<th style='text-align:center' width="10%">Family Gender</th>
									<th style='text-align:center' width="10%">Family Age</th>
									<th style='text-align:center' width="20%">Marital Status</th>
									<th style='text-align:center' width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantfamily)){
									foreach($recruitmentapplicantfamily as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".$this->RecruitmentApplicantData_model->getFamilyRelationName($val['family_relation_id'])."</td>
												<td>".$val['applicant_family_name']."</td>
												<td>".$this->configuration->Gender[$val['applicant_family_gender']]."</td>
												<td>".$val['applicant_family_age']."</td>
												<td>".$this->RecruitmentApplicantData_model->getMaritalStatusName($val['marital_status_id_family'])."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteApplicantFamily/'.$val['applicant_family_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
											<td colspan='20' style='text-align:center;'>
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