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
			<input type="hidden" name="applicant_status" id="applicant_status" class="form-control" value="<?php echo $RecruitmentApplicantData['applicant_status'];?>" readonly>

			<input type="text" autocomplete="off"  name="" id="" class="form-control" value="<?php echo $statusapplicant[$RecruitmentApplicantData['applicant_status']];?>" readonly>
			
			<label class="control-label">Status Sekarang</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="hidden" name="applicant_application_date" id="applicant_application_date" class="form-control" value="<?php echo $RecruitmentApplicantData['applicant_application_date'];?>" readonly>

			<input name="applicant_status_date" id="applicant_status_date" type="text" class="form-control" value="<?php if (empty($RecruitmentApplicantData['applicant_status_date'])){
				echo date('d-m-Y');
			}else{
				echo tgltoview($RecruitmentApplicantData['applicant_status_date']);
			}?>" readonly>
				
			<label for="form-control">Tanggal Status Sekarang</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">

			<input name="applicant_status_remark_date" id="applicant_status_remark_date" type="text" class="form-control" value="<?php echo tgltoview($RecruitmentApplicantData['applicant_status_remark_date']);?>" readonly>
			<label for="form-control">Tanggal Hasil Status Sekarang</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">

			<textarea rows="3" name="" id="" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly><?php echo $RecruitmentApplicantData['applicant_status_remark'];?></textarea>
			
			<label class="control-label">Hasil Status Sekarang</label>
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
			<textarea rows="3" name="remark" id="remark" class="form-control"></textarea>
			<label for="form-control">Status Remark</label>
		</div>
	</div>
</div>

<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="15%">Nama Pelamar</th>
									<th style='text-align:center' width="15%">Status Awal</th>
									<th style='text-align:center' width="15%">Tanggal Status Awal</th>
									<th style='text-align:center' width="15%">Hasil</th>
									<th style='text-align:center' width="15%">Status Selanjutnya</th>
									<th style='text-align:center' width="30%">Tanggal Status Selanjutnya</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recordstatus)){
									foreach($recordstatus as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$val['applicant_name']."</td>
												<td>".$statusapplicant[$val['applicant_status']]."</td>
												<td>".tgltoview($val['applicant_status_date'])."</td>
												<td>".$val['applicant_status_remark']."</td>
												<td>".$statusapplicant[$val['applicant_status_next']]."</td>
												<td>".tgltoview($val['applicant_status_next_date'])."</td>
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

										