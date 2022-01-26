<?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
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
								<a href="<?php echo base_url();?>incentiverealizationdistribution">
									Incentive Realization Distribution List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>incentiverealizationdistribution/showdetail/<?php echo $incentiverealizationdistribution['realization_distribution_id'] ?>">
									Detail Incentive Realization Distribution
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Detail Incentive Realization Distribution
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
			


				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Detail
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>incentiverealizationdistribution" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i>
										Back
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<div class = "row">
										<div class = "col-md-6">
											<?php
												$month 	= substr($incentiverealizationdistribution['realization_distribution_period'], 4, 2);

												$year 	= substr($incentiverealizationdistribution['realization_distribution_period'], 0, 4);
											?>
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="month_period" name="month_period" readonly value="<?php echo $this->configuration->Month[$month];?>">
												<label class="control-label">Month Name</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="year_period" name="year_period" readonly value="<?php echo $year;?>">
												<label class="control-label">Year</label>
											</div>		
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="month_period" name="month_period" readonly value="<?php echo $incentiverealizationdistribution['branch_name'];?>">
												<label class="control-label">Branch Name</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="year_period" name="year_period" readonly value="<?php echo $incentiverealizationdistribution['location_name'];?>">
												<label class="control-label">Location Name</label>
											</div>		
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="month_period" name="month_period" readonly value="<?php echo $incentiverealizationdistribution['realization_distribution_branch_percentage'];?>">
												<label class="control-label">Branch Percentage</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="year_period" name="year_period" readonly value="<?php echo nominal($incentiverealizationdistribution['realization_distribution_branch_amount']);?>">
												<label class="control-label">Branch Amount</label>
											</div>		
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="month_period" name="month_period" readonly value="<?php echo $incentiverealizationdistribution['realization_distribution_group_percentage'];?>">
												<label class="control-label">Group Percentage</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="year_period" name="year_period" readonly value="<?php echo nominal($incentiverealizationdistribution['realization_distribution_group_amount']);?>">
												<label class="control-label">Group Amount</label>
											</div>		
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="month_period" name="month_period" readonly value="<?php echo $incentiverealizationdistribution['realization_distribution_individual_percentage'];?>">
												<label class="control-label">Individual Percentage</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="year_period" name="year_period" readonly value="<?php echo nominal($incentiverealizationdistribution['realization_distribution_individual_amount']);?>">
												<label class="control-label">Individual Amount</label>
											</div>		
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List Title Distribution
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="15%">Job Title Name</th>
									<th width="10%">Branch Percentage</th>
									<th width="15%">Branch Amount</th>
									<th width="10%">Group Percentage</th>
									<th width="15%">Group Amount</th>
									<th width="10%">Individual Percentage</th>
									<th width="15%">Individual Amount</th>		
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if(!is_array($incentivetitledistribution)){
										echo "<tr><th colspan='9'>Data is empty</th></tr>";
									} else {
										foreach ($incentivetitledistribution as $key=>$val){
											echo"
												<tr>
													<td style='text-align  : right !important;'>".$no."</td>
													<td style='text-align  : right !important;'>".$val['job_title_name']."</td>
													<td style='text-align  : right !important;'>".nominal($val['title_distribution_branch_percentage'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['title_distribution_branch_amount'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['title_distribution_group_percentage'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['title_distribution_group_amount'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['title_distribution_individual_percentage'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['title_distribution_individual_amount'])."</td>
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
			</div>
		</div>
	</div>
</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List Employee Omzet
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_3">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="15%">Division Name</th>
									<th width="10%">Department Name</th>
									<th width="10%">Section Name</th>
									<th width="10%">Employee Name</th>
									<th width="10%">Omzet Target</th>
									<th width="10%">Omzet Achievement</th>
									<th width="10%">Branch Incentive</th>	
									<th width="10%">Group Incentive</th>	
									<th width="10%">Individual Incentive</th>	
									<th width="10%">Total Incentive</th>		
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									print_r("incentiveemployeeomzet");
									print_r($incentiveemployeeomzet);
									
									if(!is_array($incentiveemployeeomzet)){
										echo "<tr><th colspan='10'>Data is empty</th></tr>";
									} else {
										foreach ($incentiveemployeeomzet as $key => $valEmployee){
											echo"
												<tr>
													<td style='text-align  : right !important;'>".$no."</td>
													<td style='text-align  : right !important;'>".$valEmployee['division_name']."</td>
													<td style='text-align  : right !important;'>".$valEmployee['department_name']."</td>
													<td style='text-align  : right !important;'>".$valEmployee['section_name']."</td>
													<td style='text-align  : right !important;'>".$valEmployee['employee_name']."</td>
													<td style='text-align  : right !important;'>".$valEmployee['employee_omzet_target']."</td>
													<td style='text-align  : right !important;'>".$valEmployee['employee_omzet_achievement']."</td>
													<td style='text-align  : right !important;'>".nominal($valEmployee['employee_omzet_branch_amount'])."</td>
													<td style='text-align  : right !important;'>".nominal($valEmployee['employee_omzet_group_amount'])."</td>
													<td style='text-align  : right !important;'>".nominal($valEmployee['employee_omzet_individual_amount'])."</td>
													<td style='text-align  : right !important;'>".nominal($valEmployee['employee_omzet_total_amount'])."</td>
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
			</div>
		</div>
	</div>
</div>