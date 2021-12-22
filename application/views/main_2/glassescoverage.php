<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterglassescoverage_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeglassescoverage">
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
						// if(empty($hroemployeeglassescoverage)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='5' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeeglassescoverage as $key=>$val){
								
								echo"
									<tr>									
										<td>".$this->main_model->getglassescoveragename($val[glasses_coverage_id])."</td>
										<td style='text-align:right'>$val[glasses_coverage_period]</td>
										<td style='text-align:right'>".nominal($val[glasses_coverage_amount])."</td>
										<td style='text-align:right'>".nominal($val[glasses_coverage_claimed])."</td>
										<td style='text-align:right'>".nominal($val[glasses_coverage_last_balance])."</td>
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