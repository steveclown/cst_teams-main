<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfiltersalaryhistory_view'); 
?>	
<div class="form-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeesalaryhistory">
						<thead>
							<tr>
								<th style='text-align:center !important;'>Date</th>
								<th style='text-align:center !important;'>Grade</th>
								<th style='text-align:center !important;'>Class</th>
								<th style='text-align:center !important;'>Remark</th>
							</tr>
						</thead>
						<tbody>
						<?php
						// if(empty($hroemployeesalaryhistory)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='4' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeesalaryhistory as $key=>$val){
								echo "
									<tr class='odd gradeX'>
										<td style='text-align:right'>".tgltoview($val[salary_increment_date])."</td>
										<td>".$this->main_model->getGrade($val[grade_id])."</td>
										<td>".$this->main_model->getClass($val[class_id])."</td>
										<td>$val[salary_increment_remark]</td>
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