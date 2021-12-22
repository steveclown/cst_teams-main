<style>

	th{
		font-size:12px  !important;
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
		margin-bottom: 10px !important;
	}
	

</style>


			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i></i>
						<a href="<?php echo base_url();?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Applicant List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Applicant Data <small>Manage Applicant Data</small>
			</h1>
			
			<!-- END PAGE TITLE & BREADCRUMB-->
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box red-flamingo">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>List
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>recruitmentapplicantdata/addRecruitmentApplicantData" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Add New Applicant</a>
				</div>
			</div>
			<div class="portlet-body">
			<div class="form-body">
				<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
				<!--<table class="table table-striped table-bordered table-hover table-full-width">-->
					<thead>
						<tr>
							<th style='text-align:center' width='4%'>No</th>
							<th style='text-align:center' width='15%'>Name</th>
							<th style='text-align:center' width='8%'>Date</th>
							<th style='text-align:center' width='20%'>Address</th>
							<th style='text-align:center' width='15%'>City</th>
							<th style='text-align:center' width='15%'>Position</th>
							<th style='text-align:center' width='8%'>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							// if(empty($item)){
								// echo "<tr><td style='text-align:center' colspan='10'>Data Masih Kosong</td></tr>";
							// } else {
								$no = 1;
								foreach($recruitmentapplicantdata as $key=>$val){
									echo"
										<tr>
											<td style='text-align:center'>$no.</td>
											<td>".$val['applicant_name']."</td>
											<td>".tgltoview($val['applicant_application_date'])."</td>
											<td>".$val['applicant_address']."</td>
											<td>".$val['applicant_city']."</td>
											<td>".$val['applicant_application_position']."</td>
											<td>
												
												<a href='".base_url().'recruitmentapplicantdata/delete/'.$val['applicant_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Delete
												</a>
											</td>
										</tr>
									";
									/* <a href='".base_url().'recruitmentapplicantdata/edit/'.$val['applicant_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a> */
									$no++;
								}
							// }
						?>
					</tbody>
				</table>
			</div>
			</div>
		</div>
	</div>
</div>