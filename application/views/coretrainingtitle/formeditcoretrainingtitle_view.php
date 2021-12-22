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
				url : "<?php echo site_url('coretrainingtitle/function_elements_add');?>",
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
				url : "<?php echo site_url('coretrainingtitle/function_state_add');?>",
				data : {'value' : value},
				success: function(msg){
			}
		});
	}
</script>
<!-- 
<script src="<?php echo base_url();?>asset/multilevel/tree/lib/jquery.js" type="text/javascript"></script>
<script type="text/javascript">
		var site_url = "<?php echo site_url();?>";
		function load_uri(uri,dom)
		{
			$.ajax({
			    url: site_url+'/'+uri,
			    success: function(response){			
				$(dom).html(response);
			    },
			dataType:"html"  		
			});
			return false;
		}
		function show_extra_combo(combo,combo_level)
		{
			var id = $(combo).val();
			// buat dom '.combo-level' di dalam extra-combo jika belum ada
			var domcombo = 'combo-'+combo_level;
			// alert(id);
			if($('.'+domcombo).length == 0)
			{
				$('#extra-combo').append('&nbsp;<span class="'+domcombo+'"></span>');
				 $('#training_title_parent').val(id);
			}
			load_uri("trainingtitle/show_child/"+id+"/"+combo_level,'.'+domcombo);
		}
	</script> -->
<?php 
	echo $this->session->userdata('message');
	$this->session->unset_userdata('message');

	print_r("coretrainingtitle ");
	print_r($coretrainingtitle);
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
					<a href="<?php echo base_url();?>coretrainingtitle">
						Training Title List
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="<?php echo base_url();?>coretrainingtitle/editCoreTrainingTitle<?php echo $coretrainingtitle['training_title_id']?>">
						Edit Training Title
					</a>
					<i class="fa fa-angle-right"></i>
				</li>
			</ul>
		</div>
		<h1 class="page-title">
			Form Edit Training Title
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
					<a href="<?php echo base_url();?>coretrainingtitle" class="btn btn-default btn-sm">
						<i class="fa fa-angle-left"></i> Back
					</a>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<?php 
						echo form_open('coretrainingtitle/processEditCoreTrainingTitle',array('id' => 'myform', 'class' => 'horizontal-form')); 
						$data = $this->session->userdata('addcoretrainingtitle');
					?>
					<div class = "row">
						<div class="col-md-6">							
							<div class="form-group form-md-line-input">
								<?php echo form_dropdown('training_category_id', $coretrainingcategory, $coretrainingtitle['training_category_id'], 'id ="training_category_id", class="form-control select2me" onChange="function_elements_add(this.name, this.value);"');?>
								<label class="control-label">Training Category Name<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="training_title_code" id="training_title_code" class="form-control" value="<?php echo $coretrainingtitle['training_title_code']?>" onChange="function_elements_add(this.name, this.value);" >
								<span class="help-block">
									 Please input only alpha-numerical characters.
								</span>
								<label class="control-label">Training Title Code<span class="required">*</span></label>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="form-group form-md-line-input">
								<input type="text" name="training_title_name" id="training_title_name" class="form-control" value="<?php echo $coretrainingtitle['training_title_name']?>"  onChange="function_elements_add(this.name, this.value);">
								<label class="control-label">Training Title Name<span class="required">*</span></label>
							</div>
						</div>
					</div>
					
					<div class = "row">
						<div class="col-md-12">
							<div class="form-group form-md-line-input">
								<textarea class="form-control" rows="3", name="training_title_remark", id="training_title_remark", value="<?php echo $coretrainingtitle['training_title_remark'];?>" onChange="function_elements_add(this.name, this.value);"></textarea>
								<label class="control-label">Training Title Remark</label>
							</div>
						</div>
					</div>
				</div>
			<div class="form-actions right">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
			</div>
			<input type="hidden" name="training_title_id" value="<?php echo $coretrainingtitle['training_title_id']; ?>"/>
			<?php echo form_close(); ?>
		</div>
		</div>
	</div>
</div>
			<input type="hidden" name="training_title_top_parent" id="training_title_top_parent"/>
			<input type="hidden" name="training_title_has_child" id="training_title_has_child" value="0"/>
			<input type="hidden" name="training_title_parent" id="training_title_parent"/>
