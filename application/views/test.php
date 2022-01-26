
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8" />
        <title>Metronic Admin Theme #1 | Full Width Layout</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="Preview page of Metronic Admin Theme #1 for full width layout with mega menu" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="http://localhost/HRMS/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/HRMS/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/HRMS/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/HRMS/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="http://localhost/HRMS/assets/global/css/components-rounded.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="http://localhost/HRMS/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="http://localhost/HRMS/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/HRMS/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="http://localhost/HRMS/assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="favicon.ico" /> 
	</head>
    <!-- END HEAD -->

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white page-full-width">
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
                                                    </ul>
                    </div>
                    <!-- END MEGA MENU -->
                    <!-- BEGIN HEADER SEARCH BOX -->
                    <!-- DOC: Apply "search-form-expanded" right after the "search-form" class to have half expanded search box -->
                    <form class="search-form" action="extra_search.html" method="GET">
                        <div class="input-group">
                            <input type="text" autocomplete="off"  class="form-control" placeholder="Search..." name="query">
                            <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </form>
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
                            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-bell"></i>
                                    <span class="badge badge-default"> 7 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>
                                            <span class="bold">12 pending</span> notifications</h3>
                                        <a href="page_user_profile_1.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">just now</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">10 mins</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Server #2 not responding. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">14 hrs</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> Application error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">2 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Database overloaded 68%. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">3 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> A user IP blocked. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">4 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-bell-o"></i>
                                                        </span> Storage Server #4 not responding dfdfdfd. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">5 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-info">
                                                            <i class="fa fa-bullhorn"></i>
                                                        </span> System Error. </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="time">9 days</span>
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Storage server failed. </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END NOTIFICATION DROPDOWN -->
                            <!-- BEGIN INBOX DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-envelope-open"></i>
                                    <span class="badge badge-default"> 4 </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold">7 New</span> Messages</h3>
                                        <a href="app_inbox.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">Just Now </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">16 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar1.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Bob Nilson </span>
                                                        <span class="time">2 hrs </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar2.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Lisa Wong </span>
                                                        <span class="time">40 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed auctor 40% nibh congue nibh... </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="photo">
                                                        <img src="../assets/layouts/layout3/img/avatar3.jpg" class="img-circle" alt=""> </span>
                                                    <span class="subject">
                                                        <span class="from"> Richard Doe </span>
                                                        <span class="time">46 mins </span>
                                                    </span>
                                                    <span class="message"> Vivamus sed congue nibh auctor nibh congue nibh. auctor nibh auctor nibh... </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END INBOX DROPDOWN -->
                            <!-- BEGIN TODO DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-extended dropdown-tasks" id="header_task_bar">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <i class="icon-calendar"></i>
                                    <span class="badge badge-default"> 3 </span>
                                </a>
                                <ul class="dropdown-menu extended tasks">
                                    <li class="external">
                                        <h3>You have
                                            <span class="bold">12 pending</span> tasks</h3>
                                        <a href="app_todo.html">view all</a>
                                    </li>
                                    <li>
                                        <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">New release v1.2 </span>
                                                        <span class="percent">30%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 40%;" class="progress-bar progress-bar-success" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">40% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Application deployment</span>
                                                        <span class="percent">65%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 65%;" class="progress-bar progress-bar-danger" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">65% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Mobile app release</span>
                                                        <span class="percent">98%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 98%;" class="progress-bar progress-bar-success" aria-valuenow="98" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">98% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Database migration</span>
                                                        <span class="percent">10%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 10%;" class="progress-bar progress-bar-warning" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">10% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Web server upgrade</span>
                                                        <span class="percent">58%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 58%;" class="progress-bar progress-bar-info" aria-valuenow="58" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">58% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">Mobile development</span>
                                                        <span class="percent">85%</span>
                                                    </span>
                                                    <span class="progress">
                                                        <span style="width: 85%;" class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">85% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <span class="task">
                                                        <span class="desc">New UI release</span>
                                                        <span class="percent">38%</span>
                                                    </span>
                                                    <span class="progress progress-striped">
                                                        <span style="width: 38%;" class="progress-bar progress-bar-important" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">38% Complete</span>
                                                        </span>
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <!-- END TODO DROPDOWN -->
                            <!-- BEGIN USER LOGIN DROPDOWN -->
                            <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                            <li class="dropdown dropdown-user">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <img alt="" class="img-circle" src="../assets/layouts/layout/img/avatar3_small.jpg" />
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
                <!-- END SIDEBAR -->				<div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        <!-- BEGIN PAGE HEADER-->
                        <!-- BEGIN THEME PANEL -->
                        
                        <!-- END THEME PANEL -->
                        <!-- BEGIN PAGE BAR -->
                        <div class="page-bar">
                            <ul class="page-breadcrumb">
                                <li>
                                    <a href="index.html">Home</a>
                                    <i class="fa fa-circle"></i>
                                </li>
                                <li>
                                    <span>Horizontal Menu</span>
                                </li>
                            </ul>
                            <div class="page-toolbar">
                                <div class="btn-group pull-right">
                                    <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li>
                                            <a href="#">
                                                <i class="icon-bell"></i> Action</a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-shield"></i> Another action</a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-user"></i> Something else here</a>
                                        </li>
                                        <li class="divider"> </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-bag"></i> Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END PAGE BAR -->
                        <!-- BEGIN PAGE TITLE-->
                        <style>
	th{
		font-size:14px  !important;
		font-weight: bold !important;
		text-align:center !important;
		margin : 0 auto;
		vertical-align:middle !important;
	}
	td{
		font-size:12px  !important;
		font-weight: normal !important;
	}
	
	select{
		display: inline-block;
		padding: 4px 6px;
		margin-bottom: 0px !important;
		font-size: 14px;
		line-height: 20px;
		color: #555555;
		-webkit-border-radius: 3px;
		-moz-border-radius: 3px;
		border-radius: 3px;
	}
