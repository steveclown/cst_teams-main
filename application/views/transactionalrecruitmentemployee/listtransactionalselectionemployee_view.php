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
				Selection List
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo base_url();?>">
							Master
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalrecruitmentemployee">
							Recruitment List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Selection List
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
						Interview Date
					</th>
					<th width="120px">
						Action
					</th>
				</tr>
				</thead>
				<tbody>
				<?php
					foreach ($transactionalselectionemployee as $key=>$val){
						
						echo"
							<tr>									
								<td>".tgltoview($val[applicant_selection_date])."</td>
								<td>".tgltoview($val[applicant_selection_interview_date])."</td>
								<td>
									<a href='".$this->config->item('base_url').'transactionalrecruitmentemployee/add/'.$val[applicant_selection_id]."' class='btn default btn-xs default'>
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