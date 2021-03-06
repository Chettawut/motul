<script type="text/javascript">
$(function() {

    var d = new Date();
    var yearnow = d.getFullYear();
    getData();
    CreateReport('table_top_sales', $("#select_year").val() - 543, $("#vat").val(), $("#month").val(), $(
        "#stcode").val());
})

$("#select_year").change(function() {
    CreateReport('table_top_sales', $("#select_year").val() - 543, $("#vat").val(), $("#month").val(), $(
        "#stcode").val());
});

$("#vat").change(function() {
    CreateReport('table_top_sales', $("#select_year").val() - 543, $("#vat").val(), $("#month").val(), $(
        "#stcode").val());
});
$("#month").change(function() {
    CreateReport('table_top_sales', $("#select_year").val() - 543, $("#vat").val(), $("#month").val(), $(
        "#stcode").val());
});

$("#stcode").change(function() {
    CreateReport('table_top_sales', $("#select_year").val() - 543, $("#vat").val(), $("#month").val(), $(
        "#stcode").val());
});

$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
    var currId = $(e.target).attr("id");
    // alert(currId);
    if (currId === 'tap_one_code') {
        CreateReport('table_top_sales', $("#select_year").val() - 543, $("#vat").val(), $("#month").val(), $(
            "#stcode").val());
        $('#stcode').show();
        $('#month').hide();
    } else
    {
        $('#stcode').hide();
        $('#month').show();
    }
        


    //   $('#lastTab').html(currId);
})

function getData() {

    $("#table_code tbody tr").empty();
    $.ajax({
        type: "POST",
        url: "ajax/get_code.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.data_code.length; count++) {


                $('#table_code').append(
                    '<tr id="' + result
                    .data_code[
                        count] + '" data-whatever="' + result.data_code[
                        count] + '"><td>' + result.num_order[count] + '</td><td>' +
                    '<input type="text" class="form-control" onchange="setData(' +
                    result
                    .num_order[
                        count] + ',' + result.data[
                        count] +
                    ')" id="data' + result
                    .num_order[count] +
                    '" name="data' + result.num_order[count] + '" value="' + result.data[
                        count] +
                    '"></td></tr>');

                $("#stcode").append(new Option(result.data[
                    count], result.data[
                    count]));
            }

        }
    });
}

function setData(row) {

    $.ajax({
        type: "POST",
        url: "ajax/set_code.php",
        data: "row=" + row + "&value=" + $('#data' + row).val(),
        success: function(result) {
            if (result.status == '0')
                alert(result.message);
            // getData();


        }
    });
}


