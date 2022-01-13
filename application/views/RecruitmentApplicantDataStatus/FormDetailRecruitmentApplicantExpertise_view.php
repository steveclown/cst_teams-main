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
						<th style='text-align:center' width="10%">Keahlian</th>
						<th style='text-align:center' width="10%">Nama</th>
						<th style='text-align:center' width="10%">Kota</th>
						<th style='text-align:center' width="10%">Dari tahun </th>
						<th style='text-align:center' width="10%">Sampai tahun </th>
						<th style='text-align:center' width="10%">Durasi</th>
						<th style='text-align:center' width="10%">Lulus</th>
						<th style='text-align:center' width="10%">Sertifikat</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($recruitmentapplicantexpertise)){
						echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($recruitmentapplicantexpertise as $key=>$val){
							echo"
								<tr>
									<td>".$val['expertise_name']."</td>
									<td>".$val['applicant_expertise_name']."</td>
									<td>".$val['applicant_expertise_city']."</td>
									<td>".$val['applicant_expertise_from_period']."</td>
									<td>".$val['applicant_expertise_to_period']."</td>
									<td>".$val['applicant_expertise_duration']."</td>
									<td>".$status[$val['applicant_expertise_passed']]."</td>
									<td>".$status[$val['applicant_expertise_certificate']]."</td>
								</tr>
							";
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>