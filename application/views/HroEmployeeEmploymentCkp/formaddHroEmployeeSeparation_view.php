<script>
	base_url = '<?php echo base_url()?>';
	
	function reset_add_separation(){
		document.location = base_url+"HroEmployeeEmploymentCkp/reset_add_separation";
	}

	function function_elements_add_separation(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_elements_add_separation');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}
</script>

<?php 
	echo form_open('HroEmployeeEmploymentCkp/processAddHROEmployeeSeparation',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	
	$dataseparation	= $this->session->userdata('addhroemployeeseparation-'.$unique['unique']);

	if (empty($dataseparation['employee_separation_date'])) {
		$dataseparation['employee_separation_date']= date("Y-m-d");
	}
	if (empty($dataseparation['separation_reason_id'])) {
		$dataseparation['separation_reason_id']="";
	}
	if (empty($dataseparation['employee_separation_remark'])){
		$dataseparation['employee_separation_remark']="";
	}
	if (empty($dataseparation['employee_separation_description'])){
		$dataseparation['employee_separation_description']="";
	}
	 // print_r($dataseparation); exit;
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_separation_date" id="employee_separation_date" onChange="function_elements_add_separation(this.name, this.value);" value="<?php echo tgltoview($dataseparation['employee_separation_date']);?>"/>
			
			<label class="control-label">Tanggal Pemisahan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('separation_reason_id', $coreseparationreason ,set_value('separation_reason_id', $dataseparation['separation_reason_id']), 'id="separation_reason_id", class="form-control select2me" onChange="function_elements_add_separation(this.name, this.value);" onChange="function_elements_add_separation(this.name, this.value);"');?>
			<label class="control-label">Nama Alasan Pemisahan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_separation_description" name="employee_separation_description" onChange="function_elements_add_separation(this.name, this.value);" value="<?php echo $dataseparation['employee_separation_description'];?>">
			<label class="control-label">Deskripsi Pemisahan </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_separation_remark" id="employee_separation_remark" onChange="function_elements_add_separation(this.name, this.value);" class="form-control"><?php echo $dataseparation['employee_separation_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Batal</button>
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
						<th width = "15%">Tanggal Pemisahan</th>
						<th width = "15%">Nama Alasan Pemisahan</th>
						<th width = "20%">Deskripsi Pemisahan</th>
						<th width = "20%">Keterangan</th>
						<th width = "20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if(!is_array($hroemployeeseparation)){
						echo "<tr><th colspan='5' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($hroemployeeseparation as $key=>$val){
							echo"
								<tr>
									<td>".$no."</td>
									<td>".tgltoview($val['employee_separation_date'])."</td>
									<td>".$val['separation_reason_name']."</td>
									<td>".$val['employee_separation_description']."</td>
									<td>".$val['employee_separation_remark']."</td>
									<td>
										<a href='".$this->config->item('base_url').'HroEmployeeEmploymentCkp/deleteHROEmployeeSeparation/'.$val['employee_id']."/".$val['employee_separation_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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