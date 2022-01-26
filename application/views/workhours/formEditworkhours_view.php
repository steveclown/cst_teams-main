<script>
	function ulang(){
		document.getElementById("shift_code").value = "<?php echo $result['shift_code'] ?>";
		document.getElementById("shift_name").value = "<?php echo $result['shift_name'] ?>";
		document.getElementById("start_working_hour").value = "<?php echo $result['start_working_hour'] ?>";
		document.getElementById("end_working_hour").value = "<?php echo $result['end_working_hour'] ?>";
		document.getElementById("start_rest_hour").value = "<?php echo $result['start_rest_hour'] ?>";
		document.getElementById("end_rest_hour").value = "<?php echo $result['end_rest_hour'] ?>";
		document.getElementById("due_time_late").value = "<?php echo $result['due_time_late'] ?>";
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
			Form Edit Working Hour
		<h3>
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
				<a href="<?php echo base_url();?>workhours/edit/<?php echo $result['shieft_id'];?>">
					Edit Working Hour
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
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Edit
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<?php 
						echo form_open('workhours/processupdateworkhours',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$logstat = array('off'=>'off','on'=>'on');
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Shift Code<span class="required">*</span></label>
							
								<input type="text" autocomplete="off"  name="shift_code" id="shift_code" value="<?php echo $result['shift_code'];?>" class="form-control" placeholder="Shift Code">
								<span class="help-block">
									Please input only alpha-numerical characters.
								</span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Shift Name<span class="required">*</span></label>
							
								<input type="text" autocomplete="off"  name="shift_name" id="shift_name" value="<?php echo $result['shift_name'];?>" class="form-control" placeholder="Shift Name">
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Start Working Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="start_working_hour" name="start_working_hour" value="<?php echo $result['start_working_hour'];?>" class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">End Working Hour<span class="required">*</span></label>
								
								<div class="input-group">
									<input type="text" autocomplete="off"  id="end_working_hour" name="end_working_hour" value="<?php echo $result['end_working_hour'];?>" class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Start Rest Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="start_rest_hour" name="start_rest_hour" value="<?php echo $result['start_rest_hour'];?>" class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">End Rest Hour<span class="required">*</span></label>
							
								<div class="input-group">
									<input type="text" autocomplete="off"  id="end_rest_hour" name="end_rest_hour" value="<?php echo $result['end_rest_hour'];?>" class="form-control timepicker timepicker-24">
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Due Time Late<span class="required">*</span></label>
							
								<input type="text" autocomplete="off"  name="due_time_late" id="due_time_late" value="<?php echo $result['due_time_late'];?>" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Due Time Late">
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Working Hour Remark</label>
							
								<textarea rows="3" name="shift_remark" id="shift_remark" class="form-control" placeholder="Remark"><?php echo $result['shift_remark'];?></textarea>
							</div>
						</div>
					<input type="hidden" name="shift_id" value="<?php echo $result['shift_id']; ?>"/>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
