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

    $.ajax({
        type: "POST",
        url: "ajax/create_table.php",
        data: {
            vat: vat,
            month: month,
            year: year
        },
        success: function(result) {
            // console.log(result);


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


            if ($("#vat").val() === 'Y') {
                $('#' + table + ' tbody').append(
                    '<tr><td align="center" height="30">มูลค่า</td><td align="center" >' +
                    formatMoney(result.total_1 - (((result.total_1 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_2 - (((result.total_2 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_3 - (((result.total_3 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_4 - (((result.total_4 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_5 - (((result.total_5 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_6 - (((result.total_6 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_7 - (((result.total_7 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_8 - (((result.total_8 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_9 - (((result.total_9 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_10 - (((result.total_10 * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_11 - (((result.total_11 * 100) / 107) * 7 / 100), 2) +
                    '</td></tr><tr><td align="center" height="30">ภาษี</td><td align="center" >' +
                    formatMoney(((result.total_1 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_2 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_3 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_4 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_5 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_6 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_7 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_8 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_9 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_10 * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="center">' +
                    formatMoney(((result.total_11 * 100) / 107) * 7 / 100, 2) +
                    '</td></tr><tr><td align="center" height="30">รวมเงิน</td><td align="center" >' +
                    formatMoney(result.total_1, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_2, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_3, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_4, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_5, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_6, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_7, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_8, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_9, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_10, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_11, 2) +
                    '</td></tr>');
            } else {
                $('#' + table + ' tbody').append(
                    '<tr><td align="center" height="30">รวมเงิน</td><td align="right" >' +
                    formatMoney(result.total_1, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_2, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_3, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_4, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_5, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_6, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_7, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_8, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_9, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_10, 2) +
                    '</td><td align="center">' +
                    formatMoney(result.total_11, 2) +
                    '</td></tr>');
            }

            var caption;
            if (vat == 'Y')
                caption = "กราฟยอดขายตามพัสดุ";
            else
                caption = "กราฟยอดขายตามพัสดุ";

            if ($("#vat").val() === 'Y') {
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
                            "yAxisName": "บาท",
                            "theme": "fusion",
                        },
                        // Chart Data
                        "data": [{
                            "label": result.data[0],
                            "value": result.total_1
                        }, {
                            "label": result.data[1],
                            "value": result.total_2
                        }, {
                            "label": result.data[2],
                            "value": result.total_3
                        }, {
                            "label": result.data[3],
                            "value": result.total_4
                        }, {
                            "label": result.data[4],
                            "value": result.total_5
                        }, {
                            "label": result.data[5],
                            "value": result.total_6
                        }, {
                            "label": result.data[6],
                            "value": result.total_7
                        }, {
                            "label": result.data[7],
                            "value": result.total_8
                        }, {
                            "label": result.data[8],
                            "value": result.total_9
                        }, {
                            "label": result.data[9],
                            "value": result.total_10
                        }, {
                            "label": result.data[10],
                            "value": result.total_11
                        }]
                    }
                });
            } else {
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
                            "yAxisName": "บาท",
                            "theme": "fusion",
                        },
                        // Chart Data
                        "data": [{
                            "label": result.data[0],
                            "value": result.total_1 - (((result.total_1 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[1],
                            "value": result.total_2 - (((result.total_2 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[2],
                            "value": result.total_3 - (((result.total_3 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[3],
                            "value": result.total_4 - (((result.total_4 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[4],
                            "value": result.total_5 - (((result.total_5 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[5],
                            "value": result.total_6 - (((result.total_6 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[6],
                            "value": result.total_7 - (((result.total_7 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[7],
                            "value": result.total_8 - (((result.total_8 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[8],
                            "value": result.total_9 - (((result.total_9 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[9],
                            "value": result.total_10 - (((result.total_10 * 100) / 107) *
                                7 / 100)
                        }, {
                            "label": result.data[10],
                            "value": result.total_11 - (((result.total_11 * 100) / 107) *
                                7 / 100)
                        }]
                    }
                });
            }
            /// จบ 11 พัสดุ รายปี

            $('#table_one_product thead').append(
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


            $('#table_one_product tbody').append(
                '<tr><td align="center" height="30">รวมเงิน</td><td align="right" >' +
                formatMoney(result.total_1, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_2, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_3, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_4, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_5, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_6, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_7, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_8, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_9, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_10, 2) +
                '</td><td align="center">' +
                formatMoney(result.total_11, 2) +
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
                        "xAxisName": "รหัสพัสดุ",
                        "yAxisName": "บาท",
                        "theme": "fusion",
                    },
                    // Chart Data
                    "data": [{
                        "label": result.data[0],
                        "value": result.total_1 - (((result.total_1 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[1],
                        "value": result.total_2 - (((result.total_2 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[2],
                        "value": result.total_3 - (((result.total_3 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[3],
                        "value": result.total_4 - (((result.total_4 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[4],
                        "value": result.total_5 - (((result.total_5 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[5],
                        "value": result.total_6 - (((result.total_6 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[6],
                        "value": result.total_7 - (((result.total_7 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[7],
                        "value": result.total_8 - (((result.total_8 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[8],
                        "value": result.total_9 - (((result.total_9 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[9],
                        "value": result.total_10 - (((result.total_10 * 100) / 107) *
                            7 / 100)
                    }, {
                        "label": result.data[10],
                        "value": result.total_11 - (((result.total_11 * 100) / 107) *
                            7 / 100)
                    }]
                }
            });

        }
    });

}
</script>