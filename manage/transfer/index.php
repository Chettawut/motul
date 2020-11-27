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
    <title>ระบบย้ายสต๊อก (Transfer Inventory) </title>
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
                    <!-- <small></small> -->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-cart-plus"></i>ย้ายสต๊อก</a></li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cart-plus"></i>
                                <h3 id="txtHead" class="box-title">ระบบย้ายสต๊อก (Transfer Inventory) </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form action="invoice-print.php" target="_blank" method="post">
                                    <div class="btn-group" id="btnAddTF" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-success"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มใบย้ายสต๊อก</button>
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
                                    <input type="hidden" id="editsalecode" class="btn btn-default" value="John">

                                </form>
                            </div>
                            <div id="divtableTF" style="border: 1px solid #FAEBD7;">
                                <table name="tableTF" id="tableTF" class="table table-bordered table-striped">
                                    <thead style="background-color:#D6EAF8;">
                                        <tr>

                                            <th>เลขที่ใบย้ายสต๊อก</th>
                                            <th>วันที่ย้าย</th>
                                            <th>รหัสพัสดุ</th>
                                            <th>รายงานสินค้า</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>

                                </table>
                            </div>
                            <div id="divfrmTF" style="display:none;">
                                <form name="frmTF" id="frmTF" onkeydown="return event.key != 'Enter';">

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">เลขที่เอกสาร</label>
                                            <input type="text" class="form-control" name="tfcode" id="tfcode" disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">วันที่เอกสาร</label>
                                            <input type="date" class="form-control" size="4" name="tfdate" id="tfdate"
                                                disabled>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="recipient-name" class="col-form-label">วันที่ย้าย</label>
                                            <input type="date" class="form-control" size="4" name="trandate"
                                                id="trandate">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="comment">หมายเหตุ:</label>
                                            <textarea class="form-control" rows="2" name="remark" id="remark">
                                        </textarea>

                                        </div>
                                    </div>
                                    <input type="hidden" id="salecode" name="salecode"
                                        value="<?php echo $_SESSION['salecode'];?>">


                                    <hr>
                                    <hr>

                                    <br>
                                    <br>
                                    <div class="form-group col-md-12">
                                        <button type="button" id="btnAddTFdetail" class="btn btn-success"
                                            data-toggle="modal" data-target="#modal_stock"><i class="fa fa fa-tags"
                                                aria-hidden="true"></i>
                                            เพิ่มรายการ</button>

                                        <button type="button" id="btnClearTFdetail" style="display:none;"
                                            class="btn btn-danger"
                                            onClick="onDeleteDetail('tableTFDetail','btnClearTFdetail');"><i
                                                class="fa fa fa-times" aria-hidden="true"></i>
                                            ลบรายการ</button>

                                    </div>


                                    <div style="border: 1px solid #FAEBD7;">
                                        <br>

                                        <table name="tableTFDetail" id="tableTFDetail"
                                            class="table table-bordered table-striped">
                                            <thead style="background-color:#D6EAF8;">
                                                <tr>
                                                    <th style="width:5%;text-align:center">ลำดับ</th>
                                                    <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                                    <th style="width:26%;text-align:center">รายการสินค้า</th>
                                                    <th style="width:10%;text-align:center">จำนวน</th>
                                                    <th style="width:15%;text-align:center">หน่วย</th>
                                                    <th style="width:17%;text-align:center">คลังสินค้าต้นทาง</th>
                                                    <th style="width:17%;text-align:center">คลังสินค้าปลายทาง</th>

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


                    </div>
                    <div id="divfrmEditTF" style="display:none;">
                        <form name="frmEditTF" id="frmEditTF" onkeydown="return event.key != 'Enter';">

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">เลขที่เอกสาร</label>
                                    <input type="text" class="form-control" name="edittfcode" id="edittfcode" disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">วันที่เอกสาร</label>
                                    <input type="date" class="form-control" size="4" name="edittfdate" id="edittfdate"
                                        disabled>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="recipient-name" class="col-form-label">วันที่ย้าย</label>
                                    <input type="date" class="form-control" size="4" name="edittrandate"
                                        id="edittrandate" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="comment">หมายเหตุ:</label>
                                    <textarea class="form-control" rows="2" name="editremark" id="editremark">
                                        </textarea>

                                </div>
                            </div>

                            <hr>
                            <hr>

                            <br>
                            <br>

                            <div style="border: 1px solid #FAEBD7;">
                                <br>

                                <table name="tableEditTFDetail" id="tableEditTFDetail"
                                    class="table table-bordered table-striped">
                                    <thead style="background-color:#D6EAF8;">
                                        <tr>
                                            <th style="width:5%;text-align:center">ลำดับ</th>
                                            <th style="width:10%;text-align:center">รหัสสินค้า</th>
                                            <th style="width:26%;text-align:center">รายการสินค้า</th>
                                            <th style="width:10%;text-align:center">จำนวน</th>
                                            <th style="width:15%;text-align:center">หน่วย</th>
                                            <th style="width:17%;text-align:center">คลังสินค้าต้นทาง</th>
                                            <th style="width:17%;text-align:center">คลังสินค้าปลายทาง</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>

                                
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
                                <table id="table_unit2" name="table_unit2" class="table table-bordered table-striped">
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