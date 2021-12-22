<script>
	function ulang(){
		document.getElementById("training_schedule_id").value = "<?php echo $result[training_schedule_id]; ?>";
		document.getElementById("employee_id").value = "<?php echo $result[employee_id]; ?>";
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var training_schedule_id = $("#training_schedule_id").val();
			var employee_id = $("#employee_id").val();
			
		  	if(training_schedule_id!='' && employee_id!='' ){
				return true;
			}else{
				alert('Data of Training Registration Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Edit Training Registration
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionaltrainingregistration" class="btn green yellow-stripe">
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
				<a href="<?php echo base_url();?>transactionaltrainingregistration">
					Training Registration List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionaltrainingregistration/edit">
					Edit Transactional Training Registration
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
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
						echo form_open('transactionaltrainingregistration/processedittransactionaltrainingregistration',array('id' => 'myform', 'class' => 'form-horizontal')); 
					?>
						<div class="form-group">
							<label class="control-label col-md-3">Training Schedule</label>
							<div class="col-md-3">
								<?php echo form_dropdown('training_schedule_id', $schedule ,set_value('training_schedule_id',$result['training_schedule_id']),'id="training_schedule_id", class="form-control select2me"');?>
							</div>
						</div>
								
						<div class="form-group">
							<label class="control-label col-md-3">Employee Name</label>
							<div class="col-md-3">
								<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
							</div>
						</div>									
					
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
					<button type="submit" name="Save" id="Save" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="training_registration_id" value="<?php echo $result['training_registration_id']; ?>"/>
