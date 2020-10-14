<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ใบสั่งซื้อ <?php
                    echo $_POST['printpocode'];
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
    body {
        /* width: 595px; */
        /* to centre page on screen*/
        margin-left: auto;
        margin-right: auto;
    }

    .total {
        float: right
    }
    .totalnum {
        float: center
    }
    @page 
    {
        size: auto;   /* auto is the initial value */
        
    }
 .navigation,.footer,.header
        {
          display:none;
        }
    @media print {

        html,
        body {
            height: 100%;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
            -ms-overflow-style: none;
            /* IE and Edge */
            scrollbar-width: none;
            /* Firefox */
        }

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
    </style>
    <?php 
    include_once('../../conn.php');
    include_once('../config.php');
    include_once ROOT .'/index_css.php';
    ?>
</head>
<?php
	

	$sql = "SELECT a.pocode,a.podate,a.deldate,a.payment,a.poqua,a.currency,a.vat,c.stcode,c.stname1,a.supcode,d.supname,d.idno,d.road,d.subdistrict,d.district,d.province,d.zipcode,d.tel,d.taxnumber,b.supstatus ";
	$sql .= "FROM `pomaster` as a inner join podetail as b on (a.pocode=b.pocode) inner join stock as c on (c.stcode=b.stcode) inner join supplier as d on (a.supcode=d.supcode) ";
	$sql .= "where a.pocode = '".$_POST['printpocode']."'  LIMIT 1";
	
	$query = mysqli_query($conn,$sql);

	
	$json_result=array(
        "pocode" => array(),
		"podate" => array(),
		"deldate" => array(),
		"payment" => array(),
		"poqua" => array(),
		"currency" => array(),
		"vat" => array(),
		"stcode" => array(),
		"stname1" => array(),
		"supcode" => array(),
		"supname" => array(),
        "address" => array(),
        "tel" => array(),
        "taxnumber" => array(),
		"supstatus" => array()
		
		);
		
        while($row = $query->fetch_assoc()) {
			$address = ($row["idno"] == '' ? '': 'เลขที่ '.$row["idno"].' ').($row["road"] == '' ? '': 'ถนน'.$row["road"].' ');
			$address .= ($row["subdistrict"] == '' ? '': 'ต.'.$row["subdistrict"].'  ').'<br>'.($row["district"] == '' ? '': 'อ.'.$row["district"].'  ');
			$address .= ($row["province"] == '' ? '': 'จ.'.$row["province"].' ').($row["zipcode"] == '' ? '': ' '.$row["zipcode"]);

            array_push($json_result['pocode'],$row["pocode"]);
			array_push($json_result['podate'],$row["podate"]);
			array_push($json_result['deldate'],$row["deldate"]);
			array_push($json_result['payment'],$row["payment"]);
			array_push($json_result['poqua'],$row["poqua"]);
			array_push($json_result['currency'],$row["currency"]);
			array_push($json_result['vat'],$row["vat"]);
			array_push($json_result['stcode'],$row["stcode"]);
			array_push($json_result['stname1'],$row["stname1"]);
			array_push($json_result['supcode'],$row["supcode"]);
			array_push($json_result['supname'],$row["supname"]);
            array_push($json_result['address'],$address);
            array_push($json_result['tel'],$row["tel"]);
            array_push($json_result['taxnumber'],$row["taxnumber"]);
            array_push($json_result['supstatus'],$row["supstatus"]);
            // echo $row["pocode"];
			
        }
?>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <br>

            <div class="row">
                <div class="col-xs-12" style="text-align:center;">
                    <h2>
                        <!-- <i class="fa fa-globe"></i> -->

                        <h3 class="pull-center">ใบสั่งซื้อ Purchase Order</h3>
                        <h4 class="pull-center">บริษัท เคเอ็ม.5 ออโต้ จำกัด (KM.5 AUTO COMPANY LIMITED)</h4>
                        <h4 class="pull-center">51/33 หมู่7 ตำบลพลูตาหลวง อำเภอสัตหีบ จังหวัดชลบุรี 20180</h4>
                    </h2>
                    <h6>
                        TEL. 066-149-9223 , 082-556-6594 Email: KM5AUTO2020@GMAIL.COM , WWW.KM5AUTO.COM
                    </h6>
                </div>

                <!-- /.col -->
            </div>

            <br>
            <div style="text-align:right;">หมายเลขประจำตัวผู้เสียภาษี : <b>0205563000492</b></div>
            <br>

            <!-- info row -->
            <div class="row">
                <div class="col-sm-7">
                    <address>
                        ชื่อผู้ขาย : <?php
                    echo $json_result["supname"][0];
                    ?><br>
                        ที่อยู่ : <?php
                    echo $json_result["address"][0];
                    ?><br>
                        โทร/TEL: <?php
                    echo $json_result["tel"][0];
                    ?><br>
                        เลขประจำตัวผู้เสียภาษี: <?php
                    echo $json_result["taxnumber"][0];
                    ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            เลขที่เอกสารแจ้งซื้อ : <?php
                    echo $json_result["pocode"][0];
                    ?><br>
                            วันที่ : <?php                    
                    echo substr($json_result["podate"][0],8).'-'.substr($json_result["podate"][0],5,2).'-'.substr($json_result["podate"][0],0,4);
                    ?><br><br>
                            กำหนดวันส่งสินค้า : <?php
                    echo substr($json_result["deldate"][0],8).'-'.substr($json_result["deldate"][0],5,2).'-'.substr($json_result["deldate"][0],0,4);
                    ?>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <br>
            <?php
            $sql = "SELECT b.pocode,b.pono,c.stcode,c.stname1,b.amount,b.unit,b.price,b.discount,b.supstatus ";
            $sql .= "FROM podetail as b inner join stock as c on (c.stcode=b.stcode) ";
            $sql .= "where b.pocode = '".$_POST['printpocode']."' order by b.pono ";
            
            $query = mysqli_query($conn,$sql);
        
            
            $json_result=array(
                "pocode" => array(),
                "pono" => array(),
                "stcode" => array(),
                "stname1" => array(),
                "amount" => array(),
                "unit" => array(),
                "price" => array(),
                "discount" => array(),
                "supstatus" => array()
                
                );
                
                
            ?>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <div class="panel panel-default">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:5%;text-align:center;">No.</th>
                                    <th style="width:10%;text-align:center;">รหัสสินค้า</th>
                                    <th style="width:60%;text-align:center;">รายการสินค้า</th>
                                    <th style="width:10%;text-align:center;">จำนวน</th>
                                    <th style="width:15%;text-align:center;">หน่วย</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $total=0;
                            $discount=0;
                            $subtotal=0;
                            while($row = $query->fetch_assoc()) {
                                echo '<tr><td style="text-align:center;">'.$row["pono"].'</td>
                                <td style="text-align:center;">'.$row["stcode"].'</td>
                                <td style="text-align:left;">'.$row["stname1"].'</td>
                                <td style="text-align:center;">'.$row["amount"].'</td>
                                <td style="text-align:center;">'.$row["unit"].'</td>
                                </tr>';
                                $total++;
                               
                            }
                            
                            for($i=$total;$i<10;$i++)
                            {
                                echo '<tr>
                                <td style="padding:18px;"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>';
                            }
                            ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td style="text-align:left;" colspan="3">หมายเหตุ/Remark <br><br><br></td>
                                    <td colspan="2"> รวมเป็นจำนวน <span
                                            class="total"><?php echo number_format($total,0);?>&nbsp;  &nbsp; &nbsp;รายการ </span>                                        
                                    </td>
                                    
                                </tr>
                                <tr style="text-align:center;">
                                    <td colspan="2">
                                    </td>
                                    <td colspan="3">
                                        <div class="row">
                                            <div class="col-xs-6">
                                            ................................<br>................................<br>(ผู้ตรวจสอบ/ผู้ขอซื้อ)
                                            </div>
                                            <div class="col-xs-6">
                                            ................................<br>................................<br>(ผู้อนุมัติ)
                                            </div>
                                    </td>



                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>

<script type="text/javascript">
window.print();
</script>