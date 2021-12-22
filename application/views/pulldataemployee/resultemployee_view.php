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
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<?php 
	$dataemployee	= $this->session->userdata("dataemployee");
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>List Employee
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover table-full-width">
							<thead>
								<tr>
									<th>
										ID
									</th>
									<th>
										Name
									</th>
									<th>
										Password
									</th>
								</tr>
							</thead>   
							<tbody>
								<?php 
								if(!empty($dataemployee)){
									foreach ($dataemployee as $key=>$val){
										echo "
												<tr class='odd gradeX'>
													<td>$val[id]</td>
													<td>$val[name]</td>
													<td>$val[password]</td>
												</tr>
										";
									}
								}else{
										echo "
												<tr class='odd gradeX'>
													<td colspan='6' style='text-align:center;'>No Data Available</td>
												</tr>
										";
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-actions right">
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
// $this->session->unset_userdata("dataemployee");
?>