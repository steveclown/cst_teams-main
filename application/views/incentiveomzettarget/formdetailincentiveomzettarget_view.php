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
								<a href="<?php echo base_url();?>incentiveomzettarget">
									Incentive Omzet Target List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>incentiveomzettarget/showdetail/<?php echo $incentiveomzettarget['omzet_target_id'] ?>">
									Detail Incentive Omzet Target
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Detail Incentive Omzet Target
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
									<a href="<?php echo base_url();?>incentiveomzettarget" class="btn btn-default sm">
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
												$month 	= substr($incentiveomzettarget['omzet_target_period'], 4, 2);

												$year 	= substr($incentiveomzettarget['omzet_target_period'], 0, 4);
											?>
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="month_period" name="month_period" readonly value="<?php echo $this->configuration->Month[$month];?>">
												<label class="control-label">Month Name</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="year_period" name="year_period" readonly value="<?php echo $year;?>">
												<label class="control-label">Year</label>
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
									<th width="10%">Branch Name</th>
									<th width="10%">Location Name</th>
									<th width="15%">Target Amount</th>
									<th width="15%">Achievement Amount</th>
									<th width="10%">Achievement Percentage</th>
									<th width="10%">Incentive Percentage</th>
									<th width="10%">Incentive Amount</th>
									<th width="10%">Incentive Share</th>
									<th width="10%">Incentive Pending</th>
								</tr>
							</thead>
							<tbody>
								<?php
									
									$no = 1;
									if(!is_array($incentiveomzettargetitem)){
										echo "<tr><th colspan='9'>Data is empty</th></tr>";
									} else {
										$omzet_target_amount_total 				= 0;
										$omzet_achievement_amount_total 		= 0;
										$omzet_achievement_percentage_total 	= 0;
										$omzet_incentive_percentage_total 		= 0;
										$omzet_incentive_amount_total 			= 0;
										$omzet_incentive_share_amount_total 	= 0;
										$omzet_incentive_pending_amount_total 	= 0;

										foreach ($incentiveomzettargetitem as $key=>$val){
											$omzet_target_amount_total 				= $omzet_target_amount_total + $val['omzet_target_amount'];
											$omzet_achievement_amount_total 		= $omzet_achievement_amount_total + $val['omzet_achievement_amount'];
											$omzet_achievement_percentage_total 	= $omzet_achievement_percentage_total + $val['omzet_achievement_percentage'];
											$omzet_incentive_percentage_total 		= $omzet_incentive_percentage_total + $val['omzet_incentive_percentage'];
											$omzet_incentive_amount_total 			= $omzet_incentive_amount_total + $val['omzet_incentive_amount'];
											$omzet_incentive_share_amount_total 	= $omzet_incentive_share_amount_total + $val['omzet_incentive_share_amount'];
											$omzet_incentive_pending_amount_total 	= $omzet_incentive_pending_amount_total + $val['omzet_incentive_pending_amount'];
											echo"
												<tr>
													<td style='text-align : left !important;'>".$val['branch_name']."</td>
													<td style='text-align : left !important;'>".$val['location_name']."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_target_amount'], 2)."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_achievement_amount'], 2)."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_achievement_percentage'], 2)."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_incentive_percentage'], 2)."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_incentive_amount'], 2)."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_incentive_share_amount'], 2)."</td>
													<td style='text-align : right !important;'>".number_format($val['omzet_incentive_pending_amount'], 2)."</td>
												</tr>								
											";	

											$no++;													
										}
									}
								?>
								<?php 
									echo "<tr>
										<td colspan = '2' style='text-align : left !important;'><b>TOTAL</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_target_amount_total, 2)."</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_achievement_amount_total, 2)."</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_achievement_percentage_total, 2)."</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_incentive_percentage_total, 2)."</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_incentive_amount_total, 2)."</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_incentive_share_amount_total, 2)."</b></td>
										<td style='text-align : right !important;'><b>".number_format($omzet_incentive_pending_amount_total, 2)."</b></td>
									</tr>";
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>