<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"HroEmployeeTransferCkp/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeTransferCkp/function_elements_add');?>",
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
				url : "<?php echo site_url('HroEmployeeTransferCkp/function_state_add');?>",
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
								<a href="<?php echo base_url();?>HroEmployeeTransferCkp">
									Daftar Transfer Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeTransferCkp/addHROEmployeeTransfer/<?php echo $hroemployeedata['employee_id']?>">
									Tambah Transfer Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Transfer Karyawan - <?php echo $hroemployeedata['employee_name']?> -
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
					Data Karyawan
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="division_id" id="division_id" value="<?php echo $this->HroEmployeeTransferCkp_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Devisi</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="department_id" id="department_id" value="<?php echo $this->HroEmployeeTransferCkp_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Departemen</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="section_id" id="section_id" value="<?php echo $this->HroEmployeeTransferCkp_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
								<label class="control-label">Bagian </label>
							</div>	
						</div>
					</div>
				</div>
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
								<div class="actions">
									<a href="<?php echo base_url();?>HroEmployeeTransferCkp" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('HroEmployeeTransferCkp/processAddHROEmployeeTransfer',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addhrolemployeetransfer');
										if ($data['employee_transfer_date']==''){
											$data['employee_transfer_date'] = date('Y-m-d');
										}

										if(empty($data['region_id'])){
											$data['region_id']=9;
										}
										if(empty($data['branch_id'])){
											$data['branch_id']=9;
										}
										if(empty($data['location_id'])){
											$data['location_id']=9;
										}
										if(empty($data['division_id'])){
											$data['division_id']=9;
										}
										if(empty($data['department_id'])){
											$data['department_id']=9;
										}
										if(empty($data['unit_id'])){
											$data['unit_id']=9;
										}
										if(empty($data['job_title_id'])){
											$data['job_title_id']=9;
										}
										if(empty($data['grade_id'])){
											$data['grade_id']=9;
										}
										if(empty($data['class_id'])){
											$data['class_id']=9;
										}
										if (empty($data['section_id'])) {
											$data['section_id']=9;
										}
										if(empty($data['employee_transfer_remark'])){
											$data['employee_transfer_remark']="";
										}

									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_transfer_date" id="employee_transfer_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_transfer_date']);?>"/>
												<label class="control-label">Tanggal Transfer
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="region_id_last" id="region_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getRegionName($HroEmployeeTransferCkp_last['region_id'])?>" class="form-control" readonly>
												<label class="control-label">Wilayah Terakhir  </label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('region_id', $coreregion, $data['region_id'], 'id ="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Wilayah
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="branch_id_last" id="branch_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getBranchName($HroEmployeeTransferCkp_last['branch_id'])?>" class="form-control" readonly>
												<label class="control-label">Cabang Terakhir </label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('branch_id', $corebranch, $data['branch_id'], 'id ="branch_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Cabang
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="location_id_last" id="location_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getLocationName($HroEmployeeTransferCkp_last['location_id'])?>" class="form-control" readonly>
												<label class="control-label">Lokasi Terakhir </label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('location_id', $corelocation, $data['location_id'], 'id ="location_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Lokasi
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="division_id_last" id="division_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getSectionName($HroEmployeeTransferCkp_last['division_id'])?>" class="form-control" readonly>
												<label class="control-label">Devisi Terakhir</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('division_id', $coredivision, $data['division_id'], 'id ="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Devisi
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="department_id_last" id="department_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getDepartmentName($HroEmployeeTransferCkp_last['department_id'])?>" class="form-control" readonly>
												<label class="control-label">Departemen Terakhir </label>
											</div>
										</div>		

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('department_id', $coredepartment, $data['department_id'], 'id ="department_id", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Departemen
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="section_id_last" id="section_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getSectionName($HroEmployeeTransferCkp_last['section_id'])?>" class="form-control" readonly>
												<label class="control-label">Bagian Terakhir</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('section_id', $coresection, $data['section_id'], 'id ="section_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Bagian
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="unit_id_last" id="unit_id_last" value="<?php echo $coreunit[$HroEmployeeTransferCkp_last['unit_id']]?>" class="form-control" readonly>
												<label class="control-label">Satuan Terakhir</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('unit_id', $coreunit, $data['unit_id'], 'id ="unit_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Satuan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="job_title_id_last" id="job_title_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getJobTitleName($HroEmployeeTransferCkp_last['job_title_id'])?>" class="form-control" readonly>
												<label class="control-label">Pekerjaan Terakhir</label>
											</div>
										</div>	

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('job_title_id', $corejobtitle, $data['job_title_id'], 'id ="job_title_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Pekerjaan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="grade_id_last" id="grade_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getGradeName($HroEmployeeTransferCkp_last['grade_id'])?>" class="form-control" readonly>
												<label class="control-label">Tingkat Terakhir</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('grade_id', $coregrade, $data['grade_id'], 'id ="grade_id", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Tingkat
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class ="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="class_id_last" id="class_id_last" value="<?php echo $this->HroEmployeeTransferCkp_model->getClassName($HroEmployeeTransferCkp_last['class_id'])?>" class="form-control" readonly>
												<label class="control-label">Kelas Terakhir </label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('class_id', $coreclass, $data['class_id'], 'id ="class_id", class="form-control select2me " onChange="function_elements_add(this.name, this.value);"');?>
												<label class="col-md-3 control-label">Kelas
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="employee_transfer_remark" id="employee_transfer_remark" class="form-control"><?php echo $data['employee_transfer_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
