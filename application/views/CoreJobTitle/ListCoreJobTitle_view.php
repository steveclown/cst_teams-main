
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
						<a href="<?php echo base_url();?>CoreJobTitle">
							Daftar Judul Pekerjaan
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Judul Pekerjaan <small>Kelola Judul Pekerjaan</small>
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
						<a href="<?php echo base_url();?>job-title/add" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Judul Pekerjaan Baru
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
									Kode Judul Pekerjaan
								</th>
								<th>
									Nama Judul Pekerjaan
								</th>
								<th>
									Parent
								</th>
								<th width="120px">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($corejobtitle as $key=>$val){
									
									echo"
										<tr>						
											<td>".$no."</td>			
											<td>".$val['job_title_code']."</td>
											<td>".$val['job_title_name']."</td>
											<td>".$this->CoreJobTitle_model->getJobTitleName($val['job_title_parent_id'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'job-title/edit/'.$val['job_title_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'job-title/delete/'.$val['job_title_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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