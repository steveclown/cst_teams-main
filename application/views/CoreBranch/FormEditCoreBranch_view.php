<script>
function ulang(){
	document.getElementById("branch_code").value = "<?php echo $corebranch['branch_code'] ;?>";
	document.getElementById("branch_name").value = "<?php echo $corebranch['branch_name'] ;?>";
	document.getElementById("region_name").value = "<?php echo $corebranch['region_name'] ;?>";
	document.getElementById("branch_address").value = "<?php echo $corebranch['branch_address'] ;?>";
	document.getElementById("branch_contact_person").value = "<?php echo $corebranch['branch_contact_person'] ;?>";
	document.getElementById("branch_mobile_phone1").value = "<?php echo $corebranch['branch_mobile_phone1'] ;?>";
	document.getElementById("branch_mobile_phone2").value = "<?php echo $corebranch['branch_mobile_phone2'] ;?>";
	document.getElementById("branch_email").value = "<?php echo $corebranch['branch_email'] ;?>";
}
</script>
				<div class = "page-bar">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<ul class="page-breadcrumb">
						<li>
							<a href="<?php echo base_url();?>">
								Beranda
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>CoreBranch">
								Daftar Cabang
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>CoreBranch/editCoreBranch/<?php echo $corebranch['branch_id'];?>">
								Edit Cabang
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Edit Cabang
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
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>branch" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreBranch/processEditCoreBranch',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<?php echo form_dropdown('region_id', $coreregion, $corebranch['region_id'], 'id ="region_id", class="form-control select2me"');?>
												<label class="control-label">Nama Wilayah<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="branch_code" id="branch_code" value="<?php echo $corebranch['branch_code'];?>" class="form-control">
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Cabang <span class="required">*</span></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" autocomplete="off"  name="branch_name" id="branch_name" value="<?php echo $corebranch['branch_name'];?>" class="form-control">
												<label class="control-label">Nama Cabang<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">											
												<textarea rows="3" name="branch_address" id="branch_address" class="form-control"><?php echo $corebranch['branch_address'];?></textarea>
												<label class="control-label">Alamat Cabang<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">												
												<input type="text" autocomplete="off"  name="branch_contact_person" id="branch_contact_person" value="<?php echo $corebranch['branch_contact_person'];?>" class="form-control">
												<label class="control-label">Contact Person<span class="required">*</span></label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" autocomplete="off"  name="branch_phone1" id="branch_phone1" value="<?php echo $corebranch['branch_phone1'];?>" class="form-control">
												<label class="control-label">No Hp Cabang 1<span class="required">*</span></label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" autocomplete="off"  name="branch_phone2" id="branch_phone2" value="<?php echo $corebranch['branch_phone2'];?>" class="form-control">
												<label class="control-label">No Hp Cabang 2</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" autocomplete="off"  name="branch_email" id="branch_email" value="<?php echo $corebranch['branch_email'];?>" class="form-control">
												<label class="control-label">Email Cabang<span class="required">*</span></label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="branch_id" value="<?php echo $corebranch['branch_id']; ?>"/>
<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>