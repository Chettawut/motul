<?php
// Start the session
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../../../');
    exit;
}
	?>
<!DOCTYPE html>
<html>
<?php 
        $thaimonth=array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
        $title;
        if($_GET['vat']=='Y')
        $title='รายงานใบกำกับภาษีขาย';
        else
        $title='รายงานใบขายสินค้า';
        ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> <?php echo $title.' เดือน'.$thaimonth[((int)$_GET['month'])].' ปี'.($_GET['year']+543)?> </title>
    <?php include('css.php'); 
    include_once('../../../config.php');
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
            <?php include_once ROOT . '/conn.php'; ?>
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
                                <h3><i class="fa fa-cube"></i>
                                    <?php echo $title.' เดือน'.$thaimonth[(int)$_GET['month']].' ปี '.($_GET['year']+543)?>
                                </h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form class="form-inline" onsubmit="return false;">
                                    <!-- <button type="button" id="btnRefresh" class="btn btn-primary"><i
                                            class="fa fa-refresh" aria-hidden="true"></i> Refresh</button> -->


                                </form>
                                <?php
                                // echo $_GET['year'];
                                // echo $_GET['month'];
                                // echo $_GET['vat'];
                                ?>
                                <table name="table_salemonth" id="table_salemonth" class="table">
                                    <thead>
                                        <tr>
                                            <th>ลำดับที่</th>
                                            <th style="text-align:center;">วันที่</th>
                                            <th style="text-align:center;">เลขที่เอกสาร</th>
                                            <th>ชื่อเจ้าหนี้</th>
                                            <th>มูลค่าสินค้า</th>
                                            <?php if($_GET['vat']=='Y')
                                            {
                                                echo'<th>ภาษี</th>';
                                                echo'<th>รวมเงิน</th>';
                                            }                                      
                                            
                                            ?>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
        $sql = "SELECT a.socode,b.sodate,b.invoice,b.invdate,c.cusname,sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100))-sum(((((a.amount*a.price)-((a.amount*a.price)*a.discount/100))*100)/107)*7/100) as price,sum(((((a.amount*a.price)-((a.amount*a.price)*a.discount/100))*100)/107)*7/100) as vat,sum((a.amount*a.price)-((a.amount*a.price)*a.discount/100)) as total,remark ";        
        $sql .= " FROM sodetail as a inner join somaster as b on (a.socode=b.socode) inner join customer as c on (b.cuscode=c.cuscode) ";
        $sql .= " where b.vat = '".$_GET['vat']."' and SUBSTRING(b.invdate,1,4)='".$_GET['year']."' and SUBSTRING(b.invdate,6,2) = '".$_GET['month']."' and (a.supstatus = '03' or a.supstatus = '04')";
        $sql .= " GROUP by a.socode";
        $query = mysqli_query($conn,$sql);
        $numrow = 1;
        $totalprice=0;$totalvat=0;$totaltotal=0;
        while($row = $query->fetch_assoc())
        {
        echo '<tr>';
        echo '<td>'.$numrow.'</td>';
        echo '<td style="text-align:center;">'.$row["invdate"].'</td>';
        echo '<td style="text-align:center;">'.$row["invoice"].'</td>';
        echo '<td>'.$row["cusname"].'</td>';
        
        if($_GET['vat']=='Y')
        {
        echo '<td>'.number_format($row["price"],2).'</td>';
        echo '<td>'.number_format($row["vat"],2).'</td>';        
        
        }
        echo '<td>'.number_format($row["total"],2).'</td>';
        echo '<td></td>';
        echo '</tr>';
        $numrow++;
        $totalprice+=$row["price"];
        $totalvat+=$row["vat"];
        $totaltotal+=$row["total"];
        }
        echo '<tfoot><tr>';
        echo '<th></th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '<th>รวม</th>';
        
        if($_GET['vat']=='Y')
        {
        echo '<th>'.number_format($totalprice,2).'</th>';
        echo '<th>'.number_format($totalvat,2).'</th>';
        }
        echo '<th>'.number_format($totaltotal,2).'</th>';
        echo '<th></th>';
        echo '</tr></tfoot>';
        ?>
                                    </tbody>
                                </table>

                                <br>
                                <!-- Tab panes -->
                                <div class="tab-content" style="text-align:center">

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

    <?php 
    
    include_once ROOT.'/index_js.php';
    

    include_once('js.php'); 
    ?>
</body>

</html>