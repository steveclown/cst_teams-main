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

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Nationality List <small>Manage Nationality</small>
		</h3>
		<div class="page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Home</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>nationality">Nationality</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
			<div class="page-toolbar">
				<div class="btn-group pull-right">
					<a href="<?php echo base_url();?>nationality/add" class="btn blue red-stripe">
						<i class="fa fa-plus"></i> Add New Nationality
					</a>
				</div>
			</div>
		</div>
		<!-- END PAGE TITLE & BREADCRUMB-->		
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	<div class="row">
			<div class="col-md-12">
				<div class="portlet box red-flamingo">
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
								Nationality Code
							</th>
							<th>
								Nationality Name
							</th>
							<th width="30%">
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
							foreach ($nationality as $key=>$val){
								
								echo"
									<tr>									
										<td>$val[nationality_code]</td>
										<td>$val[nationality_name]</td>
										<td>
											<a href='".$this->config->item('base_url').'nationality/Edit/'.$val[nationality_id]."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
											<a href='".$this->config->item('base_url').'nationality/delete/'.$val[nationality_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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