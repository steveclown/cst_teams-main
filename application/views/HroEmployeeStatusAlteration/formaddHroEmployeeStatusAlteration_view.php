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
								<label class="control-label">Nama Karyawan</label>
							</div>
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="division_id" id="division_id" value="<?php echo $this->HroEmployeeStatusAlteration_model->getDivisionName($hroemployeedata['division_id'])?>" class="form-control" readonly>
								<label class="control-label">Devisi</label>
							</div>	
						</div>
					</div>
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="department_id" id="department_id" value="<?php echo $this->HroEmployeeStatusAlteration_model->getDepartmentName($hroemployeedata['department_id'])?>" class="form-control" readonly>
								<label class="control-label">Departemen</label>
							</div>	
						</div>
					
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="section_id" id="section_id" value="<?php echo $this->HroEmployeeStatusAlteration_model->getSectionName($hroemployeedata['section_id'])?>" class="form-control" readonly>
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
								<?php echo form_dropdown('employee_employment_status', $employeeemploymentstatus ,set_value('employee_employment_status',$data['employee_employment_status']),'id="employee_employment_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
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
								<input type="text" name="status_alteration_description" id="status_alteration_description" value="<?php echo $data['status_alteration_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Deskripsi</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-12">
							<div class="form-group form-md-line-input">
								<textarea rows="3" name="status_alteration_remark" id="status_alteration_remark" class="form-control"><?php echo $data['status_alteration_remark'];?></textarea>
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
