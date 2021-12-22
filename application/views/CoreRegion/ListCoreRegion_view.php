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
			<a href="<?php echo base_url();?>region">
				Daftar Wilayah
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Daftar Wilayah <small>Kelola wilayah</small>
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
					<a href="<?php echo base_url();?>region/add" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Tambah Wilayah Baru</a>
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
							<th>Kode Wilayah</th>
							<th>Nama Wilayah</th>
							<th width="30%">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							if(empty($coreregion)){
								echo "<tr><td colspan='8' align='center'>Data Kosong</td></tr>";
							} else {
								foreach ($coreregion as $key => $val){
									echo"
										<tr>									
											<td></td>
											<td>".$no."</td>
											<td>".$val['region_code']."</td>
											<td>".$val['region_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'region/edit/'.$val['region_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'region/delete/'.$val['region_id']."' onClick='javascript:return confirm(\"Apakah Anda Ingin Menghapus Data Ini ?\")' class='btn default btn-xs red'>
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