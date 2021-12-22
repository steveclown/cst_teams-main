<script>
	mappia = "<?php echo site_url('item/add/'); ?>";
	base_url = '<?php echo base_url();?>';
	noItemBinded = 0;
	
	function convertToCurrency(number){
		var decimalplaces = 2;
	   var decimalcharacter = ".";
	   var thousandseparater = ",";
	   number = parseFloat(number);
	   var sign = number < 0 ? "-" : "";
	   var formatted = new String(number.toFixed(decimalplaces));
	   if( decimalcharacter.length && decimalcharacter != "." ) { formatted = formatted.replace(/\./,decimalcharacter); }
	   var integer = "";
	   var fraction = "";
	   var strnumber = new String(formatted);
	   var dotpos = decimalcharacter.length ? strnumber.indexOf(decimalcharacter) : -1;
	   if( dotpos > -1 )
	   {
		  if( dotpos ) { integer = strnumber.substr(0,dotpos); }
		  fraction = strnumber.substr(dotpos+1);
	   }
	   else { integer = strnumber; }
	   if( integer ) { integer = String(Math.abs(integer)); }
	   while( fraction.length < decimalplaces ) { fraction += "0"; }
	   temparray = new Array();
	   while( integer.length > 3 )
	   {
		  temparray.unshift(integer.substr(-3));
		  integer = integer.substr(0,integer.length-3);
	   }
	   temparray.unshift(integer);
	   integer = temparray.join(thousandseparater);
	   return sign + integer + decimalcharacter + fraction;
	}

	function formaddarraitembinded(){
		alert('a');
		var item_id = document.getElementById("item_id").value;
		var item_unit 	 = document.getElementById("item_unit").value;
		var item_binded_memo_no 	 = document.getElementById("item_binded_memo_no").value;
		// var item_unit_price	= document.getElementById("item_unit_price").value;
		// var subtotal	= document.getElementById("subtotal").value;
		var item_composition_quantity = document.getElementById("item_composition_quantity").value;
		/* var noItemBinded = noItemBinded + 1; */
		
			$('#offspinwarehouse').css('display', 'none');
			$('#onspinspinwarehouse').css('display', 'table-row');
			  $.ajax({
			  type: "POST",
			  url : "<?php echo site_url('recruitmentappicantdata/addarraycomposition2');?>",
			  data: {'item_binded_memo_no' : item_binded_memo_no, 'item_composition_quantity' : item_composition_quantity, 'session_name' : "addarraycomposition-"},
			  success: function(msg){
			   // $('#onspinspinsupplier').css('display', 'none');
			   // $('#offspinconversion').css('display', 'default');
			   window.location.replace(mappia);
			 }
			});
	}
	
	function deletesessionarrays(value,session_name){
			// alert(value);
		$.ajax({
			type: "POST",
			url : "<?php echo base_url('item/deletesessionarrays');?>",
			data: {'var_to' : value, 'session_name' : session_name},
			success: function(msg){
//				alert(msg);
				window.location.replace(mappia);
			}
		});
	}
		
	$(document).on('change','#item_composition_quantity',function(event){
		item_composition_quantity 				= $('#item_composition_quantity')[0].value;
		item_unit_price			= $('#item_unit_price')[0].value;
		item_unit_id			= $('#item_unit_id')[0].value;
		item_id					= $('#item_id')[0].value;
		
		if(item_unit_price == null || item_unit_price == 0 || item_unit_price == ''){
			item_unit_price = '0';
		}
		if(item_id!=''){
			if (isNaN(item_composition_quantity)){
				alert('Please input only numbers!');
				$('#item_composition_quantity').val('');
				document.getElementById('item_composition_quantity').focus();
			}else{					
				subtotal = parseFloat(item_composition_quantity) * parseFloat(item_unit_price);
				$("#subtotal").val(subtotal);
				$("#subtotal2").val(convertToCurrency(subtotal));			
			}
		}else{
			alert('Please choose item, first!');
			$('#item_composition_quantity').val('');
			document.getElementById('item_composition_quantity').focus();
		}
	});
	
	$(document).on('change','#item_unit_price2',function(event){
		item_composition_quantity 				= $('#item_composition_quantity')[0].value;
		item_unit_price			= $('#item_unit_price2')[0].value;
		item_id					= $('#item_id')[0].value;
		item_unit_id			= $('#item_unit')[0].value;
		if(item_composition_quantity == null || item_composition_quantity == 0 || item_composition_quantity == ''){
			item_composition_quantity = '0';
		}
		if(item_id!=''){
			if (isNaN(item_composition_quantity)){
				alert('Please input only numbers!');
				$('#item_unit_price').val('');
				document.getElementById('item_unit_price').focus();
			}else{				
				subtotal = parseFloat(item_composition_quantity) * parseFloat(item_unit_price);
				$("#item_unit_price").val(item_unit_price);
				$("#item_unit_price2").val(convertToCurrency(item_unit_price));
				$("#subtotal").val(subtotal);
				$("#subtotal2").val(convertToCurrency(subtotal));	
			}
		}else{
			alert('Please choose item, first!');
			$('#item_unit_price').val('');
			document.getElementById('item_unit_price').focus();
		}
	});
	
	$(document).ready(function(){
        $("#item_category_id2").change(function(){
            var item_category_id = $("#item_category_id2").val();
			 $.ajax({
               type : "POST",
               url  : "<?php echo base_url(); ?>item/lookup_item_name",
               data : {item_category_id: item_category_id},
               success: function(data){
                   $("#item_id").html(data);				   
               }
            });
        });
    });
