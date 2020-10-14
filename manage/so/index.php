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
    <title>ใบสั่งขาย (Sales Order) </title>
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
                    Sales
                    <small>ใบสั่งขาย</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-cart-plus"></i>ใบสั่งขาย</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cart-plus"></i>
                                <h3 id="txtHead" class="box-title">ใบสั่งขาย (Sales Order) </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form action="invoice-print.php" target="_blank" method="post">
                                    <div class="btn-group" id="btnAddSO" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มใบสั่งขาย</button>
                                    </div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button>
                                    </div>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> </button>
                                    <button type="button" id="btnCancle" style="display:none;" class="btn btn-danger"><i
                                            class="fa fa-check-circle" aria-hidden="true"></i>
                                        ยกเลิกใบสั่งขาย</button>
                                    <button type="submit" id="btnPrint" style="display:none;" class="btn btn-primary"><i
                                            class="fa fa-print" aria-hidden="true"></i> Print </button>
                                    <input type="hidden" id="printsocode" class="btn btn-default" name="printsocode"
                                        value="John">
                                    <input type="hidden" id="editsalecode" class="btn btn-default" 
                                        value="John">

                                </form>
                            </div>
                            <div id="divtableSO" style="border: 1px solid #FAEBD7;">
                                <table name="tableSO" id="tableSO" class="table table-bordered table-striped">
                                    <thead style="background-color:#D6EAF8;">
                                        <tr>

                                            <th>เลขที่ใบสั่งขาย</th>
                                            <th>วันที่สั่งซื้อ</th>
                                            <th>รหัสพัสดุ</th>
                                            <th>รายงานสินค้า</th>
                                            <th>ลูกค้า</th>
                                            <th>สถานะ</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                            <div id="divfrmSO" style="display:none;">
                                <form name="frmSO" id="frmSO" onkeydown="return event.key != 'Enter';">

                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <label for="recipient-name" class="col-form-label">เลขที่ใบสั่งขาย</label>
                                            <input type="text" class="form-control" name="socode" id="socode" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>รหัสลูกค้า</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="cuscode" id="cuscode"
                                                    disabled>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" data-toggle="modal"
                                                        data-target="#modal_one" type="button"><span
                                                            class="fa fa-search"></span></button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                                            <input type="text" class="form-control" name="tdname" id="tdname" disabled>
                                        </div>

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="recipient-name" class="col-form-label">เบอร์ลูกค้า</label>
                                        <input type="text" class="form-control" size="4" name="tel" id="tel" disabled>
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label for="recipient-name" class="col-form-label">ที่อยู่ลูกค้า</label>
                                        <input type="text" class="form-control" size="4" name="address" id="address"
                                            disabled>
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">วันที่สั่งขาย</label>
                                            <input type="date" class="form-control" size="4" name="sodate" id="sodate">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                                            <input type="date" class="form-control" name="deldate" id="deldate">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name"
                                                class="col-form-label">วันที่กำหนดชำระเงิน</label>
                                            <input type="date" class="form-control" name="paydate" id="paydate">
                                        </div>



                                    </div>

                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                            <select class="form-control" name="payment" id="payment">
                                                <option value="เงินสด" selected>เงินสด</option>
                                                <option value="เครดิต">เครดิต</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="recipient-name" class="col-form-label">สกุลเงิน</label>
                                            <select class="form-control" name="currency" id="currency">
                                                <option value="บาท" selected>บาท</option>
                                                <option value="ดอลล่า">ดอลล่า</option>
                                                <option value="เยน">เยน</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="recipient-name" class="col-form-label">ภาษี </label>
                                            <div class="radio">
                                                <label class="radio-inline">
                                                    <input type="radio" name="vat" value="Y" checked> มี
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="vat" value="N"> ไม่มี
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="comment">หมายเหตุ:</label>
                                            <textarea class="form-control" rows="5" name="remark"
                                                id="remark"></textarea>
                                        </div>
                                        <input type="hidden" id="salecode" name="salecode"
                                            value="<?php echo $_SESSION['salecode'];?>">




                                    </div>

                                    <hr>
                                    <hr>

                                    <br>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <button type="button" id="btnAddSOdetail" class="btn btn-success"
                                            data-toggle="modal" data-target="#modal_stock"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มรายการ</button>

                                        <button type="button" id="btnAddSOGiveaway" class="btn btn-info"
                                            data-toggle="modal" data-target="#modal_giveaway"><i class="fa fa fa-gift"
                                                aria-hidden="true"></i>
                                            เพิ่มของแถม</button>
                                        <button type="button" id="btnClearSOdetail" style="display:none;"
                                            class="btn btn-danger"
                                            onClick="onDeleteDetail('tableSODetail','btnClearSOdetail');"><i
                                                class="fa fa fa-times" aria-hidden="true"></i>
                                            ลบรายการ</button>
                                        <button type="button" id="btnClearSOGiveaway" style="display:none;"
                                            class="btn btn-danger"
                                            onClick="onDeleteDetail('tableSOGiveaway','btnClearSOGiveaway');"><i
                                                class="fa fa fa-times" aria-hidden="true"></i>
                                            ลบของแถม</button>

                                    </div>



                                    <div style="border: 1px solid #FAEBD7;">
                                        <br>

                                        <table name="tableSODetail" id="tableSODetail"
                                            class="table table-bordered table-striped">
                                            <thead style="background-color:#D6EAF8;">
                                                <tr>
                                                    <th style="width:5%;text-align:center">ลำดับ</th>
                                                    <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                    <th style="width:20%;text-align:center">รายการสินค้า</th>
                                                    <th style="width:7%;text-align:center">จำนวน</th>
                                                    <th style="width:15%;text-align:center">หน่วย</th>
                                                    <th style="width:9%;text-align:center">ราคาขาย</th>
                                                    <th style="width:10%;text-align:center">ส่วนลด</th>
                                                    <th style="width:10%;text-align:center">จำนวนเงิน</th>
                                                    <th style="width:15%;text-align:center">คลังสินค้า</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                        </table>

                                        <table name="tableSOGiveaway" id="tableSOGiveaway"
                                            class="table table-bordered table-striped" style="display:none;">
                                            <thead style="background-color:#D6EAF8;">
                                                <tr>
                                                    <th style="width:5%;text-align:center">ลำดับ</th>
                                                    <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                    <th style="width:30%;text-align:left">รายการสินค้า</th>
                                                    <th style="width:15%;text-align:center">หน่วย</th>
                                                    <th style="width:10%;text-align:center">จำนวน</th>
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
                        <div id="divfrmEditSO" style="display:none;">
                            <form name="frmEditSO" id="frmEditSO" onkeydown="return event.key != 'Enter';">

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="recipient-name" class="col-form-label">เลขที่ใบสั่งขาย</label>
                                        <input type="text" class="form-control" name="editsocode" id="editsocode"
                                            disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>รหัสลูกค้า</label>

                                        <input type="text" class="form-control" name="editcuscode" id="editcuscode"
                                            disabled>

                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                                        <input type="text" class="form-control" name="editcusname" id="editcusname"
                                            disabled>
                                    </div>

                                </div>
                                <div class="form-group col-md-3">
                                    <label for="recipient-name" class="col-form-label">เบอร์ลูกค้า</label>
                                    <input type="text" class="form-control" size="4" name="edittel" id="edittel"
                                        disabled>
                                </div>
                                <div class="form-group col-md-9">
                                    <label for="recipient-name" class="col-form-label">ที่อยู่ลูกค้า</label>
                                    <input type="text" class="form-control" size="4" name="editaddress" id="editaddress"
                                        disabled>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">วันที่สั่งซื้อ</label>
                                        <input type="date" class="form-control" size="4" name="editsodate"
                                            id="editsodate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                                        <input type="date" class="form-control" name="editdeldate" id="editdeldate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">วันที่กำหนดชำระเงิน</label>
                                        <input type="date" class="form-control" name="editpaydate" id="editpaydate">
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                        <select class="form-control" name="editpayment" id="editpayment">
                                            <option value="เงินสด" selected>เงินสด</option>
                                            <option value="เครดิต">เครดิต</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="recipient-name" class="col-form-label">สกุลเงิน</label>
                                        <select class="form-control" name="editcurrency" id="editcurrency">
                                            <option value="บาท" selected>บาท</option>
                                            <option value="ดอลล่า">ดอลล่า</option>
                                            <option value="เยน">เยน</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="recipient-name" class="col-form-label">ภาษี </label>
                                        <div class="radio">
                                            <label class="radio-inline">
                                                <input type="radio" name="editvat" value="Y" checked> มี
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="editvat" value="N"> ไม่มี
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="comment">หมายเหตุ:</label>
                                        <textarea class="form-control" rows="5" name="editremark"
                                            id="editremark"></textarea>
                                    </div>

                                </div>

                                <hr>
                                <hr>

                                <br>
                                <br>

                                <div style="border: 1px solid #FAEBD7;">
                                    <br>

                                    <table name="tableEditSODetail" id="tableEditSODetail"
                                        class="table table-bordered table-striped">
                                        <thead style="background-color:#D6EAF8;">
                                            <tr>
                                                <th style="width:5%;text-align:center">ลำดับ</th>
                                                <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                <th style="width:20%;text-align:center">รายการสินค้า</th>
                                                <th style="width:7%;text-align:center">จำนวน</th>
                                                <th style="width:15%;text-align:center">หน่วย</th>
                                                <th style="width:9%;text-align:center">ราคาขาย</th>
                                                <th style="width:10%;text-align:center">ส่วนลด</th>
                                                <th style="width:10%;text-align:center">จำนวนเงิน</th>
                                                <th style="width:15%;text-align:center">คลังสินค้า</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                    <table name="tableEditSOGiveaway" id="tableEditSOGiveaway" style="display:none;"
                                        class="table table-bordered table-striped">
                                        <thead style="background-color:#D6EAF8;">
                                            <tr>
                                                <th style="width:5%;text-align:center">ลำดับ</th>
                                                <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                <th style="width:30%;text-align:left">รายการสินค้า</th>
                                                <th style="width:15%;text-align:center">หน่วย</th>
                                                <th style="width:10%;text-align:center">จำนวน</th>
                                                <th style="width:15%;text-align:center">คลังสินค้า</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>

                                    <div style="text-align:center;">
                                        <input id="btnEdit" type="submit" class="btn btn-primary" value="แก้ไข">
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                </div>
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
                        <h4 class="modal-title" id="myModalLabel">เลือกลูกค้า</h4>
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

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_stock" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกสินค้า</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_stock" name="table_stock"
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


        <?php include_once ROOT . '/menu_footer.php'; ?>

        <div class="control-sidebar-bg"></div>
    </div>

    <?php 
    
    include_once ROOT . '/index_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>