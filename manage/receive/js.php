<script type="text/javascript">
function onClick_tr(id, supname, address) {
    $('#supcode').val(id);
    $('#tdname').val(supname);
    // $('#address').val(address);
}

function onClick_unit(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    // alert(streetaddress + ' ' + (streetaddress2));

    $('#unit1' + row).val(unit);

}

function onClick_unit2(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    // alert(streetaddress + ' ' + (streetaddress2));

    $('#unit2' + row).val(unit);

}

function onDeleteDetail(table, id) {
    $("#" + table + " tbody").empty();
    $("#" + id).hide();

    if (table == "tableRRGiveaway")
        $('#tableRRGiveaway').hide();
}


function getTotal(row) {
    $('#total2' + row).html(formatMoney(($('#amount2' + row).val() *
        $('#price2' +
            row).val()) - ((($('#amount2' + row).val() *
        $(
            '#price2' + row).val()) * $(
        '#discount2' +
        row).val()) / 100), 2));

}

function previewRRcode() {
    $.ajax({
        type: "POST",
        url: "ajax/get_rrcode.php",
        success: function(result) {

            $("#rrcode").val(result.rrcode);

        }
    });

}

function onSelectRR(rrcode) {

    $("#editrrcode").val(rrcode);
    $("#printrrcode").val(rrcode);
    $("#tableRRDetail tbody").empty();
    $("#tableEditRRDetail").show();
    $.ajax({
        type: "POST",
        url: "ajax/getsup_rr.php",
        data: "idcode=" + rrcode,
        success: function(result) {

            $("#editrrcode").val(result.rrcode);
            $("#editsupcode").val(result.supcode);
            $("#edittdname").val(result.supname);
            $("#editaddress").val(result.address);
            $("#editrrdate").val(result.rrdate);
            $("#editinvcode").val(result.invcode);
            $("#editinvdate").val(result.invdate);
            $("#editpayment").val(result.payment);



        }
    });

    $("#divfrmEditRR").show();

    $("#txtHead").text('Edit Goods Receive');

    $('#divtableRR').hide();
    $("#btnBack").show();
    $('#btnAddRR').hide();
    $("#btnRefresh").hide();
    $("#btnPrint").show();
    $("#tableEditRRDetail tbody").empty();
    $("#tableEditRRGiveaway tbody").empty();
    $('#tableEditRRGiveaway').hide();

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
                url: "ajax/getsup_rrdetail.php",
                data: "idcode=" + rrcode,
                success: function(result) {

                    var status;
                    var title;


                    for (count = 0; count < result.stcode.length; count++) {
                        if (result.rrstatus[count] == '01') {
                            status = 'R';
                            title = 'รอรับของ';
                        } else if (result.rrstatus[count] == '02') {
                            status = 'N';
                            title = 'ยังรับของไม่ครบ';
                        } else if (result.rrstatus[count] == '03') {
                            status = 'Y';
                            title = 'รับของครบแล้ว';
                        } else if (result.rrstatus[count] == 'C') {
                            status = 'C';
                            title = 'ยกเลิก';
                        }
                        // alert(result.stcode[count]);
                        $('#tableEditRRDetail').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="rrno" id="rrno" ><p class="form-control-static" style="text-align:center">' +
                            result.rrno[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .pocode[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            result.rrno[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                            result.rrno[count] +
                            ',tableEditRRDetail," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result
                            .rrno[count] + ');" name="amount1"  id="amount1' +
                            result.rrno[count] +
                            '"  value="' +
                            result.amount[count] +
                            '" disabled></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.rrno[count] + ');" name="recamount1" id="recamount1' +
                            result.rrno[count] + '" value="' +
                            result.recamount[count] +
                            '" disabled></td><td><select class="form-control" style="text-align:left" name="places1" id="places1' +
                            $('#tableEditRRDetail tr').length + '" disabled>' + option +
                            '</select ></td><td><p style="text-align:center" class="form-control-static" title="' +
                            title + '" >' + status +
                            '</p></td></tr>'
                        );
                        $('#places1' + $('#tableEditRRDetail tbody tr').length).val(result
                            .places[count]);


                    }

                }
            });

            $.ajax({
                type: "POST",
                url: "ajax/getsup_rrdetail_giveaway.php",
                data: "idcode=" + rrcode,
                success: function(result) {
                    for (count = 0; count < result.stcode.length; count++) {

                        if (result.stcode.length > 0)
                            $('#tableEditRRGiveaway').show();
                        $('#tableEditRRGiveaway').append(
                            '<tr id="' + result.stcode[count] +
                            '" ><td name="rrno" id="rrno" ><p class="form-control-static" style="text-align:center">' +
                            result.rrno[count] +
                            '</p></td><td><p class="form-control-static" style="text-align:center">' +
                            result
                            .stcode[count] +
                            '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                            result.stname1[count] +
                            '</p></td><td><div class="input-group"><input type="text" class="form-control" name="unit2" id="unit2' +
                            result.rrno[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit2" data-whatever="' +
                            result.rrno[count] +
                            ',tableEditRRGiveaway," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.rrno[count] + ');" name="recamount2" id="recamount2' +
                            result.rrno[count] + '" value="' +
                            result.recamount[count] +
                            '" disabled></td><td><select class="form-control" style="text-align:left" name="places2" id="places2' +
                            $('#tableEditRRGiveaway tr').length + '" disabled>' + option +
                            '</select ></td></tr>'
                        );
                        // alert($('#tableEditRRGiveaway tr').length);
                        $('#places2' + $('#tableEditRRGiveaway tbody tr').length).val(result
                            .places[count]);

                    }

                }
            });
        }
    });




    // $("#tableEditPoDetail").show();

}

