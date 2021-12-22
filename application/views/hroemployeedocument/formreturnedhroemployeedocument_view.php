<script type="text/javascript">
	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedocument/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}
</script>
<div class = "page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">
				Home
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>hroemployeeaward">
				Employee Award List
			</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>
<h1 class="page-title">
	Form Employee Document Returned - <?php echo $hroemployeedocument['employee_name'];?> -
</h1>
<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	
?>
<?php echo form_open('hroemployeedocument/processReturnHroEmployeeDocument',array('class' => 'horizontal-form'));
					?>
<!-- END PAGE TITLE & BREADCRUMB-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Employee Data
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeedocument/returnedHroEmployeeDocument" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body ">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="hidden" name="employee_document_id" id="employee_document_id" value="<?php echo $hroemployeedocument['employee_document_id']?>" class="form-control" readonly>
								<input type="text" name="employee_name" id="employee_name" value="<?php echo $hroemployeedocument['employee_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Name</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="document_book_code" id="document_book_code" value="<?php echo $hroemployeedocument['document_book_code']?>" class="form-control" readonly>
								<label class="control-label">Document Book Code</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="employee_document_item_name" id="employee_document_item_name" value="<?php echo $hroemployeedocumentitem['employee_document_item_name']?>" class="form-control" readonly>
								<label class="control-label">Employee Document Name </label>
							</div>	
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_document_returned_date" id="employee_document_returned_date" onChange="function_elements_add(this.name, this.value);" value="<?php if (empty($data['employee_document_returned_date'])){
													echo date('d-m-Y');
												}else{
													echo tgltoview($data['employee_document_returned_date']);
												}?>">
								<label for="form_control">Employee Document Returned Date
									<span class="required">*</span>
								</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions right">
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>