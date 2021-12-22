<script>
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleEmployeeShift/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeShift">Shift Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Daftar Shift Karyawan <small>Kelola Shift Karyawan</small>
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		
<?php 
	$auth 					= $this->session->userdata('auth');
	$payroll_employee_level = $auth['payroll_employee_level'];

	$data = $this->session->userdata('filter-scheduleemployeeshift');

?>
	<?php echo form_open('ScheduleEmployeeShift/filter_ScheduleEmployeeShift',array('id' => 'myform', 'class' => '')); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Filter
					</div>
					<div class="tools">
						<a href="javascript:;" class='expand'></a>
					</div>
				</div>
				<div class="portlet-body display-hide">
					<div class="form-body">
						<div class = "row">
							<div class="col-md-6">
							<label class="control-label">Lokasi</label>
								<?php
									echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								?>
							</div>
							
						</div>
						<div class="row">
							<div class="col-md-12 " style="text-align  : right !important;">
								<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_search()"><i class="fa fa-times"></i> Batal</button>
							<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Cari</button>	
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo form_close(); ?>


<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Daftar
				</div>
				
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleEmployeeShift/addScheduleEmployeeShift" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Tambah Shift Karyawan</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Lokasi </th>
							<th>Nama Devisi </th>
							<th>Kode Shift Karyawan</th>
							<th>Status</th>
							<th width="20%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							foreach ($ScheduleEmployeeShift as $key => $val){
								echo"
									<tr>	
										<td>".$no."</td>							
										<td>".$val['location_name']."</td>
										<td>".$val['division_name']."</td>
										<td>".$val['employee_shift_code']."</td>
										<td>".$ScheduleEmployeeShiftstatus[$val['employee_shift_status']]."</td>
										<td>
											<a href='".$this->config->item('base_url').'ScheduleEmployeeShift/showdetail/'.$val['employee_shift_id']."' class='btn default btn-xs yellow-lemon'>
												<i class='fa fa-list'></i> Detail
											</a>
											<a href='".$this->config->item('base_url').'ScheduleEmployeeShift/editScheduleEmployeeShift/'.$val['employee_shift_id']."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
											<a href='".$this->config->item('base_url').'ScheduleEmployeeShift/deleteScheduleEmployeeShift/'.$val['employee_shift_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Hapus
											</a>
										</td>
									</tr>
								";
								$no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<?php echo form_close(); ?>	