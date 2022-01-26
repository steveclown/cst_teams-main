<?php

?>
<script>
	function ulang(){
		document.getElementById("cost_budget_code").value = "";
		document.getElementById("cost_budget_name").value = "";
		document.getElementById("cost_budget_amount").value = "";
	}
</script>
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
								<a href="<?php echo base_url();?>CoreCostBudget">
									Daftar Anggaran Biaya
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreCostBudget/addCoreCostBudget">
									Tambah Anggaran Biaya
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Anggaran Biaya
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>CoreCostBudget" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreCostBudget/processAddCoreCostBudget',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddAllowance');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="cost_budget_code" id="cost_budget_code" value="<?php echo $data['cost_budget_code'];?>" class="form-control">
												<span class="help-block">
													Mohon hanya isi dengan karakter huruf dan angka saja.
												</span>
												<label class="control-label">Kode Anggaran Biaya
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="cost_budget_name" id="cost_budget_name" value="<?php echo $data['cost_budget_name'];?>" class="form-control">
												<label class="control-label">Nama Anggaran Biaya
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
										
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="cost_budget_amount" id="cost_budget_amount" value="<?php echo $data['cost_budget_amount'];?>" class="form-control">
												<label class="control-label">Jumlah Anggaran Biaya
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
										
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
