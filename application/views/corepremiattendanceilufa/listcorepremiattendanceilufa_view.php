


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
							<a href="<?php echo base_url();?>corepremiattendance">
								Premi Attendance List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
				</div>
				<h1 class="page-title">
					Premi Attendance List <small>Manage Premi Attendance</small>
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
							<i class="fa fa-reorder"></i>List
						</div>
						<div class="actions">
							<a href="<?php echo base_url();?>corepremiattendance/addCorePremiAttendance" class="btn btn-default btn-sm">
								<i class="fa fa-plus"></i> Add New Premi Attendance
							</a>
						</div>
					</div>
					<div class="portlet-body">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th width="15%">
										Code
									</th>
									<th width="20%">
										Premi Attendance Name
									</th>
									<th width="15%">
										Premi Attendance Range 1
									</th>
									<th width="15%">
										Premi Attendance Range 2
									</th>
									<th width="15%">
										Premi Attendance Amount
									</th>
									<th width="20%">
										Action
									</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach ($corepremiattendance as $key=>$val){
										
										echo"
											<tr>									
												<td>$val[premi_attendance_code]</td>
												<td>$val[premi_attendance_name]</td>
												<td>$val[premi_attendance_range1]</td>
												<td>$val[premi_attendance_range2]</td>
												<td>".nominal($val[premi_attendance_amount])."</td>
												<td>
													<a href='".$this->config->item('base_url').'corepremiattendance/editCorePremiAttendance/'.$val[premi_attendance_id]."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'corepremiattendance/deleteCorePremiAttendance/'.$val[premi_attendance_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
													</a>
												</td>
											</tr>
										";
								} ?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
	<?php echo form_close(); ?>	