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
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
		<div class="col-md-12">
			<h3 class="page-title">
			List Request Applicant
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li class="btn-group">
					<div class="actions">
						<a href="<?php echo base_url();?>transactionalrequestemployee/daftar" class="btn green yellow-stripe">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
								 Add New Request
							</span>
						</a>
					</div>
				</li>
				<li>
					<i class="fa fa-home"></i>
					<a href="<?php echo base_url();?>">
						Master
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>transactionalrequestemployee">
						Request List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
</div>
<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
					<thead>
					<tr>
						<th>
							Title
						</th>
						<th>
							Date
						</th>
						<th>
							Due Date
						</th>
						<th>
							Region
						</th>
						<th>
							Branch
						</th>
						<th>
							Division
						</th>
						<th>
							Department
						</th>
						<th>
							Section
						</th>
						<th>
							Location
						</th>
						<th>
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach ($transactionalrequestemployee as $key=>$val){
							
							echo"
								<tr>									
									<td>$val[applicant_request_title]</td>
									<td>$val[applicant_request_date]</td>
									<td>$val[applicant_request_due_date]</td>
									<td>".$this->transactionalrequestemployee_model->getregionname($val[region_id])."</td>
									<td>".$this->transactionalrequestemployee_model->getbranchname($val[branch_id])."</td>
									<td>".$this->transactionalrequestemployee_model->getdivisionname($val[division_id])."</td>
									<td>".$this->transactionalrequestemployee_model->getdepartmentname($val[department_id])."</td>
									<td>".$this->transactionalrequestemployee_model->getsectionname($val[section_id])."</td>
									<td>".$this->transactionalrequestemployee_model->getlocationname($val[location_id])."</td>
									<td>
										<a href='".$this->config->item('base_url').'transactionalrequestemployee/detail/'.$val[applicant_request_id]."' class='btn default btn-xs default'>
											<i class='fa fa-search'></i> Detail
										</a>
									</td>
								</tr>
							";
					} ?>
					</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>