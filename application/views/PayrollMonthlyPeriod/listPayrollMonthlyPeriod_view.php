
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
						<a href="<?php echo base_url();?>PayrollMonthlyPeriod">
							Daftar Periode Bulanan
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Periode Bulanan<small>Kelola Judul Periode Bulanan</small>
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
						<a href="<?php echo base_url();?>PayrollMonthlyPeriod/addPayrollMonthlyPeriod" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Periode Bulanan
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width = "5%">
									No 
								</th>
								<th width = "20%">
									Periode Bulanan
								</th>
								<th width = "20%">
									Tanggal Mulai Periode Bulanan
								</th>
								<th width = "20%">
									Tanggal Akhir Periode Bulanan
								</th>
								<th width = "20%">
									Periode Bulanan Hari Kerja
								</th>
								<th  width = "15%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($payrollmonthlyperiod as $key=>$val){
									echo"
										<tr>	
											<td>".$no."</td>
											<td>".$monthlist[substr($val['monthly_period'], -2, 2)]." ".substr($val['monthly_period'], 0, 4)."</td>
											<td>".tgltoview($val['monthly_period_start_date'])."</td>
											<td>".tgltoview($val['monthly_period_end_date'])."</td>
											<td>".$val['monthly_period_working_days']."</td>
											<td>
												<a href='".$this->config->item('base_url').'PayrollMonthlyPeriod/deletePayrollMonthlyPeriod/'.$val['monthly_period_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Hapus
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