</style>
<script>
function reload(value) {
	var employee_id = document.getElementById("employee_id").value;
	
	$.ajax({
	   type : "POST",
	   url  : "http://localhost/HRMS/main/setselectedindexsession",
	   data: {'employee_id' : employee_id},
	   success: function(data){
			window.location = "http://localhost/HRMS/main";
	   }
	});	
}
function setselectedtab(value) {
	// alert(value);
	$.ajax({
	   type : "POST",
	   url  : "http://localhost/HRMS/main/setselectedtab",
	   data: {'selectedtab' : value},
	   success: function(data){
	   }
	});	
}

</script>

<!--
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					
				</div>
				<div class="actions">
					<a href="main/addemployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i>Add
					</a>
					<a data-toggle="modal" href="#mainfilter" class="btn default btn-sm">
						<i class="fa fa-search icon-black"></i>Search
					</a>
					<a href="main/reset_filter" class="btn default btn-sm">
						<i class="fa fa-search-minus icon-black"></i>Reset
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
-->

<div class="row">
	<div class="col-md-3">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>Employee List
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-group">
					<select class="form-control" size="35" name="employee_id" id="employee_id" onChange="reload(this.value)">
													echo"
							<option selected="selected" value="15">Tifa</option>
							";
													echo"
							<option  value="16">Vise</option>
							";
													echo"
							<option  value="17">Ferry</option>
							";
													echo"
							<option  value="18">Josep</option>
							";
											</select>
				</div>
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
<!-- </div>
<div class="row"> -->
	<div class="col-md-9">
		<!-- BEGIN Portlet PORTLET-->
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-reorder"></i>General Information
				</div>
				<div class="actions">
					<a href="main/addemployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i> Add
					</a>
					<a data-toggle="modal" href="#mainsearch" class="btn default btn-sm">
						<i class="fa fa-search icon-black"></i> Search
					</a>
					<a data-toggle="modal" href="#mainfilter" class="btn default btn-sm">
						<i class="fa fa-glass icon-black"></i> Filter
					</a>
					<!--
					<a href="main/newEmployee" class="btn default btn-sm">
						<i class="fa fa-plus icon-black"></i> Add Employee
					</a>
					<a href="#" class="btn default btn-sm">
						<i class="fa fa-minus icon-black"></i> Delete
					</a>
					<a href="#" class="btn default btn-sm">
						<i class="fa fa-eye icon-black"></i> Find
					</a>
					<a href="#" class="btn default btn-sm">
						<i class="fa fa-glass icon-black"></i> Sort
					</a>
					-->
				</div>
			</div>
			<div class="portlet-body">
				<ul class="nav nav-tabs">
					<li class='active'>
						<a href="#tab_employee" id="tab_id_employee" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Employee
						</a>
					</li>
					<li >
						<a href="#tab_payroll" id="tab_id_payroll" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Payroll
						</a>
					</li>
					<li >
						<a href="#tab_coverage" id="tab_id_coverage" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Coverage
						</a>
					</li>
					<li >
						<a href="#tab_competencies" id="tab_id_competencies" onclick="setselectedtab(this.id)" data-toggle="tab">
							 Competencies
						</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class='tab-pane fade active in' id="tab_employee">
						<ul class="nav nav-tabs">
							<li class='active'>
								<a href="#tab_content_employment" id="tab_id_employment" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Employment
								</a>
							</li>
							<li >
								<a href="#tab_content_organization" id="tab_id_organization" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Organization
								</a>
							</li>
							<li >
								<a href="#tab_content_leave" id="tab_id_leave" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Leave
								</a>
							</li>
							<li >
								<a href="#tab_content_asset" id="tab_id_asset" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Asset
								</a>
							</li>
							<li >
								<a href="#tab_content_salaryhistory" id="tab_id_salaryhistory" onclick="setselectedtab(this.id)" data-toggle="tab">
									Salary History
								</a>
							</li>
							<li >
								<a href="#tab_content_personaldata" id="tab_id_personaldata" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Personal Data
								</a>
							</li>
							<li >
								<a href="#tab_content_familydata" id="tab_id_familydata" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Family
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class='tab-pane fade active in' id="tab_content_employment">
								<div class="form-body form">
	<div class="form-body">
		<h3 class="form-section">Employment</h3>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Probation Date</label>
					<input type="text" autocomplete="off"  name="employee_probation_date" id="employee_probation_date" class="form-control" value="-" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Probation Remark</label>
					<textarea name="employee_probation_remark" id="employee_probation_remark" class="form-control" readonly></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Effective Date</label>
					<input type="text" autocomplete="off"  name="employee_effective_date" id="employee_effective_date" class="form-control" value="-" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Effective Remark</label>
					<textarea name="employee_effective_remark" id="employee_effective_remark" class="form-control" readonly></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Employee Status</label>
					<input type="text" autocomplete="off"  name="employee_status" id="employee_status" class="form-control" value="Permanent" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Status Date</label>
					<input type="text" autocomplete="off"  name="employee_status_date" id="employee_status_date" class="form-control" value="-" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Status Count</label>
					<input type="text" autocomplete="off"  name="employee_status_count" id="employee_status_count" class="form-control" value="0" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Status Due Date</label>
					<input type="text" autocomplete="off"  name="employee_status_due_date" id="employee_status_due_date" class="form-control" value="-" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Working Status</label>
					<input type="text" autocomplete="off"  name="employee_working_status" id="employee_working_status" class="form-control" value="Monthly" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Overtime Status</label>
					<input type="text" autocomplete="off"  name="employee_overtime_status" id="employee_overtime_status" class="form-control" value="Automatic" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="col-md-6">Has Leave Permission</label>
					<input type="text" autocomplete="off"  name="has_leave_permission" id="has_leave_permission" class="form-control" value="No" readonly >
				</div>
			</div>
		</div>
	</div>
