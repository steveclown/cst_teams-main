<script>
	base_url = '<?= base_url()?>';	

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"incentiverealizationdistribution/reset_session";
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
														<td style='text-align  : left !important;'>".$no."</td>
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
			
				