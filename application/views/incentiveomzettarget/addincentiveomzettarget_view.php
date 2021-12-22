<script>
	base_url = '<?= base_url()?>';	

	mappia = "	<?php 
					$site_url = 'incentiveomzettarget/addIncentiveOmzetTarget/';
					echo site_url($site_url); 
				?>";

	function reset_session(){
	 	/*alert('asd');*/
		document.location = base_url+"incentiveomzettarget/reset_session";
	}

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('incentiveomzettarget/function_elements_add');?>",
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
				url : "<?php echo site_url('incentiveomzettarget/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}

	$(document).ready(function(){
        $("#branch_id").change(function(){
            var branch_id = $("#branch_id").val();
            $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>incentiveomzettarget/getCoreLocation",
               data : {branch_id: branch_id},
               success: function(data){
                   $("#location_id").html(data);
               }
            });
        });
    });

	function processAddArrayIncentiveOmzetTarget(){
		
		var branch_id 				= document.getElementById("branch_id").value;
		var location_id 			= document.getElementById("location_id").value;
		var omzet_target_amount 	= document.getElementById("omzet_target_amount").value;
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('incentiveomzettarget/processAddArrayIncentiveOmzetTarget');?>",
			  data: {
					'branch_id' 			: branch_id,
					'location_id' 			: location_id, 
					'omzet_target_amount' 	: omzet_target_amount, 
					'session_name' 			: "addarrayincentiveomzettarget-"
				},
			  success: function(msg){
			   window.location.replace(mappia);
			 }
			});
	}

	function toRp(number) {
		var number = number.toString(), 
		rupiah = number.split('.')[0], 
		cents = (number.split('.')[1] || '') +'00';
		rupiah = rupiah.split('').reverse().join('')
			.replace(/(\d{3}(?!$))/g, '$1,')
			.split('').reverse().join('');
		return rupiah + '.' + cents.slice(0, 2);
	}

	function omzetTargetAmount (value){
		if(isNaN(value)===true || value ==''){
			alert('Please input number! ');
			document.getElementById('omzet_target_amount').value	= '';
			document.getElementById('omzet_target_amount1').value	= '';
		} else if(parseFloat (value)<0){
			document.getElementById('omzet_target_amount').value				= 0;
			document.getElementById('omzet_target_amount1').value				= 0;
		}else{
			document.getElementById('omzet_target_amount').value				= value
			document.getElementById('omzet_target_amount1').value				= toRp(value);
		}
	}	
</script>
<?php 

	$year_now 	=	date('Y');
	if(!is_array($sesi)){
		$sesi['month']			= date('m');
		$sesi['year']			= $year_now;
	}
	
	for($i=($year_now-2); $i<($year_now+2); $i++){
		$year[$i] = $i;
	} 
?>

			


				
							
									<?php 
										$sesi 	= $this->session->userdata('unique');
										$data	= $this->session->userdata('addincentiveomzettarget-'.$sesi['unique']);

										

										if (empty($data) || !is_array($data)){
											$data['month_period']				= date("m");
											$data['year_period']				= date("Y");
										}

										echo $this->session->userdata('message');
										$this->session->unset_userdata('message');
									?>

									<div class = "row">
										<div class = "col-md-4">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('month_period', $monthlist,set_value('month_period',$data['month_period']),'id="month_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Month Name</label>
											</div>	
										</div>
										
										<div class = "col-md-2">
											<div class="form-group form-md-line-input">
												<?php
													echo form_dropdown('year_period', $year, set_value('year_period',$data['year_period']),'id="year_period" class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');
												?>
												<label class="control-label">Year</label>
											</div>	
										</div>
									</div>

									<div class = "row">		
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<?php echo form_dropdown('branch_id', $corebranch ,set_value('branch_id',$data['branch_id']),'id="branch_id", class="form-control select2me"');?>
												<label class="control-label">Branch Name</label>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group form-md-line-input">
												<select name="location_id" id="location_id" class="form-control select2me">
													<option value="">--Choose Item--</option>
												</select>
												<label class="control-label">Location Name<span class="required">*</span></label>
											</div>
										</div>
									</div>

									<div class = "row">
										<div class = "col-md-6">
											<div class="form-group form-md-line-input">
												<input type="text" class="form-control" id="omzet_target_amount1" name="omzet_target_amount1" onChange="omzetTargetAmount(this.value)" value="<?php echo $data['omzet_target_amount1'];?>">


												<input type="hidden" class="form-control" id="omzet_target_amount" name="omzet_target_amount" value="<?php echo $data['omzet_target_amount'];?>">
												<label class="control-label">Omzet Target Amount </label>
											</div>	
										</div>

									</div>

									<div class="row">
										<div class="col-md-12" style='text-align:right'>
											<input type="button" name="add2" id="buttonAddArrayIncentiveOmzetTarget" value="Add" class="btn green-jungle" title="Simpan Data" onClick="processAddArrayIncentiveOmzetTarget();">
										</div>
									</div>
							
						

<?php
	$sesi 						= $this->session->userdata('unique');
	$incentiveomzettargetitem	= $this->session->userdata('addarrayincentiveomzettargetitem-'.$sesi['unique']);

	/*print_r("coreanalysistestresult ");
	print_r($coreanalysistestresult);	
	print_r("<BR>");
	print_r("<BR>");*/
?>

<br>
<br>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			List
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
									<th width="5%">No</th>
									<th width="25%">Branch Name</th>
									<th width="25%">Location Name</th>
									<th width="25%">Omzet Target Amount</th>
									<th width="15%">Action</th>					
								</tr>
							</thead>
							<tbody>
								<?php
									$total_omzet_target = 0;
									$no = 1;
									if(!is_array($incentiveomzettargetitem)){
										echo "<tr><th colspan='5'>Data is empty</th></tr>";
									} else {
										foreach ($incentiveomzettargetitem as $key=>$val){
											echo"
												<tr>
													<td style='text-align  : left !important;'>".$no."</td>
													<td style='text-align  : left !important;'>".$this->incentiveomzettarget_model->getBranchName($val['branch_id'])."</td>
													<td style='text-align  : left !important;'>".$this->incentiveomzettarget_model->getLocationName($val['location_id'])."</td>
													<td style='text-align  : right !important;'>".nominal($val['omzet_target_amount'])."</td>
													<td style='text-align  : center !important;'>
														<a href='".base_url().'incentiveomzettarget/deleteArrayIncentiveOmzetTargetItem/'.$val['location_id']."' onClick='javascript:return confirm(\"Are you sure you want to delete this entry ?\")' class='btn default btn-xs red'>
																	<i class='fa fa-trash-o'></i> Delete
														</a>
													</td>
												</tr>								
											";	
											$total_omzet_target = $total_omzet_target + $val['omzet_target_amount'];
											$no++;													
										}
									}
								?>
								<tr>
									<th colspan='3'>Total</th>
									<th style='text-align  : right !important;'><?php echo nominal($total_omzet_target); ?></th>		
									<th ></th>			
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>