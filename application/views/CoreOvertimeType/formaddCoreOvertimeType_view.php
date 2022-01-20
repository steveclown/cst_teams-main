<script>
	function ulang(){
		document.getElementById("overtime_type_code").value = "";
		document.getElementById("overtime_type_name").value = "";
		document.getElementById("overtime_working_day_ratio").value = "";
		document.getElementById("overtime_day_off_ratio").value = "";
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
								<a href="<?php echo base_url();?>CoreOvertimeType/addCoreOvertimeType">
									Tambah Tipe Lembur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Tipe Lembur
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
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>overtime-type" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('overtime-type/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

											echo $this->session->userdata('message');
											$this->session->unset_userdata('message');

											$unique 		= $this->session->userdata('unique');
											$data 			= $this->session->userdata('addCoreOvertimeType-'.$unique['unique']);
											$overtime_type_token	= $this->session->userdata('CoreOvertimeTypeToken-'.$unique['unique']);

											if(empty($data['overtime_type_code']))
											{
												$data['overtime_type_code'] 					= '';
											}

											if(empty($data['overtime_type_name'])){
											$data['overtime_type_name'] 					= '';
										}
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_code" id="overtime_type_code" value="<?php echo $data['overtime_type_code']?>" class="form-control" >
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
												<input type="text" name="overtime_type_name" id="overtime_type_name" value="<?php echo $data['overtime_type_name']?>" class="form-control" >
												<label class="control-label"> Nama Tipe Lembur
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
												<input type="text" name="overtime_type_working_day_hour1" id="overtime_type_working_day_hour1" value="<?php echo $data['overtime_type_working_day_hour1']?>" class="form-control">
												<label class="control-label">Jam hari kerja 1</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_working_day_ratio1" id="overtime_type_working_day_ratio1" value="<?php echo $data['overtime_type_working_day_ratio1']?>" class="form-control" >
												<label class="control-label">Ratio hari kerja 1</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_working_day_hour2" id="overtime_type_working_day_hour2" value="<?php echo $data['overtime_type_working_day_hour2']?>" class="form-control">
												<label class="control-label">Jam hari kerja 2</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_working_day_ratio2" id="overtime_type_working_day_ratio2" value="<?php echo $data['overtime_type_working_day_ratio2']?>" class="form-control" >
												<label class="control-label">Ratio hari kerja 2</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_hour1" id="overtime_type_day_off_hour1" value="<?php echo $data['overtime_type_day_off_hour1']?>" class="form-control">
												<label class="control-label">Jam Libur 1</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_ratio1" id="overtime_type_day_off_ratio1" value="<?php echo $data['overtime_type_day_off_ratio1']?>" class="form-control" >
												<label class="control-label">Ratio Libur 1</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_hour2" id="overtime_type_day_off_hour2" value="<?php echo $data['overtime_type_day_off_hour2']?>" class="form-control">
												<label class="control-label">Jam Libur 2</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_type_day_off_ratio2" id="overtime_type_day_off_ratio2" value="<?php echo $data['overtime_type_day_off_ratio2']?>" class="form-control" >
												
												<input type="hidden" name="overtime_type_token" id="overtime_type_token" class="form-control" value="<?php echo $overtime_type_token?>" onChange="function_elements_add(this.name, this.value);">	

												<label class="control-label">Ratio Libur 2</label>
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
