<script>
	base_url = '<?php echo base_url(); ?>';	
	function ulang(){
		document.location= base_url+"main/reset_filtersalaryhistory";
	}	
	
	function openform4(){
		var a = document.getElementById("pasword1").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<?php
	echo //form_open("main/filtersalaryhistory", array('class' => 'horizontal-form'));
	$sesi = $this->session->userdata('filter-salaryhistory');
	if(!is_array($sesi)){
		$sesi['start_date']		='';
		$sesi['end_date']		='';
		$sesi['grade_id']		='';
		$sesi['class_id']		= '';
	}
?>
<?php echo form_open('main/filtersalaryhistory',array('id' => 'myform', 'class' => 'horizontal-form')); ?>
<button class="btn btn-success" type="button" id='btn-change' onClick="openform4()">Advanced Search</button>
<div class="form-body" style="display:none;" id='pasword1'>
	<h3 class="form-section">Salay History</h3>					
	<!--<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Leave Period</label>
				<input type="text" name="employee_leave_period" id="employee_leave_period" value="<?php echo $data['employee_leave_period'];?>" class="form-control">
			</div>
		</div>
	</div>-->
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Date</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="start_date" id="start_date" type="text" class="form-control" value="<?php if (empty($sesi['start_date'])){
						echo date('d-m-Y');
					}else{
						echo tgltoview($sesi['start_date']);
					}?>" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Date</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="end_date" id="end_date" type="text" class="form-control" value="<?php if (empty($sesi['end_date'])){
						echo date('d-m-Y');
					}else{
						echo tgltoview($sesi['end_date']);
					}?>" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#start_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be greater then the End date');
						$('#start_date').val(end_date);
					} else {
						$('#alert').hide();
						$('#start_date').val(start_date);
					}
				});
			});
			$(document).ready(function(){
				$("#end_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be less than End date');
						$('#end_date').val(start_date);
					} else {
						$('#alert').hide();
						$('#end_date').val(end_date);
					}
				});
			});
		</script>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Grade</label>
				<?php echo form_dropdown('grade_id', $grade,set_value('grade_id',$data['grade_id']),'id="grade_id", class="form-control select2me"');?>
			</div>
		</div>		
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Class</label>
				<?php echo form_dropdown('class_id', $class,set_value('class_id',$data['class_id']),'id="class_id", class="form-control select2me"');?>
			</div>
		</div>
	</div>
	
	<div class="row">
		<!--<div class="form-group">
			<div class="col-md-offset-9 col-md-12">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</div>-->
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>
<?php echo form_close(); ?>