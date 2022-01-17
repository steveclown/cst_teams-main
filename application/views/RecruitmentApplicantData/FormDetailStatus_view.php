<script>
	mappia = "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";
</script>
<?php
	$sesi 	= $this->session->userdata('unique');
	$auth	= $this->session->userdata('auth');
	$data 	= $this->session->userdata('addRecruitmentApplicantData-'.$sesi['unique']);

	if (empty($data['applicant_status'])) {
		$data['applicant_status']="";
	}
?>
<!-- <?php echo '<pre>'; print_r($RecruitmentApplicantData); echo '</pre>'; ?> -->


<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="hidden" name="applicant_status" id="applicant_status" class="form-control" value="<?php echo tgltoview($RecruitmentApplicantData['applicant_status']);?>" readonly>

			<input type="text" name="" id="" class="form-control" value="<?php echo $statusapplicant[$RecruitmentApplicantData['applicant_status']];?>" readonly>
			
			<label class="control-label">Status Sekarang</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="hidden" name="applicant_application_date" id="applicant_application_date" class="form-control" value="<?php echo $RecruitmentApplicantData['applicant_application_date'];?>" readonly>

			<input name="applicant_status_date" id="applicant_status_date" type="text" class="form-control" value="<?php if (empty($RecruitmentApplicantData['applicant_status_date'])){
				echo date('d-m-Y');
			}else{
				echo $RecruitmentApplicantData['applicant_status_date'];
			}?>" readonly>
				
			<label for="form-control">Tanggal Status Sekarang</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">

			<textarea rows="3" name="applicant_status_remark" id="applicant_status_remark" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly><?php echo $RecruitmentApplicantData['applicant_status_remark'];?></textarea>
			
			<label class="control-label">Status Sekarang Remark</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">

			<input name="applicant_status_remark_date" id="applicant_status_remark_date" type="text" class="form-control" value="<?php echo tgltoview($RecruitmentApplicantData['applicant_status_remark_date']);?>" readonly>
			<label for="form-control">Tanggal Remark</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php 
				echo form_dropdown('applicant_status_next', $statusapplicant, set_value('applicant_status_next',$RecruitmentApplicantData['applicant_status_next']),'id="applicant_status_next", class="form-control select2me"');
			?>
				<label class="control-label">Status Selanjutnya</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_status_next_date" id="applicant_status_next_date" value="<?php echo date('d-m-Y');?>"/>

			<!-- <input name="applicant_status_next_date" id="applicant_status_next_date" type="text" class="form-control" value="<?php echo date('d-m-Y');?>" readonly> -->
			<label for="form-control">Tanggal Status Selanjutnya</label>
		</div>
	</div>

	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_status_remark" id="applicant_status_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $RecruitmentApplicantData['applicant_status_remark'];?></textarea>
			<label for="form-control">Status Remark</label>
		</div>
	</div>
</div>

										