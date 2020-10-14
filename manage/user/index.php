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
    <title>จัดการผู้ใช้ (User)</title>
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
                    User
                    <!-- <small>User</small> -->
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-cube"></i> User</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-cube"></i>
                                <h3 class="box-title">จัดการผู้ใช้ (User)</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="btn-group" id="btnAdd" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        เพิ่มผู้ใช้</button>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                                </div>



                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <!-- /////////////////////////////////////////////////////// HOME ///////////////////////////////////// -->
                                    <div role="tabpanel" class="tab-pane active" id="home">
                                        <div style="border: 1px solid #FAEBD7;">
                                            <div id="mainUser" >
                                                <table name="tableUser" id="tableUser"
                                                    class="table table-bordered table-striped">
                                                    <thead style=" background-color:#D6EAF8;">
                                                        <tr>
                                                            <th>Username</th>
                                                            <th>ชื่อ</th>
                                                            <th>ประเภท</th>
                                                            
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
                            เพิ่มผู้ใช้ (Add User)</h2>
                    </div>
                    <form name="frmAddUser" id="frmAddUser" action="" method="post">
                        <div class="modal-body">

                        <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">User</label>
                                <input type="text" class="form-control" name="userusername" id="userusername" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">Password</label>
                                <input type="password" class="form-control" name="userpassword" id="userpassword" required>
                            </div>
                            <div class="form-group col-md-6">

                                <label for="recipient-name" class="col-form-label">ชื่อจริง</label>
                                <input type="text" class="form-control" name="userfirstname" id="userfirstname" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ชื่อสกุล</label>
                                <input type="text" class="form-control" name="userlastname" id="userlastname" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ประเภท</label>
                                <select class="form-control" name="usertype" id="usertype">
                                    <option value="01">Store</option>
                                    <option value="02">Sales Leader</option>
                                    <option value="03">Accounting</option>
                                    <option value="04">Manager</option>
                                    <option value="05">Sales</option>
                                    <option value="99">Admin</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="usertel" id="usertel">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">email</label>
                                <input type="email" class="form-control" name="useremail" id="useremail">
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

        <div class="modal fade" id="modelUserEdit" tabindex="-1" role="dialog" aria-labelledby="modelEditLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i>
                            แก้ไขผู้ใช้ (Edit User)</h2>
                    </div>
                    <div class="modal-body">
                        <form name="frmEditUser" id="frmEditUser">
                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">User</label>
                                <input type="text" class="form-control" name="editusername" id="editusername">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ชื่อจริง</label>
                                <input type="text" class="form-control" name="editfirstname" id="editfirstname">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputEmail4">ชื่อสกุล</label>
                                <input type="text" class="form-control" name="editlastname" id="editlastname">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ประเภท</label>
                                <select class="form-control" name="edittype" id="edittype">
                                <option value="01">Store</option>
                                    <option value="02">Sales Leader</option>
                                    <option value="03">Accounting</option>
                                    <option value="04">Manager</option>
                                    <option value="05">Sales</option>
                                    <option value="99">Admin</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">SaleCode</label>
                                <input type="text" class="form-control" name="editsalecode" id="editsalecode">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">email</label>
                                <input type="email" class="form-control" name="editemail" id="editemail">
                            </div>


                            <!-- <div class="form-group col-md-6">
                                <label for="inputEmail4">Money</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" disabled>
                            </div> -->


                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id="btnDeleteUser">ลบ</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary" id="btnEditUser">แก้ไข</button>
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