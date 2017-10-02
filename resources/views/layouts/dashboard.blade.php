<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Lockbox</title>

    <!-- Import google fonts - Heading first/ text second -->
    <!--<link rel='stylesheet' type='text/css' href='http://fonts.useso.com/css?family=Open+Sans:400,700|Droid+Sans:400,700' />-->
    <!--[if lt IE 9]>
    <!--<link href="http://fonts.useso.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.useso.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
    <link href="http://fonts.useso.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
    <link href="http://fonts.useso.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
    <![endif]-->


    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="{{ asset('cssnew/assets/ico/favicon.ico') }}" type="image/x-icon"/>

    <!-- Css files -->
    <link href="{{ asset('cssnew/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/jquery.mmenu.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/climacons-font.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/xcharts/css/xcharts.min.css') }}" rel=" stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/morris/css/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/jquery-ui/css/jquery-ui-1.10.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/jvectormap/css/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/css/add-ons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('cssnew/assets/plugins/dropzone/css/dropzone.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    {{--<!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->--}}
    {{--<!--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->--}}
    <![endif]-->
    <script>
        window.onload = function() {
            var all_atag = document.querySelectorAll(".nav.nav-sidebar li a");
            var new_str = String(window.location.pathname).replace(/\/\d+/, "");
            console.log(new_str);
            for(var i = 0; i < all_atag.length; i ++) {
                if(new_str == all_atag[i].pathname) {
                    all_atag[i].parentNode.setAttribute("class", "active opened");
                }
            }
        }
    </script>

    @yield('head')

