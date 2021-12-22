<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"incentiverealizationdistribution/reset_search";
	}

	$(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiverealizationdistribution/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });
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
						<a href="<?php echo base_url();?>incentiverealizationdistribution">
							Incentive Realization Distribution List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Incentive Realization Distribution List <small>manage incentive realizatiion distribution</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('incentiverealizationdistribution/filter',array('id' => 'myform', 'class' => '')); ?>

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

	$data	= $this->session->userdata('addincentiverealizationdistribution-'.$sesi['unique']);

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

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('branch_id', $corebranch,set_value('branch_id',$data['branch_id']),'id="branch_id" class="form-control select2me" ');
								?>
								<label class="control-label">Branch</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<select name="location_id" id="location_id" class="form-control select2me">
									<option value="">--Choose Item--</option>
								</select>
								<label class="control-label">Location Name<span class="required">*</span></label>
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
						<a href="<?php echo base_url();?>incentiverealizationdistribution/addIncentiveRealizationDistribution" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
								Add New Incentive Realization Distribution
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
								<th width="15%">
									Branch Name
								</th>
								<th width="15%">
									Location Name
								</th>
								<th width="15%">
									Period
								</th>
								<th width="10%">
									Branch Target
								</th>
								<th width="10%">
									Group Target
								</th>
								<th width="10%">
									Individual Target
								</th>
								<th width="10%">
									Branch Amount
								</th>
								<th width="10%">
									Group Amount
								</th>
								<th width="10%">
									Individual Amount
								</th>
								<th width="10%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($incentiverealizationdistribution as $key=>$val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['branch_name']."</td>
											<td>".$val['location_name']."</td>
											<td>".$val['realization_distribution_period']."</td>
											<td>".$val['realization_distribution_branch_percentage']."</td>
											<td>".$val['realization_distribution_group_percentage']."</td>
											<td>".$val['realization_distribution_individual_percentage']."</td>
											<td>".nominal($val['realization_distribution_branch_amount'])."</td>
											<td>".nominal($val['realization_distribution_group_amount'])."</td>
											<td>".nominal($val['realization_distribution_individual_amount'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'incentiverealizationdistribution/showdetail/'.$val['realization_distribution_id']."' class='btn default btn-xs yellow-lemon'>
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