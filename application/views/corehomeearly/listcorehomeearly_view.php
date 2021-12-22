
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

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
						<a href="<?php echo base_url();?>corehomeearly">
							Home_Early List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Home Early List <small>Manage Home Early</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>List
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>corehomeearly/addCoreHomeEarly" class="btn btn-default btn-sm">
							<i class="fa fa-plus"></i> Add New Home Early
						</a>
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>
									No
								</th>
								<th>
									Home Early Code
								</th>
								<th>
									Home Early Name
								</th>
								<th>
									Deduction Name
								</th>
								<th width="25%">
									Action
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no = 1;
								foreach ($corehomeearly as $key=>$val){
									
									echo"
										<tr>		
											<td>".$no."</td>
											<td>".$val['home_early_code']."</td>
											<td>".$val['home_early_name']."</td>
											<td>".$val['deduction_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'corehomeearly/editCoreHomeEarly/'.$val[home_early_id]."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'corehomeearly/deleteCoreHomeEarly/'.$val[home_early_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
													<i class='fa fa-trash-o'></i> Delete
												</a>
											</td>
										</tr>
									";
									$no++;
							} ?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
<?php echo form_close(); ?>