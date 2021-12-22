

					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb ">
							<li>
								<a href="<?php echo base_url();?>">
									Master
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>corediagnose">
									Diagnose List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Diagnose List <small>Manage Diagnose</small>
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
								<a href="<?php echo base_url();?>corediagnose/addCoreDiagnose" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Add New Diagnose
								</a>
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
								<thead>
									<tr>
										<th>
											Diagnose Code
										</th>
										<th>
											Diagnose Name
										</th>
										<th width="30%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										foreach ($corediagnose as $key=>$val){
											
											echo"
												<tr>									
													<td>$val[diagnose_code]</td>
													<td>$val[diagnose_name]</td>
													<td>
														<a href='".$this->config->item('base_url').'corediagnose/editCoreDiagnose/'.$val[diagnose_id]."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'corediagnose/deleteCoreDiagnose/'.$val[diagnose_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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