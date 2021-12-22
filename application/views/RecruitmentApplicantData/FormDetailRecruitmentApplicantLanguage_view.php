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
						<th style='text-align:center' width="30%">Bahasa</th>
						<th style='text-align:center' width="15%">Kemampuan Mendengar</th>
						<th style='text-align:center' width="15%">Kemampuan Membaca</th>
						<th style='text-align:center' width="15%">Kemampuan Menulis</th>
						<th style='text-align:center' width="15%">Kemampuan Berbicara</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;

					if(!empty($recruitmentapplicantlanguage)){
						foreach($recruitmentapplicantlanguage as $key => $val){
							echo"
								<tr class='odd gradeX'>
									<td>".$val['language_name']."</td>
									<td>".$listeningskill[$val['applicant_language_listen']]."</td>
									<td>".$readingskill[$val['applicant_language_read']]."</td>
									<td>".$writingskill[$val['applicant_language_write']]."</td>
									<td>".$speakingskill[$val['applicant_language_speak']]."</td>
								</tr>
							";
							$no++;
						}
					}else{
						echo"
							<tr class='odd gradeX'>
								<td colspan='12' style='text-align:center;'>
									<b>No Data</b>
								</td>
							</tr>
						";
					}
				?>		
				<tbody>
			</table>
		</div>
	</div>
</div>