<script>
	base_url = '<?= base_url()?>';
</script>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeSchedule">Jadwal Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeSchedule">Edit Jadwal Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<?php 
	echo form_open('ScheduleEmployeeSchedule/processEditScheduleEmployeeScheduleWorking', array('class' => 'horizontal-form')); 

?>

<h1 class="page-title">
	Form Edit Jadwal Karyawan
</h1>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleEmployeeSchedule/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php
						echo $this->session->userdata('message');
						$this->session->unset_userdata('message');
					?>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $ScheduleEmployeeScheduleitem['employee_name']; ?>" class="form-control" readonly>

								<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $ScheduleEmployeeScheduleitem['employee_id']; ?>" class="form-control" readonly>

								<input type="hidden" name="employee_schedule_id" id="employee_schedule_id" value="<?php echo $ScheduleEmployeeScheduleitem['employee_schedule_id']; ?>" class="form-control" readonly>

								<input type="hidden" name="employee_schedule_item_id" id="employee_schedule_item_id" value="<?php echo $ScheduleEmployeeScheduleitem['employee_schedule_item_id']; ?>" class="form-control" readonly>

								<label for="form_control">Nama Karyawan</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_schedule_item_date" id="employee_schedule_item_date" value="<?php echo tgltoview($ScheduleEmployeeScheduleitem['employee_schedule_item_date']); ?>" class="form-control" readonly>
								<label for="form_control">Jadwal Tanggal Barang</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_shift_code" id="employee_shift_code" value="<?php echo $ScheduleEmployeeScheduleitem['employee_shift_code']; ?>" class="form-control" readonly>
								<label for="form_control">Kode Shift Karyawan</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_name" id="shift_name" value="<?php echo $ScheduleEmployeeScheduleitem['shift_name']; ?>" class="form-control" readonly>
								<label for="form_control">Nama Shift</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_schedule_item_in_start_date_old" id="employee_schedule_item_in_start_date_old" value="<?php echo $ScheduleEmployeeScheduleitem['employee_schedule_item_in_start_date']; ?>" class="form-control" readonly>
								<label for="form_control">Jadwal Di Tanggal Lama</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_schedule_item_in_start_date" id="employee_schedule_item_in_start_date" value="<?php echo $ScheduleEmployeeScheduleitem['employee_schedule_item_in_start_date']; ?>" class="form-control" >
								<label for="form_control">Jadwal Dalam Tanggal</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group form-md-line-input">
								<?php 								
									if (empty($ScheduleEmployeeScheduleitem['employee_schedule_working_reason'])) {
										$ScheduleEmployeeScheduleitem['employee_schedule_working_reason']=" ";
									}
								?>
								<input type="text" name="employee_schedule_working_reason" id="employee_schedule_working_reason" value="<?php echo $ScheduleEmployeeScheduleitem['employee_schedule_working_reason']; ?>" class="form-control" >
								<label for="form_control">Alasan Jadwal Bekerja</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_all()"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Simpan</button>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 
	echo form_close(); 
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
					<table class="table table-bordered table-advance table-hover">
						<thead>
							<tr>
								<th style='text-align:center'>No</th>
								<th style='text-align:center'>Tanggal Jadwal</th>
								<th style='text-align:center'>Jadwal Di Tanggal Lama</th>
								<th style='text-align:center'>Jadwal Dalam Tanggal</th>
								<th style='text-align:center'>Jadwalkan Di Tanggal Akhir</th>
								<th style='text-align:center'>Alasan Jadwal Bekerja</th>
								<th></th> 					
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($ScheduleEmployeeScheduleworking as $key => $val){
									echo"
									<tr>
										<td style='text-align:center'>".$no."</td>
										<td style='text-align:center'>".tgltoview($val['employee_schedule_item_date'])."</td>
										<td style='text-align:center'>".$val['employee_schedule_item_in_start_date_old']."</td>
										<td style='text-align:center'>".$val['employee_schedule_item_in_start_date']."</td>
										<td style='text-align:center'>".$val['employee_schedule_item_in_end_date']."</td>
										<td style='text-align:center'>".$val['employee_schedule_working_reason']."
									</tr>
									";
									$no++;
								}
							?>
						</tbody>
					</table>
					
				</div>
			</div>
			<label></label>	
		</div>
	</div>
</div>



