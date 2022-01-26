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

	function reset_add_expertise(){
		document.location = base_url+"HroEmployeeDataCkp/reset_add_expertise";
	}

	function function_elements_add_expertise(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeDataCkp/function_elements_add_expertise');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function processAddArrayHROEmployeeExpertise(){

		var expertise_id						= document.getElementById("expertise_id").value;
		var employee_expertise_name				= document.getElementById("employee_expertise_name").value;
		var employee_expertise_city				= document.getElementById("employee_expertise_city").value;
		var expertise_month_from				= document.getElementById("expertise_month_from").value;
		var expertise_year_from					= document.getElementById("expertise_year_from").value;
		var expertise_month_to					= document.getElementById("expertise_month_to").value;
		var expertise_year_to					= document.getElementById("expertise_year_to").value;
		var employee_expertise_duration			= document.getElementById("employee_expertise_duration").value;
		var employee_expertise_passed			= document.getElementById("employee_expertise_passed").value;
		var employee_expertise_certificate		= document.getElementById("employee_expertise_certificate").value;
		var employee_expertise_remark			= document.getElementById("employee_expertise_remark").value;
		
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('HroEmployeeDataCkp/processAddArrayHROEmployeeExpertise');?>",
			  data: {
					'expertise_id' 						: expertise_id,	
					'employee_expertise_name'			: employee_expertise_name,	
					'employee_expertise_city'			: employee_expertise_city,	
					'expertise_month_from'				: expertise_month_from,	
					'expertise_year_from'				: expertise_year_from,	
					'expertise_month_to'				: expertise_month_to,	
					'expertise_year_to'					: expertise_year_to,	
					'employee_expertise_duration'		: employee_expertise_duration,	
					'employee_expertise_passed'			: employee_expertise_passed,	
					'employee_expertise_certificate'	: employee_expertise_certificate,	
					'employee_expertise_remark'			: employee_expertise_remark,	
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
	$data 					= $this->session->userdata('addhroemployeeexpertise-'.$unique['unique']);

	$hroemployeeexpertise	= $this->session->userdata('addarrayhroemployeeexpertise-'.$unique['unique']);
?>			
								
<?php 
	$year_now 	=	date('Y');
	if(!is_array($hroemployeeexpertise)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

<?php 
	echo $this->session->userdata('message_expertise');
	$this->session->unset_userdata('message_expertise');
?>	


<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('expertise_id', $coreexpertise ,set_value('expertise_id',$data['expertise_id']),'id="expertise_id", class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');?>

			<label class="control-label">Keahlian
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
			<input type="text" autocomplete="off"  name="employee_expertise_name" id="employee_expertise_name" value="<?php echo $data['employee_expertise_name']?>" class="form-control" onChange="function_elements_add_expertise(this.name, this.value);">
			<label class="control-label">Nama Keahlian</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_expertise_city" id="employee_expertise_city" value="<?php echo $data['employee_expertise_city']?>" class="form-control" onChange="function_elements_add_expertise(this.name, this.value);">
			<label class="control-label">Kota</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_month_from', $monthlist,set_value('expertise_month_from',$data['expertise_month_from']),'id="expertise_month_from" class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');
			?>
			<label>Dari Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_year_from', $year,set_value('expertise_year_from',$data['expertise_year_from']),'id="expertise_year_from" class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_month_to', $monthlist,set_value('expertise_month_to',$data['expertise_month_to']),'id="expertise_month_to" class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');
			?>
			<label>Sampai Tahun</label>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('expertise_year_to', $year,set_value('expertise_year_to',$data['expertise_year_to']),'id="expertise_year_to" class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');
			?>
			<label></label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  name="employee_expertise_duration" id="employee_expertise_duration" value="<?php echo $data['employee_expertise_duration']?>" class="form-control" onChange="function_elements_add_expertise(this.name, this.value);">
			<label class="control-label">Durasi</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_expertise_passed', $status ,set_value('employee_expertise_passed',$data['employee_expertise_passed']),'id="employee_expertise_passed", class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');?>
			<label class="control-label">Lulus</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('employee_expertise_certificate', $status ,set_value('employee_expertise_certificate',$data['employee_expertise_certificate']),'id="employee_expertise_certificate", class="form-control select2me" onChange="function_elements_add_expertise(this.name, this.value);"');?>
			<label class="control-label">Sertifikat</label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_expertise_remark" id="employee_expertise_remark" class="form-control" onChange="function_elements_add_expertise(this.name, this.value);"><?php echo $data['employee_expertise_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="buttonAddArrayHROEmployeeExpertise" value="Reset" class="btn red" title="Reset" onClick="reset_add_expertise();">
		<input type="button" name="Add2" id="buttonAddArrayHROEmployeeExpertise" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayHROEmployeeExpertise();">
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
						<th style='text-align:center' width="10%">Keahlian</th>
						<th style='text-align:center' width="10%">Nama</th>
						<th style='text-align:center' width="10%">Kota</th>
						<th style='text-align:center' width="10%">Dari tahun</th>
						<th style='text-align:center' width="10%">Samapi Tahun</th>
						<th style='text-align:center' width="10%">Durasi</th>
						<th style='text-align:center' width="10%">Lulus</th>
						<th style='text-align:center' width="10%">Sertifikat</th>
						<th style='text-align:center'>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($hroemployeeexpertise)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Tidak Ada Data</th></tr>";
					} else {
						foreach ($hroemployeeexpertise as $key=>$val){
							echo"
								<tr>
									<td>".$this->HroEmployeeDataCkp_model->getExpertiseName($val['expertise_id'])."</td>
									<td>".$val['employee_expertise_name']."</td>
									<td>".$val['employee_expertise_city']."</td>
									<td>".$val['employee_expertise_from_period']."</td>
									<td>".$val['employee_expertise_to_period']."</td>
									<td>".$val['employee_expertise_duration']."</td>
									<td>".$status[$val['employee_expertise_passed']]."</td>
									<td>".$status[$val['employee_expertise_certificate']]."</td>
									<td>
									<a href='".$this->config->item('base_url').'HroEmployeeDataCkp/deleteArrayHROEmployeeExpertise/'.$val['record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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