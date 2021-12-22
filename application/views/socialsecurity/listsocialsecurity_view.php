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
				Social Security List <small>Manage Social Security</small>
				</h3>
				<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>socialsecurity/Add" class="btn green yellow-stripe">
								<i class="fa fa-plus"></i>
								<span class="hidden-480">
									 Add New Social Security
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
						<a href="#">
							Social Security List
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
								Period
							</th>
							<th>
								JKM
							</th>
							<th>
								JKK
							</th>
							<th>
								JHT Employee
							</th>
							<th>
								Medical Company
							</th>
							<th>
								Medical Employee
							</th>
							<th>
								JHT Company
							</th>
							<th width="5%">
								Action
							</th>
						</tr>
						</thead>
						<tbody>
						<?php
							foreach ($socialsecurity as $key=>$val){
								
								echo"
									<tr>									
										<td>$val[social_security_period]</td>
										<td>$val[social_security_jkm]</td>
										<td>$val[social_security_jkk]</td>
										<td>$val[social_security_jht_employee]</td>
										<td>$val[social_security_jht_company]</td>
										<td>$val[social_security_medical_employee]</td>
										<td>$val[social_security_medical_company]</td>
										<td>
											<a href='".$this->config->item('base_url').'socialsecurity/Edit/'.$val[social_security_id]."' class='btn default btn-xs purple'>
												<i class='fa fa-edit'></i> Edit
											</a>
											<a href='".$this->config->item('base_url').'socialsecurity/delete/'.$val[social_security_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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