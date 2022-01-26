<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('ScheduleShiftPattern/addScheduleShiftPattern'); ?>";

	function reset_all(){
		document.location= base_url+"ScheduleShiftPattern/resetitem";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleShiftPattern/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleShiftPattern/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

    function processAddArrayScheduleShiftPattern(){
		var shift_id 				= document.getElementById("shift_id").value;
		var employee_shift_id 		= document.getElementById("employee_shift_id").value;

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('ScheduleShiftPattern/processAddArrayScheduleShiftPattern');?>",
			  data: { 
					'shift_id' 					: shift_id,
					'employee_shift_id'			: employee_shift_id, 
					'session_name' 				: "addarrayScheduleShiftPatternitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
</script>

<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleShiftPattern">Pola Shift </a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleShiftPattern/addScheduleShiftPattern">Tambah Pola Shift </a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Tambah Pola Shift 
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->		

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Tambah
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleShiftPattern/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('ScheduleShiftPattern/processAddScheduleShiftPattern',array('class' => 'horizontal-form')); 
						$unique 	= $this->session->userdata('unique');
						$data 		= $this->session->userdata('addScheduleShiftPattern-'.$unique['unique']);
						$ScheduleShiftPattern_item	= $this->session->userdata('addarrayScheduleShiftPatternitem-'.$unique['unique']);
					

						if (empty($data['shift_pattern_code'])) {
							$data['shift_pattern_code']='';
							
						}
						if (empty($data['shift_pattern_name'])) {
						$data['shift_pattern_name']='';
					
						}
						if (empty($data['shift_pattern_weekly'])) {
						$data['shift_pattern_weekly']='';
					
						}
						if (empty($data['shift_pattern_cycle'])) {
						$data['shift_pattern_cycle']='';
					
						}
						if (empty($data['shift_pattern_day'])) {
						$data['shift_pattern_day']='';
					
						}
						if (empty($data['shift_id'])) {
						$data['shift_id']=0;
					
						}
						if (empty($data['employee_shift_id'])) {
						$data['employee_shift_id']=0;
					
						}
					?>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input type="text" autocomplete="off"  name="shift_pattern_code" id="shift_pattern_code" value="<?php echo $data['shift_pattern_code']; ?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Kode Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="shift_pattern_name" id="shift_pattern_name" class="form-control" value="<?php echo $data['shift_pattern_name']; ?>" onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Nama Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="shift_pattern_weekly" id="shift_pattern_weekly" class="form-control" value="<?php echo $data['shift_pattern_weekly']; ?>" onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Pola Shift mingguan
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="shift_pattern_cycle" id="shift_pattern_cycle" class="form-control" value="<?php echo $data['shift_pattern_cycle']; ?>" onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Siklus Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
					
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
                                	echo form_dropdown('shift_pattern_day', $shiftpatternday ,set_value('shift_pattern_day', $data['shift_pattern_day']),'id="shift_pattern_day", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Pola Shift Hari
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<h4 class = "form-section bold">Data Shift </h4>

					<div class="row">
						<input name="created_on" type="hidden" id="created_on"
							value="<?php 
								if (empty($data['created_on'])){
								echo date('Y-m-d- H:i:s');}
								else{
								echo $data['created_on'];}?>" />

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
                                	echo form_dropdown('shift_id', $coreshift ,set_value('shift_id', $data['shift_id']),'id="shift_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
                                	echo form_dropdown('employee_shift_id', $scheduleemployeeshift ,set_value('employee_shift_id', $data['employee_shift_id']),'id="employee_shift_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Kode Shift Karyawan
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12" style='text-align:right'>
							<input type="button" name="add2" id="buttonAddArrayScheduleShiftPattern" value="Tambah" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayScheduleShiftPattern();">
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
	
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			Daftar
		</div>
	</div>
	<div class="portlet-body ">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th width="5%" >No</th>
									<th>Shift</th> 
									<th>Kode Shift Karyawan</th>
									<th width="10%">Aksi</th>					
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;

									if(!is_array($ScheduleShiftPattern_item)){
										echo "<tr><th colspan='12' style='text-align  : center !important;>Data is empty</th></tr>";
									}else{
										foreach ($ScheduleShiftPattern_item as $key=>$val){
											echo"
												<tr>
													<td style='text-align:center'>$no.</td>
													<td>".$this->ScheduleShiftPattern_model->getCoreShiftName($val['shift_id'])."</td>
													<td>".$this->ScheduleShiftPattern_model->getEmployeeShiftCode($val['employee_shift_id'])."</td>
													<td style='text-align  : center !important;'>
														<a href='".$this->config->item('base_url')."ScheduleShiftPattern/deleteArrayScheduleShiftPatternItem/".$val['record_id']."' title='Delete Data' onClick=\"javascript:return confirm('Are you sure want to delete ?')\" class='btn default btn-xs red'><i class='fa fa-trash-o'></i> Hapus</a>
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
			<div class="row">
				<div class="col-md-12 " style="text-align  : right !important;">
					<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_all()"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-save"></i> Simpan</button>	
				</div>
			</div>

			<label></label>	
		</div>
	</div>
</div>
<?php echo form_close(); ?>