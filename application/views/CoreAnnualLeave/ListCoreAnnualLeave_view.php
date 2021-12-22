
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
						<a href="<?php echo base_url();?>CoreAnnualLeave">
							Daftar Cuti Tahunan
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Cuti Tahunan<small>Kelola Tahunan</small>
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
						<a href="<?php echo base_url();?>CoreAnnualLeave/addCoreAnnualLeave" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Cuti Tahunan Baru
						</a>
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
									Kode Cuti tahunan
								</th>
								<th>
									Nama Cuti tahunan
								</th>
								<th>
									Hari Cuti tahunan
								</th>
								<th>
									Tipe Cuti tahunan
								</th>
								<th width="120px">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($CoreAnnualLeave as $key => $val){
									
									echo"
										<tr>									
											<td>".$no."</td>
											<td>".$val['annual_leave_code']."</td>
											<td>".$val['annual_leave_name']."</td>
											<td>".$val['annual_leave_days']."</td>
											<td>".$annualleavetype[$val['annual_leave_type']]."</td>
											<td>
												<a href='".$this->config->item('base_url').'CoreAnnualLeave/editCoreAnnualLeave/'.$val['annual_leave_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'CoreAnnualLeave/deleteCoreAnnualLeave/'.$val['annual_leave_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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