</head>
<body>
<!-- header -->
<div class="navbar" role="navigation">
    <div class="container-fluid">

        <ul class="nav navbar-nav navbar-actions navbar-left">
            <li class="visible-md visible-lg"><a id="main-menu-toggle"><i class="fa fa-th-large"></i></a></li>
            <li class="visible-xs visible-sm"><a id="sidebar-menu"><i class="fa fa-navicon"></i></a></li>
        </ul>

        {{--<form class="navbar-form navbar-left">--}}
            {{--<button type="submit" class="fa fa-search"></button>--}}
            {{--<input type="text" class="form-control" placeholder="Search..."></a>--}}
        {{--</form>--}}

        {{--<div class="copyrights">--}}
            {{--Collect from--}}
            {{--<a href="http://greenbay.usc.edu/csci577/fall2016/projects/team10">Team10</a>--}}
        {{--</div>--}}
        <ul class="nav navbar-nav navbar-right">
            {{--<li class="dropdown visible-md visible-lg">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i><span--}}
                            {{--class="badge">5</span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li class="dropdown-menu-header">--}}
                        {{--<strong>Messages</strong>--}}
                        {{--<div class="progress thin">--}}
                            {{--<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="30"--}}
                                 {{--aria-valuemin="0" aria-valuemax="100" style="width: 30%">--}}
                                {{--<span class="sr-only">30% Complete (success)</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li class="avatar">--}}
                        {{--<a href="page-inbox.html">--}}
                            {{--<img class="avatar" src="{{ asset('cssnew/assets/img/avatar1.jpg') }}">--}}
                            {{--<div>New message</div>--}}
                            {{--<small>1 minute ago</small>--}}
                            {{--<span class="label label-info">NEW</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="avatar">--}}
                        {{--<a href="page-inbox.html">--}}
                            {{--<img class="avatar" src="{{ asset('cssnew/assets/img/avatar2.jpg') }}">--}}
                            {{--<div>New message</div>--}}
                            {{--<small>3 minute ago</small>--}}
                            {{--<span class="label label-info">NEW</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="avatar">--}}
                        {{--<a href="page-inbox.html">--}}
                            {{--<img class="avatar" src="{{ asset('cssnew/assets/img/avatar3.jpg') }}">--}}
                            {{--<div>New message</div>--}}
                            {{--<small>4 minute ago</small>--}}
                            {{--<span class="label label-info">NEW</span>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="avatar">--}}
                        {{--<a href="page-inbox.html">--}}
                            {{--<img class="avatar" src="{{ asset('cssnew/assets/img/avatar4.jpg') }}">--}}
                            {{--<div>New message</div>--}}
                            {{--<small>30 minute ago</small>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="avatar">--}}
                        {{--<a href="page-inbox.html">--}}
                            {{--<img class="avatar" src="{{ asset('cssnew/assets/img/avatar5.jpg') }}">--}}
                            {{--<div>New message</div>--}}
                            {{--<small>1 hours ago</small>--}}
                        {{--</a>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown-menu-footer text-center">--}}
                        {{--<a href="page-inbox.html">View all messages</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="dropdown visible-md visible-lg">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span--}}
                            {{--class="badge">3</span></a>--}}
                {{--<ul class="dropdown-menu">--}}
                    {{--<li class="dropdown-menu-header">--}}
                        {{--<strong>Notifications</strong>--}}
                        {{--<div class="progress thin">--}}
                            {{--<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="30"--}}
                                 {{--aria-valuemin="0" aria-valuemax="100" style="width: 30%">--}}
                                {{--<span class="sr-only">30% Complete (success)</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    {{--<li class="clearfix">--}}
                        {{--<i class="fa fa-comment"></i>--}}
                        {{--<a href="page-activity.html" class="notification-user"> Sharon Rose </a>--}}
                        {{--<span class="notification-action"> replied to your </span>--}}
                        {{--<a href="page-activity.html" class="notification-link"> comment</a>--}}
                    {{--</li>--}}
                    {{--<li class="clearfix">--}}
                        {{--<i class="fa fa-pencil"></i>--}}
                        {{--<a href="page-activity.html" class="notification-user"> Nadine </a>--}}
                        {{--<span class="notification-action"> just write a </span>--}}
                        {{--<a href="page-activity.html" class="notification-link"> post</a>--}}
                    {{--</li>--}}
                    {{--<li class="clearfix">--}}
                        {{--<i class="fa fa-trash-o"></i>--}}
                        {{--<a href="page-activity.html" class="notification-user"> Lorenzo </a>--}}
                        {{--<span class="notification-action"> just remove <a href="#"--}}
                                                                          {{--class="notification-link"> 12 files</a></span>--}}
                    {{--</li>--}}
                    {{--<li class="dropdown-menu-footer text-center">--}}
                        {{--<a href="page-activity.html">View all notification</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li class="dropdown visible-md visible-lg">
                <a id="cur_email" href="#" class="dropdown-toggle" data-toggle="dropdown"><img class="user-avatar"
                                                                                               src="{{ asset('cssnew/assets/img/avatar.png') }}"
                                                                                               alt="user-mail">{{@Sentinel::getUser()->email ? : "Not exists."}}
                </a>
                <ul class="dropdown-menu">
                    {{--<li class="dropdown-menu-header">--}}
                        {{--<strong>Account</strong>--}}
                    {{--</li>--}}
                    {{--<li><a href="page-profile.html"><i class="fa fa-user"></i> Profile</a></li>--}}
                    {{--<li><a href="page-login.html"><i class="fa fa-wrench"></i> Settings</a></li>--}}
                    {{--<li><a href="page-invoice.html"><i class="fa fa-usd"></i> Payments <span--}}
                                    {{--class="label label-default">10</span></a></li>--}}
                    {{--<li><a href="gallery.html"><i class="fa fa-file"></i> File <span--}}
                                    {{--class="label label-primary">27</span></a></li>--}}
                    {{--<li class="divider"></li>--}}
                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </li>
            <li><a href="{{ url('/logout') }}"><i class="fa fa-power-off"></i></a></li>
        </ul>
    </div>
</div>
<!-- end header -->

<div class="container-fluid content">

    <div class="row">
        <!-- main menu -->
        <div class="sidebar ">

            <div class="sidebar-collapse">
                <!-- logo on side bar -->
                <div class="t-center" style="background-color: white">
                    <span><a href="{{url('/')}}"><img class="text-logo" style="width: 60%; margin-left: 20%"
                                                      src="{{ asset('cssnew/assets/img/newlogo.png') }}"></a></span>
                </div>
                <!-- menu on side bar -->
                <?php if ($user = Sentinel::check()) {
                    $admin = Sentinel::findRoleByName('Admins');
                    $manager = Sentinel::findRoleByName('Managers');
                    $staff = Sentinel::findRoleByName('Staff');
                    $youth = Sentinel::findRoleByName('Youths');
                } ?>
                @if($user->inRole($admin))
                    <div class="sidebar-menu">
                        <ul class="nav nav-sidebar">
                            <li>
                                <a href="{{ url('admin') }}"><i class="fa fa-laptop"></i><span
                                            class="text"> Dashboard</span></a>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-user"></i><span class="text"> User Management</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block;">
                                    <li><a href="{{ url('admin/user/create') }}"><i class="fa fa-plus-circle"></i><span
                                                    class="text"> Create User</span></a></li>
                                    <li><a href="{{ url('admin/user/view') }}"><i class="fa fa-list"></i><span
                                                    class="text"> View Users</span></a></li>
                                </ul>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-folder"></i><span class="text"> Case Management</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block;">
                                    <li><a href="{{ url('admin/case/create') }}"><i class="fa fa-plus-circle"></i><span
                                                    class="text"> Create Case</span></a>
                                    </li>
                                    <li><a href="{{ url('admin/case/view') }}"><i class="fa fa-list"></i><span
                                                    class="text"> View Cases</span></a></li>
                                    </li>
                                </ul>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-gears"></i><span class="text"> Settings</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block">
                                    <li><a href="{{ url('admin/settings/program') }}"><i class="fa fa-gear"></i><span
                                                    class="text"> Program Settings</span></a></li>
                                    </li>
                                    <li><a href="{{ url('admin/settings/doctype') }}"><i class="fa fa-gear"></i><span
                                                    class="text"> Document Settings</span></a></li>
                                    </li>
                                    <li><a href="{{ url('admin/settings/password') }}"><i class="fa fa-gear"></i><span
                                                    class="text"> Reset Password</span></a></li>
                                    </li>
                                    <li><a href="{{ url('admin/settings/survey') }}"><i class="fa fa-gear"></i><span
                                                    class="text"> Survey Settings</span></a></li>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @elseif($user->inRole($manager))
                    <div class="sidebar-menu">
                        <ul class="nav nav-sidebar">
                            <li>
                                <a href="{{ url('manager') }}"><i class="fa fa-laptop"></i><span
                                            class="text"> Dashboard</span></a>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-user"></i><span class="text"> User Management</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block;">
                                    <li><a href="{{ url('manager/user/view') }}"><i class="fa fa-list"></i><span
                                                    class="text"> View Users</span></a></li>
                                </ul>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-folder"></i><span class="text"> Case Management</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block;">
                                    <li><a href="{{ url('manager/case/create') }}"><i class="fa fa-plus-circle"></i><span
                                                    class="text"> Create Case</span></a>
                                    </li>
                                    <li><a href="{{ url('manager/case/view') }}"><i class="fa fa-list"></i><span
                                                    class="text"> View Cases</span></a></li>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    {{--<div class="sidebar-menu">--}}
                        {{--<ul class="nav nav-sidebar">--}}
                            {{--<li>--}}
                                {{--<a href="#"><i class="fa fa-laptop"></i><span--}}
                                            {{--class="text"> Dashboard</span> <span--}}
                                            {{--class="fa fa-angle-down pull-right"></span></a>--}}
                                {{--<ul class="nav sub">--}}
                                    {{--<li><a href="{{ url('manager') }}"><i class="fa fa-plus-circle"></i><span--}}
                                                    {{--class="text"> Activities</span></a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"><i class="fa fa-user"></i><span class="text"> User Management</span> <span--}}
                                            {{--class="fa fa-angle-down pull-right"></span></a>--}}
                                {{--<ul class="nav sub">--}}
                                    {{--<li><a href="{{ url('manager/user/view') }}"><i class="fa fa-list"></i><span--}}
                                                    {{--class="text"> View Users</span></a></li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"><i class="fa fa-folder"></i><span class="text"> Case Management</span> <span--}}
                                            {{--class="fa fa-angle-down pull-right"></span></a>--}}
                                {{--<ul class="nav sub">--}}
                                    {{--<li><a href="{{ url('manager/case/create') }}"><i--}}
                                                    {{--class="fa fa-plus-circle"></i><span--}}
                                                    {{--class="text"> Create Case</span></a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="{{ url('manager/case/view') }}"><i class="fa fa-list"></i><span--}}
                                                    {{--class="text"> View Cases</span></a></li>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                                {{--<a href="#"><i class="fa fa-folder"></i><span class="text"> Shortcut</span> <span--}}
                                            {{--class="fa fa-angle-down pull-right"></span></a>--}}
                                {{--<ul class="nav sub">--}}
                                    {{--<li><a href="#"><i class="fa fa-list"></i><span class="text"> Other</span></a></li>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                @elseif($user->inRole($staff))
                    <div class="sidebar-menu">
                        <ul class="nav nav-sidebar">
                            <li>
                                <a href="{{ url('staff') }}"><i class="fa fa-laptop"></i><span
                                            class="text"> Dashboard</span></a>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-user"></i><span class="text"> User Management</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block;">
                                    <li><a href="{{ url('staff/user/view') }}"><i class="fa fa-list"></i><span
                                                    class="text"> View Users</span></a></li>
                                </ul>
                            </li>
                            <li class="opened">
                                <a><i class="fa fa-folder"></i><span class="text"> Case Management</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub" style="display: block;">
                                    <li><a href="{{ url('staff/case/view') }}"><i class="fa fa-list"></i><span
                                                    class="text"> View Cases</span></a></li>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @elseif($user->inRole($youth))
                    <div class="sidebar-menu">
                        <ul class="nav nav-sidebar">
                            <li><a href=""><i class="fa fa-laptop"></i><span class="text"> Dashboard</span></a></li>
                            <li>
                                <a href="#"><i class="fa fa-file-text"></i><span class="text"> Youth</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub">
                                    <li><a href="page-activity.html"><i class="fa fa-car"></i><span class="text"> Activity</span></a>
                                    </li>
                                    <li><a href="page-inbox.html"><i class="fa fa-envelope"></i><span
                                                    class="text"> Mail</span></a></li>
                                    <li><a href="page-invoice.html"><i class="fa fa-credit-card"></i><span class="text"> Invoice</span></a>
                                    </li>
                                    <li><a href="page-profile.html"><i class="fa fa-heart-o"></i><span class="text"> Profile</span></a>
                                    </li>
                                    <li><a href="page-pricing-tables.html"><i class="fa fa-columns"></i><span
                                                    class="text"> Pricing Tables</span></a></li>
                                    <li><a href="page-404.html"><i class="fa fa-puzzle-piece"></i><span class="text"> 404</span></a>
                                    </li>
                                    <li><a href="page-500.html"><i class="fa fa-puzzle-piece"></i><span class="text"> 500</span></a>
                                    </li>
                                    <li><a href="page-lockscreen.html"><i class="fa fa-lock"></i><span class="text"> LockScreen1</span></a>
                                    </li>
                                    <li><a href="page-lockscreen2.html"><i class="fa fa-lock"></i><span class="text"> LockScreen2</span></a>
                                    </li>
                                    <li><a href="page-login.html"><i class="fa fa-key"></i><span class="text"> Login Page</span></a>
                                    </li>
                                    <li><a href="page-register.html"><i class="fa fa-sign-in"></i><span class="text"> Register Page</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-list-alt"></i><span class="text"> Forms</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub">
                                    <li><a href="form-elements.html"><i class="fa fa-indent"></i><span class="text"> Form elements</span></a>
                                    </li>
                                    <li><a href="form-wizard.html"><i class="fa fa-tags"></i><span
                                                    class="text"> Wizard</span></a></li>
                                    <li><a href="form-dropzone.html"><i class="fa fa-plus-square-o"></i><span
                                                    class="text"> Dropzone Upload</span></a></li>
                                    <li><a href="form-x-editable.html"><i class="fa fa-pencil"></i><span class="text"> X-editable</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="table.html"><i class="fa fa-table"></i><span class="text"> Tables</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-signal"></i><span class="text"> Visual Chart</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub">
                                    <li><a href="chart-flot.html"><i class="fa fa-random"></i><span class="text"> Flot Chart</span></a>
                                    </li>
                                    <li><a href="chart-xchart.html"><i class="fa fa-retweet"></i><span class="text"> xChart</span></a>
                                    </li>
                                    <li><a href="chart-other.html"><i class="fa fa-bar-chart-o"></i><span class="text"> Other</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-briefcase"></i><span class="text"> UI Features</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub">
                                    <li><a href="ui-sliders-progress.html"><i class="fa fa-align-left"></i><span
                                                    class="text"> Progress</span></a></li>
                                    <li><a href="ui-nestable-list.html"><i class="fa fa-outdent"></i><span class="text"> Nestable Lists</span></a>
                                    </li>
                                    <li><a href="ui-elements.html"><i class="fa fa-list"></i><span class="text"> Elements</span></a>
                                    </li>
                                    <li><a href="ui-panels.html"><i class="fa fa-list-alt"></i><span class="text"> Panels</span></a>
                                    </li>
                                    <li><a href="ui-buttons.html"><i class="fa fa-th"></i><span
                                                    class="text"> Buttons</span></a></li>
                                </ul>
                            </li>
                            <li><a href="widgets.html"><i class="fa fa-life-bouy"></i><span class="text"> Widgets</span></a>
                            </li>
                            <li><a href="typography.html"><i class="fa fa-font"></i><span
                                            class="text"> Typography</span></a></li>
                            <li>
                                <a href="#"><i class="fa fa-bolt"></i><span class="text"> Icons</span> <span
                                            class="fa fa-angle-down pull-right"></span></a>
                                <ul class="nav sub">
                                    <li><a href="icons-font-awesome.html"><i class="fa fa-meh-o"></i><span class="text"> Font Awesome</span></a>
                                    </li>
                                    <li><a href="icons-climacons.html"><i class="fa fa-meh-o"></i><span class="text"> Climacons</span></a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="gallery.html"><i class="fa fa-picture-o"></i><span class="text"> Gallery</span></a>
                            </li>
                            <li><a href="calendar.html"><i class="fa fa-calendar"></i><span
                                            class="text"> Calendar</span></a></li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="sidebar-footer">

                <div class="sidebar-brand">
                    e-Lockbox
                </div>

                <ul class="sidebar-terms">
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Help</a></li>
                    <li><a href="#">About</a></li>
                </ul>

                <div class="copyright text-center">
                    <small><i class="fa fa-cube"></i> e-Lockbox from <a
                                href="http://greenbay.usc.edu/csci577/fall2016/projects/team10/" title="Team 10"
                                target="_blank">USC Team10</a></small>
                </div>
            </div>

        </div>
        <!-- end main menu -->
        <div class="main">
            @yield('content')
        </div>
    </div>

</div>

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Warning Title</h4>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="clearfix"></div>


<!-- start: JavaScript-->
<!--[if !IE]>-->

<script src="{{ asset('cssnew/assets/js/jquery-2.1.1.min.js') }}"></script>

<!--<![endif]-->

<!--[if IE]>

<script src="{{ asset('cssnew/assets/js/jquery-1.11.1.min.js') }}"></script>

<![endif]-->

<!--[if !IE]>-->

<script type="text/javascript">
    window.jQuery || document.write("<script src='{{ asset('cssnew/assets/js/jquery-2.1.1.min.js') }}'>" + "<" + "/script>");
</script>

<!--<![endif]-->

<!--[if IE]>

<script type="text/javascript">
    window.jQuery || document.write("<script src='{{ asset('cssnew/assets/js/jquery-1.11.1.min.js') }}'>" + "<" + "/script>");
</script>

<![endif]-->
<script src="{{ asset('cssnew/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/js/bootstrap.min.js') }}"></script>


<!-- page scripts -->
<script src="{{ asset('cssnew/assets/plugins/jquery-ui/js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/touchpunch/jquery.ui.touch-punch.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/fullcalendar/js/fullcalendar.min.js') }}"></script>
<!--[if lte IE 8]>
<script language="javascript" type="text/javascript"
        src="{{ asset('cssnew/assets/plugins/excanvas/excanvas.min.js') }}"></script>
<![endif]-->
<script src="{{ asset('cssnew/assets/plugins/flot/jquery.flot.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/flot/jquery.flot.pie.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/flot/jquery.flot.stack.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/flot/jquery.flot.resize.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/flot/jquery.flot.time.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/flot/jquery.flot.spline.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/xcharts/js/xcharts.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/autosize/jquery.autosize.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/placeholder/jquery.placeholder.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/datatables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/morris/js/morris.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/jvectormap/js/gdp-data.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/gauge/gauge.min.js') }}"></script>


<!-- theme scripts -->
<script src="{{ asset('cssnew/assets/js/SmoothScroll.js') }}"></script>
<script src="{{ asset('cssnew/assets/js/jquery.mmenu.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/js/core.min.js') }}"></script>
<script src="{{ asset('cssnew/assets/plugins/d3/d3.min.js') }}"></script>

<!-- inline scripts related to this page -->
<script src="{{ asset('cssnew/assets/js/pages/index.js') }}"></script>

<!-- end: JavaScript-->
</body>
</html>