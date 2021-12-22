<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterworkingexperience_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeworkingexperience">
					<thead>
					<tr>
						<th>
							Company Name
						</th>
						<th>
							Company Address
						</th>
						<th>
							Job Title
						</th>
						<th>
							From
						</th>
						<th>
							To
						</th>
						<th>
							Last Salary
						</th>
						<th>
							Reason
						</th>
						<th>
							Letter
						</th>
						<th>
							Remark
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						// if(empty($hroemployeeeducation)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='9' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeeworkingexperience as $key=>$val){
								
								echo"
									<tr>									
									<td>$val[company_name]</td>
									<td>$val[company_address]</td>
									<td>$val[working_experience_job_title]</td>
									<td>$val[working_experience_from_period]</td>
									<td>$val[working_experience_to_period]</td>
									<td>".nominal($val[working_experience_last_salary])."</td>
									<td>$val[working_experience_resign_reason]</td>
									<td>".$this->configuration->ResignLetter[($val[working_experience_resign_letter])]."</td>
									<td>$val[working_experience_remark]</td>
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