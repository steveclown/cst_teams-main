<script>
	base_url = '<?php base_url()?>';
	
</script>
<div class="workplace" style="padding:5px !important;"> 
<?php
	$this->load->view('CoreDeduction/formaddCoreDeduction_view');		 
?>


<?php 
	echo form_open('CoreDeduction/processAddCoreDeduction'); 
	$sesi 					= $this->session->userdata('unique');
	$data					= $this->session->userdata('CoreDeduction-'.$sesi['unique']);
	$CoreDeductionallowance	= $this->session->userdata($data['created_on']);

	print_r("CoreDeductionallowance");
	print_r($CoreDeductionallowance);
?>
				
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>Daftar
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">									
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Tunjangan</th>
									<th>Rasio Potongan Tunjangan</th>
									<th>AksiV</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($CoreDeductionallowance)){
									foreach($CoreDeductionallowance as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->CoreDeduction_model->getAllowanceName($val['allowance_id'])."</td>
												<td>".$val['deduction_allowance_ratio']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'CoreDeduction/deleteArrayDeductionAllowance/'.$val['created_on'].'/'.$val['allowance_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Hapus
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='11' style='text-align:center;'>
												<b>No Data</b>
											</td>
										</tr>
									";
								}
							?>		
							<tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>

		