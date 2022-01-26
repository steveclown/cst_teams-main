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

	mappia = "	
		<?php 
			$site_url = 'ScheduleEmployeeShift/editScheduleEmployeeShift/'.$ScheduleEmployeeShift['employee_shift_id'];
			echo site_url($site_url); 
		?>
	";

	function reset_edit(){
		document.location= base_url+"ScheduleEmployeeShift/reset_edit/<?php echo $ScheduleEmployeeShift['employee_shift_id']?>";
	}

	function function_elements_edit(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleEmployeeShift/function_elements_edit');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
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
            var location_id		= $("#location_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>ScheduleEmployeeShift/getHROEmployeeData",
               data : {
               		division_id			: division_id, 
               		department_id		: department_id, 
               		section_id			: section_id, 
               		unit_id				: unit_id,
               		location_id 		: location_id
               	},
               success: function(data){
                   $("#employee_id").html(data);				   
               }
            });
        });
    });

    function processEditArrayScheduleEmployeeShift(){
    	var employee_shift_id			= document.getElementById("employee_shift_id").value;
		var department_id 				= document.getElementById("department_id").value;
		var section_id 					= document.getElementById("section_id").value;
		var unit_id 					= document.getElementById("unit_id").value;
		var employee_id 				= document.getElementById("employee_id").value;
		

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('ScheduleEmployeeShift/processEditArrayScheduleEmployeeShift');?>",
			  data: {
			  		'employee_shift_id'	: employee_shift_id,
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
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleEmployeeShift">Shift Karyawan</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Edit Shift Karyawan
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->		
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Edit
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleEmployeeShift/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('ScheduleEmployeeShift/processEditScheduleEmployeeShift', array('class' => 'horizontal-form')); 
					?>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" autocomplete="off"  name="employee_shift_code" id="employee_shift_code" value="<?php echo $ScheduleEmployeeShift['employee_shift_code']; ?>" class="form-control" readonly>

								<input type="hidden" name="employee_shift_id" id="employee_shift_id" value="<?php echo $ScheduleEmployeeShift['employee_shift_id']; ?>" class="form-control" >
								<label for="form_control">Kode Shift Karyawan </label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									$ScheduleEmployeeShiftstatus = $this->configuration->ScheduleEmployeeShiftStatus(); 
								?>
								<input type="text" autocomplete="off"  name="employee_shift_status" id="employee_shift_status" value="<?php echo $ScheduleEmployeeShiftstatus[$ScheduleEmployeeShift['employee_shift_status']]; ?>" class="form-control" >
								<label for="form_control">Status</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" autocomplete="off"  name="division_name" id="division_name" value="<?php echo $ScheduleEmployeeShift['division_name']; ?>" class="form-control" readonly>

                                <input type="hidden" name="division_id" id="division_id" value="<?php echo $ScheduleEmployeeShift['division_id']; ?>" class="form-control">
								<label for="form_control">Nama Devisi</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <input type="text" autocomplete="off"  name="location_name" id="location_name" value="<?php echo $ScheduleEmployeeShift['location_name']; ?>" class="form-control" readonly>

                                <input type="hidden" name="location_id" id="location_id" value="<?php echo $ScheduleEmployeeShift['location_id']; ?>" class="form-control">
								<label for="form_control">Nama Lokasi </label>
							</div>	
						</div>
					</div>

					<h4 class = "form-section bold">Data Karyawan Data</h4>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									$unique		= $this->session->userdata('unique');
								//	$data 		= $this->session->userdata('addScheduleEmployeeShift-'.$unique['unique']);
									if(empty($ScheduleEmployeeShift['departement_id'])){
										$ScheduleEmployeeShift['departement_id']="";
									}
									if (!empty($ScheduleEmployeeShift['division_id'])){
										$coredepartment		= create_double($this->ScheduleEmployeeShift_model->getCoreDepartment($ScheduleEmployeeShift['division_id']), 'department_id', 'department_name');

										echo form_dropdown('department_id', $coredepartment ,set_value('department_id', $ScheduleEmployeeShift['department_id']),'id="department_id", class="form-control select2me" onChange="function_elements_edit(this.name, this.value);"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);">
										<option value="">--PIlih Item--</option>
									</select>
								<?php
									}
								?>
								<label for="form_control">Nama Departemen
									<span class="required">*</span>
								</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);">
									<option value="">--PIlih Item--</option>
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
                                <select name="unit_id" id="unit_id" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);">
									<option value="">--Pilih Item--</option>
								</select>
								<label for="form_control">Nama Satuan
									<span class="required">*</span>
								</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_edit(this.name, this.value);">
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
							<input type="button" name="add2" id="buttonEditArrayInvtWarehouseTransferRequsition" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processEditArrayScheduleEmployeeShift();">
						</div>
					</div>	

				</div>
			</div>
		</div>
	</div>
</div>

<?php
	$unique 					= $this->session->userdata('unique');
	$ScheduleEmployeeShiftitem	= $this->session->userdata('editarrayScheduleEmployeeShiftitem-'.$unique['unique']);
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
									<th>Status</th> 				
									<th>Aksi</th>	
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
									if (empty($ScheduleEmployeeShiftitem)){

									} else {
										foreach ($ScheduleEmployeeShiftitem as $key=>$val){
											/*if ($val['employee_shift_item_status'] == 1){*/
												echo" 
													<tr>
														<td style='text-align:center'>".$no."</td>
														<td>".$this->ScheduleEmployeeShift_model->getDepartmentName($val['department_id'])."</td>
														<td>".$this->ScheduleEmployeeShift_model->getSectionName($val['section_id'])."</td>
														<td>".$this->ScheduleEmployeeShift_model->getUnitName($val['unit_id'])."</td>
														<td>".$this->ScheduleEmployeeShift_model->getEmployeeName($val['employee_id'])."</td>
														<td>".$val['employee_shift_item_status']."</td>
														<td style='text-align  : center !important;'>
															<a href='".$this->config->item('base_url')."ScheduleEmployeeShift/deleteArrayEditScheduleEmployeeShiftItem/".$val['employee_id']."/".$ScheduleEmployeeShift['employee_shift_id']."' title='Delete Data' onClick=\"javascript:return confirm('Apakah yakin ingin dihapus ?')\" class='btn default btn-xs red'><i class='fa fa-trash-o'></i> Hapus</a>
														</td>
													</tr>
												";

												$no++;
											/*}*/
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
					<button type="reset" name="Reset" class="btn btn-danger" onclick="reset_edit()"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" name="Save" id="save" class="btn green-jungle" title="Save"><i class="fa fa-check"></i> Save</button>	
				</div>
			</div>

			<label></label>	
		</div>
	</div>
</div>

<?php echo form_close(); ?>