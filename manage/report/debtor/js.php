<script type="text/javascript">
$(function() {

    $("#min").datepicker({
        format: 'yyyy-mm-dd'
    });
    $("#max").datepicker({
        format: 'yyyy-mm-dd'
    });
    // format: 'yyyy-mm-dd'

    CreateReport('table_debtor', '','','','','');



    $('#min, #max,#pay_status').change(function() {
        CreateReport('table_debtor', $('#min').val(),$('#max').val(),$('#pay_status').val(),$('#search_name').val(),$('#cuscode').val());
        // alert($('#cuscode').val());
    });


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
    $('#cuscode').val(id);
    CreateReport('table_debtor',$('#min').val(),$('#max').val(),$('#pay_status').val(),$('#search_name').val(), id);
}


function CreateReport(table,min,max,pay_status,search_name, cuscode) {

    $("#" + table + " tbody tr").empty();

    $.ajax({
        type: "POST",
        url: "ajax/create_table.php",
        data: {
            min: min,
            max: max,
            pay_status: pay_status,
            search_name: search_name,
            cuscode: cuscode
        },
        success: function(result) {
            // console.log(result.total);

            for (count = 0; count < result.socode.length; count++) {
                var invdate = result
                    .invdate[count].substring(8) + '-' + result
                    .invdate[count].substring(5, 7) + '-' + result
                    .invdate[count].substring(0, 4);

                if (result.paycondate[count] != '') {
                    paycondate = result
                        .paycondate[count].substring(8) + '-' + result
                        .paycondate[count].substring(5, 7) + '-' + result
                        .paycondate[count].substring(0, 4);
                } else
                paycondate = '';

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
                    paycondate +
                    '</td><td align="right">' +
                    result.delcode[count] +
                    '</td></tr>');

            }

        }
    });

}
</script>