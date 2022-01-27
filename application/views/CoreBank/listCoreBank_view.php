
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
								<a href="<?php echo base_url()?>CoreBank">
									Daftar Bank
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Daftar Bank <small>Kelola Bank</small>
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
								Daftar
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>bank/add" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i>
									Tambah Bank Baru
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th>
											Kode Bank
										</th>
										<th>
											Nama Bank
										</th>
										<th width="30%">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($CoreBank as $key=>$val){
											echo"
												<tr>									
													<td>".$val['bank_code']."</td>
													<td>".$val['bank_name']."</td>
													<td>
														<a href='".$this->config->item('base_url').'bank/edit/'.$val['bank_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'bank/delete/'.$val['bank_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
															<i class='fa fa-trash-o'></i> Hapus
														</a>
													</td>
												</tr>
											";
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		<?php echo form_close(); ?>	