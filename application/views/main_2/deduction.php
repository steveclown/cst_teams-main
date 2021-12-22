<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterdeduction_view'); 
?>
<div class="form-body form">
	<div class="form-body">
	<!--<h3 class="form-section">Deduction</h3>-->
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeededuction">
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
								 Remark
							</th>
						</tr>
					</thead>   
					<tbody>
						<?php 
						// if(empty($hroemployeededuction)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='4' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeededuction as $key=>$val){
								echo "
										<tr class='odd gradeX'>
											<td>".$this->main_model->getDeductionName($val[deduction_id])."</td>												
											<td style='text-align:right'>$val[employee_deduction_period]</td>
											<td style='text-align:right'>".nominal($val[employee_deduction_amount])."</td>
											<td>$val[employee_deduction_remark]</td>
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
