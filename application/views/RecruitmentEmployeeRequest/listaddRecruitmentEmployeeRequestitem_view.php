<script>
base_url = '<?php echo base_url();?>';
function reset_all(){
	document.location = base_url+"RecruitmentEmployeeRequest/resetrequestemployee";
}
</script>

<?php 
	echo form_open('RecruitmentEmployeeRequest/processAddRecruitmentEmployeeRequest',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$sesi 		= $this->session->userdata('unique');
	$auth 		= $this->session->userdata('auth');
	$header		= $this->session->userdata('addRecruitmentEmployeeRequest-'.$sesi['unique']);

	$RecruitmentEmployeeRequestitem	= $this->session->userdata("dataRecruitmentEmployeeRequestitem-".$header['created_id']);

?>		
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Daftar
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
													Nomer
												</th>
												<th>
													Aksi
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
												$no=1;
												/* print_r($RecruitmentEmployeeRequestitem);*/
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
															<td>
																<a href='".$this->config->item('base_url').'RecruitmentEmployeeRequest/deletearrayrequestemployeeitem/'.$key."' onClick='javascript:return confirm(\"Apakah Yakin ingin dihapus ?\")' class='btn default btn-xs red'>
																	<i class='fa fa-trash-o'></i> Delete
																</a>
															</td>
														</tr>
													";
												} 
											}else{
												echo "	<tr class='odd gradeX'>
															<td colspan='11' style='text-align:center;'>Tidak Ada Data </td>
														</tr>
													";						
											}
											$no++;
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_all();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
							</div>
						</div>
					</div>
				</div>
<?php echo form_close(); ?>