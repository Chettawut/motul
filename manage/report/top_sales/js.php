<script type="text/javascript">
$(function() {

    var d = new Date();
    var yearnow = d.getFullYear();

    CreateReport('table_saleyear', yearnow, 'Y');
})

$("#select_year").change(function() {
    CreateReport('table_saleyear', $("#select_year").val() - 543, $("#vat").val());
});

$("#vat").change(function() {
    CreateReport('table_saleyear', $("#select_year").val() - 543, $("#vat").val());
});


function CreateReport(table, year, vat) {
    $("#" + table + " thead tr").empty();
    $("#" + table + " tbody tr").empty();

    $.ajax({
        type: "POST",
        url: "ajax/create_table.php",
        data: {
            vat: vat,
            year: year
        },
        success: function(result) {
            // console.log(result);


            $('#' + table + ' thead').append(
                '<tr bgcolor="#BEBEBE"><td align="center" height="35" width="100">Description</td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=01&vat=' + $("#vat").val() +
                '" target="_blank">Jan</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=02&vat=' + $("#vat").val() +
                '" target="_blank">Feb</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=03&vat=' + $("#vat").val() +
                '" target="_blank">Mar</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=04&vat=' + $("#vat").val() +
                '" target="_blank">Apr</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=05&vat=' + $("#vat").val() +
                '" target="_blank">May</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=06&vat=' + $("#vat").val() +
                '" target="_blank">Jun</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=07&vat=' + $("#vat").val() +
                '" target="_blank">Jul</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=08&vat=' + $("#vat").val() +
                '" target="_blank">Aug</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=09&vat=' + $("#vat").val() +
                '" target="_blank">Sep</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=10&vat=' + $("#vat").val() +
                '" target="_blank">Oct</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=11&vat=' + $("#vat").val() +
                '" target="_blank">Nov</a></td><td align="center" width="60"><a href="month?year=' +
                ($("#select_year").val() - 543) + '&month=12&vat=' + $("#vat").val() +
                '" target="_blank">Dec</a></td></tr>'
            );


            if ($("#vat").val() === 'Y') {
                $('#' + table + ' tbody').append(
                    '<tr><td align="center" height="30">มูลค่า</td><td align="right" >' +
                    formatMoney(result.total_Jan - (((result.total_Jan * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Feb - (((result.total_Feb * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Mar - (((result.total_Mar * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Apr - (((result.total_Apr * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_May - (((result.total_May * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jun - (((result.total_Jun * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jul - (((result.total_Jul * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Aug - (((result.total_Aug * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Sep - (((result.total_Sep * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Oct - (((result.total_Oct * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Nov - (((result.total_Nov * 100) / 107) * 7 / 100), 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Dec - (((result.total_Dec * 100) / 107) * 7 / 100), 2) +
                    '</td></tr><tr><td align="center" height="30">ภาษี</td><td align="right" >' +
                    formatMoney(((result.total_Jan * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Feb * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Mar * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Apr * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_May * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Jun * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Jul * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Aug * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Sep * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Oct * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Nov * 100) / 107) * 7 / 100, 2) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Dec * 100) / 107) * 7 / 100, 2) +

                    '</td></tr><tr><td align="center" height="30">รวมเงิน</td><td align="right" >' +
                    formatMoney(result.total_Jan, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Feb, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Mar, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Apr, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_May, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jun, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jul, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Aug, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Sep, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Oct, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Nov, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Dec, 2) +
                    '</td></tr>');
            } else {
                $('#' + table + ' tbody').append(
                    '<tr><td align="center" height="30">รวมเงิน</td><td align="right" >' +
                    formatMoney(result.total_Jan, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Feb, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Mar, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Apr, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_May, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jun, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jul, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Aug, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Sep, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Oct, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Nov, 2) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Dec, 2) +
                    '</td></tr>');
            }

            var caption;
            if (vat == 'Y')
                caption = "กราฟแสดงใบกำกับภาษีขาย";
            else
                caption = "กราฟแสดงใบขายสินค้า";

            // if ($("#vat").val() === 'Y') {
            //     $('#chart-container').insertFusionCharts({
            //         type: "column3d",
            //         width: "900",
            //         height: "400",
            //         dataFormat: "json",
            //         dataSource: {
            //             // Chart Configuration
            //             "chart": {
            //                 "caption": caption,
            //                 "subCaption": "ปี " + (year + 543),
            //                 "xAxisName": "Month",
            //                 "yAxisName": "Baht",
            //                 "theme": "fusion",
            //             },
            //             // Chart Data
            //             "data": [{
            //                 "label": "Jan",
            //                 "value": result.total_Jan
            //             }, {
            //                 "label": "Feb",
            //                 "value": result.total_Feb
            //             }, {
            //                 "label": "Mar",
            //                 "value": result.total_Mar
            //             }, {
            //                 "label": "Apr",
            //                 "value": result.total_Apr
            //             }, {
            //                 "label": "May",
            //                 "value": result.total_May
            //             }, {
            //                 "label": "Jun",
            //                 "value": result.total_Jun
            //             }, {
            //                 "label": "Jul",
            //                 "value": result.total_Jul
            //             }, {
            //                 "label": "Aug",
            //                 "value": result.total_Aug
            //             }, {
            //                 "label": "Sep",
            //                 "value": result.total_Sep
            //             }, {
            //                 "label": "Oct",
            //                 "value": result.total_Oct
            //             }, {
            //                 "label": "Nov",
            //                 "value": result.total_Nov
            //             }, {
            //                 "label": "Dec",
            //                 "value": result.total_Dec
            //             }]
            //         }
            //     });
            // }
            // else
            // {
            //     $('#chart-container').insertFusionCharts({
            //         type: "column3d",
            //         width: "900",
            //         height: "400",
            //         dataFormat: "json",
            //         dataSource: {
            //             // Chart Configuration
            //             "chart": {
            //                 "caption": caption,
            //                 "subCaption": "ปี " + (year + 543),
            //                 "xAxisName": "Month",
            //                 "yAxisName": "Baht",
            //                 "theme": "fusion",
            //             },
            //             // Chart Data
            //             "data": [{
            //                 "label": "Jan",
            //                 "value": result.total_Jan - (((result.total_Jan * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Feb",
            //                 "value": result.total_Feb - (((result.total_Feb * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Mar",
            //                 "value": result.total_Mar - (((result.total_Mar * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Apr",
            //                 "value": result.total_Apr - (((result.total_Apr * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "May",
            //                 "value": result.total_May - (((result.total_May * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Jun",
            //                 "value": result.total_Jun - (((result.total_Jun * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Jul",
            //                 "value": result.total_Jul - (((result.total_Jul * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Aug",
            //                 "value": result.total_Aug - (((result.total_Aug * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Sep",
            //                 "value": result.total_Sep - (((result.total_Sep * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Oct",
            //                 "value": result.total_Oct - (((result.total_Oct * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Nov",
            //                 "value": result.total_Nov - (((result.total_Nov * 100) / 107) * 7 / 100)
            //             }, {
            //                 "label": "Dec",
            //                 "value": result.total_Dec - (((result.total_Dec * 100) / 107) * 7 / 100)
            //             }]
            //         }
            //     });
            // }

        }
    });

}
</script>