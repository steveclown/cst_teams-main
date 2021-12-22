
					<div class="row">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered table-advance table-hover">
									<thead>
										<tr>
											<th style='text-align:center' width="5%">No.</th>
											<th style='text-align:center' width="9%">Transfer Date</th>
											<th style='text-align:center' width="9%">Region Name</th>
											<th style='text-align:center' width="9%">Branch Name</th>
											<th style='text-align:center' width="9%">Location Name</th>
											<th style='text-align:center' width="9%">Division Name</th>
											<th style='text-align:center' width="9%">Department Name</th>
											<th style='text-align:center' width="9%">Section Name</th>
											<th style='text-align:center' width="9%">Job Title Name</th>
											<th style='text-align:center' width="9%">Grade Name</th>
											<th style='text-align:center' width="9%">Class Name</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$no = 1;
											if(!empty($hroemployeetransfer_data)){
												foreach($hroemployeetransfer_data as $key=>$val){
													echo"
														<tr class='odd gradeX'>
															<td style='text-align:center'>$no.</td>
															<td>".tgltoview($val['employee_transfer_date'])."</td>
															<td>".$val['region_name']."</td>
															<td>".$val['branch_name']."</td>
															<td>".$val['location_name']."</td>
															<td>".$val['division_name']."</td>
															<td>".$val['department_name']."</td>
															<td>".$val['section_name']."</td>
															<td>".$val['job_title_name']."</td>
															<td>".$val['grade_name']."</td>
															<td>".$val['class_name']."</td>
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
				