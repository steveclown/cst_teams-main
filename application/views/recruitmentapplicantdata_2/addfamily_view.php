<script>
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
	
	function formaddarrayfamily(){
		var family_status_id 					= document.getElementById("family_status_id").value;
		var applicant_family_name 				= document.getElementById("applicant_family_name").value;
		var applicant_family_address			= document.getElementById("applicant_family_address").value;
		var applicant_family_city				= document.getElementById("applicant_family_city").value;
		var applicant_family_zip_code			= document.getElementById("applicant_family_zip_code").value;
		var applicant_family_rt					= document.getElementById("applicant_family_rt").value;
		var applicant_family_rw					= document.getElementById("applicant_family_rw").value;
		var applicant_family_kecamatan			= document.getElementById("applicant_family_kecamatan").value;
		var applicant_family_kelurahan			= document.getElementById("applicant_family_kelurahan").value;
		var applicant_family_home_phone			= document.getElementById("applicant_family_home_phone").value;
		var applicant_family_mobile_phone1		= document.getElementById("applicant_family_mobile_phone1").value;
		var applicant_family_mobile_phone2		= document.getElementById("applicant_family_mobile_phone2").value;
		var applicant_family_gender				= document.getElementById("applicant_family_gender").value;
		var applicant_family_date_of_birth		= document.getElementById("applicant_family_date_of_birth").value;
		var applicant_family_education			= document.getElementById("applicant_family_education").value;
		var applicant_family_occupation			= document.getElementById("applicant_family_occupation").value;
		var marital_status_id					= document.getElementById("marital_status_id").value;
		var applicant_family_remark				= document.getElementById("applicant_family_remark").value;
		
		
		$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('transactionalapplicantdata/addarrayfamily');?>",
			  data: {'family_status_id' : family_status_id, 'applicant_family_name' : applicant_family_name, 'applicant_family_address' : applicant_family_address, 'applicant_family_city':applicant_family_city,
			  'applicant_family_zip_code' :applicant_family_zip_code, 'applicant_family_rt' : applicant_family_rt, 'applicant_family_rw' : applicant_family_rw,
			  'applicant_family_kecamatan' : applicant_family_kecamatan, 'applicant_family_kelurahan' : applicant_family_kelurahan, 'applicant_family_home_phone' : applicant_family_home_phone,
			  'applicant_family_mobile_phone1' : applicant_family_mobile_phone1,'applicant_family_mobile_phone2' : applicant_family_mobile_phone2,'applicant_family_gender' : applicant_family_gender,
			  'applicant_family_date_of_birth' : applicant_family_date_of_birth,'applicant_family_education' : applicant_family_education,'applicant_family_occupation' : applicant_family_occupation,
			  'marital_status_id' : marital_status_id,'applicant_family_remark' : applicant_family_remark,'session_name' : "addarrayfamily-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace("<?php echo site_url('transactionalapplicantdata/add'); ?>");
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
	
?>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Family Status</label>
			<?php
				echo form_dropdown('family_status_id', $familystatus,set_value('family_status_id',$data['family_status_id']),'id="family_status_id" class="form-control"');
			?>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Name</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_name" name="applicant_family_name" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_name'];?>" placeholder="Name">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Address</label>
			<textarea rows="3" name="applicant_family_address" id="applicant_family_address" class="form-control" placeholder="Remark"><?php echo $data['applicant_family_address'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>City</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_city" name="applicant_family_city" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_city'];?>" placeholder="City">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>ZIP Code</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_zip_code" name="applicant_family_zip_code" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_zip_code'];?>" placeholder="ZIP Code">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>RT</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_rt" name="applicant_family_rt" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_rt'];?>" placeholder="RT">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>RW</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_rw" name="applicant_family_rw" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_rw'];?>" placeholder="RW">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kelurahan</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_kelurahan" name="applicant_family_kelurahan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_kelurahan'];?>" placeholder="Kelurahan">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Kecamatan</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_kecamatan" name="applicant_family_kecamatan" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_kecamatan'];?>" placeholder="Kecamatan">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Home Phone</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_home_phone" name="applicant_family_home_phone" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_home_phone'];?>" placeholder="Home Phone">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Mobile Phone 1</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_mobile_phone1" name="applicant_family_mobile_phone1" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_mobile_phone1'];?>" placeholder="Mobile Phone">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Mobile Phone 2</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_mobile_phone2" name="applicant_family_mobile_phone2" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_mobile_phone2'];?>" placeholder="Mobile Phone 2">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Gender</label>
			<?php
				echo form_dropdown('applicant_family_gender', $gender,set_value('applicant_family_gender',$data['applicant_family_gender']),'id="applicant_family_gender" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label">Date of Birth</label>
			<div class="input-group">
				<input name="applicant_family_date_of_birth" id="applicant_family_date_of_birth" type="text" class="form-control" value="<?php if (empty($data['applicant_family_date_of_birth'])){
					echo date('d-m-Y');
				}else{
					echo $parent['applicant_family_date_of_birth'];
				}?>" readonly>
				<span class="input-group-btn">
					<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Place of Bhirth</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_place_of_birth" name="applicant_family_place_of_birth" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_place_of_birth'];?>" placeholder="Place of Bhirth">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label>Education</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_education" name="applicant_family_education" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_education'];?>" placeholder="Education">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Ocupation</label>
			<input type="text" autocomplete="off"  class="form-control" id="applicant_family_occupation" name="applicant_family_occupation" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['applicant_family_occupation'];?>" placeholder="Ocupation">
		</div>
	</div>
</div>
<div class="row">	
	<div class="col-md-6">
		<div class="form-group">
			<label>Marital Status</label>
			<?php
				echo form_dropdown('marital_status_id', $marital,set_value('marital_status_id',$data['marital_status_id']),'id="marital_status_id" class="form-control"');
			?>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 ">
		<div class="form-group">
			<label class="control-label">Remark</label>
			<textarea rows="3" name="applicant_family_remark" id="applicant_family_remark" class="form-control" placeholder="Remark"><?php echo $data['applicant_family_remark'];?></textarea>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12" style='text-align:right'>
		<input type="reset" name="Reset" value="Cancel" class="btn btn-danger" onClick="reset_all();">
		<input type="submit" name="add2" id="add2" value="Add" class="btn blue" title="Simpan Data" onClick="formaddarrayfamily();">
	</div>
</div>
<?php echo form_close(); ?>
<?php 
	$sesi 	= $this->session->userdata('unique');
	$family	= $this->session->userdata('addarrayfamily-'.$sesi['unique']);
?>
<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No.</th>
									<th style='text-align:center' width="10%">Status KK</th>
									<th style='text-align:center' width="10%">Name</th>
									<th style='text-align:center' width="10%">Address</th>
									<th style='text-align:center' width="10%">City</th>
									<th style='text-align:center' width="10%">ZIP Code</th>
									<th style='text-align:center' width="10%">RT</th>
									<th style='text-align:center' width="10%">RW</th>
									<th style='text-align:center' width="10%">Kecamatan</th>
									<th style='text-align:center' width="10%">Kelurahan</th>
									<th style='text-align:center' width="10%">Home Phone</th>
									<th style='text-align:center' width="10%">HP 1</th>
									<th style='text-align:center' width="10%">HP 2</th>
									<th style='text-align:center' width="10%">Tgl Lahir</th>
									<th style='text-align:center' width="10%">Tempat Lahir</th>
									<th style='text-align:center' width="10%">Pendidikan</th>
									<th style='text-align:center' width="10%">Pekerjaan</th>
									<th style='text-align:center' width="10%">Status</th>
									<th style='text-align:center' width="10%">Remark</th>
									<th style='text-align:center'>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($family)){
									foreach($family as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->transactionalapplicantdata_model->getfamilystatusname($val['family_status_id'])."</td>
												<td>".$val[applicant_family_name]."</td>
												<td>".$val[applicant_family_address]."</td>
												<td>".$val[applicant_family_city]."</td>
												<td>".$val[applicant_family_zip_code]."</td>
												<td>".$val[applicant_family_rt]."</td>
												<td>".$val[applicant_family_rw]."</td>
												<td>".$val[applicant_family_kecamatan]."</td>
												<td>".$val[applicant_family_kelurahan]."</td>
												<td>".$val[applicant_family_home_phone]."</td>
												<td>".$val[applicant_family_mobile_phone1]."</td>
												<td>".$val[applicant_family_mobile_phone2]."</td>
												<td>".$this->configuration->Gender[$val[applicant_family_gender]]."</td>
												<td>".tgltoview($val[applicant_family_date_of_birth])."</td>
												<td>".$val[applicant_family_place_of_birth]."</td>
												<td>".$val[applicant_family_education]."</td>
												<td>".$val[applicant_family_occupation]."</td>
												<td>".$this->transactionalapplicantdata_model->getmaritalstatusname($val['marital_status_id'])."</td>
												<td>".$val[applicant_family_remark]."</td>
												<td>";
												?>															
													<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php echo $val[family_status_id].'-'.$val[applicant_family_name].'-'.$val[applicant_family_address]
													.'-'.$val[applicant_family_city].'-'.$val[applicant_family_zip_code].'-'.$val[applicant_family_rt].'-'.$val[applicant_family_rw]
													.'-'.$val[applicant_family_kecamatan].'-'.$val[applicant_family_kelurahan].'-'.$val[applicant_family_home_phone].'-'.$val[applicant_family_mobile_phone1].'-'.$val[applicant_family_mobile_phone2]
													.'-'.$val[applicant_family_gender].'-'.$val[applicant_family_date_of_birth].'-'.$val[applicant_family_place_of_birth].'-'.$val[applicant_family_education].'-'.$val[applicant_family_occupation]
													.'-'.$val[marital_status_id].'-'.$val[applicant_family_remark]; ?>","addarrayfamilyapplicant-");'>
															<i class='fa fa-trash-o'></i> Delete </button>
													<?php
												echo"
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='20' style='text-align:center;'>
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


<label></label>