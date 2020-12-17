<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",
        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_id tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .stcode[count] + '" onClick="onClick_tr(this.id);"><td>' + [
                        count+1] + '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');


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

    var d = new Date();
    var yearnow = d.getFullYear();

    CreateReport('table_sale', '', '1');

})

$("#select_stock").change(function() {
    CreateReport('table_sale', $("#select_stock").val(), $("#select_place").val());
});

$("#select_place").change(function() {
    CreateReport('table_sale', $("#select_stock").val(), $("#select_place").val());
});

function onClick_tr(id) {
    
    CreateReport('table_sale', id, $("#select_place").val());
    $("#select_stock").val(id);
}


function CreateReport(table, stock, place) {
    // $("#" + table + " thead tr").empty();
    $("#" + table + " tbody tr").empty();

    $.ajax({
        type: "POST",
        url: "ajax/create_table.php",
        data: {
            stock: stock,
            place: place
        },
        success: function(result) {
            // console.log(result);


            for (count = 0; count < result.socode.length; count++) {
            $('#' + table + ' tbody').append(
                '<tr><td style="text-align:center;">' + result.socode[count] +
                '</td><td>' + result.sodate[count] + '</td><td>' + result.stcode[count] + '</td><td>' + result
                .stname[count] + '</td><td>' + result.cusname[count] + '</td><td>' + result.amount[count] + '</td><td>' + result.unit[count] + '</td></tr>');
            }
        }

    });

}
</script>