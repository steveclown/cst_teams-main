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
				Glasses Coverage List for : <?php echo $this->transactionalglassesadjustment_model->getemployeename($this->session->userdata("employee_id"));?>
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalglassesadjustment" class="btn green yellow-stripe">
								<i class="fa fa-angle-left"></i>
								<span class="hidden-480">
									 Back
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
						<a href="<?php echo base_url();?>transactionalglassesadjustment">
							Glasses Adjustment List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Glasses Coverage List
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
									Name
								</th>
								<th>
									Period
								</th>
								<th>
									Amount
								</th>
								<th>
									Claimed
								</th>
								<th>
									Last Balance
								</th>
								<th width="120px">
									Action
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
								// if(empty($glassescoverage)){
									// echo "	<tr class='odd gradeX'>
												// <td colspan='5' style='text-align:center;'>No Data Available</td>
											// </tr>
									// ";						
								// }else{
								foreach ($glassescoverage as $key=>$val){
									echo"
										<tr>									
											<td>".$this->transactionalglassesadjustment_model->getglassescoveragename($val[glasses_coverage_id])."</td>
											<td>$val[glasses_coverage_period]</td>
											<td>".nominal($val[glasses_coverage_amount])."</td>
											<td>".nominal($val[glasses_coverage_claimed])."</td>
											<td>".nominal($val[glasses_coverage_last_balance])."</td>
											<td>
												<a href='".$this->config->item('base_url').'transactionalglassesadjustment/add/'.$val[employee_glasses_coverage_id]."' class='btn default btn-xs blue'>
													<i class='fa fa-check'></i> Adjust
												</a>
											</td>
										</tr>
									";
									} 
								// } 
							?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- END EXAMPLE TABLE PORTLET-->
			</div>
		</div>
<?php echo form_close(); ?>	