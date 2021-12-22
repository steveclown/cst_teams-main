<!-- BEGIN PAGE TITLE & BREADCRUMB-->
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<a href="<?php echo base_url();?>">Beranda</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?php echo base_url();?>ScheduleShiftPattern">Pola Shift</a>
			<i class="fa fa-angle-right"></i>
		</li>
	</ul>
</div>


<h1 class="page-title">
	Form Detail Pola Shift
</h1>
<!-- END PAGE TITLE & BREADCRUMB-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					Detail
				</div>
				<div class="actions">
					<a href="<?php echo base_url();?>ScheduleShiftPattern/" class="btn btn-default btn-sm">
					<i class="fa fa-angle-left"></i> Kembali</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('scheduleshiftpattern/processEditScheduleShiftPattern',array('class' => 'horizontal-form')); 
						$unique 	= $this->session->userdata('unique');
						$data 		= $this->session->userdata('editscheduleshiftpattern-'.$unique['unique']);
						$scheduleshiftpattern_item	= $this->session->userdata('editarrayscheduleshiftpatternitem-'.$unique['unique']);
						$data_item	= $this->session->userdata($data['created_on']);
				
					?>
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
                               <input type="text" name="shift_pattern_code" id="shift_pattern_code" value="<?php echo $ScheduleShiftPattern['shift_pattern_code']; ?>" class="form-control" onChange="function_elements_add(this.name, this.value);" readonly>
								<label for="form_control">Kode Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_pattern_name" id="shift_pattern_name" class="form-control" value="<?php echo $ScheduleShiftPattern['shift_pattern_name']; ?>" onChange="function_elements_add(this.name, this.value);" readonly>
								<label for="form_control">Nama Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_pattern_weekly" id="shift_pattern_weekly" class="form-control" value="<?php echo $ScheduleShiftPattern['shift_pattern_weekly']; ?>" onChange="function_elements_add(this.name, this.value);" readonly>
								<label for="form_control">Pola Shift Mingguan
									<span class="required">*</span>
								</label>
							</div>	
						</div>
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="shift_pattern_cycle" id="shift_pattern_cycle" class="form-control" value="<?php echo $ScheduleShiftPattern['shift_pattern_cycle']; ?>" onChange="function_elements_add(this.name, this.value);" readonly>
								<label for="form_control">Siklus Pola Shift
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								
								<input type="text" name="shift_pattern_day" id="shift_pattern_day" class="form-control" value="<?php echo $shiftpatternday[$ScheduleShiftPattern['shift_pattern_day']]; ?>" onChange="function_elements_add(this.name, this.value);" readonly>
								<label for="form_control">Pola Shift Hari
									<span class="required">*</span>
								</label>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			Daftar
		</div>
	</div>
	<div class="portlet-body ">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th width="5%" >No</th>
									<th>Shift</th>
									<th>Kode Shift karyawan</th> 				
								</tr>
							</thead>
							<tbody>
								<?php
									$no = 1;
										foreach ($ScheduleShiftPatternitem as $key=>$val){
											echo"
												<tr>
													<td style='text-align:center'>".$no."</td>
													<td>".$val['shift_name']."</td>
													<td>".$val['employee_shift_code']."</td>
												</tr>
											";
											$no++;
										}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<label></label>	
		</div>
	</div>
</div>