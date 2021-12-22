
    
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
								<a href="<?php echo base_url();?>CoreRating">
									Daftar Peringkat
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Daftar Peringkat <small>kelola Peringkat</small>
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
		
	<?php 
		echo $this->session->userdata('message');
		$this->session->unset_userdata('message');
	?>			
		<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Daftar
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>CoreRating/addCoreRating" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Tambah Peringkat baru
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
											Kode Peringkat
										</th>
										<th>
											Nama Peringkat
										</th>
										<th>
											Range Peringkat 1
										</th>
										<th>
											Range Peringkat 2
										</th>
										<th>
											Nilai Peringkat
										</th>
										<th>
											Keterangan
										</th>
										<th width="120px">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										foreach ($CoreRating as $key=>$val){
											
											echo"
												<tr>
													<td>".$no."</td>									
													<td>".$val['rating_code']."</td>
													<td>".$val['rating_name']."</td>
													<td>".$val['rating_range1']."</td>
													<td>".$val['rating_range2']."</td>
													<td>".$val['rating_value']."</td>
													<td>".$val['rating_remark']."</td>
													<td>
														<a href='".$this->config->item('base_url').'CoreRating/editCoreRating/'.$val['rating_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'CoreRating/deleteCoreRating/'.$val['rating_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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