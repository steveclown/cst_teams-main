
	
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
								<a href="<?php echo base_url();?>corelostitem">
									Lost Item List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Lost Item List <small>Manage Lost Item</small>
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
								<a href="<?php echo base_url();?>corelostitem/addCoreLostItem" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Add New Lost Item
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
											Lost Item Code
										</th>
										<th>
											Lost Item Name
										</th>
										<th width="25%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no=1;
										foreach ($corelostitem as $key=>$val){									
											echo"
												<tr>				
													<td>".$no."</td>					
													<td>".$val['lost_item_code']."</td>
													<td>".$val['lost_item_name']."</td>
													<td>
														<a href='".$this->config->item('base_url').'corelostitem/editCoreLostItem/'.$val['lost_item_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
														<a href='".$this->config->item('base_url').'corelostitem/deleteCoreLostItem/'.$val['lost_item_id']."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
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