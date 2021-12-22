<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"RecruitmentEmployeeRequest/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('RecruitmentEmployeeRequest/function_elements_add');?>",
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
				url : "<?php echo site_url('RecruitmentEmployeeRequest/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
	/*function processAddArrayRecruitmentEmployeeRequest(){

		
		var region_id 					= document.getElementById("region_id").value;
		var branch_id 					= document.getElementById("branch_id").value;
		var location_id 				= document.getElementById("location_id").value;
		var division_id 				= document.getElementById("division_id").value;
		var department_id 				= document.getElementById("department_id").value;
		var section_id					= document.getElementById("section_id").value;
		var job_title_id 				= document.getElementById("job_title_id").value;
		var education_id 				= document.getElementById("education_id").value;
		var expertise_id 				= document.getElementById("expertise_id").value;
		var employee_request_item_total = document.getElementById("employee_request_item_total").value;
		var employee_request_item_description = document.getElementById("employee_request_item_description").value;
		var employee_request_item_remark = document.getElementById("employee_request_item_remark").value;
		

		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('RecruitmentEmployeeRequest/processAddArrayRecruitmentEmployeeRequest');?>",
			  data: {
			  		
			  		'region_id' 						: region_id,
					'branch_id' 						: branch_id,
					'location_id' 						: location_id,
					'division_id' 						: division_id,
					'department_id'						: department_id, 
					'section_id'						: section_id, 
					'job_title_id' 						: job_title_id,
					'education_id' 						: education_id,
					'expertise_id' 						: expertise_id,
					'employee_request_item_total' 		: employee_request_item_total,
					'employee_request_item_description'	: employee_request_item_description, 
					'employee_request_remark'			: employee_request_remark, 

					'session_name' 							: "AddArrayRecruitmentEmployeeRequest-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}*/
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
							<a href="<?php echo base_url();?>RecruitmentEmployeeRequest">
								Daftar Permintaan Karyawan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>RecruitmentEmployeeRequest/addRecruitmentEmployeeRequest">
								Tambah Permintaan Karyawan
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h3 class="page-title">
					Form Tambah Permintaan Karyawan
				</h3>
				<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo form_open('RecruitmentEmployeeRequest/processAddArrayRecruitmentEmployeeRequest', array('id' => 'myform', 'class' => 'horizontal-form')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$data		= $this->session->userdata('addRecruitmentEmployeeRequest');
?>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	if(empty($data['created_id'])){
		$data['created_id']="";
	}
	if(empty($data['employee_request_title'])){
		$data['employee_request_title']="";
	}
	if(empty($data['employee_request_date'])){
		$data['employee_request_date']="";
	}
	if(empty($data['employee_request_due_date'])){
		$data['employee_request_due_date']="";
	}
	if(empty($data['employee_request_remark'])){
		$data['employee_request_remark']="";
	}
	if(empty($data['region_id'])){
		$data['region_id']="";
	}
	if(empty($data['branch_id'])){
		$data['branch_id']="";
	}
	if(empty($data['location_id'])){
		$data['location_id']="";
	}
	if(empty($data['division_id'])){
		$data['division_id']="";
	}	
	if(empty($data['department_id'])){
		$data['department_id']="";
	}
	if(empty($data['section_id'])){
		$data['section_id']="";
	}	
	if(empty($data['job_title_id'])){
		$data['job_title_id']="";
	}	
	if(empty($data['expertise_id'])){
		$data['expertise_id']="";
	}	
	if(empty($data['education_id'])){
		$data['education_id']="";
	}
	if(empty($data['employee_request_item_total'])){
		$data['employee_request_item_total']="";
	}
	if(empty($data['employee_request_item_description'])){
		$data['employee_request_item_description']="";
	}
	if(empty($data['employee_request_item_remark'])){
		$data['employee_request_item_remark']="";
	}

?>
					

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>RecruitmentEmployeeRequest" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_request_title" id="employee_request_title" value="<?php echo $data['employee_request_title'];?>" class="form-control">
												<label class="control-label">Judul</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['employee_request_date'])){
												?>
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_date" id="employee_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_request_date']);?>"/>
												<?php
													} else {
												?>
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_date" id="employee_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview(date("Y-m-d"));?>"/>
												<?php 
													}
												?>
												<!-- <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_date" id="employee_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo date('Y-m-d');?>">
												 -->
												<label class="control-label">Tanggal Permintaan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php
													if (!empty($data['employee_request_due_date'])){
												?>
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_due_date" id="employee_request_due_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['employee_request_due_date']);?>"/>
												<?php
													} else {
												?>
													<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_due_date" id="employee_request_due_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview(date("Y-m-d"));?>"/>
												<?php 
													}
												?>

												<!-- <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_due_date" id="employee_request_due_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo date('Y-m-d');?>"> -->
												<label class="control-label">Tanggal akhir Permintaan
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
												<textarea rows="3" name="employee_request_remark" id="employee_request_remark" class="form-control"><?php echo $data['employee_request_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
											</div>
										</div>
									</div>

									<h4>Detail Employee Request</h4>
									<br>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('region_id', $coreregion ,set_value('region_id', $data['region_id']),'id="region_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Wilayah</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('branch_id', $corebranch ,set_value('branch_id', $data['branch_id']),'id="branch_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Cabang</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('location_id', $corelocation ,set_value('location_id', $data['location_id']),'id="location_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Lokasi</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('division_id', $coredivision ,set_value('division_id', $data['division_id']),'id="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Devisi</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('department_id', $coredepartment ,set_value('department_id', $data['department_id']),'id="department_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Departemen</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('section_id', $coresection ,set_value('section_id', $data['section_id']),'id="section_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Bagian</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('job_title_id', $corejobtitle ,set_value('job_title_id', $data['job_title_id']),'id="job_title_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Judul Pekerjaan</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('education_id', $coreeducation ,set_value('education_id', $data['education_id']),'id="education_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Pendidikan</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('expertise_id', $coreexpertise ,set_value('expertise_id', $data['expertise_id']),'id="expertise_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
												<label class="control-label">Nama Keahlian</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_request_item_total" id="employee_request_item_total" value="<?php echo $data['employee_request_item_total'];?>" class="form-control">
												<label class="control-label">Total Permintaan Karyawan</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" name="employee_request_item_description" id="employee_request_item_description" value="<?php echo $data['employee_request_item_description'];?>" class="form-control">
												<label class="control-label">Deskripsi Permintaan Karyawan </label>
											</div>
										</div>
									</div>


									<div class = "row">
										<div class = "col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="employee_request_item_remark" id="employee_request_item_remark" class="form-control"><?php echo $data['employee_request_item_remark'];?></textarea>
												<label class="control-label">Keterangan Permintaan Karyawan</label>
											</div>
										</div>
									</div>
								</div>

								<div class="form-actions right">
									<button type="submit" class="btn green-jungle"><i class="fa fa-plus"></i> Tambah</button>
								</div>
								
								<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
								<input type="hidden" name="created_id" value="<?php echo $auth['username']; ?>"> 					
<!-- <?php echo form_close(); ?> -->
							</div>
						</div>
					</div>
				</div>


<?php 
	$this->load->view('RecruitmentEmployeeRequest/listaddRecruitmentEmployeeRequestitem_view');
?>