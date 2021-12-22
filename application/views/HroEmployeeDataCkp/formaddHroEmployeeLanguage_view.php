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

	function reset_add_language(){
		document.location = base_url+"HroEmployeeDataCkp/reset_add_language";
	}

	function function_elements_add_language(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeDataCkp/function_elements_add_language');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	function processAddArrayHROEmployeeLanguage(){

		var language_id						= document.getElementById("language_id").value;
		var employee_language_listen		= document.getElementById("employee_language_listen").value;
		var employee_language_read			= document.getElementById("employee_language_read").value;
		var employee_language_write			= document.getElementById("employee_language_write").value;
		var employee_language_speak			= document.getElementById("employee_language_speak").value;
		var employee_language_remark		= document.getElementById("employee_language_remark").value;
		

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('HroEmployeeDataCkp/processAddArrayHROEmployeeLanguage');?>",
			  data: {
					'language_id' 						: language_id,	
					'employee_language_listen'			: employee_language_listen,	
					'employee_language_read'			: employee_language_read,	
					'employee_language_write'			: employee_language_write,	
					'employee_language_speak'			: employee_language_speak,	
					'employee_language_remark'			: employee_language_remark,	
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
	$data 					= $this->session->userdata('addhroemployeelanguage-'.$unique['unique']);

	$hroemployeelanguage	= $this->session->userdata('addarrayhroemployeelanguage-'.$unique['unique']);
?>			

<?php 
	$year_now 	=	date('Y');
	if(!is_array($hroemployeelanguage)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 

	if (empty($data['language_id'])) {
		$data['language_id']=9;
	}
	if (empty($data['employee_language_listen'])) {
		$data['employee_language_listen']=9;
	}
	if (empty($data['employee_language_read'])) {
		$data['employee_language_read']=9;
	}
	if (empty($data['employee_language_write'])) {
		$data['employee_language_write']=9;
	}
	if (empty($data['employee_language_speak'])) {
		$data['employee_language_speak']=9;
	}
	if (empty($data['employee_language_remark'])) {
		$data['employee_language_remark']="";
	}
?>

<?php 
	echo $this->session->userdata('message_language');
	$this->session->unset_userdata('message_language');
?>	
									
<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('language_id', $corelanguage,set_value('language_id',$data['language_id']),'id="language_id" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label>Bahasa</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_listen', $listeningskill,set_value('employee_language_listen',$data['employee_language_listen']),'id="employee_language_listen" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Mendengar</label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_read', $readingskill,set_value('employee_language_read',$data['employee_language_read']),'id="employee_language_read" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Membaca</label>
		</div>
	</div>
</div>

<div class="row">	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_write', $writingskill,set_value('employee_language_write',$data['employee_language_write']),'id="employee_language_write" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Menulis </label>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('employee_language_speak', $speakingskill,set_value('employee_language_speak',$data['employee_language_speak']),'id="employee_language_speak" class="form-control select2me" onChange="function_elements_add_language(this.name, this.value);"');
			?>
			<label for="form-control">Kemampuan Berbicara </label>
		</div>
	</div>
</div>

<div class = "row">	
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_language_remark" id="employee_language_remark" class="form-control" onChange="function_elements_add_language(this.name, this.value);"><?php echo $data['employee_language_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>
								

<div class="row">
	<div class="col-md-12 " style="text-align  : right !important;">
		<input type="button" name="Reset" id="reset" value="Reset" class="btn red" title="Reset" onClick="reset_add_language();">
		<input type="button" name="Add2" id="buttonAddArrayHROEmployeeLanguage" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayHROEmployeeLanguage();">
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
						<th style='text-align:center' width="5%">No.</th>
						<th style='text-align:center' width="30%">Bahasa</th>
						<th style='text-align:center' width="15%">Mendengar</th>
						<th style='text-align:center' width="15%">Membaca </th>
						<th style='text-align:center' width="15%">Menulis </th>
						<th style='text-align:center' width="15%">Berbicara </th>
						<th style='text-align:center'>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;

					if(!empty($hroemployeelanguage)){
						foreach($hroemployeelanguage as $key => $val){
							echo"
								<tr class='odd gradeX'>
									<td style='text-align:center'>$no.</td>
									<td>".$this->HroEmployeeDataCkp_model->getLanguageName($val['language_id'])."</td>
									<td>".$listeningskill[$val['employee_language_listen']]."</td>
									<td>".$readingskill[$val['employee_language_read']]."</td>
									<td>".$writingskill[$val['employee_language_write']]."</td>
									<td>".$speakingskill[$val['employee_language_speak']]."</td>
									<td style='text-align  : center !important;'>
										<a href='".$this->config->item('base_url').'HroEmployeeDataCkp/deleteArrayHROEmployeeLanguage/'.$val['record_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
										</a>";
									echo "
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