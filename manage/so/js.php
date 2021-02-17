<script type="text/javascript">
function onClick_tr(id, supname, address, tel) {
    $('#cuscode').val(id);
    $('#tdname').val(supname);
    $('#address').val(address);
    $('#tel').val(tel.substring(0, 3) + '-' + tel.substring(3));
}

function onDelete_MainTable(row) {
    var tmpstcode = [];
    var tmpstname1 = [];
    var tmpunit = [];
    var tmpsellprice = [];
    var all_row = $('#tableSODetail tbody tr').length;

    for (var i = row + 1; i <= all_row; i++) {
        tmpstcode.push($('#stcode1' + i).text());
        tmpstname1.push($('#stname1' + i).text());
        tmpunit.push($('#unit1' + i).val());
        tmpsellprice.push($('#price1' + i).val());
    }

    for (var d = row; d <= all_row; d++)
        $("#detail" + d).remove();

    for (var j = 0; j < tmpstcode.length; j++)
        onCreate_detail(tmpstcode[j], tmpstname1[j], tmpunit[j], tmpsellprice[j]);

}

function onCreate_detail(stcode, stname1, unit, sellprice) {

    var all_row = $('#tableSODetail tr').length;

    $('#tableSODetail').append(
        '<tr id="detail' + all_row +
        '" ><td><p class="form-control-static" style="text-align:center">' +
        all_row +
        '</p></td><td><p class="form-control-static" name="stcode1"  id="stcode1' +
        all_row +
        '" style="text-align:center">' +
        stcode +
        '</p></td><td><p class="form-control-static" name="stname1"  id="stname1' +
        all_row +
        '" style="text-align:left" >' +
        stname1 +
        '</p></td><td><input type="number" class="form-control" name="amount1"  id="amount1' +
        all_row +
        '" min="1" value="1"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
        all_row + '" value="' +
        unit +
        '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
        all_row +
        ',tableSODetail,' +
        stcode +
        '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" name="price1" id="price1' +
        all_row + '" value="' +
        sellprice +
        '"></td><td><div class="input-group"><input type="text" class="form-control" name="discount1" id="discount1' +
        all_row +
        '" value="0"><div class="input-group-addon">%</div></div></td><td ><p name="total1" id="total1' +
        all_row +
        '" class="form-control-static" style="text-align:right">0</p></td><td><button type="button" onClick="onDelete_MainTable(' +
        all_row +
        ')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> ลบ</button></td></tr>'
    );

    onCal_detail(all_row);


}

function onDelete_GiveawayTable(row) {
    var tmpstcode = [];
    var tmpstname1 = [];
    var tmpunit = [];
    var tmpsellprice = [];
    var all_row = $('#tableSOGiveaway tbody tr').length;

    for (var i = row + 1; i <= all_row; i++) {
        tmpstcode.push($('#stcode2' + i).text());
        tmpstname1.push($('#stname2' + i).text());
        tmpunit.push($('#unit2' + i).val());
    }

    for (var d = row; d <= all_row; d++)
        $("#giveaway" + d).remove();

    for (var j = 0; j < tmpstcode.length; j++)
        onCreate_giveaway(tmpstcode[j], tmpstname1[j], tmpunit[j]);

    if ($('#tableSOGiveaway tbody tr').length == 0)
        $('#tableSOGiveaway').hide();
}

function onCreate_giveaway(stcode, stname1, unit) {

    var all_row = $('#tableSOGiveaway tr').length;

    $('#tableSOGiveaway').append(
        '<tr id="giveaway' + all_row +
        '" ><td ><p class="form-control-static" style="text-align:center">' +
        all_row +
        '</p></td><td><p class="form-control-static" name="stcode2" id="stcode2' +
        all_row +
        '" style="text-align:center">' +
        stcode +
        '</p></td><td><p class="form-control-static" name="stname2" id="stname2' +
        all_row +
        '" style="text-align:left">' +
        stname1 +
        '</p></td><td><input type="number" style="text-align:right" class="form-control" name="amount2"  id="amount2' +
        all_row +
        '" min="1" value="1"></td><td><div class="input-group"><input type="text" class="form-control" style="text-align:center" name="unit2" id="unit2' +
        all_row + '" value="' +
        unit +
        '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit2" data-whatever="' +
        all_row +
        ',tableSOGiveaway" type="button"><span class="fa fa-search"></span></button></span></div></td><td><button type="button" onClick="onDelete_GiveawayTable(' +
        all_row +
        ')"; class="btn btn-danger form-control" ><i class="fa fa fa-times" aria-hidden="true"></i class=> ลบ</button></td></tr>'
    );



}

