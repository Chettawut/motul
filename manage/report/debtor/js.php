<script type="text/javascript">
$(function() {

    CreateReport('table_debtor', '');

    $.ajax({
        type: "POST",
        url: "ajax/get_customer.php",
        data: "&type=" + '<?php echo $_SESSION['type'];?>' +
            "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
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
            console.log(result.total);

            for (count = 0; count < result.socode.length; count++) {
                invdate = result
                    .invdate[count].substring(8) + '-' + result
                    .invdate[count].substring(5, 7) + '-' + result
                    .invdate[count].substring(0, 4);

                    recelog = result
                    .recelog[count].substring(8) + '-' + result
                    .recelog[count].substring(5, 7) + '-' + result
                    .recelog[count].substring(0, 4);

                $('#' + table + ' tbody').append(
                    '<tr><td align="left" >' +
                    invdate +
                    '</td><td align="center">' +
                    result.invoice[count] +
                    '</td><td align="left">' +
                    result.cusname[count] +
                    '</td><td align="right">' +
                    result.total[count] +
                    '</td><td align="center">' +
                    recelog +
                    '</td><td align="right">' +
                    result.delcode[count] +
                    '</td></tr>');
            
            }

          

        }
    });

}
</script>