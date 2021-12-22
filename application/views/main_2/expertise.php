<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterexpertise_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeexpertise">
					<thead>
					<tr>
						<th>Name</th>
						<th>Title</th>
						<th>City</th>
						<th>Start Period</th>
						<th>End Period</th>
						<th>Duration</th>
						<th>Status</th>
						<th>Certificate</th>
					</tr>
					</thead>
					<tbody>
					<?php
						// if(empty($hroemployeeexpertise)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='8' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeeexpertise as $key=>$val){
								
								echo"
									<tr>									
										<td>".$this->main_model->getexpertisename($val[expertise_id])."</td>
										<td>$val[employee_expertise_name]</td>
										<td>$val[employee_expertise_city]</td>
										<td style='text-align:right'>$val[employee_expertise_from_period]</td>
										<td style='text-align:right'>$val[employee_expertise_to_period]</td>
										<td style='text-align:right'>$val[employee_expertise_duration]</td>
										<td>".$this->configuration->ExpertisePassed[($val[employee_expertise_passed])]."</td>
										<td>".$this->configuration->ExpertiseCertificate[($val[employee_expertise_certificate])]."</td>
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
