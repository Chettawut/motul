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
    <title>รายงานการขายรายพัสดุ</title>
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
                                <i class="fa fa-bar-chart"></i>
                                <h3 class="box-title">รายงานการขายรายพัสดุ</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form class="form-inline" onsubmit="return false;">
                                    <!-- <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button> -->
                                    <div class="input-group">
                                        <input id="select_stock" name="select_stock" type="text" class="form-control"
                                            id="exampleInputEmail1" placeholder="รหัสพัสดุ">
                                        <span class=" input-group-btn"><button class="btn btn-default"
                                                data-toggle="modal" data-target="#modal_one" type="button"><span
                                                    class="fa fa-search"></span></button></span>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="select_place" name="select_place"
                                            style="width: 100%;">
                                            <option value="ALL">ทั้งหมด</option>
                                            <option value="1">คลัง A</option>
                                            <option value="2">คลัง B</option>
                                            <option value="3">คลัง C</option>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <select class="form-control" id="vat" name="vat" style="width: 100%;">
                                            <option value="Y">มี VAT</option>
                                            <option value="N">ไม่มี VAT</option>
                                        </select>
                                    </div> -->

                                </form>


                                <br>


                                <br>
                                <!-- Tab panes -->
                                <div class="tab-content" style="text-align:center">
                                    <table name="table_sale" id="table_sale" class="table">
                                        <thead>
                                            <tr>
                                                <!-- <th>ลำดับที่</th> -->
                                                <th style="text-align:center;">เลขที่ใบขาย</th>
                                                <th>วันที่ขาย</th>
                                                <th>รหัสพัสดุ</th>
                                                <th>ชื่อพัสดุ</th>
                                                <th>ชื่อลูกค้า</th>
                                                <th>จำนวน</th>
                                                <th>หน่วย</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>

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

        <div class="modal fade bs-example-modal-lg" id="modal_one" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกรหัสพัสดุ</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_id" name="table_id" class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสลูกค้า</th>
                                                <th>ชื่อลูกค้า</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
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