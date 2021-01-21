<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_register.php",
        //    data: $("#frmMain").serialize(),
        success: function(result) {
            var type;
            for (count = 0; count < result.supcode.length; count++) {

                var status = '';
                if(result.status[count]=='Y')
                status = 'เปิดใช้งาน'
                else
                status = 'ปิดใช้งาน'

                $('#tableSupplier').append(
                    '<tr data-toggle="modal" data-target="#modelSupplierEdit" id="' + result
                    .supcode[
                        count] + '" data-whatever="' + result.code[
                        count] + '">.<td>' + result.supcode[count] + '</td><td>' +
                    result.supname[count] + '</td><td  style="text-align:center">' + status + '</td></tr>');
            }

            var table = $('#tableSupplier').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',"ordering": false
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });

            

        }
    });
   

})
$('#modelSupplierEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    $.ajax({
        type: "POST",
        url: "ajax/getsup_supplier.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #code').val(result.code);            
            modal.find('.modal-body #editsupcode').val(result.supcode);
            modal.find('.modal-body #editsupname').val(result.supname);
            modal.find('.modal-body #editidno').val(result.idno);
            modal.find('.modal-body #editroad').val(result.road);
            modal.find('.modal-body #editsubdistrict').val(result.subdistrict);
            modal.find('.modal-body #editdistrict').val(result.district);
            modal.find('.modal-body #editprovince').val(result.province);
            modal.find('.modal-body #editzipcode').val(result.zipcode);
            modal.find('.modal-body #edittel').val(result.tel);
            modal.find('.modal-body #editfax').val(result.fax);
            modal.find('.modal-body #edittaxnumber').val(result.taxnumber);
            modal.find('.modal-body #editemail').val(result.email);
            modal.find('.modal-body #editstatus').val(result.status);

           
        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//ส่งใบแจ้ง
$("#frmAddSupplier").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "ajax/add_supplier.php",
        data: $("#frmAddSupplier").serialize(),
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


$("#frmEditSupplier").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })
    $.ajax({
        type: "POST",
        url: "ajax/edit_supplier.php",
        data: $("#frmEditSupplier").serialize(),
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