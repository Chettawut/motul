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
    <title>ระบบจัดการข้อมูล Unit </title>
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
                    <small>Unit</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-ticket"></i> Unit</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cube"></i>
                                <h3 class="box-title">ระบบจัดการข้อมูล Unit</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="btn-group" id="btnAdd" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        เพิ่ม Unit</button>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                                </div>



                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- /////////////////////////////////////////////////////// HOME ///////////////////////////////////// -->
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div style="border: 1px solid #FAEBD7;">
                                            <div id="mainUnit">
                                                <table name="tableUnit" id="tableUnit"
                                                    class="table table-bordered table-striped">
                                                    <thead style=" background-color:#D6EAF8;">
                                                        <tr>
                                                            <th width="80%">Unit Name</th>
                                                            <th width="20%">สถานะการใช้งาน</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
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
                            เพิ่ม Unit</h2>
                    </div>
                    <form name="frmAddUnit" id="frmAddUnit" action="" method="post">
                        <div class="modal-body">

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ชื่อ Unit </label>
                                <input type="text" class="form-control" name="unit" id="unit" required>
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

        <div class="modal fade" id="modelUnitEdit" tabindex="-1" role="dialog" aria-labelledby="modelEditLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i>
                            จัดการ Unit</h2>
                    </div>
                    <div class="modal-body">
                        <form name="frmEditUnit" id="frmEditUnit">
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ชื่อ Unit </label>
                                <input type="text" class="form-control" name="editunit" id="editunit">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">สถานะการใช้งาน</label>
                                <select class="form-control" name="status" id="status">

                                    <option value="Y">เปิดการใช้งาน</option>
                                    <option value="N">ปิดการใช้งาน</option>

                                </select>
                            </div>
                            <input type="hidden" id="unitcode" name="unitcode">
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btnDeleteUnit">ลบ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary" id="btnEditUnit">แก้ไข</button>
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