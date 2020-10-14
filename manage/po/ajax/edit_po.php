<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    date_default_timezone_set("Asia/Bangkok");

    $price = explode(',', $_POST['price']);
    $amount = explode(',', $_POST['amount']);
    $stcode = explode(',', $_POST['stcode']);
    $unit = explode(',', $_POST['unit']);
    $discount = explode(',', $_POST['discount']);
    
    $StrSQL = "UPDATE pomaster SET supcode='".$_POST["editsupcode"]."',date = '".date("Y-m-d")."', time='".date("H:i:s")."' ";
    $StrSQL .= ",deldate='".$_POST["editdeldate"]."' ,podate='".$_POST["editpodate"]."',payment='".$_POST["editpayment"]."' ,poqua='".$_POST["editpoqua"]."',currency='".$_POST["editcurrency"]."' ,vat='".$_POST["editvat"]."' ";
    $StrSQL .= "WHERE pocode='".$_POST["editpocode"]."' ";
    $query = mysqli_query($conn,$StrSQL);

    
    if($query) {
        foreach ($stcode as $key=> $value) {
            $StrSQL = "UPDATE podetail SET stcode='". $stcode[$key] ."' ,price ='". $price[$key] ."', unit ='". $unit[$key] ."', amount ='". $amount[$key] ."', discount = '". $discount[$key] ."'  ";
            $StrSQL .= "WHERE pocode='".$_POST["editpocode"]."' and pono= '". ++$key ."' ";
            
            $query = mysqli_query($conn,$StrSQL);
            }
    }
    
    // echo $StrSQL;

    
        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขใบแจ้งซื้อเรียบร้อยแล้ว '. $_POST["editpocode"].' สำเร็จ','sql'=> $StrSQL));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> $StrSQL));
        }
    
        mysqli_close($conn);
?>