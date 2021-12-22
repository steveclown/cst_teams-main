<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
    

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
						<a href="<?php echo base_url();?>systemuser">
							User List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>

			<h3 class="page-title">
				User List <small>Manage User</small>
			</h3>
			<!-- END PAGE TITLE & BREADCRUMB-->

		
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								User List
							</div>
							<div class="actions">
								<a href="<?php echo base_url();?>systemuser/addSystemUser" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">
										 Add New User
									</span>
								</a>
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
											Username
										</th>
										<th>
											User Group Name
										</th>
										<th>
											Employee Name
										</th>
										<th>
											Division Name
										</th>
										<th>
											Department Name
										</th>
										<th>
											Section Name
										</th>
										<th width="120px">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no = 1;
										foreach ($systemuser as $key => $val){
											
											echo"
												<tr>
													<td>".$no."</td>
													<td>".$val['username']."</td>
													<td>".$this->systemuser_model->getSystemGroupName($val['user_group_id'])."</td>
													<td>".$this->systemuser_model->getEmployeeName($val['employee_id'])."</td> 
													<td>".$this->systemuser_model->getDivisionName($val['division_id'])."</td> 
													<td>".$this->systemuser_model->getDepartmentName($val['department_id'])."</td> 
													<td>".$this->systemuser_model->getSectionName($val['section_id'])."</td> 
													<td>
														<a href='".$this->config->item('base_url').'systemuser/editSystemUser/'.$val['user_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>

														<a href='".$this->config->item('base_url').'systemuser/resetPasswordSystemUser/'.$val['user_id']."' class='btn default btn-xs yellow'>
															<i class='fa fa-edit'></i> Reset
														</a>
													</td>
												</tr>
											";
											$no++;
									} ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		<?php echo form_close(); ?>	