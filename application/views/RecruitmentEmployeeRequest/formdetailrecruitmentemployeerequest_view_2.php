<script>
	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"recruitmentemployeerequest/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('recruitmentemployeerequest/function_elements_add');?>",
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
				url : "<?php echo site_url('recruitmentemployeerequest/function_state_add');?>",
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
						Home
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>recruitmentapplicantrequest">
						Applicant Request List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>recruitmentapplicantrequest/<?php $recruitmentapplicantrequest['applicant_request_id']?>">
						Detail Employee Request
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>

		<h3 class="page-title">
			Form Detail Employee Request
		</h3>
		<!-- END PAGE TITLE & BREADCRUMB-->

				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Add
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>recruitmentemployeerequest" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										
									?>


									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  name="employee_request_title" id="employee_request_title" value="<?php echo $recruitmentemployeerequest['employee_request_title'];?>" class="form-control" readonly>
												<label class="control-label">Title</label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_date" id="employee_request_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($recruitmentemployeerequest['employee_request_date']);?>" readonly>
												<label class="control-label">Request Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_request_due_date" id="employee_request_due_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($recruitmentemployeerequest['employee_request_due_date']);?>" readonly>
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
												<textarea rows="3" name="employee_request_remark" id="employee_request_remark" class="form-control" readonly><?php echo $recruitmentemployeerequest['employee_request_remark'];?></textarea>
												<label class="control-label">Remark</label>
											</div>
										</div>
									</div>
								</div>
									

								<div class="form-actions right">
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Add</button>
								</div>
								
								<input type="hidden" name="created_on" value="<?php echo date("Y-m-d H:i:s");?>">
								<input type="hidden" name="created_id" value="<?php echo $auth[username]; ?>">
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
												<th>
													Action
												</th>
											</tr>
											</thead>
											<tbody>
											<?php
											if(!empty($recruitmentemployeerequestitem)){
												foreach ($recruitmentemployeerequestitem as $key=>$val){

													echo"
														<tr class='odd gradeX'>
															<td>".$this->recruitmentemployeerequest_model->getRegionName($val['region_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getBranchName($val['branch_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getLocationName($val['location_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getDivisionName($val['division_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getDepartmentName($val['department_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getSectionName($val['section_id'])."</td>
															
															<td>".$this->recruitmentemployeerequest_model->getJobTitleName($val['job_title_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getEducationName($val['education_id'])."</td>
															<td>".$this->recruitmentemployeerequest_model->getExpertiseName($val['expertise_id'])."</td>
															<td>".$val['employee_request_item_total']."</td>
															<td>
																<a href='".$this->config->item('base_url').'recruitmentemployeerequest/deletearrayrequestemployeeitem/'.$key."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																	<i class='fa fa-trash-o'></i> Delete
																</a>
															</td>
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
									<button type="button" class="btn red" onClick="reset_all();"><i class="fa fa-times"></i> Reset</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
								</div>
							</div>
						</div>
					</div>
				</div>



<div class="form-actions right">
					<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
					<a <?php if($detail['applicant_request_status']=='0'){echo"href='#void'";}else if($detail['applicant_request_status']=='1'){echo"href='#cannotvoid'";} ?> class="btn red" data-toggle="modal">
						<i class="fa fa-times"></i> Void
					</a>
				</div>

<input type="hidden" name="applicant_request_id" value="<?php echo $detail[applicant_request_id];?>">

<div class="modal fade" id="void" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Action Confirmation</h4>
			</div>
			<div class="modal-body">
				Are you sure you want to void this entry ?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn red"></i><i class="fa fa-times"></i> Void</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<div class="modal fade" id="cannotvoid" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Action Impossible</h4>
			</div>
			<div class="modal-body">
				This request is already selected. You cannot void this entry, you have to void the corresponding selection applicant first !!!
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<?php echo form_close(); ?>