</script>
<?php 
	// echo form_open('settingstock/savesettingstockProcess'); 
	$sesi 	= $this->session->userdata('unique');
	// $data	= $this->session->userdata('settingstock-'.$sesi['unique']);
	$composition	= $this->session->userdata('addarraycomposition-'.$sesi['unique']);
	// print_r($unit);exit;
?>


						<?php
											if(!empty($composition)){
												foreach($composition as $key=>$val){
												}
											}
						?>
						<div class="col-md-12">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Item Binded Memo No</label>
										<input type="text" class="form-control" id="item_binded_memo_no" name="item_binded_memo_no" value="<?php echo $val['item_binded_memo_no'];?>" placeholder="Item Binded Memo No">
										
								
									</div>								
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label">Quantity</label>
										<input type="text" class="form-control" id="item_composition_quantity" name="item_composition_quantity" value="<?php echo $data['item_composition_quantity'];?>" placeholder="">
									</div>								
								</div>
								
							</div>
							<div class="col-md-12 " style="text-align  : right !important;">
								<button type='button' id='buttonaddarrayitem' class='btn default btn-xs green' onClick="formaddarraitembinded();"><i class='fa fa-plus'></i> Add</button>
							</div>
							<!--<div class="odd gradeX" id="onspinspinwarehouse" style="display:none;">
								<input type="text" class="form-control spinner" value="Processing ..." readonly>
							</div>-->
							<label></label>
							<div class="table-scrollable">
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th style='text-align:center' width='35%'>Item Name</th>
											<th style='text-align:center'>Quantity</th>
											<th style='text-align:center'>Item Unit</th>
											<th style='text-align:center'>Action</th>
										</tr>
									</thead>
									<tbody>
									<!--	<tr class="odd gradeX" id="offspinwarehouse" style="table-row">
											<td> <?php echo form_dropdown('item_id', $item, set_value('item_id',$data['item_id']),'id="item_id" class="form-control select2me"') ?></td>
											<td> <input class="form-control" type="text" name="item_composition_quantity" id="item_composition_quantity" value="<?php echo set_value('item_composition_quantity',$data['item_composition_quantity']); ?>"/></td>
											<td> <?php echo form_dropdown('item_unit', $unit, set_value('item_unit',$data['item_unit']),'id="item_unit" class="form-control select2me"') ?></td>											
											<!--<td> 
												<input class="form-control" type="text" name="item_unit_price2" id="item_unit_price2" value="<?php echo set_value('item_unit_price2',$data['item_unit_price2']); ?>"/>
												<input class="form-control" type="hidden" name="item_unit_price" id="item_unit_price" value="<?php echo set_value('item_unit_price',$data['item_unit_price']); ?>"/>
											</td>
											
											<td> 
												<input class="form-control" type="text" name="subtotal2" id="subtotal2" value="<?php echo set_value('subtotal2',$data['subtotal2']); ?>"/>
												<input class="form-control" type="hidden" name="subtotal" id="subtotal" value="<?php echo set_value('subtotal',$data['subtotal']); ?>"/>
											</td>-->
											<!--		<td> <button type='button' id='buttonaddarrayitem' class='btn default btn-xs green' onClick="formaddarraitem();"><i class='fa fa-plus'></i> Add</button></td>
										</tr>
										<tr class="odd gradeX" id="onspinspinwarehouse" style="display:none;">
											<td colspan="8">
												<input type="text" class="form-control spinner" value="Processing ..." readonly>
											</td>
										</tr>-->
										<?php
											if(!empty($composition)){
												foreach($composition as $key=>$val){
													echo"
														<tr class='odd gradeX'>
															<td style='text-align  : left !important;'>".$this->item_model->getitemname($val['item_id_composition'])."</td>
															<td style='text-align:right'>".nominal($val['item_composition_quantity'])."</td>															
															<td>".$this->item_model->getunitsymbol($val[item_unit])."</td>
															<!--<td>".nominal($val[item_unit_price])."</td>
															<td>".nominal($val[subtotal])."</td>-->
															";
															?>															
																<!--<button type='button' class='btn default btn-xs red' onClick='deletesessionarrays("<?php //echo $val[item_id_composition]; ?>","addarraycomposition-");'>
																<i class='fa fa-trash-o'></i> Delete </button>-->
															<?php
															echo"
															<td style='text-align  : center !important;'><a href='".$this->config->item('base_url')."item/deleteitembindeditem/$val[item_id_composition]' title='Delete Data' onClick=\"javascript:return confirm('apakah yakin ingin dihapus ?')\"><img border='0' src='".$this->config->item('base_url')."img/cross.gif'></a></td>
												
															</td>
														</tr>
													";
													
												}
											}else{
												echo"
													<tr class='odd gradeX'>
														<td colspan='4' style='text-align:center;'>
															No Data
														</td>
													</tr>
												";
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
				