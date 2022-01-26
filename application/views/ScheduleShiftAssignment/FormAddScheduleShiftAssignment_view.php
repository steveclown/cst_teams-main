<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('ScheduleShiftAssignment/addScheduleShiftAssignment'); ?>";

	function reset_add(){
		document.location= base_url+"ScheduleShiftAssignment/reset_add";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleShiftAssignment/function_elements_add');?>",
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
				url : "<?php echo site_url('ScheduleShiftAssignment/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	function processAddArrayScheduleShiftAssignment(){
		
		var shift_pattern_id						= document.getElementById("shift_pattern_id").value;
		var shift_assignment_start_date				= document.getElementById("shift_assignment_start_date").value;
		var shift_assignment_cycle					= document.getElementById("shift_assignment_cycle").value;
		

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('ScheduleShiftAssignment/processAddArrayScheduleShiftAssignment');?>",
			  data: {
					'shift_pattern_id' 				: shift_pattern_id,	
					'shift_assignment_start_date'	: shift_assignment_start_date,	
					'shift_assignment_cycle'		: shift_assignment_cycle,	
					'session_name' 					: "addarraypurchaseorderitem-"
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
			<a href="<?php echo base_url();?>ScheduleShiftAssignment">Tugas Shift</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleShiftAssignment/addScheduleShiftAssignment">Tambah Tugas Shift</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Tambah Tugas Shift
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
					<a href="<?php echo base_url();?>ScheduleShiftAssignment/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php  
						echo form_open('ScheduleShiftAssignment/processAddScheduleShiftAssignment',array('class' => 'horizontal-form'));

						$unique 	= $this->session->userdata('unique');
						$data 		= $this->session->userdata('addScheduleShiftAssignment-'.$unique['unique']);

						if(empty($data['division_id'])){
							$data['division_id']=9;
						}
						if(empty($data['shift_pattern_id'])){
							$data['shift_pattern_id']=9;
						}
						if(empty($data['shift_assignment_start_date'])){
							$data['shift_assignment_start_date']= date('Y-m-d');
						}
						if(empty($data['shift_assignment_cycle'])){
							$data['shift_assignment_cycle']="";
						}

					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
                                	echo form_dropdown('division_id', $coredivision ,set_value('division_id', $data['division_id']),'id="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');

                                	
                                ?>
								<label for="form_control">Nama Devisi
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<h4 class = "form-section bold">Pola Shift </h4>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
                                	echo form_dropdown('shift_pattern_id', $scheduleshiftpattern ,set_value('shift_pattern_id', $data['shift_pattern_id']),'id="shift_pattern_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="shift_assignment_start_date" id="shift_assignment_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['shift_assignment_start_date']);?>">
								<label for="form_control">Tanggal Mulai 
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="shift_assignment_cycle" id="shift_assignment_cycle" class="form-control" value="<?php echo $data['shift_assignment_cycle']; ?>" onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Siklus Tugas Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<input type="button" name="Add2" id="buttonAddArrayScheduleShiftAssignment" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayScheduleShiftAssignment();">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	$unique 						= $this->session->userdata('unique');
	$ScheduleShiftAssignmentitem 	= $this->session->userdata('addarrayScheduleShiftAssignmentitem-'.$unique['unique']);
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List
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
									<th>Kode Pola Shift</th> 
									<th>Nama Pola Shift</th>
									<th>Tanggal Mulai </th>
									<th>Siklus Tugas Shift</th>
									<th width="10%">Aksi</th>					
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;

									if(!is_array($ScheduleShiftAssignmentitem)){
										echo "<tr><th colspan='6' style='text-align  : center !important;'>Tidak Ada Data</th></tr>";
									}else{
										foreach ($ScheduleShiftAssignmentitem as $key=>$val){
											echo"
												<tr>
													<td style='text-align:center'>".$no."</td>
													<td>".$this->ScheduleShiftAssignment_model->getShiftPatternCode($val['shift_pattern_id'])."</td>
													<td>".$this->ScheduleShiftAssignment_model->getShiftPatternName($val['shift_pattern_id'])."</td>
													<td>".tgltoview($val['shift_assignment_start_date'])."</td>
													<td>".$val['shift_assignment_cycle']."</td>
													<td style='text-align  : center !important;'>
														<a href='".$this->config->item('base_url')."ScheduleShiftAssignment/deleteArrayScheduleShiftAssignment/".$val['shift_pattern_id']."' title='Delete Data' onClick=\"javascript:return confirm('Apakah yakin ingin dihapus ?')\" class='btn default btn-xs red'><i class='fa fa-trash-o'></i> Hapus</a>
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
					<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_add()"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Simpan</button>	
				</div>
			</div>

			<label></label>	
		</div>
	</div>
</div>
<?php echo form_close(); ?>