function onCal_detail(row) {
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

function previewSOcode() {
    $.ajax({
        type: "POST",
        url: "ajax/get_socode.php",
        success: function(result) {

            $("#socode").val(result.socode);

        }
    });

}

function onDeleteDetail(table, id) {
    $("#" + table + " tbody").empty();
    $("#" + id).hide();

    if (table == "tableSOGiveaway")
        $('#tableSOGiveaway').hide();
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


function onSelectSO(socode) {    

    $("#editsocode").val(socode);
    $("#tableSODetail tbody").empty();
    $("#tableEditSODetail").show();
    $("#printsocode").val(socode);
    
    if ($("#" + socode + " td:eq(5)").text() == "รออนุมัติขาย") {
        // enabledSupSO(); 
        $("#btnEdit").show();
        $("#btnAddSOdetail2").show();
        $("#btnAddSOGiveaway2").show();
    } else {
        disabledSupSO();
        $("#btnEdit").hide();
        $("#btnAddSOdetail2").hide();
        $("#btnAddSOGiveaway2").hide();
    }

    if ($("#" + socode + " td:eq(5)").text() == "ยกเลิกการใช้งาน")
        $("#btnPrint").hide();
    else
        $("#btnPrint").show();

    $.ajax({
        type: "POST",
        url: "ajax/getsup_so.php",
        data: "idcode=" + socode,
        success: function(result) {

            $("#editsocode").val(result.socode);
            $("#editcuscode").val(result.cuscode);
            $("#editcusname").val(result.cusname);
            $("#editaddress").val(result.address);
            $("#edittel").val(result.tel);
            $("#editsodate").val(result.sodate);
            $("#editdeldate").val(result.deldate);
            $("#editpaydate").val(result.paydate);
            $("#editpayment").val(result.payment);
            $("#editcurrency").val(result.currency);
            $("#editremark").val(result.remark);
            $("#editsalecode").val(result.salecode);
            $("input[name=editvat][value=" + result.vat + "]").prop('checked', true);

        }
    });

    if (($("#" + socode + " td:eq(5)").text() != "สมบูรณ์") && ($("#" + socode + " td:eq(5)").text() !=
            "ยกเลิกการใช้งาน"))
        $("#btnCancle").show();
    else
        $("#btnCancle").hide();

    $("#txtHead").text('แก้ไขใบสั่งขาย (Edit Sale Order)');

    $("#divfrmEditSO").show();
    $('#divtableSO').hide();
    $("#btnBack").show();
    $('#btnAddSO').hide();
    $("#btnRefresh").hide();
    $("#tableEditSODetail tbody").empty();
    $("#tableEditSOGiveaway tbody").empty();
    $('#tableEditSOGiveaway').hide();
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
                url: "ajax/getsup_sodetail.php",
                data: "idcode=" + socode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        $('#tableEditSODetail').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="sono" id="sono" ><p class="form-control-static" style="text-align:center">' +
                            result.sono[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .sono[count] + ');" name="amount1"  id="amount1' +
                            result.sono[count] +
                            '"  value="' +
                            result.amount[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            result.sono[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.sono[count] +
                            ',tableEditSODetail,' +
                            result
                            .stcode[count] +
                            '" type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.sono[count] + ');" name="price1" id="price1' +
                            result.sono[count] + '" value="' +
                            result.price[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" onChange="getTotal(' +
                            result.sono[count] + ');" name="discount1" id="discount1' +
                            result.sono[count] +
                            '" value="' +
                            result.discount[count] +
                            '"><div class="input-group-addon">%</div></div></td><td ><p name="total1" id="total1' +
                            result.sono[count] +
                            '" class="form-control-static" style="text-align:right">0</p></td><td><select class="form-control" style="text-align:left" name="places1" id="places1' +
                            $('#tableEditSODetail tr').length + '" disabled>' +
                            option +
                            '</select></td></tr>'
                        );
                        getTotal(result.sono[count]);
                        $('#places1' + $('#tableEditSODetail tbody tr').length).val(result
                            .places[count]);

                    }

                }
            });

            $.ajax({
                type: "POST",
                url: "ajax/getsup_sodetail_giveaway.php",
                data: "idcode=" + socode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {
                        if (result.stcode.length > 0)
                            $('#tableEditSOGiveaway').show();
                        $('#tableEditSOGiveaway').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="sono" id="sono" ><p class="form-control-static" style="text-align:center">' +
                            $('#tableEditSOGiveaway tr').length +
                            '</p></td><td><p class="form-control-static" name="stcode2" id="stcode2' +
                            $('#tableEditSOGiveaway tr').length +
                            '" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:left">' +
                            result
                            .stname1[count] +
                            '</p></td><td><input type="number" style="text-align:right" class="form-control" name="amount2"  id="amount2' +
                            $('#tableEditSOGiveaway tr').length +
                            '" value="' +
                            result.amount[count] +
                            '"></td><td><div class="input-group"><input type="text" class="form-control" style="text-align:center" name="unit2" id="unit2' +
                            $('#tableEditSOGiveaway tr').length + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit2" data-whatever="' +
                            $('#tableEditSOGiveaway tr').length +
                            ',tableEditSOGiveaway," type="button"><span class="fa fa-search"></span></button></span></div></td><td><select class="form-control" style="text-align:left" name="places2" id="places2' +
                            $('#tableEditSOGiveaway tr').length + '" disabled>' +
                            option +
                            '</select></td></tr>'
                        );
                        $('#places2' + $('#tableEditSOGiveaway tbody tr').length).val(result
                            .places[count]);
                        // getTotal(result.rrno[count]);

                    }

                }
            });
        }
    });


    // $("#tableEditPoDetail").show();

}

