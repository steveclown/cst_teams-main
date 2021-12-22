<script>
	base_url = '<?php base_url()?>';
	
</script>
<div class="workplace" style="padding:5px !important;"> 
<?php
	$this->load->view('corededuction/formeditcorededuction_view');		 
?>
<?php 
	echo form_open('corededuction/processEditCoreDeduction'); 
	$sesi 							= $this->session->userdata('unique');
	$data							= $this->session->userdata('corededuction-'.$sesi['unique']);
?>
				
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-reorder"></i>List
		</div>
	</div>
	<div class="portlet-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12">									
					<div class="table-responsive">
						<table class="table table-bordered table-advance table-hover">
							<thead>
								<tr>
									<th>No.</th>
									<th>Allowance Name</th>
									<th>Deduction Allowance Ratio</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no = 1;
								if(!empty($coredeductionallowance)){
									foreach($coredeductionallowance as $key=>$val){
										echo"
											<tr class='odd gradeX'>
												<td style='text-align:center'>$no.</td>
												<td>".$this->corededuction_model->getAllowanceName($val['allowance_id'])."</td>
												<td>".$val['deduction_allowance_ratio']."</td>
												<td style='text-align  : center !important;'>
													<a href='".base_url().'corededuction/deleteEditArrayDeductionAllowance/'.$corededuction['deduction_id'].'/'.$val['allowance_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
														<i class='fa fa-trash-o'></i> Delete
													</a>
												</td>
											</tr>
										";
										$no++;
									}
								}else{
									echo"
										<tr class='odd gradeX'>
											<td colspan='11' style='text-align:center;'>
												<b>No Data</b>
											</td>
										</tr>
									";
								}
							?>		
							<tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="form-actions right">
					<input type="hidden" name="deduction_id2" id="deduction_id2" value="<?php echo $corededuction['deduction_id'];?>" class="form-control">
					<button type="button" class="btn red" onClick="reset_data();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
				</div>
			</div>
		</div>
	</div>
</div>

<?php echo form_close(); ?>

		