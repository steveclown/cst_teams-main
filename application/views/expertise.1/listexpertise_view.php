<style>
	input[type="text"] {
		height:30px !important; 
		width:50% !important;
		margin : 0 auto;
	}
	th{
		font-size: 14px  !important;
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
    
		<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Expertise <small>List</small>
					</h3>
					
					<ul class="page-breadcrumb breadcrumb">
						<li class="btn-group">
							<div class="actions">
								<a href="<?php echo base_url();?>expertise/Add" class="btn green yellow-stripe">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">
										 Add New expertise
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
							<a href="<?php echo base_url();?>expertise">
								Expertise List
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
		</div>
		
		<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>List
							</div>
						</div>
						<div class="portlet-body">
							
							<table class="table table-striped table-bordered table-hover table-full-width" id="sample_3">
							<thead>
							<tr>
								<th width="5%">
									 No
								</th>
								<th width="25%">
									Expertise Code
								</th>
								<th width="25%">
									Expertise Name
								</th>
								<th width="25%">
									Expertise Remark
								</th>
								<th width="25%">
									Action
								</th>
							</tr>
							</thead>
							<tbody>
							<?php
							$no=1;
								foreach ($Expertise as $key=>$val){
									
									echo"
										<tr>									
											<td>$no</td>
											<td>$val[expertise_code]</td>
											<td>$val[expertise_name]</td>
											<td>$val[expertise_remark]</td>
											<td>
												<a href='".$this->config->item('base_url').'expertise/Edit/'.$val[expertise_id]."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>
												<a href='".$this->config->item('base_url').'expertise/delete/'.$val[expertise_id]."' onClick='javascript:return confirm(\"apakah yakin ingin dihapus ?\")' class='btn default btn-xs black'>
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