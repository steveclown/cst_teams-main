<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"assignmentbusinesstrip/reset_search";
	}
</script>

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
						<a href="<?php echo base_url();?>assignmentbusinesstrip/unApprovedAssignmentBusinessTrip">
							UnApprovred Business Trip List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>

				</ul>
			</div>
			<h1 class="page-title">
				UnApproved Business Trip List <small>Manage UnApproved Business Trip</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
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
								<th>
									Description
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								print_r("unapprovedassignmentbusinesstrip ");
								print_r($unapprovedassignmentbusinesstrip);

								/*foreach ($unapprovedassignmentbusinesstrip as $key=>$val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$this->assignmentbusinesstrip_model->getEmployeeName($val['employee_id'])."</td>
											<td>".$this->assignmentbusinesstrip_model->getDivisionName($val['division_id'])."</td>
											<td>".$this->assignmentbusinesstrip_model->getDepartmentName($val['department_id'])."</td>
											<td>".$this->assignmentbusinesstrip_model->getSectionName($val['section_id'])."</td>
											<td>".$val['business_trip_purpose']."</td>
											<td>
												<a href='".$this->config->item('base_url').'assignmentbusinesstrip/addAssignmentBusinessTrip/'.$val['employee_id']."' class='btn default btn-xs red'>
													<i class='fa fa-plus'></i> Approval
												</a>
											</td>
										</tr>
									";
									$no++;*/
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
