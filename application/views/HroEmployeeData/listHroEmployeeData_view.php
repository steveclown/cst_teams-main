<script>
	base_url = '<?php echo base_url();?>';
	
	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
			//alert(division_id);
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeData/lookup_core_division",
               data : {division_id: division_id},
               success: function(data){
                   $("#deparment_id").html(data);				   
               }
            });
        });
    });

    function reset_filter(){
		document.location = base_url+"HroEmployeeData/reset_search";
	}
</script>
	
			
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
								<a href="#">
									Daftar Data Karyawan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Daftar Data Karyawan <small>Kelola Data Karyawan</small>
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->
				
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<?php
	$data=$this->session->userdata('filter-HroEmployeeData');
?>
<?php echo form_open('HroEmployeeData/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Daftar Filter
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

							<div class="actions">
								<!-- <a href="<?php echo base_url();?>HroEmployeeData/addHROEmployeeData" class="btn btn-default sm">
									<i class="fa fa-plus"></i>
									Tambah Data Karyawan
								</a> -->
							</div>
						</div>
						<div class="portlet-body">
							<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
								<thead>
									<tr>
										<th width="5%">
											No
										</th>
										<th width="15%">
											Kode Karyawan
										</th>
										<th width="15%">
											Nama Karyawan
										</th>
										<th width="15%">
											Nama Devisi
										</th>
										<th width="15%">
											Nama Departemen
										</th>
										<th width="15%">
											Nama Bagian
										</th>
										<th width="20%">
											Aksi
										</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$no=1;
										/*print_r("HRO Employee Data ");
										print_r($HroEmployeeData);
										*/
										foreach ($HroEmployeeData as $key=>$val){
											echo"
												<tr>				
													<td>".$no."</td>					
													<td>".$val['employee_code']."</td>
													<td>".$val['employee_name']."</td>
													<td>".$this->HroEmployeeData_model->getDivisionName($val['division_id'])."</td>
													<td>".$this->HroEmployeeData_model->getDepartmentName($val['department_id'])."</td>
													<td>".$this->HroEmployeeData_model->getSectionName($val['section_id'])."</td>
													<td>
														<a href='".$this->config->item('base_url').'hro-employee-data/edit/'.$val['employee_id']."' class='btn default btn-xs purple'>
															<i class='fa fa-edit'></i> Edit
														</a>
													</td>
												</tr>
											";
											$no++;
										} 
									?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>
		<?php echo form_close(); ?>	