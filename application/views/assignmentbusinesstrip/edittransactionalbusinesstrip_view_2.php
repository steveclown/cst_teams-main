<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result[employee_id]; ?>";
		document.getElementById("employee_transfer_id").value = "<?php echo $result[employee_transfer_id]; ?>";
		document.getElementById("business_trip_date").value = "<?php echo $result[business_trip_date]; ?>";
		document.getElementById("business_trip_start_date").value = "<?php echo $result[business_trip_start_date]; ?>";
		document.getElementById("business_trip_end_date").value = "<?php echo $result[business_trip_end_date]; ?>";
		document.getElementById("business_trip_purpose").value = "<?php echo $result[business_trip_purpose]; ?>";
		document.getElementById("business_trip_target").value = "<?php echo $result[business_trip_target]; ?>";
		document.getElementById("business_trip_total_expense").value = "<?php echo $result[business_trip_total_expense]; ?>";
		document.getElementById("business_trip_approved").value = "<?php echo $result[business_trip_approved]; ?>";
		document.getElementById("business_trip_approved_by").value = "<?php echo $result[business_trip_approved_by]; ?>";
		document.getElementById("business_trip_approved_on").value = "<?php echo $result[business_trip_approved_on]; ?>";
		document.getElementById("business_trip_approved_remark").value = "<?php echo $result[business_trip_approved_remark]; ?>";
	}
	
	function set_approved(){
		if($('#'+"business_trip_approved").is(':checked')==false){
			//document.getElementById("account_suspended").readOnly =true;
			$('#business_trip_approved').val("0");		
		} else {
			//document.getElementById(kunci+"_budgetrevenue").readOnly =false;
			//budgetamount1 		= $('#budgetamount1')[0].value;
			$('#business_trip_approved').val("1");
			
		}		
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var employee_id = $("#employee_id").val();
			var employee_transfer_id = $("#employee_transfer_id").val();
			var business_trip_date = $("#business_trip_date").val();
			var business_trip_start_date = $("#business_trip_start_date").val();
			var business_trip_end_date = $("#business_trip_end_date").val();
			var business_trip_purpose = $("#business_trip_purpose").val();
			var business_trip_target = $("#business_trip_target").val();
			var business_trip_total_expense = $("#business_trip_total_expense").val();
			var business_trip_approved = $("#business_trip_approved").val();
			var business_trip_approved_on = $("#business_trip_approved_on").val();
			var business_trip_approved_by = $("#business_trip_approved_by").val();
			
		  	if(employee_id!='' && business_trip_date!='' && business_trip_start_date!='' && business_trip_end_date!='' && business_trip_purpose!='' && business_trip_target!=''
			&& business_trip_total_expense!='' && business_trip_approved!='' && business_trip_approved_on!='' && business_trip_approved_by != ''){
				return true;
			}
		});
    });
</script>
<?php 
	echo form_open('transactionalbusinesstrip/processedittransactionalbusinesstrip',array('id' => 'myform', 'class' => 'form-horizontal')); 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Edit Letter of Business Trip
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionalbusinesstrip" class="btn green yellow-stripe">
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
				<a href="<?php echo base_url();?>transactionalbusinesstrip">
					Letter of Business Trip List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionalbusinesstrip/edit">
					Edit Transactional Letter of Business Trip
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
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="form-group">
							<label class="control-label col-md-3">Employee</label>
							<div class="col-md-3">
								<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Business Trip Date</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
									<input name="business_trip_date" id="business_trip_date" type="text" class="form-control" value="<?php if (empty($result['business_trip_date'])){
										echo date('d-m-Y');
									}else{
										echo tgltoview($result['business_trip_date']);
									}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Start Date</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
									<input name="business_trip_start_date" id="business_trip_start_date" type="text" class="form-control" value="<?php if (empty($result['business_trip_start_date'])){
										echo date('d-m-Y');
									}else{
										echo tgltoview($result['business_trip_start_date']);
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
									<input name="business_trip_end_date" id="business_trip_end_date" type="text" class="form-control" value="<?php if (empty($result['business_trip_end_date'])){
										echo date('d-m-Y');
									}else{
										echo tgltoview($result['business_trip_end_date']);
									}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
							<script type="text/javascript">
								$(document).ready(function(){
									$("#business_trip_start_date").change(function(){
										end_date 		= $('#business_trip_end_date')[0].value;
										end_date_split 	= end_date.split('-');
										endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
										start_date 		= $('#business_trip_start_date')[0].value;
										start_date_split = start_date.split('-');
										startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
										if (startDate.valueOf() > endDate.valueOf()){
											alert('The start date can not be greater then the end date');
											$('#business_trip_start_date').val(end_date);
										} else {
											$('#alert').hide();
											$('#business_trip_start_date').val(start_date);
										}
									});
								});
											
								$(document).ready(function(){
									$("#business_trip_end_date").change(function(){
										end_date 		= $('#business_trip_end_date')[0].value;
										end_date_split 	= end_date.split('-');
										endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
										start_date 		= $('#business_trip_start_date')[0].value;
										start_date_split = start_date.split('-');
										startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
										if (endDate.valueOf() < startDate.valueOf()){
											alert('The end date can not be less than start date');
											$('#business_trip_end_date').val(start_date);
										} else {
											$('#alert').hide();
											$('#business_trip_end_date').val(end_date);
										}
									});
								});
							</script>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Purpose</label>
							<div class="col-md-8">
								<textarea rows="5" name="business_trip_purpose" id="business_trip_purpose" class="form-control" placeholder="Business Trip Purpose"><?php echo $result['business_trip_purpose'];?></textarea>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Target</label>
							<div class="col-md-8">
								<textarea rows="5" name="business_trip_target" id="business_trip_target" class="form-control" placeholder="Business Trip Target"><?php echo $result['business_trip_target'];?></textarea>
							</div>
						</div>
										
						<div class="form-group">
							<label class="col-md-3 control-label">Total Expense</label>
							<div class="col-md-3">
								<input type="text" name="business_trip_total_expense" id="business_trip_total_expense" value="<?php echo $result['business_trip_total_expense'];?>" class="form-control" placeholder="Total Expense">
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Approved</label>
							<div class="col-md-3">
								<?php echo form_checkbox('business_trip_approved', $approved ,set_value('business_trip_approved',$result['business_trip_approved']),'id="business_trip_approved", OnClick="set_approved()"'); ?> Approved
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Approved By</label>
							<div class="col-md-3">
								<input type="text" name="business_trip_approved_by" id="business_trip_approved_by" value="<?php echo $result['business_trip_approved_by'];?>" class="form-control" placeholder="Approved By">
							</div>
						</div>
						
						<div class="form-group">
							<label class="control-label col-md-3">Approved On</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
									<input name="business_trip_approved_on" id="business_trip_approved_on" type="text" class="form-control" value="<?php if (empty($result['business_trip_approved_on'])){
										echo date('d-m-Y');
									}else{
										echo tgltoview($result['business_trip_approved_on']);
									}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
																
						<div class="form-group">
							<label class="col-md-3 control-label">Remark</label>
							<div class="col-md-8">
								<textarea rows="5" name="business_trip_approved_remark" id="business_trip_approved_remark" class="form-control" placeholder="Remark"><?php echo $result['business_trip_approved_remark'];?></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
					<button type="submit" name="Save" id="Save" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
			</div>
		</div>
	</div>
</div>
<input type="hidden" name="business_trip_id" value="<?php echo $result['business_trip_id']; ?>"/>
<?php echo form_close(); ?>