</div>							</div>
							<div class='tab-pane fade' id="tab_content_organization">
								<div class="form-body form">
	<div class="form-body">
		<h3 class="form-section">Organization</h3>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Region</label>
					<input type="text" autocomplete="off"  name="region_id" id="region_id" class="form-control" value="Bekonang" readonly>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Branch:</label>
					<input type="text" autocomplete="off"  name="branch_id" id="branch_id" class="form-control" value="Santren" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Division:</label>
					<input type="text" autocomplete="off"  name="division_id" id="division_id" class="form-control" value="Finance" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Department:</label>
					<input type="text" autocomplete="off"  name="department_id" id="department_id" class="form-control" value="Telemarketing" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Section:</label>
					<input type="text" autocomplete="off"  name="section_id" id="section_id" class="form-control" value="Kanvas" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Job Title:</label>
					<input type="text" autocomplete="off"  name="job_title_id" id="job_title_id" class="form-control" value="Executor" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Grade:</label>
					<input type="text" autocomplete="off"  name="grade_id" id="grade_id" class="form-control" value="Premium" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Class:</label>
					<input type="text" autocomplete="off"  name="class_id" id="class_id" class="form-control" value="Class1" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Location:</label>
					<input type="text" autocomplete="off"  name="location_id" id="location_id" class="form-control" value="Solo" readonly >
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3">Shift:</label>
					<input type="text" autocomplete="off"  name="shift_id" id="shift_id" class="form-control" value="Shift Pagi" readonly >
				</div>
			</div>
		</div>
	</div>
</div>							</div>
							<div class='tab-pane fade' id="tab_content_leave">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterleave";
	}	
	
	function openform3(){
		var a = document.getElementById("passwordf").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<form action="http://localhost/HRMS/main/filterleave" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform3()">Advanced Search</button>
<div class="form-body" style="display:none;" id='passwordf'>
	<h3 class="form-section">Leave</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Leave Name</label>
				<select name="annual_leave_id" id="annual_leave_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Leave 1</option>
<option value="2">Leave 2</option>
</select>			</div>
		</div>
	</div>					
	<!--<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Leave Period</label>
				<input type="text" autocomplete="off"  name="employee_leave_period" id="employee_leave_period" value="" class="form-control">
			</div>
		</div>
	</div>-->
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="start_period" id="start_period" type="text" class="form-control" value="05-03-2017" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="end_period" id="end_period" type="text" class="form-control" value="05-03-2017" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#start_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be greater then the End date');
						$('#start_date').val(end_date);
					} else {
						$('#alert').hide();
						$('#start_date').val(start_date);
					}
				});
			});
			$(document).ready(function(){
				$("#end_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be less than End date');
						$('#end_date').val(start_date);
					} else {
						$('#alert').hide();
						$('#end_date').val(end_date);
					}
				});
			});
		</script>
	</div>
	<div class="row">
		<!--<div class="form-group">
			<div class="col-md-offset-9 col-md-12">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</div>-->
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
		<form action="#" class="horizontal-form">
		<div class="form-body">		
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeleave">
						<thead>
							<tr>
								<th>Leave Name</th>
								<th>Period</th>
								<th>Days</th>
								<th>Taken</th>
								<th>Last Balance</th>
								<th>Remark</th>
							</tr>
						</thead>
						<tbody>
						
									<tr class='odd gradeX'>
										<td>Leave 1</td>
										<td style='text-align:right'>18-02-2015</td>
										<td style='text-align:right'>2</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>2</td>
										<td>Cuti Piknik</td>
									</tr>
								
									<tr class='odd gradeX'>
										<td>Leave 1</td>
										<td style='text-align:right'>01-03-2015</td>
										<td style='text-align:right'>1</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>1</td>
										<td>Cuti Jalan-jalan</td>
									</tr>
								
									<tr class='odd gradeX'>
										<td>Leave 2</td>
										<td style='text-align:right'>-</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>0</td>
										<td></td>
									</tr>
													</tbody>
					</table>	
				</div>
			</div>
		</div>
		</form>
	</div>
</div>							</div>
							<div class='tab-pane fade' id="tab_content_asset">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterasset";
	}	
	
	function openform2(){
		var a = document.getElementById("asd").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<form action="http://localhost/HRMS/main/filterasset" method="post" accept-charset="utf-8" id="myform2" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform2()">Advanced Search</button>
<div class="form-body" style="display:none;" id='asd'>
	<h3 class="form-section">Asset</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Asset Name</label>
				<select name="asset_id" id="asset_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">asd</option>
<option value="2">asdfg</option>
<option value="3">Chair</option>
</select>			</div>
		</div>
	</div>					
	<!--<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Leave Period</label>
				<input type="text" autocomplete="off"  name="employee_leave_period" id="employee_leave_period" value="" class="form-control">
			</div>
		</div>
	</div>-->
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Receipt Date</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="start_date" id="start_date" type="text" class="form-control" value="05-03-2017" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Receipt Date</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="end_date" id="end_date" type="text" class="form-control" value="05-03-2017" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#start_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be greater then the End date');
						$('#start_date').val(end_date);
					} else {
						$('#alert').hide();
						$('#start_date').val(start_date);
					}
				});
			});
			$(document).ready(function(){
				$("#end_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be less than End date');
						$('#end_date').val(start_date);
					} else {
						$('#alert').hide();
						$('#end_date').val(end_date);
					}
				});
			});
		</script>
	</div>
	<div class="row">
		<!--<div class="form-group">
			<div class="col-md-offset-9 col-md-12">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</div>-->
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeasset">
					<thead>
					<tr>
						<th>
							Asset Name
						</th>
						<th>
							Sub Asset Name
						</th>
						<th>
							Receipt Date
						</th>
						<th>
							Return Date
						</th>
					</tr>
					</thead>   
					<tbody>
						
										<tr class='odd gradeX'>
									<td>asd</td>
									<td>Meja</td>
									<td style='text-align:right'>02-03-2016 00:00:00</td>
									<td style='text-align:right'>07-06-2016 00:00:00</td>
										</tr>
								
										<tr class='odd gradeX'>
									<td>asd</td>
									<td>Meja</td>
									<td style='text-align:right'>01-01-2015 00:00:00</td>
									<td style='text-align:right'>01-01-1970 00:00:00</td>
										</tr>
								
										<tr class='odd gradeX'>
									<td>Chair</td>
									<td>Table</td>
									<td style='text-align:right'>16-03-2016 00:00:00</td>
									<td style='text-align:right'>16-03-2016 00:00:00</td>
										</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_salaryhistory">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filtersalaryhistory";
	}	
	
	function openform4(){
		var a = document.getElementById("pasword1").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<form action="http://localhost/HRMS/main/filtersalaryhistory" method="post" accept-charset="utf-8" id="myform" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform4()">Advanced Search</button>
<div class="form-body" style="display:none;" id='pasword1'>
	<h3 class="form-section">Salay History</h3>					
	<!--<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Leave Period</label>
				<input type="text" autocomplete="off"  name="employee_leave_period" id="employee_leave_period" value="" class="form-control">
			</div>
		</div>
	</div>-->
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Date</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="start_date" id="start_date" type="text" class="form-control" value="05-03-2017" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Date</label>
				<div class="input-group date date-picker" data-date-format="dd-mm-yyyy">
					<input name="end_date" id="end_date" type="text" class="form-control" value="05-03-2017" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#start_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be greater then the End date');
						$('#start_date').val(end_date);
					} else {
						$('#alert').hide();
						$('#start_date').val(start_date);
					}
				});
			});
			$(document).ready(function(){
				$("#end_date").change(function(){
					end_date 		= $('#end_date')[0].value;
					end_date_split 	= end_date.split('-');
					endDate			= new Date(end_date_split[2],parseInt(end_date_split[1])-1,end_date_split[0]);
					start_date 		= $('#start_date')[0].value;
					start_date_split = start_date.split('-');
					startDate			= new Date(start_date_split[2],parseInt(start_date_split[1])-1,start_date_split[0]);
					if (startDate.valueOf() > endDate.valueOf()){
						alert('The Start date can not be less than End date');
						$('#end_date').val(start_date);
					} else {
						$('#alert').hide();
						$('#end_date').val(end_date);
					}
				});
			});
		</script>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Grade</label>
				<select name="grade_id" id="grade_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Premium</option>
