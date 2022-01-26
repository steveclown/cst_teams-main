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
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	echo form_open('transactionalrequestemployee/delete', array('id' => 'myform', 'class' => 'horizontal-form')); 
?>

		<div class = "page-bar">
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">
						Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>RecruitmentEmployeeRequest">
						Daftar Permohonan Karyawan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>RecruitmentEmployeeRequest/showdetail/<?php echo $RecruitmentEmployeeRequest['employee_request_id']?>">
						Detail Permohonan Karyawan
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>

		<h3 class="page-title">
			Form Detail Permohonan Karyawan
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->

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
												<input type="text" autocomplete="off"  name="employee_request_title" id="employee_request_title" value="<?php echo $RecruitmentEmployeeRequest['employee_request_title'];?>" class="form-control" readonly>
												<label class="control-label">Judul</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_date" id="employee_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($RecruitmentEmployeeRequest['employee_request_date']);?>" readonly>
												<label class="control-label">Tanggal Permintaan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_due_date" id="employee_request_due_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($RecruitmentEmployeeRequest['employee_request_due_date']);?>" readonly>
												<label class="control-label">Tanggal Akhir permintaan
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
												<textarea rows="3" name="employee_request_remark" id="employee_request_remark" class="form-control" readonly><?php echo $RecruitmentEmployeeRequest['employee_request_remark'];?></textarea>
												<label class="control-label">Keterangan</label>
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
									Daftar Permintaan
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="table-scrollable">
										<table class="table table-striped table-bordered table-hover table-full-width">
											<thead>
											<tr>
												<th>
													No
												</th>
												<th>
													Wilayah
												</th>
												<th>
													Cabang
												</th>	
												<th>
													Lokasi
												</th>											
												<th>
													Devisi
												</th>
												<th>
													Departemen
												</th>												
												<th>
													Bagian
												</th>
												<th>
													Judul Pekerjaan
												</th>
												<th>
													Pendidikan
												</th>
												<th>
													Keahlian
												</th>
												<th>
													Jumlah
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											$no=1;
											if(!empty($RecruitmentEmployeeRequestitem)){
												foreach ($RecruitmentEmployeeRequestitem as $key=>$val){

													echo"
														<tr class='odd gradeX'>
															<td>".$no."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getRegionName($val['region_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getBranchName($val['branch_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getLocationName($val['location_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getDivisionName($val['division_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getDepartmentName($val['department_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getSectionName($val['section_id'])."</td>
															
															<td>".$this->RecruitmentEmployeeRequest_model->getJobTitleName($val['job_title_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getEducationName($val['education_id'])."</td>
															<td>".$this->RecruitmentEmployeeRequest_model->getExpertiseName($val['expertise_id'])."</td>
															<td>".$val['employee_request_item_total']."</td>
														</tr>
													";
													$no++;
												} 
											}else{
												echo "	<tr class='odd gradeX'>
															<td colspan='11' style='text-align:center;'>Tidak Ada Data</td>
														</tr>
													";						
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



