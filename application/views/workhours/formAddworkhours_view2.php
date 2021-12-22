<script>
	function ulang(){
		document.getElementById("shift_code").value = "";
		document.getElementById("shift_name").value = "";
		document.getElementById("start_working_hour").value = "";
		document.getElementById("end_working_hour").value = "";
		document.getElementById("start_rest_hour").value = "";
		document.getElementById("end_rest_hour").value = "";
		document.getElementById("due_time_late").value = "";
	}
	 
	function checkTime(start_working_hour)
  {
    var errorMsg = "";

    // regular expression to match required time format
    re = /^(\d{1,2}):(\d{2})(:00)?([ap]m)?$/;

    if(start_working_hour.value != '') {
      if(regs = start_working_hour.value.match(re)) {
        if(regs[4]) {
          // 12-hour time format with am/pm
          if(regs[1] < 1 || regs[1] > 12) {
            errorMsg = "Invalid value for hours: " + regs[1];
          }
        } else {
          // 24-hour time format
          if(regs[1] > 23) {
            errorMsg = "Invalid value for hours: " + regs[1];
          }
        }
        if(!errorMsg && regs[2] > 59) {
          errorMsg = "Invalid value for minutes: " + regs[2];
        }
      } else {
        errorMsg = "Invalid time format: " + start_working_hour.value;
      }
    }

    if(errorMsg != "") {
      alert(errorMsg);
      start_working_hour.focus();
      return false;
    }

    return true;
  }
  
  function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 
            && (charCode < 48 || charCode > 57))
            return false;

        return true;
  }
  
  $(document).ready(function(){
        $("#save").click(function(){
			var shift_code = $("#shift_code").val();
			var shift_name = $("#shift_name").val();
			var start_working_hour = $("#start_working_hour").val();
			var end_working_hour = $("#end_working_hour").val();
			var start_rest_hour = $("#start_rest_hour").val();
			var end_rest_hour = $("#end_rest_hour").val();
			 var due_time_late = $("#due_time_late").val();
		  	if(shift_code!='' && shift_name!='' && start_working_hour!='' && end_working_hour!='' && start_rest_hour!='' && end_rest_hour!='' && due_time_late!=''){
				return true;
			}else{
				alert('Data of Working Hour Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });
</script>
<div class="row">
	<div class="col-md-12">
	<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Add Working Hour
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>workhours" class="btn green yellow-stripe">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							 Back
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
				<a href="<?php echo base_url();?>workhours">
					Working Hour List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Add Working Hour
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
	echo form_open('workhours/processaddworkhours',array('id' => 'myform'));
	$data = $this->session->userdata('addworkhours');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Add
				</div>				
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<div class="row">
						<div class="form-group">
							<label class="col-md-3 control-label">Shift Code<span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" name="shift_code" id="shift_code" value="<?php echo $data['shift_code'];?>" class="form-control" placeholder="Shift Code">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-3 control-label">Shift Name<span class="required">*</span></label>
							<div class="col-md-6">
								<input type="text" name="shift_name" id="shift_name" value="<?php echo $data['shift_name'];?>" class="form-control" placeholder="Shift Name">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Add
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
				<div class="row">
					<div class="form-group">
						<label class="col-md-3 control-label">Shift Code<span class="required">*</span></label>
						<div class="col-md-8">
							<input type="text" name="shift_code" id="shift_code" value="<?php echo $data['shift_code'];?>" class="form-control" placeholder="Shift Code">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Shift Name<span class="required">*</span></label>
						<div class="col-md-8">
							<input type="text" name="shift_name" id="shift_name" value="<?php echo $data['shift_name'];?>" class="form-control" placeholder="Shift Name">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Start Working Hour<span class="required">*</span></label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" id="start_working_hour" name="start_working_hour" value="<?php echo $data['start_working_hour'];?>" class="form-control timepicker timepicker-24">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">End Working Hour<span class="required">*</span></label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" id="end_working_hour" name="end_working_hour" value="<?php echo $data['end_working_hour'];?>" class="form-control timepicker timepicker-24">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">Start Rest Hour<span class="required">*</span></label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" id="start_rest_hour" name="start_rest_hour" value="<?php echo $data['start_rest_hour'];?>" class="form-control timepicker timepicker-24">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-3">End Rest Hour<span class="required">*</span></label>
						<div class="col-md-5">
							<div class="input-group">
								<input type="text" id="end_rest_hour" name="end_rest_hour" value="<?php echo $data['end_rest_hour'];?>" class="form-control timepicker timepicker-24">
								<span class="input-group-btn">
									<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
								</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Due Time Late<span class="required">*</span></label>
						<div class="col-md-8">
							<input type="text" name="due_time_late" id="due_time_late" value="<?php echo $data['due_time_late'];?>" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Due Time Late">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Remark</label>
						<div class="col-md-8">
							<textarea rows="5" name="shift_remark" id="shift_remark" class="form-control" placeholder="Remark"><?php echo $data['shift_remark'];?></textarea>
						</div>
					</div>
				</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				
			</div>
		</div>
	</div>
</div>-->
<?php echo form_close(); ?>