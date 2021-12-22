
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
							<a href="<?php echo base_url();?>RecruitmentEmployeeRequest">
								Daftar Employee Request
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h3 class="page-title">
					Daftar Persetujuan Employee Request 
				</h3>
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
							<i class="fa fa-reorder"></i>Daftar
						</div>
					</div>
					
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th>
										No
									</th>
									<th>
										Diminta oleh
									</th>
									<th>
										Gelar
									</th>
									<th>
										Tanggal
									</th>
									<th>
										Jatuh Tempo
									</th>
									<th>
										Aksi
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if (empty($RecruitmentEmployeeRequest_approval)) {
										echo"<td colspan='6'>Data kosong</td>";		
									}else{
										foreach ($RecruitmentEmployeeRequest_approval as $key=>$val){	
											echo"
												<tr>	
													<td>".$no."</td>						
													<td>".$this->RecruitmentEmployeeRequest_model->getEmployeeName($val['employee_id'])."</td>		
													<td>".$val['employee_request_title']."</td>
													<td>".tgltoview($val['employee_request_date'])."</td>
													<td>".tgltoview($val['employee_request_due_date'])."</td>
													<td>";

														if ($val['approved']==0) {
															echo"													
																<a href='".$this->config->item('base_url').'RecruitmentEmployeeRequest/approvalEmployeeRequest/'.$val['employee_request_id']."' class='btn green btn-xs default'>
																<i class='fa fa-check'></i> Approval
																</a>														
															";
														}else{
															echo "<b>Telah Disetujui</b>";
														}
														echo"
													</td>
												</tr>
											";
											$no++;
										} 
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
<?php echo form_close(); ?>	