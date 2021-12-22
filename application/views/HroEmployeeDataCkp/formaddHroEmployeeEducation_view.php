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
	mappia 		= "<?php echo site_url('HroEmployeeDataCkp/addHROEmployeeData'); ?>";

	function reset_add_education(){
		document.location = base_url+"HroEmployeeDataCkp/reset_add_education";
	}

	function function_elements_add_education(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeDataCkp/function_elements_add_education');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function processAddArrayHROEmployeeEducation(){
		
		var education_id						= document.getElementById("education_id").value;
		var employee_education_type				= document.getElementById("employee_education_type").value;
		var employee_education_name				= document.getElementById("employee_education_name").value;
		var employee_education_city				= document.getElementById("employee_education_city").value;
		var education_month_from				= document.getElementById("education_month_from").value;
		var education_year_from					= document.getElementById("education_year_from").value;
		var education_month_to					= document.getElementById("education_month_to").value;
		var education_year_to					= document.getElementById("education_year_to").value;
		var employee_education_duration			= document.getElementById("employee_education_duration").value;
		var employee_education_passed			= document.getElementById("employee_education_passed").value;
		var employee_education_certificate		= document.getElementById("employee_education_certificate").value;
		var employee_education_remark			= document.getElementById("employee_education_remark").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('HroEmployeeDataCkp/processAddArrayHROEmployeeEducation');?>",
			  data: {
					'education_id' 						: education_id,	
					'employee_education_type'			: employee_education_type,	
					'employee_education_name'			: employee_education_name,	
					'employee_education_city'			: employee_education_city,	
					'education_month_from'				: education_month_from,	
					'education_year_from'				: education_year_from,	
					'education_month_to'				: education_month_to,	
					'education_year_to'					: education_year_to,	
					'employee_education_duration'		: employee_education_duration,	
					'employee_education_passed'			: employee_education_passed,	
					'employee_education_certificate'	: employee_education_certificate,	
					'employee_education_remark'			: employee_education_remark,	
					'session_name' 						: "addarraypurchaseorderitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});

	}
</script>

					

<?php
	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addhroemployeeeducation-'.$unique['unique']);

	$hroemployeeeducation	= $this->session->userdata('addarrayhroemployeeeducation-'.$unique['unique']);
?>			
								
<?php 
	echo $this->session->userdata('message_education');
	$this->session->unset_userdata('message_education');

?>	
<?php 
	$year_now 	=	date('Y');
	if(!is_array($hroemployeeeducation)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>			
									
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('education_id', $coreeducation ,set_value('education_id',$data['education_id']),'id="education_id", class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');?>

			<label class="control-label">Pendidikan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_education_type', $educationtype ,set_value('employee_education_type',$data['employee_education_type']),'id="employee_education_type", class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');?>
			<label class="control-label">Jenis Pendidikan 
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_education_name" id="employee_education_name" value="<?php echo $data['employee_education_name']?>" class="form-control" onChange="function_elements_add_education(this.name, this.value);">
			<label class="control-label">Nama Pendidikan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_education_city" id="employee_education_city" value="<?php echo $data['employee_education_city']?>" class="form-control" onChange="function_elements_add_education(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_from', $monthlist,set_value('education_month_from',$data['education_month_from']),'id="education_month_from" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Dari Tahun </label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_from', $year,set_value('education_year_from',$data['education_year_from']),'id="education_year_from" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_month_to', $monthlist,set_value('education_month_to',$data['education_month_to']),'id="education_month_to" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label>Sampai Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('education_year_to', $year,set_value('education_year_to',$data['education_year_to']),'id="education_year_to" class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_education_duration" id="employee_education_duration" value="<?php echo $data['employee_education_duration']?>" class="form-control" onChange="function_elements_add_education(this.name, this.value);">
			<label class="control-label">Durasi</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_education_passed', $status ,set_value('employee_education_passed',$data['employee_education_passed']),'id="employee_education_passed", class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');?>
			<label class="control-label">Lulus</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_education_certificate', $status ,set_value('employee_education_certificate',$data['employee_education_certificate']),'id="employee_education_certificate", class="form-control select2me" onChange="function_elements_add_education(this.name, this.value);"');?>
			<label class="control-label">Ijazah</label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_education_remark" id="employee_education_remark" class="form-control" onChange="function_elements_add_education(this.name, this.value);"><?php echo $data['employee_education_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>
							
<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeEducation" value="Reset" class="btn red" title="Reset" onClick="reset_add_education();">
		<input type="button" name="Add2" id="buttonAddArrayHROEmployeeEducation" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayHROEmployeeEducation();">
	</div>
</div>

<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th style='text-align:center' width="10%">Pendidikan</th>
						<th style='text-align:center' width="10%">Jenis Pendidikan</th>
						<th style='text-align:center' width="10%">Nama</th>
						<th style='text-align:center' width="10%">Kota</th>
						<th style='text-align:center' width="10%">Dari tahun</th>
						<th style='text-align:center' width="10%">Sampai tahun</th>
						<th style='text-align:center' width="10%">Durasi</th>
						<th style='text-align:center' width="10%">Lulus</th>
						<th style='text-align:center' width="10%">Ijazah</th>
						<th style='text-align:center'>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeeducation)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Tidak Ada Data</th></tr>";
					} else {
						foreach ($hroemployeeeducation as $key=>$val){
							echo"
								<tr>
									<td>".$this->HroEmployeeDataCkp_model->getEducationName($val['education_id'])."</td>
									<td>".$educationtype[$val['employee_education_type']]."</td>
									<td>".$val['employee_education_name']."</td>
									<td>".$val['employee_education_city']."</td>
									<td>".$val['employee_education_from_period']."</td>
									<td>".$val['employee_education_to_period']."</td>
									<td>".$val['employee_education_duration']."</td>
									<td>".$status[$val['employee_education_passed']]."</td>
									<td>".$status[$val['employee_education_certificate']]."</td>
									<td>
									<a href='".$this->config->item('base_url').'HroEmployeeDataCkp/deleteArrayHROEmployeeEducation/'.$val['record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
										</a>";
									echo"
								</tr>
								
							";
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>