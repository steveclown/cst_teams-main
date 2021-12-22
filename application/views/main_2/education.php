<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfiltereducation_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeeducation">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Type
						</th>
						<th>
							Title
						</th>
						<th>
							City
						</th>
						<th>
							From
						</th>
						<th>
							To
						</th>
						<th>
							Duration
						</th>
						<th>
							Status
						</th>
						<th>
							Certificate
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
							foreach ($hroemployeeeducation as $key=>$val){
								
								echo"
									<tr>									
										<td>".$this->main_model->geteducationname($val[education_id])."</td>
										<td>".$this->configuration->EducationType[($val[education_type])]."</td>
										<td>$val[employee_education_name]</td>
										<td>$val[employee_education_city]</td>
										<td style='text-align:right;'>$val[employee_education_from_period]</td>
										<td style='text-align:right;'>$val[employee_education_to_period]</td>
										<td style='text-align:right;'>$val[employee_education_duration]</td>
										<td>".$this->configuration->EducationPassed[($val[employee_education_passed])]."</td>
										<td>".$this->configuration->EducationCertificate[($val[employee_education_certificate])]."</td>
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