<option value="2">Pertamax</option>
<option value="3">Premium</option>
</select>			</div>
		</div>		
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Class</label>
				<select name="class_id" id="class_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Class1</option>
<option value="2">Class 2</option>
</select>			</div>
		</div>
	</div>
	
	<div class="row">
		<!--<div class="form-group">
			<div class="col-md-offset-9 col-md-12">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</div>-->
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>
</form>	
<div class="form-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeesalaryhistory">
						<thead>
							<tr>
								<th style='text-align:center !important;'>Date</th>
								<th style='text-align:center !important;'>Grade</th>
								<th style='text-align:center !important;'>Class</th>
								<th style='text-align:center !important;'>Remark</th>
							</tr>
						</thead>
						<tbody>
											</tbody>
					</table>	
				</div>
			</div>
		</div>
	</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_personaldata">
								<div class="portlet-body form">
	<div class="form-body">
			<h3 class="form-section">Personal Data</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label class="control-label">Employee Code</label>
						<input type="text" autocomplete="off"  name="employee_code" id="employee_code" value="Tifa" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Employee Name<span class="required">*</span></label>
						<input type="text" autocomplete="off"  name="employee_name" id="employee_name" value="Tifa" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Nick Name</label>
						<input type="text" autocomplete="off"  name="employee_nick_name" id="employee_nick_name" value="Tifa" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Gender</label>
						<input type="text" autocomplete="off"  name="employee_gender" id="employee_gender" value="Female" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Date of Birth<span class="required">*</span></label>
						<input class="form-control" type="text" name="date_of_birth" id="date_of_birth" value="18-02-2015" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Place Of Birth</label>
						<input type="text" autocomplete="off"  name="place_of_birth" id="place_of_birth" value="Jakarta" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Religion</label>
						<input type="text" autocomplete="off"  name="employee_religion" id="employee_religion" value="Christian" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Blood Type</label>
						<input type="text" autocomplete="off"  name="employee_blood_type" id="employee_blood_type" value="O" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Picture</label><br>
						<img src='http://localhost/HRMS/./img/employee/c5f12eaba9633622dbf58f114cd054e2.jpg' height='150' width='150'>					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<h3 class="form-section">Family</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Marital Status</label>
							<input type="text" autocomplete="off"  name="marital_status_id" id="marital_status_id" value="asdfg" class="form-control" readonly>

					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Heir Name</label>
						<input type="text" autocomplete="off"  name="employee_heir_name" id="employee_heir_name" value="George" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">Heir Occupation</label>
						<input type="text" autocomplete="off"  name="employee_heir_occupation" id="employee_heir_occupation" value="SPV" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<h3 class="form-section">Current Address</h3>
			<div class="row">
				<div class="col-md-12 ">
					<div class="form-group">
						<label>Address</label>
						<input type="text" autocomplete="off"  name="employee_address" id="employee_address" value="Purwasari" class="form-control" readonly>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>City</label>
						<input type="text" autocomplete="off"  name="employee_city" id="employee_city" value="Solo" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Zip Code</label>
						<input type="text" autocomplete="off"  name="employee_zip_code" id="employee_zip_code" value="57134" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<!--/row-->
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>RT</label>
						<input type="text" autocomplete="off"  name="employee_rt" id="employee_rt" value="01" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Kelurahan</label>
						<input type="text" autocomplete="off"  name="employee_kelurahan" id="employee_kelurahan" value="Purwasari" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>RW</label>
						<input type="text" autocomplete="off"  name="employee_rw" id="employee_rw" value="03" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Kecamatan</label>
						<input type="text" autocomplete="off"  name="employee_kecamatan" id="employee_kecamatan" value="Laweyan" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<h3 class="form-section">Contact Person</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Home Phone</label>
						<input type="text" autocomplete="off"  name="employee_home_phone" id="employee_home_phone" value="023923092" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Mobile Phone</label>
						<input type="text" autocomplete="off"  name="employee_mobile_phone" id="employee_mobile_phone" value="3203239" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Email</label>
						<input type="text" autocomplete="off"  name="employee_email_address" id="employee_email_address" value="tifa@tifa.com" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<h3 class="form-section">Residential Address</h3>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Residence ID</label>
						<input type="text" autocomplete="off"  name="employee_id_number" id="employee_id_number" value="83830382038939" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Residence Address</label>
						<input type="text" autocomplete="off"  name="employee_residence_address" id="employee_residence_address" value="Purwasari" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence City</label>
						<input type="text" autocomplete="off"  name="employee_residence_city" id="employee_residence_city" value="Solo" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence Zip Code</label>
						<input type="text" autocomplete="off"  name="employee_residence_zip_code" id="employee_residence_zip_code" value="32321" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence RT</label>
						<input type="text" autocomplete="off"  name="employee_residence_rt" id="employee_residence_rt" value="09" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence Kelurahan</label>
						<input type="text" autocomplete="off"  name="employee_residence_kelurahan" id="employee_residence_kelurahan" value="Purwasari" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence RW</label>
						<input type="text" autocomplete="off"  name="employee_residence_rw" id="employee_residence_rw" value="09" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Residence Kecamatan</label>
						<input type="text" autocomplete="off"  name="employee_residence_kecamatan" id="employee_residence_kecamatan" value="Laweyan" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<h3 class="form-section">Driving License</h3>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Driving License A</label>
						<input type="text" autocomplete="off"  name="employee_driving_licenseA" id="employee_driving_licenseA" value="y" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
				<div class="col-md-6">
					<div class="form-group">
						<label>Driving License B</label>
						<input type="text" autocomplete="off"  name="employee_driving_licenseB" id="employee_driving_licenseB" value="y" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Driving License B1</label>
						<input type="text" autocomplete="off"  name="employee_driving_licenseB1" id="employee_driving_licenseB1" value="n" class="form-control" readonly>
					</div>
				</div>
				<!--/span-->
			</div>
	</div>
