

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
							<a href="<?php echo base_url();?>CoreDeduction">
								Daftar Potongan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
						Daftar Potongan <small>Kelola Potongan</small>
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
							<i class="fa fa-reorder"></i>Daftar
						</div>
						<div class="actions">
							<a href="<?php echo base_url();?>deduction/add" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Potongan baru
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Kode
									</th>
									<th>
										Nama Potongan
									</th>
									<th>
										Jumlah Potongan
									</th>
									<th>
										Potongan tipe
									</th>
									<th width="120px">
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no=1;
									foreach ($corededuction as $key=>$val){
										
										echo"
											<tr>	
												<td>".$no."</td>								
												<td>".$val['deduction_code']."</td>
												<td>".$val['deduction_name']."</td>
												<td>".$val['deduction_amount']."</td>
												<td>".$deductiontype[$val['deduction_type']]."</td>
												<td>
													<a href='".$this->config->item('base_url').'deduction/edit/'.$val['deduction_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'deduction/delete/'.$val['deduction_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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