<script type="text/javascript">
//STEP 2 - Chart Data
const chartData = [{
    label: "Venezuela",
    value: "290"
}, {
    label: "Saudi",
    value: "260"
}, {
    label: "Canada",
    value: "180"
}, {
    label: "Iran",
    value: "140"
}, {
    label: "Russia",
    value: "115"
}, {
    label: "UAE",
    value: "100"
}, {
    label: "US",
    value: "30"
}, {
    label: "China",
    value: "30"
}]
//STEP 3 - Chart Configurations
const chartConfigs = {
    type: "column2d",
    width: "700",
    height: "400",
    dataFormat: "json",
    dataSource: {
        // Chart Configuration
        "chart": {
            "caption": "Countries With Most Oil Reserves [2017-18]",
            "subCaption": "In MMbbl = One Million barrels",
            "xAxisName": "Country",
            "yAxisName": "Reserves (MMbbl)",
            "numberSuffix": "K",
            "theme": "fusion",
        },
        // Chart Data
        "data": chartData
    }
}


$(function() {

    var d = new Date();
    var yearnow = d.getFullYear();
    $("#chart-container").insertFusionCharts(chartConfigs);
    CreateReport('table_saleyear',yearnow,'Y');
})

    $("#select_year").change(function() {
            CreateReport('table_saleyear', $("#select_year").val() - 543, $("#vat").val());            
    });

    $("#vat").change(function() {
            CreateReport('table_saleyear', $("#select_year").val() - 543, $("#vat").val());            
    });


function CreateReport(table, year,vat) {
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
                    '<tr bgcolor="#BEBEBE"><td align="center" height="35" width="100">Description</td><td align="center" width="60"><a href="https://www.w3schools.com" target="_blank">Jan</a></td><td align="center" width="60">Feb</td><td align="center" width="60">Mar</td><td align="center" width="60">Apr</td><td align="center" width="60">May</td><td align="center" width="60">Jun</td><td align="center" width="60">Jul</td><td align="center" width="60">Aug</td><td align="center" width="60">Sep</td><td align="center" width="60">Oct</td><td align="center" width="60">Nov</td><td align="center" width="60">Dec</td></tr>'
                );
                $('#' + table + ' tbody').append(
                    '<tr><td align="center" height="30">มูลค่า</td><td align="right" >' +
                    formatMoney(result.total_Jan-(((result.total_Jan*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Feb-(((result.total_Feb*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Mar-(((result.total_Mar*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Apr-(((result.total_Apr*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_May-(((result.total_May*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jun-(((result.total_Jun*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jul-(((result.total_Jul*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Aug-(((result.total_Aug*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Sep-(((result.total_Sep*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Oct-(((result.total_Oct*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Nov-(((result.total_Nov*100)/107)*7/100), 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Dec-(((result.total_Dec*100)/107)*7/100), 0) +
                    
                    '</td></tr><tr><td align="center" height="30">ภาษี</td><td align="right" >' +
                    formatMoney(((result.total_Jan*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Feb*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Mar*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Apr*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_May*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Jun*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Jul*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Aug*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Sep*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Oct*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Nov*100)/107)*7/100, 0) +
                    '</td><td align="right">' +
                    formatMoney(((result.total_Dec*100)/107)*7/100, 0) +

                    '</td></tr><tr><td align="center" height="30">รวมเงิน</td><td align="right" >' +
                    formatMoney(result.total_Jan, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Feb, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Mar, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Apr, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_May, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jun, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Jul, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Aug, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Sep, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Oct, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Nov, 0) +
                    '</td><td align="right">' +
                    formatMoney(result.total_Dec, 0) +
                    '</td></tr>');

                var caption;
                    caption = "กราฟแสดงยอดขาย";

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
                            "xAxisName": "Month",
                            "yAxisName": "Baht",
                            "theme": "fusion",
                        },
                        // Chart Data
                        "data": [{
                            "label": "Jan",
                            "value": result.total_Jan
                        }, {
                            "label": "Feb",
                            "value": result.total_Feb
                        }, {
                            "label": "Mar",
                            "value": result.total_Mar
                        }, {
                            "label": "Apr",
                            "value": result.total_Apr
                        }, {
                            "label": "May",
                            "value": result.total_May
                        }, {
                            "label": "Jun",
                            "value": result.total_Jun
                        }, {
                            "label": "Jul",
                            "value": result.total_Jul
                        }, {
                            "label": "Aug",
                            "value": result.total_Aug
                        }, {
                            "label": "Sep",
                            "value": result.total_Sep
                        }, {
                            "label": "Oct",
                            "value": result.total_Oct
                        }, {
                            "label": "Nov",
                            "value": result.total_Nov
                        }, {
                            "label": "Dec",
                            "value": result.total_Dec
                        }]
                    }
                });
            }
        });

    }
</script>