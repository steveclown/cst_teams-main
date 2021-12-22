


				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<div class = "page-bar">
					<ul class="page-breadcrumb">
						<li>
							<a href="<?php echo base_url();?>">
								Beranda
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>CorePremiAttendance">
								Daftar Premi Kehadiran
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Daftar Premi Kehadiran <small>kelola Premi Kehadiran</small>
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
							<i class="fa fa-reorder"></i>Daftar
						</div>
						<div class="actions">
							<a href="<?php echo base_url();?>CorePremiAttendance/addCorePremiAttendance" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Premi Kehadiran baru
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th width="10%">
										No
									</th>
									<th width="15%">
										Code
									</th>
									<th width="20%">
										Nama Premi Kehadiran
									</th>
									<th width="15%">
										Range Premi Kehadiran 1
									</th>
									<th width="15%">
										Range Premi Kehadiran 2
									</th>
									<th width="15%">
										Total Premi Kehadiran
									</th>
									<th width="25%">
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach ($CorePremiAttendance as $key=>$val){
										
										echo"
											<tr>
												<td>$no</td>									
												<td>$val[premi_attendance_code]</td>
												<td>$val[premi_attendance_name]</td>
												<td>$val[premi_attendance_range1]</td>
												<td>$val[premi_attendance_range2]</td>
												<td>".nominal($val['premi_attendance_amount'])."</td>
												<td>
													<a href='".$this->config->item('base_url').'CorePremiAttendance/editCorePremiAttendance/'.$val['premi_attendance_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>

													<a href='".$this->config->item('base_url').'CorePremiAttendance/deleteCorePremiAttendance/'.$val['premi_attendance_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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