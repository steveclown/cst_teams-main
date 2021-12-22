<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_accident(){
		document.location = base_url+"HroEmployeeEmploymentCkp/reset_add_accident/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_accident(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_elements_add_accident');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}
</script>
				
<?php 
	echo form_open('HroEmployeeEmploymentCkp/processAddHROEmployeeWorkAccident',array('id' => 'myform', 'class' => 'horizontal-form'));

	$unique 		= $this->session->userdata('unique');
	
	$dataaccident	= $this->session->userdata('addhroemployeeworkaccident-'.$unique['unique']);

?>
<?php 
	$year_now 	=	date('Y');
	if(!is_array($dataaccident)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 

	if ($dataaccident['employee_work_accident_date'] =" " || empty($dataaccident['employee_work_accident_date'])) {
		$dataaccident['employee_work_accident_date'] = date('Y-m-d');
		# code...
	}
	if(empty($dataaccident['work_accident_id'])){
		$dataaccident['work_accident_id']="";
	}
	if (empty($dataaccident['employee_work_accident_start_date'])) {
		$dataaccident['employee_work_accident_start_date']=date('Y-m-d');
		# code...
	}
	if(empty($dataaccident['employee_work_accident_end_date'])){
		$dataaccident['employee_work_accident_end_date']=date('Y-m-d');
	}
	if(empty($dataaccident['employee_work_accident_duration'])){
		$dataaccident['employee_work_accident_duration']="";
	}
	if(empty($dataaccident['employee_work_accident_reason'])){
		$dataaccident['employee_work_accident_reason']="";

	}
	if(empty($dataaccident['employee_work_accident_description'])){
		$dataaccident['employee_work_accident_description']="";
	}

?>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_work_accident_date" id="employee_work_accident_date" onChange="function_elements_add_accident(this.name, this.value);" value="<?php echo tgltoview($dataaccident['employee_work_accident_date']);?>">
			<label class="control-label">Tanggal Kecelakaan Kerja
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
	
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('work_accident_id', $dataaccident, set_value('work_accident_id', $dataaccident['work_accident_id']), 'id="work_accident_id" class="form-control select2me" onChange="function_elements_add_accident(this.name, this.value);"');
			?>
			<label class="control-label">Penyebab Kecelakaan </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_work_accident_start_date" id="employee_work_accident_start_date" onChange="function_elements_add_accident(this.name, this.value);" value="<?php echo tgltoview($dataaccident['employee_work_accident_start_date']);?>">
			<label class="control-label">Tanggal Mulai Kecelakaan Kerja
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_work_accident_end_date" id="employee_work_accident_end_date" onChange="function_elements_add_accident(this.name, this.value);" value="<?php echo tgltoview($dataaccident['employee_work_accident_end_date']);?>">
			<label class="control-label">Tanggal Selesai Kecelakaan Kerja
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
			<input type="text" name="employee_work_accident_description" id="employee_work_accident_description" value="<?php echo $dataaccident['employee_work_accident_description']?>" class="form-control" onChange="function_elements_add_accident(this.name, this.value);">
			<label class="control-label">Deskripsi</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="employee_work_accident_duration" id="employee_work_accident_duration" value="<?php echo $dataaccident['employee_work_accident_duration']?>" class="form-control" onChange="function_elements_add_accident(this.name, this.value);">
			<label class="control-label">Durasi</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_work_accident_reason" id="employee_work_accident_reason" class="form-control" onChange="function_elements_add_accident(this.name, this.value);"><?php echo $dataaccident['employee_work_accident_reason'];?></textarea>
			<label class="control-label">Alasan</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_accident();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
<?php echo form_close(); ?>
						

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th width = "15%">Tanggal Kecelakaan Kerja</th>
						<th width = "15%">Penyebab Kecelakaan </th>
						<th width = "20%">Deskripsi</th>
						<th width = "10%">Tanggal Mulai </th>
						<th width = "10%">Tanggal Selesai </th>
						<th width = "10%">Durasi</th>
						<th width = "20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if(!is_array($hroemployeeworkaccident)){
						echo "<tr><th colspan='6' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeworkaccident as $key=>$val){
							echo"
								<tr>
									<td>".$no."</td>
									<td>".tgltoview($val['employee_work_accident_date'])."</td>
									<td>".$val['work_accident_name']."</td>
									<td>".$val['employee_work_accident_description']."</td>
									<td>".tgltoview($val['employee_work_accident_start_date'])."</td>
									<td>".tgltoview($val['employee_work_accident_end_date'])."</td>
									<td>".$val['employee_work_accident_duration']."</td>
									<td>
										<a class='btn default btn-xs yellow' data-toggle='modal' href='#myModal' data-target='#detail-modal".$val['employee_work_accident_id']."' id='".$val['employee_work_accident_id']."'><i class='fa fa-pencil'></i> Detail
										</a>
										<a href='".$this->config->item('base_url').'HroEmployeeEmploymentCkp/deletePayrollLeaveRequest_Data/'.$val['employee_id']."/".$val['employee_work_accident_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
										</a>
									</td>
								</tr>
							";
						$no++;
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>
				
