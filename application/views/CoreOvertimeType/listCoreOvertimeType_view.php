


			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb ">
					<li>
						<a href="<?php echo base_url();?>">
							Beranda
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>CoreOvertimeType">
							Daftar Tipe Lembur
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Tipe Lembur <small>Kelola Tipe Lembur</small>
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
						<i class="fa fa-reorder"></i>List
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>overtime-type/add" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Tipe Lembur
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="15%">
									No
								</th>
								<th width="15%">
									Kode Tipe Lembur
								</th>
								<th width="15%">
									Nama Tipe Lembur
								</th>
								<th width="10%">
									Ratio Hari kerja 1
								</th>
								<th width="10%">
									Ratio Hari kerja 2
								</th>
								<th width="10%">
									Ratio Libur 1
								</th>
								<th width="10%">
									Ratio Libur 2
								</th>
								<th width="20%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($coreovertimetype as $key=>$val){
									
									echo"
										<tr>
											<td>$no</td>				
											<td>$val[overtime_type_code]</td>
											<td>$val[overtime_type_name]</td>
											<td>$val[overtime_type_working_day_ratio1]</td>
											<td>$val[overtime_type_working_day_ratio2]</td>
											<td>$val[overtime_type_day_off_ratio2]</td>
											<td>$val[overtime_type_day_off_ratio2]</td>
											<td>
												<a href='".$this->config->item('base_url').'overtime-type/edit/'.$val['overtime_type_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'overtime-type/delete/'.$val['overtime_type_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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