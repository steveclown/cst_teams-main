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
</style>
<script>

function show(){
	document.getElementById('period').style.display = "";
}
function hyde(){
	document.getElementById('period').style.display = "none";
}

</script>
<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">
		Pull Data Attendance
		</h3>
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	$sesi	= 	$this->session->userdata('filter-attendance');
	// print_r($sesi);exit;
	if(!is_array($sesi)){
			// $sesi['ip_address']						='';
			// $sesi['port']							='';
			$sesi['machine_id']						='';
			$sesi['start_date']						='';
			$sesi['end_date']						='';
			$sesi['options']						='';
	}
?>
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="portlet blue box">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs"></i>Pull Data Attendance
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
				<?php 
					echo form_open('pulldataattendance/filter', array('id' => 'myform', 'class' => 'form-horizontal'));
				?>
					<!--
					<div class="form-group">
						<label class="control-label col-md-3">IP Address
						</label>
						<div class="col-md-4">
							<input type="text" autocomplete="off"  class="form-control" name="ip_address" id="ip_address"  value="<?php if($sesi[ip_address]=="")echo date('192.168.0.10'); else echo $sesi[ip_address];?>"/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Port
						</label>
						<div class="col-md-4">
							<input type="text" autocomplete="off"  class="form-control" name="port" id="port"  value="<?php if($sesi[port]=="")echo "4370"; else echo $sesi[port];?>"/>
						</div>
					</div>
					-->
					<div class="form-group">
						<label class="control-label col-md-3">Select Machine
						</label>
						<div class="col-md-4">
							<?php 
							if($sesi['machine_id'] != ""){
								echo form_dropdown('machine_id', $machine, $sesi['machine_id'], 'id ="machine_id" class="form-control select2me" disabled');
							}else{
								echo form_dropdown('machine_id', $machine, $sesi['machine_id'], 'id ="machine_id" class="form-control select2me"');
							}
							?>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Options</label>
						<div class="radio-list col-md-4">
							<label class="radio-inline">
							<input type="radio" name="options" id="optionsRadios4" value="today" onchange="hyde()" <?php
							if($sesi[options]=="" || $sesi[options]=="today"){
								echo " checked ";
							}
							if($sesi[options]!="" && $sesi[options]!="today"){
								echo" disabled ";
							}
							?> > Today </label>
							<label class="radio-inline">
							<input type="radio" name="options" id="optionsRadios5" value="thismonth" onchange="hyde()" <?php 
							if($sesi[options]=="thismonth"){
								echo " checked ";
							}
							if($sesi[options]!="" && $sesi[options]!="thismonth"){
								echo" disabled ";
							}
							?> > This Month </label>
							<label class="radio-inline">
							<input type="radio" name="options" id="optionsRadios6" value="period" onchange="show()" <?php
							if($sesi[options]=="period"){
								echo " checked ";
							}
							if($sesi[options]!="" && $sesi[options]!="period"){
								echo" disabled ";
							}
							?> > Period </label>
						</div>
					</div>
					<div id="period" style="<?php if($sesi['options']!="period")echo"display:none;";else echo"";?>">
					<div class="form-group">
						<label class="col-md-3 control-label">Start Date</label>
						<div class="col-md-8">
							<div class='input-group input-medium date date-picker' data-date='<?php if($sesi[start_date]=="")echo date('d-m-Y'); else echo $sesi[start_date];?>' data-date-format='dd-mm-yyyy' data-date-viewmode='years'>
									<input type='text' name='start_date' id='start_date' class='form-control' value='<?php if($sesi[start_date]=="")echo date('d-m-Y'); else echo $sesi[start_date];?>' readonly>
									<span class='input-group-btn'>
										<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
									</span>
							</div>
							<span class='help-block'>
								 Select date
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">End Date</label>
						<div class="col-md-8">
							<div class='input-group input-medium date date-picker' data-date='<?php if($sesi[end_date]=="")echo date('d-m-Y'); else echo $sesi[end_date];?>' data-date-format='dd-mm-yyyy' data-date-viewmode='years'>
									<input type='text' name='end_date' id='end_date' class='form-control' value='<?php if($sesi[end_date]=="")echo date('d-m-Y'); else echo $sesi[end_date];?>' readonly>
									<span class='input-group-btn'>
										<button class='btn default' type='button'><i class='fa fa-calendar'></i></button>
									</span>
							</div>
							<span class='help-block'>
								 Select date
							</span>
						</div>
					</div>
					</div>
					<div class="form-actions right">
						<a href="pulldataattendance/resetfilter" class="btn red"><i class="fa fa-times"></i> Reset</a>
						<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
						<!--<button type="submit" class="btn green"></i><i class="fa fa-plus"></i> Add</button>-->
						<!--<button type="button" class="btn red" onClick="empty();"><i class="fa fa-times"></i> Reset</button>-->
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('pulldataattendance/resultattendance_view');?>