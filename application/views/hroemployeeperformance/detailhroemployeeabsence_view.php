
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="10%">Absence Date</th>
									<th style='text-align:center' width="25%">Absence Name</th>
									<th style='text-align:center' width="25%">Absence Description</th>
									<th style='text-align:center' width="10%">Start Date</th>
									<th style='text-align:center' width="10%">End Date</th>
									<th style='text-align:center' width="20%">Absence Duration</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($hroemployeeabsence)){
									foreach($hroemployeeabsence as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".tgltoview($val['employee_absence_date'])."</td>
												<td>".$val['absence_name']."</td>
												<td>".$val['employee_absence_description']."</td>
												<td>".tgltoview($val['employee_absence_start_date'])."</td>
												<td>".tgltoview($val['employee_absence_end_date'])."</td>
												<td>".$val['employee_absence_duration']."</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='20' style='text-align:center;'>
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


