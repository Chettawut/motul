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
    <title>จัดการลูกค้า (Customer)</title>
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
                    <small>Customer</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-id-card-o"></i> Customer</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">

                        <div class="box" style="background-color:#EAEDED">
                            <div class="box-header">
                                <i class="fa fa-id-card-o"></i>
                                <h3 class="box-title">จัดการลูกค้า (Customer)</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">

                                <div class="btn-group" id="btnAdd" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#exampleModal"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        เพิ่มลูกค้า</button>
                                    <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button>
                                    <button type="button" id="btnShowALL"
                                        class="btn btn-warning pull-right"><i class="fa fa-eye" aria-hidden="true"></i>
                                        ดูลูกค้าทั้งหมด</button>
                                    <button type="button" id="btnShow"
                                        class="btn btn-warning pull-right" style="display:none;"><i class="fa fa-eye" aria-hidden="true"></i>
                                        ดูลูกค้าเฉพาะที่เปิดใช้งาน</button>
                                </div>



                                <div id="mainCustomer" style="border: 1px solid #FAEBD7;" width="100%">
                                    <table name="tableCustomer" id="tableCustomer"
                                        class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th width="15%">รหัสลูกค้า</th>
                                                <th width="38%">ชื่อลูกค้า</th>
                                                <th width="12%" style="text-align:center">จังหวัด</th>
                                                <th width="20%" style="text-align:center">ที่อยู่</th>
                                                <th width="15%" style="text-align:center">สถานะใช้งาน</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>

                                <div id="mainAllCustomer" style="border: 1px solid #FAEBD7;display:none;" width="100%">

                                    <table name="tableAllCustomer" id="tableAllCustomer"
                                        class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th width="15%">รหัสลูกค้า</th>
                                                <th width="38%">ชื่อลูกค้า</th>
                                                <th width="12%" style="text-align:center">จังหวัด</th>
                                                <th width="20%" style="text-align:center">ที่อยู่</th>
                                                <th width="15%" style="text-align:center">สถานะใช้งาน</th>

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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i>
                            เพิ่มลูกค้า (Add Customer)</h2>
                    </div>

                    <form name="frmAddCustomer" id="frmAddCustomer" action="" method="post">
                        <div class="modal-body">

                            <div class="form-group col-md-12">
                                <div class="row">
                                    <div class="form-group col-md-2">
                                        <label for="recipient-name" class="col-form-label">รหัสลูกค้า</label>
                                        <input type="number" class="form-control" name="cuscode1" id="cuscode1" min="0"
                                            max="9" placeholder="ภาค" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="recipient-name" class="col-form-label"><br></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="cuscode2" id="cuscode2"
                                                minlength="9" maxlength="9" placeholder="จังหวัด" disabled required>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" data-toggle="modal"
                                                    data-target="#modal_one" type="button"><span
                                                        class="fa fa-search"></span></button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="recipient-name" class="col-form-label"><br></label>
                                        <input type="text" class="form-control" name="cuscode3" id="cuscode3"
                                            minlength="3" maxlength="3" placeholder="ลำดับ" required>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                                <input type="text" class="form-control" name="cusname" id="cusname" required>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">Google Map</label>
                                <input type="text" class="form-control" name="map" id="map" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="tel" id="tel" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เบอร์แฟ็ค</label>
                                <input type="text" class="form-control" name="fax" id="fax">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เลขที่</label>
                                <input type="text" class="form-control" name="idno" id="idno">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ถนน</label>
                                <input type="text" class="form-control" name="road" id="road">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ตำบล</label>
                                <input type="text" class="form-control" name="subdistrict" id="subdistrict">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">อำเภอ</label>
                                <input type="text" class="form-control" name="district" id="district">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">จังหวัด</label>
                                <select class="form-control" name="province" id="province" disabled>
                                    <?php getProvince();?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" name="zipcode" id="zipcode">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เลขผู้เสียภาษี</label>
                                <input type="text" class="form-control" name="taxnumber" id="taxnumber">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email">
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

        <!-- Modal table_id -->
        <div class="modal fade bs-example-modal-lg" id="modal_one" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">เลือกตัวย่อจังหวัด</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <table id="table_id" name="table_id" class="table table-bordered table-striped">
                                        <thead style=" background-color:#D6EAF8;">
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>ตัวย่อจังหวัด</th>
                                                <th>ชื่อจังหวัด</th>

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

        <div class="modal fade" id="modelCustomerEdit" tabindex="-1" role="dialog" aria-labelledby="modelEditLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="exampleModalLabel"><i class="fa fa-cube" aria-hidden="true"></i>
                            แก้ไขลูกค้า (Edit Customer)</h2>
                    </div>
                    <form name="frmEditCustomer" id="frmEditCustomer">
                        <div class="modal-body">

                            <div class="form-group col-md-12">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="recipient-name" class="col-form-label">รหัสลูกค้า</label>
                                        <input type="text" class="form-control" name="editcuscode" id="editcuscode"
                                            disabled required>
                                    </div>

                                </div>

                            </div>

                            <div class="form-group col-md-12">
                                <label for="recipient-name" class="col-form-label">ชื่อลูกค้า</label>
                                <input type="text" class="form-control" name="editcusname" id="editcusname" required>
                            </div>

                            <div class="form-group col-md-12">

                                <label for="recipient-name" class="col-form-label">Google Map</label>

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><span class="fa fa-eye"
                                                onclick="window.open($('#editmap').val(),'_blank');">
                                                View</span></button>
                                    </span>
                                    <input type="text" class="form-control" name="editmap" id="editmap">

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="edittel" id="edittel">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เบอร์แฟ็ค</label>
                                <input type="text" class="form-control" name="editfax" id="editfax">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เลขที่</label>
                                <input type="text" class="form-control" name="editidno" id="editidno">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ถนน</label>
                                <input type="text" class="form-control" name="editroad" id="editroad">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">ตำบล</label>
                                <input type="text" class="form-control" name="editsubdistrict" id="editsubdistrict">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">อำเภอ</label>
                                <input type="text" class="form-control" name="editdistrict" id="editdistrict">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">จังหวัด</label>
                                <select class="form-control" name="editprovince" id="editprovince" disabled>
                                    <?php getProvince();?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">รหัสไปรษณีย์</label>
                                <input type="text" class="form-control" name="editzipcode" id="editzipcode">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">เลขผู้เสียภาษี</label>
                                <input type="text" class="form-control" name="edittaxnumber" id="edittaxnumber">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="text" class="form-control" name="editemail" id="editemail">
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
                            <input id="btnEdit" type="submit" class="btn btn-primary" value="Submit">
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

