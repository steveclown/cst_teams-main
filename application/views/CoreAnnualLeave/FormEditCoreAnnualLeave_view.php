
<script>
function ulang(){
	document.getElementById("annual_leave_code").value = "<?php echo $CoreAnnualLeave['annual_leave_code'] ?>";
	document.getElementById("annual_leave_name").value = "<?php echo $CoreAnnualLeave['annual_leave_name'] ?>";
	document.getElementById("annual_leave_id").value = "<?php echo $CoreAnnualLeave['annual_leave_id'] ?>";
}
</script>


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
								<a href="<?php echo base_url();?>CoreAnnualLeave">
									Daftar Cuti tahunan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreAnnualLeave/edit/<?php echo $CoreAnnualLeave['annual_leave_id']?>">
									Edit Cuti tahunan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
					Form Edit Cuti tahunan
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
									<a href="<?php echo base_url();?>CoreAnnualLeave" class="btn btn-default btn-sm`">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreAnnualLeave/processEditCoreAnnualLeave',array('id' => 'myform', 'class' => 'horizontal-form')); 
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="annual_leave_code" id="annual_leave_code" value="<?php echo $CoreAnnualLeave['annual_leave_code']?>" class="form-control">
												<span class="help-block">
													Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Cuti tahunan
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="annual_leave_name" id="annual_leave_name" value="<?php echo $CoreAnnualLeave['annual_leave_name']?>" class="form-control">
												<label class="control-label">Nama Cuti tahunan</label>
											</div>
										</div>
									</div>	
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="annual_leave_days" id="annual_leave_days" value="<?php echo $CoreAnnualLeave['annual_leave_days']?>" class="form-control" >
												<span class="help-block">
													Please input only numbers.
												</span>
												<label class="control-label">Hari Cuti tahunan</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('annual_leave_type', $annualleavetype ,set_value('annual_leave_type',$CoreAnnualLeave['annual_leave_type']),'id="annual_leave_type", class="form-control select2me"');?>
												<label class="control-label col-md-3">Tipe Cuti tahunan</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="annual_leave_remark" id="annual_leave_remark" class="form-control" placeholder="Remark"><?php echo $CoreAnnualLeave['annual_leave_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>
										<input type="hidden" name="annual_leave_id" value="<?php echo $CoreAnnualLeave['annual_leave_id']; ?>"/>
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
				
