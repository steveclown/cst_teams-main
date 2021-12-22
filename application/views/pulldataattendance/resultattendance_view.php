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
	// echo form_open('addnewapplicant/processaddapplicanteducation',array('id' => 'myform', 'class' => 'form-horizontal')); 
	$dataattendance	= $this->session->userdata("dataattendance");
	// print_r($dataattendance);exit;
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>List Attendance
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="table-scrollable">
						<table class="table table-striped table-bordered table-hover table-full-width">
							<thead>
								<tr>
									<th>
										Index
									</th>
									<th>
										ID
									</th>
									<th>
										Status
									</th>
									<th>
										Tanggal
									</th>
									<th>
										Jam
									</th>
								</tr>
							</thead>   
							<tbody>
								<?php 
								if(!empty($dataattendance)){
									foreach ($dataattendance as $key=>$val){
										echo "
												<tr class='odd gradeX'>
													<td>$val[index]</td>
													<td>$val[id]</td>
													<td>$val[status]</td>
													<td>$val[tanggal]</td>
													<td>$val[jam]</td>
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
					<!--<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>-->
				</div>
			</div>
		</div>
	</div>
</div>
<?php 
// echo form_close(); 
// $this->session->unset_userdata("dataattendance");
?>