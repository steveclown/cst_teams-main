
				<div class = "page-bar">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<ul class="page-breadcrumb">
						<li>
							<a href="<?php echo base_url();?>">
								Home
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>assignmentovertimerate">
								Overtime Rate List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url();?>assignmentovertimerate/showdetail/<?php echo $assignmentovertimerate['overtime_rate_id'];?>">
								Detail Overtime Rate
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Form Detail Overtime Rate
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
									Form Detail
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>assignmentovertimerate" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class="row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="zone_id" id="zone_id" value="<?php echo $this->assignmentovertimerate_model->getZoneName($assignmentovertimerate['zone_id'])?>" class="form-control" onChange="function_elements_add(this.name, this.value)" readonly>

												<label class="control-label">Zone Name
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_rate_effective_date" id="overtime_rate_effective_date" value="<?php echo tgltoview($assignmentovertimerate['overtime_rate_effective_date'])?>" class="form-control" onChange="function_elements_add(this.name, this.value)" readonly>

												<label class="control-label">Effective Date
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<input type="text" name="overtime_rate_description" id="overtime_rate_description" value="<?php echo $assignmentovertimerate['overtime_rate_description']?>" class="form-control" onChange="function_elements_add(this.name, this.value)" readonly>
												<label class="control-label">Overtime Rate Description<span class="required">*</span></label>
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
									<div class="row">
										<div class="col-md-12">									
											<div class="table-responsive">
												<table class="table table-bordered table-advance table-hover">
													<thead>
														<tr>
															<th>No.</th>
															<th>Division Name</th>
															<th>Department Name</th>
															<th>Section Name</th>
															<th>Job Title Name</th>
															<th>Allowance Name</th>
															<th>Allowance Amount</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$no = 1;

														if(!empty($assignmentovertimeratetitle)){
															foreach($assignmentovertimeratetitle as $key=>$val){
																echo"
																	<tr class='odd gradeX'>
																		<td style='text-align:center'>$no.</td>
																		<td>".$this->assignmentovertimerate_model->getDivisionName($val['division_id'])."</td>
																		<td>".$this->assignmentovertimerate_model->getDepartmentName($val['department_id'])."</td>
																		<td>".$this->assignmentovertimerate_model->getSectionName($val['section_id'])."</td>
																		<td>".$this->assignmentovertimerate_model->getJobTitleName($val['job_title_id'])."</td>
																		<td>".$this->assignmentovertimerate_model->getAllowanceName($val['allowance_id'])."</td>
																		<td>".nominal($val['overtime_rate_allowance_amount'])."</td>
																	</tr>
																";
																$no++;
															}
														}else{
															echo"
																<tr class='odd gradeX'>
																	<td colspan='11' style='text-align:center;'>
																		<b>No Data</b>
																	</td>
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
					</div>
				</div>