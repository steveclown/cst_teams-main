<script>
	function ulang(){
		document.getElementById("training_schedule_id").value = "";
		document.getElementById("training_selection_period").value = "";
		document.getElementById("employee_id").value = "";
		document.getElementById("training_selection_date").value = "";
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var training_schedule_id = $("#training_schedule_id").val();
			var training_selection_period = $("#training_selection_period").val();
			var employee_id = $("#employee_id").val();
			//alert(employee_id);
			var training_selection_date = $("#training_selection_date").val();
			
		  	if(training_schedule_id!='' && training_selection_period!='' && training_selection_date!=''){
				return true;
			}else{
				alert('Data of Training Candidate Selection Not Yet Complete');
				return false;
			}
		});
    });
</script>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Add Transactional Training Candidate Selection
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionaltrainingselection" class="btn green yellow-stripe">
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
				<a href="<?php echo base_url();?>transactionaltrainingselection">
					Training Candidate Selection List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionaltrainingselection/add">
					Add Transactional Training Candidate Selection
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
					<i class="fa fa-reorder"></i>Form Add
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<?php 
						echo form_open('transactionaltrainingselection/processaddtransactionaltrainingselection',array('id' => 'myform', 'class' => 'form-horizontal')); 
						$data = $this->session->userdata('addtransactionaltrainingsselection');
					?>
						<div class="form-group">
							<label class="control-label col-md-3">Training Schedule</label>
							<div class="col-md-3">
								<?php echo form_dropdown('training_schedule_id', $schedule ,set_value('training_schedule_id',$data['training_schedule_id']),'id="training_schedule_id", class="form-control select2me"');?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Selection Period</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="yyyy-mm">
									<input name="training_selection_period" id="training_selection_period" type="text" class="form-control" value="<?php if (empty($data['training_selection_period'])){
									echo date('Y-m');
										}else{
									echo $data['training_selection_period'];
										}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
								
						<div class="form-group">
							<label class="control-label col-md-3">Employee Name</label>
							<div class="col-md-3">
								<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$data['employee_id']),'id="employee_id", class="form-control select2me"');?>
							</div>
						</div>									
						
						<div class="form-group">
							<label class="control-label col-md-3">Selection Date</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
									<input name="training_selection_date" id="training_selection_date" type="text" class="form-control" value="<?php if (empty($data['training_selection_date'])){
									echo date('d-m-Y');
										}else{
									echo $data['training_selection_date'];
										}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
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


