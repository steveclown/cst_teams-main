
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th style='text-align:center' width="10%">Leave Date</th>
									<th style='text-align:center' width="25%">Leave Name</th>
									<th style='text-align:center' width="25%">Leave Description</th>
									<th style='text-align:center' width="10%">Start Date</th>
									<th style='text-align:center' width="10%">End Date</th>
									<th style='text-align:center' width="20%">Leave Duration</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($payrollleaverequest)){
									foreach($payrollleaverequest as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td>".tgltoview($val['leave_request_date'])."</td>
												<td>".$val['annual_leave_name']."</td>
												<td>".$val['leave_request_description']."</td>
												<td>".tgltoview($val['leave_request_start_date'])."</td>
												<td>".tgltoview($val['leave_request_end_date'])."</td>
												<td>".$val['leave_request_duration']."</td>
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


