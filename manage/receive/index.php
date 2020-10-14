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
    <title>ระบบรับสินค้า (Receive)</title>
    <?php include('css.php'); 
    include_once('../config.php');
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
                    Store
                    <small>ระบบรับสินค้า</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-truck"></i> ระบบรับสินค้า</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                    <form action="invoice-print.php" method="post" target="_blank">
                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-truck"></i>
                                <h3 id="txtHead" class="box-title">ระบบรับสินค้า (Goods Receive)</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="btn-group" id="btnAddRR" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                            aria-hidden="true"></i>
                                        เพิ่มใบรับสินค้า</button></div>
                                <div class="btn-group" id="btnEditSubmit" style="display:none;" role="group"
                                    aria-label="Basic example">
                                    <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                            aria-hidden="true"></i>
                                        Edit</button></div>
                                <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                    aria-label="Basic example">
                                    <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                            aria-hidden="true"></i>
                                        Back</button></div>
                                <button type="button" id="btnRefresh" class="btn btn-primary"><i class="fa fa-refresh"
                                        aria-hidden="true"></i> </button>
                                        
                                        <button type="submit" id="btnPrint" style="display:none;" class="btn btn-primary"><i class="fa fa-print"
                                            aria-hidden="true"></i>
                                        Print</button>
                                    <input type="hidden" id="printrrcode" class="btn btn-default" name="printrrcode"
                                        value="John"><br><br>


                                </form>
                            </div>
                            <div id="divtableRR" style="border: 1px solid #FAEBD7;">
                                <table name="tableRR" id="tableRR" class="table table-bordered table-striped">
                                    <thead style="background-color:#D6EAF8;">
                                        <tr>

                                            <th  style="width:13%;text-align:center">เลขที่ใบรับ</th>
                                            <th  style="width:10%;text-align:center">วันที่รับ</th>
                                            <th  style="width:12%;text-align:center">รหัสพัสดุ</th>
                                            <th  style="width:29%;text-align:center">รายงานสินค้า</th>
                                            <th  style="width:33%;text-align:center">ผู้ขาย</th>
                                            <th  style="width:3%;text-align:center">สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                            <div id="divfrmRR" style="display:none;">
                                <form name="frmRR" id="frmRR" onkeydown="return event.key != 'Enter';">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">เลขที่ใบรับสินค้า</label>
                                            <input type="text" class="form-control" name="rrcode" id="rrcode" disabled>
                                        </div>
                                        <div class="form-group col-md-6  col-md-offset-2">
                                            <label for="recipient-name" class="col-form-label">วันที่รับสินค้า</label>
                                            <input type="date" class="form-control" size="4" name="rrdate" id="rrdate">
                                        </div>

                                    </div>

                                    <div class="form-group col-md-6">
                                        <label>รหัสผู้ขาย</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="supcode" id="supcode"
                                                disabled>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" data-toggle="modal"
                                                    data-target="#modal_one" type="button"><span
                                                        class="fa fa-search"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">ชื่อผู้ขาย</label>
                                        <input type="text" class="form-control" name="tdname" id="tdname" disabled>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">Invoice No.</label>
                                            <input type="text" class="form-control" name="invcode" id="invcode">
                                        </div>
                                        <div class="form-group col-md-6  col-md-offset-2">
                                            <label for="recipient-name" class="col-form-label">วันที่ออก Invoice</label>
                                            <input type="date" class="form-control" size="4" name="invdate"
                                                id="invdate">
                                        </div>

                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-5">
                                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                            <select class="form-control" name="payment" id="payment">
                                                <option value="เงินสด" selected>เงินสด</option>
                                                <option value="30 วัน">30 วัน</option>
                                                <option value="45 วัน">45 วัน</option>
                                                <option value="60 วัน">60 วัน</option>
                                                <option value="90 วัน">90 วัน</option>
                                                <option value="120 วัน">120 วัน</option>
                                            </select>
                                        </div>
                                    </div>


                                    <hr>
                                    <hr>

                                    <br>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <button type="button" id="btnAddRRdetail" class="btn btn-success"
                                            data-toggle="modal" data-target="#modal_po"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มรายการ</button>
                                        <button type="button" id="btnAddRRGiveaway" class="btn btn-info"
                                            data-toggle="modal" data-target="#modal_giveaway"><i class="fa fa fa-gift"
                                                aria-hidden="true"></i>
                                            เพิ่มของแถม</button>
                                        <button type="button" id="btnClearRRdetail" style="display:none;"
                                            class="btn btn-danger"
                                            onClick="onDeleteDetail('tableRRDetail','btnClearRRdetail');"><i
                                                class="fa fa fa-times" aria-hidden="true"></i>
                                            ลบรายการ</button>
                                        <button type="button" id="btnClearRRGiveaway" style="display:none;"
                                            class="btn btn-danger"
                                            onClick="onDeleteDetail('tableRRGiveaway','btnClearRRGiveaway');"><i
                                                class="fa fa fa-times" aria-hidden="true"></i>
                                            ลบของแถม</button>
                                    </div>



                                    <div style="border: 1px solid #FAEBD7;">
                                        <br>

                                        <table name="tableRRDetail" id="tableRRDetail"
                                            class="table table-bordered table-striped">
                                            <thead style="background-color:#D6EAF8;">
                                                <tr>
                                                    <th style="width:5%;text-align:right">ลำดับ</th>
                                                    <th style="width:8%;text-align:center">ใบสั่งซื้อ</th>
                                                    <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                    <th style="width:20%;text-align:center">รายการสินค้า</th>
                                                    <th style="width:15%;text-align:center">หน่วย</th>
                                                    <th style="width:12%;text-align:center">จำนวนรับแล้ว</th>
                                                    <th style="width:10%;text-align:center">จำนวนรับ</th>
                                                    <th style="width:15%;text-align:center">คลังสินค้า</th>
                                                    <th style="width:5%;text-align:center">สถานะ</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>

                                        <table name="tableRRGiveaway" id="tableRRGiveaway"
                                            class="table table-bordered table-striped" style="display:none;">
                                            <thead style="background-color:#D6EAF8;">
                                                <tr>
                                                    <th style="width:5%;text-align:center">ลำดับ</th>
                                                    <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                    <th style="width:20%;text-align:center">รายการสินค้า</th>
                                                    <th style="width:15%;text-align:center">หน่วย</th>
                                                    <th style="width:10%;text-align:center">จำนวน</th>
                                                    <th style="width:10%;text-align:center">ราคาขาย</th>
                                                    <th style="width:15%;text-align:center">จำนวนเงิน (บาท)</th>
                                                    <th style="width:15%;text-align:center">คลังสินค้า</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>

                                        <br>
                                        <br>
                                        <br>

                                        <div style="text-align:right;">

                                            <input type="submit" class="btn btn-primary" value="ยืนยัน">
                                        </div>
                                        <br>
                                        <br>
                                        <br>
                                </form>
                            </div>
                        </div>
                        <div id="divfrmEditRR" style="display:none;">
                            <form name="frmEditRR" id="frmEditRR" onkeydown="return event.key != 'Enter';">

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">เลขที่ใบรับสินค้า</label>
                                        <input type="text" class="form-control" name="editrrcode" id="editrrcode"
                                            disabled>
                                    </div>
                                    <div class="form-group col-md-6  col-md-offset-2">
                                        <label for="recipient-name" class="col-form-label">วันที่รับสินค้า</label>
                                        <input type="date" class="form-control" size="4" name="editrrdate"
                                            id="editrrdate" disabled>
                                    </div>

                                </div>

                                <div class="form-group col-md-6">
                                    <label>รหัสผู้ขาย</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="editsupcode" id="editsupcode"
                                            disabled>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" data-toggle="modal" data-target="#modal_one"
                                                type="button"><span class="fa fa-search"></span></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="recipient-name" class="col-form-label">ชื่อผู้ขาย</label>
                                    <input type="text" class="form-control" name="edittdname" id="edittdname" disabled>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">Invoice No.</label>
                                        <input type="text" class="form-control" name="editinvcode" id="editinvcode"
                                            disabled>
                                    </div>
                                    <div class="form-group col-md-6  col-md-offset-2">
                                        <label for="recipient-name" class="col-form-label">วันที่ออก Invoice</label>
                                        <input type="date" class="form-control" size="4" name="editinvdate"
                                            id="editinvdate" disabled>
                                    </div>

                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-5">
                                        <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                        <select class="form-control" name="editpayment" id="editpayment" disabled>
                                            <option value="เงินสด" selected>เงินสด</option>
                                            <option value="30 วัน">30 วัน</option>
                                            <option value="45 วัน">45 วัน</option>
                                            <option value="60 วัน">60 วัน</option>
                                            <option value="90 วัน">90 วัน</option>
                                            <option value="120 วัน">120 วัน</option>
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <hr>

                                <br>
                                <br>

                                <div style="border: 1px solid #FAEBD7;">
                                    <br>

                                    <table name="tableEditRRDetail" id="tableEditRRDetail"
                                        class="table table-bordered table-striped">
                                        <thead style="background-color:#D6EAF8;">
                                            <tr>
                                                <th style="width:5%;text-align:right">ลำดับ</th>
                                                <th style="width:10%;text-align:center">ใบสั่งซื้อ</th>
                                                <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                <th style="width:20%;text-align:center">รายการสินค้า</th>
                                                <th style="width:15%;text-align:center">หน่วย</th>
                                                <th style="width:10%;text-align:center">จำนวนซื้อ</th>
                                                <th style="width:10%;text-align:center">จำนวนรับ</th>
                                                <th style="width:15%;text-align:center">คลังสินค้า</th>
                                                <th style="width:5%;text-align:center">สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                    <table name="tableEditRRGiveaway" id="tableEditRRGiveaway" style="display:none;"
                                        class="table table-bordered table-striped">
                                        <thead style="background-color:#D6EAF8;">
                                            <tr>
                                                <th style="width:5%;text-align:center">ลำดับ</th>
                                                <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                <th style="width:20%;text-align:center">รายการสินค้า</th>
                                                <th style="width:15%;text-align:center">หน่วย</th>
                                                <th style="width:10%;text-align:center">จำนวน</th>
                                                <th style="width:15%;text-align:center">คลังสินค้า</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                    <div class="col-xs-12 text-center">
                                        <!-- <a href="invoice-print.php" target="_blank" class="btn btn-info"><i
                                                class="fa fa-print"></i> Print</a>
                                        <input type="submit" class="btn btn-primary" value="แก้ไข"> -->
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </section>
            <!-- /.content -->

        </div>

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_one" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกผู้ขาย</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_id" name="table_id" class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสผู้ขาย</th>
                                                <th>ชื่อผู้ขาย</th>

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

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_po" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกใบสั่งซื้อจากผู้ขาย <span id="txtsupname"
                                style="font-weight: bold;">....</span></h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_po" name="table_po" class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th></th>
                                                <th>ลำดับ</th>
                                                <th>เลขที่ใบสั่งซื้อ</th>
                                                <th>รหัสพัสดุ</th>
                                                <th>รายการ</th>
                                                <th>หน่วย</th>
                                                <th>จำนวนสั่งซื้อ</th>
                                                <th>จำนวนที่รับแล้ว</th>
                                                <th>สถานะ</th>

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
                        <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                        <button id="btnSubmitPO" type="button" class="btn btn-primary" data-dismiss="modal">ยืนยัน</button>

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_giveaway" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกของแถมจากลูกค้า</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_giveaway" name="table_giveaway"
                                        class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสสินค้า</th>
                                                <th>ชื่อสินค้า</th>

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

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_unit" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <input id="idunit" type="hidden" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_unit" name="table_unit" class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ชื่อหน่วยสินค้า</th>

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

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_unit2" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกสินค้า</h4>
                    </div>
                    <div class="modal-body">
                        <input id="idunit2" type="hidden" value="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_unit2" name="table_unit2"
                                        class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ชื่อหน่วยสินค้า</th>

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


        <?php include_once ROOT . '/menu_footer.php'; ?>

        <div class="control-sidebar-bg"></div>
    </div>

    <?php 
    
    include_once ROOT . '/index_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>