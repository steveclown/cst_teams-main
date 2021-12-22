
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="10%">Overtime Date</th>
									<th style='text-align:center' width="25%">Overtime Type Name</th>
									<th style='text-align:center' width="25%">Overtime Description</th>
									<th style='text-align:center' width="20%">Overtime Duration</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($payrollovertimerequest)){
									foreach($payrollovertimerequest as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".tgltoview($val['overtime_request_date'])."</td>
												<td>".$val['overtime_type_name']."</td>
												<td>".$val['overtime_request_description']."</td>
												<td>".$val['overtime_request_duration']."</td>
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


