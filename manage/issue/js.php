<script type="text/javascript">
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
    if ($("#" + socode + " td:eq(5)").text() == "รอยืนยันส่งสินค้า") {
        $("#btnApp").show();
    }

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
                            '" disabled></td><td><select class="form-control" style="text-align:left" id="places2' +
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

// ตัดขาย
$("#btnApp").click(function() {
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

    

    $(':disabled ').each(function(event) {
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
        url: "ajax/set_issue.php",
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
                onSelectSO($('#editsocode').val());
                disabledSupSO();
            }
        }
    });

});

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


$(function() {


    getSO();

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



    //Refresh
    $("#btnRefresh").click(function() {
        RefreshPage();
    });

    // ย้อนกลับไปหน้าหลัก
    $("#btnBack").click(function() {
        window.location.reload();
    });



});
</script>