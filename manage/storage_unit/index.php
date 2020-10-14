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
    <title>จัดการหน่วยเก็บสินค้า (Storage Unit Management)</title>
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
                    <small>Storage Unit Management</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-cube"></i> Storage Unit Management</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cube"></i>
                                <h3 class="box-title">จัดการหน่วยเก็บสินค้า (Storage Unit Management)</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="btn-group" id="btnAdd" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        เพิ่มกลุ่มหน่วยสินค้า</button>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                                </div>



                                <div style="border: 1px solid #FAEBD7;" width="100%">
                                    <div id="mainStock">
                                        <table name="tableStock" id="tableStock"
                                            class="table table-bordered table-striped">
                                            <thead style=" background-color:#D6EAF8;">
                                                <tr>
                                                    <th width="10%" style="text-align:center">ลำดับ</th>
                                                    <th width="60%" style="text-align:center">ชื่อกลุ่มพัสดุ</th>
                                                    <th width="30%" style="text-align:center">จำนวนที่เข้าสต๊อก</th> 
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i>
                            เพิ่มกลุ่มอัตราหน่วยเก็บสินค้า</h2>
                    </div>

                    <form name="frmAddStock" id="frmAddStock" action="" method="post">
                        <div class="modal-body">

                        <div class="form-group col-md-6">
                                <label >ชื่ออัตราหน่วยเก็บสินค้า</label>
                                <input type="text" class="form-control" name="storage_name" id="storage_name" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label >อัตราส่วนหลัก</label>
                                <input type="text" class="form-control" name="main_ratio" id="main_ratio" value="1" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4">จำนวนที่เข้าสต๊อก</label>
                                <input type="number" class="form-control" name="ratio" id="ratio" required>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modelStockEdit" tabindex="-1" role="dialog" aria-labelledby="modelEditLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i>
                            แก้ไขกลุ่มหน่วยเก็บสินค้า</h2>
                    </div>
                    <form name="frmEditStock" id="frmEditStock">
                        <div class="modal-body">

                            <div class="form-group col-md-6">
                                <label >ชื่ออัตราหน่วยเก็บสินค้า</label>
                                <input type="text" class="form-control" name="editstorage_name" id="editstorage_name" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label >อัตราส่วนหลัก</label>
                                <input type="text" class="form-control" name="editmain_ratio" id="editmain_ratio" value="1" disabled>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4">จำนวนที่เข้าสต๊อก</label>
                                <input type="number" class="form-control" name="editratio" id="editratio" required>
                            </div>



                            <input type="hidden" id="code" name="code">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
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