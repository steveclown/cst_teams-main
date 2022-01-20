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
								<a href="<?php echo base_url();?>corelocation">
									Location List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Location List <small>Manage Location</small>
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
								<a href="<?php echo base_url();?>location/add" class="btn btn-default btn-sm">
									<i class="fa fa-plus"></i> Add New Location
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
											Location Code
										</th>
										<th>
											Location Name
										</th>
										<th width="30%">
											Action
										</th>
									</tr>
								</thead>
								<tbody>
								<?php
									$no=1;
									foreach ($corelocation as $key=>$val){
										
										echo"
											<tr>		
												<td>".$no."</td>
												<td>".$val['location_code']."</td>
												<td>".$val['location_name']."</td>
												<td>
													<a href='".$this->config->item('base_url').'location/edit/'.$val['location_id']."' class='btn default btn-xs purple'>
														<i class='fa fa-edit'></i> Edit
													</a>
													<a href='".$this->config->item('base_url').'location/delete/'.$val['location_id']."' onClick='javascript:return confirm(\"Apakah yakin ingin dihapus ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Hapus
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