<div class="workplace" style="padding:5px !important;"> 
<?php 
	$this->load->view('main/formfilterasset_view'); 
?>
<div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeasset">
					<thead>
					<tr>
						<th>
							Asset Name
						</th>
						<th>
							Sub Asset Name
						</th>
						<th>
							Receipt Date
						</th>
						<th>
							Return Date
						</th>
					</tr>
					</thead>   
					<tbody>
						<?php 
						// if(empty($hroemployeeasset)){
							// echo "	<tr class='odd gradeX'>
										// <td colspan='4' style='text-align:center;'>No Data Available</td>
									// </tr>
							// ";						
						// }else{
							foreach ($hroemployeeasset as $key=>$val){
								$rec = explode(" ",$val[employee_asset_receipt_date]);
								$ret = explode(" ",$val[employee_asset_return_date]);
								echo "
										<tr class='odd gradeX'>
									<td>".$this->main_model->getAssetName($val[asset_id])."</td>
									<td>".$this->main_model->getSubAssetName($val[sub_asset_id])."</td>
									<td style='text-align:right'>".tgltoview($rec[0])." ".$rec[1]."</td>
									<td style='text-align:right'>".tgltoview($ret[0])." ".$ret[1]."</td>
										</tr>
								";
							}
						// }
						?>
					</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
<?php echo form_close(); ?>