<?php 
	$auth 	= $this->session->userdata('auth');
?>
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Human Resource Management System | iLuFA</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for full width layout with mega menu" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?php echo base_url();?>assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?php echo base_url();?>assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?php echo base_url();?>assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo base_url();?>assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?php echo base_url();?>assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
	</head>
    <!-- END HEAD -->
	
	

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-full-width page-footer-fixed">
        <div class="page-wrapper">
            <!-- BEGIN HEADER -->
            <div class="page-header navbar navbar-fixed-top">
                <!-- BEGIN HEADER INNER -->
                <div class="page-header-inner ">
                    <!-- BEGIN LOGO -->
                    <div class="page-logo">
                        <a href="index.html">
                            <img src="../assets/layouts/layout/img/logo.png" alt="logo" class="logo-default" /> </a>
                    </div>
                    <!-- END LOGO -->
                    <!-- BEGIN MEGA MENU -->
                    <!-- DOC: Remove "hor-menu-light" class to have a horizontal menu with theme background instead of white background -->
                    <!-- DOC: This is desktop version of the horizontal menu. The mobile version is defined(duplicated) in the responsive menu below along with sidebar menu. So the horizontal menu has 2 seperate versions -->
                    <div class="hor-menu   hidden-sm hidden-xs">
                        <ul class="nav navbar-nav">
                            <!-- DOC: Remove data-hover="megamenu-dropdown" and data-close-others="true" attributes below to disable the horizontal opening on mouse hover -->
                            <?php
							$menu = $this->MainPage_model->getParentMenu($auth['user_group_level']);
							// print_r($menu); exit;
							foreach($menu as $key=>$val){
								$datamenu = $this->MainPage_model->getDataParentmenu($val['detect']);
								$class 		= $this->uri->segment(1);
								if($class==''){$class='MainPage';}
								$active		= $this->MainPage_model->getActive($class);
								$compare 	= $datamenu['id_menu'];
								if($active==$compare){$stat = 'active';}else{$stat='';}
								if($datamenu['id_menu'] == '1'){
									echo'
									<li class="classic-menu-dropdown '.$stat.'">
										<a href="'.base_url().$datamenu['id'].'">
										<i class="fa '.$datamenu['image'].'"></i>
													'.$datamenu['text'].'
										<span class="selected">
										</span>
										</a>
									</li>
								';
								}else{
									$class 		= $this->uri->segment(1);
									if($class==''){$class='MainPage';}
									$active		= $this->MainPage_model->getActive($class);
									$compare 	= $datamenu['id_menu'];
									if($active==$compare){$stat = 'active';}else{$stat='';}
									echo'
										<li class="classic-menu-dropdown '.$stat.'">
											<a data-toggle="dropdown" data-hover="dropdown" data-close-others="true" href="">
												<i class="fa '.$datamenu['image'].'"></i>
													'.$datamenu['text'].'
												<span class="selected">
												</span>
											</a>
											<ul class="dropdown-menu">
									';
									$datasubmenu= $this->MainPage_model->getParentSubMenu2($auth['user_group_level'],$val['detect']);
									foreach($datasubmenu as $key2=>$val2){
										$idmenucari = substr($val2['id_menu'],0,2);
										$countsubmenu=count($this->MainPage_model->getSubMenu2($idmenucari));
										if($countsubmenu > 1){
											$submenuopen = $this->MainPage_model->getDataParentmenu($idmenucari);
											$class2 		= $this->uri->segment(1);
											if($class==''){$class='MainPage';}
											$active2		= $this->MainPage_model->getActive2($class);
											$compare2 		= $submenuopen['id_menu'];
											if($active2==$compare2){$stat2 = 'active';}else{$stat2='';}
											// echo'
											// <li class="dropdown-submenu '.$stat2.'">
													// <a href="'.base_url().$submenuopen['id'].'">
													// '.$submenuopen['text'].'
													// </a>
													// <ul class="dropdown-menu">
												// ';
												echo'
											<li class="dropdown-submenu '.$stat2.'">
													<a data-toggle="dropdown-submenu" data-close-others="true" href="#">
														<!-- <i class="fa '.$submenuopen['image'].'"></i> -->
															'.$submenuopen['text'].'
														
														<!--<span class="selected"></span>-->
													</a>
													<ul class="dropdown-menu">
												';
													
												$datasubmenu2= $this->MainPage_model->getParentSubMenu3($auth['user_group_level'],$submenuopen['id_menu']);	
												// print_r($datasubmenu2); exit;
												foreach($datasubmenu2 as $key3=>$val3){
														$idmenucari2 = substr($val3['id_menu'],0,3);
														$countsubmenu2=count($this->MainPage_model->getSubMenu2($idmenucari2));
														if($countsubmenu2 > 1){
															$submenuopen2=$this->MainPage_model->getDataParentmenu($idmenucari2);
															$class3 		= $this->uri->segment(1);
															if($class3==''){$class2='MainPage';}
															$active3		= $this->MainPage_model->getActive3($class);
															$compare3 		= $submenuopen2['id_menu'];
															if($active3==$compare3){$stat3 = 'active';}else{$stat3='';}
															// echo'
															// <li class="dropdown-submenu '.$stat3.'">
																// <a href="'.base_url().$submenuopen2['id'].'">
																// '.$submenuopen2['text'].'
																// </a>
																// <ul class="dropdown-menu">	
																// ';
																echo'
															<li class="dropdown-submenu '.$stat3.'">
																	<a data-toggle="dropdown-submenu" data-close-others="true" href="#">
																		<!--<i class="fa '.$submenuopen2['image'].'"></i> -->
																			'.$submenuopen2['text'].'
																		
																		<!--<span class="fa '.$submenuopen2['image'].'"></span>-->
																	</a>
																	<ul class="dropdown-menu">
																';
															$datasubmenu3= $this->MainPage_model->getParentSubMenu($auth['user_group_level'],$submenuopen2['id_menu']);	
																foreach($datasubmenu3 as $key4=>$val4){
																		echo'
																		<li >
																			<a href="'.base_url().$val4['id'].'">
																			'.$val4['text'].'
																			</a>
																			</li>
																		';
																		}
																		echo'	
																</ul>	
															</li>
															';
														}
														else{
														$submenuopen3=$this->MainPage_model->getDataParentmenu($val3['id_menu']);
															echo'
															<li>
															<a href="'.base_url().$submenuopen3['id'].'">
															'.$submenuopen3['text'].'
															</a>
															</li>
															';
														}
												}
												echo'	
												</ul>
											</li>
											';
										}else{
											$submenuopen2=$this->MainPage_model->getDataParentmenu($val2['id_menu']);
												$judul=$submenuopen2['text'];
												echo'
													<li >
														<a href="'.base_url().$submenuopen2['id'].'">
														<!-- <i class="fa '.$submenuopen2['image'].'"></i> -->
															'.$judul.'
														</a>
													</li>
												';
										}
									}
									echo'	
										</ul>
										</li>
									';
								}
							}
							?>
                        </ul>
                    </div>
                    <!-- END MEGA MENU -->
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <!-- END HEADER SEARCH BOX -->
                    <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                        <span></span>
                    </a>
                    <!-- END RESPONSIVE MENU TOGGLER -->
                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <!-- BEGIN NOTIFICATION DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                            <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                            <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                            
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="<?php echo base_url();?>assets/layouts/layout/img/avatar3_small.jpg" />
                                    <span class="username username-hide-on-mobile"> Nick </span>
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    <li>
                                        <a href="page_user_profile_1.html">
                                            <i class="icon-user"></i> My Profile </a>
                                    </li>
                                    <li>
                                        <a href="app_calendar.html">
                                            <i class="icon-calendar"></i> My Calendar </a>
                                    </li>
                                    <li>
                                        <a href="app_inbox.html">
                                            <i class="icon-envelope-open"></i> My Inbox
                                            <span class="badge badge-danger"> 3 </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="app_todo.html">
                                            <i class="icon-rocket"></i> My Tasks
                                            <span class="badge badge-success"> 7 </span>
                                        </a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="page_user_lock_1.html">
                                            <i class="icon-lock"></i> Lock Screen </a>
                                    </li>
                                    <li>
                                        <a href="page_user_login_1.html">
                                            <i class="icon-key"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-quick-sidebar-toggler">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <i class="icon-logout"></i>
                                </a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER -->
                        </ul>
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END HEADER INNER -->
            </div>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <div class="page-container">
                <!-- BEGIN SIDEBAR -->
                                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                <div class="page-sidebar-wrapper">
                    <!-- BEGIN SIDEBAR -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <div class="page-sidebar navbar-collapse collapse">
                        <!-- END SIDEBAR MENU -->
                        
                    </div>
                    <!-- END SIDEBAR -->
                </div>
                <!-- END SIDEBAR -->