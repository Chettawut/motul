<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_storage.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {

            for (count = 0; count < result.storage_name.length; count++) {


                $('#tableStock').append(
                    '<tr data-toggle="modal" data-target="#modelStockEdit" id="' + result
                    .storage_id[
                        count] + '" data-whatever="' + result.storage_id[
                        count] + '"><td style="text-align:center">'+(count+1)+'</td><td style="text-align:center">' + result.storage_name[count] + '</td><td style="text-align:center">' +
                    result.ratio[count] + '</td></tr>');
            }

            var table = $('#tableStock').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',"ordering": false
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });

            

        }
    });


})


$('#modelStockEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_storage.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #editstorage_name').val(result.storage_name);            
            modal.find('.modal-body #editratio').val(result.ratio);
            modal.find('.modal-body #code').val(result.storage_id);

           
        }
    });
});

$('#modelEdit').on('hidden.bs.modal', function() {
    $("#frmEditInventory *").prop('disabled', true);
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//ส่งใบแจ้ง
$("#frmAddStock").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_storage.php",
        data: $("#frmAddStock").serialize(),
        success: function(result) {
            if (result.status == 1) // Success
            {
                alert(result.message);
                window.location.reload();
                // console.log(result.message);
            }
            else
            {
                alert('รหัสซ้ำ');
            }
        }
    });


});

$("#frmEditStock").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_storage.php",
        data: $("#frmEditStock").serialize(),
        success: function(result) {
            
            if (result.status == 1) // Success
            {
                alert(result.message);
                window.location.reload();
                // console.log(result.message);
            }
        }
    });

});

</script>