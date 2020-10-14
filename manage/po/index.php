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
    <title>ใบแจ้งซื้อ (Purchase Order)</title>
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
                    <small>Purchase Order</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-book"></i> Purchase Order</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-book"></i>
                                <h3 id="txtHead" class="box-title">ใบแจ้งซื้อ (Purchase Order)</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form action="invoice-print.php" method="post" target="_blank">
                                    <div class="btn-group" id="btnAddPO" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มใบสั่งซื้อ</button></div>
                                    <div class="btn-group" id="btnEditSubmit" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            แก้ไข</button></div>
                                    <div class="btn-group" id="btnBack" style="display:none;" role="group"
                                        aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            ย้อนกลับ</button></div>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> </button>

                                    <button type="submit" id="btnPrint" style="display:none;" class="btn btn-primary"><i class="fa fa-print"
                                            aria-hidden="true"></i>
                                        Print</button>
                                    <input type="hidden" id="printpocode" class="btn btn-default" name="printpocode"
                                        value="John"><br><br>


                                </form>

                            </div>
                        </div>
                        <div id="divtablePO" style="border: 1px solid #FAEBD7;">
                            <table name="tablePO" id="tablePO" class="table table-bordered table-striped">
                                <thead style="background-color:#D6EAF8;">
                                    <tr>

                                        <th>เลขที่ใบสั่งซื้อ</th>
                                        <th>วันที่สั่งซื้อ</th>
                                        <th>รหัสพัสดุ</th>
                                        <th>รายงานสินค้า</th>
                                        <th>ผู้ขาย</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <div id="divfrmPO" style="display:none;">
                            <form name="frmPO" id="frmPO" onkeydown="return event.key != 'Enter';">

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label for="recipient-name" class="col-form-label">เลขที่ใบสั่งซื้อ</label>
                                        <input type="text" class="form-control" name="pocode" id="pocode" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
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

                                </div>

                                <div class="form-group col-md-12">
                                    <label for="recipient-name" class="col-form-label">ที่อยู่ผู้ขาย</label>
                                    <input type="text" class="form-control" size="4" name="address" id="address"
                                        disabled>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">วันที่สั่งซื้อ</label>
                                        <input type="date" class="form-control" size="4" name="podate" id="podate">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                                        <input type="date" class="form-control" name="deldate" id="deldate">
                                    </div>

                                    <div class="form-group col-md-4">
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

                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">ใบเสนอราคา</label>
                                        <input type="text" class="form-control" name="poqua" id="poqua">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label">สกุลเงิน</label>
                                        <select class="form-control" name="currency" id="currency">
                                            <option value="บาท" selected>บาท</option>
                                            <option value="ดอลล่า">ดอลล่า</option>
                                            <option value="เยน">เยน</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
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

                                </div>

                                <hr>
                                <hr>

                                <br>
                                <br>
                                <div class="form-group col-md-12">
                                    <button type="button" id="btnAddPOdetail" class="btn btn-success"
                                        data-toggle="modal" data-target="#modal_stock"><i class="fa fa fa-tags"
                                            aria-hidden="true"></i>
                                        เพิ่มรายการ</button>
                                    <button type="button" id="btnClearPOdetail" style="display:none;" class="btn btn-danger"
                                        onClick="onDeleteDetail();"><i class="fa fa fa-times" aria-hidden="true"></i>
                                        ลบรายการ</button>
                                </div>



                                <div style="border: 1px solid #FAEBD7;">
                                    <br>

                                    <table name="tablePoDetail" id="tablePoDetail"
                                        class="table table-bordered table-striped">
                                        <thead style="background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>รหัสสินค้า</th>
                                                <th>รายการสินค้า</th>
                                                <th>จำนวน</th>
                                                <th>หน่วย</th>
                                                <th>ราคาขาย</th>
                                                <th>ส่วนลด</th>
                                                <th>จำนวนเงิน (บาท)</th>
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
                    <div id="divfrmEditPO" style="display:none;">
                        <form name="frmEditPO" id="frmEditPO" onkeydown="return event.key != 'Enter';">

                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="recipient-name" class="col-form-label">เลขที่ใบสั่งซื้อ</label>
                                    <input type="text" class="form-control" name="editpocode" id="editpocode" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label>รหัสผู้ขาย</label>

                                    <input type="text" class="form-control" name="editsupcode" id="editsupcode"
                                        disabled>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="recipient-name" class="col-form-label">ชื่อผู้ขาย</label>
                                    <input type="text" class="form-control" name="edittdname" id="edittdname" disabled>
                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">ที่อยู่ผู้ขาย</label>
                                <input type="text" class="form-control" size="4" name="editaddress" id="editaddress"
                                    disabled>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">วันที่สั่งซื้อ</label>
                                    <input type="date" class="form-control" size="4" name="editpodate" id="editpodate">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">วันที่นัดส่งของ</label>
                                    <input type="date" class="form-control" name="editdeldate" id="editdeldate">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">การชำระเงิน</label>
                                    <select class="form-control" name="editpayment" id="editpayment">
                                        <option value="เงินสด" selected>เงินสด</option>
                                        <option value="30 วัน">30 วัน</option>
                                        <option value="45 วัน">45 วัน</option>
                                        <option value="60 วัน">60 วัน</option>
                                        <option value="90 วัน">90 วัน</option>
                                        <option value="120 วัน">120 วัน</option>
                                    </select>
                                </div>

                            </div>

                            <div class="form-row">

                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">ใบเสนอราคา</label>
                                    <input type="text" class="form-control" name="editpoqua" id="editpoqua">
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">สกุลเงิน</label>
                                    <select class="form-control" name="editcurrency" id="editcurrency">
                                        <option value="บาท" selected>บาท</option>
                                        <option value="ดอลล่า">ดอลล่า</option>
                                        <option value="เยน">เยน</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
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

                            </div>

                            <hr>
                            <hr>

                            <br>
                            <br>

                            <div style="border: 1px solid #FAEBD7;">
                                <br>

                                <table name="tableEditPoDetail" id="tableEditPoDetail"
                                    class="table table-bordered table-striped">
                                    <thead style="background-color:#D6EAF8;">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รหัสสินค้า</th>
                                            <th>รายการสินค้า</th>
                                            <th>จำนวน</th>
                                            <th>หน่วย</th>
                                            <th>ราคาขาย</th>
                                            <th>ส่วนลด</th>
                                            <th>จำนวนเงิน (บาท)</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                            <div style="text-align:right;">
                                <input type="submit" class="btn btn-primary" value="แก้ไข">
                            </div>
                        </form>

                        <br>
                        <br>
                        <br>
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
                                <table id="table_stock" name="table_stock" class="table table-bordered table-striped">
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


    <?php include_once ROOT . '/menu_footer.php'; ?>

    <div class="control-sidebar-bg"></div>
    </div>

    <?php 
    
    include_once ROOT . '/index_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>