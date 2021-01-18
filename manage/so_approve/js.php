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
    // alert(streetaddress + ' ' + (streetaddress2));

    $('#unit1' + row).val(unit);

}

function onClick_unit2(unit, target) {

    var row = target.split(',')[0];
    var id = target.split(',')[1];
    // alert(streetaddress + ' ' + (streetaddress2));

    $('#unit2' + row).val(unit);

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

function onSelectSO(socode) {

    $("#editsocode").val(socode);
    $("#printsocode").val(socode);
    // $("#editpaycondate").val(formatDate(new Date()));
    $("#btnPrintInvoice").show();
    $("#btnPrintReceipt").show();
    $("#tableSODetail tbody").empty();
    $("#tableEditSODetail").show();
    $.ajax({
        type: "POST",
        url: "ajax/getsup_so.php",
        data: "idcode=" + socode,
        success: function(result) {

            $("#editsocode").val(result.socode);
            $("#editcuscode").val(result.cuscode);
            $("#editcusname").val(result.cusname);
            $("#editaddress").val(result.address);
            $("#editdelcode").val(result.delcode);
            $("#editdeltype").val(result.deltype);
            $("#editinvoice").val(result.invoice);
            $("#editpaycondate").val(result.paycondate);
            $("#editrecedate").val(result.recedate);
            $("#edittel").val(result.tel);
            $("#editsodate").val(result.sodate);
            $("#editdeldate").val(result.deldate);
            $("#editpaydate").val(result.paydate);
            $("#editpayment").val(result.payment);
            $("#editcurrency").val(result.currency);
            $("#editremark").val(result.remark);
            $("input[name=editvat][value=" + result.vat + "]").prop('checked', true);

        }
    });

    $("#divfrmEditSO").show();

    $("#txtHead").text('แก้ไขใบสั่งขาย (Edit Sale Order)');

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

                option += '<option value="' + result.placescode[count] + '" disabled>' + result
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
                            '" disabled></td><td><div class="input-group"><input type="text" class="form-control" name="unit1" id="unit1' +
                            result.sono[count] + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-whatever="' +
                            result.sono[count] +
                            ',tableEditSODetail," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="text" class="form-control" onChange="getTotal(' +
                            result.sono[count] + ');" name="price1" id="price1' +
                            result.sono[count] + '" value="' +
                            result.price[count] +
                            '" disabled></td><td><div class="input-group"><input type="text" class="form-control" onChange="getTotal(' +
                            result.sono[count] + ');" name="discount1" id="discount1' +
                            result.sono[count] +
                            '" value="' +
                            result.discount[count] +
                            '" disabled><div class="input-group-addon">%</div></div></td><td ><p name="total1" id="total1' +
                            result.sono[count] +
                            '" class="form-control-static" style="text-align:right">0</p></td><td><select class="form-control" style="text-align:left" name="places1" id="places1' +
                            $('#tableEditSODetail tr').length + '" >' +
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
                            '</p></td><td><div class="input-group"><input type="text" class="form-control" style="text-align:center" name="unit2" id="unit2' +
                            $('#tableEditSOGiveaway tr').length + '" value="' +
                            result.unit[count] +
                            '" disabled><span class="input-group-btn"><button class="btn btn-default" data-whatever="' +
                            $('#tableEditSOGiveaway tr').length +
                            ',tableEditSOGiveaway," type="button"><span class="fa fa-search"></span></button></span></div></td><td><input type="number" style="text-align:right" class="form-control" name="amount2"  id="amount2' +
                            $('#tableEditSOGiveaway tr').length +
                            '" value="' +
                            result.amount[count] +
                            '" disabled></td><td><select class="form-control" style="text-align:left" name="places2" id="places2' +
                            $('#tableEditSOGiveaway tr').length + '" >' +
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
        success: function(result) {
            var supstatus, suptitle;

            for (count = 0; count < result.socode.length; count++) {

                if (result.recedate[count] != '') {
                    supstatus = 'จ่ายเงินแล้ว'
                    suptitle = 'จ่ายเงินแล้ว'
                } else if (result.supstatus[count] == '01') {
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
        url: "ajax/get_invoice_no.php",

        success: function(result) {

            for (count = 0; count < result.socode.length; count++) {

                $('#table_invoice tbody').append(
                    '<tr data-toggle="modal" data-dismiss="modal"  id="' + result
                    .socode[count] + '" ><td>' + result.invoice[
                        count] + '</td><td>' +
                    result.socode[count] + '</td><td>' +
                    result.sodate[count] + '</td><td>' +
                    result.vat[count] + '</td></tr>');


            }

            $('#table_invoice').DataTable({
                "dom": 't<"bottom"p><"clear">',
                "order": [
                    [0, "desc"]
                ]
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

    //สั่งปริ้น Invoice
    $("#btnPrintInvoice").click(function() {

        // alert($("#printsocode").val());
        $.ajax({
            type: "POST",
            url: "ajax/set_invdate.php",
            data: "socode=" + $("#printsocode").val(),
            success: function(result) {
                //    alert(result.log);


            }
        });

    });

    //สั่งปริ้น ใบแจ้งหนี้
    $("#btnPrintReceipt").click(function() {

        // alert($("#printsocode").val());
        $.ajax({
            type: "POST",
            url: "ajax/set_receipt.php",
            data: "socode=" + $("#printsocode").val(),
            success: function(result) {
                //    alert(result.log);


            }
        });

    });

    // กดยืนยันแก้ไข SO
    $("#frmEditSO").submit(function(event) {
        event.preventDefault();


        $(':disabled').each(function(event) {
            $(this).removeAttr('disabled');
        });



        $.ajax({
            type: "POST",
            url: "ajax/edit_so.php",
            data: $("#frmEditSO").serialize(),
            success: function(result) {
                if (result.status == 1) {
                    alert(result.message);
                    $("#editsocode").prop("disabled", true);
                    $("#editcuscode").prop("disabled", true);
                    $("#editcusname").prop("disabled", true);
                    $("#edittdname").prop("disabled", true);
                    $("#edittel").prop("disabled", true);
                    $("#editsodate").prop("disabled", true);
                    $("#editdeldate").prop("disabled", true);
                    $("#editpaydate").prop("disabled", true);
                    $("#editpayment").prop("disabled", true);
                    $("#editcurrency").prop("disabled", true);
                    $("#editvatY").attr("disabled",true);
                    $("#editvatN").attr("disabled",true);
                    $("#editremark").prop("disabled", true);
                    $("#editaddress").prop("disabled", true);
                    
                    // window.location.reload();
                    // console.log(result.sql);
                } else {
                    alert('err');
                    console.log(result.message);
                }
            }
        });

    });

    //Refresh
    $("#btnRefresh").click(function() {
        RefreshPage();
    });

    // ย้อนกลับไปหน้าหลัก
    $("#btnBack").click(function() {
        // $("#tablePO tbody").empty();
        window.location.reload();
        // $("#txtHead").text('ใบสั่งขาย (Sales Order)');
        // $("#divfrmSO").hide();
        // $("#divfrmEditSO").hide();
        // $('#divtableSO').show();
        // $(this).hide();
        // $("#btnPrintInvoice").hide();
        // $("#btnPrintReceipt").hide(); 
        // $("#btnAddClear").hide();
        // $("#btnEditSubmit").hide();
        // $("#btnAddSubmit").hide();
        // $("#btnAddSO").show();
        // $("#btnRefresh").show();
    });


});
</script>