function CreateReport(table, year, vat, month, stcode) {
    $("#" + table + " thead tr").empty();
    $("#" + table + " tbody tr").empty();
    $("#table_one_product thead tr").empty();
    $("#table_one_product tbody tr").empty();

    $.ajax({
        type: "POST",
        url: "ajax/create_table.php",
        data: {
            vat: vat,
            month: month,
            year: year,
            stcode: stcode
        },
        success: function(result) {
            // console.log(result);
            // alert(result.total_1[0])

            $('#' + table + ' thead').append(
                '<tr bgcolor="#BEBEBE"><td align="center" height="35" width="100">รหัสพัสดุ</td><td align="center" width="60">' +
                result.data[0] + '</td><td align="center" width="60">' + result.data[1] +
                '</td><td align="center" width="60">' + result.data[2] +
                '</td><td align="center" width="60">' + result.data[3] +
                '</td><td align="center" width="60">' + result.data[4] +
                '</td><td align="center" width="60">' + result.data[5] +
                '</td><td align="center" width="60">' + result.data[6] +
                '</td><td align="center" width="60">' + result.data[7] +
                '</td><td align="center" width="60">' + result.data[8] +
                '</td><td align="center" width="60">' + result.data[9] +
                '</td><td align="center" width="60">' + result.data[10] + '</td></tr>'
            );

            var digi = 0;


            $('#' + table + ' tbody').append(
                '<tr><td align="center" height="30">รวมเงิน</td><td align="center" >' +
                formatMoney(result.total_1, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_2, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_3, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_4, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_5, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_6, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_7, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_8, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_9, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_10, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_11, digi) +
                '</td></tr>');


            var caption;
            if (vat == 'Y')
                caption = "กราฟยอดขายตามพัสดุ";
            else
                caption = "กราฟยอดขายตามพัสดุ";


            $('#chart-container').insertFusionCharts({
                type: "column3d",
                width: "900",
                height: "400",
                dataFormat: "json",
                dataSource: {
                    // Chart Configuration
                    "chart": {
                        "caption": caption,
                        "subCaption": "ปี " + (year + 543),
                        "xAxisName": "รหัสพัสดุ",
                        "yAxisName": "แกลลอน",
                        "theme": "fusion",
                    },
                    // Chart Data
                    "data": [{
                        "label": result.data[0],
                        "value": formatMoney(result.total_1, digi)
                    }, {
                        "label": result.data[1],
                        "value": formatMoney(result.total_2, digi)
                    }, {
                        "label": result.data[2],
                        "value": formatMoney(result.total_3, digi)
                    }, {
                        "label": result.data[3],
                        "value": formatMoney(result.total_4, digi)
                    }, {
                        "label": result.data[4],
                        "value": formatMoney(result.total_5, digi)
                    }, {
                        "label": result.data[5],
                        "value": formatMoney(result.total_6, digi)
                    }, {
                        "label": result.data[6],
                        "value": formatMoney(result.total_7, digi)
                    }, {
                        "label": result.data[7],
                        "value": formatMoney(result.total_8, digi)
                    }, {
                        "label": result.data[8],
                        "value": formatMoney(result.total_9, digi)
                    }, {
                        "label": result.data[9],
                        "value": formatMoney(result.total_10, digi)
                    }, {
                        "label": result.data[10],
                        "value": formatMoney(result.total_11, digi)
                    }]
                }
            });
            /// จบ 11 พัสดุ รายปี

            $('#table_one_product thead').append(
                '<tr bgcolor="#BEBEBE"><td align="center" height="35" width="100">Description</td><td align="center" width="60">Jan</td><td align="center" width="60">Feb</td><td align="center" width="60">Mar</td><td align="center" width="60">Apr</td><td align="center" width="60">May</td><td align="center" width="60">Jun</td><td align="center" width="60">Jul</td><td align="center" width="60">Aug</td><td align="center" width="60">Sep</td><td align="center" width="60">Oct</td><td align="center" width="60">Nov</td><td align="center" width="60">Dec</td></tr>'
            );


            $('#table_one_product tbody').append(
                '<tr><td align="center" height="30">รวมเงิน</td><td align="center" >' +
                formatMoney(result.total_Jan, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Feb, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Mar, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Apr, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_May, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Jun, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Jul, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Aug, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Sep, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Oct, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Nov, digi) +
                '</td><td align="center">' +
                formatMoney(result.total_Dec, digi) +
                '</td></tr>');

            $('#chart_container_code').insertFusionCharts({

                type: "column3d",
                width: "900",
                height: "400",
                dataFormat: "json",
                dataSource: {
                    // Chart Configuration
                    "chart": {
                        "caption": caption,
                        "subCaption": "ปี " + (year + 543),
                        "xAxisName": "เดือน",
                        "yAxisName": "แกลลอน",
                        "theme": "fusion",
                    },
                    // Chart Data
                    "data": [{
                        "label": "Jan",
                        "value": result.total_Jan[0]
                    }, {
                        "label": "Feb",
                        "value": result.total_Feb[0]
                    }, {
                        "label": "Mar",
                        "value": result.total_Mar[0]
                    }, {
                        "label": "Apr",
                        "value": result.total_Apr[0]
                    }, {
                        "label": "May",
                        "value": result.total_May[0]
                    }, {
                        "label": "Jun",
                        "value": result.total_Jun[0]
                    }, {
                        "label": "Jul",
                        "value": result.total_Jul[0]
                    }, {
                        "label": "Aug",
                        "value": result.total_Aug[0]
                    }, {
                        "label": "Sep",
                        "value": result.total_Sep[0]
                    }, {
                        "label": "Oct",
                        "value": result.total_Oct[0]
                    }, {
                        "label": "Nov",
                        "value": result.total_Nov[0]
                    }, {
                        "label": "Dec",
                        "value": result.total_Dec[0]
                    }]
                }
            });

        }
    });

}
</script>