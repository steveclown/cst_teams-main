<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"incentiveomzettarget/reset_search";
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
						<a href="<?php echo base_url();?>incentiveomzettarget">
							Incentive Omzet Target List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Incentive Omzet Target List <small>Manage incentive omzet target</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('incentiveomzettarget/filter',array('id' => 'myform', 'class' => '')); ?>

<?php
	$sesi 	= $this->session->userdata('unique');

	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 

	$data	= $this->session->userdata('addincentiveomzettarget-'.$sesi['unique']);

	$data['month_period']				= date("m");
	$data['year_period']				= date("Y");
										
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-4">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('month_period', $monthlist,set_value('month_period',$data['month_period']),'id="month_period" class="form-control select2me" ');
								?>
								<label class="control-label">Month Name</label>
							</div>	
						</div>
						
						<div class = "col-md-2">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('year_period', $year, set_value('year_period',$data['year_period']),'id="year_period" class="form-control select2me" ');
								?>
								<label class="control-label">Year</label>
							</div>	
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						List
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>incentiveomzettarget/addIncentiveOmzetTarget" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
								Add New Incentive Omzet Target
							</span>
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th >
									Omzet Target Period
								</th>
								<th width="20%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($incentiveomzettarget as $key=>$val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['omzet_target_period']."</td>
											<td>
												<a href='".$this->config->item('base_url').'incentiveomzettarget/showdetail/'.$val['omzet_target_id']."' class='btn default btn-xs yellow-lemon'>
														<i class='fa fa-bars'></i> Detail
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