</div>							</div>
							<div class='tab-pane fade' id="tab_content_familydata">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterfamily";
	}	
	
	function openformfamily(){
		var a = document.getElementById("family").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filterfamily" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformfamily()">Advanced Search</button>
<div class="form-body" style="display:none;" id='family'>
	<h3 class="form-section">Family Data</h3>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Family Status</label>
				<select name="family_status_id" id="family_status_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">asd</option>
<option value="2">Anak</option>
</select>			</div>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Family Name</label>
				<input type="text" autocomplete="off"  name="employee_family_name" id="employee_family_name" value="" class="form-control" placeholder="Company Name">
			</div>
		</div>
	</div>			
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form>	<div class="form-body form">
		<div class="form-body">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeefamilydata">
						<thead>
							<tr>
								<th>
									 Name
								</th>
								<th>
									 Status
								</th>
								<th>
									 Has Coverage Claim
								</th>
								<th>
									 Ratio
								</th>
								<th>
									 Detail
								</th>
							</tr>
						</thead>
						<tbody>
							
											<tr class='odd gradeX'>
												<td>
													Rini
												</td>
												<td>
													Anak
												</td>												
												<td>
													No
												</td>
												<td>
													1
												</td>
												<td>
													<a href='http://localhost/HRMS/hroemployeefamilydata/Edit/1' class='btn default btn-xs black'>
													<i class='fa fa-edit'></i> Detail
													</a>
												</td>
											</tr>
									
											<tr class='odd gradeX'>
												<td>
													Deni
												</td>
												<td>
													Anak
												</td>												
												<td>
													No
												</td>
												<td>
													10
												</td>
												<td>
													<a href='http://localhost/HRMS/hroemployeefamilydata/Edit/3' class='btn default btn-xs black'>
													<i class='fa fa-edit'></i> Detail
													</a>
												</td>
											</tr>
															</tbody>
						</table>
				</div>
			</div>
		</div>
	</div>
</div>
</form>							</div>
						</div>
					</div>
					<div class='tab-pane fade' id="tab_payroll">
						<ul class="nav nav-tabs">
							<li class='active'>
								<a href="#tab_content_payment" id="tab_id_payment" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Payment
								</a>
							</li>
							<li >
								<a href="#tab_content_allowance" id="tab_id_allowance" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Allowances
								</a>
							</li>
							<li >
								<a href="#tab_content_deduction" id="tab_id_deduction" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Deduction
								</a>
							</li>
							<!--<li >
								<a href="#tab_content_loan" id="tab_id_loan" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Loan
								</a>
							</li>-->
							<li >
								<a href="#tab_content_insurance" id="tab_id_insurance" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Insurance
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class='tab-pane fade active in' id="tab_content_payment">
								<div class="portlet-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Bank Name</label>
					<input type="text" autocomplete="off"  name="employee_bank_name" id="employee_bank_name" class="form-control" placeholder="Bank Name" value="BNI" readonly>
				</div>
			</div>
			<!--/span-->
			<div class="col-md-6">
				<div class="form-group">
					<label>Account Number</label>
					<input type="text" autocomplete="off"  name="employee_bank_acct_no" id="employee_bank_acct_no" class="form-control" placeholder="Account Number"  value="0390239" readonly>
				</div>
			</div>
			<!--/span-->
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label>Account Name</label>
					<input type="text" autocomplete="off"  name="employee_bank_acct_name" id="employee_bank_acct_name" class="form-control" placeholder="Account Name"  value="Tifa" readonly>
				</div>
			</div>
			<!--/span-->
		</div>
	</div>
</div>							</div>
							<div class='tab-pane fade' id="tab_content_allowance">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterallowance";
	}	
	
	function openform5(){
		var a = document.getElementById("abc").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<form action="http://localhost/HRMS/main/filterallowance" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform5()">Advanced Search</button>
<div class="form-body" style="display:none;" id='abc'>
	<h3 class="form-section">Allowance</h3>		
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Allowance Name</label>
				<select name="allowance_id" id="allowance_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Transport</option>
<option value="2">Smartphone</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<!--<div class="form-group">
			<div class="col-md-offset-9 col-md-12">
				<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
				<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
			</div>
		</div>-->
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeallowance">
					<thead>
						<tr>
							<th>
								 Name
							</th>
							<th>
								 Period
							</th>
							<th>
								 Amount
							</th>
							<th>
								 Remark
							</th>
						</tr>
					</thead>   
					<tbody>
						
										<tr class='odd gradeX'>
											<td>Transport</td>												
											<td style='text-align:right'>0</td>
											<td style='text-align:right'>100,000</td>
											<td>oke</td>
										</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_deduction">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterdeduction";
	}	
	
	function openform6(){
		var a = document.getElementById("form-deduction").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<form action="http://localhost/HRMS/main/filterdeduction" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform6()">Advanced Search</button>
<div class="form-body" style="display:none;" id='form-deduction'>
	<h3 class="form-section">Deduction</h3>		
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Deduction Name</label>
				<select name="deduction_id" id="deduction_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Terlambat</option>
<option value="2">Alpha</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
	<!--<h3 class="form-section">Deduction</h3>-->
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeededuction">
					<thead>
						<tr>
							<th>
								 Name
							</th>
							<th>
								 Period
							</th>
							<th>
								 Amount
							</th>
							<th>
								 Remark
							</th>
						</tr>
					</thead>   
					<tbody>
						
										<tr class='odd gradeX'>
											<td>Terlambat</td>												
											<td style='text-align:right'>0</td>
											<td style='text-align:right'>100,000</td>
											<td>oke</td>
										</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_loan">
															</div>
							<div class='tab-pane fade' id="tab_content_insurance">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterinsurance";
	}	
	
	function openform7(){
		var a = document.getElementById("insurance").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
		// document.getElementById("code").style.display = "block";
		// document.getElementById("name").style.display = "block";
	}
