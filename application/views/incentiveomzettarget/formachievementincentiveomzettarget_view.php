<script type="text/javascript">
	function toRp(number) {
		var number = number.toString(), 
		rupiah = number.split('.')[0], 
		cents = (number.split('.')[1] || '') +'00';
		rupiah = rupiah.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
		return rupiah ;
	}

	function omzetChange(k,value){
		var omzet_achievement_amount = document.getElementById("omzet_achievement_amount_view_"+k).value;

		/*alert(omzet_achievement_amount);*/
		if(value==""){
			alert("Value cannot be empty");
			document.getElementById("omzet_achievement_amount_"+k).value = omzet_achievement_amount;
			document.getElementById("omzet_achievement_amount_view_"+k).value = toRp(omzet_achievement_amount);
		}else
		if(isNaN(value)){
			alert("Value must be a number");
			document.getElementById("omzet_achievement_amount_"+k).value = omzet_achievement_amount;
			document.getElementById("omzet_achievement_amount_view_"+k).value = toRp(omzet_achievement_amount);
		}else
		if(parseFloat(value)<0){
			alert("Value must be more than 0");
			document.getElementById("omzet_achievement_amount_"+k).value = omzet_achievement_amount;
			document.getElementById("omzet_achievement_amount_view_"+k).value = toRp(omzet_achievement_amount);
		}else
		{
			document.getElementById("omzet_achievement_amount_"+k).value = value;
			document.getElementById("omzet_achievement_amount_view_"+k).value = toRp(value);
		}
	}
</script>
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
			<a href="<?php echo base_url();?>incentiveomzettarget/achievementIncentiveOmzetTarget/<?php echo $incentiveomzettarget['omzet_target_id'] ?>">
				Achievement Incentive Omzet Target
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Form Achievement Incentive Omzet Target
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->
			
<?php 
	echo form_open('incentiveomzettarget/processAchievementIncentiveOmzetTarget',array('id' => 'myform', 'class' => 'horizontal-form')); 
?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Edit
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
									<th width="25%">Omzet Achievement Amount</th>		
								</tr>
							</thead>
							<tbody>
								<?php
									
									$no = 1;
									if(!is_array($incentiveomzettargetitem)){
										echo "<tr><th colspan='9'>Data is empty</th></tr>";
									} else {
										foreach ($incentiveomzettargetitem as $key => $val){
											echo"
												<tr>
													<input type='hidden' name='".$key."' value='$key'>

													<input class='form-control' style='text-align:right;' type='hidden' name='omzet_target_item_id_".$key."' id='omzet_target_item_id_".$key."' value='$val[omzet_target_item_id]'/>

													<td style='text-align  : left !important;'>".$no."</td>
													<td style='text-align  : left !important;'>".$val['branch_name']."</td>
													<td style='text-align  : left !important;'>".$val['location_name']."</td>
													<td style='text-align  : right !important;'>".nominal($val['omzet_target_amount'])."</td>
													<td style='text-align  : right !important;'>
														<input class='form-control' style='text-align:right;' type='text' name='omzet_achievement_amount_view_".$key."' id='omzet_achievement_amount_view_".$key."' value='0' onchange='omzetChange(".$key.",this.value);'/>

														<input class='form-control' style='text-align:right;' type='hidden' name='omzet_achievement_amount_".$key."' id='omzet_achievement_amount_".$key."' value='0'/>
													</td>
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

			<div class="row">
				<div class="col-md-12">
					<div class="form-actions right">
						<div class="form-group form-md-line-input">
							<input type="hidden" name="omzet_target_id" id="omzet_target_id" value="<?php echo $incentiveomzettarget['omzet_target_id']; ?>">

							<input type="hidden" name="omzet_target_total_amount" id="omzet_target_total_amount" value="<?php echo $incentiveomzettarget['omzet_target_total_amount']; ?>">
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>