function getSO() {
    $.ajax({
        type: "POST",
        url: "ajax/get_so.php",
        data: "&type=" + '<?php echo $_SESSION['type'];?>' +
            "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.socode.length; count++) {


                if (result.supstatus[count] == '01') {
                    supstatus = 'รออนุมัติขาย'
                    suptitle = 'รออนุมัติขาย'
                } else if (result.supstatus[count] == '02') {
                    supstatus = 'รอออกใบกำกับภาษี'
                    suptitle = 'รอออกใบกำกับภาษี'
                } else if (result.supstatus[count] == '03') {
                    supstatus = 'รอยืนยันส่งสินค้า'
                    suptitle = 'รอยืนยันส่งสินค้า'
                } else if (result.supstatus[count] == '04') {
                    supstatus = 'สมบูรณ์';
                    suptitle = 'สมบูรณ์';
                } else if (result.supstatus[count] == 'C') {
                    supstatus = 'ยกเลิกการใช้งาน'
                    suptitle = 'ยกเลิกการใช้งาน'
                } else if (result.supstatus[count] == 'N') {
                    supstatus = 'ยังส่งของไม่ครบ'
                    suptitle = 'ยังส่งของไม่ครบ'
                }
                sodate = result
                    .sodate[count].substring(8) + '-' + result
                    .sodate[count].substring(5, 7) + '-' + result
                    .sodate[count].substring(0, 4);

                $('#tableSO').append(
                    '<tr id="' + result.socode[
                        count] + '" onClick="onSelectSO(this.id);" ><td>' + result.socode[count] +
                    '</td><td>' + sodate + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result
                    .cusname[count] + '</td><td><span title="' + suptitle + '">' + supstatus +
                    '</span></td></tr>');
            }

            var table = $('#tableSO').DataTable({
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


    getSO();

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

    //modal เพิ่มของขาย
    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_stock tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" data-target="#modelStockEdit" id="' +
                    result.stcode[count] + '" data-whatever="' + result
                    .code[count] + '"><td>' + result.stcode[count] +
                    '</td><td>' +
                    result.stname1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount1[count] +
                    '</td><td style="text-align:right">' +
                    result.piece1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount2[count] +
                    '</td><td style="text-align:right">' +
                    result.piece2[count] +
                    '</td><td style="text-align:right">' +
                    result.amount3[count] +
                    '</td><td style="text-align:right">' +
                    result.piece3[count] +
                    '</td></tr>');


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

    //modal เพิ่มของแถม
    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_giveaway tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" data-target="#modelStockEdit" id="' +
                    result.stcode[count] + '" data-whatever="' + result
                    .code[count] + '"><td>' + result.stcode[count] +
                    '</td><td>' +
                    result.stname1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount1[count] +
                    '</td><td style="text-align:right">' +
                    result.piece1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount2[count] +
                    '</td><td style="text-align:right">' +
                    result.piece2[count] +
                    '</td><td style="text-align:right">' +
                    result.amount3[count] +
                    '</td><td style="text-align:right">' +
                    result.piece3[count] +
                    '</td></tr>');


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

    //modal เพิ่มของขาย
    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_stock2 tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" data-target="#modelStockEdit" id="' +
                    result.stcode[count] + '" data-whatever="' + result
                    .code[count] + '"><td>' + result.stcode[count] +
                    '</td><td>' +
                    result.stname1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount1[count] +
                    '</td><td style="text-align:right">' +
                    result.piece1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount2[count] +
                    '</td><td style="text-align:right">' +
                    result.piece2[count] +
                    '</td><td style="text-align:right">' +
                    result.amount3[count] +
                    '</td><td style="text-align:right">' +
                    result.piece3[count] +
                    '</td></tr>');


            }

            $('#table_stock2').DataTable({
                "dom": '<"pull-left"f>rt<"bottom"p><"clear">',
                "ordering": true
            });


            $(".dataTables_filter input[type='search']").attr({
                size: 40,
                maxlength: 40
            });
        }
    });

    //modal เพิ่มของแถม
    $.ajax({
        type: "POST",
        url: "ajax/get_stock.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_giveaway2 tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal" data-target="#modelStockEdit" id="' +
                    result.stcode[count] + '" data-whatever="' + result
                    .code[count] + '"><td>' + result.stcode[count] +
                    '</td><td>' +
                    result.stname1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount1[count] +
                    '</td><td style="text-align:right">' +
                    result.piece1[count] +
                    '</td><td style="text-align:right">' +
                    result.amount2[count] +
                    '</td><td style="text-align:right">' +
                    result.piece2[count] +
                    '</td><td style="text-align:right">' +
                    result.amount3[count] +
                    '</td><td style="text-align:right">' +
                    result.piece3[count] +
                    '</td></tr>');


            }

            $('#table_giveaway2').DataTable({
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

    $('#modal_unit2').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var recipient = button.data('whatever')
        var modal = $(this);

        $.ajax({
            type: "POST",
            url: "ajax/get_unit.php",

            success: function(result) {
                $('#table_unit2 tbody').empty();
                for (count = 0; count < result.unitcode.length; count++) {

                    $('#table_unit2 tbody').append(
                        '<tr data-toggle="modal" data-dismiss="modal" onClick="onClick_unit2(\'' +
                        result.unit[count] + '\',\'' + recipient + '\');"  id="' +
                        result
                        .unitcode[count] + '" );"><td>' + result.unitcode[count] +
                        '</td><td>' +
                        result.unit[count] + '</td></tr>');


                }


            }
        });
    })



    // กดยืนยันเพิ่ม SO
    $("#frmSO").submit(function(event) {
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


        $('#tableSODetail tbody tr').each(function(key) {
            stcode.push($(this).find("td #stcode1" + (++key)).text());
        });
        $('#tableSODetail tbody tr').each(function(key) {
            amount.push($(this).find("td #amount1" + (++key)).val());
        });
        $('#tableSODetail tbody tr').each(function(key) {
            unit.push($(this).find("td #unit1" + (++key)).val());
        });
        $('#tableSODetail tbody tr').each(function(key) {
            price.push($(this).find("td #price1" + (++key)).val());
        });
        $('#tableSODetail tbody tr').each(function(key) {
            discount.push($(this).find("td #discount1" + (++key)).val());
        });

        $('#tableSOGiveaway tbody tr').each(function(key) {
            stcode2.push($(this).find("td #stcode2" + (++key)).text());
        });
        $('#tableSOGiveaway tbody tr').each(function(key) {
            amount2.push($(this).find("td #amount2" + (++key)).val());
        });
        $('#tableSOGiveaway tbody tr').each(function(key) {
            unit2.push($(this).find("td #unit2" + (++key)).val());
        });

        if ($("#cuscode").val() != '') {
            if (stcode != 0) {
                if ($('input[name="vat"][value="Y"]').prop("checked")||$('input[name="vat"][value="N"]').prop("checked")) {                    
                    $(':disabled').each(function(event) {
                        $(this).removeAttr('disabled');
                    });

                    $.ajax({
                        type: "POST",
                        url: "ajax/add_so.php",
                        data: $("#frmSO").serialize() + "&amount=" + amount + "&stcode=" +
                            stcode +
                            "&unit=" + unit +
                            "&price=" + price +
                            "&discount=" + discount + "&stcode2=" + stcode2 + "&amount2=" +
                            amount2 +
                            "&unit2=" + unit2 +
                            "&salecode=" + '<?php echo $_SESSION['salecode'];?>',
                        success: function(result) {
                            if (result.status == 1) {
                                alert(result.message);
                                window.location.reload();
                                // console.log(result.sql);
                            } else {
                                alert(result.message);

                                $("#editsocode").prop("disabled", true);
                                $("#editcuscode").prop("disabled", true);
                                $("#editcusname").prop("disabled", true);
                                $("#edittdname").prop("disabled", true);
                                $("#edittel").prop("disabled", true);
                                $("#editaddress").prop("disabled", true);

                                // console.log(result.message);
                            }
                        }
                    });
                } else {
                    alert('กรุณาเลือก VAT ก่อน');
                }
            } else {
                alert('กรุณาเพิ่มรายการ');
            }
        } else {
            alert('กรุณาเลือกลูกค้า');
        }
    });

    // กดยืนยันแก้ไข SO
    $("#frmEditSO").submit(function(event) {
        event.preventDefault();

        // alert('ระบบแก้ไขกำลังปรับปรุง')

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


        $('#tableEditSODetail tbody tr').each(function() {
            stcode.push($(this).attr("id"));
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            amount.push($(this).find("td #amount1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            unit.push($(this).find("td #unit1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            price.push($(this).find("td #price1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            discount.push($(this).find("td #discount1" + (++key)).val());
        });

        $('#tableEditSODetail tbody tr').each(function(key) {
            places.push($(this).find("td #places1" + (++key)).val());
        });

        $('#tableEditSOGiveaway tbody tr').each(function() {
            stcode2.push($(this).attr("id"));
        });
        $('#tableEditSOGiveaway tbody tr').each(function(key) {
            amount2.push($(this).find("td #amount2" + (++key)).val());
        });
        $('#tableEditSOGiveaway tbody tr').each(function(key) {
            unit2.push($(this).find("td #unit2" + (++key)).val());
        });
        $('#tableEditSOGiveaway tbody tr').each(function(key) {
            places2.push($(this).find("td #places2" + (++key)).val());
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
                    alert(result.message);
                    $("#editsocode").prop("disabled", true);
                    $("#editcuscode").prop("disabled", true);
                    $("#editcusname").prop("disabled", true);
                    $("#edittdname").prop("disabled", true);
                    $("#edittel").prop("disabled", true);
                    $("#editaddress").prop("disabled", true);
                    // console.log(result.message);
                }
            }
        });

    });

    // เพิ่ม so detail เมื่อเลือกสต๊อก
    $("#table_stock").delegate('tbody tr', 'click', function() {
        var id = $(this).attr("id");

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

                        onCreate_detail(result.stcode, result.stname1, result
                            .unit, result.sellprice);

                    }
                });
            }
        });


    });


    // เพิ่ม po detail เมื่อเลือกสต๊อก
    $("#table_giveaway").delegate('tbody tr', 'click', function() {
        var target = $(this).attr("id");
        var id = target.split(',')[0];
        var row = target.split(',')[1];
        $('#tableSOGiveaway').show();
        // alert(row+' test '+id);
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

                        onCreate_giveaway(result.stcode, result.stname1, result
                            .unit)

                    }
                });

            }
        });




    });

    // เพิ่ม so detail เมื่อเลือกสต๊อกเพิ่มเติม
    $("#table_stock2").delegate('tbody tr', 'click', function() {
        var id = $(this).attr("id");
        var option = '';

        if (confirm("คุณต้องการเพิ่มสินค้ารหัส " + id + " หรือไม่")) {
            $.ajax({
                type: "POST",
                url: "ajax/add_sodetail.php",
                data: "stcode=" + id + "&socode=" + $("#editsocode").val(),
                success: function(result) {
                    // alert(result.message);

                    if (result.status == 1) {
                        alert(result.message);
                        onSelectSO($("#editsocode").val());
                        // console.log(result.sql);
                    } else {
                        alert(result.message);
                        $("#editsocode").prop("disabled", true);
                        $("#editcuscode").prop("disabled", true);
                        $("#editcusname").prop("disabled", true);
                        $("#edittdname").prop("disabled", true);
                        $("#edittel").prop("disabled", true);
                        $("#editaddress").prop("disabled", true);
                        // console.log(result.message);
                    }


                }
            });

        }



    });


    // เพิ่ม so detail เมื่อเลือกสต๊อกของแถมเพิ่มเติม
    $("#table_giveaway2").delegate('tbody tr', 'click', function() {
        var id = $(this).attr("id");

        if (confirm("คุณต้องการเพิ่มของแถมรหัส " + id + " หรือไม่")) {

            // $('#tableEditSOGiveaway').show();

            $.ajax({
                type: "POST",
                url: "ajax/add_sodetail_giveaway.php",
                data: "stcode=" + id + "&socode=" + $("#editsocode").val(),
                success: function(result) {
                    // alert(result.message);

                    if (result.status == 1) {
                        alert(result.message);
                        onSelectSO($("#editsocode").val());
                        // console.log(result.sql);
                    } else {
                        alert(result.message);
                        $("#editsocode").prop("disabled", true);
                        $("#editcuscode").prop("disabled", true);
                        $("#editcusname").prop("disabled", true);
                        $("#edittdname").prop("disabled", true);
                        $("#edittel").prop("disabled", true);
                        $("#editaddress").prop("disabled", true);
                        // console.log(result.message);
                    }


                }
            });

        }




    });



    // ยกเลิกอนุมัติการขาย
    $("#btnCancle").click(function() {
        var so_code = $("#editsocode").val();

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


        $('#tableEditSODetail tbody tr').each(function() {
            stcode.push($(this).attr("id"));
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            amount.push($(this).find("td #amount1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            unit.push($(this).find("td #unit1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            price.push($(this).find("td #price1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            discount.push($(this).find("td #discount1" + (++key)).val());
        });
        $('#tableEditSODetail tbody tr').each(function(key) {
            places.push($(this).find("td #places1" + (++key)).val());
        });

        $('#tableEditSOGiveaway tbody tr').each(function() {
            stcode2.push($(this).attr("id"));
        });
        $('#tableEditSOGiveaway tbody tr').each(function(key) {
            amount2.push($(this).find("td #amount2" + (++key)).val());
        });
        $('#tableEditSOGiveaway tbody tr').each(function(key) {
            unit2.push($(this).find("td #unit2" + (++key)).val());
        });
        $('#tableEditSOGiveaway tbody tr').each(function(key) {
            places2.push($(this).find("td #places2" + (++key)).val());
        });


        // alert('ไม่สามารถยกเลิกได้ กรุณาติดต่อโปรแกรมเมอร์');
        // window.location.reload();
        // alert(amount2);

        if (confirm("คุณต้องการยกเลิกใบสั่งขาย " + so_code + " หรือไม่")) {
            $.ajax({
                type: "POST",
                data: $("#frmEditSO").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                    "&unit=" + unit +
                    "&price=" + price +
                    "&places=" + places +
                    "&discount=" + discount + "&stcode2=" + stcode2 + "&amount2=" + amount2 +
                    "&unit2=" + unit2 +
                    "&places2=" + places2,
                url: "ajax/cancle_so.php",
                success: function(result) {
                    alert(result["message"]);
                    window.location.reload();
                }
            });
        } else
            window.location.reload();
    });


    //Refresh
    $("#btnRefresh").click(function() {
        RefreshPage();
    });

    // ลบค่าในฟอร์ม
    $("#btnAddClear").click(function() {
        $("#tdcode").val('');
        $("#tdname").val('');
        $("#idno").val('');
        $("#road").val('');
        $("#subdistrict").val('');
        $("#district").val('');
        $("#province").val('');
        $("#country").val('');
        $("#zipcode").val('');
        $("#tel").val('');
        $("#fax").val('');
        $("#email").val('');
    });


    // ย้ายไปหน้า เพิ่ม SO
    $("#btnAddSO").click(function() {

        $("#socode").val('');
        $("#supcode").val('');
        $("#tdname").val('');
        $("#address").val('');
        $("#sodate").val(formatDate(new Date()));
        $("#deldate").val(formatDate(new Date()));
        $("#paydate").val(formatDate(new Date()));
        $("#tableSODetail tbody").empty();
        previewSOcode();

        $("#tableEditSODetail").hide();
        $("#tableSODetail").show();

        $("#txtHead").text('เพิ่มใบสั่งขาย (Add Sales Order)');
        $("#frmSO").show();
        $("#divfrmSO").show();
        $("#divfrmEditSO").hide();
        $('#divtableSO').hide();
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