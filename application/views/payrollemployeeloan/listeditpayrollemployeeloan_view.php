<div class="workplace" style="padding:5px !important;">
<?php
		$this->load->view('hroemployeeloan/edithroemployeeloan_view');	 
?>
<?php 
	echo form_open('hroemployeeloan/processupdateemployeeloan'); 
	$sesi 		= $this->session->userdata('unique');
	$data		= $this->session->userdata('provider-'.$sesi['unique']);
	$loan	= $this->session->userdata($data['created_on']);
	// print_r($journal); exit;
?>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-bordered table-advance table-hover" style="margin-top:-15px !important;">
				<thead>
					<tr>
						<th>Period</th>
						<th>Payment Date</th>
						<th>Installment Payment</th>
						<th>Loan Amount</th>
						<th>Loan Payment</th>
						<th>Loan Balance</th>						
					</tr>
				</thead>
				<tbody>
				<?php
					if(!is_array($loan_item)){
						echo "<tr><th colspan='7' style='text-align  : center !important;'>Data is Empty</th></tr>";
					} else {
						foreach ($loan_item as $key=>$val){
							//$DefaultValue = $this->journal_model->getDefaultValue($val[account_id]);
							echo"
								<tr>
									<td>".$this->trainingprovider_model->gettitlename($val[training_title_id])."</td>
									<td>".$val[training_provider_item_name]."</td>
									<td style='text-align:right'>".nominal($val[training_provider_item_cost])."</td>
									<td>".$val[training_provider_item_duration]."</td>
									<td>".$val[training_provider_item_remark]."</td>
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
<div class="col-md-12 " style="text-align  : right !important;">
	<input type="hidden" class="form-control" name="createdon" id="createdon" value="<?php echo $data['created_on'];?>">
	<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
	<button type="submit" class="btn blue"><i class="fa fa-check"></i> Save</button>
</div>
</div>