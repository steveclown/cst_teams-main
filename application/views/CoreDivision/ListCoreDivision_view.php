
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
							<a href="<?php echo base_url();?>CoreDivision">
								Daftar Devisi
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h3 class="page-title">
					Daftar Devisi 
					<!-- <small>Kelola Devisi Division</small> -->
				</h3>
				<!-- END PAGE TITLE & BREADCRUMB-->
				
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Daftar
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>CoreDivision/addCoreDivision" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Tambah Devisi Baru
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th>
											Kode Devisi
										</th>
										<th>
											Nama Devisi
										</th>
										<th width="30%">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no = 1;
									foreach ($coredivision as $key=>$val){
										
										echo"
											<tr>					
												<td>".$no."</td>				
												<td>".$val['division_code']."</td>
												<td>".$val['division_name']."</td>
												<td>
													<a href='".$this->config->item('base_url').'CoreDivision/editCoreDivision/'.$val['division_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'CoreDivision/deleteCoreDivision/'.$val['division_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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