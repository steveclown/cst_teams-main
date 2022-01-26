<script>
	function ulang(){
		document.getElementById("employee_id").value = "<?php echo $result['employee_id'] ?>";
		document.getElementById("employee_code").value = "<?php echo $result['employee_code'] ?>";
		document.getElementById("employee_loan_description").value = "<?php echo $result['employee_loan_description'] ?>";
		document.getElementById("installment_payment_period").value = "<?php echo $result['installment_payment_period'] ?>";
		document.getElementById("installment_payment_total").value = "<?php echo $result['installment_payment_total'] ?>";
		document.getElementById("employee_loan_amount_total").value = "<?php echo $result['employee_loan_amount_total'] ?>";
		document.getElementById("employee_loan_amount").value = "<?php echo $result['employee_loan_amount'] ?>";
	}
</script>
<?php 
echo $this->session->userdata('message');
$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Form Edit Employee Loan
		</h3>
		<ul class="page-breadcrumb breadcrumb">
		<li class="btn-group">
			<div class="actions">
				<a href="<?php echo base_url();?>hroemployeeloan" class="btn green yellow-stripe">
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
			<a href="<?php echo base_url();?>hroemployeeloan">
				Employee Loan List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>hroemployeeloan/edit/<?php echo $result['employee_loan_id'];?>">
				Edit Employee Loan
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
						<i class="fa fa-reorder"></i>Form Add
					</div>
				</div>
				<div class="portlet-body">
					<div class="form-body">
						<?php
							echo form_open('hroemployeeloan/arrayupdateemployeeloanitem',array('id' => 'myform', 'class' => 'form-horizontal')); 
						?>
							<div class="form-group">
								<label class="col-md-3 control-label">Employee Name</label>
								<div class="col-md-8">
									<?php echo form_dropdown('employee_id', $employee ,set_value('employee_id',$result['employee_id']),'id="employee_id", class="form-control select2me"');?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Employee Name</label>
								<div class="col-md-8">
									<?php echo form_dropdown('employee_code', $employee_code ,set_value('edmployee_code',$result['employee_code']),'id="employee_code", class="form-control select2me"');?>
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Loan Description
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="employee_loan_description" id="employee_loan_description" value="<?php echo $result['employee_loan_description'];?>" class="form-control" placeholder="Loan Description">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Installment Payment Period</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="installment_payment_period" id="installment_payment_period" value="<?php echo $result['installment_payment_period'];?>" class="form-control" placeholder="Installment Payment Period">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Installment Payment Total</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="installment_payment_total" id="installment_payment_total" value="<?php echo $result['installment_payment_total'];?>" class="form-control" placeholder="Installment Payment Total">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Loan Amount Total</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="employee_loan_amount_total" id="employee_loan_amount_total" value="<?php echo $result['employee_loan_amount_total'];?>" class="form-control" placeholder="Loan Amount Total">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Loan Amount</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="employee_loan_amount" id="employee_loan_amount" value="<?php echo $result['employee_loan_amount'];?>" class="form-control" placeholder="Loan Amount">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-3 control-label">Period</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="period" id="period" value="<?php echo $result['period'];?>" class="form-control" placeholder="Period">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Installment Payment</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="installment_payment" id="installment_payment" value="<?php echo $result['installment_payment'];?>" class="form-control" placeholder="Installment Payment">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Loan Amount</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="employee_loan_amount" id="employee_loan_amount" value="<?php echo $result['employee_loan_amount'];?>" class="form-control" placeholder="Loan Amount">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Loan Payment</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="employee_loan_payment" id="employee_loan_payment" value="<?php echo $result['employee_loan_payment'];?>" class="form-control" placeholder="Loan Payment">
								</div>
							</div>
							<div class="form-group">
								<label class="col-md-3 control-label">Loan Balance</label>
								<div class="col-md-8">
									<input type="text" autocomplete="off"  name="employee_loan_balance" id="employee_loan_balance" value="<?php echo $result['employee_loan_balance'];?>" class="form-control" placeholder="Loan Balance">
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Payment Date</label>
								<div class="col-md-3">
									<div class="input-group input-medium date date-picker" data-date="<?php echo date("d-m-Y");?>" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
										<input type="text" autocomplete="off"  class="form-control" name="payment_date" id="payment_date" value="<?php echo tgltoview($result['payment_date']);?>" readonly>
											<span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
									</div>
									<!-- /input-group -->
									<span class="help-block">
										 Select date
									</span>
								</div>
							</div>
							
							<input name="created_on" type="hidden"
							value="<?php 
								if (empty($data['created_on'])){
								echo date('Ymdhis');}
								else{
								echo $data['created_on'];}?>" />						
					</div>
					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onclick="reset_all()">
						<button type="submit" class="btn blue">Add</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>