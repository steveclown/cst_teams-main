
	
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
								<a href="<?php echo base_url();?>CoreCommissionMmc">
									 Daftar Komisi MMC 
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Daftar Komisi MMC  <small>Kelola Komisi MMC </small>
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
								<a href="<?php echo base_url();?>CoreCommissionMmc/addcoreCommissionMmc" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i>Tambah Komisi MMC Baru
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
											Nama Judul Pekerjaan
										</th>
										<th>
											Omzet Awal
										</th>
										<th>
											Omzet Akhir
										</th>
										<th>
											Unit
										</th>
										<th width="25%">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
										foreach ($corecommissionmmc as $key=>$val){									
											echo"
												<tr>				
													<td>".$no."</td>					
													<td>".$val['job_title_name']."</td>
													<td>".nominal($val['commission_mmc_start_omzet'])."</td>
													<td>".nominal($val['commission_mmc_end_omzet'])."</td>
													<td>".nominal($val['commission_mmc_unit'])."</td>
													<td>
														<a href='".$this->config->item('base_url').'CoreCommissionMmc/editcoreCommissionMmc/'.$val['commission_mmc_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'CoreCommissionMmc/deletecoreCommissionMmc/'.$val['commission_mmc_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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