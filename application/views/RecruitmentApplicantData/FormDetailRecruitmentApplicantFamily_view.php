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
						<th style='text-align:center' width="20%">Hubungan Keluarga </th>
						<th style='text-align:center' width="20%">Nama Keluarga </th>
						<th style='text-align:center' width="10%">Kota</th>
						<th style='text-align:center' width="20%">No HP</th>
						<th style='text-align:center' width="20%">Pendidikan</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($recruitmentapplicantfamily)){
						echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($recruitmentapplicantfamily as $key => $val){
							echo"
								<tr>
									<td>".$val['family_relation_name']."</td>
									<td>".$val['applicant_family_name']."</td>
									<td>".$val['applicant_family_city']."</td>
									<td>".$val['applicant_family_mobile_phone']."</td>
									<td>".$val['applicant_family_education']."</td>
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