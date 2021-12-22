<script>
	base_url = '<?php echo base_url();?>';
	mappia = "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";
	
	function reset_add_experience(){
		document.location = base_url+"RecruitmentApplicantData/reset_add_experience";
	}

	function function_elements_add_experience(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_experience');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	function processAddArrayRecruitmentApplicantExperience(){
		
		var work_month_from 				= document.getElementById("work_month_from").value;
		var work_year_from 					= document.getElementById("work_year_from").value;
		var work_month_to 					= document.getElementById("work_month_to").value;
		var work_year_to 					= document.getElementById("work_year_to").value;
		var experience_company_name 		= document.getElementById("experience_company_name").value;
		var experience_company_address 		= document.getElementById("experience_company_address").value;
		var experience_job_title			= document.getElementById("experience_job_title").value;
		var experience_last_salary			= document.getElementById("experience_last_salary").value;
		var experience_separation_reason	= document.getElementById("experience_separation_reason").value;
		var experience_separation_letter	= document.getElementById("experience_separation_letter").value;
		var experience_experience_remark	= document.getElementById("experience_experience_remark").value; 
		
		/* alert(experience_separation_letter); */
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentApplicantData/processAddArrayRecruitmentApplicantExperience');?>",
			  data: {
					'work_month_from' 				: work_month_from,
					'work_year_from' 				: work_year_from, 
					'work_month_to' 				: work_month_to,
					'work_year_to' 					: work_year_to, 
					'experience_company_name' 		: experience_company_name, 
					'experience_company_address' 	: experience_company_address, 
					'experience_job_title' 			: experience_job_title, 
					'experience_last_salary' 		: experience_last_salary, 
					'experience_separation_reason' 	: experience_separation_reason,
					'experience_separation_letter' 	: experience_separation_letter, 
					'experience_experience_remark' 	: experience_experience_remark, 
					'session_name' 					: "addarrayexperience-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
</script>
<?php
	$unique				= $this->session->userdata('unique');
	$auth				= $this->session->userdata('auth');
	$data_experience 	= $this->session->userdata('addrecruitmentapplicantexperience-'.$unique['unique']);	
	

	
	$year_now 	=	date('Y');
	if(!is_array($data_experience)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-50); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_month_from', $monthlist,set_value('work_month_from',$data_experience['work_month_from']),'id="work_month_from" class="form-control select2me" onChange="function_elements_add_experience(this.name, this.value);"');
			?>
			<label>Dari Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_year_from', $year,set_value('work_year_from',$data_experience['work_year_from']),'id="work_year_from" class="form-control select2me" onChange="function_elements_add_experience(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_month_to', $monthlist,set_value('work_month_to',$data_experience['work_month_to']),'id="work_month_to" class="form-control select2me" onChange="function_elements_add_experience(this.name, this.value);"');
			?>
			<label>Sampai Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_year_to', $year,set_value('work_year_to',$data_experience['work_year_to']),'id="work_year_to" class="form-control select2me" onChange="function_elements_add_experience(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_company_name" name="experience_company_name" onChange="function_elements_add_experience(this.name, this.value);" value="<?php echo $data_experience['experience_company_name'];?>">
			<label>Nama Perusahaan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="company_address" id="experience_company_address" onChange="function_elements_add_experience(this.name, this.value);"class="form-control" ><?php echo $data_experience['experience_company_address'];?></textarea>
			<label class="control-label">Alamat Perusahaan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_job_title" name="experience_job_title" onChange="function_elements_add_experience(this.name, this.value);" value="<?php echo $data_experience['experience_job_title'];?>" >
			<label>Bekerja Sebagai</label>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_last_salary" name="experience_last_salary" onChange="function_elements_add_experience(this.name, this.value);" value="<?php echo $data_experience['experience_last_salary'];?>">
			<label>Gaji Terakhir</label>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_separation_reason" id="experience_separation_reason" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"><?php echo $data_experience['experience_separation_reason'];?></textarea>
			<label class="control-label">Alasan Keluar</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_separation_letter', $separationletter,set_value('experience_separation_letter',$data_experience['experience_separation_letter']),'id="experience_separation_letter" class="form-control select2me" onChange="function_elements_add_experience(this.name, this.value);"');
			?>
			<label>Surat Plakerin</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_experience_remark" id="experience_experience_remark" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"><?php echo $data_experience['experience_experience_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantExperience" value="Reset" class="btn red" title="Reset" onClick="reset_add_experience();">
		<input type="button" name="Add2" id="buttonAddArrayRecruitmentApplicantExperience" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayRecruitmentApplicantExperience();">
	</div>
</div>
<br>
<br>

<?php 
	$unique							= $this->session->userdata('unique');
	$recruitmentapplicantexperience	= $this->session->userdata('addarrayrecruitmentapplicantexperience-'.$unique['unique']);
?>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Nama</th>
									<th style='text-align:center' width="10%">Alamat</th>
									<th style='text-align:center' width="10%">Kerja Sebagai</th>
									<th style='text-align:center' width="10%">Dari Tahun</th>
									<th style='text-align:center' width="10%">Sampai Tahun </th>
									<th style='text-align:center' width="10%">Gaji Terakhir</th>
									<th style='text-align:center' width="10%">Alasan Keluar</th>
									<th style='text-align:center' width="10%">Surat Plakerin</th>
									<th style='text-align:center' width="10%">Keterangan</th>
									<th style='text-align:center'>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantexperience)){
									foreach($recruitmentapplicantexperience as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['experience_company_name']."</td>
												<td>".$val['experience_company_address']."</td>
												<td>".$val['experience_job_title']."</td>
												<td>".$val['experience_from_period']."</td>
												<td>".$val['experience_to_period']."</td>
												<td>".$val['experience_last_salary']."</td>
												<td>".$val['experience_separation_reason']."</td>
												<td>".$separationletter[$val['experience_separation_letter']]."</td>
												<td>".$val['experience_experience_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteArrayRecruitmentApplicantExperience/'.$val['applicant_experience_record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Hapus
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
												<b>Tidak Ada Data</b>
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
			
<!-- <br>
<br>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_most_impressive" name="applicant_most_impressive" onChange="function_elements_add_experience(this.name, this.value);" value="<?php echo $data_experience['applicant_most_impressive'];?>">
			<label>Most Impressive Company</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_most_impressive_reason" id="applicant_most_impressive_reason" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"><?php echo $data_experience['applicant_most_impressive_reason'];?></textarea>
			<label class="control-label">Most Impressive Company Reason</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_has_team_member', $status,set_value('applicant_has_team_member',$data_experience['applicant_has_team_member']),'id="applicant_has_team_member" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"');
			?>
			<label>Has Team Member</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_has_team_number" name="applicant_has_team_number" onChange="function_elements_add_experience(this.name, this.value);" value="<?php echo $data_experience['applicant_has_team_number'];?>">
			<label>Team Member</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_how_to_manage_team_member" id="applicant_how_to_manage_team_member" class="form-control" onChange="function_elements_add_experience(this.name, this.value);" ><?php echo $data_experience['applicant_how_to_manage_team_member'];?></textarea>
			<label>How to Manage Member</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_head_expectation" id="applicant_head_expectation" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"><?php echo $data_experience['applicant_head_expectation'];?></textarea>
			<label>Head Expectation</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_new_ideas" id="applicant_new_ideas" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"><?php echo $data_experience['applicant_new_ideas'];?></textarea>
			<label>New Ideas</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_achievement" id="applicant_achievement" class="form-control" onChange="function_elements_add_experience(this.name, this.value);"><?php echo $data_experience['applicant_achievement'];?></textarea>
			<label>Achievement</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_achievement_satisfaction" id="applicant_achievement_satisfaction" onChange="function_elements_add_experience(this.name, this.value);" class="form-control" ><?php echo $data_experience['applicant_achievement_satisfaction'];?></textarea>
			<label control-label">Achievement Satisfaction</label>
		</div>
	</div>
</div> -->