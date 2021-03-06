<?php
// Start the session
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../');
    exit;
}
	?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>รายงานใบกำกับภาษีขายรายปี</title>
    <?php include('css.php'); 
    include_once('../../config.php');
    include_once ROOT .'/func.php';
    include_once ROOT .'/index_css.php';
    ?>
</head>

<body class="hold-transition skin-red sidebar-mini">
    <div class="wrapper">

        <?php include_once ROOT . '/menu_head.php'; ?>
        <!-- Left side column. contains the logo and sidebar -->

        <?php include_once ROOT . '/menu_left.php'; ?>

        <!-- --------------------------------------- body ----------------------------------------------- -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    รายงาน
                    <small>Report</small>
                </h1>
                <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-bar-chart"></i> Report</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cube"></i>
                                <h3 class="box-title">รายงานใบกำกับภาษีขายรายปี</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form class="form-inline" onsubmit="return false;">
                                    <!-- <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button> -->
                                    <div class="form-group">
                                        <select class="form-control" id="select_year" name="select_year"
                                            style="width: 100%;">
                                            <?php 
												$year=date("Y")+543;
												for($count=0;$count<5;$count++)
												echo '<option value="'.$year.'" >ปี '.$year--.'</option>'                    
											?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="vat" name="vat" style="width: 100%;">
                                            <option value="Y">มี VAT</option>
                                            <option value="N">ไม่มี VAT</option>
                                        </select>
                                    </div>

                                </form>


                                <br>
                                <!-- Tab panes -->
                                <div class="tab-content" style="text-align:center">
                                    <table id="table_saleyear" class="table table-hover" >
                                        <thead>

                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                    <div id="chart-container">กรุณารอ กำลังประมวลผลกราฟ</div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>



        <?php include_once ROOT .'/menu_footer.php'; ?>

        <div class="control-sidebar-bg"></div>
    </div>

    <?php 
    
    include_once ROOT.'/index_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>