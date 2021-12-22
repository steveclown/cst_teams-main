<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>

<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_edit_family(){
		document.location = base_url+"HroEmployeeDataCkp/reset_edit_family/<?php echo $HroEmployeeDataCkp['employee_id']?>";
	}

	function function_elements_edit_family(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeDataCkp/function_elements_edit_family');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	
</script>
							
<?php 
	echo $this->session->userdata('message_family');
	$this->session->unset_userdata('message_family');
?>		

<?php 
	echo form_open('HroEmployeeDataCkp/processAddHROEmployeeFamily',array('id' => 'myform', 'class' => 'horizontal-form')); 

	if (empty($data['employee_family_date_of_birth'])){
		$data['employee_family_date_of_birth'] = date("d-m-Y");
	}
	if (empty($data['family_relation_id'])) {
		$data['family_relation_id']="";
	}
	if (empty($data['employee_family_name'])) {
		$data['employee_family_name']="";
	}
	if (empty($data['employee_family_address'])) {
		$data['employee_family_address']="";
	}
	if (empty($data['employee_family_city'])) {
		$data['employee_family_city']="";
	}
	if (empty($data['employee_family_postal_code'])) {
		$data['employee_family_postal_code']="";
	}
	if (empty($data['employee_family_rt'])) {
		$data['employee_family_rt']="";
	}
	if (empty($data['employee_family_rw'])) {
		$data['employee_family_rw']="";
	}
	if (empty($data['employee_family_kelurahan'])) {
		$data['employee_family_kelurahan']="";
	}
	if (empty($data['employee_family_kecamatan'])) {
		$data['employee_family_kecamatan']="";
	}
	if (empty($data['employee_family_occupation'])) {
		$data['employee_family_occupation']="";
	}
	if (empty($data['employee_family_gender'])) {
		$data['employee_family_gender']="";
	}
	if (empty($data['employee_family_home_phone'])) {
		$data['employee_family_home_phone']="";
	}
	if (empty($data['employee_family_mobile_phone'])) {
		$data['employee_family_mobile_phone']="";
	}
	if (empty($data['family_marital_status_id'])) {
		$data['family_marital_status_id']="";
	}
	if (empty($data['employee_family_education'])) {
		$data['employee_family_education']="";
	}
	if (empty($data['employee_family_place_of_birth'])) {
		$data['employee_family_place_of_birth']="";
	}
	if (empty($data['employee_family_remark'])) {
		$data['employee_family_remark']="";
	}

?>					
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('family_relation_id', $corefamilyrelation ,set_value('family_relation_id', $data['family_relation_id']),'id="family_relation_id", class="form-control select2me" onChange="function_elements_edit_family(this.name, this.value);"');?>
			<label class="control-label">Hubungan Keluarga 
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_name" id="employee_family_name" value="<?php echo $data['employee_family_name']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Nama Keluarga 
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_family_address" id="employee_family_address" class="form-control" onChange="function_elements_edit_family(this.name, this.value);" ><?php echo $data['employee_family_address'];?></textarea>
			<label class="control-label">Alamat</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_city" id="employee_family_city" value="<?php echo $data['employee_family_city']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_postal_code" id="employee_family_postal_code" value="<?php echo $data['employee_family_postal_code']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kode Pos </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_rt" id="employee_family_rt" value="<?php echo $data['employee_family_rt']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">RT</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_rw" id="employee_family_rw" value="<?php echo $data['employee_family_rw']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">RW</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_kelurahan" id="employee_family_kelurahan" value="<?php echo $data['employee_family_kelurahan']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kelurahan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_kecamatan" id="employee_family_kecamatan" value="<?php echo $data['employee_family_kecamatan']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Kecamatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_home_phone" id="employee_family_home_phone" value="<?php echo $data['employee_family_home_phone']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Telp Rumah </label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_mobile_phone" id="employee_family_mobile_phone" value="<?php echo $data['employee_family_mobile_phone']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">No Hp</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_family_gender', $gender ,set_value('employee_family_gender',$data['employee_family_gender']),'id="employee_family_gender", class="form-control select2me" onChange="function_elements_edit_family(this.name, this.value);"');?>
			<label class="control-label">Jenis Kelamin</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('family_marital_status_id', $coremaritalstatus ,set_value('family_marital_status_id',$data['family_marital_status_id']),'id="family_marital_status_id", class="form-control select2me" onChange="function_elements_edit_family(this.name, this.value);"');?>
			<label class="control-label">Status Pernikahan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_family_date_of_birth" id="employee_family_date_of_birth" onChange="function_elements_edit_family(this.name, this.value);"  value="<?php echo tgltoview($data['employee_family_date_of_birth']);?>"/>
			<label class="control-label">Tanggal Lahir
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_place_of_birth" id="employee_family_place_of_birth" value="<?php echo $data['employee_family_place_of_birth']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);" >
			<label class="control-label">Tempat Lahir</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_education" id="employee_family_education" value="<?php echo $data['employee_family_education']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Pendidikan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_family_occupation" id="employee_family_occupation" value="<?php echo $data['employee_family_occupation']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">
			<label class="control-label">Pekerjaan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="5" name="employee_family_remark" id="employee_family_remark" class="form-control" onChange="function_elements_edit_family(this.name, this.value);"><?php echo $data['employee_family_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeFamily" value="Reset" class="btn red" title="Reset" onClick="reset_edit_family();">
		<input type="submit" name="Add2" id="buttonAddArrayHROEmployeeFamily" value="Add" class="btn green-jungle" title="Simpan Data" >
	</div>
</div>

<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $HroEmployeeDataCkp['employee_id']?>" class="form-control" onChange="function_elements_edit_family(this.name, this.value);">

<?php echo form_close(); ?>
<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Hubungan Keluarga</th>
						<th>Nama Keluarga </th>
						<th>Kota</th>
						<th>No Hp</th>
						<th>Pendidikan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!empty($hroemployeefamily)){
						foreach ($hroemployeefamily as $key => $val){
							echo"
								<tr>
									<td>".$val['family_relation_name']."</td>
									<td>".$val['employee_family_name']."</td>
									<td>".$val['employee_family_city']."</td>
									<td>".$val['employee_family_mobile_phone']."</td>
									<td>".$val['employee_family_education']."</td>
									<td>
									<a href='".$this->config->item('base_url').'HroEmployeeDataCkp/deleteHROEmployeeFamily/'.$HroEmployeeDataCkp['employee_id'].'/'.$val['employee_family_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
										<i class='fa fa-trash-o'></i> Hapus
									</a>";
									echo"
								</tr>
								
							";
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
				</tbody>
			</table>
		</div>
	</div>
</div>