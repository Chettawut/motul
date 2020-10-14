<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    
	// $strSQL = "UPDATE user SET ";
    // $strSQL .= "username='".$_POST["editusername"]."',password='".$_POST["editpassword"]."',firstname='".$_POST["editfirstname"]."',lastname='".$_POST["editlastname"]."',tel='".$_POST["edittel"]."' ";
    // $strSQL .= ",email='".$_POST["editemail"]."',type='".$_POST["edittype"]."',bankcode='".$_POST["editbankcode"]."',bankname='".$_POST["editbankname"]."',date='' ";
    // $strSQL .= "WHERE username= '".$_POST["editusername"]."' ";

    $strSQL = "UPDATE stock SET ";
    $strSQL .= "stcode='".$_POST["editstcode"]."',storage_id='".$_POST["editstorage_id"]."',stname1='".$_POST["editstname1"]."',unit='".$_POST["editunit"]."',stmin1='".$_POST["editstmin1"]."' ";
    $strSQL .= ",stmin2='".$_POST["editstmin2"]."',sellprice='".$_POST["editsellprice"]."',status='".$_POST["editstatus"]."',s_date='".date("Y-m-d")."',s_time='".date("H:i:s")."'";
    $strSQL .= "WHERE code= '".$_POST["code"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขรหัสสินค้า '.$_POST["editstcode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>