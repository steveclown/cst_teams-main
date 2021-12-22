<script type="text/javascript">
	function reset_all(){
		document.location= base_url+"hroemployeedocument/reset_search";
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
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
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
	Employee Document List <small>Manage Employee Document</small>
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		
<?php
$data=$this->session->userdata('filter-hroemployeedocument');
if(!is_array($data)){
		$data['employee_id'] 	= '';
	}
?>
<?php echo form_open('hroemployeedocument/filter_hroemployeedocument',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter List
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body">
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
					<div class="form-group">
						<div class="form-action" style="text-align: right !important;">
							<button type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_all();"><i class="fa fa-times"></i>Reset</button>
							<button type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data"><i class="fa fa-search"></i>Find</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					List
				</div>
				
				<div class="actions">
					<a href="<?php echo base_url();?>hroemployeedocument/addHroEmployeeDocument" class="btn btn-default btn-sm">
					<i class="fa fa-plus"></i> Add New Employee Document</a>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No. </th>
							<th width="20%">Employee Name</th>
							<th>Document Book Name</th>
							<th>Employee Document Name</th>
							<th>Document Receipt Date</th>
							<th>Document Status</th>
							<th>Document Returned Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no = 1;
							foreach ($hroemployeedocument as $key=>$val){
								echo"
									<tr>
										<td>$no</td>								
										<td>$val[employee_name]</td>
										<td>$val[document_book_code]</td>
										<td>$val[employee_document_item_name]</td>
										<td>".tgltoview($val['employee_document_receipt_date'])."</td>
										<td>".$this->configuration->EmployeeDocumentStatus[$val['employee_document_status']]."</td>
										<td>".tgltoview($val['employee_document_returned_date'])."</td>
									</tr>
								";
								$no++;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
<?php echo form_close(); ?>	