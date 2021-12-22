
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="10%">Late Date</th>
									<th style='text-align:center' width="30%">Late Name</th>
									<th style='text-align:center' width="30%">Late Description</th>
									<th style='text-align:center' width="30%">Late Duration</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($hroemployeelate)){
									foreach($hroemployeelate as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".tgltoview($val['employee_late_date'])."</td>
												<td>".$val['late_name']."</td>
												<td>".$val['employee_late_description']."</td>
												<td>".$val['employee_late_duration']."</td>
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


