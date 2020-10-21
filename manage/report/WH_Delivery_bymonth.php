<?php
session_start();

if ($_SESSION["user_login"] <>""){
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=tis-620">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>��Ң��觵�������Ҥ�����͹</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

    <!-- Morris chart -->
    <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/iCheck/all.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Pace style -->
    <link rel="stylesheet" href="../plugins/pace/paceloading.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


    <script src="../chart-js/Chart.bundle.js"></script>
    <script src="../chart-js/utils.js"></script>
    <style>
    canvas {
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
    }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">

    <!-- Preloader -->
    <?
    // $strYear = '2018';

    if ($strYear=="") 
        $strYear = date("Y");
?>


    <!--End off Preloader -->

    <div class="wrapper">

        <?include("../menu_header.php");?>

        <?include("../menu_left.php");?>
        <?include("../func_pae.php");?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <section class="content-header">
                    <H1 id="menuName" >��§ҹ��Ң����Թ��������͹</H1>
                    <ol class="breadcrumb">
                        WH_Delivery_bymonth
                    </ol>
                </section>
                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12" id="frmList">
                        <div class="nav-tabs-custom">
                            <ul id="select_tap" class="nav nav-tabs">
                                <li class="active"><a href="#region" data-toggle="tab">��������Ҥ</a></li>
                                <li><a href="#truck" data-toggle="tab">���������ö</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="region">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <form class="form-inline" onsubmit="return false;">
                                                <div class="form-group">
                                                    <select class="form-control" id="select_year2" name="select_year2"
                                                        style="width: 100%;">
                                                        <?php 
															$year=date("Y")+543;
															for($count=0;$count<10;$count++)
																echo '<option value="'.$year.'" >�� '.$year--.'</option>'                    
														?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="box-body">
                                            <ul id="select_tap_region" class="nav nav-tabs">
                                                <li class="active"><a href="#central" data-toggle="tab">�Ҥ��ҧ</a>
                                                </li>
                                                <li><a href="#east" data-toggle="tab">�Ҥ���ѹ�͡</a></li>
                                                <li><a href="#north" data-toggle="tab">�Ҥ�˹��</a></li>
                                                <li><a href="#northeast" data-toggle="tab">�Ҥ���ѹ�͡��§�˹��</a>
                                                </li>
                                                <li><a href="#south" data-toggle="tab">�Ҥ��</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="central">
                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3>��ا෾��л������</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablecentral" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <div>
                                                                <div style="text-align:right;">
                                                                    <font size="4px">
                                                                        <!-- <i id="plus-tablecentral" class="fa fa-plus-square"
                                                                           onclick='onClick_Plus(this.id,<?php echo $strYear?>);' aria-hidden="true"></i>
                                                                        <i id="minus-tablecentral" class="fa fa-minus-square"
                                                                            aria-hidden="true"></i> -->
                                                                    </font>
                                                                </div>
                                                                <div style="text-align:center;" id="tablecentral-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="east">

                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3>�Ҥ���ѹ�͡</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tableeast" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;" id="tableeast-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="north">
                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3>�Ҥ�˹��</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablenorth" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;" id="tablenorth-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="northeast">
                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3>�Ҥ���ѹ�͡��§�˹��</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablenortheast" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;"
                                                                    id="tablenortheast-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="south">

                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3>�Ҥ��</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablesouth" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;" id="tablesouth-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="truck">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <form class="form-inline" onsubmit="return false;">
                                                <div class="form-group">
                                                    <select class="form-control" id="select_year" name="select_year"
                                                        style="width: 100%;">
                                                        <? 
															$year=date("Y")+543;
															for($count=0;$count<10;$count++)
																echo '<option value="'.$year.'" >�� '.$year--.'</option>'                    
														?>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="box-body">
                                            <ul id="select_tap_truck" class="nav nav-tabs">
                                                <li class="active"><a href="#car6" data-toggle="tab">ö 6 ���</a> </li>
                                                <li><a href="#car10" data-toggle="tab">ö 10 ���</a></li>
                                                <li><a href="#car18" data-toggle="tab">ö 18 ���</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane active" id="car6">
                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3>ö 6 ���</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablecar6" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;" id="tablecar6-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="car10">

                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3> ö 10 ���</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablecar10" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;" id="tablecar10-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="tab-pane" id="car18">

                                                    <div class="box box-default">
                                                        <div class="box-header with-border">
                                                            <center>
                                                                <h3> ö 18 ���</h3>
                                                            </center>
                                                        </div>
                                                        <div class="box-body">
                                                            <table id="tablecar18" class="table table-hover">
                                                                <thead>

                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <br>
                                                        <div class="box box-default">
                                                            <div class="box-header with-border">
                                                                <br>
                                                                <div style="text-align:center;" id="tablecar18-chart">
                                                                    FusionCharts will render here</div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

            </section>
            <!-- /.content -->
        </div>

        <?include("../footer.php");?>





        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Sparkline -->
    <script src="../bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- PACE -->
    <script src="../bower_components/PACE/pace.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../plugins/iCheck/icheck.min.js"></script>
    <!-- daterangepicker -->
    <script src="../bower_components/moment/min/moment.min.js"></script>
    <script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- FusionCharts -->
    <script type="text/javascript" src="../FusionCharts/js/fusioncharts.js"></script>
    <!-- jQuery-FusionCharts -->
    <script type="text/javascript" src="../FusionCharts/integrations/jquery/js/jquery-fusioncharts.js"></script>
    <!-- Fusion Theme -->
    <script type="text/javascript" src="../FusionCharts/js/themes/fusioncharts.theme.fusion.js"></script>

    <!-- page script -->
    <script type="text/javascript">
    // To make Pace works on Ajax calls
    $(document).ajaxStart(function() {
        Pace.restart()
    })
    $('.ajax').click(function() {
        $.ajax({
            url: '#',
            success: function(result) {
                $('.ajax-content').html('<hr>Ajax Request Completed !')
            }
        })
    })
    </script>
    <script>
    $(function() {

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        })
        var d = new Date();
        var yearnow = d.getFullYear();
        CreateReport('tablecentral', yearnow);
        CreateReport('tableeast', yearnow);
        CreateReport('tablenorth', yearnow);
        CreateReport('tablenortheast', yearnow);
        CreateReport('tablesouth', yearnow);

        CreateReport('tablecar6', yearnow);
        CreateReport('tablecar10', yearnow);
        CreateReport('tablecar18', yearnow);

        $("#select_year2").change(function() {
            CreateReport('tablecentral', $("#select_year2").val() - 543);
            CreateReport('tableeast', $("#select_year2").val() - 543);
            CreateReport('tablenorth', $("#select_year2").val() - 543);
            CreateReport('tablenortheast', $("#select_year2").val() - 543);
            CreateReport('tablesouth', $("#select_year2").val() - 543);
            // alert($("#select_year2").val());
        });

        $("#select_year").change(function() {
            CreateReport('tablecar6', $("#select_year").val() - 543);
            CreateReport('tablecar10', $("#select_year").val() - 543);
            CreateReport('tablecar18', $("#select_year").val() - 543);
        });


    })


    function CreateReport(table, year) {
        $("#" + table + " thead tr").empty();
        $("#" + table + " tbody tr").empty();

        $.ajax({
            type: "POST",
            url: "ajax/create_table.php",
            data: {
                table: table,
                year: year
            },
            success: function(result) {
                // console.log(result);

                $('#' + table + ' thead').append(
                    '<tr bgcolor="#BEBEBE"><td align="center" height="35" width="100">Description</td><td align="center" width="60">Jan</td><td align="center" width="60">Feb</td><td align="center" width="60">Mar</td><td align="center" width="60">Apr</td><td align="center" width="60">May</td><td align="center" width="60">Jun</td><td align="center" width="60">Jul</td><td align="center" width="60">Aug</td><td align="center" width="60">Sep</td><td align="center" width="60">Oct</td><td align="center" width="60">Nov</td><td align="center" width="60">Dec</td></tr>'
                );
                $('#' + table + ' tbody').append(
                    '<tr><td align="center" height="30">��Ң���</td><td align="right" >' +
                    formatMoney(result.delivCost_Jan, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Feb, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Mar, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Apr, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_May, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Jun, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Jul, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Aug, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Sep, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Oct, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Nov, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivCost_Dec, 0) +
                    '</td></tr><tr><td align="center" height="30">���˹ѡ (Tons)</td><td align="right" >' +
                    formatMoney(result.delivQuan_Jan, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Feb, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Mar, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Apr, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_May, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Jun, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Jul, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Aug, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Sep, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Oct, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Nov, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.delivQuan_Dec, 0) +
                    '</td></tr><tr><td align="center" height="30">�ҷ/��.</td><td align="right" >' +
                    formatMoney(result.bahtKg_Jan, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Feb, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Mar, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Apr, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_May, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Jun, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Jul, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Aug, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Sep, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Oct, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Nov, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.bahtKg_Dec, 2) +
                    '</td></tr>');

                var caption;
                if (table == 'tablecentral')
                    caption = "��ا෾��л������";
                else if (table == 'tableeast')
                    caption = "�Ҥ���ѹ�͡";
                else if (table == 'tablenorth')
                    caption = "�Ҥ�˹��";
                else if (table == 'tablenortheast')
                    caption = "�Ҥ���ѹ�͡��§�˹��";
                else if (table == 'tablesouth')
                    caption = "�Ҥ��";
                else if (table == 'tablecar6')
                    caption = "ö 6 ���";
                else if (table == 'tablecar10')
                    caption = "ö 10 ���";
                else if (table == 'tablecar18')
                    caption = "ö 18 ���";

                $('#' + table + '-chart').insertFusionCharts({
                    type: "column3d",
                    width: "700",
                    height: "400",
                    dataFormat: "json",
                    dataSource: {
                        // Chart Configuration
                        "chart": {
                            "caption": caption,
                            "subCaption": "�� " + (year + 543),
                            "xAxisName": "Month",
                            "yAxisName": "Baht / Kg.",
                            "theme": "fusion",
                        },
                        // Chart Data
                        "data": [{
                            "label": "Jan",
                            "value": formatMoney(result.bahtKg_Jan, 2)
                        }, {
                            "label": "Feb",
                            "value": formatMoney(result.bahtKg_Feb, 2)
                        }, {
                            "label": "Mar",
                            "value": formatMoney(result.bahtKg_Mar, 2)
                        }, {
                            "label": "Apr",
                            "value": formatMoney(result.bahtKg_Apr, 2)
                        }, {
                            "label": "May",
                            "value": formatMoney(result.bahtKg_May, 2)
                        }, {
                            "label": "Jun",
                            "value": formatMoney(result.bahtKg_Jun, 2)
                        }, {
                            "label": "Jul",
                            "value": formatMoney(result.bahtKg_Jul, 2)
                        }, {
                            "label": "Aug",
                            "value": formatMoney(result.bahtKg_Aug, 2)
                        }, {
                            "label": "Sep",
                            "value": formatMoney(result.bahtKg_Sep, 2)
                        }, {
                            "label": "Oct",
                            "value": formatMoney(result.bahtKg_Oct, 2)
                        }, {
                            "label": "Nov",
                            "value": formatMoney(result.bahtKg_Nov, 2)
                        }, {
                            "label": "Dec",
                            "value": formatMoney(result.bahtKg_Dec, 2)
                        }]
                    }
                });
            }
        });

    }

    function onClick_Plus(id, year) {
        // CreateReport('tablecentral', year);
        // $('#tablecentral-chart').resizeTo(Number($('#tablecentral-chart').width) + 20);
        // tablecentral_width=tablecentral_width+100;
        // $('#tablecentral-chart').updateFusionCharts({width: tablecentral_width,height: "90%"});
        // plus-tablecentral
        // alert(year);
    }
    function onClick_Minus(id, year) {
    }
    </script>


</body>
<?php
 odbc_close_all();	
}else{
header( "location: ../login.php");
 exit(0);	
}?>

</html>