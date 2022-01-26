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
						Form Calculate Incentive Realization Distribution
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
											echo form_open('incentiverealizationdistribution/processAchievementIncentiveRealizationDistribution',array('id' => 'myform', 'class' => 'horizontal-form')); 

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
												<input type="text" autocomplete="off"  class="form-control" id="branch_name" name="branch_name" readonly value="<?php echo $incentiverealizationdistribution['branch_name'];?>">
												<label class="control-label">Branch Name</label>
											</div>	
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" autocomplete="off"  class="form-control" id="location_name" name="location_name" readonly value="<?php echo $incentiverealizationdistribution['location_name'];?>">
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
												<input type="text" autocomplete="off"  class="form-control" id="month_period" name="month_period" readonly value="<?php echo $incentiverealizationdistribution['realization_distribution_group_percentage'];?>">
												<label class="control-label">Group Percentage</label>
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
									</div>

									<input type="hidden" class="form-control" id="omzet_target_id" name="omzet_target_id" readonly value="<?php echo $incentiverealizationdistribution['omzet_target_id'];?>">

									<input type="hidden" class="form-control" id="realization_distribution_id" name="realization_distribution_id" readonly value="<?php echo $incentiverealizationdistribution['realization_distribution_id'];?>">

									<div class="tabbable-line boxless tabbable-reversed ">
										<ul class="nav nav-tabs">
											<?php
												if($data['active_tab']=="" || $data['active_tab']=="title"){
													$tabtitle = "<li class='active'><a href='#tabtitle' name='title' data-toggle='tab' onClick='function_state_add(this.name);'><b>Title</b></a></li>";
												}else{
													$tabtitle = "<li><a href='#tabtitle' data-toggle='tab' name='title' onClick='function_state_add(this.name);'><b>Title</b></a></li>";
												}

												if($data['active_tab']=="employee"){
													$tabemployee = "<li class='active'><a href='#tabemployee' name='employee' data-toggle='tab' onClick='function_state_add(this.name)'><b>Employee</b></a></li>";
												}else{
													$tabemployee = "<li><a href='#tabemployee' data-toggle='tab' name='employee' onClick='function_state_add(this.name)'><b>Employee</b></a></li>";
												}
												
												echo $tabtitle;
												echo $tabemployee;
											?>
										</ul>
										<div class="tab-content">
											<?php
												if($data['active_tab']=="" || $data['active_tab']=="title"){
													$stattitle = "active";
												}else{
													$stattitle = "";
												}

												if($data['active_tab']=="employee"){
													$statemployee = "active";
												}else{
													$statemployee = "";
												}
												
												echo"<div class='tab-pane ".$stattitle."' id='tabtitle'>";
													$this->load->view("incentiverealizationdistribution/achievementincentivetitledistribution_view");
												echo"</div>";

												echo"<div class='tab-pane ".$statemployee."' id='tabemployee'>";
													$this->load->view("incentiverealizationdistribution/achievementincentiveemployeeomzet_view");
												echo"</div>";
											?>
										</div>
									</div>
									<div class="row">
										<div class="form-actions right">
											<button type="reset" class="btn red" onClick="reset_session();"><i class="fa fa-times"></i> Reset</button>
											<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

