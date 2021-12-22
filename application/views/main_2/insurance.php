<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterinsurance_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeinsurance">
					<thead>
						<tr>
							<th>
								 Name
							</th>							
							<th>
								 Premi Code
							</th>
							<th>
								 Period
							</th>
							<th>
								 Amount
							</th>
							<th>
								 Remark
							</th>
						</tr>
					</thead>   
					<tbody>
						<?php 
						// if(empty($hroemployeeinsurance)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='5' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeeinsurance as $key=>$val){
								echo "
										<tr class='odd gradeX'>
											<td>
												".$this->main_model->getInsuranceName($val[insurance_id])."
											</td>
											<td>
												".$this->main_model->getInsurancePremiCode($val[insurance_premi_id])."
											</td>												
											<td style='text-align:right'>
												$val[employee_insurance_period]
											</td>
											<td style='text-align:right'>
												".nominal($val[employee_insurance_premi_amount])."
											</td>
											<td>
												$val[employee_insurance_remark]
											</td>
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
