
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
							Berada
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>CoreShift">
							Daftar Shift
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Shift <small>Kelola Shift</small>
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
						<a href="<?php echo base_url();?>CoreShift/addCoreShift" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Tambah Shift Baru
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
							Kode Shift
						</th>
						<th>
							Nama Shift
						</th>
						<th>
							Start Working Hour
						</th>
						<th>
							End Working Hour
						</th>
						<th>
							Working Hours Start
						</th>
						<th>
							Working Hours End
						</th>
						<th>
							Shift Hari Berikutnya
						</th>
						<th width="25%">
							Aksi
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						$no = 1;
						foreach ($CoreShift as $key=>$val){
							
							echo"
								<tr>
									<td>".$no."</td>
									<td>".$val['shift_code']."</td>							
									<td>".$val['shift_name']."</td>
									<td>".$val['start_working_hour']."</td>									
									<td>".$val['end_working_hour']."</td>									
									<td>".$val['working_hours_start']."</td>									
									<td>".$val['working_hours_end']."</td>									
									<td>".$shiftnextday[$val['shift_next_day']]."</td>									
									<td>
										<a href='".$this->config->item('base_url').'CoreShift/editCoreShift/'.$val['shift_id']."' class='btn default btn-xs purple'>
											<i class='fa fa-edit'></i> Edit
										</a>
										
										<a href='".$this->config->item('base_url').'CoreShift/deleteCoreShift/'.$val['shift_id']."' onClick='javascript:return confirm(\"Apakah kamu yakin ingin menghapus data ini ?\")' class='btn default btn-xs red'>
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