
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>corecostbudget">
							Cost Budget List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Core Budget List <small>Manage Cost Budget</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

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
					<div class="actions">
						<a href="<?php echo base_url();?>corecostbudget/addCoreCostBudget" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Cost Budget
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									Cost Budget Code
								</th>
								<th>
									Cost Budget Name
								</th>
								<th>
									Cost Budget Amount
								</th>
								<th width="120px">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								foreach ($corecostbudget as $key=>$val){
									
									echo"
										<tr>									
											<td>".$val['cost_budget_code']."</td>
											<td>".$val['cost_budget_name']."</td>
											<td>".nominal($val['cost_budget_amount'])."</td>
											<td>
												<a href='".$this->config->item('base_url').'corecostbudget/editCoreCostBudget/'.$val[cost_budget_id]."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'corecostbudget/deleteCoreCostBudget/'.$val[cost_budget_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Delete
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