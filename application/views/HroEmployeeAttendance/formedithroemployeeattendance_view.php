<script>
	function ulang(){
		document.getElementById("employee_asset_id").value = "<?php echo $result['employee_asset_id'] ?>";
		document.getElementById("asset_id").value = "<?php echo $result['asset_id'] ?>";
		document.getElementById("sub_asset_id").value = "<?php echo $result['sub_asset_id'] ?>";
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_asset_receipt_date").value = "<?php echo $result['employee_asset_receipt_date'] ?>";
		document.getElementById("employee_asset_return_date").value = "<?php echo $result['employee_asset_return_date'] ?>";
		document.getElementById("employee_asset_remark").value = "<?php echo $result['employee_asset_remark'] ?>";
	}
	
</script>
<script>
function kings(){
	var missingFields = false;
	var strFields = "";

	if(myform.rhh.value>=24)
	{
	missingFields = true;
	strFields += "Receipt Date hours must not exceed 23 hours \n";
	}
	if(isNaN(myform.rhh.value))
	{
	missingFields = true;
	strFields += "Receipt Date hours must contain only numbers \n";
	}
	if(myform.rhh.value=="")
	{
	missingFields = true;
	strFields += "Receipt Date hours must be filled \n";
	}
	
	if(myform.rmm.value>=60)
	{
	missingFields = true;
	strFields += "Receipt Date minutes must not exceed 60 minutes \n";
	}
	if(isNaN(myform.rmm.value))
	{
	missingFields = true;
	strFields += "Receipt Date minutes must contain only numbers \n";
	}
	if(myform.rmm.value=="")
	{
	missingFields = true;
	strFields += "Receipt Date minutes must be filled \n";
	}
	
	if(myform.rss.value>=60)
	{
	missingFields = true;
	strFields += "Receipt Date seconds must not exceed 60 seconds \n";
	}
	if(isNaN(myform.rss.value))
	{
	missingFields = true;
	strFields += "Receipt Date seconds must contain only numbers \n";
	}
	if(myform.rss.value=="")
	{
	missingFields = true;
	strFields += "Receipt Date seconds must be filled \n";
	}

	if(myform.rrhh.value>=24)
	{
	missingFields = true;
	strFields += "Return Date hours must not exceed 23 hours \n";
	}
	if(isNaN(myform.rrhh.value))
	{
	missingFields = true;
	strFields += "Return Date hours must contain only numbers \n";
	}
	if(myform.rrhh.value=="")
	{
	missingFields = true;
	strFields += "Return Date hours must be filled \n";
	}
	
	if(myform.rrmm.value>=60)
	{
	missingFields = true;
	strFields += "Return Date minutes must not exceed 60 minutes \n";
	}
	if(isNaN(myform.rrmm.value))
	{
	missingFields = true;
	strFields += "Return Date minutes must contain only numbers \n";
	}
	if(myform.rrmm.value=="")
	{
	missingFields = true;
	strFields += "Return Date minutes must be filled \n";
	}
	
	if(myform.rrss.value>=60)
	{
	missingFields = true;
	strFields += "Return Date seconds must not exceed 60 seconds \n";
	}
	if(isNaN(myform.rrss.value))
	{
	missingFields = true;
	strFields += "Return Date seconds must contain only numbers \n";
	}
	if(myform.rrss.value=="")
	{
	missingFields = true;
	strFields += "Return Date seconds must be filled \n";
	}
	
	if( missingFields ) {
		alert( "I'm sorry, but you must provide the following field(s) before continuing:\n" + strFields );
		return false;
	}
	return true;
}
</script>
<?php
$arrayreceipt=explode(" ",$result['employee_asset_receipt_date']);
$arrayreturn=explode(" ",$result['employee_asset_return_date']);
?>

			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Edit Employee Asset
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>hroemployeeasset" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>hroemployeeasset">
							Employee Asset List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>hroemployeeasset/edit/<?php $result['employee_asset_id']; ?>">
							Edit Employee Asset
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
										echo form_open('hroemployeeasset/processEditHroEmployeeAsset',array('id' => 'myform', 'class' => 'horizontal-form')); 
										$employee_id =  $this->session->userdata('employee_id');
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="col-md-3 control-label">Employee Name
												<span class="required">
												*
												</span></label>
											
												<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="<?php echo $this->hroemployeeasset_model->getemployeename($employee_id)?>" class="form-control" placeholder="Employee Name" readonly>
												<input type="hidden" name="employee_id" id="employee_id" value="<?php echo $employee_id; ?>" class="form-control" readonly>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Asset Name
												<span class="required">
												*
												</span></label>
											
												<?php echo form_dropdown('asset_id', $asset, $result['asset_id'], 'id ="asset_id", class="form-control select2me"');?>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Sub Asset Name
												<span class="required">
												*
												</span></label>
											
												<?php echo form_dropdown('sub_asset_id', $subasset, $result['sub_asset_id'], 'id ="sub_asset_id", class="form-control select2me"');?>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Receive Date</label>
											
												<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  class="form-control" name="receipt_date" value="<?php echo tgltoview($result['employee_asset_receipt_date']) ;?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Receive Time</label>
												<div class="input-group">
													<input type="text" autocomplete="off"  class="form-control timepicker timepicker-24" name="receipt_time" value="<?php echo $arrayreceipt[1];?>">
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
												<label class="control-label">Return Date</label>
											
												<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
													<input type="text" autocomplete="off"  class="form-control" name="return_date" value="<?php echo tgltoview($result['employee_asset_return_date']);?>" readonly>
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
													</span>
												</div>
											</div>
										</div>
										
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Return Time</label>
												<div class="input-group">
													<input type="text" autocomplete="off"  class="form-control timepicker timepicker-24" name="return_time" value="<?php echo $arrayreturn[1];?>">
													<span class="input-group-btn">
														<button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
													</span>
												</div>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label">Remark</label>
											
												<textarea rows="5" name="employee_asset_remark" id="employee_asset_remark" class="form-control" placeholder="Remark"><?php echo $result['employee_asset_remark'];?></textarea>
											</div>
										</div>
									</div>
										<input type="hidden" name="employee_asset_id" value="<?php echo $result['employee_asset_id']; ?>"/>
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
				
