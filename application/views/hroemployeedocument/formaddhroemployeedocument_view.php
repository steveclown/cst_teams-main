<script>
	base_url 	= '<?php echo base_url();?>';
	mappia 		= "<?php echo site_url('hroemployeedocument/addHroEmployeeDocument'); ?>";

	function reset_all(){
		document.location= base_url+"hroemployeedocument/resetitem";
	}

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
	
	function function_state_add(value){
		// alert(value);
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('hroemployeedocument/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id = $("#division_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeedocument/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id = $("#department_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeedocument/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
        	var division_id = $("#division_id").val();
        	var department_id = $("#department_id").val();
            var section_id = $("#section_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>hroemployeedocument/getHroEmployeeData",
               data : {division_id: division_id, department_id: department_id, section_id: section_id},
               success: function(data){
                   $("#employee_id").html(data);				   
               }
            });
        });
    });

    function processAddArrayHroEmployeeDocument(){
		var employee_document_item_name 	= document.getElementById("employee_document_item_name").value;

			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('hroemployeedocument/processAddArrayHroEmployeeDocument');?>",
			  data: { 
					'employee_document_item_name'	: employee_document_item_name, 
					'created_on'					: created_on,	
					'session_name' 					: "addarrayhroemployeedocumentitem-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}
</script>

<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>hroemployeedocument">Employee Document</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Form Add Employee Document
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->		

<?php
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Form Add
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeedocument/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Back</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php echo form_open_multipart('hroemployeedocument/processAddHroEmployeeDocument',array('class' => 'horizontal-form',  'role' => 'form'));
					?>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <?php
                                	echo form_dropdown('document_book_id', $coredocumentbook ,set_value('document_book_id', $data['document_book_id']),'id="document_book_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Document Book Code
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="employee_document_receipt_date" id="employee_document_receipt_date" onChange="function_elements_add(this.name, this.value);" value="<?php if (empty($data['sales_order_date'])){
													echo date('d-m-Y');
												}else{
													echo tgltoview($data['employee_document_receipt_date']);
												}?>">
								<label for="form_control">Employee Document Receipt Date
									<span class="required">*</span>
								</label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                                <?php
                                	echo form_dropdown('division_id', $coredivision ,set_value('division_id', $data['division_id']),'id="division_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Division Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									if (!empty($data['department_id'])){
										$coredepartment = create_double($this->hroemployeedocument_model->getCoreDepartment($data['division_id']),'department_id','department_name');
										echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']),'id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
								<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<?php } ?>
								<label for="form_control">Department Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									if (!empty($data['section_id'])){
										$coresection = create_double($this->hroemployeedocument_model->getCoreSection($data['department_id']),'section_id','section_name');
										echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']),'id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
                                <select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<?php } ?>
								<label for="form_control">Section Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php 
									if (!empty($data['employee_id'])){
										$employee = create_double($this->hroemployeedocument_model->getHroEmployeeData($data['division_id'], $data['department_id'], $data['section_id']),'employee_id','employee_name');
										echo form_dropdown('employee_id', $employee, set_value('employee_id', $data['employee_id']),'id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
                                <select name="employee_id" id="employee_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
									<option value="">--Choose One--</option>
								</select>
								<?php } ?>
								<label for="form_control">Employee Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
	                           <input type="text" name="employee_document_item_name" id="employee_document_item_name" value="<?php echo $data['employee_document_item_name']; ?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
								<label for="form_control">Employee Document Book Name
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						
						<!-- <div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
                                	echo form_dropdown('emoloyee_document_status', $employeedocumentstatus ,set_value('emoloyee_document_status', $data['emoloyee_document_status']),'id="emoloyee_document_status", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
                                ?>
								<label for="form_control">Employee Document Status
									<span class="required">*</span>
								</label>
							</div>	
						</div> -->
					</div>

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<!--<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
										<img src="<?php //echo base_url().'assets/img/200X150_no_image.png'?>" alt=""/>
									</div>-->
									<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 150px; max-width: 200px; max-height: 150px;">
										<img src="<?php echo base_url().'assets/img/200X150_no_image.png'?>" alt=""/>
									</div>
									<div>
										<span class="btn default btn-file">
											<span class="fileinput-new">
												 Select image
											</span>
											<span class="fileinput-exists">
												 Change
											</span>
											<input type="file" name="item_picture">
										</span>
										<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
											 Remove
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>



				
				<div class="form-actions right">
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
