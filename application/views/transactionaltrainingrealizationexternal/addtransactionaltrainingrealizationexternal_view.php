<script>
	function ulang(){
		document.getElementById("training_selection_id").value = "";
		document.getElementById("realization_training_date").value = "";
		document.getElementById("realization_training_remark").value = "";
	}	
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var training_selection_id = $("#training_selection_id").val();
			var realization_training_date = $("#realization_training_date").val();
			//alert(training_selection_id);
		  	if(training_selection_id!='' && realization_training_date!=''){
				return true;
			}else{
				alert('Data of Training Realization External Not Yet Complete');
				return false;
			}
		});
    });
</script>

<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
			Form Add Transactional Training External Realization
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li class="btn-group">
				<div class="actions">
					<a href="<?php echo base_url();?>transactionaltrainingrealizationexternal" class="btn green yellow-stripe">
						<i class="fa fa-angle-left"></i>
						<span class="hidden-480">
							 Back
						</span>
					</a>
				</div>
			</li>
			<li>
				<i class="fa fa-home"></i>
				<a href="<?php echo base_url();?>">
						Master
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="<?php echo base_url();?>transactionaltrainingrealizationexternal">
					Training External Realization List
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">
					Add Transactional Training External Realization
				</a>
				<i class="fa fa-angle-right"></i>
			</li>
		</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Form Add
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-body">
					<?php 
						echo form_open('transactionaltrainingrealizationexternal/processaddtransactionaltrainingrealizationexternal',array('id' => 'myform', 'class' => 'form-horizontal')); 
						$data = $this->session->userdata('addtransactionaltrainingsrealization');
					?>
						<div class="form-group">
							<label class="control-label col-md-3">Training Selection</label>
							<div class="col-md-3">
								<?php echo form_dropdown('training_selection_id', $selection ,set_value('training_selection_id',$data['training_selection_id']),'id="training_selection_id", class="form-control select2me"');?>
							</div>
						</div>							
						
						<div class="form-group">
							<label class="control-label col-md-3">Realization Date</label>
							<div class="col-md-3">
								<div class="input-group date date-picker" id="dp4" data-date-format="dd-mm-yyyy">
									<input name="realization_training_date" id="realization_training_date" type="text" class="form-control" value="<?php if (empty($data['realization_training_date'])){
									echo date('d-m-Y');
										}else{
									echo $data['realization_training_date'];
										}?>" readonly>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label class="col-md-3 control-label">Remark</label>
							<div class="col-md-8">
								<textarea rows="5" name="realization_training_remark" id="realization_training_remark" class="form-control" placeholder="Remark"><?php echo $data['realization_training_remark'];?></textarea>
							</div>
						</div>
						
				</div>
				<div class="form-actions right">
					<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
					<button type="submit" name="Save" id="Save" class="btn blue"><i class="fa fa-check"></i> Save</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>


