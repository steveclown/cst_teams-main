
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>CoreApplicantStatus">Status Lamaran</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
		
<h1 class="page-title">
	Daftar Status Lamaran <small>Kelola Status Lamaran</small>
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
							<a href="<?php echo base_url();?>CoreApplicantStatus/addCoreApplicantStatus" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Status Lamaran Baru</a>
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
										Kode Status Lamaran
									</th>
									<th>
										Nama Status Lamaran
									</th>
									<th>
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach ($CoreApplicantStatus as $key=>$val){
										
										echo"
											<tr>
												<td>".$no."</td>									
												<td>".$val['applicant_status_code']."</td>
												<td>".$val['applicant_status_name']."</td>
												<td>
													<a href='".$this->config->item('base_url').'CoreApplicantStatus/editCoreApplicantStatus/'.$val['applicant_status_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'CoreApplicantStatus/deleteCoreApplicantStatus/'.$val['applicant_status_id']."' onClick='javascript:return confirm(\"Apakah Anda akan menghapus data ini ?\")' class='btn default btn-xs red'>
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