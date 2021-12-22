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
						Daftar Employee Request 
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>RecruitmentEmployeeRequest/approvalEmployeeRequest/<?php echo $RecruitmentEmployeeRequest['employee_request_id']?>">
						Persetujuan Employee Request
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>

		<h3 class="page-title">
			Form Persetujuan Employee Request
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Persetujuan
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>RecruitmentEmployeeRequest/approval" class="btn btn-default sm">
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
												<input type="text" name="employee_request_title" id="employee_request_title" value="<?php echo $RecruitmentEmployeeRequest['employee_request_title'];?>" class="form-control" readonly>
												<label class="control-label">Gelar</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_date" id="employee_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($RecruitmentEmployeeRequest['employee_request_date']);?>" readonly>
												<label class="control-label">Tanggal Request
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_due_date" id="employee_request_due_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($RecruitmentEmployeeRequest['employee_request_due_date']);?>" readonly>
												<label class="control-label">Request Due Date
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
									List
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="table-scrollable">
										<table class="table table-striped table-bordered table-hover table-full-width">
											<thead>
											<tr>
												<th>
													Region
												</th>
												<th>
													Branch
												</th>	
												<th>
													Location
												</th>											
												<th>
													Division
												</th>
												<th>
													Department
												</th>												
												<th>
													Section
												</th>
												<th>
													Jobtitle
												</th>
												<th>
													Education
												</th>
												<th>
													Expertise
												</th>
												<th>
													Number
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(!empty($RecruitmentEmployeeRequestitem)){
												foreach ($RecruitmentEmployeeRequestitem as $key=>$val){

													echo"
														<tr class='odd gradeX'>
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
												} 
											}else{
												echo "	<tr class='odd gradeX'>
															<td colspan='11' style='text-align:center;'>No Data Available</td>
														</tr>
													";						
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
								<div class="form-actions right">
									<a class="btn green" data-toggle="modal" href="#modalapproval"><i class="fa fa-pencil"></i> Approve</a>
								</div>
							</div>
						</div>
					</div>
				</div>

<?php echo form_open('RecruitmentEmployeeRequest/processApprovalRecruitmentEmployeeRequest',array('id' => 'myform', 'class' => 'horizontal-form'));?>
<!-- /.modal -->
<script>
	$(document).ready(function(){
        $("#Save").click(function(){
			var employee_request_status_remark = $("#employee_request_status_remark").val();
			
		  	if(employee_request_status_remark!=''){
				return true;
			}else{
				alert('Please insert remark');
				return false;
			}
		});
    });
</script>
<div class="modal fade bs-modal-lg" id="modalapproval" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Approval Recruitment Employee Request</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<label class="control-label">Status</label>
						<div class="input-icon right">
							<?php echo form_textarea(array('rows'=>'3','name'=>'employee_request_status_remark','class'=>'form-control','id'=>'employee_request_status_remark','value'=>set_value('employee_request_status_remark',$RecruitmentEmployeeRequest['employee_request_status_remark'])))?>
						</div>	
					</div>	
					<div class="col-md-12">
						<label class="control-label">Remark</label>
						<div class="input-icon right">
							<i class="fa"></i>
							<?php echo form_textarea(array('rows'=>'3','name'=>'approved_remark','class'=>'form-control','id'=>'approved_remark','value'=>set_value('approved_remark',$RecruitmentEmployeeRequest['approved_remark'])))?>
						</div>	
					</div>	
				</div>
					
				<input type="hidden" class="form-control" name="employee_request_id" id="canvasemployee_request_id_order_requisition_id"  value="<?php echo $RecruitmentEmployeeRequest['employee_request_id'];?>"/>
					
				<div class="modal-footer">
					<button type="button" class="btn red" data-dismiss="modal">Close</button>
					<button type="submit" id="Save" class="btn green-jungle"><i class="fa fa-check"></i> Approval</button>
				</div>
			</div>
				<!-- /.modal-content -->
		</div>
			<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->
<?php
echo form_close(); 
?>	