
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">
							Beranda
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>CoreClass">
							Daftar Kelas
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Kelas <small>Kelola Kelas</small>
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
						<a href="<?php echo base_url();?>CoreClass/addCoreClass" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Kelas Baru
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									no
								</th>
								<th width = "15%">
									Nama Tingkatan
								</th>
								<th width = "20%">
									Kode Kelas
								</th>
								<th width = "20%">
									Nama Kelas
								</th>
								
								<th width = "15%">
									Gaji Standar 1
								</th>
								<th width = "15%">
									Gaji Standar 2
								</th>
								<th width = "15%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($CoreClass as $key=>$val){
									
									echo"
										<tr>
											<td>".$no."</td>
											<td>".$this->CoreClass_model->getGradeName($val['grade_id'])."</td>
											<td>".$val['class_code']."</td>
											<td>".$val['class_name']."</td>									
											<td>".nominal($val['standard_salary_range1'])."</td>
											<td>".nominal($val['standard_salary_range2'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'CoreClass/editCoreClass/'.$val['class_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'CoreClass/deleteCoreClass/'.$val['class_id']."' onClick='javascript:return confirm(\"Apakah Anda yakin akan menghapus data ini ?\")' class='btn default btn-xs red'>
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