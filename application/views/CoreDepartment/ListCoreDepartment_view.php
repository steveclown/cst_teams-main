
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
		
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Beranda
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>CoreDepartment">
							Daftar Departemen
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Departemen <small>Kelola Departemen</small>
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
						<a href="<?php echo base_url();?>department/add" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Departemen Baru
						</a>
					</div>
				</div>
				<div class="portlet-body ">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
					<tr>
						<th width="5%">
							No
						</th>
						<th>
							Nama Devisi
						</th>
						<th>
							Kode Departemen
						</th>
						<th>
							Nama Departemen
						</th>
						<th width="25%">
							Aksi
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						foreach ($coredepartment as $key=>$val){
							
							echo"
								<tr>
									<td>".$no."</td>
									<td>".$this->CoreDepartment_model->getDivisionName($val['division_id'])."</td>					
									<td>".$val['department_code']."</td>
									<td>".$val['department_name']."</td>									
									<td>
										<a href='".$this->config->item('base_url').'department/edit/'.$val['department_id']."' class='btn default btn-xs purple'>
											<i class='fa fa-edit'></i> Edit
										</a>
										<a href='".$this->config->item('base_url').'department/delete/'.$val['department_id']."' onClick='javascript:return confirm(\"Apakah yakin data ini ingin dihapus ?\")' class='btn default btn-xs red'>
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