<?php

function getProvince(){
    echo '<option value="" selected>-- เลือกจังหวัด --</option>
    <option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
    <option value="กระบี่">กระบี่ </option>
    <option value="กาญจนบุรี">กาญจนบุรี </option>
    <option value="กาฬสินธุ์">กาฬสินธุ์ </option>
    <option value="กำแพงเพชร">กำแพงเพชร </option>
    <option value="ขอนแก่น">ขอนแก่น</option>
    <option value="จันทบุรี">จันทบุรี</option>
    <option value="ฉะเชิงเทรา">ฉะเชิงเทรา </option>
    <option value="ชัยนาท">ชัยนาท </option>
    <option value="ชัยภูมิ">ชัยภูมิ </option>
    <option value="ชุมพร">ชุมพร </option>
    <option value="ชลบุรี">ชลบุรี </option>
    <option value="เชียงใหม่">เชียงใหม่ </option>
    <option value="เชียงราย">เชียงราย </option>
    <option value="ตรัง">ตรัง </option>
    <option value="ตราด">ตราด </option>
    <option value="ตาก">ตาก </option>
    <option value="นครนายก">นครนายก </option>
    <option value="นครปฐม">นครปฐม </option>
    <option value="นครพนม">นครพนม </option>
    <option value="นครราชสีมา">นครราชสีมา </option>
    <option value="นครศรีธรรมราช">นครศรีธรรมราช </option>
    <option value="นครสวรรค์">นครสวรรค์ </option>
    <option value="นราธิวาส">นราธิวาส </option>
    <option value="น่าน">น่าน </option>
    <option value="นนทบุรี">นนทบุรี </option>
    <option value="บึงกาฬ">บึงกาฬ</option>
    <option value="บุรีรัมย์">บุรีรัมย์</option>
    <option value="ประจวบคีรีขันธ์">ประจวบคีรีขันธ์ </option>
    <option value="ปทุมธานี">ปทุมธานี </option>
    <option value="ปราจีนบุรี">ปราจีนบุรี </option>
    <option value="ปัตตานี">ปัตตานี </option>
    <option value="พะเยา">พะเยา </option>
    <option value="พระนครศรีอยุธยา">พระนครศรีอยุธยา </option>
    <option value="พังงา">พังงา </option>
    <option value="พิจิตร">พิจิตร </option>
    <option value="พิษณุโลก">พิษณุโลก </option>
    <option value="เพชรบุรี">เพชรบุรี </option>
    <option value="เพชรบูรณ์">เพชรบูรณ์ </option>
    <option value="แพร่">แพร่ </option>
    <option value="พัทลุง">พัทลุง </option>
    <option value="ภูเก็ต">ภูเก็ต </option>
    <option value="มหาสารคาม">มหาสารคาม </option>
    <option value="มุกดาหาร">มุกดาหาร </option>
    <option value="แม่ฮ่องสอน">แม่ฮ่องสอน </option>
    <option value="ยโสธร">ยโสธร </option>
    <option value="ยะลา">ยะลา </option>
    <option value="ร้อยเอ็ด">ร้อยเอ็ด </option>
    <option value="ระนอง">ระนอง </option>
    <option value="ระยอง">ระยอง </option>
    <option value="ราชบุรี">ราชบุรี</option>
    <option value="ลพบุรี">ลพบุรี </option>
    <option value="ลำปาง">ลำปาง </option>
    <option value="ลำพูน">ลำพูน </option>
    <option value="เลย">เลย </option>
    <option value="ศรีสะเกษ">ศรีสะเกษ</option>
    <option value="สกลนคร">สกลนคร</option>
    <option value="สงขลา">สงขลา </option>
    <option value="สมุทรสาคร">สมุทรสาคร </option>
    <option value="สมุทรปราการ">สมุทรปราการ </option>
    <option value="สมุทรสงคราม">สมุทรสงคราม </option>
    <option value="สระแก้ว">สระแก้ว </option>
    <option value="สระบุรี">สระบุรี </option>
    <option value="สิงห์บุรี">สิงห์บุรี </option>
    <option value="สุโขทัย">สุโขทัย </option>
    <option value="สุพรรณบุรี">สุพรรณบุรี </option>
    <option value="สุราษฎร์ธานี">สุราษฎร์ธานี </option>
    <option value="สุรินทร์">สุรินทร์ </option>
    <option value="สตูล">สตูล </option>
    <option value="หนองคาย">หนองคาย </option>
    <option value="หนองบัวลำภู">หนองบัวลำภู </option>
    <option value="อำนาจเจริญ">อำนาจเจริญ </option>
    <option value="อุดรธานี">อุดรธานี </option>
    <option value="อุตรดิตถ์">อุตรดิตถ์ </option>
    <option value="อุทัยธานี">อุทัยธานี </option>
    <option value="อุบลราชธานี">อุบลราชธานี</option>
    <option value="อ่างทอง">อ่างทอง </option>';
}
?>