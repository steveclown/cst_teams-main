

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
					<a href="<?php echo base_url();?>ScheduleShiftPattern">Pola Shift</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Daftar Pola Shift <small>Kelola Pola Shift </small>
		</h1>
		
		<!-- END PAGE TITLE & BREADCRUMB-->		
<!-- <?php echo form_open('ScheduleShiftPattern/filter_ScheduleShiftPattern',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body">
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_schedule_date_start" id="employee_schedule_date_start">
								<label for="form_control">Start Date</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_schedule_date_end" id="employee_schedule_date_end" >
								<label for="form_control">End Date</label>
							</div>	
						</div>
					</div>
					<div class="form-group">
						<div class="form-action" style="text-align: right !important;">
							<button type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_all();"><i class="fa fa-times"></i>Reset</button>
							<button type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data"><i class="fa fa-search"></i>Find</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?> -->

			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Daftar
							</div>
							
							<div class="actions">
								<a href="<?php echo base_url();?>ScheduleShiftPattern/addScheduleShiftPattern" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i>Tambah Pola Shift Baru</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Pola Shift</th>
										<th>Nama Pola Shift</th>
										<th>Pola Shift Mingguan</th>
										<th>Siklus Pola Shift </th>
										<th>Pola Shift Harian</th>
										<th width="20%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($ScheduleShiftPattern as $key=>$val){
											echo"
												<tr>	
													<td>".$no."</td>							
													<td>".$val['shift_pattern_code']."</td>
													<td>".$val['shift_pattern_name']."</td>
													<td>".$val['shift_pattern_weekly']."</td>
													<td>".$val['shift_pattern_cycle']."</td>
													<td>".$shiftpatternday[$val['shift_pattern_day']]."</td>
													<td>
														<a href='".$this->config->item('base_url').'ScheduleShiftPattern/showdetail/'.$val['shift_pattern_id']."' class='btn default btn-xs yellow-lemon'>
															<i class='fa fa-list'></i> Detail
														</a>
														<a href='".$this->config->item('base_url').'ScheduleShiftPattern/editScheduleShiftPattern/'.$val['shift_pattern_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'ScheduleShiftPattern/deleteScheduleShiftPattern/'.$val['shift_pattern_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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