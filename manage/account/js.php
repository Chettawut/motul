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
    // console.log( $("#"+socode+" td:eq(5)").text() );

    $("#editsocode").val(socode);
    $("#printsocode").val(socode);
    if( $("#"+socode+" td:eq(5)").text() == "รอออกใบกำกับภาษี" ){
       $("#btnCal").show(); 
    }else{
       $("#btnApp").show(); 
    }
    
    // $("#btnPrintInvoice").show();
    // $("#btnPrintInvoice2").show();
    // $("#btnPrintReceipt").show();    
    // $("#btnPrintReceipt2").show();    
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
                        $('#places1' + $('#tableEditSODetail tbody tr').length).val(result.places[count]);                   

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
                        $('#places2' + $('#tableEditSOGiveaway tbody tr').length).val(result.places[count]);                   
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
                sodate =  result
                    .sodate[count].substring(8)+'-'+ result
                    .sodate[count].substring(5,7)+'-'+result
                    .sodate[count].substring(0,4);

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


    // ย้อนกลับไปหน้าหลัก
    $("#btnBack").click(function() {
        // $("#tablePO tbody").empty();
        window.location.reload();
        //$("#txtHead").text('ใบสั่งขาย (Sales Order)');
        //$("#divfrmSO").hide();
        //$("#divfrmEditSO").hide();
        //$('#divtableSO').show();
        //$(this).hide();
        //$("#btnPrintInvoice").hide();
        //$("#btnPrintReceipt").hide(); 
        //$("#btnPrintInvoice2").hide();
        //$("#btnPrintReceipt2").hide(); 
        //$("#btnAddClear").hide();
        //$("#btnApp").hide();
        //$("#btnEditSubmit").hide();
        //$("#btnAddSubmit").hide();
        //$("#btnAddSO").show();
        //$("#btnRefresh").show();
    });

    // อนุมัติการขาย
    $("#btnApp").click(function (){
        var so_code = $("#editsocode").val(); 
        if( confirm("คุณต้องการ ที่จะอนุมัติการขาย หรือไม่") ){
           $.ajax({
            type: "POST",
            data: {so_code: so_code, flg:1},
            url: "ajax/approve_so.php",
            success: function(result) {
                alert(result["message"]);
                window.location.reload();
            }
            });
        } 
    });
    // ยกเลิกอนุมัติการขาย
    $("#btnCal").click(function (){
        var so_code = $("#editsocode").val(); 
        if( confirm("คุณต้องการ ที่จะยกเลิกอนุมัติการขาย หรือไม่") ){
           $.ajax({
            type: "POST",
            data: {so_code: so_code, flg:0},
            url: "ajax/approve_so.php",
            success: function(result) {
                alert(result["message"]);
                window.location.reload();
            }
            });
        } 
    });

});
</script>