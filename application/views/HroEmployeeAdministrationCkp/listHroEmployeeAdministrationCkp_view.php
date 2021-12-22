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
		document.location = base_url+"HroEmployeeAdministrationCkp/reset_search";
	}

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAdministrationCkp/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	$(document).ready(function(){
        $("#location_id").change(function(){
			var location_id 	= $("#location_id").val();
			
				$.ajax({
					type: "POST",
					url : "<?php echo site_url('HroEmployeeAdministrationCkp/getScheduleEmployeeShift');?>",
					data: {location_id: location_id},
					success: function(msg){
					// alert(msg);
					$('#employee_shift_id').html(msg);
				}
				});
		});
	});
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
						<a href="<?php echo base_url();?>HroEmployeeAdministrationCkp">
							Daftar Administrasi Karyawan
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>
			<h1 class="page-title">
				Daftar Administrasi Karyawan <small>Kelola Administrasi Karyawan</small>
			</h1>
			<!-- END PAGE TITLE & BREADCRUMB-->


	
<?php 
	echo form_open('HroEmployeeAdministrationCkp/filter',array('id' => 'myform', 'class' => '')); 
	$unique 	= $this->session->userdata('unique');
	$data 		= $this->session->userdata('filter-HroEmployeeAttendanceAdministrationCkp');
?>
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
									echo form_dropdown('location_id', $corelocation, set_value('location_id',$data['location_id']),'id="location_id" class="form-control select2me" ');			

								?> 

								<label class="control-label">Nama Lokasi</label>

							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<select name="employee_shift_id" id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Pilih One--</option>
								</select>
								<label class="control-label">Kode Shift Karyawan<span class="required">*</span></label>
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
									Kode Karyawan
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
								<th width="20%">
									Aksi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								foreach ($hroemployeedata_attendance as $key=>$val){
									echo"
										<tr>			
											<td>".$no."</td>						
											<td>".$val['employee_code']."</td>
											<td>".$val['employee_name']."</td>
											<td>".$val['division_name']."</td>
											<td>".$val['department_name']."</td>
											<td>".$val['section_name']."</td>
											<td>
												<a href='".$this->config->item('base_url').'HroEmployeeAdministrationCkp/editHROEmployeeAdministration/'.$val['employee_id']."' class='btn default btn-xs grey-gallery'>
													<i class='fa fa-edit'></i> Perbaharui Data
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