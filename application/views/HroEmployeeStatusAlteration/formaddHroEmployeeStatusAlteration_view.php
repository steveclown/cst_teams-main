<script>
	base_url 	= '<?php echo base_url();?>';

	function reset_add(){
		document.location = base_url+"HroEmployeeStatusAlteration/reset_add/<?php echo $hroemployeedata['employee_id']; ?>";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeStatusAlteration/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeStatusAlteration/function_state_add');?>",
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
								<a href="<?php echo base_url();?>transactionalstatusalterationbyemployee">
									Daftar Perubahan Status
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>HroEmployeeStatusAlteration/addHROEmployeeStatusAlteration/<?php echo $hroemployeedata['employee_id']?>">
									Tambah Perubahan Status
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Perubahan Status - <?php echo $hroemployeedata['employee_name']?> - <?php echo $employeeemploymentstatus[$hroemployeedata['employee_employment_status']] ?>
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
<div class="col-md-6">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Data Karyawan
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 

						$unique = $this->session->userdata('unique');

						$data 	=  $this->session->userdata('addHroEmployeeStatusAlteration-'.$unique['unique']);	

						if (empty($data['status_alteration_date'])){
							$data['status_alteration_date'] = date('d-m-Y');
						}

						if (empty($data['status_alteration_last_date'])){
							$data['status_alteration_last_date'] = date('d-m-Y');
						}
						if (empty($data['status_alteration_description'])){
							$data['status_alteration_description'] = "";
						}
						if (empty($data['status_alteration_remark'])){
							$data['status_alteration_remark'] = "";
						}
						if (empty($data['employee_employment_status'])){
							$data['employee_employment_status'] = "";
						}

					?>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_name" id="employee_name" class="form-control" value="<?php echo $hroemployeedata['employee_name']?>" readonly>
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_code" id="employee_code" class="form-control" value="<?php echo $hroemployeedata['employee_code']?>" readonly>
								<label class="control-label">Kode Karyawan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
								if ($hroemployeestatusalteration_last==true) {
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$hroemployeestatusalteration_last['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								} else{
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$hroemployeedata['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								}
								?>
								<label class="control-label">Status Pekerjaan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="status_alteration_date" id="status_alteration_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['status_alteration_date']);?>">
								<label class="control-label">Tanggal Perubahan Status</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="status_alteration_last_date" id="status_alteration_last_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['status_alteration_last_date']);?>">
								<label class="control-label">Perubahan Status Tanggal Terakhir</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="text" name="status_alteration_description" id="status_alteration_description" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Deskripsi</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<!-- <input type="text" name="employee_id" id="employee_id" value="<?php echo $hroemployeedata['employee_id']?>" class="form-control" readonly>
								<input type="text" name="applicant_id" id="applicant_id" value="<?php echo $hroemployeedata['applicant_id']?>" class="form-control" readonly>
								<input type="text" name="marital_status_id" id="marital_status_id" value="<?php echo $hroemployeedata['marital_status_id']?>" class="form-control" readonly>
								<input type="text" name="region_id" id="region_id" value="<?php echo $hroemployeedata['region_id']?>" class="form-control" readonly>
								<input type="text" name="branch_id" id="branch_id" value="<?php echo $hroemployeedata['branch_id']?>" class="form-control" readonly>
								<input type="text" name="company_id" id="company_id" value="<?php echo $hroemployeedata['company_id']?>" class="form-control" readonly>
								<input type="text" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_id']?>" class="form-control" readonly>
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_id']?>" class="form-control" readonly>
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_id']?>" class="form-control" readonly>
								<input type="text" name="unit_id" id="unit_id" value="<?php echo $hroemployeedata['unit_id']?>" class="form-control" readonly>
								<input type="text" name="job_title_id" id="job_title_id" value="<?php echo $hroemployeedata['job_title_id']?>" class="form-control" readonly>
								<input type="text" name="grade_id" id="grade_id" value="<?php echo $hroemployeedata['grade_id']?>" class="form-control" readonly>
								<input type="text" name="class_id" id="class_id" value="<?php echo $hroemployeedata['class_id']?>" class="form-control" readonly>
								<input type="text" name="location_id" id="location_id" value="<?php echo $hroemployeedata['location_id']?>" class="form-control" readonly>
								<input type="text" name="bank_id" id="bank_id" value="<?php echo $hroemployeedata['bank_id']?>" class="form-control" readonly>
								<textarea rows="3" name="status_alteration_remark" id="status_alteration_remark" class="form-control"></textarea> -->
								<label class="control-label">Keterangan</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Perubahan Data Karyawan
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>HroEmployeeStatusAlteration" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Kembali
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('HroEmployeeStatusAlteration/processAddHROEmployeeStatusAlteration',array('id' => 'myform', 'class' => 'horizontal-form')); 

						$unique = $this->session->userdata('unique');

						$data 	=  $this->session->userdata('addHroEmployeeStatusAlteration-'.$unique['unique']);	

						if (empty($data['status_alteration_date'])){
							$data['status_alteration_date'] = date('d-m-Y');
						}

						if (empty($data['status_alteration_last_date'])){
							$data['status_alteration_last_date'] = date('d-m-Y');
						}
						if (empty($data['status_alteration_description'])){
							$data['status_alteration_description'] = "";
						}
						if (empty($data['status_alteration_remark'])){
							$data['status_alteration_remark'] = "";
						}
						if (empty($data['employee_employment_status'])){
							$data['employee_employment_status'] = "";
						}

					?>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
								if ($hroemployeestatusalteration_last==true) {
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$hroemployeestatusalteration_last['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								} else{
									echo form_dropdown('employee_employment_status', $employeeemploymentstatus, set_value('employee_employment_status',$hroemployeedata['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
								}
								?>
								<label class="control-label">Status Pekerjaan</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="status_alteration_date" id="status_alteration_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['status_alteration_date']);?>">
								<label class="control-label">Tanggal Perubahan Status</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="status_alteration_last_date" id="status_alteration_last_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['status_alteration_last_date']);?>">
								<label class="control-label">Perubahan Status Tanggal Terakhir</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<input type="text" name="status_alteration_description" id="status_alteration_description" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Deskripsi</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<!-- <input type="text" name="employee_id" id="employee_id" value="<?php echo $hroemployeedata['employee_id']?>" class="form-control" readonly>
								<input type="text" name="applicant_id" id="applicant_id" value="<?php echo $hroemployeedata['applicant_id']?>" class="form-control" readonly>
								<input type="text" name="marital_status_id" id="marital_status_id" value="<?php echo $hroemployeedata['marital_status_id']?>" class="form-control" readonly>
								<input type="text" name="region_id" id="region_id" value="<?php echo $hroemployeedata['region_id']?>" class="form-control" readonly>
								<input type="text" name="branch_id" id="branch_id" value="<?php echo $hroemployeedata['branch_id']?>" class="form-control" readonly>
								<input type="text" name="company_id" id="company_id" value="<?php echo $hroemployeedata['company_id']?>" class="form-control" readonly>
								<input type="text" name="division_id" id="division_id" value="<?php echo $hroemployeedata['division_id']?>" class="form-control" readonly>
								<input type="text" name="department_id" id="department_id" value="<?php echo $hroemployeedata['department_id']?>" class="form-control" readonly>
								<input type="text" name="section_id" id="section_id" value="<?php echo $hroemployeedata['section_id']?>" class="form-control" readonly>
								<input type="text" name="unit_id" id="unit_id" value="<?php echo $hroemployeedata['unit_id']?>" class="form-control" readonly>
								<input type="text" name="job_title_id" id="job_title_id" value="<?php echo $hroemployeedata['job_title_id']?>" class="form-control" readonly>
								<input type="text" name="grade_id" id="grade_id" value="<?php echo $hroemployeedata['grade_id']?>" class="form-control" readonly>
								<input type="text" name="class_id" id="class_id" value="<?php echo $hroemployeedata['class_id']?>" class="form-control" readonly>
								<input type="text" name="location_id" id="location_id" value="<?php echo $hroemployeedata['location_id']?>" class="form-control" readonly>
								<input type="text" name="bank_id" id="bank_id" value="<?php echo $hroemployeedata['bank_id']?>" class="form-control" readonly>
								<textarea rows="3" name="status_alteration_remark" id="status_alteration_remark" class="form-control"></textarea> -->
								<label class="control-label">Keterangan</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="reset_add();"><i class="fa fa-times"></i> Batal</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
				</div>
				<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id'] ?>">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<!-- TABLE RECORD -->

<div class="row">
	<div class="col-md-12">	
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
			</div>
			<div class="portlet-body ">
				<!-- BEGIN FORM-->
				<div class="form-body">
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th>Status Pekerjaan</th>
											<th>Tanggal Perubahan Status</th>
											<th>Tanggal Perubahan Status Terakhir</th>
											<th>Deskripsi</th>
											<th>Keterangan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>

									<?php
										if(!is_array($hroemployeestatusalteration)){
											echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
										} else {
											foreach ($hroemployeestatusalteration as $key=>$g){
												echo"
													<tr>
														<td>".$this->configuration->EmployeeStatus()[$g['employee_employment_status']]."</td>
														<td>".tgltoview($g['status_alteration_date'])."</td>
														<td>".tgltoview($g['status_alteration_last_date'])."</td>
														<td>".$g['status_alteration_description']."</td>
														<td>".$g['status_alteration_remark']."</td>
														<td>
														<a href='".$this->config->item('base_url').'hroemployeestatusalteration/deleteHROEmployeeStatusAlteration/'.$g['status_alteration_id'].'/'.$g['employee_employment_status'].'/'.$g['employee_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
															<i class='fa fa-trash-o'></i> Delete</a>";
														echo"
													</tr>
													
												";
											}
										}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

