<script>
	function reset_add_warning(){
		document.location = base_url+"HroEmployeeEmploymentCkp/reset_add_warning";
	}

	function function_elements_add_warning(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_elements_add_warning');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}
</script>

<?php 
	echo form_open('HroEmployeeEmploymentCkp/processAddHROEmployeeWarning',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 		= $this->session->userdata('unique');
	
	$datawarning	= $this->session->userdata('addhroemployeewarning-'.$unique['unique']);

	if (empty($datawarning)){
		$datawarning['employee_warning_date']	 		= date("Y-m-d");
	}

	if(empty($datawarning['warning_id'])){
		$datawarning['warning_id']="";
	}
	if(empty($datawarning['employee_warning_description'])){
		$datawarning['employee_warning_description']="";
	}
	if(empty($datawarning['employee_warning_remark'])){
		$datawarning['employee_warning_remark']="";
	}
	// print_r($datawarning); exit;

?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_warning_date" id="employee_warning_date" onChange="function_elements_add_warning(this.name, this.value);" value="<?php echo tgltoview($datawarning['employee_warning_date']);?>"/>
			<label class="control-label">Tanggal peringatan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('warning_id', $corewarning ,set_value('warning_id',$datawarning['warning_id']),'id="warning_id", class="form-control select2me" onChange="function_elements_add_warning(this.name, this.value);" onChange="function_elements_add_warning(this.name, this.value);"');?>
			<label class="control-label">Nama peringatan </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" class="form-control" id="employee_warning_description" name="employee_warning_description" onChange="function_elements_add_warning(this.name, this.value);" value="<?php echo $datawarning['employee_warning_description'];?>">
			<label class="control-label">Deskripsi peringatan  </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_warning_remark" id="employee_warning_remark" onChange="function_elements_add_warning(this.name, this.value);" class="form-control"><?php echo $datawarning['employee_warning_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_warning();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
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
						<th width = "15%">Warning Date</th>
						<th width = "15%">Warning Name</th>
						<th width = "20%">Warning Description</th>
						<th width = "20%">Warning Remark</th>
						<th width = "20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if(!is_array($hroemployeewarning)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Tidak Ada Data</th></tr>";
					} else {
						foreach ($hroemployeewarning as $key => $val){
							echo"
								<tr>
									<td>".$no."</td>
									<td>".tgltoview($val['employee_warning_date'])."</td>
									<td>".$val['warning_name']."</td>
									<td>".$val['employee_warning_description']."</td>
									<td>".$val['employee_warning_remark']."</td>
									<td>
										<a href='".$this->config->item('base_url').'HroEmployeeEmploymentCkp/deleteHROEmployeeWarning/'.$val['employee_id']."/".$val['employee_warning_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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