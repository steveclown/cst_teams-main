
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="10%">Day Off Date</th>
									<th style='text-align:center' width="25%">Day Off Name</th>
									<th style='text-align:center' width="25%">Day Off Description</th>
									<th style='text-align:center' width="10%">Start Date</th>
									<th style='text-align:center' width="10%">End Date</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($hroemployeeworkingdayoff)){
									foreach($hroemployeeworkingdayoff as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".tgltoview($val['employee_working_dayoff_date'])."</td>
												<td>".$val['dayoff_name']."</td>
												<td>".$val['employee_working_dayoff_description']."</td>
												<td>".tgltoview($val['employee_working_dayoff_start_date'])."</td>
												<td>".tgltoview($val['employee_working_dayoff_end_date'])."</td>
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


