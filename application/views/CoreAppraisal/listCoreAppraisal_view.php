
	
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
								<a href="<?php echo base_url();?>CoreAppraisal">
									Daftar Penilaian
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Daftar Penilaian <small>kelola Penilaian</small>
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
								<a href="<?php echo base_url();?>CoreAppraisal/addCoreAppraisal" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Tambah Penilaian Baru
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th width="15%">
											Kode Penilaian
										</th>
										<th width="20%">
											Nama Penilaian
										</th>
										<th width="20%">
											Nilai Penilaian Awal
										</th>
										<th width="20%">
											Nilai Penilaian Akhir
										</th>
										<th width="10%">
											Tipe Penilaian
										</th>
										<th width="15%">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
										foreach ($coreappraisal as $key=>$val){									
											echo"
												<tr>									
													<td>".$val['appraisal_code']."</td>
													<td>".$val['appraisal_name']."</td>
													<td>".$val['appraisal_start_value']."</td>
													<td>".$val['appraisal_end_value']."</td>
													<td>".$this->configuration->AppraisalType[$val['appraisal_type']]."</td>
													<td>
														<a href='".$this->config->item('base_url').'CoreAppraisal/editCoreAppraisal/'.$val[appraisal_id]."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'CoreAppraisal/deleteCoreAppraisal/'.$val[appraisal_id]."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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