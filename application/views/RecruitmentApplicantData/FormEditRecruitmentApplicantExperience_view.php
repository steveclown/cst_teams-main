<script>
	base_url = '<?php echo base_url();?>';

	
	function reset_edit_experience(){
		document.location = base_url+"RecruitmentApplicantData/reset_edit_experience";
	}

	function function_elements_edit_experience(name, value){
		$.ajax({
				type : "POST",
				url  : "<?php echo site_url('RecruitmentApplicantData/function_elements_edit_experience');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
</script>
<?php
	echo form_open('RecruitmentApplicantData/processAddRecruitmentApplicantExperience', array('id' => 'myform', 'class' => 'horizontal-form'));


	echo $this->session->userdata('message_experience');
	$this->session->unset_userdata('message_experience');

	$unique				= $this->session->userdata('unique');
	$auth				= $this->session->userdata('auth');
	$data_experience 	= $this->session->userdata('editrecruitmentapplicantexperience-'.$unique['unique']);	
	

	
	$year_now 	=	date('Y');
	if(!is_array($data_experience)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-50); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 

	if (empty($data_experience['work_month_from'])) {
		$data_experience['work_month_from']="";
		# code...
	}
	if (empty($data_experience['work_month_to'])) {
		$data_experience['work_month_to']="";
		# code...
	}
	if (empty($data_experience['work_year_from'])) {
		$data_experience['work_year_from']="";
		# code...
	}
	if (empty($data_experience['work_year_to'])) {
		$data_experience['work_year_to']="";
		# code...
	}
	if (empty($data_experience['experience_company_name'])) {
		$data_experience['experience_company_name']="";
		# code...
	}
	if (empty($data_experience['experience_company_address'])) {
		$data_experience['experience_company_address']="";
		# code...
	}
	if (empty($data_experience['experience_separation_letter'])) {
		$data_experience['experience_separation_letter']="";
		# code...
	}
	if (empty($data_experience['experience_remark'])) {
		$data_experience['experience_remark']="";
		# code...
	}
	if (empty($data_experience['experience_separation_reason'])) {
		$data_experience['experience_separation_reason']="";
		# code...
	}
	if (empty($data_experience['experience_job_title'])) {
		$data_experience['experience_job_title']="";
		# code...
	}
	if (empty($data_experience['experience_last_salary'])) {
		$data_experience['experience_last_salary']="";
		# code...
	}
?>
<div class="row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_month_from', $monthlist,set_value('work_month_from',$data_experience['work_month_from']),'id="work_month_from" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label>Dari Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_year_from', $year,set_value('work_year_from',$data_experience['work_year_from']),'id="work_year_from" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_month_to', $monthlist,set_value('work_month_to',$data_experience['work_month_to']),'id="work_month_to" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label>Sampai Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_year_to', $year,set_value('work_year_to',$data_experience['work_year_to']),'id="work_year_to" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_company_name" name="experience_company_name" onChange="function_elements_edit_experience(this.name, this.value);" value="<?php echo $data_experience['experience_company_name'];?>">
			<label>Nama Perusahaan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_company_address" id="experience_company_address" onChange="function_elements_edit_experience(this.name, this.value);" class="form-control" ><?php echo $data_experience['experience_company_address'];?></textarea>
			<label class="control-label">Alamat Perusahaan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_job_title" name="experience_job_title" onChange="function_elements_edit_experience(this.name, this.value);" value="<?php echo $data_experience['experience_job_title'];?>" >
			<label>Kerja Sebagai</label>
		</div>
	</div>	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="experience_last_salary" name="experience_last_salary" onChange="function_elements_edit_experience(this.name, this.value);" value="<?php echo $data_experience['experience_last_salary'];?>">
			<label>Gaji Terakhir </label>
		</div>
	</div>	
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_separation_reason" id="experience_separation_reason" class="form-control" onChange="function_elements_edit_experience(this.name, this.value);"><?php echo $data_experience['experience_separation_reason'];?></textarea>
			<label class="control-label">Alasan Keluar </label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('experience_separation_letter', $separationletter,set_value('experience_separation_letter',$data_experience['experience_separation_letter']),'id="experience_separation_letter" class="form-control select2me" onChange="function_elements_edit_experience(this.name, this.value);"');
			?>
			<label>Surat Plakerin</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="experience_remark" id="experience_remark" class="form-control" onChange="function_elements_edit_experience(this.name, this.value);"><?php echo $data_experience['experience_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantExperience" value="Reset" class="btn red" title="Reset" onClick="reset_edit_experience();">
		<input type="submit" name="Add2" id="buttonAddArrayRecruitmentApplicantExperience" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>

<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $RecruitmentApplicantData['applicant_id']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">

<?php echo form_close(); ?>
<br>
<br>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Nama Perusahaan</th>
									<th style='text-align:center' width="10%">Alamat</th>
									<th style='text-align:center' width="10%">Bagian</th>
									<th style='text-align:center' width="10%">Dari Tahun</th>
									<th style='text-align:center' width="10%">Sampai Tahun</th>
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
												<td>".$val['experience_remark']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteRecruitmentApplicantExperience/'.$val['applicant_id'].'/'.$val['applicant_experience_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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
