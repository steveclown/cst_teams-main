<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"HroEmployeeAbsence/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAbsence/function_elements_add');?>",
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
				url : "<?php echo site_url('HroEmployeeAbsence/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<!-- <?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?> -->

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeAbsence">
									Daftar Absen Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeAbsence/addHROEmployeeAbsence/<?php echo $hroemployeedata['employee_id']?>">
									Tambah Absen Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Absen jaryawan - <?php echo $hroemployeedata['employee_name'];?> -
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			

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
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedata['employee_name']?>" class="form-control" readonly>
								<label class="control-label">nama Karyawan</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->HroEmployeeAbsence_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Divisi</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->HroEmployeeAbsence_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Departemen</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->HroEmployeeAbsence_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
									<a href="<?php echo base_url();?>HroEmployeeAbsence" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('HroEmployeeAbsence/processAddHROEmployeeAbsence',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$data = $this->session->userdata('addHroEmployeeAbsence');
									?>
									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_absence_date" id="employee_absence_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_absence_date']);?>"/>
												<label class="control-label">Data Absen
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('absence_id', $coreabsence ,set_value('absence_id',$data['absence_id']),'id="absence_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Absen</label>
											</div>
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_absence_start_date" id="employee_absence_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_absence_start_date']);?>"/>
												<label class="control-label">Tanggal Mulai Absen
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_absence_end_date" id="employee_absence_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_absence_end_date']);?>"/>
												<label class="control-label">Tanggal Selesai Absen
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
												<input type="text" class="form-control" id="employee_absence_description" name="employee_absence_description" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_absence_description'];?>">
												<label class="control-label">Deskripsi Absen </label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="employee_absence_duration" name="employee_absence_duration" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_absence_duration'];?>">
												<label class="control-label">Durasi Ambesn</label>
											</div>	
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="employee_absence_remark" id="employee_absence_remark" onChange="function_elements_add(this.name, this.value);" class="form-control"><?php echo $data['employee_absence_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>
								</div>
								<div class="form-actions right">
									<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id']; ?>"/>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
