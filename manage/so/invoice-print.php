<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ใบคำขอขายสินค้า <?php
                    echo $_POST['printsocode'];
                    ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
    * {
        font-family: "Angsana New";
        font-weight: normal;
        font-size: 16px;
        margin: 10px, 0, 0, 0;
        padding: 0;
    }

    .total {
        float: right
    }

    .totalnum {
        float: center
    }

    @page {

       
        /* auto is the initial value */

    }

    @media print {


        /* Hide scrollbar for Chrome, Safari and Opera */
        body::-webkit-scrollbar {
            display: none;
        }


        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12 {
            float: left;
        }

        .col-sm-12 {
            width: 100%;
        }

        .col-sm-11 {
            width: 91.66666667%;
        }

        .col-sm-10 {
            width: 83.33333333%;
        }

        .col-sm-9 {
            width: 75%;
        }

        .col-sm-8 {
            width: 66.66666667%;
        }

        .col-sm-7 {
            width: 58.33333333%;
        }

        .col-sm-6 {
            width: 50%;
        }

        .col-sm-5 {
            width: 41.66666667%;
        }

        .col-sm-4 {
            width: 33.33333333%;
        }

        .col-sm-3 {
            width: 25%;
        }

        .col-sm-2 {
            width: 16.66666667%;
        }

        .col-sm-1 {
            width: 8.33333333%;
        }


    }

    .navigation,
    .footer,
    .header {
        display: none;
    }
    </style>
    <?php 
    include_once('../../conn.php');
    include_once('../config.php');
    include_once ROOT .'/index_css.php';
    ?>
</head>
<?php
	

	$sql = "SELECT a.socode,a.sodate,a.deldate,a.payment,a.paydate,a.remark,a.currency,a.vat,a.salecode,a.date,a.time,c.stcode,c.stname1,a.cuscode,d.cusname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,d.tel,d.taxnumber,b.supstatus ";
	$sql .= "FROM `somaster` as a inner join sodetail as b on (a.socode=b.socode) inner join stock as c on (c.stcode=b.stcode) inner join customer as d on (a.cuscode=d.cuscode) ";
	$sql .= "where a.socode = '".$_POST['printsocode']."'  LIMIT 1";
	// echo $sql;
	$query = mysqli_query($conn,$sql);
    
	
	$json_result=array(
        "socode" => array(),
		"sodate" => array(),
		"deldate" => array(),
        "payment" => array(),
        "paydate" => array(),
        "date" => array(),
		"time" => array(),
        "remark" => array(),
		"currency" => array(),
		"vat" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"cuscode" => array(),
		"cusname" => array(),
        "address" => array(),
        "tel" => array(),
        "taxnumber" => array(),
        "salecode" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').' '.($row["district"] == '' ? '': '<br>อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['socode'],$row["socode"]);
			array_push($json_result['sodate'],$row["sodate"]);
			array_push($json_result['deldate'],$row["deldate"]);
            array_push($json_result['payment'],$row["payment"]);
            array_push($json_result['paydate'],$row["paydate"]);
            array_push($json_result['date'],$row["date"]);
            array_push($json_result['time'],$row["time"]);
            array_push($json_result['remark'],$row["remark"]);
			array_push($json_result['currency'],$row["currency"]);
			array_push($json_result['vat'],$row["vat"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['cuscode'],$row["cuscode"]);
			array_push($json_result['cusname'],$row["cusname"]);
            array_push($json_result['address'],$address);
            array_push($json_result['tel'],$row["tel"]);
            array_push($json_result['taxnumber'],$row["taxnumber"]);
            array_push($json_result['salecode'],$row["salecode"]);
            array_push($json_result['supstatus'],$row["supstatus"]);
            // echo $row["pocode"];
			
        }
?>

