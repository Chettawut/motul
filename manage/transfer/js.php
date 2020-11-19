<script type="text/javascript">
function onClick_tr(id, supname, address, tel) {
    $('#cuscode').val(id);
    $('#tdname').val(supname);
    $('#address').val(address);
    $('#tel').val(tel.substring(0, 3) + '-' + tel.substring(3));
}

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    var stcode = target.split(',')[2];
    // alert(target + ' ' + stcode);
    // console.log($('#amount1' + row).val() + ' ' + stcode);


    $.ajax({
        type: "POST",
        url: "ajax/cal_stock.php",
        data: "idcode=" + stcode,
        success: function(result) {

            $('#unit1' + row).val(unit);
            if (unit == 'ลัง')
                $('#price1' + row).val(result.ratio * result.sellprice);
            else
                $('#price1' + row).val(result.sellprice);

        }
    });

}

function onClick_unit2(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    // alert(row + ' ' + (target));

    $('#unit2' + row).val(unit);

    // $.ajax({
    //     type: "POST",
    //     url: "ajax/cal_stock.php",
    //     data: "idcode=" + stcode,
    //     success: function(result) {

    //         $('#unit1' + row).val(unit);
    //         if(unit=='ลัง')
    //         $('#price1' + row).val(result.ratio*result.sellprice);
    //         else
    //         $('#price1' + row).val(result.sellprice);

    //     }
    // });

}

function previewTFcode() {
    $.ajax({
        type: "POST",
        url: "ajax/get_tfcode.php",
        success: function(result) {

            $("#tfcode").val(result.tfcode);

        }
    });

}

function onDeleteDetail(table, id) {
    $("#" + table + " tbody").empty();
    $("#" + id).hide();

    if (table == "tableTFGiveaway")
        $('#tableTFGiveaway').hide();
}

function getTotal(row) {
    $('#total1' + row).html(formatMoney(($('#amount1' + row).val() *
        $('#price1' +
            row).val()) - ((($('#amount1' + row).val() *
        $(
            '#price1' + row).val()) * $(
        '#discount1' +
        row).val()) / 100), 2));

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
}

function enabledSupSO() {
    $("input[type='text'], textarea").each(function(event) {
        $(this).prop('disabled', false);
    });
    $("input[type='date']").each(function(event) {
        $(this).prop('disabled', false);
    });
    $("select").each(function(event) {
        $(this).prop('disabled', false);
    });
    $("select option").each(function(event) {
        $(this).prop('disabled', false);
    });

    $("input:radio").each(function(event) {
        $(this).prop('disabled', false);
    });
}

function onSelectTF(tfcode) {

    $("#edittfcode").val(tfcode);
    $("#tableTFDetail tbody").empty();
    $("#tableEditTFDetail").show();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_tf.php",
        data: "idcode=" + tfcode,
        success: function(result) {
            $("#edittfcode").val(result.tfcode);
            $("#edittfdate").val(result.tfdate);
            $("#edittrandate").val(result.trandate);
            $("#editremark").val(result.remark);

        }
    });

    $("#divfrmEditTF").show();
    $('#divtableTF').hide();
    $("#btnBack").show();
    $('#btnAddTF').hide();
    $("#btnRefresh").hide();
    $("#tableEditTFDetail tbody").empty();

    var option = '';
    $.ajax({
        type: "POST",
        url: "ajax/get_places.php",

        success: function(result) {

            for (count = 0; count < result.places.length; count++) {

                option += '<option value="' + result.placescode[count] + '">' + result
                    .places[count] + '</option>';


            }
            $.ajax({
                type: "POST",
                url: "ajax/getsup_tfdetail.php",
                data: "idcode=" + tfcode,
                success: function(result) {
                        
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditTFDetail').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="tfno" id="tfno" ><p class="form-control-static" style="text-align:center">' +
                            result.tfno[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" name="amount1"  id="amount1' +
                            result.tfno[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            result.tfno[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.tfno[count] +
                            ',tableEditTFDetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><select class="form-control" style="text-align:left" name="places1" id="places1' +
                            $('#tableEditTFDetail tr').length + '" disabled>' +
                            option +
                            '</select></td><td><select class="form-control" style="text-align:left" name="places2" id="places2' +
                            $('#tableEditTFDetail tr').length + '" disabled>' +
                            option +
                            '</select></td></tr>'
                        );
                        $('#places1' + $('#tableEditTFDetail tbody tr').length).val(result
                            .places1[count]);
                        $('#places2' + $('#tableEditTFDetail tbody tr').length).val(result
                            .places2[count]);

                    }

                }
            });

        }
    });


    // $("#tableEditPoDetail").show();

}

function getTF() {
    $.ajax({
        type: "POST",
        url: "ajax/get_tf.php",
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.tfcode.length; count++) {

                tfdate = result
                    .tfdate[count].substring(8) + '-' + result
                    .tfdate[count].substring(5, 7) + '-' + result
                    .tfdate[count].substring(0, 4);

                $('#tableTF').append(
                    '<tr id="' + result.tfcode[
                        count] + '" onClick="onSelectTF(this.id);" ><td>' + result.tfcode[count] +
                    '</td><td>' + tfdate + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td></tr>');
            }

            var table = $('#tableTF').DataTable({
                "dom": '<"pull-right"f>rt<"bottom"p><"clear">',
                "order": [],
                "pageLength": 20
            })


            $(".dataTables_filter input[type='search']").attr({
                size: 60,
                maxlength: 60
            });

        }
    });
}

