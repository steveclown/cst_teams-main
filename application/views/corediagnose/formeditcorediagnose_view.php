<script>
	function ulang(){
		document.getElementById("diagnose_id").value = "<?php echo $corediagnose['diagnose_id'] ?>";
		document.getElementById("diagnose_name").value = "<?php echo $corediagnose['diagnose_name'] ?>";
		document.getElementById("diagnose_code").value = "<?php echo $corediagnose['diagnose_code'] ?>";
		document.getElementById("diagnose_remark").value = "<?php echo $corediagnose['diagnose_remark'] ?>";
	}
</script>

		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb ">
				<li>
					<a href="<?php echo base_url();?>">
						Home
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>corediagnose">
						Diagnose List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>corediagnose/editCoreDiagnose/<?php echo $corediagnose['diagnose_id']; ?>">
						Edit Diagnose
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
		Form Edit Diagnose
		</h1>
		<!-- END PAGE TITLE & BREADCRUMB-->

<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');
?>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet box blue">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-reorder"></i>Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>corediagnose" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Back
						</a>
					</div>
				</li>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('corediagnose/processEditCoreDiagnose',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="diagnose_code" id="diagnose_code" class="form-control" value="<?php echo $corediagnose['diagnose_code']?>" >
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Diagnose Code</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="diagnose_name" id="diagnose_name" class="form-control" value="<?php echo $corediagnose['diagnose_name']?>" >
									<label class="control-label">Diagnose Name</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="diagnose_remark" id="diagnose_remark" class="form-control"><?php echo $corediagnose['diagnose_remark']?></textarea>
									<label class="control-label">Diagnose Remark</label>
								</div>
							</div>
						</div>
							<input type="hidden" name="diagnose_id" value="<?php echo $corediagnose['diagnose_id']; ?>"/>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>

