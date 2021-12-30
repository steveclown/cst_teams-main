
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

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
						<a href="<?php echo base_url();?>CoreAbsence">
							Daftar Absensi
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Absensi <small>Kelola Absensi</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Daftar
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>CoreAbsence/addCoreAbsence" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Absensi Baru
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									No
								</th>
								<th>
									Kode Absensi
								</th>
								<th>
									Nama Absensi
								</th>
								<th>
									Nama Deduksi
								</th>
								<th width="25%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($coreabsence as $key=>$val){
									
									echo"
										<tr>		
											<td>".$no."</td>
											<td>".$val['absence_code']."</td>
											<td>".$val['absence_name']."</td>
											<td>".$val['deduction_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'CoreAbsence/editCoreAbsence/'.$val['absence_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'CoreAbsence/deleteCoreAbsence/'.$val['absence_id']."' onClick='javascript:return confirm(\"Apakah anda yakin ingin menghapus data ini ?\")' class='btn default btn-xs red'>
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