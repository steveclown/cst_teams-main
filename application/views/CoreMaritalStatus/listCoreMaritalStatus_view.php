


		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreMaritalStatus">Daftar Status Pernikahan</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Daftar Status Pernikahan <small>Kelola Status Pernikahan</small>
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
							<a href="<?php echo base_url();?>marital-status/add" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Status Pernikahan Baru
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
										Kode Status Pernikahan
									</th>
									<th>
										Nama Status Pernikahan
									</th>
									<th width="30%">
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach ($coremaritalstatus as $key=>$val){
										
										echo"
											<tr>
												<td>".$no."</td>								
												<td>".$val['marital_status_code']."</td>
												<td>".$val['marital_status_name']."</td>
												<td>
													<a href='".$this->config->item('base_url').'marital-status/edit/'.$val['marital_status_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'marital-status/delete/'.$val['marital_status_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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