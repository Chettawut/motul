<script type="text/javascript">
$(function() {

    CreateReport('table_debtor', '');

    $.ajax({
        type: "POST",
        url: "ajax/get_customer.php",
        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_id tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .cuscode[count] + '" onClick="onClick_tr(this.id);"><td>' + result.code[
                        count] + '</td><td>' +
                    result.cuscode[count] + '</td><td>' +
                    result.cusname[count] + '</td></tr>');


            }

            $('#table_id').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

})

function onClick_tr(id) {

    CreateReport('table_debtor', id);
}





function CreateReport(table, cuscode) {

    $("#" + table + " tbody tr").empty();

    $.ajax({
        type: "POST",
        url: "ajax/create_table.php",
        data: {
            cuscode: cuscode
        },
        success: function(result) {
            // console.log(result.total);

            for (count = 0; count < result.socode.length; count++) {
                var invdate = result
                    .invdate[count].substring(8) + '-' + result
                    .invdate[count].substring(5, 7) + '-' + result
                    .invdate[count].substring(0, 4);

                if (result.delcode[count] != '') {
                    recedate = result
                        .recedate[count].substring(8) + '-' + result
                        .recedate[count].substring(5, 7) + '-' + result
                        .recedate[count].substring(0, 4);
                } else
                    recedate = '';

                var paydate = result
                    .paydate[count].substring(8) + '-' + result
                    .paydate[count].substring(5, 7) + '-' + result
                    .paydate[count].substring(0, 4);



                $('#' + table + ' tbody').append(
                    '<tr><td align="left" >' +
                    invdate +
                    '</td><td align="center">' +
                    paydate +
                    '</td><td align="center">' +
                    result.invoice[count] +
                    '</td><td align="left">' +
                    result.cusname[count] +
                    '</td><td align="right">' +
                    formatMoney(result.total[count], 0) +
                    '</td><td align="center">' +
                    recedate +
                    '</td><td align="right">' +
                    result.delcode[count] +
                    '</td></tr>');

            }

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#min').datepicker("getDate");
                    var max = $('#max').datepicker("getDate");
                    var paystatus = $('#pay_status').val();
                    var startDate = new Date(data[0]);
                    var payDate = data[6];

                    if (paystatus == '') {
                        if (min == null && max == null) {
                            return true;
                        }
                        if (min == null && startDate <= max) {
                            return true;
                        }
                        if (max == null && startDate >= min) {
                            return true;
                        }
                        if (startDate <= max && startDate >= min) {
                            return true;
                        }
                        return false;
                    }
                    if (paystatus == 'Y') {
                        if (payDate != '') {
                            if (min == null && max == null) {
                                return true;
                            }
                            if (min == null && startDate <= max) {
                                return true;
                            }
                            if (max == null && startDate >= min) {
                                return true;
                            }
                            if (startDate <= max && startDate >= min) {
                                return true;
                            }
                            return false;
                        }

                    }
                    if (paystatus == 'N') {
                        if (payDate == '') {
                            if (min == null && max == null) {
                                return true;
                            }
                            if (min == null && startDate <= max) {
                                return true;
                            }
                            if (max == null && startDate >= min) {
                                return true;
                            }
                            if (startDate <= max && startDate >= min) {
                                return true;
                            }
                            return false;
                        }
                    }

                    return false;
                }
            );

            $("#min").datepicker({
                onSelect: function() {
                    table.draw();
                },
                changeMonth: true,
                changeYear: true,
                format: 'dd-mm-yyyy'
            });
            $("#max").datepicker({
                onSelect: function() {
                    table.draw();
                },
                changeMonth: true,
                changeYear: true,
                format: 'dd-mm-yyyy'
            });

            var table2 = $('#' + table).DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">'
            });
            $('#min, #max,#pay_status').change(function() {
                table2.draw();
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 80,
                maxlength: 80
            });



        }
    });

}
</script>