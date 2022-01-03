<script>
	function ulang(){
		document.getElementById("deduction_id").value = "";
		document.getElementById("deduction_name").value = "";
	}

	function reset_add(){
		document.location = "<?php echo base_url();?>CoreDeduction/reset_add";
	}
</script>
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
								<a href="<?php echo base_url();?>CoreDeduction">
									Daftar Potongan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>CoreDeduction/addCoreDeduction">
									Tambah Potongan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Potongan
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
									<a href="<?php echo base_url();?>CoreDeduction" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('deduction/process-add',array('id' => 'myform', 'class' => 'horizontal-form')); 

											echo $this->session->userdata('message');
											$this->session->unset_userdata('message');

											$unique 		= $this->session->userdata('unique');
											$data 			= $this->session->userdata('addCoreDeduction-'.$unique['unique']);
											$deduction_token	= $this->session->userdata('CoreDeductionToken-'.$unique['unique']);

											if(empty($data['deduction_code']))
											{
												$data['deduction_code'] 					= '';
											}

											if(empty($data['deduction_name'])){
											$data['deduction_name'] 					= '';
										}
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_code" id="deduction_code" class="form-control" value="<?php echo $data['deduction_code']?>" onChange="function_elements_add(this.name, this.value);">
												<span class="help-block">
													Mohon hanya diisi karakter huruf dan angka.
												</span>
												<label class="control-label">Kode Potongan
													<span class="required">
													*
													</span>
												</label>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_name" id="deduction_name" class="form-control" value="<?php echo $data['deduction_name']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Potongan</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Tipe Potongan
												<span class="required">
												*
												</span></label>												
												<?php echo form_dropdown('deduction_type', $deductiontype, $data['deduction_type'], 'id ="deduction_type", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_amount" id="deduction_amount" class="form-control" value="<?php echo $data['deduction_amount']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Jumlah Potongan </label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_premi_attendance_ratio" id="deduction_premi_attendance_ratio" class="form-control" value="<?php echo $data['deduction_premi_attendance_ratio']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Rasio Potongan Premi Kehadiran</label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<?php 
													echo form_dropdown('deduction_premi_attendance_status', $deductionpremiattendancestatus ,set_value('deduction_premi_attendance_status', $data['deduction_premi_attendance_status']),'id="allowance_id", class="form-control select2me"');
												?>
												<label class="control-label">Status Potongan Premi Kehadiran</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_basic_salary_ratio" id="deduction_basic_salary_ratio" class="form-control" value="<?php echo $data['deduction_basic_salary_ratio']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Rasio Potongan Gaji Pokok</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_late_start_duration" id="deduction_late_start_duration" class="form-control" value="<?php echo $data['deduction_late_start_duration']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Potongan Keterlambatan Awal</label>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="deduction_late_end_duration" id="deduction_late_end_duration" class="form-control" value="<?php echo $data['deduction_late_end_duration']?>" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Potongan Keterlambatan Akhir</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="deduction_remark" id="deduction_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $data['deduction_remark']?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>
										
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>