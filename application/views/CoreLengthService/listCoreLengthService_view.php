

				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<div class = "page-bar">
					<ul class="page-breadcrumb ">
						<li>
							<a href="<?php echo base_url();?>">
								Beranda
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>CoreLengthService">
								Daftar Masa jabatan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Daftar Masa jabatan <small>Kelola Masa jabatan </small>
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
							<a href="<?php echo base_url();?>length-service/add" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Masa jabatan baru
							</a>
						</div>
					</li>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th width="15%">
										kode
									</th>
									<th width="30%">
										Nama Masa jabatan
									</th>
									<th width="15%">
										Range Masa jabatan 1
									</th>
									<th width="15%">
										Range Masa jabatan 2
									</th>
									<th width="10%">
										Total Masa jabatan
									</th>
									<th width="20%">
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach ($CoreLengthService as $key=>$val){
										
										echo"
											<tr>	
												<td>$no</td>								
												<td>".$val['length_service_code']."</td>
												<td>".$val['length_service_name']."</td>
												<td>".$val['length_service_range1']."</td>
												<td>".$val['length_service_range2']."</td>
												<td>".nominal($val['length_service_amount'])."</td>
												<td>
													<a href='".$this->config->item('base_url').'length-service/edit/'.$val['length_service_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'length-service/delete/'.$val['length_service_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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