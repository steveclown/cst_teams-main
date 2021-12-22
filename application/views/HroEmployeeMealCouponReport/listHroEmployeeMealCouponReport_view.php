<style>

	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}

	.flexigrid div.pDiv input {
		vertical-align:middle !important;
	}
	
	.flexigrid div.pDiv div.pDiv2 {
		margin-bottom: 10px !important;
	}
</style>
<script>

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('HroEmployeeMealCouponReport/function_elements_add');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
						// alert(name);
			}
		});
	}

	$(document).ready(function(){
        $("#division_id").change(function(){
            var division_id 	= $("#division_id").val();

            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeMealCouponReport/getCoreDepartment",
               data : {division_id: division_id},
               success: function(data){
                   $("#department_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#department_id").change(function(){
            var department_id 	= $("#department_id").val();

            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeMealCouponReport/getCoreSection",
               data : {department_id: department_id},
               success: function(data){
                   $("#section_id").html(data);				   
               }
            });
        });
    });

    $(document).ready(function(){
        $("#section_id").change(function(){
            var section_id 	= $("#section_id").val();

            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>HroEmployeeMealCouponReport/getCoreUnit",
               data : {section_id: section_id},
               success: function(data){
                   $("#unit_id").html(data);				   
               }
            });
        });
    });
</script>

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	$data=$this->session->userdata('filter-HroEmployeeMealCouponReport');
	if(!is_array($data)){
		$data['start_date'] 	= date("Y-m-d");
		$data['end_date'] 		= date("Y-m-d");
		$data['location_id'] 	= '';			
		$data['division_id'] 	= '';			
		$data['department_id'] 	= '';			
		$data['section_id'] 	= '';			
		$data['unit_id'] 		= '';			
	}
?>
<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>HroEmployeeMealCouponReport">Laporan Kupon Makanan Pegawai</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>

<h1 class="page-title">
	Laporan Kupon Makanan Pegawai
</h1>

<!-- END PAGE TITLE & BREADCRUMB-->		
<?php echo form_open('HroEmployeeMealCouponReport/filter',array('id' => 'myform', 'class' => '')); ?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Filter 
				</div>
				<div class="tools">
					<a href="javascript:;" class='expand'></a>
				</div>
			</div>
			<div class="portlet-body display-hide">
				<div class="form-body form">
					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="start_date" id="start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['start_date']);?>"/>
								<label class="control-label">Tanggal Mulai 
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group form-md-line-input">
								<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="end_date" id="end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['end_date']);?>"/>
								<label class="control-label">Tanggal Berakhir
									<span class="required">
										*
									</span>
								</label>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('location_id', $corelocation, set_value('location_id', $data['location_id']),'id="location_id" class="form-control select2me"');
								?>
								<label>Nama lokasi</label>
							</div>
						</div>

						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<?php
									echo form_dropdown('division_id', $coredivision, set_value('division_id', $data['division_id']),'id="division_id" class="form-control select2me"');
								?>
								<label>Nama Divisi </label>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group">
								<label class="control-label">nama departemen</label>
								<?php 
									if (!empty($data['division_id'])){
										$coredepartment = create_double($this->HroEmployeeMealCouponReport_model->getCoreDepartment($data['division_id']), 'department_id', 'department_name');

										echo form_dropdown('department_id', $coredepartment, set_value('department_id', $data['department_id']), 'id="department_id" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="department_id" id="department_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Pilih Satu--</option>
									</select>
								<?php 
									} 
								?>
							</div>
						</div>

						<div class = "col-md-6">
							<div class="form-group">
								<label class="control-label">nama bagian</label>
								<?php 
									if (!empty($data['department_id'])){
										$coresection = create_double($this->HroEmployeeMealCouponReport_model->getCoreSection($data['department_id']), 'section_id', 'section_name');

										echo form_dropdown('section_id', $coresection, set_value('section_id', $data['section_id']), 'id="section_id" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="section_id" id="section_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Pilih Satu--</option>
									</select>
								<?php 
									} 
								?>
							</div>
						</div>
					</div>

					<div class = "row">
						<div class = "col-md-6">
							<div class="form-group">
								<label class="control-label">Nama Satuan</label>
								<?php 
									if (!empty($data['section_id'])){
										$coreunit = create_double($this->HroEmployeeMealCouponReport_model->getCoreUnit($data['section_id']), 'unit_id', 'unit_name');

										echo form_dropdown('unit_id', $coreunit, set_value('unit_id', $data['unit_id']), 'id="unit_id" onChange="function_elements_add(this.name, this.value);"');
									} else {
								?>
									<select name="unit_id" id="unit_id" class="form-control select2me" onChange="function_elements_add(this.name, this.value);">
										<option value="">--Pilih Satu--</option>
									</select>
								<?php 
									} 
								?>
							</div>
						</div>
					</div>

					<div class="form-actions right">
						<input type="reset" name="Reset" value="Reset" class="btn btn-danger" onClick="reset_filter();">
						<input type="submit" name="Find" value="Find" class="btn green-jungle" title="Search Data">

						<a href='javascript:void(window.open("<?php echo base_url(); ?>HroEmployeeMealCouponReport/exportHROEmployeeMealCouponReport","_blank","top=100,left=200,width=300,height=300"));' class="btn blue" title="Export to Excel">
                            <i class="fa fa-file-excel-o"></i> Export Data
                       	</a>
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
			</div>
			<div class="portlet-body">
				<?php
					echo form_open('payrollemployeemonthlyreport/previewreport'); 
				?>
				<table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama lokasi</th>
							<th>Kode Karyawan</th>
							<th>nama karyawan</th>
							<th>nama departemen</th>
							<th>nama Satuan</th>
							<th>Kupon Makan Total</th>
							<th> Kupon Makan Penggunaan </th>
							<th>Kupon Makan Tunjangan</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=1;
							
							foreach ($hroemployeemealcoupon as $key=>$val){
								$employee_meal_coupon_subvention = $val['total_meal_coupon'] * $mealcouponsubvention['employee_meal_coupon_subvention'];

								$employee_meal_coupon_company_subvention = $val['total_meal_coupon'] * $mealcouponsubvention['employee_meal_coupon_company_subvention'];
								echo"
									<tr>	
										<td>".$no."</td>
										<td>".$val['location_name']."</td>	
										<td>".$val['employee_code']."</td>
										<td>".$val['employee_name']."</td>		
										<td>".$val['department_name']."</td>
										<td>".$val['unit_name']."</td>
										<td>".$val['total_meal_coupon']."</td>	
										<td>".nominal($employee_meal_coupon_subvention)."</td>
										<td>".nominal($employee_meal_coupon_company_subvention)."</td>
									</tr>
								";
								$no++;
						} ?>
					</tbody>
				</table>
				<!-- <div class="row">
					<div class="col-md-12 " style="text-align  : right !important;">
						<input type="submit" name="Preview" id="Preview" value="Preview" class="btn blue" title="Preview">
					</div>
				</div> -->
			</div>
		</div>
		<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>