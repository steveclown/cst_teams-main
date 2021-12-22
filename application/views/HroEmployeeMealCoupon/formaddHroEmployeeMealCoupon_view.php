<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"HroEmployeeMealCoupon/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeMealCoupon/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeMealCoupon/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
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
								<a href="<?php echo base_url();?>HroEmployeeMealCoupon">
									Daftar Kupon Makanan Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>HroEmployeeMealCoupon/AddHROEmployeeMealCoupon">
									Tambah Kupon Makanan Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<!-- END PAGE TITLE & BREADCRUMB-->
					<h1 class="page-title">
						Kupon Makanan Karyawan
					</h1>

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
					</div>
					<div class="portlet-body form">
						<div class="form-body">
							<?php 
								echo form_open('HroEmployeeMealCoupon/processAddHROEmployeeMealCoupon',array('id' => 'myform', 'class' => 'horizontal-form')); 
								$unique 	= $this->session->userdata('unique');
								$data 		= $this->session->userdata('addarrayHroEmployeeMealCoupon-'.$unique['unique']);
							?>
							
							<div class = "row">
								<div class="col-md-6">
									<div class="form-group form-md-line-input">
										<input type="text" name="employee_rfid_code" id="employee_rfid_code" value="<?php echo $data['employee_rfid_code']?>" class="form-control" onChange="function_elements_add(this.name, this.value);" autofocus>
										<label class="control-label">Kode RFID Karyawan</label>
									</div>	
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue">
					<div class="portlet-title">
						<div class="caption">
							Form Tambah
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box blue">
								<div class="portlet-body form">
									<div class="form-body">
										<?php
											$unique 	= $this->session->userdata('unique');
											$data 		= $this->session->userdata('addarrayHroEmployeeMealCoupon-'.$unique['unique']);
										?>
										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_code" id="employee_code" value="<?php echo $data['employee_code'];?>" class="form-control" readonly>
													<span class="help-block">
														 Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Kode Karyawan</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="employee_name" id="employee_name" value="<?php echo $data['employee_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														  Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Nama Karyawan 
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="division_name" id="division_name" value="<?php echo $data['division_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Nama Devisi
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="department_name" id="department_name" value="<?php echo $data['department_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Nama Departemen
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="section_name" id="section_name" value="<?php echo $data['section_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Nama Bagian
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>

											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="unit_name" id="unit_name" value="<?php echo $data['unit_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Nama Satuan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>

										<div class = "row">
											<div class = "col-md-6">
												<div class="form-group form-md-line-input">
													<input type="text" name="job_title_name" id="job_title_name" value="<?php echo $data['job_title_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
													<span class="help-block">
														 Mohon hanya diisi karater huruf dan angka
													</span>

													<label class="control-label">Nama Pekerjaan
														<span class="required">
															*
														</span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>