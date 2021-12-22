<script>
	base_url = '<?php echo base_url();?>';

	function reset_data(){
		document.location = base_url+"PayrollMonthlyPeriod/reset_data";
	}


    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollMonthlyPeriod/function_elements_add');?>",
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
				url : "<?php echo site_url('PayrollMonthlyPeriod/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	
	$sesi 	= $this->session->userdata('unique');
	$data	= $this->session->userdata('addPayrollMonthlyPeriod-'.$sesi['unique']);

	$year_now 	=	date('Y');
	if(!is_array($data)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
	
?>
			
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>PayrollMonthlyPeriod/addPayrollMonthlyPeriod">
									Tambah Periode Bulanan
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Tambah Periode Bulanan
					</h1>
					<!-- END PAGE TITLE & BREADCRUMB-->


				<div class="row">
					<div class="col-md-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									Form Tambah
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>PayrollMonthlyPeriod" class="btn btn-default btn-sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('PayrollMonthlyPeriod/processAddPayrollMonthlyPeriod',array('id' => 'myform', 'class' => 'horizontal-form')); 
										
										$sesi 	= $this->session->userdata('unique');
										$data	= $this->session->userdata('addPayrollMonthlyPeriod-'.$sesi['unique']);

										
										$data['month_period']				= date("m");
										$data['year_period']				= date("Y");
										$data['monthly_period_start_date'] 	= tgltodb(date("d-m-Y"));
										$data['monthly_period_end_date']	= tgltodb(date("d-m-Y"));
										
										if (empty($data['monthly_period_working_days'])) {
											$data['monthly_period_working_days']="";
										}
										/*print_r("data ");
										print_r($data);*/
									?>
									<div class = "row">
										<div class="col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('month_period', $monthlist,set_value('month_period',$data['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label>Dari Periode</label>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year,set_value('year_period',$data['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label></label>
											</div>
										</div>
									
										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" name="monthly_period_working_days" id="monthly_period_working_days" value="<?php echo $data['monthly_period_working_days']?>" class="form-control"  onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Hari Kerja
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="monthly_period_start_date" id="monthly_period_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['monthly_period_start_date']);?>"/>
												<label class="control-label">Tanggal Mulai Periode Bulanan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="monthly_period_end_date" id="monthly_period_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($data['monthly_period_end_date']);?>"/>
												<label class="control-label">Tanggal Akhir Periode Bulanan
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
								<div class="form-actions right">
									<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Batal</button>
									<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
								</div>
								<?php echo form_close(); ?>
							</div>
						</div>
					</div>
				</div>