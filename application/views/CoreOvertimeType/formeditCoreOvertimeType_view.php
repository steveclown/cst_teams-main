<script>
function ulang(){
	document.getElementById("overtime_type_code").value = "<?php echo $CoreOvertimeType['overtime_type_code'] ?>";
	document.getElementById("overtime_type_name").value = "<?php echo $result['overtime_type_name'] ?>";
	document.getElementById("overtime_working_day_ratio").value = "<?php echo $result['overtime_working_day_ratio'] ?>";
	document.getElementById("overtime_day_off_ratio").value = "<?php echo $result['overtime_day_off_ratio'] ?>";
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
								<a href="<?php echo base_url();?>CoreOvertimeType">
									Daftar Tipe Lembur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreOvertimeType/editCoreOvertimeType/<?php echo $CoreOvertimeType['overtime_type_id']?>">
									Edit Tipe Lembur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Tipe Lembur
					</h1>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
			<!-- END PAGE TITLE & BREADCRUMB-->
	
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>CoreOvertimeType" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('CoreOvertimeType/processEditCoreOvertimeType',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('AddOvertimeType');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_code" id="overtime_type_code" value="<?php echo $CoreOvertimeType['overtime_type_code']?>" class="form-control" >
												<span class="help-block">
													 Please input only alpha-numerical characters.
												</span>
												<label class="control-label">Kode Tipe Lembur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_name" id="overtime_type_name" value="<?php echo $CoreOvertimeType['overtime_type_name']?>" class="form-control" >
												<label class="control-label">Nama Tipe Lembur
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
												<input type="text" name="overtime_type_working_day_hour1" id="overtime_type_working_day_hour1" value="<?php echo $CoreOvertimeType['overtime_type_working_day_hour1']?>" class="form-control">
												<label class="control-label">jam hari kerja 1</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_working_day_ratio1" id="overtime_type_working_day_ratio1" value="<?php echo $CoreOvertimeType['overtime_type_working_day_ratio1']?>" class="form-control" >
												<label class="control-label">Ratio Hari Kerja 1</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_working_day_hour2" id="overtime_type_working_day_hour2" value="<?php echo $CoreOvertimeType['overtime_type_working_day_hour2']?>" class="form-control">
												<label class="control-label">jam hari kerja 2</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_working_day_ratio2" id="overtime_type_working_day_ratio2" value="<?php echo $CoreOvertimeType['overtime_type_working_day_ratio2']?>" class="form-control" >
												<label class="control-label">Ratio Hari Kerja 2</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_hour1" id="overtime_type_day_off_hour1" value="<?php echo $CoreOvertimeType['overtime_type_day_off_hour1']?>" class="form-control">
												<label class="control-label">Jam libur1</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_ratio1" id="overtime_type_day_off_ratio1" value="<?php echo $CoreOvertimeType['overtime_type_day_off_ratio1']?>" class="form-control" >
												<label class="control-label">Ratio Libur 1</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_hour2" id="overtime_type_day_off_hour2" value="<?php echo $CoreOvertimeType['overtime_type_day_off_hour2']?>" class="form-control">
												<label class="control-label">Jam libur 2</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_ratio2" id="overtime_type_day_off_ratio2" value="<?php echo $CoreOvertimeType['overtime_type_day_off_ratio2']?>" class="form-control" >
												<label class="control-label">Ratio Libur 2</label>
											</div>
										</div>
									</div>
									
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="overtime_type_id" value="<?php echo $CoreOvertimeType['overtime_type_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
				
