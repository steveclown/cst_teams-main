<style>
	th{
		font-size:12px  !important;
		font-weight: normal !important;
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
			Applicant Family List
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li class="btn-group">
					<div class="actions">
						<a href="<?php echo base_url();?>transactionalapplicantfamily/add" class="btn green yellow-stripe">
							<i class="fa fa-plus"></i>
							<span class="hidden-480">
								 Add Transactional Applicant Family
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
						Applicant Family List
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
							Status
						</th>
						<th>
							Family Status
						</th>
						<th>
							Applicant Name
						</th>
						<th>
							Family Name
						</th>
						<th>
							address
						</th>
						<th>
							City
						</th>
						<th>
							Zip Code
						</th>
						<th>
							RT
						</th>
						<th>
							RW
						</th>
						<th>
							Kecamatan
						</th>
						<th>
							Kelurahan
						</th>
						<th>
							Home Phone
						</th>
						<th>
							Mobile Phone 1
						</th>
						<th>
							Mobile Phone 2
						</th>
						<th>
							Gender
						</th>
						<th>
							Date Of Birth
						</th>
						<th>
							Place Of Birth
						</th>
						<th>
							Education
						</th>
						<th>
							Occupation
						</th>
						<th>
							Marital Status
						</th>
						<th width="120px">
							Action
						</th>
					</tr>
					</thead>
					<tbody>
					<?php
						foreach ($transactionalapplicantfamily as $key=>$val){
							
							echo"
								<tr>									
									<td>".$this->configuration->Status1[($val[status])]."</td>
									<td>".$this->transactionalapplicantfamily_model->getfamilystatusname($val[family_status_id])."</td>
									<td>".$this->transactionalapplicantfamily_model->getapplicantname($val[applicant_id])."</td>
									<td>$val[applicant_family_name]</td>
									<td>$val[applicant_family_address]</td>
									<td>$val[applicant_family_city]</td>
									<td>$val[applicant_family_zip_code]</td>
									<td>$val[applicant_family_rt]</td>
									<td>$val[applicant_family_rw]</td>
									<td>$val[applicant_family_kecamatan]</td>
									<td>$val[applicant_family_kelurahan]</td>
									<td>$val[applicant_family_home_phone]</td>
									<td>$val[applicant_family_mobile_phone1]</td>
									<td>$val[applicant_family_mobile_phone2]</td>
									<td>$val[applicant_family_gender]</td>
									<td style='text-align:right'>".tgltoview($val[applicant_family_date_of_birth])."</td>
									<td>$val[applicant_family_place_of_birth]</td>
									<td>$val[applicant_family_education]</td>
									<td>$val[applicant_family_occupation]</td>
									<td>".$this->transactionalapplicantfamily_model->getmaritalstatusname($val[marital_status_id])."</td>
									<td>
										<a href='".$this->config->item('base_url').'transactionalapplicantfamily/Edit/'.$val[applicant_family_id]."' class='btn default btn-xs purple'>
											<i class='fa fa-edit'></i> Edit
										</a>
										<a href='".$this->config->item('base_url').'transactionalapplicantfamily/delete/'.$val[applicant_family_id]."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
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