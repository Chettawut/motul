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
    <title>รายงานยอดขายสูงสุดตามพัสดุ</title>
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
                                <i class="fa fa-cube"></i>
                                <h3 class="box-title">รายงานยอดขายสูงสุดตามพัสดุ</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            <form class="form-inline" onsubmit="return false;">
                                    <?php                                    
                                        $month = array(0=>"ทั้งปี",1=>"มกราคม", 2=>"กุมภาพันธ์", 3=>"มีนาคม", 4=>"เมษายน", 5=>"พฤษภาคม", 6=>"มิถุนายน", 7=>"กรกฎาคม", 8=>"สิงหาคม", 9=>"กันยายน", 10=>"ตุลาคม", 11=>"พฤศจิกายน", 12=>"ธันวาคม");
                                    ?>
                                    <div class="form-group">
                                        <select class="form-control" id="select_year" name="select_year"
                                            style="width: 100%;">
                                            <?php 
												$year=date("Y")+543;
												for($count=0;$count<5;$count++)
                                                if($_GET['year']==($year-543))
												echo '<option value="'.$year.'" selected>ปี '.$year--.'</option>';                    
                                                else
                                                echo '<option value="'.$year.'" >ปี '.$year--.'</option>';                   
											?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="vat" name="vat" style="width: 100%;">
                                            <option value="A" selected>ทั้งหมด</option>
                                            <option value="Y">มี VAT</option>
                                            <option value="N">ไม่มี VAT</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="month" name="month" style="width: 100%;">
                                            <?php 
                                                for($i=0;$i<=12;$i++){
                                                    if($i<10)
                                                    $m="0".$i;
                                                    else
                                                    $m=$i;
                                                    
                                                    if($_GET['month']==$m)
                                                        echo"<option value='".$m."' selected>".$month[$i]."</option>";                                                        
                                                    else 
                                                    echo"<option value='".$m."'>".$month[$i]."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" id="stcode" name="stcode" style="width: 100%;display:none;">                                            
                                        </select>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#modal_one"
                                        class="btn btn-primary  pull-right"><i class="fa fa-edit"
                                            aria-hidden="true"></i> แก้ไขสินค้า</button>


                                </form>


                                <br>
                                <!-- Tab panes -->
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#sum_year" id="tap_sum_year" aria-controls="home"
                                            role="tab" data-toggle="tab">ยอดขาย 11 พัสดุ รายปี </a></li>
                                    <li role="presentation"><a href="#one_code" id="tap_one_code" aria-controls="profile" role="tab"
                                            data-toggle="tab">ยอดขาย 1 พัสดุ ใน 1 ปี</a></li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content" style="text-align:center">
                                    <div role="tabpanel" class="tab-pane active" id="sum_year">
                                        <table id="table_top_sales" class="table table-hover">
                                            <thead>

                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div id="chart-container">กรุณารอ กำลังประมวลผลกราฟ</div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="one_code">
                                    <table id="table_one_product" class="table table-hover">
                                            <thead>

                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div id="chart_container_code">กรุณารอ กำลังประมวลผลกราฟ</div>
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



        <?php include_once ROOT .'/menu_footer.php'; ?>

        <div class="control-sidebar-bg"></div>
    </div>

    <!-- Modal table_id -->
    <div class="modal fade bs-example-modal-lg" id="modal_one" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">แก้ไขสินค้า</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <table id="table_code" name="table_code" class="table table-bordered table-striped">
                                    <thead style=" background-color:#D6EAF8;">
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รหัสพัสดุ</th>
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

    <?php 
    
    include_once ROOT.'/index_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>