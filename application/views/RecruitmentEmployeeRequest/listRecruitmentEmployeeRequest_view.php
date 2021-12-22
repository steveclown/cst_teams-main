<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	
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
							<a href="<?php echo base_url();?>RecruitmentEmployeeRequest">
								Daftar Permintaan Karyawan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h3 class="page-title">
					Daftar Permintaan Karyawan <small>Kelola Permintaan Karyawan</small>
				</h3>
				<!-- END PAGE TITLE & BREADCRUMB-->

		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-reorder"></i>Daftar
						</div>

						<div class="actions">
							<a href="<?php echo base_url();?>RecruitmentEmployeeRequest/addRecruitmentEmployeeRequest" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Tambah Permintaan Karyawan baru
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
										Diminta oleh
									</th>
									<th>
										Judul
									</th>
									<th>
										Tanggal
									</th>
									<th>
										Batas tanggal terakhir
									</th>
									<th>
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									foreach ($RecruitmentEmployeeRequest as $key=>$val){
										
										echo"
											<tr>	
												<td>".$no."</td>						
												<td>".$this->RecruitmentEmployeeRequest_model->getEmployeeName($val['employee_id'])."</td>		
												<td>".$val['employee_request_title']."</td>
												<td>".tgltoview($val['employee_request_date'])."</td>
												<td>".tgltoview($val['employee_request_due_date'])."</td>
												<td>
													<a href='".$this->config->item('base_url').'RecruitmentEmployeeRequest/showdetail/'.$val['employee_request_id']."' class='btn yellow-saffron btn-xs default'>
														<i class='fa fa-search'></i> Detail
													</a>
												</td>
											</tr>
										";
										$no++;
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