</script>
<form action="http://localhost/HRMS/main/filterinsurance" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform7()">Advanced Search</button>
<div class="form-body" style="display:none;" id='insurance'>
	<h3 class="form-section">Insurance</h3>		
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Insurance Name</label>
				<select name="insurance_id" id="insurance_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">asdfasdf</option>
<option value="3">Prudential</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Insurance Premi Name</label>
				<select name="insurance_premi_id" id="insurance_premi_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">001</option>
<option value="2">002</option>
</select>			</div>
		</div>
	</div>			
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeinsurance">
					<thead>
						<tr>
							<th>
								 Name
							</th>							
							<th>
								 Premi Code
							</th>
							<th>
								 Period
							</th>
							<th>
								 Amount
							</th>
							<th>
								 Remark
							</th>
						</tr>
					</thead>   
					<tbody>
						
										<tr class='odd gradeX'>
											<td>
												Prudential
											</td>
											<td>
												001
											</td>												
											<td style='text-align:right'>
												201501
											</td>
											<td style='text-align:right'>
												5,000,000
											</td>
											<td>
												Asuransi kecelakaan
											</td>
										</tr>
								
										<tr class='odd gradeX'>
											<td>
												asdfasdf
											</td>
											<td>
												001
											</td>												
											<td style='text-align:right'>
												35
											</td>
											<td style='text-align:right'>
												1,000,000
											</td>
											<td>
												oke
											</td>
										</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
						</div>
					</div>
					<div class='tab-pane fade' id="tab_coverage">
						<ul class="nav nav-tabs">
							<li class='active'>
								<a href="#tab_content_medicalcoverage" id="tab_id_medicalcoverage" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Medical
								</a>
							</li>
							<li >
								<a href="#tab_content_glassescoverage" id="tab_id_glassescoverage" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Glasses
								</a>
							</li>
							<li >
								<a href="#tab_content_hospitalcoverage" id="tab_id_hospitalcoverage" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Hospital
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class='tab-pane fade active in' id="tab_content_medicalcoverage">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filtermedicalcoverage";
	}	
	
	function openformmedical(){
		var a = document.getElementById("medical").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filtermedicalcoverage" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformmedical()">Advanced Search</button>
<div class="form-body" style="display:none;" id='medical'>
	<h3 class="form-section">Medical Coverage</h3>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Medical Coverage Name</label>
				<select name="medical_coverage_id" id="medical_coverage_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Coverage 2</option>
<option value="2">Coverage 3</option>
<option value="3">Coverage 1</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeemedicalcoverage">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Period
						</th>
						<th>
							Amount
						</th>
						<th>
							Claimed
						</th>
						<th>
							Last Balance
						</th>
					</tr>
					</thead>
					<tbody>
					
								<tr>									
									<td>Coverage 2</td>
									<td style='text-align:right'>201501</td>
									<td style='text-align:right'>5,000</td>
									<td style='text-align:right'>4,000</td>
									<td style='text-align:right'>1,000</td>
								</tr>
							
								<tr>									
									<td>Coverage 3</td>
									<td style='text-align:right'>201501</td>
									<td style='text-align:right'>1,600,000</td>
									<td style='text-align:right'>0</td>
									<td style='text-align:right'>1,600,000</td>
								</tr>
							
								<tr>									
									<td>Coverage 3</td>
									<td style='text-align:right'>2016</td>
									<td style='text-align:right'>1,000,000</td>
									<td style='text-align:right'>0</td>
									<td style='text-align:right'>1,000,000</td>
								</tr>
												</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_glassescoverage">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterglassescoverage";
	}	
	
	function openformglasses(){
		var a = document.getElementById("glasses").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filterglassescoverage" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformglasses()">Advanced Search</button>
<div class="form-body" style="display:none;" id='glasses'>
	<h3 class="form-section">Glasses Coverage</h3>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Glasses Coverage Name</label>
				<select name="glasses_coverage_id" id="glasses_coverage_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Glasses2</option>
<option value="2">Glasses1</option>
<option value="3">Glasses3</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeglassescoverage">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Period
						</th>
						<th>
							Amount
						</th>
						<th>
							Claimed
						</th>
						<th>
							Last Balance
						</th>
					</tr>
					</thead>
					<tbody>
					
									<tr>									
										<td>Glasses2</td>
										<td style='text-align:right'>201502</td>
										<td style='text-align:right'>1,000,000</td>
										<td style='text-align:right'>1,350,000</td>
										<td style='text-align:right'>650,000</td>
									</tr>
								
									<tr>									
										<td>Glasses2</td>
										<td style='text-align:right'>2016</td>
										<td style='text-align:right'>555</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>555</td>
									</tr>
								
									<tr>									
										<td>Glasses2</td>
										<td style='text-align:right'>2016</td>
										<td style='text-align:right'>555</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>555</td>
									</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_hospitalcoverage">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterhospitalcoverage";
	}	
	
	function openformhospital(){
		var a = document.getElementById("hospital").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filterhospitalcoverage" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformhospital()">Advanced Search</button>
<div class="form-body" style="display:none;" id='hospital'>
	<h3 class="form-section">Hospital Coverage</h3>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Hospital Coverage Name</label>
				<select name="hospital_coverage_id" id="hospital_coverage_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Hospital3</option>
<option value="2">Hospital1</option>
<option value="3">Hospital2</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeehospitalcoverage">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Period
						</th>
						<th>
							Amount
						</th>
						<th>
							Claimed
						</th>
						<th>
							Last Balance
						</th>
					</tr>
					</thead>
					<tbody>
					
									<tr>									
										<td>Hospital2</td>
										<td style='text-align:right'>201501</td>
										<td style='text-align:right'>10,000</td>
										<td style='text-align:right'>1,000</td>
										<td style='text-align:right'>9,000</td>
									</tr>
								
									<tr>									
										<td>Hospital3</td>
										<td style='text-align:right'>2016</td>
										<td style='text-align:right'>99</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>99</td>
									</tr>
								
									<tr>									
										<td>Hospital3</td>
										<td style='text-align:right'>2016</td>
										<td style='text-align:right'>99</td>
										<td style='text-align:right'>0</td>
										<td style='text-align:right'>99</td>
									</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
						</div>
					</div>
					<div class='tab-pane fade' id="tab_competencies">
						<ul class="nav nav-tabs">
							<li class='active'>
								<a href="#tab_content_education" id="tab_id_education" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Education
								</a>
							</li>
							<li >
								<a href="#tab_content_expertise" id="tab_id_expertise" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Expertise
								</a>
							</li>
							<li >
								<a href="#tab_content_language" id="tab_id_language" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Language
								</a>
							</li>
							<li >
								<a href="#tab_content_workingexperience" id="tab_id_workingexperience" onclick="setselectedtab(this.id)" data-toggle="tab">
									 Experience
								</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class='tab-pane fade active in' id="tab_content_education">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filtereducation";
	}	
	
	function openform8(){
		var a = document.getElementById("education").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filtereducation" method="post" accept-charset="utf-8" id="myform" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openform8()">Advanced Search</button>
<div class="form-body" style="display:none;" id='education'>
	<h3 class="form-section">Education</h3>			
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Education Name</label>
				<select name="education_id" id="education_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="3">High School</option>
<option value="4">CCNA</option>
<option value="5">Elementary School</option>
</select>			</div>
		</div>		
	</div>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Education Type</label>
				<select name="education_type" id="education_type", class="form-control select2me">
<option value="0">Formal</option>
<option value="1">Non Formal</option>
</select>			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>
</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeeducation">
					<thead>
					<tr>
						<th>
							Name
						</th>
						<th>
							Type
						</th>
						<th>
							Title
						</th>
						<th>
							City
						</th>
						<th>
							From
						</th>
						<th>
							To
						</th>
						<th>
							Duration
						</th>
						<th>
							Status
						</th>
						<th>
							Certificate
						</th>
					</tr>
					</thead>
					<tbody>
					
									<tr>									
										<td>High School</td>
										<td>Formal</td>
										<td>Sma</td>
										<td>Solo</td>
										<td style='text-align:right;'>201201</td>
										<td style='text-align:right;'>201501</td>
										<td style='text-align:right;'>3.00</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_expertise">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterexpertise";
	}	
	
	function openformexpertise(){
		var a = document.getElementById("form-expertise").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filterexpertise" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformexpertise()">Advanced Search</button>
<div class="form-body" style="display:none;" id='form-expertise'>
	<h3 class="form-section">Expertise</h3>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Expertise Name</label>
				<select name="expertise_id" id="expertise_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">Bank</option>
<option value="3">PNS</option>
</select>			</div>
		</div>
	</div>		
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Employee Expertise Name</label>
				<input type="text" autocomplete="off"  name="employee_expertise_name" id="employee_expertise_name" value="" class="form-control" placeholder="Employee Expertise Name">
			</div>
		</div>
	</div>		

	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeexpertise">
					<thead>
					<tr>
						<th>Name</th>
						<th>Title</th>
						<th>City</th>
						<th>Start Period</th>
						<th>End Period</th>
						<th>Duration</th>
						<th>Status</th>
						<th>Certificate</th>
					</tr>
					</thead>
					<tbody>
					
									<tr>									
										<td>Bank</td>
										<td>Tax Expertise</td>
										<td>Jakrata</td>
										<td style='text-align:right'>201201</td>
										<td style='text-align:right'>201212</td>
										<td style='text-align:right'>12.00</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
								
									<tr>									
										<td>Bank</td>
										<td>solo</td>
										<td>solo</td>
										<td style='text-align:right'>2015</td>
										<td style='text-align:right'>2016</td>
										<td style='text-align:right'>3.00</td>
										<td>Yes</td>
										<td>Yes</td>
									</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_language">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterlanguage";
	}	
	
	function openformlanguage(){
		var a = document.getElementById("form-language").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filterlanguage" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformlanguage()">Advanced Search</button>
<div class="form-body" style="display:none;" id='form-language'>
	<h3 class="form-section">Language</h3>	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Language Name</label>
				<select name="language_id" id="language_id", class="form-control select2me">
<option value="" selected="selected">--- Choose One ---</option>
<option value="1">English</option>
<option value="2">Indonesia</option>
</select>			</div>
		</div>
	</div>		

	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeelanguage">
					<thead>
					<tr>
						<th>Name</th>
						<th>Listening</th>
						<th>Reading</th>
						<th>Writing</th>
						<th>Speaking</th>
					</tr>
					</thead>
					<tbody>
					
								<tr>									
									<td>English</td>
									<td>Good</td>
									<td>Good</td>
									<td>Good</td>
									<td>Good</td>
								</tr>
								
								<tr>									
									<td>Indonesia</td>
									<td>Standard</td>
									<td>Standard</td>
									<td>Bad</td>
									<td>Bad</td>
								</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
							<div class='tab-pane fade' id="tab_content_workingexperience">
								<div class="workplace" style="padding:5px !important;"> 
<script>
	base_url = 'http://localhost/HRMS/';	
	function ulang(){
		document.location= base_url+"main/reset_filterexperience";
	}	
	
	function openformexperience(){
		var a = document.getElementById("experience").style;
		if(a.display=="none"){
			a.display = "block";
		}else{
			a.display = "none";
		}
	}
</script>
<form action="http://localhost/HRMS/main/filterexperience" method="post" accept-charset="utf-8" class="horizontal-form"><button class="btn btn-success" type="button" id='btn-change' onClick="openformexperience()">Advanced Search</button>
<div class="form-body" style="display:none;" id='experience'>
	<h3 class="form-section">Working Experience</h3>		
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">Start Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="start_period" id="start_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label">End Period</label>
				<div class="input-group date date-picker" data-date-format="yyyy-mm">
					<input name="end_period" id="end_period" type="text" class="form-control" value="2017-03" readonly>
					<span class="input-group-btn">
						<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
					</span>
				</div>	
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">Company Name</label>
				<input type="text" autocomplete="off"  name="company_name" id="company_name" value="" class="form-control" placeholder="Company Name">
			</div>
		</div>
	</div>		
	<div class="row">
		<div class="form-actions right">
			<button type="button" class="btn red" onClick="ulang();"><i class="fa fa-times"></i> Reset</button>
			<button type="submit" class="btn blue"><i class="fa fa-check"></i> Filter</button>
		</div>
	</div>
</div>

</form><div class="form-body form">
	<div class="form-body">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<table class="table table-striped table-bordered table-hover table-full-width" id="hroemployeeworkingexperience">
					<thead>
					<tr>
						<th>
							Company Name
						</th>
						<th>
							Company Address
						</th>
						<th>
							Job Title
						</th>
						<th>
							From
						</th>
						<th>
							To
						</th>
						<th>
							Last Salary
						</th>
						<th>
							Reason
						</th>
						<th>
							Letter
						</th>
						<th>
							Remark
						</th>
					</tr>
					</thead>
					<tbody>
					
									<tr>									
									<td>PT. ABC</td>
									<td>Solo</td>
									<td>Staff</td>
									<td>2014</td>
									<td>2015</td>
									<td>2,000,000</td>
									<td>gaji kurang</td>
									<td>Yes</td>
									<td></td>
									</tr>
								
									<tr>									
									<td>PT Java Abadi</td>
									<td>Purwasari</td>
									<td>SPV</td>
									<td>2010</td>
									<td>2015</td>
									<td>3,500,000</td>
									<td>oke</td>
									<td>Yes</td>
									<td>oke</td>
									</tr>
								
									<tr>									
									<td>XXX</td>
									<td>XXX</td>
									<td>XXX</td>
									<td>2016</td>
									<td>2016</td>
									<td>10,000</td>
									<td>XXX</td>
									<td>Yes</td>
									<td>XXXX</td>
									</tr>
													</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</div>
</form>							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Portlet PORTLET-->
	</div>
</div>

<!-- BEGIN FORM-->
<form action="http://localhost/HRMS/main/filter" method="post" accept-charset="utf-8" id="myform" class="horizontal-form">	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="mainsearch" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Search Employee</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Employee Name</label>
							<input type="text" autocomplete="off"  name="filter_employee_name" id="filter_employee_name" class="form-control" placeholder="Name" value="">
						</div>
					</div>
				<div class="modal-footer">
					<a href="main/reset_filter" class="btn red">
						<i class="fa fa-times"></i> Reset Search
					</a>
					<button type="submit" class="btn blue"><i class="fa fa-search"></i> Search Data</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->

	<!-- /.modal -->
	<div class="modal fade bs-modal-lg" id="mainfilter" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Filter Employee</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label>Employee Name</label>
							<div class="radio-list">
								<label class="radio-inline">
								<input type="radio" name="sort_employee_name" id="optionsRadios4" value="asc" > Ascending </label>
								<label class="radio-inline">
								<input type="radio" name="sort_employee_name" id="optionsRadios5" value="desc" > Descending </label>
								<label class="radio-inline">
								<input type="radio" name="sort_employee_name" id="optionsRadios6" value="" checked> None </label>
							</div>
						</div>
					</div>
				<div class="modal-footer">
					<a href="main/reset_filter" class="btn red">
						<i class="fa fa-times"></i> Reset Filter
					</a>
					<button type="submit" class="btn blue"><i class="fa fa-search"></i> Filter Data</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
</div>
	<!-- /.modal -->
</form>                    </div>
                    <!-- END CONTENT BODY -->
                </div>
            <!-- BEGIN FOOTER -->
			<div class="page-footer">
                <div class="page-footer-inner"> 2016 &copy; Metronic Theme By
                    <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
                    <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a>
                </div>
                <div class="scroll-to-top">
                    <i class="icon-arrow-up"></i>
                </div>
            </div>
            <!-- END FOOTER -->
        </div>
        <!-- END QUICK NAV -->
        <!--[if lt IE 9]>
<script src="../assets/global/plugins/respond.min.js"></script>
<script src="../assets/global/plugins/excanvas.min.js"></script> 
<script src="../assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
        <!-- BEGIN CORE PLUGINS -->
        <script src="http://localhost/HRMS/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="http://localhost/HRMS/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="http://localhost/HRMS/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="http://localhost/HRMS/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
    </body>

</html>