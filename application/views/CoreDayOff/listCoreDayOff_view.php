

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
						<a href="<?php echo base_url();?>CoreDayOff">
							Daftar Libur
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Libur <small>Kelola Libur</small>
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
						<a href="<?php echo base_url();?>day-off/add" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i>Tambah Libur baru
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
									Kode Libur
								</th>
								<th>
									Nama Libur
								</th>
								
								<th width="25%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($coredayoff as $key=>$val){
									
									echo"
										<tr>	
											<td>".$no."</td>
											<td>".$val['dayoff_code']."</td>
											<td>".$val['dayoff_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'day-off/edit/'.$val['dayoff_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'day-off/delete/'.$val['dayoff_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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