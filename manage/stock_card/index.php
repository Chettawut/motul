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
    <title>เช็คยอดพัสดุ (Stock Card)</title>
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
                    Stock Card
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-cube"></i> Stock Card</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cube"></i>
                                <h3 class="box-title">เช็คยอดพัสดุ (Stock Card)</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="btn-group" id="btnAdd" role="group" aria-label="Basic example">

                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                                </div>



                                <div style="border: 1px solid #FAEBD7;" width="100%">
                                    <div id="mainStock">
                                        <table name="tableStock" id="tableStock"
                                            class="table table-bordered table-striped">
                                            <thead style=" background-color:#D6EAF8;">
                                                <tr>
                                                    <th width="10%">รหัสพัสดุ</th>
                                                    <th width="40%">ชื่อพัสดุ</th>
                                                    <th width="8%" style="text-align:center">ลังคลังA</th>
                                                    <th width="8%" style="text-align:center">เศษคลังA</th>
                                                    <th width="8%" style="text-align:center">ลังคลังB</th>
                                                    <th width="8%" style="text-align:center">เศษคลังB</th>
                                                    <th width="8%" style="text-align:center">ลังคลังC</th>
                                                    <th width="8%" style="text-align:center">เศษคลังC</th>
                                                    <th width="10%" style="text-align:center">หน่วย</th>

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
                            เพิ่มรหัสสินค้า (Add Inventory)</h2>
                    </div>

                    <form name="frmAddStock" id="frmAddStock" action="" method="post">
                        <div class="modal-body">

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">รหัสพัสดุ</label>
                                <input type="text" class="form-control" name="stcode" id="stcode" minlength="6"
                                    maxlength="6" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">หน่วยพัสดุ</label>
                                <select class="form-control" name="unit" id="unit">
                                    <?php 
                                            include('../conn.php');
                                        	$sql = "SELECT * FROM `unit` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["unit"].'">'.$row["unit"].'</option>';
                                            }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">อัตราส่วนต่อลัง</label>
                                <select class="form-control" name="storage_id" id="storage_id">
                                <option value="0">--- ยังไม่ระบุ ---</option>
                                    <?php 
                                        	$sql = "SELECT * FROM `storage_unit`  ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["storage_id"].'">'.$row["storage_name"].'</option>';
                                            }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">ชื่อพัสดุ</label>
                                <input type="text" class="form-control" name="stname1" id="stname1" required>
                            </div>


                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">Min Store</label>
                                <input type="number" class="form-control" name="stmin1" id="stmin1" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">Min Sale</label>
                                <input type="number" class="form-control" name="stmin2" id="stmin2" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">ราคาขาย</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" name="sellprice" id="sellprice">
                                    <span class="input-group-addon">บาท</span>
                                </div>
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
                            รายละเอียดพัสดุ (Stock detail)</h2>
                    </div>
                    <form name="frmEditStock" id="frmEditStock">
                        <div class="modal-body">

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">รหัสพัสดุ</label>
                                <input type="text" class="form-control" name="editstcode" id="editstcode" minlength="6"
                                    maxlength="6" disabled>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">หน่วยพัสดุ</label>
                                <select class="form-control" name="editunit" id="editunit">
                                    <?php 
                                        	$sql = "SELECT * FROM `unit` where status = 'Y' ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["unit"].'">'.$row["unit"].'</option>';
                                            }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">อัตราส่วนต่อลัง</label>
                                <select class="form-control" name="editstorage_id" id="editstorage_id">
                                    <option value="0">--- ยังไม่ระบุ ---</option>
                                    <?php 
                                        	$sql = "SELECT * FROM `storage_unit`  ";
                                            $query = mysqli_query($conn,$sql);
                                        
                                            while($row = $query->fetch_assoc()) {
                                                echo '<option value="'.$row["storage_id"].'">'.$row["storage_name"].'</option>';
                                            }
                                    ?>

                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="inputEmail4">ชื่อพัสดุ</label>
                                <input type="text" class="form-control" name="editstname1" id="editstname1">
                            </div>


                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">Min Store</label>
                                <input type="text" class="form-control" name="editstmin1" id="editstmin1">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="recipient-name" class="col-form-label">Min Sale</label>
                                <input type="text" class="form-control" name="editstmin2" id="editstmin2">
                            </div>

                            <div class="form-group col-md-4">

                                <label for=" recipient-name" class="col-form-label">ราคาขาย</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="editsellprice" id="editsellprice">
                                    <span class="input-group-addon">บาท</span>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">สถานะการใช้งาน</label>
                                <select class="form-control" name="editstatus" id="editstatus">

                                    <option value="Y">เปิดการใช้งาน</option>
                                    <option value="N">ปิดการใช้งาน</option>

                                </select>

                            </div>


                            <input type="hidden" id="code" name="code">


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            
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