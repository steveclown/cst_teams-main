<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 12px !important;
	}
	

</style>				

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th style='text-align:center' width="10%">Name</th>
						<th style='text-align:center' width="10%">Address</th>
						<th style='text-align:center' width="10%">Job Title</th>
						<th style='text-align:center' width="10%">From Period</th>
						<th style='text-align:center' width="10%">To Period</th>
						<th style='text-align:center' width="10%">Last Salary</th>
						<th style='text-align:center' width="10%">Separation Reason</th>
						<th style='text-align:center' width="10%">Separation Letter</th>
						<th style='text-align:center' width="10%">Remark</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					if(!empty($recruitmentapplicantexperience)){
						foreach($recruitmentapplicantexperience as $key => $val){
							echo"
								<tr class='odd gradeX'>
									<td>".$val['experience_company_name']."</td>
									<td>".$val['experience_company_address']."</td>
									<td>".$val['experience_job_title']."</td>
									<td>".$val['experience_from_period']."</td>
									<td>".$val['experience_to_period']."</td>
									<td>".$val['experience_last_salary']."</td>
									<td>".$val['experience_separation_reason']."</td>
									<td>".$separationletter[$val['experience_separation_letter']]."</td>
									<td>".$val['experience_remark']."</td>
								</tr>
							";
							$no++;
						}
					}else{
						echo"
							<tr class='odd gradeX'>
								<td colspan='11' style='text-align:center;'>
									<b>Tidak Ada Data</b>
								</td>
							</tr>
						";
					}
				?>
			</table>
		</div>
	</div>
</div>