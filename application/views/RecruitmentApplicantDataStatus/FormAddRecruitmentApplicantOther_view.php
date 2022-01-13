<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('RecruitmentApplicantData/addRecruitmentApplicantData'); ?>";

	function function_elements_add_other(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_other');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}


	function reset_add_organization(){
		document.location = base_url+"RecruitmentApplicantData/reset_add_organization";
	}

	function function_elements_add_organization(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentApplicantData/function_elements_add_organization');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function processAddArrayRecruitmentApplicantOrganization(){
		var organization_name 		= document.getElementById("organization_name").value;
		var organization_type	 	= document.getElementById("organization_type").value;
		var organization_period 	= document.getElementById("organization_period").value;
		var organization_title		= document.getElementById("organization_title").value;
		var organization_status		= document.getElementById("organization_status").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentApplicantData/processAddArrayRecruitmentApplicantOrganization');?>",
			  data: {
					'organization_name' 	: organization_name, 
					'organization_type' 	: organization_type, 
					'organization_period' 	: organization_period, 
					'organization_title'	: organization_title,
					'organization_status' 	: organization_status, 
					'session_name' 			: "addarrayorganization-"
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
	$unique 		= $this->session->userdata('unique');
	$auth			= $this->session->userdata('auth');
	$data_other 	= $this->session->userdata('addrecruitmentapplicantother-'.$unique['unique']);	
	
	
	$status = array(
		'0'	=> 'No',
		'1'	=> 'Yes'
	);
	
	$year_now 	=	date('Y');
	if(!is_array($data_other)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
	
?>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_hobby" id="applicant_hobby" class="form-control" onChange="function_elements_add_other(this.name, this.value);" ><?php echo $data_other['applicant_hobby'];?></textarea>
			<label>Hobi</label>
		</div>
	</div>
</div>
<div class = "row">
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_hobby_active" id="applicant_hobby_active" class="form-control" onChange="function_elements_add_other(this.name, this.value);"><?php echo $data_other['applicant_hobby_active'];?></textarea>
			<label>Hobi yang masih aktif</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_reading_type" id="applicant_reading_type" class="form-control" onChange="function_elements_add_other(this.name, this.value);"><?php echo $data_other['applicant_reading_type'];?></textarea>
			<label>Jenis membaca</label>
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="applicant_good_book" id="applicant_good_book" class="form-control" onChange="function_elements_add_other(this.name, this.value);"><?php echo $data_other['applicant_good_book'];?></textarea>
			<label>Buku yang Disuka</label>
		</div>
	</div>
</div>

<?php
	$unique 							= $this->session->userdata('unique');
	$recruitmentapplicantorganization	= $this->session->userdata('addarrayrecruitmentapplicantorganization-'.$unique['unique']);
	$data_organization 					= $this->session->userdata('addrecruitmentapplicantorganization-'.$unique['unique']);	
?>

<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="organization_name" name="organization_name" onChange="function_elements_add_organization(this.name, this.value);" value="<?php echo $data_organization['organization_name'];?>">
			<label>Nama Organisasi</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('organization_type', $organizationtype,set_value('organization_type',$data_organization['organization_type']),'id="organization_type" class="form-control select2me" onChange="function_elements_add_organization(this.name, this.value);"');
			?>
			<label>Jenis Organisasi</label>
		</div>
	</div>
</div>
<div class="row">		
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('organization_period', $year,set_value('organization_period',$data_organization['organization_period']),'id="organization_period" class="form-control  select2me" onChange="function_elements_add_organization(this.name, this.value);"');
			?>
			<label>Periode</label>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="organization_title" name="organization_title" onChange="function_elements_add_organization(this.name, this.value);" value="<?php echo $data_organization['organization_title'];?>">
			<label>Jabatan</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('organization_status', $organizationstatus,set_value('organization_status',$data_organization['organization_status']),'id="organization_status" class="form-control  select2me" onChange="function_elements_add_organization(this.name, this.value);"');
			?>
			<label>Status</label>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayRecruitmentApplicantOrganization" value="Reset" class="btn red" title="Reset" onClick="reset_add_expertise();">
		<input type="button" name="Add2" id="buttonAddArrayRecruitmentApplicantOrganization" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayRecruitmentApplicantOrganization();">
	</div>
</div>
<br>
<br>


			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="25%">Name</th>
									<th style='text-align:center' width="10%">Jenis Organisasi</th>
									<th style='text-align:center' width="10%">Periode</th>
									<th style='text-align:center' width="20%">Jabatan</th>
									<th style='text-align:center' width="20%">Status</th>
									<th style='text-align:center' width="10%">Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php
							$no = 1;
								if(!empty($recruitmentapplicantorganization)){
									foreach($recruitmentapplicantorganization as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>".$no."</td>
												<td>".$val['organization_name']."</td>
												<td>".$organizationtype[$val['organization_type']]."</td>
												<td>".$val['organization_period']."</td>
												<td>".$val['organization_title']."</td>
												<td>".$organizationstatus[$val['organization_status']]."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'RecruitmentApplicantData/deleteArrayRecruitmentApplicantOrganization/'.$val['applicant_organization_record_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i>Hapus
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='6' style='text-align:center;'>
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