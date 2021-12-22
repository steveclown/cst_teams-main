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
		document.location = base_url+"HroEmployeeAttendanceTotalReport/reset_search";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceTotalReport/function_elements_add');?>",
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
					url : "<?php echo site_url('HroEmployeeAttendanceTotalReport/getScheduleEmployeeShift');?>",
					data: {location_id: location_id},
					success: function(msg){
					// alert(msg);
					$('#employee_shift_id').html(msg);
				}
				});
		});
	});

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
						<a href="HroEmployeeAttendanceTotalReport">
							Daftar Aset Karyawan
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Daftar Aset Karyawan
			</h1>

<?php 
	echo form_open('HroEmployeeAttendanceTotalReport/filter',array('id' => 'myform', 'class' => '')); 

	$data = $this->session->userdata('filter-HroEmployeeAttendanceTotalReport');
	if(!is_array($data)){
		$data['start_date']				= date('d-m-Y');
		$data['end_date']				= date('d-m-Y');
	}
	if (empty($data['location_id'])) {
		$data['location_id']=9;
		# code...
	}
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
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label"> Tanggal Mulai
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">Tanggal Berakhir
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('location_id', $corelocation, set_value('location_id',$data['location_id']),'id="location_id" class="form-control select2me" ');
								?>
								<label class="control-label">Nama lokasi</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<select name="employee_shift_id" id="employee_shift_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Pilih Satu--</option>
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

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

<?php
	echo form_open('HroEmployeeAttendanceTotalReport/processPrinting'); 
?>
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
								<?php
									if (!empty($scheduleemployeescheduleitem)){
										$array_key 	= array_keys($scheduleemployeescheduleitem[0]);

										$count 		= count($array_key);

										for($i=0; $i<$count; $i++){
											$index_array 	= $array_key[$i];

											$length_index 	= strlen($index_array);

											if ($length_index > 6){
												echo "<th>
													".$index_array."
												</th>";
											}
										}
										echo "
											<th>Total Hari</th>
											<th>Total Libur</th>
											<th>Total Izin SDR</th>
											<th>Total Izin No SDR</th>
											<th>Total Absensi</th>
											<th>Total Meninggalkan</th>
											<th>Total Default</th>
											<th>Total Kosong</th>
											";
									}
								?>
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;

								if (!empty($scheduleemployeescheduleitem)){

									$count_attendance = count($scheduleemployeescheduleitem);

									$array_key = array_keys($scheduleemployeescheduleitem[0]);

									$count = count($array_key);

									//print_r($scheduleemployeescheduleitem);

									for ($j=0; $j<$count_attendance; $j++){
										$total_days 		= 0;
										$total_off 			= 0;
										$total_absence 		= 0;
										$total_permit_with 	= 0;
										$total_permit_no 	= 0;
										$total_leave 		= 0;
										$total_default 		= 0;
										$total_empty 		= 0;

										echo"
											<tr>			
												<td>".$no."</td>";

										for($i=0; $i<$count; $i++){
											$index_array 	= $array_key[$i];

											$length_index 	= strlen($index_array);

											$schedule_employee_item_status = $scheduleemployeescheduleitem[$j][$index_array];

											if ($schedule_employee_item_status == "0"){
												$schedule_employee_item_status_str = "Off";
											} else if ($schedule_employee_item_status == "1"){
												$schedule_employee_item_status_str = "O";
											} else if ($schedule_employee_item_status == "2"){
												$schedule_employee_item_status_str = "M";
											} else if ($schedule_employee_item_status == "3"){
												$schedule_employee_item_status_str = "SDR";
											} else if ($schedule_employee_item_status == "5"){
												$schedule_employee_item_status_str = "I";
											} else if ($schedule_employee_item_status == "4"){
												$schedule_employee_item_status_str = "C";
											} else if ($schedule_employee_item_status == ""){
												$schedule_employee_item_status_str = "X";
											} else if ($schedule_employee_item_status == "9"){
												$schedule_employee_item_status_str = "-";
											} else {
												$schedule_employee_item_status_str = $scheduleemployeescheduleitem[$j][$index_array];
											}

											if ($schedule_employee_item_status == "0"){
												$total_off++;
											}

											if ($schedule_employee_item_status == "1"){
												$total_days++;
											}

											if ($schedule_employee_item_status == "2"){
												$total_absence++;
											}

											if ($schedule_employee_item_status == "3"){
												$total_permit_with++;
											}

											if ($schedule_employee_item_status == "4"){
												$total_leave++;
											}

											if ($schedule_employee_item_status == "5"){
												$total_permit_no++;
											}

											if ($schedule_employee_item_status == "9"){
												$total_default++;
											}

											if ($schedule_employee_item_status == ""){
												$total_empty++;
											}

											if ($length_index > 6){
												echo "	
													<td>".$schedule_employee_item_status_str."</td>
												";
											}
										}

										echo "	
											<td>".$total_days."</td>
											<td>".$total_off."</td>
											<td>".$total_permit_with."</td>
											<td>".$total_permit_no."</td>
											<td>".$total_absence."</td>
											<td>".$total_leave."</td>
											<td>".$total_default."</td>
											<td>".$total_empty."</td>
										";
										echo "</tr>";

										$no++;
									}
								}
								
							?>
						</tbody>
					</table>
					<br>
					<br>
					<div class="row">
						<div class="col-md-12 " style="text-align  : right !important;">
							<a href='javascript:void(window.open("<?php echo base_url(); ?>HroEmployeeAttendanceTotalReport/exportHROEmployeeAttendanceTotalReport","_blank","top=100,left=200,width=300,height=300"));' class="btn green-jungle" title="Export to Excel">
	                            <i class="fa fa-file-excel-o"></i> Export Data
	                       	</a>
							<input type="submit" name="Preview" id="Preview" value="Preview" class="btn blue" title="Preview">
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>