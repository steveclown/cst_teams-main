<script>
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
	
	function formaddarraymedical(){
		var family_relation_id 			= document.getElementById("family_relation_id_medical").value;
		var applicant_medical_disease 	= document.getElementById("applicant_medical_disease").value;
		var applicant_medical_name		= document.getElementById("applicant_medical_name").value;
		
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarraymedical');?>",
			  data: {
					'family_relation_id' 			: family_relation_id, 
					'applicant_medical_disease' 	: applicant_medical_disease, 
					'applicant_medical_name'		: applicant_medical_name,
					'session_name' 					: "addarraymedical-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
		});
	}
	
	function formaddarrayaccident(){
		var accident_month 						= document.getElementById("accident_month").value;
		var accident_year 						= document.getElementById("accident_year").value;
		var applicant_accident_remark 			= document.getElementById("applicant_accident_remark").value;
		var applicant_accident_consequence 		= document.getElementById("applicant_accident_consequence").value;
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarrayaccident');?>",
			  data: {
					'accident_month' 					: accident_month, 
					'accident_year' 					: accident_year, 
					'applicant_accident_remark'			: applicant_accident_remark,
					'applicant_accident_consequence'	: applicant_accident_consequence,
					'session_name' 						: "addarrayaccident-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
		});
	}
	
	function formaddarraypersonality(){
		var applicant_strength_remark 			= document.getElementById("applicant_strength_remark").value;
		var applicant_weakness_remark 			= document.getElementById("applicant_weakness_remark").value;
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarraypersonality');?>",
			  data: {
					'applicant_strength_remark'			: applicant_strength_remark,
					'applicant_weakness_remark'			: applicant_weakness_remark,
					'session_name' 						: "addarraypersonality-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
		});
	}
	
	function formaddarraylaw(){
		var law_month 				= document.getElementById("law_month").value;
		var law_year 				= document.getElementById("law_year").value;
		var applicant_law_location 	= document.getElementById("applicant_law_location").value;
		var applicant_law_remark 	= document.getElementById("applicant_law_remark").value;
		
		/* alert(applicant_law_remark); */
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarraylawexperience');?>",
			  data: {
					'law_month'					: law_month,
					'law_year'					: law_year,
					'applicant_law_location'	: applicant_law_location,
					'applicant_law_remark'		: applicant_law_remark,
					'session_name' 				: "addarraylawexperience-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
		});
	}
	
	function formaddarrayinterview(){
		var interview_month 				= document.getElementById("interview_month").value;
		var interview_year 					= document.getElementById("interview_year").value;
		var applicant_interview_location 	= document.getElementById("applicant_interview_location").value;
		var applicant_interview_remark 		= document.getElementById("applicant_interview_remark").value;
		
		/* alert(applicant_interview_location); */
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarrayinterview');?>",
			  data: {
					'interview_month'				: interview_month,
					'interview_year'				: interview_year,
					'applicant_interview_location'	: applicant_interview_location,
					'applicant_interview_remark'	: applicant_interview_remark,
					'session_name' 					: "addarrayinterview-"},
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
	
	for($i=($year_now-5); $i<($year_now+1); $i++){
		$year[$i] = $i;
	} 
	
?>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_weight" name="applicant_weight" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_weight'];?>" >
			<label>Weight</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_height" name="applicant_height" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_height'];?>" >
			<label>Height</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_sick_opname', $sickopname,set_value('applicant_sick_opname',$data['applicant_sick_opname']),'id="applicant_sick_opname" class="form-control select2me"');
			?>
			<label>Sick Opname</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_disease" name="applicant_sick_disease" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_disease'];?>">
			<label>Disease </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_how_long" name="applicant_sick_how_long" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_how_long'];?>" >
			<label>How Long</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_year" name="applicant_sick_year" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_year'];?>" >
			<label>Year</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_sick_hospital" name="applicant_sick_hospital" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_sick_hospital'];?>">
			<label>Hospital</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_colour_blind', $colourblind,set_value('applicant_colour_blind',$data['applicant_colour_blind']),'id="applicant_colour_blind" class="form-control select2me"');
			?>
			<label>Colour Blind</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('family_relation_id_medical', $corefamilyrelation,set_value('family_relation_id',$data['family_relation_id']),'id="family_relation_id_medical" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Family Relation</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_medical_disease" name="applicant_medical_disease" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_medical_disease'];?>">
			<label>Disease</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_medical_name" name="applicant_medical_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_medical_name'];?>">
			<label>Family Name</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayMedical" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraymedical();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 				 			= $this->session->userdata('unique');
	$recruitmentapplicantmedical	= $this->session->userdata('addarraymedical-'.$sesi['unique']);
?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="25%">Family Relation</th>
									<th style='text-align:center' width="25%">Disease</th>
									<th style='text-align:center' width="25%">Family Name</th>
									<th style='text-align:center' width="20%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($recruitmentapplicantmedical)){
									foreach($recruitmentapplicantmedical as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->recruitmentapplicantdata_model->getFamilyRelationName($val['family_relation_id'])."</td>
												<td>".$val['applicant_medical_disease']."</td>
												<td>".$val['applicant_medical_name']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantMedical/'.$val['applicant_medical_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
<br>
<br>
<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('accident_month', $monthlist,set_value('accident_month',$data['accident_month']),'id="accident_month" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('accident_year', $year,set_value('accident_year',$data['accident_year']),'id="accident_year" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>
<div class = "row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_accident_remark" id="applicant_accident_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_accident_remark'];?></textarea>
			<label>Remark</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_accident_consequence" id="applicant_accident_consequence" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_accident_consequence'];?></textarea>
			<label>Accident Consequence</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayAccident" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayaccident();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 							= $this->session->userdata('unique');
	$recruitmentapplicantaccident	= $this->session->userdata('addarrayaccident-'.$sesi['unique']);
	/* print_r($recruitmentapplicantaccident); */
?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Accident Period</th>
									<th style='text-align:center' width="10%">Remark</th>
									<th style='text-align:center' width="10%">Accident Consequence</th>
									<th style='text-align:center' width="10%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($recruitmentapplicantaccident)){
									foreach($recruitmentapplicantaccident as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['applicant_accident_period']."</td>
												<td>".$val['applicant_accident_remark']."</td>
												<td>".$val['applicant_accident_consequence']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantAccident/'.$val['applicant_accident_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
			
<br>
<br>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_strength_remark" name="applicant_strength_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_strength_remark'];?>">
			<label>Strength Remark</label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_weakness_remark" name="applicant_weakness_remark" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_weakness_remark'];?>">
			<label>Weakness Remark</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayPersonality" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraypersonality();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 								= $this->session->userdata('unique');
	$recruitmentapplicantpersonality	= $this->session->userdata('addarraypersonality-'.$sesi['unique']);
?>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="40%">Strength Remark</th>
									<th style='text-align:center' width="40%">Weakness Remark</th>
									<th style='text-align:center' width="15%">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($recruitmentapplicantpersonality)){
									foreach($recruitmentapplicantpersonality as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['applicant_strength_remark']."</td>
												<td>".$val['applicant_weakness_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantPersonality/'.$val['applicant_personality_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
<br>
<br>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_coworker_name1" name="applicant_coworker_name1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_coworker_name1'];?>">
			<label>Coworker Name 1</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_coworker_section1" name="applicant_coworker_section1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_coworker_section1'];?>">
			<label>Coworker Section 1</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_coworker_relation1" name="applicant_coworker_relation1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_coworker_relation1'];?>" >
			<label>Coworker Relationship 1</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_coworker_name2" name="applicant_coworker_name2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_coworker_name2'];?>">
			<label>Coworker Name 2</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_coworker_section2" name="applicant_coworker_section2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_coworker_section2'];?>">
			<label>Coworker Section 2</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_coworker_relation2" name="applicant_coworker_relation2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_coworker_relation2'];?>" >
			<label>Coworker Relationship 2</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_name" name="applicant_emergency_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_name'];?>">
			<label>Emergency Name </label>
		</div>
	</div>

	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_address" name="applicant_emergency_address" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_address'];?>" >
			<label>Address</label>
		</div>
	</div>	
</div>
<div class = "row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_relationship" name="applicant_emergency_relationship" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_relationship'];?>">
			<label>Relationship</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_home_phone" name="applicant_emergency_home_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_home_phone'];?>">
			<label>Home Phone</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_emergency_mobile_phone" name="applicant_emergency_mobile_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_emergency_mobile_phone'];?>">
			<label>Mobile Phone </label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_brand1" name="applicant_daily_transportation_brand1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_brand1'];?>" >
			<label>Transportation 1</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_year1" name="applicant_daily_transportation_year1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_year1'];?>">
			<label>Year 1</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_owner1" name="applicant_daily_transportation_owner1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_owner1'];?>">
			<label>Owner 1</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_brand2" name="applicant_daily_transportation_brand2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_brand2'];?>" >
			<label>Transportation 2</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_year2" name="applicant_daily_transportation_year2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_year2'];?>">
			<label>Year 2</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_daily_transportation_owner2" name="applicant_daily_transportation_owner2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_daily_transportation_owner2'];?>">
			<label>Owner 2</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('law_month', $monthlist,set_value('law_month',$data['law_month']),'id="law_month" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('law_year', $year,set_value('law_year',$data['law_year']),'id="law_year" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_law_location" name="applicant_law_location" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_law_location'];?>">
			<label>Location</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_law_remark" id="applicant_law_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['applicant_law_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayLaw" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarraylaw();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 	= $this->session->userdata('unique');
	$recruitmentapplicantlaw	= $this->session->userdata('addarraylawexperience-'.$sesi['unique']);	
	/* print_r($recruitmentapplicantlaw); */
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
								if(!empty($recruitmentapplicantlaw)){
									foreach($recruitmentapplicantlaw as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['applicant_law_period']."</td>
												<td>".$val['applicant_law_location']."</td>
												<td>".$val['applicant_law_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantLaw/'.$val['applicant_law_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
<br>
<br>
<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('interview_month', $monthlist,set_value('interview_month',$data['interview_month']),'id="interview_month" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('interview_year', $year,set_value('interview_year',$data['interview_year']),'id="interview_year" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_interview_location" name="applicant_interview_location" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_interview_location'];?>">
			<label>Location</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_interview_remark" id="applicant_interview_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" ><?php echo $data['applicant_interview_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayInterview" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayinterview();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 							= $this->session->userdata('unique');
	$recruitmentapplicantinterview	= $this->session->userdata('addarrayinterview-'.$sesi['unique']);	
	/* print_r($recruitmentapplicantinterview); */
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
								if(!empty($recruitmentapplicantinterview)){
									foreach($recruitmentapplicantinterview as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['applicant_interview_period']."</td>
												<td>".$val['applicant_interview_location']."</td>
												<td>".$val['applicant_interview_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantInterview/'.$val['applicant_interview_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
<br>
<br>