$(function() {


    getTF();

    $.ajax({
        type: "POST",
        url: "ajax/get_customer.php",
        data: "&type=" + '<?php echo $_SESSION['type'];?>' +
            "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_id tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .cuscode[count] + '" onClick="onClick_tr(this.id,\'' + result.cusname[
                        count] + '\',\'' + result.address[count] + '\',\'' + result.tel[count] +
                    '\');"><td>' + result.code[
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

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_stock tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .stcode[count] + '" );"><td>' + result.code[count] + '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');


            }

            $('#table_stock').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_unit.php",

        success: function(result) {

            for (count = 0; count < result.unitcode.length; count++) {

                $('#table_unit tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                    result.unit[count] + '\');"  id="' +
                    result
                    .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                    '</td><td>' +
                    result.unit[count] + '</td></tr>');


            }

            $('#table_unit').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_giveaway tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' +
                    result
                    .stcode[count] + '" );"><td>' + result.code[count] +
                    '</td><td>' +
                    result.stcode[count] + '</td><td>' +
                    result.stname1[count] + '</td></tr>');


            }

            $('#table_giveaway').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

    $('#modal_unit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);

        $.ajax({
            type: "POST",
            url: "ajax/get_unit.php",

            success: function(result) {
                $('#table_unit tbody').empty();
                for (count = 0; count < result.unitcode.length; count++) {

                    $('#table_unit tbody').append(
                        '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit(\'' +
                        result.unit[count] + '\',\'' + recipient + '\');"  id="' +
                        result
                        .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                        '</td><td>' +
                        result.unit[count] + '</td></tr>');


                }


            }
        });
    })




    // กดยืนยันเพิ่ม TF
    $("#frmTF").submit(function(event) {
        event.preventDefault();

        var stcode = [];
        var amount = [];
        var unit = [];
        var places1 = [];
        var places2 = [];



        $('#tableTFDetail tbody tr').each(function() {
            stcode.push($(this).attr("id"));
        });
        $('#tableTFDetail tbody tr').each(function(key) {
            amount.push($(this).find("td #amount1" + (++key)).val());
        });
        $('#tableTFDetail tbody tr').each(function(key) {
            unit.push($(this).find("td #unit1" + (++key)).val());
        });
        $('#tableTFDetail tbody tr').each(function(key) {
            places1.push($(this).find("td #places1" + (++key)).val());
        });
        $('#tableTFDetail tbody tr').each(function(key) {
            places2.push($(this).find("td #places2" + (++key)).val());
        });


        if (stcode != 0) {
            $(':disabled').each(function(event) {
                $(this).removeAttr('disabled');
            });

            $.ajax({
                type: "POST",
                url: "ajax/add_tf.php",
                data: $("#frmTF").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                    "&unit=" + unit +
                    "&places1=" + places1 +
                    "&places2=" + places2 +
                    "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
                success: function(result) {
                    if (result.status == 1) {
                        alert(result.message);
                        window.location.reload();
                        // console.log(result.sql);
                    } else {
                        alert(result.message);

                        $("#tfcode").prop("disabled", true);
                        $("#tfdate").prop("disabled", true);

                        // console.log(result.message);
                    }
                }
            });
        } else {
            alert('กรุณาเพิ่มรายการ');
        }
    });

    // กดยืนยันแก้ไข SO
    $("#frmEditTF").submit(function(event) {
        event.preventDefault();



        var amount = [];
        var stcode = [];
        var unit = [];
        var price = [];
        var discount = [];
        var places = [];

        var stcode2 = [];
        var amount2 = [];
        var unit2 = [];
        var places2 = [];

        $(':disabled').each(function(event) {
            $(this).removeAttr('disabled');
        });


        $('#tableEditTFDetail tbody tr').each(function() {
            stcode.push($(this).attr("id"));
        });
        $('#tableEditTFDetail tbody tr').each(function(key) {
            amount.push($(this).find("td #amount1" + (++key)).val());
        });
        $('#tableEditTFDetail tbody tr').each(function(key) {
            unit.push($(this).find("td #unit1" + (++key)).val());
        });
        $('#tableEditTFDetail tbody tr').each(function(key) {
            price.push($(this).find("td #price1" + (++key)).val());
        });
        $('#tableEditTFDetail tbody tr').each(function(key) {
            discount.push($(this).find("td #discount1" + (++key)).val());
        });


        $.ajax({
            type: "POST",
            url: "ajax/edit_so.php",
            data: $("#frmEditSO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                "&unit=" + unit +
                "&price=" + price +
                "&places=" + places +
                "&discount=" + discount + "&stcode2=" + stcode2 + "&amount2=" + amount2 +
                "&unit2=" + unit2 +
                "&places2=" + places2,
            success: function(result) {
                if (result.status == 1) {
                    alert(result.message);
                    window.location.reload();
                    // console.log(result.sql);
                } else {
                    alert('err');
                    console.log(result.message);
                }
            }
        });

    });

    // เพิ่ม po detail เมื่อเลือกสต๊อก
    $("#table_stock").delegate('tr', 'click', function() {
        var id = $(this).attr("id");
        $('#btnClearTFdetail').show();

        var option = '';
        $.ajax({
            type: "POST",
            url: "ajax/get_places.php",

            success: function(result) {

                for (count = 0; count < result.places.length; count++) {

                    option += '<option value="' + result.placescode[count] + '">' + result
                        .places[count] + '</option>';


                }
                $.ajax({
                    type: "POST",
                    url: "ajax/getsup_stock.php",
                    data: "idcode=" + id,
                    success: function(result) {

                        var today = new Date();
                        var dd = today.getDate() + 7;

                        var mm = today.getMonth() + 1;
                        var yyyy = today.getFullYear();
                        if (dd < 10) {
                            dd = '0' + dd;
                        }

                        if (mm < 10) {
                            mm = '0' + mm;
                        }
                        today = yyyy + '-' + mm + '-' + dd;
                        // console.log(today);

                        $('#tableTFDetail').append(
                            '<tr id="' + result.stcode +
                            '" ><td name="sono" id="sono" ><p class="form-control-static" style="text-align:center">' +
                            $('#tableTFDetail tr').length +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1 +
                            '</p></td><td><input type="text" class="form-control" name="amount1"  id="amount1' +
                            $('#tableTFDetail tr').length +
                            '"  value="0"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            $('#tableTFDetail tr').length + '" value="' +
                            result.unit +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            $('#tableTFDetail tr').length +
                            ',tableTFDetail,' +
                            result
                            .stcode +
                            '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><select class="form-control" style="text-align:left" name="places1" id="places1' +
                            $('#tableTFDetail tr').length + '" >' +
                            option +
                            '</select></td><td><select class="form-control" style="text-align:left" name="places2" id="places2' +
                            $('#tableTFDetail tr').length + '" >' +
                            option +
                            '</select></td></tr>'
                        );


                        var row = $('#tableTFDetail tbody tr').length;

                        $('#amount1' + row).change(function() {
                            $('#total1' + row).html(formatMoney(($(
                                    '#amount1' + row)
                                .val() *
                                $('#price1' +
                                    row).val()) - ((($(
                                    '#amount1' + row
                                )
                                .val() *
                                $(
                                    '#price1' + row)
                                .val()) * $(
                                '#discount1' +
                                row).val()) / 100), 2));
                        });

                        $('#price1' + row).change(function() {
                            $('#total1' + row).html(formatMoney(($(
                                    '#amount1' + row)
                                .val() *
                                $('#price1' +
                                    row).val()) - ((($(
                                    '#amount1' + row
                                )
                                .val() *
                                $(
                                    '#price1' + row)
                                .val()) * $(
                                '#discount1' +
                                row).val()) / 100), 2));
                        });

                        $('#discount1' + row).change(function() {
                            $('#total1' + row).html(formatMoney(($(
                                    '#amount1' + row)
                                .val() *
                                $('#price1' +
                                    row).val()) - ((($(
                                    '#amount1' + row
                                )
                                .val() *
                                $(
                                    '#price1' + row)
                                .val()) * $(
                                '#discount1' +
                                row).val()) / 100), 2));
                        });

                        $('input[type=text]').on('keydown', function(e) {
                            $('#total1' + row).html(formatMoney(($(
                                    '#amount1' + row)
                                .val() *
                                $('#price1' +
                                    row).val()) - ((($(
                                    '#amount1' + row
                                )
                                .val() *
                                $(
                                    '#price1' + row)
                                .val()) * $(
                                '#discount1' +
                                row).val()) / 100), 2));
                        });


                    }
                });
            }
        });


    });


    //Refresh
    $("#btnRefresh").click(function() {
        RefreshPage();
    });


    // ย้ายไปหน้า เพิ่ม TF
    $("#btnAddTF").click(function() {

        $("#socode").val('');
        $("#supcode").val('');
        $("#tdname").val('');
        $("#address").val('');
        $("#tfdate").val(formatDate(new Date()));
        $("#trandate").val(formatDate(new Date()));
        $("#tableTFDetail tbody").empty();
        previewTFcode();

        $("#tableEditTFDetail").hide();
        $("#tableTFDetail").show();

        $("#txtHead").text('เพิ่มใบย้ายสินค้า (Add Transfer Inventory)');
        $("#frmTF").show();
        $("#divfrmTF").show();
        $("#divfrmEditTF").hide();
        $('#divtableTF').hide();
        $(this).hide();
        $("#btnAddSubmit").show();
        $("#btnBack").show();
        $("#btnRefresh").hide();
        $("#btnPrint").hide();

    });

    // ย้อนกลับไปหน้าหลัก
    $("#btnBack").click(function() {
        window.location.reload();
    });


});
</script>