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
	
	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
</style>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Training Candidate Selection List <small>Manage Training Candidate Selection</small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionaltrainingselection/add" class="btn green yellow-stripe">
						<i class="fa fa-plus"></i>
						<span class="hidden-480">
							 Add Training Candidate Selection
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
				<a href="<?php echo base_url();?>transactionaltrainingselection">
					Training Candidate Selection List
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
							<th width="25%">Training Schedule Name</th>
							<th width="25%">Selection Period</th>
							<th width="25%">Selection Date</th>
							<th width="25%">Employee Name</th>				
							<th width="25%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							foreach ($transactionaltrainingselection as $key=>$val){					
								echo"
									<tr>									
										<td>".$this->transactionaltrainingselection_model->getschedulename($val[training_schedule_id])."</td>
										<td style='text-align:right'>".$val[training_selection_period]."</td>
										<td>".$this->transactionaltrainingselection_model->getemployeename($val[employee_id])."</td>
										<td style='text-align:right'>".tgltoview($val[training_selection_date])."</td>
										<td>
											<a href='".$this->config->item('base_url').'transactionaltrainingselection/edit/'.$val[training_selection_id]."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
											<a href='".$this->config->item('base_url').'transactionaltrainingselection/delete/'.$val[training_selection_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
												<i class='fa fa-trash-o'></i> Delete
											</a>
										</td>
									</tr>
								";
							} 
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<?php echo form_close(); ?>
