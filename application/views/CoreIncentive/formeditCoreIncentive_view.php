<script>
	function reset_data(){
		document.getElementById("incentive_id").value = "<?php echo $CoreIncentive['incentive_id'] ?>";
		document.getElementById("premi_attendance_code").value = "<?php echo $CoreIncentive['premi_attendance_code'] ?>";
		document.getElementById("premi_attendance_name").value = "<?php echo $CoreIncentive['premi_attendance_name'] ?>";
		
	}

	base_url = '<?php base_url()?>';

	mappia = "	<?php 
					$site_url = 'CoreIncentive/addCoreIncentive/';
					echo site_url($site_url); 
				?>";

	function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('CoreIncentive/function_elements_add');?>",
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
				url : "<?php echo site_url('CoreIncentive/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>


		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<div class = "page-bar">
			<ul class="page-breadcrumb ">
				<li>
					<a href="<?php echo base_url();?>">
						Beranda
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreIncentive">
						Daftar Insentif
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>CoreIncentive/editCoreIncentive/<?php echo $CoreIncentive['incentive_id']; ?>">
						Edit Insentif
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h3 class="page-title">
		Form Edit Insentif 
		</h3>
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
						Form Edit
					</div>
					<div class="actions">
						<a href="<?php echo base_url();?>CoreIncentive" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i> Kembali
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('CoreIncentive/processEditCoreIncentive',array('id' => 'myform', 'class' => 'horizontal-form')); 
						?>
						<div class = "row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="incentive_code" id="incentive_code" class="form-control" value="<?php echo $CoreIncentive['incentive_code']?>" >
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
									<label class="control-label">Kode Insentif
										<span class="required">
											*
										</span>
									</label>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="incentive_name" id="incentive_name" class="form-control" value="<?php echo $CoreIncentive['incentive_name']?>" >
									<label class="control-label"> Nama Insentif</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-6">
							<div class="form-group form-md-line-input">
									<input type="text" name="incentive_amount" id="incentive_amount" class="form-control" value="<?php echo $CoreIncentive['incentive_amount']?>">
									<label class="control-label"> Total Insentif</label>
								</div>
							</div>
						</div>
						
						<div class = "row">
							<div class="col-md-12">
								<div class="form-group form-md-line-input">
									<textarea rows="3" name="incentive_remark" id="incentive_remark" class="form-control"><?php echo $CoreIncentive['incentive_remark']?></textarea>
									<label class="control-label">Keterangan</label>
								</div>
							</div>
						</div>
							<input type="hidden" name="incentive_id" value="<?php echo $CoreIncentive['incentive_id']; ?>"/>
					</div>
					<div class="form-actions right">
						<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Batal</button>
						<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Simpan</button>
					</div>
					<?php echo form_close(); ?>
				</div>
			</div>
		</div>
	</div>
	
