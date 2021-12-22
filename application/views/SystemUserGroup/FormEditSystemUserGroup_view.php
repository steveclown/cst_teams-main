<script>
	function CheckedAll () {
		for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
		  document.getElementById('myform').elements[i].checked = true;
		}
    }
	
	function UnCheckedAll () {
		for (var i = 0; i < document.getElementById('myform').elements.length; i++) {
		  document.getElementById('myform').elements[i].checked = false;
		}
    }
	function ulang(){
		document.getElementById("user_group_name").value = "";
	}
</script>

<script>
function ulang(){
	document.getElementById("loan_type_code").value = "<?php echo $systemusergroup['loan_type_code'] ?>";
	document.getElementById("loan_type_name").value = "<?php echo $systemusergroup['loan_type_name'] ?>";
}
</script>


			
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
								<a href="<?php echo base_url();?>SystemUserGroup">
									User Group List
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="<?php echo base_url();?>SystemUserGroup/editSystemUserGroup/<?php echo $systemusergroup['user_group_id'];?>">
									Edit User Group
								</a>
								<i class="fa fa-angle-right"></i>
							</li>
						</ul>
					</div>
					<h3 class="page-title">
						Form Edit User Group
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
						<a href="<?php echo base_url();?>SystemUserGroup" class="btn btn-default btn-sm">
							<i class="fa fa-angle-left"></i>
							<span class="hidden-480">
								 Back
							</span>
						</a>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<?php 
							echo form_open('SystemUserGroup/processEditSystemUserGroup',array('id' => 'myform', 'class' => 'horizontal-form')); 
							$data = $this->session->userdata('addSystemUserGroup');
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="user_group_code" id="user_group_code" class="form-control" value="<?php echo $systemusergroup['user_group_code']?>">
									<label class="control-label">
										User Group Code
										<span class="required">*</span>
									</label>
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group form-md-line-input">
									<input type="text" name="user_group_name" id="user_group_name" class="form-control" value="<?php echo $systemusergroup['user_group_name']?>">
									<label class="control-label">
										User Group Name
										<span class="required">*</span>
									</label>
									<span class="help-block">
										 Please input only alpha-numerical characters.
									</span>
								</div>
							</div>
						</div>

						<input type="hidden" name="user_group_id" id="user_group_id" class="form-control" value="<?php echo $systemusergroup['user_group_id']?>">
						<input type="hidden" name="old_user_group_name" id="old_user_group_name" class="form-control" value="<?php echo $systemusergroup['user_group_name']?>">


						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-3 control-label">Privilege  Menu
									</label>
									<div class="col-md-4">
										<ul>
											<?php
												$auth		= $this->session->userdata('auth');
												$menulist1 	= $this->SystemUserGroup_model->getMenuList("_");
												foreach($menulist1 as $key=>$val){
													if($val['type']=='folder'){
														echo "<li>";
														echo '<label>'.$val['text']."</label>";
															echo "<ul>";
																$menulist2 = $this->SystemUserGroup_model->getMenuList($val['id_menu']."_");
																foreach($menulist2 as $key2=>$val2){
																	if($val2['type']=='folder'){
																		echo "<li>";
																		echo '<label>'.$val2['text'].'</label>';
																		echo "<ul>";
																		$menulist3 = $this->SystemUserGroup_model->getMenuList($val2['id_menu']."_");
																		foreach($menulist3 as $key3=>$val3){
																			if($val3['type']=='folder'){
																				echo "<li>";
																				echo '<label>'.$val3['text'].'</label>';
																				echo "<ul>";
																				$menulist4 = $this->SystemUserGroup_model->getMenuList($val3['id_menu']."_");
																				foreach($menulist4 as $key4=>$val4){
																						if($val4['type']=='folder'){
																						echo "<li>";
																						echo '<label>'.$val3['text'].'</label>';
																						}
																						else{
																							if($val4['id_menu']!='21' && $val4['id_menu']!='22'){
																							echo "<li>";
																							echo form_checkbox($val4['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val4['id_menu']),'');
																							echo "<label> ".$val4['text']."</label>";
																							echo "</li>";
																							}else if($auth['user_group_level']=='1' || $auth['user_group_level']=='2'){
																							echo "<li>";
																							echo form_checkbox($val4['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val4['id_menu']),'');
																							echo "<label> ".$val4['text']."</label>";
																							echo "</li>";
																						}else {continue;}
																						}
																					}
																					echo "</ul>";
																				echo "</li>";
																		}
																		else
																		{
																		if($val3['id_menu']!='21' && $val3['id_menu']!='22'){
																			echo "<li>";
																			echo form_checkbox($val3['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val3['id_menu']),'');
																			echo "<label> ".$val3['text']."</label>";
																			echo "</li>";
																		}else if($auth['user_group_level']=='1' || $auth['user_group_level']=='2'){
																			echo "<li>";
																			echo form_checkbox($val3['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val3['id_menu']),'');
																			echo "<label> ".$val3['text']."</label>";
																			echo "</li>";
																		}else {continue;}
																		
																		}
																		}
																		echo "</ul>";
																	echo "</li>";
																		
																	} else {
																		if($val2['id_menu']!='21' && $val2['id_menu']!='22'){
																			echo "<li>";
																			echo form_checkbox($val2['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val2['id_menu']),'');
																			echo "<label> ".$val2['text']."</label>";
																			echo "</li>";
																		}else if($auth['user_group_level']=='1' || $auth['user_group_level']=='2'){
																			echo "<li>";
																			echo form_checkbox($val2['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val2['id_menu']),'');
																			echo "<label> ".$val2['text']."</label>";
																			echo "</li>";
																		}else {continue;}
																	}
																}
															echo "</ul>";
														echo "</li>";
													} else {
														echo "<li>";
														echo form_checkbox($val['id_menu']."_FT",1,$this->SystemUserGroup_model->isThisMenuInGroup($systemusergroup['user_group_id'],$val['id_menu']),'');
														echo "<label> ".$val['text']."</label>";
														echo "</li>";
													}
												}
											?>
										</ul>
										<a href="javascript:CheckedAll()" title="Check All">Check All</a> / <a href="javascript:UnCheckedAll()" title="UnCheck All">UnCheck All</a>
									</div>
								</div>
							</div>
						</div>
						<div class="form-actions right">
							<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
							<button type="submit" class="btn green-jungle"><i class="fa fa-check"></i> Save</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php echo form_close(); ?>

