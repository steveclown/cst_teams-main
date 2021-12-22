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

	img {
		border-radius: 10%;	
	}
	

</style>
<script>
	base_url = '<?php echo base_url();?>';

    function reset_filter(){
		document.location = base_url+"HroEmployeeAttendanceReportAndroid/reset_search";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeAttendanceReportAndroid/function_elements_add');?>",
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
					url : "<?php echo site_url('HroEmployeeAttendanceReportAndroid/getScheduleEmployeeShift');?>",
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
							Home
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="HroEmployeeAttendanceReportAndroid">
							Employee Attendance Report
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
				</ul>
			</div>	
			<!-- END PAGE TITLE & BREADCRUMB-->
			<h1 class="page-title">
				Employee Attendance Report
			</h1>

<?php 
	echo form_open('HroEmployeeAttendanceReportAndroid/filter',array('id' => 'myform', 'class' => '')); 
	$auth = $this->session->userdata('auth');
	$data = $this->session->userdata('filter-HroEmployeeAttendanceReportAndroid');
	
	if(!is_array($data)){
		$data['start_date']				= date('d-m-Y');
		$data['end_date']				= date('d-m-Y');
		$data['location_id']			= '';
		$data['employee_shift_id']		= "";
	}
	if (empty($data['location_id'])) {
		$data['location_id']="";
		# code...
	}

?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label">Tanggal 
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<!-- <div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">Tanggal Berakhir
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div> -->
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('location_id', $corelocation, set_value('location_id',$data['location_id']),'id="location_id" class="form-control select2me" ');
								?>
								<label class="control-label"> Nama Lokasi</label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								 <select name="employee_shift_id" id="employee_shift_id"  class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Pilih Satu--</option>
								</select> 
								
								<label class="control-label">Kode Shift Karyawan <span class="required">*</span></label>
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
	echo form_open('HroEmployeeAttendanceReportAndroid/processPrinting'); 
?>
<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Daftar tanggal <?php echo tgltoview($data['start_date']);?>
					</div>
				</div>
				<div class="portlet-body">
					<table style="height: 100% width:100%" class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Karyawan</th>
								<th>Kode Karyawan</th>								
								<th>Photo IN</th>
								<th>Waktu Masuk</th>
								<th>Lokasi Absen IN</th>
								<th>Photo Out</th>
								<th>Waktu Keluar</th>
								<th>Lokasi Absen OUT</th>							
							</tr>
						</thead>
						<tbody>
							<?php
								$no=1;
								$ShiftNextDay			= $this->configuration->ShiftNextDay();

								foreach ($scheduleemployeescheduleitem as $key=>$val){									
									if($val['time_in'] != null){
										$date_in = $val['time_in'];
										$time_in = date("H:i:s", strtotime($date_in));
										//echo $time_in;										
									}else{
										$time_in = "-";
									}
									if($val['time_out'] != null){
										$date_out = $val['time_out'];
										$time_out = date("H:i:s", strtotime($date_out));
									}else{
										$time_out = "-";
									}
									//print_r($time_in->format("h:i:s"));	
								
									if(!empty($val['photo_in'])){						        	
										// $photo_in ="<img src='data:image/jpg;base64,". base64_encode($val['photo_in'])."' border-radius='20' alt='photo' width='61' height='100'/>";
										$photo_in 	= "<img src=\"".$base_url."img/absensi_photo/".$val['photo_in']."\" border-radius='20' alt='photo' width='61' height='100'/>";
									}else{
										$photo_in 	= "";
									}
									if(!empty($val['photo_out'])){						        	
										$photo_out 	= "<img src=\"".$base_url."img/absensi_photo/".$val['photo_out']."\" border-radius='20' alt='photo' width='61' height='100'/>";
										// $photo_out ="<img src='data:image/jpg;base64,". base64_encode($val['photo_out'])."' border-radius='20' alt='photo' width='61' height='100'/>";
									}else{
										$photo_out = "";
									}

									$BatasMasuk  = $val['time_in_end'];
									// $BatasKeluar = new DateTime($val['time_out_date']);
									
									$start = strtotime(date("H:i:s", strtotime($BatasMasuk)));
									$end   = strtotime(date("H:i:s", strtotime($val['time_in'])));

									$diff  = $end - $start;

									$hours = floor($diff / (60 * 60));

									$minutes = $diff - $hours * (60 * 60);
									
									echo"
										<tr>	
											<td>".$no."</td>
											<td>".$val['employee_name']."</td>
											<td>".$val['employee_code']."</td>
											<td>".$photo_in."</td>
											<td>".$time_in."</td>
											<td>".$val['employee_schedule_item_address_in']."</td>
											<td>".$photo_out."</td>
											<td>".$time_out."</td>
											<td>".$val['employee_schedule_item_address_out']."</td>											
											
										</tr>
									";
								
									$no++;
							} ?>
						</tbody>
					</table>							
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>
