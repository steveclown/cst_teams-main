<script>
	base_url = '<?php echo base_url();?>';

	
	function reset_edit_education(){
		document.location = base_url+"RecruitmentApplicantData/reset_edit_education";
	}

	function function_elements_edit_education(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_edit_education');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
</script>
<?php 
 

	echo form_open('RecruitmentApplicantData/processAddRecruitmentApplicantEducation', array('id' => 'myform', 'class' => 'horizontal-form')); 

	$this->session->userdata('message_education');
	$this->session->unset_userdata('message_education');

	$unique 		= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_education = $this->session->userdata('editrecruitmentapplicanteducation-'.$unique['unique']);	

	$year_now 	=	date('Y');
	if(!is_array($data_education)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	}

	if(empty($data_education['education_id'])){
		$data_education['education_id'] = '';
	}

	if(empty($data_education['applicant_education_type'])){
		$data_education['applicant_education_type'] = '';
	}

	if(empty($data_education['applicant_education_name'])){
		$data_education['applicant_education_name'] = '';
	}

	if(empty($data_education['applicant_education_city'])){
		$data_education['applicant_education_city'] = '';
	}

	if(empty($data_education['education_month_from'])){
		$data_education['education_month_from'] = '';
	}

	if(empty($data_education['education_year_from'])){
		$data_education['education_year_from'] = '';
	}

	if(empty($data_education['education_month_to'])){
		$data_education['education_month_to'] = '';
	}

	if(empty($data_education['education_year_to'])){
		$data_education['education_year_to'] = '';
	}

	if(empty($data_education['applicant_education_duration'])){
		$data_education['applicant_education_duration'] = '';
	}

	if(empty($data_education['applicant_education_passed'])){
		$data_education['applicant_education_passed'] = '';
	}

	if(empty($data_education['applicant_education_certificate'])){
		$data_education['applicant_education_certificate'] = '';
	}

	if(empty($data_education['applicant_education_remark'])){
		$data_education['applicant_education_remark'] = '';
	}
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_id', $coreeducation,set_value('education_id',$data_education['education_id']),'id="education_id" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>Pendidikan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_type', $educationtype,set_value('applicant_education_type',$data_education['applicant_education_type']),'id="applicant_education_type" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>Jenis Pendidikan </label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_education_name" name="applicant_education_name" onChange="function_elements_edit_education(this.name, this.value);" value="<?php echo $data_education['applicant_education_name'];?>">
			<label>Nama Pendidikan </label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_education_city" name="applicant_education_city" onChange="function_elements_edit_education(this.name, this.value);" value="<?php echo $data_education['applicant_education_city'];?>">
			<label>Kota</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_from', $monthlist,set_value('education_month_from',$data_education['education_month_from']),'id="education_month_from" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>Dari Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_from', $year,set_value('education_year_from',$data_education['education_year_from']),'id="education_year_from" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_to', $monthlist,set_value('education_month_to',$data_education['education_month_to']),'id="education_month_to" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>Sampai Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_to', $year,set_value('education_year_to',$data_education['education_year_to']),'id="education_year_to" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_education_duration" name="applicant_education_duration" onChange="function_elements_edit_education(this.name, this.value);" value="<?php echo $data_education['applicant_education_duration'];?>">
			<label>Durasi</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_passed', $status,set_value('applicant_education_passed',$data_education['applicant_education_passed']),'id="applicant_education_passed" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>Lulus</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_education_certificate', $status,set_value('applicant_education_certificate',$data_education['applicant_education_certificate']),'id="applicant_education_certificate" class="form-control select2me" onChange="function_elements_edit_education(this.name, this.value);"');
			?>
			<label>Ijazah</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_education_remark" id="applicant_education_remark" class="form-control" onChange="function_elements_edit_education(this.name, this.value);" ><?php echo $data_education['applicant_education_remark'];?></textarea>
			<label class="control-label">Keterangan Pendidikan</label>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantEducation" value="Reset" class="btn red" title="Reset" onClick="reset_edit_education();">
		<input type="submit" name="Add2" id="buttonAddArrayRecruitmentApplicantEducation" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>
<input type="hidden" name="applicant_id" id="applicant_id" value="<?php echo $RecruitmentApplicantData['applicant_id']?>" class="form-control" onChange="function_elements_edit_education(this.name, this.value);">

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
									<th style='text-align:center' width="10%">Pendidikan</th>
									<th style='text-align:center' width="10%">Jenis</th>
									<th style='text-align:center' width="10%">Nama</th>
									<th style='text-align:center' width="10%">Kota</th>
									<th style='text-align:center' width="10%">Tahun Masuk</th>
									<th style='text-align:center' width="10%"> Tahun Lulus</th>
									<th style='text-align:center' width="10%">Durasi</th>
									<th style='text-align:center' width="10%">Lulus</th>
									<th style='text-align:center' width="10%">Ijazah</th>
									<th style='text-align:center'>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								// print_r("data education");
								// print_r($recruitmentapplicanteducation);
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

												<td>
													<a href='".$this->config->item('base_url').'RecruitmentApplicantData/deleteRecruitmentApplicantEducation/'.$val['applicant_id'].'/'.$val['applicant_education_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> hapus
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
