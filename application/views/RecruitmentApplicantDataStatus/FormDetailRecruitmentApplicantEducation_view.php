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
						<th style='text-align:center' width="10%">Pendidikan</th>
						<th style='text-align:center' width="10%">Jenis</th>
						<th style='text-align:center' width="10%">Nama</th>
						<th style='text-align:center' width="10%">Kota</th>
						<th style='text-align:center' width="10%">Tahun Masuk</th>
						<th style='text-align:center' width="10%"> Tahun Lulus</th>
						<th style='text-align:center' width="10%">Durasi</th>
						<th style='text-align:center' width="10%">Lulus</th>
						<th style='text-align:center' width="10%">Ijazah</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($recruitmentapplicanteducation)){
						echo "<tr><th colspan='9' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($recruitmentapplicanteducation as $key=>$val){
							echo"
								<tr>
									<td>".$val['education_name']."</td>
									<td>".$educationtype[$val['applicant_education_type']]."</td>
									<td>".$val['applicant_education_name']."</td>
									<td>".$val['applicant_education_city']."</td>
									<td>".$val['applicant_education_from_period']."</td>
									<td>".$val['applicant_education_to_period']."</td>
									<td>".$val['applicant_education_duration']."</td>
									<td>".$status[$val['applicant_education_passed']]."</td>
									<td>".$status[$val['applicant_education_certificate']]."</td>
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