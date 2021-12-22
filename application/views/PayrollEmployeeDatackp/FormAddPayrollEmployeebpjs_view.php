<script>
	function reset_add_bpjs(){
		document.location = base_url+"PayrollEmployeeDatackp/reset_add_bpjs";
	}

	function function_elements_add_bpjs(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('PayrollEmployeeDatackp/function_elements_add_bpjs');?>",
				data : {'name' : name, 'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function() 
   	{
     	$('#modaloutbpjs').on('show.bs.modal', function (e) 
        {

          var employee_bpjs_id = $(e.relatedTarget).data('id');
                                                                                             
          document.getElementById('employee_bpjs_id_out').value = employee_bpjs_id;
        });
   	});
</script>

					

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
	// print_r($data);exit;
?>		

<!-- <?php 
	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i = $year_now; $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>	 -->


<?php 
	echo form_open('PayrollEmployeeDatackp/processAddPayrollEmployeeBPJS',array('id' => 'myform', 'class' => 'horizontal-form'));

	$unique 				= $this->session->userdata('unique');
	$data 					= $this->session->userdata('addpayrollemployeebpjs-'.$unique['unique']);

	if (empty($data['bpjs_in_date'])){
		$data['bpjs_in_date'] 						= date("Y-m-d");
	}

	if(empty($data['bpjs_reported_salary'])){
		$data['bpjs_reported_salary']				= 0;
	}

	if(empty($data['bpjs_total_amount'])){
		$data['bpjs_total_amount']					= 0;
	}

	if(empty($data['bpjs_kesehatan_status'])){
		$data['bpjs_kesehatan_status']				= 0;
	}

	if(empty($data['bpjs_kesehatan_no'])){
		$data['bpjs_kesehatan_no']					= '';
	}

	if(empty($data['bpjs_kesehatan_percentage'])){
		$data['bpjs_kesehatan_percentage']			= 0;
	}

	if(empty($data['bpjs_kesehatan_amount'])){
		$data['bpjs_kesehatan_amount']				= 0;
	}

	if(empty($data['bpjs_tenagakerja_status'])){
		$data['bpjs_tenagakerja_status']			= 0;
	}

	if(empty($data['bpjs_tenagakerja_no'])){
		$data['bpjs_tenagakerja_no']				= '';
	}

	if(empty($data['bpjs_tenagakerja_percentage'])){
		$data['bpjs_tenagakerja_percentage']		= 0;
	}

	if(empty($data['bpjs_tenagakerja_amount'])){
		$data['bpjs_tenagakerja_amount']			= 0;
	}

	if(empty($data['bpjs_remark'])){
		$data['bpjs_remark']						= '';
	}
?>		
<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="bpjs_in_date" id="bpjs_in_date" onChange="function_elements_add_bpjs(this.name, this.value);" value="<?php echo tgltoview($data['bpjs_in_date']);?>">
			<label class="control-label">Tanggal Masuk BPJS
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
			<input type="text" name="bpjs_reported_salary" id="bpjs_reported_salary" value="<?php echo $data['bpjs_reported_salary'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Gaji yang Dilaporkan
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_total_amount" id="bpjs_total_amount" value="<?php echo $data['bpjs_total_amount'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">BPJS Total Jumlah
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
			<?php echo form_dropdown('bpjs_kesehatan_status', $bpjsstatus ,set_value('bpjs_kesehatan_status',$data['bpjs_kesehatan_status']),'id="bpjs_kesehatan_status", class="form-control select2me" onChange="function_elements_add_bpjs(this.name, this.value);"');?>
			<label class="control-label">Status BPJS Kesehatan 
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_kesehatan_no" id="bpjs_kesehatan_no" value="<?php echo $data['bpjs_kesehatan_no'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">No. BPJS Kesehatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_kesehatan_percentage" id="bpjs_kesehatan_percentage" value="<?php echo $data['bpjs_kesehatan_percentage'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">Prosentase BPJS Kesehatan</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_kesehatan_amount" id="bpjs_kesehatan_amount" value="<?php echo $data['bpjs_kesehatan_amount'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);" >
			<label class="control-label">Jumlah BPJS Kesehatan</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<?php echo form_dropdown('bpjs_tenagakerja_status', $bpjsstatus ,set_value('bpjs_tenagakerja_status',$data['bpjs_tenagakerja_status']),'id="bpjs_tenagakerja_status", class="form-control select2me" onChange="function_elements_add_bpjs(this.name, this.value);"');?>
			<label class="control-label">Status BPJS Tenaga Kerja 
				<span class="required">
					*
				</span>
			</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerja_no" id="bpjs_tenagakerja_no" value="<?php echo $data['bpjs_tenagakerja_no'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">No. BPJS Tenaga Kerja </label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerjan_percentage" id="bpjs_tenagakerja_percentage" value="<?php echo $data['bpjs_tenagakerja_percentage'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);">
			<label class="control-label">Prosentase BPJS Tenaga Kerja</label>
		</div>
	</div>

	<div class = "col-md-6">
		<div class="form-group form-md-line-input">
			<input type="text" name="bpjs_tenagakerja_amount" id="bpjs_tenagakerja_amount" value="<?php echo $data['bpjs_tenagakerja_amount'];?>" class="form-control" onChange="function_elements_add_bpjs(this.name, this.value);" >
			<label class="control-label">Jumlah BPJS Tenaga Kerja</label>
		</div>
	</div>
</div>

<div class = "row">
	<div class = "col-md-12">
		<div class="form-group form-md-line-input">
			<textarea rows="3" name="bpjs_remark" id="bpjs_remark" class="form-control"><?php echo $data['bpjs_remark'];?></textarea>
			<label class="control-label">Keterangan</label>
		</div>
	</div>
</div>
				
<div class="form-actions right">
	<button type="reset" class="btn red" onClick="reset_add_bpjs();"><i class="fa fa-times"></i> Batal</button>
	<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
</div>
<input type="hidden" name="employee_id" value="<?php echo $hroemployeedata['employee_id'] ?>">
<?php echo form_close(); ?>
			
<BR>
<BR>

<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th width="10%">Tanggal Masuk</th>
						<th width="15%">Gaji yang Dilaporkan</th>
						<th width="15%">BPJS Total</th>
						<th width="15%">Jumlah BPJS Kesehatan</th>
						<th width="15%">Jumlah BPJS Tenaga Kerja</th>
						<th width="10%">Status Keluar</th>
						<th width="10%">Tanggal Keluar</th>
						<th width="10%">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($payrollemployeebpjs)){
						echo "<tr><th colspan='8' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($payrollemployeebpjs as $key=>$val){
							echo"
								<tr>
									<td>".tgltoview($val['bpjs_in_date'])."</td>
									<td>".nominal($val['bpjs_reported_salary'])."</td>
									<td>".nominal($val['bpjs_total_amount'])."</td>
									<td>".nominal($val['bpjs_kesehatan_amount'])."</td>
									<td>".nominal($val['bpjs_tenagakerja_amount'])."</td>
									<td>".$bpjsstatus[$val['bpjs_out_status']]."</td>
									<td>".tgltoview($val['bpjs_out_date'])."</td>
									<td>
										<a href='".$this->config->item('base_url').'PayrollEmployeeDatackp/deletePayrollEmployeeBPJS/'.$val['employee_id']."/".$val['employee_bpjs_id']."' onClick='javascript:return confirm(\"Apakah Anda yakin akan menghapus data ini ?\")' class='btn default btn-xs red'>
											<i class='fa fa-trash-o'></i> Hapus
										</a>

										<a href='#modaloutbpjs' class='btn default btn-xs green' data-toggle='modal' data-id='".$val['employee_bpjs_id']."'><i class='fa fa-delete'></i> BPSJ Keluar</a>
									</td>";
									echo"
								</tr>
								
							";
						}
					}
				?>	
				</tbody>
			</table>
		</div>
	</div>
</div>

<?php echo form_open('PayrollEmployeeDatackp/processOutPayrollEmployeeBPJS',array('id' => 'myform', 'class' => 'horizontal-form'));
?>
<script>
	$(document).ready(function(){
        $("#save").click(function(){
			var bpjs_out_status_remark = $("#bpjs_out_status_remark").val();
						
		  	if(bpjs_out_status_remark != '' && bpjs_out_status_remark != ''){
				return true;
			}else{
				alert('Data Not Complete');
				return false;
			}
		});
    });
</script>
	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="modaloutbpjs" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Out BPJS</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Remark</label>
							<div class="input-icon right">
								<i class="fa"></i>
								<?php 
									echo form_textarea(array('rows'=>'3','name'=>'bpjs_out_status_remark','class'=>'form-control','id'=>'bpjs_out_status_remark'))?>
							</div>	
						</div>	
					</div>
					

					<input type="hidden" class="form-control" name="employee_bpjs_id_out" id="employee_bpjs_id_out"  value=""/>

					<input type="hidden" class="form-control" name="employee_id" id="employee_id"  value="<?php echo $hroemployeedata['employee_id']; ?>"/>
					
					<div class="modal-footer">
						<button type="button" class="btn red" data-dismiss="modal">Close</button>
						<button type="submit" id="save" class="btn green"><i class="fa fa-check"></i> Save</button>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
	</div>
	<!-- /.modal -->
<?php
echo form_close(); 
?>