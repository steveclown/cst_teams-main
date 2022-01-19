
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	<div class = "page-bar">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<ul class="page-breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">
					Beranda
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>CoreBranch">
					Daftar Cabang
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
	</div>
	<h1 class="page-title">
		Daftar Cabang<small>kelola Cabang</small>
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
						<a href="<?php echo base_url();?>branch/add" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Cabang Baru
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="10%">Kode Wilayah</th>
								<th width="10%">Nama Wilayah</th>
								<th width="10%">Kode Cabang</th>
								<th width="15%">Nama Cabang</th>
								<th width="15%">Alamat Cabang</th>
								<th width="10%">Contact Person</th>
								<th width="10%">No Hp Cabang 1</th>
								<th width="15%">Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								if(empty($corebranch)){
									echo "<tr><td colspan='8' align='center'>Data Kosong</td></tr>";
								} else {
									foreach ($corebranch as $key=>$val){
										
										echo"
											<tr>		
												<td>".$no."</td>
												<td>".$val['region_code']."</td>
												<td>".$val['region_name']."</td>
												<td>".$val['branch_code']."</td>
												<td>".$val['branch_name']."</td>
												<td>".$val['branch_address']."</td>
												<td>".$val['branch_contact_person']."</td>
												<td>".$val['branch_phone1']."</td>
												<td>
													<a href='".$this->config->item('base_url').'branch/edit/'.$val['branch_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'branch/delete/'.$val['branch_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus?\")' class='btn default btn-xs red'>
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
<?php echo form_close(); ?>