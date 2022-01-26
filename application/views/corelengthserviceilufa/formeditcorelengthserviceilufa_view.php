<script>
	function ulang(){
		document.getElementById("length_service_id").value = "<?php echo $corelengthservice['length_service_id'] ?>";
		document.getElementById("length_service_code").value = "<?php echo $corelengthservice['length_service_code'] ?>";
		document.getElementById("length_service_name").value = "<?php echo $corelengthservice['length_service_name'] ?>";
		document.getElementById("length_service_range1").value = "<?php echo $corelengthservice['length_service_range1'] ?>";
		document.getElementById("length_service_range2").value = "<?php echo $corelengthservice['length_service_range2'] ?>";
		document.getElementById("length_service_amount").value = "<?php echo $corelengthservice['length_service_amount'] ?>";
		document.getElementById("length_service_remark").value = "<?php echo $corelengthservice['length_service_remark'] ?>";
	}
</script>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">
						Home
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>corelengthserviceilufa">
						Length of Service List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>corelengthserviceilufa/editCoreLengthService/<?php echo $corelengthserviceilufa['length_service_id']; ?>">
						Edit Length of Service
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Length of Service 
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->

	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>corelengthserviceilufa" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('corelengthserviceilufa/processEditCoreLengthService',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_code" id="length_service_code" class="form-control" value="<?php echo $corelengthservice['length_service_code']?>">
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Length of Service Code</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_name" id="length_service_name" class="form-control" value="<?php echo $corelengthservice['length_service_name']?>" >
									<label class="control-label">Length of Service Name</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_range1" id="length_service_range1" class="form-control" value="<?php echo $corelengthservice['length_service_range1']?>">
									<label class="control-label">Length of Service Range 1</label>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_range2" id="length_service_range2" class="form-control" value="<?php echo $corelengthservice['length_service_range2']?>" >
									<label class="control-label">Length of Service Range 2</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_amount" id="length_service_amount" class="form-control" value="<?php echo $corelengthservice['length_service_amount']?>" >
									<label class="control-label">Length of Service Amount</label>
								</div>
							</div>
						</div>

						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_amount_multiply" id="length_service_amount_multiply" class="form-control" value="<?php echo $corelengthservice['length_service_amount_multiply']?>" >
									<label class="control-label">Length of Service Amount Multiply</label>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" autocomplete="off"  name="length_service_min_saving" id="length_service_min_saving" class="form-control" value="<?php echo $corelengthservice['length_service_min_saving']?>" >
									<label class="control-label">Length of Service Min Saving</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="length_service_remark" id="length_service_remark" class="form-control"><?php echo $corelengthservice['length_service_remark']?></textarea>
									<label class="control-label">Remark</label>
								</div>
							</div>
						</div>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<input type="hidden" name="length_service_id" value="<?php echo $corelengthservice['length_service_id']; ?>"/>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	
