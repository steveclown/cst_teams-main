<script>
	base_url = '<?php echo base_url()?>';

	function reset_add_leave(){
		document.location = base_url+"HroEmployeeEmploymentCkp/reset_add_leave/<?php echo $hroemployeedata['employee_id']?>";
	}

	function function_elements_add_leave(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeEmploymentCkp/function_elements_add_leave');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){

			}
		});
	}
</script>
				
<?php 
	echo form_open('HroEmployeeEmploymentCkp/processAddPayrollLeaveRequest',array('id' => 'myform', 'class' => 'horizontal-form'));

	$unique 	= $this->session->userdata('unique');
	
	$dataleave	= $this->session->userdata('addpayrollleaverequest-'.$unique['unique']);

	if (empty($dataleave)){
		$dataleave['leave_request_date']	 		= date("Y-m-d");
		$dataleave['leave_request_start_date'] 		= date("Y-m-d");
		$dataleave['leave_request_end_date'] 		= date("Y-m-d");
		$dataleave['annual_leave_id']				="";
		$dataleave['leave_request_description']		="";
		$dataleave['leave_request_duration']		="";
		$dataleave['leave_request_reason']			="";
	}
?>

<?php 
	$year_now 	=	date('Y');
	if(!is_array($dataleave)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_date" id="leave_request_date" onChange="function_elements_add_leave(this.name, this.value);" value="<?php echo tgltoview($dataleave['leave_request_date']);?>">
			<label class="control-label">Tanggal Permintaan Cuti
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
	
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php
				echo form_dropdown('annual_leave_id', $coreannualleave,set_value('annual_leave_id',$dataleave['annual_leave_id']),'id="annual_leave_id" class="form-control select2me" onChange="function_elements_add_leave(this.name, this.value);"');
			?>
			<label class="control-label">Jenis Cuti</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_start_date" id="leave_request_start_date" onChange="function_elements_add_leave(this.name, this.value);" value="<?php echo tgltoview($dataleave['leave_request_start_date']);?>">
			<label class="control-label">Tinggalkan Tanggal Mulai Permintaan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="leave_request_end_date" id="leave_request_end_date" onChange="function_elements_add_leave(this.name, this.value);" value="<?php echo tgltoview($dataleave['leave_request_end_date']);?>">
			<label class="control-label">Tinggalkan Tanggal Selesai Permintaan
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
			<input type="text" name="leave_request_description" id="leave_request_description" value="<?php echo $dataleave['leave_request_description']?>" class="form-control" onChange="function_elements_add_leave(this.name, this.value);">
			<label class="control-label">Deskripsi</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="leave_request_duration" id="leave_request_duration" value="<?php echo $dataleave['leave_request_duration']?>" class="form-control" onChange="function_elements_add_leave(this.name, this.value);">
			<label class="control-label">Durasi</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="leave_request_reason" id="leave_request_reason" class="form-control" onChange="function_elements_add_leave(this.name, this.value);"><?php echo $dataleave['leave_request_reason'];?></textarea>
			<label class="control-label">alasan</label>
		</div>
	</div>
</div>

<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_leave();"><i class="fa fa-times"></i> Reset</button>
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
						<th>no</th>
						<th width = "15%">Tanggal cuti</th>
						<th width = "15%">Jenis cuti</th>
						<th width = "20%">Deskripsi Cuti</th>
						<th width = "10%">Tanggal Mulai </th>
						<th width = "10%">Tanggal Selesai </th>
						<th width = "10%">durasi Cuti </th>
						<th width = "20%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no=1;
					if(!is_array($payrollleaverequest)){
						echo "<tr><th colspan='12' style='text-align  : center !important;'>Tidak Ada Data </th></tr>";
					} else {
						foreach ($payrollleaverequest as $key=>$val){
							$leave_request_id = $val['leave_request_id'];
							echo"
								<tr>
									<td>".$no."</td>
									<td>".tgltoview($val['leave_request_date'])."</td>
									<td>".$val['annual_leave_name']."</td>
									<td>".$val['leave_request_description']."</td>
									<td>".tgltoview($val['leave_request_start_date'])."</td>
									<td>".tgltoview($val['leave_request_end_date'])."</td>
									<td>".$val['leave_request_duration']."</td>
									<td>
										<a class='btn default btn-xs yellow' data-toggle='modal' href='#myModal' data-target='#detail-modal".$val['leave_request_id']."' id='".$val['leave_request_id']."'><i class='fa fa-pencil'></i> Detail
										</a>
										<a href='".$this->config->item('base_url').'HroEmployeeEmploymentCkp/deletePayrollLeaveRequest_Data/'.$val['employee_id']."/".$val['leave_request_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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
				
