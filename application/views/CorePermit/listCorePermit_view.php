
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
						<a href="<?php echo base_url();?>CorePermit">
							Daftar Izin
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Izin <small>Kelola Izin</small>
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
						<a href="<?php echo base_url();?>CorePermit/addCorePermit" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i>Tambah Izin baru
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
								<th width="20%">
									Kode Izin	
								</th>
								<th width="20%">
									Nama Izin	
								</th>
								<th width="20%">
									Nama Deduksi
								</th>
								<th width="20%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($corepermit as $key=>$val){
									
									echo"
										<tr>		
											<td>".$no."</td>
											<td>".$val['permit_code']."</td>
											<td>".$val['permit_name']."</td>
											<td>".$val['deduction_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'CorePermit/editCorePermit/'.$val['permit_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'CorePermit/deleteCorePermit/'.$val['permit_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Delete
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