<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    $places = explode(',', $_POST['places']);
    
    $amount2 = explode(',', $_POST['amount2']);
    $stcode2 = explode(',', $_POST['stcode2']);
    $unit2 = explode(',', $_POST['unit2']);
    $places2 = explode(',', $_POST['places2']);
    
    $StrSQL = "UPDATE somaster SET date = '".date("Y-m-d")."', time='".date("H:i:s")."' ";
    $StrSQL .= ",deldate='".$_POST["editdeldate"]."' ,sodate='".$_POST["editsodate"]."',payment='".$_POST["editpayment"]."' ,paydate='".$_POST["editpaydate"]."',currency='".$_POST["editcurrency"]."' ,vat='".$_POST["editvat"]."',remark='".$_POST["editremark"]."' ";
    $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' ";
    $query = mysqli_query($conn,$StrSQL);

    
    if($query) {
        foreach ($stcode as $key=> $value) {
            
            $StrSQL = "UPDATE sodetail SET stcode='". $stcode[$key] ."' ,price ='". $price[$key] ."', unit ='". $unit[$key] ."', amount ='". $amount[$key] ."', discount = '". $discount[$key] ."',places = '". $places[$key] ."' ";
            $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' and sono= '". ++$key ."' and giveaway = '0' ";
            
            $query = mysqli_query($conn,$StrSQL);
            }
        foreach ($stcode2 as $key2=> $value2) {
                if($stcode2[$key2]!='')
                {

                    $StrSQL = "UPDATE sodetail SET stcode='". $stcode2[$key2] ."' , unit ='". $unit2[$key2] ."', amount ='". $amount2[$key2] ."', places = '". $places2[$key2] ."' ";
                    $StrSQL .= "WHERE socode='".$_POST["editsocode"]."' and sono= '". ++$key2 ."' and giveaway = '1' ";
                    
                    $query = mysqli_query($conn,$StrSQL);
                }
            }
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขใบแจ้งซื้อเรียบร้อยแล้ว '. $_POST["editsocode"].' สำเร็จ','sql'=> $StrSQL));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>