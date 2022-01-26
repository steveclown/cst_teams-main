<script>
	function reset_add_award(){
		document.location = base_url+"HroEmployeeEmploymentCkp/reset_add_award/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_award(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_elements_add_award');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}
</script>
			
<?php 
	echo form_open('HroEmployeeEmploymentCkp/processAddHROEmployeeAward',array('id' => 'myform', 'class' => 'horizontal-form')); 

	$unique 	= $this->session->userdata('unique');

	$dataaward	= $this->session->userdata('addhroemployeeaward-'.$unique['unique']);

	if (empty($dataaward)){
		$dataaward['employee_award_date']	 		= date("Y-m-d");
	}
	if(empty($dataaward['award_id'])){
		$dataaward['award_id']="";
	}
	if(empty($dataaward['employee_award_description'])){
		$dataaward['employee_award_description']="";
	}

	if(empty($dataaward['employee_award_remark'])){
		$dataaward['employee_award_remark']="";
	}
?>
<div class = "row">		
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_award_date" id="employee_award_date" onChange="function_elements_add_award(this.name, this.value);" value="<?php echo tgltoview($dataaward['employee_award_date']);?>"/>
			<label class="control-label">Tanggal Perhargaan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('award_id', $coreaward ,set_value('award_id',$dataaward['award_id']),'id="award_id", class="form-control select2me" onChange="function_elements_add_award(this.name, this.value);" onChange="function_elements_add_award(this.name, this.value);"');?>
			<label class="control-label">Nama Perhargaan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<input type="text" autocomplete="off"  class="form-control" id="employee_award_description" name="employee_award_description" onChange="function_elements_add_award(this.name, this.value);" value="<?php echo $dataaward['employee_award_description'];?>">
			<label class="control-label">Deskripsi Perhargaan  </label>
		</div>	
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="employee_award_remark" id="employee_award_remark" onChange="function_elements_add_award(this.name, this.value);" class="form-control"><?php echo $dataaward['employee_award_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_award();"><i class="fa fa-times"></i> Reset</button>
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
						<th width = "5%">No </th>
						<th width = "15%">Tanggal Perhargaan </th>
						<th width = "15%">Nama Perhargaan </th>
						<th width = "20%">Deskripsi Perhargaan</th>
						<th width = "20%">Keterangan </th>
						<th width = "20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if(!is_array($hroemployeeaward)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Tidak Ada Data</th></tr>";
					} else {
						foreach ($hroemployeeaward as $key=>$val){
							echo"
								<tr>
									<td>".$no."</td>
									<td>".tgltoview($val['employee_award_date'])."</td>
									<td>".$val['award_name']."</td>
									<td>".$val['employee_award_description']."</td>
									<td>".$val['employee_award_remark']."</td>
									<td>
										<a href='".$this->config->item('base_url').'HroEmployeeEmploymentCkp/deleteHROEmployeeAward/'.$val['employee_id']."/".$val['employee_award_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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