<?php
$status = array(0 => "Not Fancy", 1 => "Fancy");
?>
<script>
function ulang(){
	document.getElementById("training_job_title_id").value = "<?php echo $result[training_job_title_id]; ?>";
	document.getElementById("training_title_id").value = "<?php echo $result[training_title_id]; ?>";
	document.getElementById("training_provider_id").value = "<?php echo $result[training_provider_id]; ?>";
	document.getElementById("training_provider_item_id").value = "<?php echo $result[training_provider_item_id]; ?>";
	document.getElementById("training_schedule_start_date").value = "<?php echo $result[training_schedule_start_date]; ?>";
	document.getElementById("training_schedule_end_date").value = "<?php echo $result[training_schedule_end_date]; ?>";
	document.getElementById("training_schedule_name").value = "<?php echo $result[training_schedule_name]; ?>";
	document.getElementById("training_schedule_capacity").value = "<?php echo $result[training_schedule_capacity]; ?>";
	document.getElementById("training_schedule_duration").value = "<?php echo $result[training_schedule_duration]; ?>";
	document.getElementById("training_schedule_location").value = "<?php echo $result[training_schedule_location]; ?>";
	document.getElementById("training_schedule_remark").value = "<?php echo $result[training_schedule_remark]; ?>";
}

	function warningname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$/; 
		var letter = /^[a-zA-Z\s]*$/;   
		//var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("training_schedule_name").value = "";
			return false;
		}
	}
	
	function warningcapacity(value){
		if(isNaN(value)===true || value ==''){
			alert('please input only numbers! ');
			document.getElementById('training_schedule_capacity').value	= '';
			$('#training_schedule_capacity').focus();
		}else{
			document.getElementById('training_schedule_capacity').value	= value;
		}
	}
	
	function warningduration(value){
		if(isNaN(value)===true || value ==''){
			alert('please input only numbers! ');
			document.getElementById('training_schedule_duration').value	= '';
			$('#training_schedule_duration').focus();
		}else{
			document.getElementById('training_schedule_duration').value	= value;
		}
	}
	
	function warninglocation(inputname) {
		var letter = /^[a-zA-Z\s]*$/;   
		//var letter = /^[0-9a-zA-Z]+$/; 
		//var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("training_schedule_location").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var training_job_title_id = $("#training_job_title_id").val();
			var training_title_id = $("#training_title_id").val();
			var training_provider_id = $("#training_provider_id").val();
			var training_provider_item_id = $("#training_provider_item_id").val();
			var training_schedule_start_date = $("#training_schedule_start_date").val();
			var training_schedule_end_date = $("#training_schedule_end_date").val();
			var training_schedule_name = $("#training_schedule_name").val();
			var training_schedule_capacity = $("#training_schedule_capacity").val();
			var training_schedule_duration = $("#training_schedule_duration").val();
			var training_schedule_location = $("#training_schedule_location").val();
			
		  	if(training_job_title_id!='' && training_title_id!='' && training_provider_id!='' && training_provider_item_id!='' && training_schedule_start_date!='' && training_schedule_end_date!='' && training_schedule_name!=''
			&& training_schedule_capacity!='' && training_schedule_duration!='' && training_schedule_location!=''){
				return true;
			}else{
				alert('Data of Training Schedule Not Yet Complete');
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
					Form Edit Training Schedule
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionaltrainingschedule" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionaltrainingschedule">
							Training Schedule List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionaltrainingschedule/edit/<?php echo $result['training_schedule_id'];?>">
							Edit Transactional Training Schedule
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
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('transactionaltrainingschedule/processEdittransactionaltrainingschedule',array('id' => 'myform', 'class' => 'form-horizontal')); 
									?>
										<div class="form-group">
											<label class="control-label col-md-3">Training Job Title</label>
											<div class="col-md-3">
												<?php echo form_dropdown('training_job_title_id', $jobtitle ,set_value('training_job_title_id',$result['training_job_title_id']),'id="training_job_title_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3">Training Title</label>
											<div class="col-md-3">
												<?php echo form_dropdown('training_title_id', $title ,set_value('training_title_id',$result['training_title_id']),'id="training_title_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3">Training Provider</label>
											<div class="col-md-3">
												<?php echo form_dropdown('training_provider_id', $provider ,set_value('training_provider_id',$result['training_provider_id']),'id="training_provider_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3">Training Provider Item</label>
											<div class="col-md-3">
												<?php echo form_dropdown('training_provider_item_id', $provideritem ,set_value('training_provider_item_id',$result['training_provider_item_id']),'id="training_provider_item_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3">Start Date</label>
											<div class="col-md-3">
												<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
													<input name="training_schedule_start_date" id="training_schedule_start_date" type="text" class="form-control" value="<?php if (empty($data['training_schedule_start_date'])){
														echo date('d-m-Y');
															}else{
														echo $data['training_schedule_start_date'];
															}?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										
										<div class="form-group">
											<label class="control-label col-md-3">End Date</label>
											<div class="col-md-3">
												<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
													<input name="training_schedule_end_date" id="training_schedule_end_date" type="text" class="form-control" value="<?php if (empty($data['training_schedule_end_date'])){
														echo date('d-m-Y');
															}else{
														echo $data['training_schedule_end_date'];
															}?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
											<script type="text/javascript">
											$(document).ready(function(){
												$("#training_schedule_start_date").change(function(){
													end_date 		= $('#training_schedule_end_date')[0].value;
													end_date_split 	= end_date.split('-');
													endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
													start_date 		= $('#training_schedule_start_date')[0].value;
													start_date_split = start_date.split('-');
													startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
													if (startDate.valueOf() > endDate.valueOf()){
														alert('The Start date can not be greater then the End date');
														$('#training_schedule_start_date').val(end_date);
													} else {
														$('#alert').hide();
														$('#training_schedule_start_date').val(start_date);
													}
												});
											});
											
											$(document).ready(function(){
												$("#training_schedule_end_date").change(function(){
													end_date 		= $('#training_schedule_end_date')[0].value;
													end_date_split 	= end_date.split('-');
													endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
													start_date 		= $('#training_schedule_start_date')[0].value;
													start_date_split = start_date.split('-');
													startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
													if (endDate.valueOf() < startDate.valueOf()){
														alert('The end date can not be less than start date');
														$('#training_schedule_end_date').val(start_date);
													} else {
														$('#alert').hide();
														$('#training_schedule_end_date').val(end_date);
													}
												});
											});
										</script>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label">Training Schedule Name</label>
											<div class="col-md-3">
												<input type="text" name="training_schedule_name" id="training_schedule_name" onChange="warningname(training_schedule_name);" value="<?php echo $result['training_schedule_name'];?>" class="form-control" placeholder="Schedule Name">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label">Training Schedule Capacity</label>
											<div class="col-md-3">
												<input type="text" name="training_schedule_capacity" id="training_schedule_capacity" onChange="warningcapacity(this.value);" value="<?php echo $result['training_schedule_capacity'];?>" class="form-control" placeholder="Schedule Capacity">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label">Training Schedule Duration</label>
											<div class="col-md-3">
												<input type="text" name="training_schedule_duration" id="training_schedule_duration" onChange="warningduration(this.value);" value="<?php echo $result['training_schedule_duration'];?>" class="form-control" placeholder="Schedule Duration">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label">Training Schedule Location</label>
											<div class="col-md-3">
												<input type="text" name="training_schedule_location" id="training_schedule_location" onChange="warninglocation(training_schedule_location);" value="<?php echo $result['training_schedule_location'];?>" class="form-control" placeholder="Schedule Location">
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-3 control-label">Remark</label>
											<div class="col-md-8">
											<textarea rows="5" name="training_schedule_remark" id="training_schedule_remark" class="form-control" placeholder="Strength Remark"><?php echo $result['training_schedule_remark'];?></textarea>
											</div>
										</div>
								</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
									<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
									<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>
<input type="hidden" name="training_schedule_id" value="<?php echo $result['training_schedule_id']; ?>"/>
