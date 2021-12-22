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
									<th width="5%">No</th>
									<th width="25%">Branch Name</th>
									<th width="25%">Location Name</th>
									<th width="25%">Omzet Target Amount</th>		
								</tr>
							</thead>
							<tbody>
								<?php
									
									$no = 1;
									if(!is_array($incentiveomzettargetitem)){
										echo "<tr><th colspan='9'>Data is empty</th></tr>";
									} else {
										foreach ($incentiveomzettargetitem as $key=>$val){
											echo"
												<tr>
													<td style='text-align  : left !important;'>".$no."</td>
													<td style='text-align  : left !important;'>".$val['branch_name']."</td>
													<td style='text-align  : left !important;'>".$val['location_name']."</td>
													<td style='text-align  : right !important;'>".nominal($val['omzet_target_amount'])."</td>
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