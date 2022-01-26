
<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData/'); ?>";

	function reset_add_family(){
		document.location = base_url+"RecruitmentApplicantData/reset_add_family";
	}

	function function_elements_add_family(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_family');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	function processAddArrayRecruitmentApplicantFamily(){
		
		var family_relation_id 					= document.getElementById("family_relation_id").value;
		var applicant_family_name 				= document.getElementById("applicant_family_name").value;
		var applicant_family_address			= document.getElementById("applicant_family_address").value;
		var applicant_family_city				= document.getElementById("applicant_family_city").value;
		var applicant_family_postal_code		= document.getElementById("applicant_family_postal_code").value;
		var applicant_family_rt					= document.getElementById("applicant_family_rt").value;
		var applicant_family_rw					= document.getElementById("applicant_family_rw").value;
		var applicant_family_kelurahan			= document.getElementById("applicant_family_kelurahan").value;
		var applicant_family_kecamatan			= document.getElementById("applicant_family_kecamatan").value;
		var applicant_family_home_phone			= document.getElementById("applicant_family_home_phone").value;
		var applicant_family_mobile_phone		= document.getElementById("applicant_family_mobile_phone").value;
		var applicant_family_gender				= document.getElementById("applicant_family_gender").value;
		var applicant_family_date_of_birth		= document.getElementById("applicant_family_date_of_birth").value;
		var applicant_family_place_of_birth		= document.getElementById("applicant_family_place_of_birth").value;
		var applicant_family_education			= document.getElementById("applicant_family_education").value;
		var applicant_family_occupation			= document.getElementById("applicant_family_occupation").value;
		var marital_status_id_family			= document.getElementById("marital_status_id_family").value;
		var applicant_family_remark				= document.getElementById("applicant_family_remark").value;
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentApplicantData/processAddArrayRecruitmentApplicantFamily');?>",
			  data: {
						'family_relation_id' 				: family_relation_id, 
						'marital_status_id_family' 			: marital_status_id_family, 
						'applicant_family_name' 			: applicant_family_name, 
						'applicant_family_address'			: applicant_family_address,	
						'applicant_family_city'				: applicant_family_city,	
						'applicant_family_postal_code'		: applicant_family_postal_code,	
						'applicant_family_rt'				: applicant_family_rt,	
						'applicant_family_rw'				: applicant_family_rw,	
						'applicant_family_kelurahan'		: applicant_family_kelurahan,	
						'applicant_family_kecamatan'		: applicant_family_kecamatan,	
						'applicant_family_home_phone'		: applicant_family_home_phone,	
						'applicant_family_mobile_phone'		: applicant_family_mobile_phone,	
						'applicant_family_gender' 			: applicant_family_gender, 
						'applicant_family_date_of_birth'	: applicant_family_date_of_birth, 
						'applicant_family_place_of_birth'	: applicant_family_place_of_birth, 
						'applicant_family_education' 		: applicant_family_education, 
						'applicant_family_occupation' 		: applicant_family_occupation, 
						'applicant_family_remark' 			: applicant_family_remark, 
						'session_name' 						: "addarrayfamily-"
					},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
	
	
</script>
<?php
	$unique			= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_family 	= $this->session->userdata('addRecruitmentApplicantFamily-'.$unique['unique']);	

	if($data_family['applicant_family_date_of_birth'] == '' || empty($data_family['applicant_family_date_of_birth'])){
		$data_family['applicant_family_date_of_birth'] = date("Y-m-d");
	}

	if (empty($data_family['family_relation_id'])) {
		$data_family['family_relation_id']=" ";
		# code...
	}
	if (empty($data_family['applicant_family_name'])) {
		$data_family['applicant_family_name']=" ";
		# code...
	}
	if (empty($data_family['applicant_family_address'])) {
		$data_family['applicant_family_address']=" ";
		# code...
	}
	if (empty($data_family['applicant_family_city'])) {
		$data_family['applicant_family_city']=" ";
	}
	if (empty($data_family['applicant_family_postal_code'])) {
		$data_family['applicant_family_postal_code']=" ";
	}
	if (empty($data_family['applicant_family_rt'])) {
		$data_family['applicant_family_rt']=" ";
	}
	if (empty($data_family['applicant_family_kelurahan'])) {
		$data_family['applicant_family_kelurahan']=" ";
	}
	if (empty($data_family['applicant_family_rw'])) {
		$data_family['applicant_family_rw']=" ";
	}
	if (empty($data_family['applicant_family_kecamatan'])) {
		$data_family['applicant_family_kecamatan']=" ";
	}
	if (empty($data_family['applicant_family_home_phone'])) {
		$data_family['applicant_family_home_phone']=" ";
	}
	if (empty($data_family['applicant_family_mobile_phone'])) {
		$data_family['applicant_family_mobile_phone']=" ";
	}
	if (empty($data_family['applicant_family_gender'])) {
		$data_family['applicant_family_gender']=" ";
	}
	if (empty($data_family['applicant_family_place_of_birth'])) {
		$data_family['applicant_family_place_of_birth']=" ";
	}
	if (empty($data_family['applicant_family_education'])) {
		$data_family['applicant_family_education']=" ";
	}
	if (empty($data_family['applicant_family_occupation'])) {
		$data_family['applicant_family_occupation']=" ";
	}
	if (empty($data_family['applicant_family_remark'])) {
		$data_family['applicant_family_remark']=" ";
	}
	if (empty($data_family['marital_status_id'])) {
		$data_family['marital_status_id']=" ";
	}
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('family_relation_id', $corefamilyrelation,set_value('family_relation_id', $data_family['family_relation_id']),'id="family_relation_id" class="form-control select2me" onChange="function_elements_add_family(this.name, this.value);"');
			?>
			<label for="form-control">Hubungan Keluarga</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_name" name="applicant_family_name" onChange="function_elements_add_family(this.name, this.value);" value="<?php echo $data_family['applicant_family_name'];?>">
			<label for = "form-control">Nama Keluarga</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_family_address" id="applicant_family_address" class="form-control" onChange="function_elements_add_family(this.name, this.value);" ><?php echo $data_family['applicant_family_address'];?></textarea>
			<label class="control-label">Alamat</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_city" id="applicant_family_city" value="<?php echo $data_family['applicant_family_city']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_postal_code" id="applicant_family_postal_code" value="<?php echo $data_family['applicant_family_postal_code']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Kode Pos</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_rt" id="applicant_family_rt" value="<?php echo $data_family['applicant_family_rt']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_rw" id="applicant_family_rw" value="<?php echo $data_family['applicant_family_rw']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_kelurahan" id="applicant_family_kelurahan" value="<?php echo $data_family['applicant_family_kelurahan']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_kecamatan" id="applicant_family_kecamatan" value="<?php echo $data_family['applicant_family_kecamatan']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_home_phone" id="applicant_family_home_phone" value="<?php echo $data_family['applicant_family_home_phone']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">Telp Rumah</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_mobile_phone" id="applicant_family_mobile_phone" value="<?php echo $data_family['applicant_family_mobile_phone']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);">
			<label class="control-label">No HP</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('applicant_family_gender', $gender,set_value('applicant_family_gender',$data_family['applicant_family_gender']),'id="applicant_family_gender" class="form-control select2me" onChange="function_elements_add_family(this.name, this.value);"');
			?>
			<label for="form-control">Jenis kelamin</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('marital_status_id_family', $coremaritalstatus,set_value('marital_status_id',$data_family['marital_status_id']),'id="marital_status_id_family" class="form-control select2me" onChange="function_elements_add_family(this.name, this.value);"');
			?>
			<label>Status Pernikahan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="applicant_family_date_of_birth" id="applicant_family_date_of_birth" onChange="function_elements_add_family(this.name, this.value);" value="<?php echo tgltoview($data_family['applicant_family_date_of_birth']);?>"/>
			<label class="control-label">Tanggal Lahir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="applicant_family_place_of_birth" id="applicant_family_place_of_birth" value="<?php echo $data_family['applicant_family_place_of_birth']?>" class="form-control" onChange="function_elements_add_family(this.name, this.value);" >
			<label class="control-label">Tempat Lahir</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_education" name="applicant_family_education" onChange="function_elements_add_family(this.name, this.value);" value="<?php echo $data_family['applicant_family_education'];?>" >
			<label for = "form-control">Pendidikan</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_occupation" name="applicant_family_occupation" onChange="function_elements_add_family(this.name, this.value);" value="<?php echo $data_family['applicant_family_occupation'];?>">
			<label for = "form-control">Pekerjaan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-12 ">
		<div class="form-group form-md-line-input">
			<label class="control-label">Keterangan Keluarga</label>
			<textarea rows="3" name="applicant_family_remark" id="applicant_family_remark" class="form-control" onChange="function_elements_add_family(this.name, this.value);" ><?php echo $data_family['applicant_family_remark'];?></textarea>
		</div>
	</div>

</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantFamily" value="Reset" class="btn red" title="Reset" onClick="reset_add_family();">
		<input type="button" name="Add2" id="buttonAddArrayRecruitmentApplicantFamily" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayRecruitmentApplicantFamily();">
	</div>
</div>

<br>
<br>

<?php 
	$unique 					= $this->session->userdata('unique');
	$recruitmentapplicantfamily	= $this->session->userdata('addArrayRecruitmentApplicantFamily-'.$unique['unique']);
?>
<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No</th>
									<th style='text-align:center' width="20%">Hubungan Keluarga</th>
									<th style='text-align:center' width="20%">Nama Keluarga</th>
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
													<a href='".base_url().'RecruitmentApplicantData/deleteArrayRecruitmentApplicantFamily/'.$val['applicant_family_record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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