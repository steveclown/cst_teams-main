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
					<a href="<?php echo base_url();?>ScheduleShiftAssignment">Tugas Shift</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		
		<h1 class="page-title">
			Daftar Tugas Shift <small>Kelola Tugas Shift</small>
		</h1>
		 
		<!-- END PAGE TITLE & BREADCRUMB-->		
		
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								Daftar
							</div>
							
							<div class="actions">
								<a href="<?php echo base_url();?>ScheduleShiftAssignment/addScheduleShiftAssignment" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i>Tambah Tugas Shift Baru</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_1">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Devisi</th>
										<th>Kode Pola Shift</th>
										<th>Tanggal Mulai Tugas</th>
										<th>Siklus Tugas </th>
										<th width="20%">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($ScheduleShiftAssignment as $key => $val){
											$shift_assignment_item_id = $this->ScheduleShiftAssignment_model->getMinID($val['shift_assignment_id']);

											if($val['shift_assignment_item_id'] == $shift_assignment_item_id){
												echo"
													<tr>
														<td>".$no."</td>	
														<td>".$val['division_name']."</td>
														<td>".$val['shift_pattern_code']."</td>
														<td>".tgltodb($val['shift_assignment_start_date'])."</td>
														<td>".$val['shift_assignment_cycle']."</td>
														<td>
															<a href='".$this->config->item('base_url').'ScheduleShiftAssignment/showdetail/'.$val['shift_assignment_id']."' class='btn default btn-xs yellow-lemon'>
																<i class='fa fa-list'></i> Detail
															</a>

															<a href='".$this->config->item('base_url').'ScheduleShiftAssignment/deleteScheduleShiftAssignment/'.$val['shift_assignment_id']."' class='btn default btn-xs red',onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")'>
																<i class='fa fa-trash-o'></i> Hapus
															</a>
														</td>
													</tr>
												";
											} else {
												echo"
													<tr>
														<td>".$no."</td>	
														<td>".$val['division_name']."</td>
														<td>".$val['shift_pattern_code']."</td>
														<td>".tgltodb($val['shift_assignment_start_date'])."</td>
														<td>".$val['shift_assignment_cycle']."</td>
														<td></td>
													</tr>
												";
											}

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