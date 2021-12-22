<script>
	base_url = '<?= base_url()?>';	

	mappia = "	<?php 
					$site_url = 'incentiverealizationdistribution/addIncentiveRealizationDistribution/';
					echo site_url($site_url); 
				?>";

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"incentiverealizationdistribution/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('incentiverealizationdistribution/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('incentiverealizationdistribution/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

</script>
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

					
			



			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th width="5%">No</th>
									<th width="10%">Division Name</th>
									<th width="10%">Department Name</th>
									<th width="10%">Section Name</th>
									<th width="10%">Job Title Name</th>
									<th width="15%">Employee Name</th>		
									<th width="10%">Omzet Target</th>	
									<th width="10%">Omzet Achievement</th>		
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if(!is_array($incentiveemployeeomzet)){
										echo "<tr><th colspan='9'>Data is empty</th></tr>";
									} else {
										foreach ($incentiveemployeeomzet as $key=>$val){
											echo"
												<tr>
													<input type='hidden' name='".$key."' value='$key'>

													<td style='text-align  : left !important;'>".$no."</td>
													<td style='text-align  : right !important;'>".$val['division_name']."</td>
													<td style='text-align  : right !important;'>".$val['department_name']."</td>
													<td style='text-align  : right !important;'>".$val['section_name']."</td>
													<td style='text-align  : right !important;'>".$val['job_title_name']."</td>
													<td style='text-align  : right !important;'>".$val['employee_name']."</td>
													<td style='text-align  : right !important;'>".nominal($val['employee_omzet_target'])."</td>
													<td style='text-align  : right !important;'>
														<input class='form-control' style='text-align:right;' type='text' name='employee_omzet_achievement_".$key."' id='employee_omzet_achievement_".$key."' value='0' />

														<input class='form-control' style='text-align:right;' type='hidden' name='employee_id_".$key."' id='employee_id_".$key."' value=".$val['employee_id']." />
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
		