function getRR() {
    $.ajax({
        type: "POST",
        url: "ajax/get_rr.php",
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.rrcode.length; count++) {

                if (result.rrstatus[count] == '01') {
                    supstatus = 'R'
                    suptitle = 'รอรับของ'
                } else if (result.rrstatus[count] == '02') {
                    supstatus = 'N'
                    suptitle = 'ยังรับของไม่ครบ'
                } else if (result.rrstatus[count] == '03') {
                    supstatus = 'Y'
                    suptitle = 'รับของครบแล้ว'
                } else if (result.rrstatus[count] == 'C') {
                    supstatus = 'C'
                    suptitle = 'ยกเลิกการใช้งาน'
                }

                $('#tableRR').append(
                    '<tr id="' + result.rrcode[
                        count] + '" onClick="onSelectRR(this.id);" ><td>' + result.rrcode[count] +
                    '</td><td>' + result
                    .rrdate[count] + '</td><td>' + result
                    .stcode[count] + '</td><td>' + result.stname1[count] + '</td><td>' + result
                    .supname[count] + '</td><td><span title="' + suptitle + '">' + supstatus +
                    '</span></td></tr>');
            }

            var table = $('#tableRR').DataTable({
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


$('.ajax').click(function() {
    $.ajax({
        url: '#',
        success: function(result) {
            $('.ajax-content').html('<hr>Ajax Request Completed !')
        }
    });
});

$(function() {
    // $(document).ajaxStart(function() {
    // Pace.restart()
    // });
    getRR();

    $.ajax({
        type: "POST",
        url: "ajax/get_supplier.php",

        success: function(result) {

            for (count = 0; count < result.code.length; count++) {

                $('#table_id tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .supcode[count] + '" onClick="onClick_tr(this.id,\'' + result.supname[
                        count] + '\',\'' + result.address[count] + '\');"><td>' + result.code[
                        count] + '</td><td>' +
                    result.supcode[count] + '</td><td>' +
                    result.supname[count] + '</td></tr>');


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


    $('#modal_po').on('shown.bs.modal', function() {

        // alert($('#tableRRDetail').val());

        $('#table_po tbody').empty();
        if ($('#supcode').val() != '') {
            $.ajax({
                type: "POST",
                url: "ajax/get_podetail.php",
                data: "idcode=" + $('#supcode').val(),
                success: function(result) {
                    // alert(result.pocode);
                    var status;
                    var title;
                    $('#txtsupname').text(result.supname[0]);

                    for (count = 0; count < result.pocode.length; count++) {


                        if (result.supstatus[count] == '01') {
                            status = 'R';
                            title = 'รอรับของ';
                        } else if (result.supstatus[count] == '02') {
                            status = 'N';
                            title = 'ยังรับของไม่ครบ';
                        } else if (result.supstatus[count] == '03') {
                            status = 'Y';
                            title = 'รับของครบแล้ว';
                        } else if (result.supstatus[count] == 'C') {
                            status = 'C';
                            title = 'ยกเลิก';
                        }

                        $('#table_po tbody').append(
                            '<tr id="' +
                            result.pocode[count] + ',' +
                            result.pono[count] +
                            '" );"><td><input type="checkbox" id="' + 'chk' +
                            count + '" name="' + 'chk' +
                            count + '" value="' + count + '" ></td><td>' + [count + 1] +
                            '</td><td>' +
                            result.pocode[count] + '</td><td>' +
                            result.stcode[count] + '</td><td>' + result.stname1[count] +
                            '</td><td>' +
                            result.unit[count] + '</td><td style="text-align:right">' +
                            result.amount[count] +
                            '</td><td style="text-align:right">' + result.recamount[
                                count] +
                            '</td><td><p style="text-align:center" class="form-control-static" title="' +
                            title + '" >' + status +
                            '</p></td></tr>');


                    }

                }
            });
        } else {
            alert('กรุณาเลือกผู้ขาย');
            $('#modal_po').modal('toggle');
        }
    })


    // กดยืนยันเพิ่ม RR
    $("#frmRR").submit(function(event) {
        event.preventDefault();

        var amount = [];
        var stcode = [];
        var unit = [];
        var recamount = [];
        var pocode = [];
        var price = [];
        var discount = [];
        var places = [];

        var stcode2 = [];
        var amount2 = [];
        var unit2 = [];
        var price2 = [];
        var places2 = [];

        $('#tableRRDetail tbody tr').each(function() {
            stcode.push($(this).attr("id"));
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            amount.push($(this).find("td #amount1" + (++key)).val());
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            unit.push($(this).find("td #unit1" + (++key)).val());
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            price.push($(this).find("td #price1" + (++key)).val());
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            discount.push($(this).find("td #discount1" + (++key)).val());
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            recamount.push($(this).find("td #recamount1" + (++key)).val());
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            pocode.push($(this).find("td #pocode1" + (++key)).text());
        });
        $('#tableRRDetail tbody tr').each(function(key) {
            places.push($(this).find("td #places1" + (++key)).val());
        });

        $('#tableRRGiveaway tbody tr').each(function() {
            stcode2.push($(this).attr("id"));
        });
        $('#tableRRGiveaway tbody tr').each(function(key) {
            amount2.push($(this).find("td #amount2" + (++key)).val());
        });
        $('#tableRRGiveaway tbody tr').each(function(key) {
            unit2.push($(this).find("td #unit2" + (++key)).val());
        });
        $('#tableRRGiveaway tbody tr').each(function(key) {
            price2.push($(this).find("td #price2" + (++key)).val());
        });
        $('#tableRRGiveaway tbody tr').each(function(key) {
            places2.push($(this).find("td #places2" + (++key)).val());
        });
        // alert(places);

        if (stcode != 0) {
            $(':disabled').each(function(event) {
                $(this).removeAttr('disabled');
            });

            $.ajax({
                type: "POST",
                url: "ajax/add_rr.php",
                data: $("#frmRR").serialize() + "&amount=" + amount + "&stcode=" + stcode +
                    "&unit=" + unit +
                    "&recamount=" + recamount +
                    "&price=" + price +
                    "&discount=" + discount +
                    "&pocode=" + pocode +
                    "&places=" + places + "&stcode2=" + stcode2 + "&amount2=" + amount2 +
                    "&unit2=" + unit2 +
                    "&price2=" + price2 +
                    "&places2=" + places2,
                success: function(result) {
                    if (result.status == 1) {
                        alert(result.message);
                        window.location.reload();
                        // console.log(result.sql);
                    } else {
                        alert(result.message);
                        console.log(result.message);
                    }
                }
            });
        } else {
            alert('กรุณาเพิ่มรายการ');
        }
    });

    // เพิ่ม po detail เมื่อเลือกสต๊อก
    $("#btnSubmitPO").click(function() {
        // $('#tableRRDetail').val()
        var table = $("#table_po tbody");
        var rows = $('#table_po tbody tr').length;
        $("#tableRRDetail tbody").empty();
        // alert(row);
        var option = '';
        $.ajax({
            type: "POST",
            url: "ajax/get_places.php",

            success: function(result) {
                for (var i = 0; i < rows; i++) {

                    if ($('#chk' + i).is(':checked')) {

                        var target = $('#chk' + i).closest('tr').attr('id');
                        var id = [];
                        id[i] = target.split(',')[0];
                        var row = [];
                        row[i] = target.split(',')[1];
                        $('#btnClearRRdetail').show();
                        


                        for (count = 0; count < result.places.length; count++) {
                            option += '<option value="' + result.placescode[count] + '">' +
                                result
                                .places[count] + '</option>';


                        }
                        
                        $.ajax({
                            type: "POST",
                            url: "ajax/getsup_podetail.php",
                            data: "idcode=" + id[i] +
                                "&row=" + row[i],
                            success: function(result) {
                                console.log(result);
                                var status;
                                var title;
                                if (result.supstatus == '01') {
                                    status = 'R';
                                    title = 'รอรับของ';
                                } else if (result.supstatus == '02') {
                                    status = 'N';
                                    title = 'ยังรับของไม่ครบ';
                                } else if (result.supstatus == '03') {
                                    status = 'Y';
                                    title = 'รับของครบแล้ว';
                                } else if (result.supstatus == 'C') {
                                    status = 'C';
                                    title = 'ยกเลิก';
                                }

                                $('#tableRRDetail').append(
                                    '<tr id="' + result.stcode +
                                    '" ><td name="pono" id="pono" ><p class="form-control-static" style="text-align:center">' +
                                    $('#tableRRDetail tr').length +
                                    '</p></td><td><p class="form-control-static" name="pocode1" id="pocode1' +
                                    $('#tableRRDetail tr').length +
                                    '" style="text-align:left">' +
                                    result
                                    .pocode +
                                    '</p></td><td><p class="form-control-static" style="text-align:center">' +
                                    result
                                    .stcode +
                                    '</p></td><td> <p class="form-control-static" style="text-align:left">' +
                                    result.stname1 +
                                    '</p></td><td><div class="input-group"><input type="text" class="form-control" style="text-align:center" name="unit1" id="unit1' +
                                    $('#tableRRDetail tr').length +
                                    '" value="' +
                                    result.unit +
                                    '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit" data-whatever="' +
                                    $('#tableRRDetail tr').length +
                                    ',tablePoDetail," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="number" style="text-align:right" class="form-control" name="amount1"  id="amount1' +
                                    $('#tableRRDetail tr').length +
                                    '" min="1" max="' +
                                    result.recamount +
                                    '" value="' +
                                    result.recamount +
                                    '" disabled></td><td><input type="number" class="form-control" style="text-align:right" name="recamount1" id="recamount1' +
                                    $('#tableRRDetail tr').length +
                                    '"  min="1" max="' +
                                    (result.amount - result.recamount) +
                                    '" value="' +
                                    (result.amount - result.recamount) +
                                    '"></td><td><select class="form-control" style="text-align:left" name="places1" id="places1' +
                                    $('#tableRRDetail tr').length + '" >' +
                                    option +
                                    '</select></td><td><p style="text-align:center" class="form-control-static" title="' +
                                    title + '" >' + status +
                                    '</p> <input type="hidden" id="price1' +
                                    $('#tableRRDetail tr').length +
                                    '" name="price1" value="' +
                                    result.price +
                                    '"><input type="hidden" id="discount1' +
                                    $('#tableRRDetail tr').length +
                                    '" name="discount1" value="' +
                                    result.discount +
                                    '"></td></tr>'
                                );



                            }
                        });


                    }
                }




            }
        });

    });

    // เพิ่ม po detail เมื่อเลือกสต๊อก
    $("#table_giveaway").delegate('tr', 'click', function() {
        var target = $(this).attr("id");
        var id = target.split(',')[0];
        var row = target.split(',')[1];
        $('#btnClearRRGiveaway').show();
        $('#tableRRGiveaway').show();
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

                        $('#tableRRGiveaway').append(
                            '<tr id="' + result.stcode +
                            '" ><td name="stno" id="stno" ><p class="form-control-static" style="text-align:center">' +
                            $('#tableRRGiveaway tr').length +
                            '</p></td><td><p class="form-control-static" name="stcode2" id="stcode2' +
                            $('#tableRRGiveaway tr').length +
                            '" style="text-align:center">' +
                            result
                            .stcode +
                            '</p></td><td><p class="form-control-static" style="text-align:left">' +
                            result
                            .stname1 +
                            '</p></td><td><div class="input-group"><input type="text" class="form-control" style="text-align:center" name="unit2" id="unit2' +
                            $('#tableRRGiveaway tr').length + '" value="' +
                            result.unit +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-toggle="modal" data-target="#modal_unit2" data-whatever="' +
                            $('#tableRRGiveaway tr').length +
                            ',tablePoDetail," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="number" style="text-align:right" class="form-control" name="amount2"  id="amount2' +
                            $('#tableRRGiveaway tr').length +
                            '" value="0"></td><td><input type="number" style="text-align:right" class="form-control" name="price2"  id="price2' +
                            $('#tableRRGiveaway tr').length +
                            '" value="' +
                            result.sellprice +
                            '"></td><td><p name="total2" id="total2' +
                            $('#tableRRGiveaway tr').length +
                            '" class="form-control-static" style="text-align:right">0</p></td><td><select class="form-control" style="text-align:left" name="places2" id="places2' +
                            $('#tableRRGiveaway tr').length + '" >' +
                            option +
                            '</select></td></tr>'
                        );

                        var row = $('#tableRRGiveaway tbody tr').length;

                        $('#amount2' + row).change(function() {
                            $('#total2' + row).html(formatMoney(($(
                                    '#amount2' + row)
                                .val() * $('#price2' + row)
                                .val())));

                        });

                        $('#price2' + row).change(function() {
                            $('#total2' + row).html(formatMoney(($(
                                    '#amount2' + row)
                                .val() * $('#price2' + row)
                                .val())));
                        });

                        $('input[type=text]').on('keydown', function(e) {
                            $('#total2' + row).html(formatMoney(($(
                                    '#amount2' + row)
                                .val() * $('#price2' + row)
                                .val())))
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


    // ย้ายไปหน้า เพิ่ม PO
    $("#btnAddRR").click(function() {

        $("#rrcode").val('');
        $("#supcode").val('');
        $("#tdname").val('');
        $("#address").val('');
        $("#rrdate").val(formatDate(new Date()));
        $("#invdate").val(formatDate(new Date()));
        $("#tableRRDetail tbody").empty();
        previewRRcode();

        $("#tableEditRRDetail").hide();
        $("#tableRRDetail").show();

        $("#txtHead").text('สร้างใบรับสินค้า (Add Goods Receive)');
        $("#frmRR").show();
        $("#divfrmRR").show();
        $("#divfrmEditRR").hide();
        $('#divtableRR').hide();
        $('#btnAddRR').hide();
        $("#btnAddSubmit").show();
        $("#btnBack").show();
        $("#btnRefresh").hide();

    });

    // ย้อนกลับไปหน้าหลัก
    $("#btnBack").click(function() {
        // $("#tablePO tbody").empty();

        $("#txtHead").text('ระบบรับสินค้า (Goods Receive)');
        $("#divfrmRR").hide();
        $("#divfrmEditRR").hide();
        $('#divtableRR').show();
        $(this).hide();
        $("#btnPrint").hide();
        $("#btnAddClear").hide();
        $("#btnEditSubmit").hide();
        $("#btnAddSubmit").hide();
        $("#btnAddRR").show();
        $("#btnRefresh").show();
    });


});
</script>