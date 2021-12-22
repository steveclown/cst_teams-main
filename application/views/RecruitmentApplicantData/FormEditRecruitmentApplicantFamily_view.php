
<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_edit_family(){
		document.location = base_url+"RecruitmentApplicantData/reset_edit_family";
	}

	function function_elements_edit_family(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_edit_family');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
	
	
</script>
<?php
	echo form_open('RecruitmentApplicantData/processAddRecruitmentApplicantFamily', array('id' => 'myform', 'class' => 'horizontal-form')); 

	$this->session->userdata('message_family');
	$this->session->unset_userdata('message_family');
?>
<?php
	$unique			= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_family 	= $this->session->userdata('editrecruitmentapplicantfamily-'.$unique['unique']);	

	
	if (empty($data_family['applicant_family_date_of_birth']) || $data_family['applicant_family_date_of_birth']=="") {
		$data_family['applicant_family_date_of_birth'] = date('Y-m-d');
	}
	if (empty($data['family_relation_id'])) {
		$data['family_relation_id']="";
		# code...
	}
	if (empty($data['applicant_family_name'])) {
		$data['applicant_family_name']="";
		# code...
	}
	if (empty($data['applicant_family_address'])) {
		$data['applicant_family_address']=" ";
		# code...
	}
	if (empty($data['applicant_family_city'])) {
		$data['applicant_family_city']=" ";
	}
	if (empty($data['applicant_family_postal_code'])) {
		$data['applicant_family_postal_code']=" ";
	}
	if (empty($data['applicant_family_rt'])) {
		$data['applicant_family_rt']=" ";
	}
	if (empty($data['applicant_family_kelurahan'])) {
		$data['applicant_family_kelurahan']=" ";
	}
	if (empty($data['applicant_family_rw'])) {
		$data['applicant_family_rw']=" ";
	}
	if (empty($data['applicant_family_kecamatan'])) {
		$data['applicant_family_kecamatan']=" ";
	}
	if (empty($data['applicant_family_home_phone'])) {
		$data['applicant_family_home_phone']=" ";
	}
	if (empty($data['applicant_family_mobile_phone'])) {
		$data['applicant_family_mobile_phone']=" ";
	}
	if (empty($data['applicant_family_gender'])) {
		$data['applicant_family_gender']=" ";
	}
	if (empty($data['applicant_family_place_of_birth'])) {
		$data['applicant_family_place_of_birth']=" ";
	}
	if (empty($data['applicant_family_education'])) {
		$data['applicant_family_education']=" ";
	}
	if (empty($data['applicant_family_occupation'])) {
		$data['applicant_family_occupation']=" ";
	}
	if (empty($data['applicant_family_remark'])) {
		$data['applicant_family_remark']=" ";
	}
	if (empty($data['marital_status_id'])) {
		$data['marital_status_id']=" ";
	}
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('family_relation_id', $corefamilyrelation,set_value('family_relation_id', $data['family_relation_id']),'id="family_relation_id" class="form-control select2me" onChange="function_elements_edit_family(this.name, this.value);"');
			?>
			<label for="form-control">Hubungan Keluarga</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_family_name" name="applicant_family_name" onChange="function_elements_edit_family(this.name, this.value);" value="<?php echo $data['applicant_family_name'];?>">
			<label for = "form-control">Nama Keluarga</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_family_address" id="applicant_family_address" class="form-control" onChange="function_elements_edit_family(this.name, this.value);" ><?php echo $data['applicant_family_address'];?></textarea>
			<label class="control-label">Alamat</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_city" id="applicant_family_city" value="<?php echo $data['applicant_family_city']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_postal_code" id="applicant_family_postal_code" value="<?php echo $data['applicant_family_postal_code']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kode Pos </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_rt" id="applicant_family_rt" value="<?php echo $data['applicant_family_rt']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_rw" id="applicant_family_rw" value="<?php echo $data['applicant_family_rw']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_kelurahan" id="applicant_family_kelurahan" value="<?php echo $data['applicant_family_kelurahan']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_kecamatan" id="applicant_family_kecamatan" value="<?php echo $data['applicant_family_kecamatan']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_home_phone" id="applicant_family_home_phone" value="<?php echo $data['applicant_family_home_phone']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Telp Rumah </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_mobile_phone" id="applicant_family_mobile_phone" value="<?php echo $data['applicant_family_mobile_phone']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">No HP </label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_family_gender', $gender,set_value('applicant_family_gender',$data['applicant_family_gender']),'id="applicant_family_gender" class="form-control select2me" onChange="function_elements_edit_family(this.name, this.value);"');
			?>
			<label for="form-control">Jenis Kelamin Keluarga</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('marital_status_id', $coremaritalstatus,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id" class="form-control select2me" onChange="function_elements_edit_family(this.name, this.value);"');
			?>
			<label> Status Pernikahan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_family_date_of_birth" id="applicant_family_date_of_birth" onChange="function_elements_edit_family(this.name, this.value);" value="<?php echo tgltoview($data_family['applicant_family_date_of_birth']);?>"/>
			<label class="control-label">Tanggal Lahir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="applicant_family_place_of_birth" id="applicant_family_place_of_birth" value="<?php echo $data['applicant_family_place_of_birth']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);" >
			<label class="control-label">Tempat Lahir</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_family_education" name="applicant_family_education" onChange="function_elements_edit_family(this.name, this.value);" value="<?php echo $data['applicant_family_education'];?>" >
			<label for = "form-control">Pendidikan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="applicant_family_occupation" name="applicant_family_occupation" onChange="function_elements_edit_family(this.name, this.value);" value="<?php echo $data['applicant_family_occupation'];?>">
			<label for = "form-control">Pekerjaan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<label class="control-label"> Keterangan Keluarga</label>
			<textarea rows="3" name="applicant_family_remark" id="applicant_family_remark" class="form-control" onChange="function_elements_edit_family(this.name, this.value);" ><?php echo $data['applicant_family_remark'];?></textarea>
		</div>
	</div>

</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeFamily" value="Reset" class="btn red" title="Reset" onClick="reset_edit_family();">
		<input type="submit" name="Add2" id="buttonAddArrayHROEmployeeFamily" value="Add" class="btn green-jungle" title="Simpan Data" >
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
									<th style='text-align:center' width="5%">No</th>
									<th style='text-align:center' width="20%">Hubungan Keluarga </th>
									<th style='text-align:center' width="20%">Nama Keluarga </th>
									<th style='text-align:center' width="10%">Kota</th>
									<th style='text-align:center' width="20%">No HP</th>
									<th style='text-align:center' width="20%">Pendidikan</th>
									<th style='text-align:center' width="10%">Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($recruitmentapplicantfamily)){
									foreach($recruitmentapplicantfamily as $key => $val){
										echo"
											<tr class='odd gradeX'>
												<td>".$no."</td>
												<td>".$this->RecruitmentApplicantData_model->getFamilyRelationName($val['family_relation_id'])."</td>
												<td>".$val['applicant_family_name']."</td>
												<td>".$val['applicant_family_city']."</td>
												<td>".$val['applicant_family_mobile_phone']."</td>
												<td>".$val['applicant_family_education']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteRecruitmentApplicantFamily/'.$val['applicant_id'].'/'.$val['applicant_family_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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
											<td colspan='20' style='text-align:center;'>
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


<label></label>