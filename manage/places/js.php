<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_places.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {
            var type;
            for (count = 0; count < result.places.length; count++) {

                var status = '';
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'

                $('#tablePlaces').append(
                    '<tr data-toggle="modal" data-target="#modelPlacesEdit" id="' + result
                    .places[
                        count] + '" data-whatever="' + result.placescode[
                        count] + '">.<td>' + result.places[count] + '</td><td>' +
                        status + '</td></tr>');
            }

            var table = $('#tablePlaces').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "ordering": false
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });



        }
    });


})
$('#modelPlacesEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_places.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #placescode').val(result.placescode);
            modal.find('.modal-body #editplaces').val(result.places);
            modal.find('.modal-body #status').val(result.status);

        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//ส่งใบแจ้ง
$("#frmAddPlaces").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_places.php",
        data: $("#frmAddPlaces").serialize(),
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

$("#btnEditPlaces").click(function() {

    $.ajax({
        type: "POST",
        url: "ajax/edit_places.php",
        data: $("#frmEditPlaces").serialize(),
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