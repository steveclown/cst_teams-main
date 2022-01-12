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
			<a href="<?php echo base_url();?>company">
				Daftar Perusahaan
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Daftar Perusahaan <small>Kelola Perusahaan</small>
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Daftar
				</div>
				
				<div class="actions">
					<a href="<?php echo base_url();?>company/add" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Tambah Perusahaan Baru</a>
				</div>
			</div>
			<div class="portlet-body">
				<?php 
					echo $this->session->userdata('message');
					$this->session->unset_userdata('message');
				?>
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th width="%"></th>
							<th width="5%">No</th>
							<th>Kode Perusahaan</th>
							<th>Nama Perusahaan</th>
							<th width="30%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							if(empty($corecompany)){
								echo "<tr><td colspan='8' align='center'>Data Kosong</td></tr>";
							} else {
								foreach ($corecompany as $key => $val){
									echo"
										<tr>									
											<td></td>
											<td>".$no."</td>
											<td>".$val['company_code']."</td>
											<td>".$val['company_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'company/edit/'.$val['company_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'company/delete/'.$val['company_id']."' onClick='javascript:return confirm(\"Apakah Anda Ingin Menghapus Data Ini ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Hapus
												</a>
											</td>
										</tr>
									";
									$no++;
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>