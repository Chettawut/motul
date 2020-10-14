<?php
include_once('config.php'); 
?>
<header class="main-header">
            <!-- Logo -->
            <a href="<?php echo PATH; ?>" class="logo" style="background-color: #e6001a;">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="<?php echo PATH; ?>/img/logo.jpg"  width="50px;"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="<?php echo PATH; ?>/img/logo.jpg"  width="100px;"> </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" style="background-color: #e6001a;">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">                        
                            
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo PATH; ?>/img/admin.png" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php echo PATH; ?>/img/admin.png" class="img-circle" alt="User Image">

                                    <p>
                                    <?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?> <br><?php echo $_SESSION['type']; ?>
                                        <small>Member since Apr. 2019</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Edit Profile</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Change Password</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                </li> -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <!-- <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div> -->
                                    <div style="text-align:center;">
                                    <a class="btn btn-default btn-flat" href="<?php echo PATH_CSS; ?>/logout.php"><i class="fa fa-sign-out  text-white"></i> <span>Log Out</span></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

                
            </nav>
        </header>