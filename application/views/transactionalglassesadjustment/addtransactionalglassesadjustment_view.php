<?php
$status = array(0=>"Fancy", 1=>"Not Fancy");
?>
<script>
function ulang(){
	document.getElementById("employee_id").value = "";
	document.getElementById("glasses_coverage_id").value = "";
	document.getElementById("glasses_adjustment_date").value = "";
	document.getElementById("glasses_adjustment_opening_balance").value = "";
	document.getElementById("glasses_adjustment_amount").value = "";
	document.getElementById("glasses_adjustment_last_balance").value = "";
	document.getElementById("glasses_adjustment_remark").value = "";
}

function toRp(number) {
	var number = number.toString(), 
	rupiah = number.split('.')[0], 
	cents = (number.split('.')[1] || '') +'00';
	rupiah = rupiah.split('').reverse().join('')
		.replace(/(\d{3}(?!$))/g, '$1,')
		.split('').reverse().join('');
	// return rupiah + '.' + cents.slice(0, 2);
	return rupiah;
}

function check(value) {
	var glasses_coverage_amount = <?php echo $data[glasses_coverage_amount]?>;
	if(value<glasses_coverage_amount){
		alert("Value must not less than previous amount");
		document.getElementById("glasses_adjustment_amount_view").value = toRp(glasses_coverage_amount);
		document.getElementById("glasses_adjustment_amount").value = glasses_coverage_amount;
	}else{
		document.getElementById("glasses_adjustment_amount_view").value = toRp(value);
		document.getElementById("glasses_adjustment_amount").value = value;
	}
}
</script>
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<h3 class="page-title">
					Form Add Transactional Glasses Adjustment
					</h3>
					<ul class="page-breadcrumb breadcrumb">
					<li class="btn-group">
						<div class="actions">
							<a href="<?php echo base_url();?>transactionalglassesadjustment" class="btn green yellow-stripe">
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
						<a href="<?php echo base_url();?>transactionalglassesadjustment">
							Glasses Adjustment List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo base_url();?>transactionalglassesadjustment/listglassescoverage">
							Glasses Coverage List
						</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">
							Add Transactional Glasses Adjustment
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
						echo form_open('transactionalglassesadjustment/processAddtransactionalglassesadjustment',array('id' => 'myform', 'class' => 'form-horizontal'));
						// $data = $this->session->userdata('Addtransactionalglassesadjustment');
					?>
					<!--<div class="form-group">
						<label class="control-label col-md-3">Employee Name<span class="required">*</span></label>
						<div class="col-md-8">
							<?php echo form_dropdown('employee_id', $employee, $data['employee_id'], 'id ="employee_id", class="form-control select2me"');?>
						</div>
					</div>-->
					<div class="form-group">
						<label class="control-label col-md-3">Employee Name
						<span class="required">
						*
						</span></label>
						<div class="col-md-8">
							<input type="text" name="employee_name" id="employee_name" value="<?php echo $employee;?>" class="form-control" placeholder="Employee Name" readonly>
						</div>
						<input type="hidden" name="employee_id" value="<?php echo $this->session->userdata("employee_id"); ?>"/>
					</div>
					<!--<div class="form-group">
						<label class="control-label col-md-3">Glasses Coverage Name<span class="required">*</span></label>
						<div class="col-md-8">
							<?php echo form_dropdown('glasses_coverage_id', $glassescoverage, $data['glasses_coverage_id'], 'id ="glasses_coverage_id", class="form-control select2me"');?>
						</div>
					</div>		
					-->
					<div class="form-group">
						<label class="control-label col-md-3">Adjustment Date</label>
						<div class="col-md-3">
							<div class="input-group input-medium date date-picker" data-date="<?php date("d-m-Y")?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
								<input type="text" class="form-control" name="glasses_adjustment_date" value="<?php if($data[glasses_adjustment_date]=="")echo date('d-m-Y'); else echo tgltoview($data['glasses_adjustment_date']);?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Amount</label>
						<div class="col-md-8">
							<input type="text" name="glasses_adjustment_amount_view" id="glasses_adjustment_amount_view" value="<?php echo nominal($data['glasses_coverage_amount']);?>" class="form-control" placeholder="Amount" onchange="check(this.value)">
							<input type="hidden" name="glasses_adjustment_amount" id="glasses_adjustment_amount" value="<?php echo $data['glasses_coverage_amount'];?>" class="form-control" placeholder="Amount">
							<span class="help-block">
								Please input only numbers.
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Remark</label>
						<div class="col-md-8">
							<textarea rows="5" name="glasses_adjustment_remark" id="glasses_adjustment_remark" class="form-control" placeholder="Remark"><?php echo $data['glasses_adjustment_remark'];?></textarea>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<!-- <button type="submit" class="btn blue" onclick="return kings();"><i class="fa fa-check"></i> Save</button> -->
					<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				<input type="hidden" name="employee_glasses_coverage_id" value="<?php echo $data[employee_glasses_coverage_id];?>">
				<input type="hidden" name="glasses_coverage_amount" value="<?php echo $data[glasses_coverage_amount];?>">
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>