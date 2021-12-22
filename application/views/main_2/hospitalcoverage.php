<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterhospitalcoverage_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeehospitalcoverage">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Period
						</th>
						<th>
							Amount
						</th>
						<th>
							Claimed
						</th>
						<th>
							Last Balance
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						// if(empty($hroemployeehospitalcoverage)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='5' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeehospitalcoverage as $key=>$val){
								
								echo"
									<tr>									
										<td>".$this->main_model->gethospitalcoveragename($val[hospital_coverage_id])."</td>
										<td style='text-align:right'>$val[hospital_coverage_period]</td>
										<td style='text-align:right'>".nominal($val[hospital_coverage_amount])."</td>
										<td style='text-align:right'>".nominal($val[hospital_coverage_claimed])."</td>
										<td style='text-align:right'>".nominal($val[hospital_coverage_last_balance])."</td>
									</tr>
								";
							} 
						// } 
					?>
					</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
<?php echo form_close(); ?>