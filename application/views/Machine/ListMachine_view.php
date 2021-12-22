<style>
	th{
		font-size: 12px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>

		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Beranda</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>Machine">Mesin</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
			<h3 class="page-title">
				Daftar Mesin <small>Kelola Mesin</small>
			</h3>
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
								<a href="<?php echo base_url();?>Machine/addMachine" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Mesin Baru</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
							<thead>
							<tr>
								<th>
									No
								</th>
								<th>
									Kode Mesin
								</th>
								<th>
									Nama Mesin
								</th>
								<th>
									IP Address Mesin
								</th>								
								<th>
									Port Mesin
								</th>
								<th width="120px">
									Aksi
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
								$no=1;
								foreach ($Machine as $key=>$val){
									
									echo"
										<tr>									
											<td>".$no."</td>
											<td>".$val['machine_code']."</td>
											<td>".$val['machine_name']."</td>
											<td>".$val['machine_ip_address']."</td>
											<td>".$val['machine_port']."</td>
											<td>
												<a href='".$this->config->item('base_url').'Machine/editMachine/'.$val['machine_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'Machine/deleteMachine/'.$val['machine_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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