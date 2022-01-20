


			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i></i>
						<a href="<?php echo base_url();?>">
							Beranda
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Daftar Pelamar
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Data Pelamar <small>Kelola data pelamar</small>
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
					<a href="<?php echo base_url();?>recruitment-applicant-data/add" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Tambah pelamar baru</a>
				</div>
			</div>
			<div class="portlet-body">
			<div class="form-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
				<!--<table class="table table-striped table-bordered table-hover table-full-width">-->
					<thead>
						<tr>
							<th style='text-align:center' width='5%'>No</th>
							<th style='text-align:center' width='15%'>Nama</th>
							<th style='text-align:center' width='10%'>Tanggal pelamar</th>
							<th style='text-align:center' width='10%'>Tanggal Lahir</th>
							<th style='text-align:center' width='15%'>Alamat</th>
							<th style='text-align:center' width='15%'>Kota</th>
							<th style='text-align:center' width='15%'>No Hp </th>
							<th style='text-align:center' width='15%'>Pendidikan Terakhir</th>
							<th style='text-align:center' width='10%'>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// if(empty($item)){
								// echo "<tr><td style='text-align:center' colspan='10'>Data Masih Kosong</td></tr>";
							// } else {
								$no = 1;
						 		/*print_r("RecruitmentApplicantData ");
								print_r($RecruitmentApplicantData); */
								foreach($recruitmentapplicantdata as $key => $val){
									echo"
										<tr>
											<td>".$no."</td>
											<td>".$val['applicant_name']."</td>
											<td>".tgltoview($val['applicant_application_date'])."</td>
											<td>".tgltoview($val['applicant_date_of_birth'])."</td>
											<td>".$val['applicant_address']."</td>
											<td>".$val['applicant_city']."</td>
											<td>".$val['applicant_mobile_phone']."</td>
											<td>".$val['applicant_last_education']."</td>
											<td>
												<a href='".$this->config->item('base_url').'recruitment-applicant-data/edit/'.$val['applicant_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
											</td>
											<td>
												<a href='".$this->config->item('base_url').'recruitment-applicant-data/delete/'.$val['applicant_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Hapus
												</a>
											</td>
										</tr>
									";
									
									/* <a href='".base_url().'RecruitmentApplicantData/edit/'.$val['applicant_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a> */
									$no++;
								}
							// }
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>