<?php
// Start the session
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../');
    exit;
}
	?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>หน้าข่าวสาร</title>
    <?php include('index_css.php');?>
</head>

<body class="hold-transition skin-red sidebar-mini" style="background-color: #e6001a;">
    <div class="wrapper">

        <?php include_once('menu_head.php'); ?>
        <!-- Left side column. contains the logo and sidebar -->
        
        <?php include_once('menu_left.php'); ?>

        <!-- --------------------------------------- body ----------------------------------------------- -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Dashboard
                    <small>Control panel</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
        
            </section>
            <!-- /.content -->
        </div>
        <?php include('menu_footer.php'); ?>
        
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <?php include('index_js.php');?>
</body>
</html>