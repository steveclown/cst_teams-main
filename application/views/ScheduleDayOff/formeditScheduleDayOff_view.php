<script>
	function ulang(){
		document.getElementById("award_code").value = "";
		document.getElementById("award_name").value = "";
	}
	
	function warningawardcode(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[0-9a-zA-Z]+$/; 
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("award_code").value = "";
			return false;
		}
	}
	
	function warningawardname(inputname) {
		//var letter = /^[0-9a-zA-Z]+$+ +/;  
		var letter = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/
		if(inputname.value.match(letter)){
			return true;
		}else{
			alert('Please input alphanumeric characters only');
			document.getElementById("award_name").value = "";
			return false;
		}
	}
	
	$(document).ready(function(){
        $("#Save").click(function(){
			var award_code = $("#award_code").val();
			var award_name = $("#award_name").val();
			var award_remark = $("#award_remark").val();
			
		  	if(award_code!='' && award_name!='' && award_remark!=''){
				return true;
			}else{
				alert('Data of Award Not Yet Complete');
				// document.getElementById("journal_voucher_description").value = "";
				return false;
			}
		});
    });

    function function_elements_add(name, value){
		$.ajax({
				type: "POST",
				url : "<?php echo site_url('ScheduleDayOff/function_elements_add');?>",
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
				url : "<?php echo site_url('ScheduleDayOff/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>


					<!-- BEGIN PAGE TITLE & BREADCRUMB-->
					<div class = "page-bar">
						<ul class="page-breadcrumb breadcrumb">
							<li>
								<a href="<?php echo base_url();?>">
									Beranda
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>ScheduleDayOff">
									Daftar Hari Libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>ScheduleDayOff/editScheduleDayOff/<?php echo $ScheduleDayOff['day_off_id'];?>">
									Edit Hari Libur
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h1 class="page-title">
						Form Edit Hari Libur
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
									Form Edit
								</div>
								<div class="actions">
									<a href="<?php echo base_url();?>ScheduleDayOff" class="btn btn-default sm">
										<i class="fa fa-angle-left"></i> Kembali
									</a>
								</div>
							</div>
							<div class="portlet-body form">
								<div class="form-body">
									<?php 
										echo form_open('ScheduleDayOff/processEditScheduleDayOff',array('id' => 'myform', 'class' => 'horizontal-form'));
									?>
									<div class = "row">
										<div class="col-md-6">
											<div class="form-group form-md-line-input">											
												<input type="text" name="day_off_name" id="day_off_name" value="<?php echo $ScheduleDayOff['day_off_name'];?>" class="form-control" onChange="function_elements_add(this.name, this.value);">
												<label class="control-label">Nama Hari Libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
										
										<div class = "col-md-3">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="day_off_start_date" id="day_off_start_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($ScheduleDayOff['day_off_start_date']);?>">
												<label class="control-label">Tanggal Mulai Libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>

										<div class = "col-md-3">
											<div class="form-group form-md-line-input">
												<input class="form-control form-control-inline input-medium date-picker" data-date-format="dd-mm-yyyy" type="text" name="day_off_end_date" id="day_off_end_date" onChange="function_elements_add(this.name, this.value);" value="<?php echo tgltoview($ScheduleDayOff['day_off_end_date']);?>">
												<label class="control-label">Tanggal Akhir Libur
													<span class="required">
														*
													</span>
												</label>
											</div>
										</div>
									</div>
									
									<div class = "row">
										<div class="col-md-12">
											<div class="form-group form-md-line-input">
												<textarea rows="3" name="day_off_remark" id="day_off_remark" class="form-control" onChange="function_elements_add(this.name, this.value);"><?php echo $ScheduleDayOff['day_off_remark'];?></textarea>
												<label class="control-label">Keterangqan</label>
											</div>
										</div>
									</div>
										<input type="hidden" name="day_off_id" value="<?php echo $ScheduleDayOff['day_off_id']; ?>"/>
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
			
