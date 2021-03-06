<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url(); ?>#/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class=" logo-mini"> <img style="padding-bottom:5px;"   width="35px" height="35px" src="<?php echo base_url(); ?>assets/ico/1154494.png" class=""> </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
        <!--<img   height="35px" src="<?php echo base_url(); ?>assets/ico/bizi-logo.png" class="">-->
            <img style="padding-bottom:5px;"  width="35px" height="35px" src="<?php echo base_url(); ?>assets/ico/1154494.png" class="">
            <span class="hidden" style="padding-left:3px; font-size: 23px;"><b>CBL</b></span>
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" id="toggle-button" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="hidden dropdown messages-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>
                        <span class="label label-success">4</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 4 messages</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- start message -->
                                    <a href="#">
                                        <div class="pull-left">
                                            <img src="<?php echo base_url(); ?>assets/admin/dist/img/user.png" class="img-circle" alt="User Image">
                                        </div>
                                        <h4>
                                            Support Team
                                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                        </h4>
                                        <p>Some msg</p>
                                    </a>
                                </li><!-- end message -->
                            </ul>
                        </li>
                        <li class="footer"><a href="#">See All Messages</a></li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="hidden dropdown notifications-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="hidden dropdown tasks-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        <span class="label label-danger">9</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 9 tasks</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                <li><!-- Task item -->
                                    <a href="#">
                                        <h3>
                                            Design some buttons
                                            <small class="pull-right">20%</small>
                                        </h3>
                                        <div class="progress xs">
                                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">20% Complete</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="#">View all tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class=" dropdown user user-menu">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?>assets/admin/dist/img/user.png" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $first_name; ?> <?php echo $last_name; ?></span>
                    </a>
                    <ul class="hidden dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo base_url(); ?>assets/admin/dist/img/user.png" class="img-circle" alt="User Image">
                            <p>
                                <?php //echo $first_name; ?> <?php //echo $last_name; ?> - <?php //echo $users_position; ?>
                                <small>Member since Nov. 2012</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                           <div class="col-xs-4 text-center">
                             <a href="#">Followers</a>
                           </div>
                           <div class="col-xs-4 text-center">
                             <a href="#">Sales</a>
                           </div>
                           <div class="col-xs-4 text-center">
                             <a href="#">Friends</a>
                           </div>
                         </li>-->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url(); ?>/admin/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li class="hidden hidden-xs">
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
                <li class="">
                    <a href="<?php echo base_url(); ?>/admin/logout" title="Logout"><i class="fa fa-power-off"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>