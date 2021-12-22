<style>
	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:16px  !important;
		font-weight: normal !important;
	}
</style>
<?php
	$RfidMode = $this->configuration->RfidMode();
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
					<a href="<?php echo base_url();?>shift">
						Preference Rfid Device
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
			Preference Rfid
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->
		
	
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						MODE RFID
					</div>					
				</div>
				<div class="portlet-body">
					<div class="form-body">
						<?php
							echo $this->session->userdata('message');
							$this->session->unset_userdata('message');
						?>
						<table class="table table-striped table-bordered table-checkable" >
							<thead>
								<tr>
									<th style='text-align:center' width="5%">No</th>
									<th style='text-align:center' width="20%">ID Device</th>
									<th style='text-align:center' width="55%">Mode</th>
									<th style='text-align:center' width="20%">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if(!is_array($PreferenceRfid)){
										echo "<tr><th colspan='2'>Data Masih Kosong</th></tr>";
									} else {
										foreach($PreferenceRfid as $key=>$val){
										
											echo"
												<tr>
													<td>".$no."</td>
													<td>".$val['preference_rfid_device_id']."</td>											
													<td><strong>".$RfidMode[$val['preference_rfid_mode']]."</strong></td>
													<td>";
													if ($val["preference_rfid_mode"] == 0) {
														echo"
															<a href='".$this->config->item('base_url').'PreferenceRfid/editPreferenceRfidScan/'.$val['preference_rfid_id']."' onClick='javascript:return confirm(\"Apakah anda yakin ingin Mengganti mode alat?\")' class='btn default btn-xs blue'>
																<i class='fa fa-edit'></i> Ubah
															</a>
														";
													}else{
														echo"
															<a href='".$this->config->item('base_url').'PreferenceRfid/editPreferenceRfidAdd/'.$val['preference_rfid_id']."' onClick='javascript:return confirm(\"Apakah anda yakin ingin Mengganti mode alat?\")' class='btn default btn-xs blue'>
																<i class='fa fa-edit'></i> Ubah
															</a>
														";
													}
													echo"
													</td>
												</tr>
											";
											$no++;
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php echo form_close(); ?>