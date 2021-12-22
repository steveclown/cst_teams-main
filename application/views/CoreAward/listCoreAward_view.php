
	
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
								<a href="<?php echo base_url();?>CoreAward">
									Daftar Penghargaan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Daftar Penghargaan <small>Kelola Penghargaan</small>
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
								<a href="<?php echo base_url();?>CoreAward/addCoreAward" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Tambah Penghargaan Baru
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
											Kode Penghargaan
										</th>
										<th>
											Nama Penghargaan
										</th>
										<th>
											Keterangan
										</th>
										<th width="25%">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($CoreAward as $key=>$val){									
											echo"
												<tr>
													<td>".$no."</td>									
													<td>".$val['award_code']."</td>
													<td>".$val['award_name']."</td>
													<td>".$val['award_remark']."</td>
													<td>
														<a href='".$this->config->item('base_url').'CoreAward/editCoreAward/'.$val['award_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'CoreAward/deleteCoreAward/'.$val['award_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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