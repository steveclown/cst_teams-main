<style>
	th{
		font-size: 12px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

</style>

	<div class="row">
			<div class="col-md-12">
				<!-- BEGIN PAGE TITLE & BREADCRUMB-->
				<h3 class="page-title">
				Recruitment List <small>Manage Recruitment</small>
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalrecruitmentemployee/listselection" class="btn green yellow-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
									 Add New Recruitment
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
						<a href="#">
							Recruitment List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
				<!-- END PAGE TITLE & BREADCRUMB-->
			</div>
	</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
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
						Date
					</th>
					<th>
						Due Date
					</th>
					<th width="120px">
						Action
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($transactionalrecruitmentemployee as $key=>$val){
						
						echo"
							<tr>									
								<td>".tgltoview($val[applicant_recruitment_date])."</td>
								<td>".tgltoview($val[applicant_recruitment_due_date])."</td>
								<td>
									<a href='".$this->config->item('base_url').'transactionalrecruitmentemployee/detail/'.$val[applicant_recruitment_id]."' class='btn default btn-xs default'>
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
<?php echo form_close(); ?>	