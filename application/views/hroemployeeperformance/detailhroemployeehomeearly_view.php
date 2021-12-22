
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="10%">Home Early Date</th>
									<th style='text-align:center' width="25%">Home Early Name</th>
									<th style='text-align:center' width="25%">Home Early Description</th>
									<th style='text-align:center' width="20%">Home Early Reason</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($hroemployeehomeearly)){
									foreach($hroemployeehomeearly as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".tgltoview($val['employee_home_early_date'])."</td>
												<td>".$val['home_early_name']."</td>
												<td>".$val['employee_home_early_description']."</td>
												<td>".$val['employee_home_early_reason']."</td>
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