<body>
    <h3 style="margin-top:20px;padding:0px;font-family:'Angsana New';" class="pull-right">ใบคำขอขายสินค้า</h3>
    <div class="row">
        <div class="col-sm-7">
            <h6>
                <?php 
                if($json_result["vat"][0]=='Y')
                    {
                    ?>
                <h4> 
                บริษัท เคเอ็ม.5 ออโต้ จำกัด ( สำนักงานใหญ่ )<br> KM.5 AUTO COMPANY LIMITED</h4>
                51/33 หมู่7 ตำบลพลูตาหลวง อำเภอสัตหีบ จังหวัดชลบุรี 20180
                <br>TEL. 066-149-9223 , 082-556-6594 <br>
                Email: KM5AUTO2020@GMAIL.COM , WWW.KM5AUTO.COM<br>
                หมายเลขประจำตัวผู้เสียภาษี : <b>0205563000492</br>
                <?php
                }
                else
                {
                ?>
                <img src="../../img/motul.png" style="margin-left:30px;" width="230" height="70">
                <?php
                }
                ?>
            </h6>
        </div>
        <div class="col-sm-5">

            <div class="panel-body">
                วันที่ : <?php                    
                    echo substr($json_result["date"][0],8).'/'.substr($json_result["date"][0],5,2).'/'.substr($json_result["date"][0],0,4);
                    ?><br>
                เวลา : <?php                    
                    echo substr($json_result["time"][0],0,5);
                    ?> น.<br><br>
                    <?php
                     if ($json_result["vat"][0]=='Y')
                     {
                         $vattype = 'Y';
                         echo 'VAT';
                     }
                     else
                     {
                         $vattype = 'N';
                         echo 'NO-VAT';
                     }
                    ?>
            </div>

        </div>

        <!-- /.col -->
    </div>


    <!-- info row -->
    <div class="row" >
        <div class="col-sm-7">
            <div class="panel panel-default">
                <div class="panel-body" style="padding:2px 10px;">
                    <font size="-1">
                        รหัสลูกค้า : <?php
                    echo $json_result["cuscode"][0];
                    ?><br>
                        ชื่อลูกค้า : <?php
                    echo $json_result["cusname"][0];
                    ?><br>
                        ที่อยู่ : <?php
                    echo $json_result["address"][0];
                    ?><br>
                        โทร/TEL : <?php
                    echo $json_result["tel"][0];
                    ?><br>
                        เลขประจำตัวผู้เสียภาษี : <?php
                    echo $json_result["taxnumber"][0];
                    ?>
                    </font>
                </div>
            </div>
        </div>
        <?php
            if($json_result["salecode"][0]=='')
            {
                $sql = "SELECT firstname,lastname,salecode ";
                $sql .= "FROM user ";
                $sql .= "where salecode = '0001' ";
            }
            else
            {            
            $sql = "SELECT firstname,lastname,salecode ";
            $sql .= "FROM user ";
            $sql .= "where salecode = '".$json_result["salecode"][0]."' ";
            }
            $query = mysqli_query($conn,$sql);
            $row = $query->fetch_assoc();
            ?>
        <!-- /.col -->
        <div class="col-sm-5">
            <div class="panel panel-default">
                <div class="panel-body" style="padding:2px 10px;">
                    เลขที่ใบสั่งขาย : <?php
                    echo $json_result["socode"][0];
                    ?><br>
                    รหัสพนักงานขาย : <?php
                    echo $row["salecode"].' '.$row["firstname"].' '.$row["lastname"];
                    ?><br>
                    เงื่อนไขชำระเงิน : <?php
                    echo $json_result["payment"][0];
                    ?><br>
                    วันที่กำหนดชำระเงิน : <?php
                    echo substr($json_result["paydate"][0],8).'/'.substr($json_result["paydate"][0],5,2).'/'.substr($json_result["paydate"][0],0,4);
                    ?><br>
                    วันที่จัดส่ง : <?php                    
                    echo substr($json_result["sodate"][0],8).'/'.substr($json_result["sodate"][0],5,2).'/'.substr($json_result["sodate"][0],0,4);
                    ?><br><br>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php
            $sql = "SELECT b.socode,b.sono,c.stcode,c.stname1,c.sellprice,b.amount,b.unit,b.price,b.discount,b.supstatus ";
            $sql .= "FROM sodetail as b inner join stock as c on (c.stcode=b.stcode) ";
            $sql .= "where b.socode = '".$_POST['printsocode']."' and b.giveaway = 0 order by b.sono ";
            
            $query = mysqli_query($conn,$sql);

            $sql1 = "SELECT b.socode,b.sono,c.stcode,c.stname1,c.sellprice,b.amount,b.unit,b.price,b.discount,b.supstatus ";
            $sql1 .= "FROM sodetail as b inner join stock as c on (c.stcode=b.stcode) ";
            $sql1 .= "where b.socode = '".$_POST['printsocode']."' and b.giveaway = 1 order by b.sono ";
            
            $query1 = mysqli_query($conn,$sql1);
                
            ?>
    <!-- Table row -->
    <div class="row" >
        <div class="col-xs-12 table-responsive">
            <div class="panel panel-default" >
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width:5%;text-align:center;">No.</th>
                            <th style="width:10%;text-align:center;">รหัสสินค้า</th>
                            <th style="text-align:center;">รายการสินค้า</th>
                            <th style="width:8%;text-align:center;">จำนวน</th>
                            <th style="text-align:center;">หน่วย</th>
                            <th style="text-align:center;">ราคา</th>
                            <th style="text-align:center;">ส่วนลด</th>
                            <th style="text-align:center;">ขาย</th>
                            <th style="text-align:center;">จำนวนเงิน</th>
                        </tr>
                    </thead>
                    <tbody style="margin: 0;padding: 0;">
                        <?php
                            $total=0;
                            $discount=0;
                            $subtotal=0;
                            while($row2 = $query->fetch_assoc()) {
                                echo '<tr><td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row2["sono"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row2["stcode"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:left;">'.$row2["stname1"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row2["amount"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row2["unit"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:right;">'.$row2["price"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row2["discount"].' %'.'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:right;">'.($row2["price"]-(($row2["price"]*($row2["discount"])/100))).'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:right;">'.number_format((($row2["amount"]*$row2["price"])-((($row2["amount"]*$row2["price"])*($row2["discount"])/100))),2).'</td></tr>';
                                // $total++;
                                $total+=($row2["price"]*$row2["amount"]);
                                $discount+=(((($row2["amount"]*$row2["price"])*($row2["discount"])/100)));
                                $subtotal+=(($row2["amount"]*$row2["price"])-((($row2["amount"]*$row2["price"])*($row2["discount"])/100)));
                               
                            }
                            

                            while($row1 = $query1->fetch_assoc()) {
                                echo '<tr><td style="padding-top:0px;padding-bottom:0px;text-align:center;"></td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row1["stcode"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:left;">'.$row1["stname1"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row1["amount"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">'.$row1["unit"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:right;">'.$row1["sellprice"].'</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:center;">แถมฟรี</td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:right;"></td>
                                <td style="padding-top:0px;padding-bottom:0px;text-align:right;"></td></tr>';
                                // $total++;
                                $total+=($row1["price"]*$row1["amount"]);
                                $discount+=(((($row1["amount"]*$row1["price"])*($row1["discount"])/100)));
                                $subtotal+=(($row1["amount"]*$row1["price"])-((($row1["amount"]*$row1["price"])*($row1["discount"])/100)));
                               
                            }
                            
                            for($i=(mysqli_num_rows($query)+mysqli_num_rows($query1));$i<14;$i++)
                            {
                                echo '<tr>
                                <td style="padding:12px;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
                            
                            }
                            if ($vattype=='Y')
                                $vat = (($subtotal*100)/107)*7/100;
                                else
                                $vat = 0;
                            ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="text-align:left;" colspan="3">หมายเหตุ/Remark <br><?php
                    echo $json_result["remark"][0];
                    ?><br><br></td>
                            <td style="text-align:left;" colspan="6">ราคาสินค้า / TOTAL <span
                                    class="total"><?php echo number_format($subtotal-($vat),2);?></span>
                                <br>ภาษีมูลค่าเพิ่ม / VAT<span class="total"><?php echo number_format($vat,2);?></span>
                                <br>จำนวนเงินรวมทั้งสิ้น<span
                                    class="total"><?php echo number_format($subtotal,2);?></span>
                            </td>

                        </tr>
                        <tr style="font-size:10px;text-align:left;">
                            <td>Note: </td>
                            <td colspan="8">
                                - เมื่อสินค้าถึงผู้ซื้อไม่รับคืนทุกรณี ยกเว้น
                                ตรวจสอบสินค้าชำรุดจากการขนส่งหรือเสียหายเกินกว่าจะคงสภาพเป็นสินค้าได้<br>
                                &nbsp; ผู้ซื้อต้องแจ้งผู้ขายเพื่อทำการเปลี่ยนสินค้าและรับทราบปัญหาภายใน 7
                                วันหากเกินกำหนดเวลา ถือว่าผู้ซื้อยอมรับสินค้านั้น<br>
                                - ในกรณีที่ชำระเป็นเช็คหรือโอนผ่านบัญชีธนาคาร กรุณาสั่งจ่ายในนามบัญชี <br>
                                <?php 
                                if($json_result["vat"][0]=='Y')
                                {
                                ?>
                                    &nbsp; <b>ชื่อบัญชี บริษัท เคเอ็ม.5 ออโต้ จำกัด ธนาคารกสิกรไทย สาขาสัตหีบ เลขที่บัญชี 070-3-94567-8</b><br>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    &nbsp; <b>ชื่อบัญชี นายนพดล มุกดาสนิท ธนาคารกสิกรไทย สาขาสัตหีบ เลขที่บัญชี 023-3-75646-6</b><br>
                                <?php
                                    }
                                    ?>
                                - หากชำระเงินเกินกำหนด บริษัทฯ จะคิดดอกเบี้ย 1.5% ต่อเดือน
                            </td>
                        </tr>
                        <tr style="text-align:center;">
                            <td colspan="3">
                                <br><br><?php
                    echo $row["firstname"].' '.$row["lastname"];
                    ?><br>(ผู้ขอขายสินค้า)
                            </td>
                            <td colspan="3">
                                <br><br>ปรัชญา จรัสกิตติตระกูล<br>(ผู้ตรวจสอบ/ผู้อนุมัติ)
                            </td>
                            <td colspan="3">
                                <br>........................................<br>สุพรรณี ดาราพันธุ์<br>(ผู้อนุมัติ)
                            </td>

                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</body>

</html>

<script type="text/javascript">
window.print();
</script>