<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
	

</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"HroEmployeeStatusAlteration/reset_search";
	}
</script>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

			<!-- BEGIN PAGE TITLE & BREADCRUMB-->
			<div class = "page-bar">
				<ul class="page-breadcrumb">
					<li>
						<a href="<?php echo base_url();?>">
							Beranda
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>HroEmployeeStatusAlteration">
							Daftar Perubahan Status
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Perubahan Status <small>Kelola Perubahan Status </small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->

<?php echo form_open('HroEmployeeStatusAlteration/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision,set_value('division_id',$data['division_id']),'id="division_id" class="form-control select2me" ');
								?>
								<label class="control-label">Devisi</label>
							</div>	
						</div>
						
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('department_id', $coredepartment, set_value('department_id',$data['department_id']),'id="department_id" class="form-control select2me" ');
								?>
								<label class="control-label">Departemen</label>
							</div>	
						</div>
					</div>
					
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me" ');
								?>
								<label class="control-label">Bagian </label>
							</div>	
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('employee_id', $hroemployeedata, set_value('employee_id', $data['employee_id']), 'id="employee_id" class="form-control select2me" ');
								?>
								<label class="control-label">Karyawan </label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" class="form-control select2me" ');
								?>
								<label class="control-label">Bagian </label>
							</div>	
						</div>
					</div>
					
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Daftar
					</div>
				</div>
				<div class="portlet-body">
					<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th width="5%">
									No
								</th>
								<th>
									Nama Karyawan
								</th>
								<th>
									Nama Devisi
								</th>
								<th>
									Nama Departemen
								</th>
								<th>
									Nama Bagian
								</th>
								<th>
									Nama Status
								</th>
								<th width="20%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeedata_statusalteration as $key=>$val){
									/*<a href='".$this->config->item('base_url').'payrollhospitalclaim/editPayrollEmployeeSuspend/'.$val['employee_id']."' class='btn default btn-xs purple'>
													<i class='fa fa-edit'></i> Edit
												</a>*/
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$this->HroEmployeeStatusAlteration_model->getEmployeeName($val['employee_id'])."</td>
											<td>".$this->HroEmployeeStatusAlteration_model->getDivisionName($val['division_id'])."</td>
											<td>".$this->HroEmployeeStatusAlteration_model->getDepartmentName($val['department_id'])."</td>
											<td>".$this->HroEmployeeStatusAlteration_model->getSectionName($val['section_id'])."</td>
											<td>".$employeeemploymentstatus[$val['employee_employment_status']]."</td>
											<td>
												<a href='".$this->config->item('base_url').'HroEmployeeStatusAlteration/addHROEmployeeStatusAlteration/'.$val['employee_id']."' class='btn default btn-xs green-jungle'>
													<i class='fa fa-plus'></i> Tambah
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