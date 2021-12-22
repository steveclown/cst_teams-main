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
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('ScheduleEmployeeShift/addScheduleEmployeeShift'); ?>";

	function reset_all(){
		document.location= base_url+"ScheduleEmployeeShift/resetitem";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleEmployeeShift/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleEmployeeShift/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>ScheduleEmployeeShift/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>ScheduleEmployeeShift/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
            var section_id = $("#section_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>ScheduleEmployeeShift/getCoreUnit",
               data : {section_id: section_id},
               success: function(data){
                   $("#unit_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#unit_id").change(function(){
        	var division_id 	= $("#division_id").val();
        	var department_id 	= $("#department_id").val();
            var section_id 		= $("#section_id").val();
            var unit_id 		= $("#unit_id").val();
            var location_id 	= $("#location_id").val();

            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>ScheduleEmployeeShift/getHROEmployeeData",
               data : {
               			division_id		: division_id, 
               			department_id	: department_id, 
               			section_id		: section_id, 
               			unit_id			: unit_id,
               			location_id		: location_id},
               success: function(data){
                   $("#employee_id").html(data);				   
               }
            });
        });
    });

    function processAddArrayScheduleEmployeeShift(){
		var department_id 				= document.getElementById("department_id").value;
		var section_id 					= document.getElementById("section_id").value;
		var unit_id 					= document.getElementById("unit_id").value;
		var employee_id 				= document.getElementById("employee_id").value;
		

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('ScheduleEmployeeShift/processAddArrayScheduleEmployeeShift');?>",
			  data: {
					'department_id' 	: department_id,
					'section_id' 		: section_id, 
					'employee_id' 		: employee_id, 
					'unit_id' 			: unit_id,
					'session_name' 		: "addarrayScheduleEmployeeShiftitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
</script>

<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda </a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeShift">Shift Karyawan </a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeShift/addScheduleEmployeeShift">Tambah Shift Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Tambah Shift Karyawan
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
					Form Tambah
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleEmployeeShift/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('ScheduleEmployeeShift/processAddScheduleEmployeeShift',array('class' => 'horizontal-form')); 

						$auth 		= $this->session->userdata('auth');
						$unique 	= $this->session->userdata('unique');
						$data 		= $this->session->userdata('addScheduleEmployeeShift-'.$unique['unique']);

						$ScheduleEmployeeShift_item	= $this->session->userdata('addarrayScheduleEmployeeShiftitem-'.$unique['unique']);

						if(empty($data['employee_shift_code'])){
							$data['employee_shift_code'] = '';
						}
						if(empty($data['division_id'])){
							$data['division_id'] = '';
						}
						if(empty($data['departemen_id'])){
							$data['departemen_id'] = '';
						}
						if(empty($data['location_id'])){
							$data['location_id'] = '20';
						}
						//$payroll_employee_level = $auth['payroll_employee_level'];
						//if ($payroll_employee_level == 9){


					?>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<?php
										echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']), 'id="location_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									?>

									<label for="form_control">Nama Lokasi
										<span class="required">*</span>
									</label>
								</div>
							</div>
						</div>
					<?php 
					//	}
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input tyep="text" name="employee_shift_code" id="employee_shift_code" class="form-control" onChange="function_elements_add(this.name, this.value);" value="<?php echo $data['employee_shift_code']; ?>">
								<label for="form_control">Kode Shift Karyawan
									<span class="required">*</span>
								</label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <?php
                                	echo form_dropdown('division_id', $coredivision ,set_value('division_id', $data['division_id']),'id="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Nama Devisi
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>
					<input name="created_on" type="hidden" id="created_on"
							value="<?php 
								if (empty($data['created_on'])){
								echo date('Y-m-d- H:i:s');}
								else{
								echo $data['created_on'];}?>" />

					<h4 class = "form-section bold">Data Karyawan</h4>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									if (!empty($data['division_id'])){
										$coredepartment		= create_double($this->ScheduleEmployeeShift_model->getCoreDepartment($data['division_id']), 'department_id', 'department_name');

										echo form_dropdown('department_id', $coredepartment ,set_value('department_id', $data['department_id']),'id="department_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Pilih Item--</option>
									</select>
								<?php
									}
								?>
								<label for="form_control"> Nama Departemen
									<span class="required">*</span>
								</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Pilih Item--</option>
								</select>
								<label for="form_control">Nama Bagian 
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <select name="unit_id" id="unit_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Pilih Item--</option>
								</select>
								<label for="form_control">Nama Satuan
									<span class="required">*</span>
								</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Pilih Item--</option>
								</select>
								<label for="form_control">Nama Karyawan
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12" style='text-align:right'>
							<input type="button" name="add2" id="buttonAddArrayInvtWarehouseTransferRequsition" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayScheduleEmployeeShift();">
						</div>
					</div>	
				</div>
					
			</div>
		</div>
	</div>
</div>
<?php 
	
?>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List
		</div>
	</div>
	<div class="portlet-body ">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th >No</th>
									<th>Nama Departemen</th>
									<th>Nama Bagian</th>
									<th>Nama Satuan</th>
									<th>Nama Karyawan</th> 
									<th>Aksi</th>					
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if(!is_array($ScheduleEmployeeShift_item)){
										echo "<tr><th colspan='6'>Tidak Ada Data</th></tr>";
									}else{
										foreach ($ScheduleEmployeeShift_item as $key=>$val){
											echo"
												<tr>
													<td style='text-align:center'>$no.</td>
													<td>".$this->ScheduleEmployeeShift_model->getDepartmentName($val['department_id'])."</td>
													<td>".$this->ScheduleEmployeeShift_model->getSectionName($val['section_id'])."</td>
													<td>".$this->ScheduleEmployeeShift_model->getUnitName($val['unit_id'])."</td>
													<td>".$this->ScheduleEmployeeShift_model->getEmployeeName($val['employee_id'])."</td>
													<td style='text-align  : center !important;'>
														
														<a href='".$this->config->item('base_url')."ScheduleEmployeeShift/deleteArrayScheduleEmployeeShiftItem/".$val['employee_id']."' title='Delete Data' onClick=\"javascript:return confirm('Apakah yakin ingin dihapus ?')\" class='btn default btn-xs red'><i class='fa fa-trash-o'></i> Hapus</a>
													</td>
												</tr>
											";
											$no++;
										}
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 " style="text-align  : right !important;">
					<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_all()"><i class="fa fa-times"></i> Batal</button>
				<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Simpan</button>	
				</div>
			</div>

			<label></label>	
		</div>
	</div>
</div>
<?php echo form_close(); ?>