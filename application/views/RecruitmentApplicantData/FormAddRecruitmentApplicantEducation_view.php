<script>
	base_url = '<?php echo base_url();?>';
	mappia = "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";
	
	function reset_add_education(){
		document.location = base_url+"RecruitmentApplicantData/reset_add_education";
	}

	function function_elements_add_education(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_education');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processAddArrayRecruitmentApplicantEducation(){
		var education_id 						= document.getElementById("education_id").value;
		var applicant_education_type	 		= document.getElementById("applicant_education_type").value;
		var applicant_education_name 			= document.getElementById("applicant_education_name").value;
		var applicant_education_city			= document.getElementById("applicant_education_city").value;
		var education_month_from				= document.getElementById("education_month_from").value;
		var education_year_from					= document.getElementById("education_year_from").value;
		var education_month_to					= document.getElementById("education_month_to").value;
		var education_year_to					= document.getElementById("education_year_to").value;
		var applicant_education_duration		= document.getElementById("applicant_education_duration").value;
		var applicant_education_passed			= document.getElementById("applicant_education_passed").value;
		var applicant_education_certificate		= document.getElementById("applicant_education_certificate").value;
		var applicant_education_remark			= document.getElementById("applicant_education_remark").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentApplicantData/processAddArrayRecruitmentApplicantEducation');?>",
			  data: {
						'education_id' 						: education_id, 
						'applicant_education_type' 			: applicant_education_type, 
						'applicant_education_name' 			: applicant_education_name, 
						'applicant_education_city'			: applicant_education_city,
						'education_month_from'				: education_month_from,	
						'education_year_from'				: education_year_from,	
						'education_month_to'				: education_month_to,	
						'education_year_to'					: education_year_to, 
						'applicant_education_duration' 		: applicant_education_duration,
						'applicant_education_passed' 		: applicant_education_passed, 
						'applicant_education_certificate' 	: applicant_education_certificate, 
						'applicant_education_remark' 		: applicant_education_remark, 
						'session_name' 						: "addarrayeducation-"
					},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
	
	
	
	
</script>
<!-- <?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?> -->
<?php
	$unique 		= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_education = $this->session->userdata('addrecruitmentapplicanteducation-'.$unique['unique']);	
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_id', $coreeducation,set_value('education_id',$data_education['education_id']),'id="education_id" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Pendidikan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_type', $educationtype,set_value('applicant_education_type',$data_education['applicant_education_type']),'id="applicant_education_type" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Jenis Pendidikan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_name" name="applicant_education_name" onChange="function_elements_add_education(this.name, this.value);" value="<?php echo $data_education['applicant_education_name'];?>">
			<label>Nama Pendidikan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_city" name="applicant_education_city" onChange="function_elements_add_education(this.name, this.value);" value="<?php echo $data_education['applicant_education_city'];?>">
			<label>Kota</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_from', $monthlist,set_value('education_month_from',$data_education['education_month_from']),'id="education_month_from" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Tahun Masuk</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_from', $year,set_value('education_year_from',$data_education['education_year_from']),'id="education_year_from" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_to', $monthlist,set_value('education_month_to',$data_education['education_month_to']),'id="education_month_to" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Tahun Lulus</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_to', $year,set_value('education_year_to',$data_education['education_year_to']),'id="education_year_to" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_education_duration" name="applicant_education_duration" onChange="function_elements_add_education(this.name, this.value);" value="<?php echo $data_education['applicant_education_duration'];?>">
			<label>Durasi</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_passed', $status,set_value('applicant_education_passed',$data_education['applicant_education_passed']),'id="applicant_education_passed" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Lulus</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_certificate', $status,set_value('applicant_education_certificate',$data_education['applicant_education_certificate']),'id="applicant_education_certificate" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Ijazah</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_education_remark" id="applicant_education_remark" class="form-control" onChange="function_elements_add_education(this.name, this.value);" ><?php echo $data_education['applicant_education_remark'];?></textarea>
			<label class="control-label">Keterangan Pendidikan</label>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantEducation" value="Reset" class="btn red" title="Reset" onClick="reset_add_education();">
		<input type="button" name="Add2" id="buttonAddArrayRecruitmentApplicantEducation" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayRecruitmentApplicantEducation();">
	</div>
</div>

<br>
<br>
<?php 
	$unique 						= $this->session->userdata('unique');
	$recruitmentapplicanteducation	= $this->session->userdata('addarrayrecruitmentapplicanteducation-'.$unique['unique']);
?>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Pendidikan</th>
									<th style='text-align:center' width="10%">Jenis Pendidikan</th>
									<th style='text-align:center' width="10%">Nama</th>
									<th style='text-align:center' width="10%">Kota</th>
									<th style='text-align:center' width="10%">Tahun Masuk</th>
									<th style='text-align:center' width="10%">Tahun Lulus</th>
									<th style='text-align:center' width="10%">Durasi</th>
									<th style='text-align:center' width="10%">Lulus</th>
									<th style='text-align:center' width="10%">Ijazah</th>
									<th style='text-align:center'>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicanteducation)){
									foreach($recruitmentapplicanteducation as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>".$no."</td>
												<td>".$this->RecruitmentApplicantData_model->getEducationName($val['education_id'])."</td>
												<td>".$educationtype[$val['applicant_education_type']]."</td>
												<td>".$val['applicant_education_name']."</td>
												<td>".$val['applicant_education_city']."</td>
												<td>".$val['applicant_education_from_period']."</td>
												<td>".$val['applicant_education_to_period']."</td>
												<td>".$val['applicant_education_duration']."</td>
												<td>".$status[$val['applicant_education_passed']]."</td>
												<td>".$status[$val['applicant_education_certificate']]."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteArrayRecruitmentApplicantEducation/'.$val['applicant_education_record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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
											<td colspan='12' style='text-align:center;'>
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

<br>
<br>
