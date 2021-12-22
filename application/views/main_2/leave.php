<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterleave_view'); 
?>
<div class="form-body form">
		<form action="#" class="horizontal-form">
		<div class="form-body">		
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeleave">
						<thead>
							<tr>
								<th>Leave Name</th>
								<th>Period</th>
								<th>Days</th>
								<th>Taken</th>
								<th>Last Balance</th>
								<th>Remark</th>
							</tr>
						</thead>
						<tbody>
						<?php
						// print_r($hroemployeeleave);exit;
						// if(empty($hroemployeeleave)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='6' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeeleave as $key=>$val){
								echo "
									<tr class='odd gradeX'>
										<td>".$this->main_model->getannualleavename($val[annual_leave_id])."</td>
										<td style='text-align:right'>".tgltoview($val[employee_leave_period])."</td>
										<td style='text-align:right'>$val[employee_leave_days]</td>
										<td style='text-align:right'>$val[employee_leave_taken]</td>
										<td style='text-align:right'>$val[employee_leave_last_balance]</td>
										<td>$val[employee_leave_remark]</td>
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
		</form>
	</div>
</div>