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
    
	
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->					
					<div class = "page-bar">
						<ul class="page-breadcrumb ">
							<li>
								<a href="<?php echo base_url();?>">
									Home
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">
									User Group List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						User Group <small>Manage User Group</small>
					</h3>
					<!-- END PAGE TITLE & BREADCRUMB-->
		
		<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>List
							</div>

							<div class="actions">
								<a href="<?php echo base_url();?>systemusergroup/addSystemUserGroup" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">
										 Add New User Group
									</span>
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
											Level
										</th>
										<th>
											User Group Code
										</th>
										<th>
											User Group Name
										</th>
										<th width="30%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
										foreach ($systemusergroup as $key=>$val){
											echo"
												<tr>
													<td>$no</td>									
													<td>".$val['user_group_level']."</td>
													<td>".$val['user_group_code']."</td>
													<td>".$val['user_group_name']."</td>
													<td>
														<a href='".$this->config->item('base_url').'systemusergroup/editSystemUserGroup/'.$val['user_group_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'systemusergroup/deleteSystemUserGroup/'.$val['user_group_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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
