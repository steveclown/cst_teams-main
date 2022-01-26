<script>
	// mappia = "<?php echo site_url('item/add'); ?>";
	
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
	
	function formaddarrayworking(){
		
		var work_month_from 			= document.getElementById("work_month_from").value;
		var work_year_from 				= document.getElementById("work_year_from").value;
		var work_month_to 				= document.getElementById("work_month_to").value;
		var work_year_to 				= document.getElementById("work_year_to").value;
		var working_company_name 		= document.getElementById("working_company_name").value;
		var working_company_address 	= document.getElementById("working_company_address").value;
		var working_job_title			= document.getElementById("working_job_title").value;
		var working_last_salary			= document.getElementById("working_last_salary").value;
		var working_separation_reason	= document.getElementById("working_separation_reason").value;
		var working_separation_letter	= document.getElementById("working_separation_letter").value;
		var working_experience_remark	= document.getElementById("working_experience_remark").value; 
		
		/* alert(working_separation_letter); */
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentapplicantdata/addarrayworking');?>",
			  data: {
					'work_month_from' 				: work_month_from,
					'work_year_from' 				: work_year_from, 
					'work_month_to' 				: work_month_to,
					'work_year_to' 					: work_year_to, 
					'working_company_name' 			: working_company_name, 
					'working_company_address' 		: working_company_address, 
					'working_job_title' 			: working_job_title, 
					'working_last_salary' 			: working_last_salary, 
					'working_separation_reason' 	: working_separation_reason,
					'working_separation_letter' 	: working_separation_letter, 
					'working_experience_remark' 	: working_experience_remark, 
					'session_name' 					: "addarrayworking-"
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
	
	/* print_r($data); */
?>
<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_month_from', $monthlist,set_value('work_month_from',$data['work_month_from']),'id="work_month_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>From Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_year_from', $year,set_value('work_year_from',$data['work_year_from']),'id="work_year_from" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_month_to', $monthlist,set_value('work_month_to',$data['work_month_to']),'id="work_month_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>To Period</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_year_to', $year,set_value('work_year_to',$data['work_year_to']),'id="work_year_to" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="working_company_name" name="working_company_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_company_name'];?>">
			<label>Company Name</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="company_address" id="working_company_address" onChange="function_elements_add(this.name, this.value);"class="form-control" ><?php echo $data['working_company_address'];?></textarea>
			<label class="control-label">Company Address</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="working_job_title" name="working_job_title" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_job_title'];?>" >
			<label>Job Title</label>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="working_last_salary" name="working_last_salary" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['working_last_salary'];?>">
			<label>Last Salary</label>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="working_separation_reason" id="working_separation_reason" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['working_separation_reason'];?></textarea>
			<label class="control-label">Separation Reason</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('working_separation_letter', $separationletter,set_value('working_separation_letter',$data['working_separation_letter']),'id="working_separation_letter" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
			?>
			<label>Separation Letter</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="working_experience_remark" id="working_experience_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['working_experience_remark'];?></textarea>
			<label class="control-label">Remark</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="button" name="add2" id="buttonAddArrayWorking" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayworking();">
	</div>
</div>
<br>
<br>

<?php 
	$sesi 							= $this->session->userdata('unique');
	$recruitmentapplicantworking	= $this->session->userdata('addarrayworking-'.$sesi['unique']);
?>

<!--div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">-->
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Name</th>
									<th style='text-align:center' width="10%">Address</th>
									<th style='text-align:center' width="10%">Job Title</th>
									<th style='text-align:center' width="10%">From Period</th>
									<th style='text-align:center' width="10%">To Period</th>
									<th style='text-align:center' width="10%">Last Salary</th>
									<th style='text-align:center' width="10%">Separation Reason</th>
									<th style='text-align:center' width="10%">Separation Letter</th>
									<th style='text-align:center' width="10%">Remark</th>
									<th style='text-align:center'>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantworking)){
									foreach($recruitmentapplicantworking as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['working_company_name']."</td>
												<td>".$val['working_company_address']."</td>
												<td>".$val['working_job_title']."</td>
												<td>".$val['working_from_period']."</td>
												<td>".$val['working_to_period']."</td>
												<td>".$val['working_last_salary']."</td>
												<td>".$val['working_separation_reason']."</td>
												<td>".$this->configuration->SeparationLetter[$val['working_separation_letter']]."</td>
												<td>".$val['working_experience_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'recruitmentapplicantdata/deleteApplicantWorking/'.$val['applicant_working_record_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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
											<td colspan='11' style='text-align:center;'>
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
			<input type="text" autocomplete="off"  class="form-control" id="applicant_most_impressive" name="applicant_most_impressive" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_most_impressive'];?>">
			<label>Most Impressive Company</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_most_impressive_reason" id="applicant_most_impressive_reason" class="form-control" ><?php echo $data['applicant_most_impressive_reason'];?></textarea>
			<label class="control-label">Most Impressive Company Reason</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_has_team_member', $status,set_value('applicant_has_team_member',$data['applicant_has_team_member']),'id="applicant_has_team_member" class="form-control"');
			?>
			<label>Has Team Member</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_has_team_number" name="applicant_has_team_number" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_has_team_number'];?>">
			<label>Team Member</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_how_to_manage_team_member" id="applicant_how_to_manage_team_member" class="form-control" ><?php echo $data['applicant_how_to_manage_team_member'];?></textarea>
			<label>How to Manage Member</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_head_expectation" id="applicant_head_expectation" class="form-control" ><?php echo $data['applicant_head_expectation'];?></textarea>
			<label>Head Expectation</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_new_ideas" id="applicant_new_ideas" class="form-control" ><?php echo $data['applicant_new_ideas'];?></textarea>
			<label>New Ideas</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_achievement" id="applicant_achievement" class="form-control" ><?php echo $data['applicant_achievement'];?></textarea>
			<label>Achievement</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_achievement_satisfaction" id="applicant_achievement_satisfaction" class="form-control" ><?php echo $data['applicant_achievement_satisfaction'];?></textarea>
			<label control-label">Achievement Satisfaction</label>
		</div>
	</div>
</div>