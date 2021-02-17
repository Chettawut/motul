<script type="text/javascript">
$(function() {

    $.ajax({
        type: "POST",
        url: "ajax/get_customer.php",
        data: "&type=" + '<?php echo $_SESSION['type'];?>' +
            "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
        success: function(result) {
            var type;
            for (count = 0; count < result.cuscode.length; count++) {

                var status = '';
                if (result.status[count] == 'Y')
                    status = 'เปิดใช้งาน'
                else
                    status = 'ปิดใช้งาน'

                $('#tableCustomer').append(
                    '<tr data-toggle="modal" data-target="#modelCustomerEdit" id="' + result
                    .cuscode[
                        count] + '" data-whatever="' + result.code[
                        count] + '">.<td>' + result.cuscode[count] + '</td><td>' +
                    result.cusname[count] + '</td><td style="text-align:center">' +
                    result.province[count] + '</td><td style="text-align:left">' +
                    result.idno[count] + '</td><td  style="text-align:center">' + status +
                    '</td></tr>');
            }

            var table = $('#tableCustomer').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "pageLength": 12
            });

            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });


        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_province.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_id tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .shortname[
                        count] + '" onClick="onClick_tr(this.id,\'' + result.name[count] +
                    '\');"><td>' + result.code[count] + '</td><td>' +
                    result.name[count] + '</td><td>' +
                    result.shortname[count] + '</td></tr>');


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


function onClick_tr(id, name) {
    $('#cuscode2').val(id);
    $('#province').val(name);


}

function disabledSupSO() {
    $("input[type='text'], textarea").each(function(event) {
        $(this).prop('disabled', true);
    });
    $("input[type='date']").each(function(event) {
        $(this).prop('disabled', true);
    });
    $("select").each(function(event) {
        $(this).prop('disabled', true);
    });
    $("select option").each(function(event) {
        $(this).prop('disabled', true);
    });

    $("input:radio").each(function(event) {
        $(this).prop('disabled', true);
    });
    $("#btnEdit").hide();
}

$('#modelCustomerEdit').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');
    var modal = $(this);

    var type = $("#spantype").text().replace(/\s/g,'');
    if(type==='Sales')
      disabledSupSO();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_customer.php",
        data: "idcode=" + recipient,
        success: function(result) {
            modal.find('.modal-body #code').val(result.code);
            modal.find('.modal-body #editcuscode').val(result.cuscode);
            modal.find('.modal-body #editcusname').val(result.cusname);
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
            modal.find('.modal-body #editmap').val(result.map);
            modal.find('.modal-body #editstatus').val(result.status);


        }
    });
});

$("#btnRefresh").click(function() {
    window.location.reload();
});

//ส่งใบแจ้ง
$("#frmAddCustomer").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })

    $.ajax({
        type: "POST",
        url: "ajax/add_customer.php",
        data: $("#frmAddCustomer").serialize() +
            "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
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

$("#frmEditCustomer").submit(function(e) {
    e.preventDefault();
    $(':disabled').each(function(e) {
        $(this).removeAttr('disabled');
    })

    $.ajax({
        type: "POST",
        url: "ajax/edit_customer.php",
        data: $("#frmEditCustomer").serialize(),
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