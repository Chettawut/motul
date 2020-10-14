<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    
	// $strSQL = "UPDATE user SET ";
    // $strSQL .= "username='".$_POST["editusername"]."',password='".$_POST["editpassword"]."',firstname='".$_POST["editfirstname"]."',lastname='".$_POST["editlastname"]."',tel='".$_POST["edittel"]."' ";
    // $strSQL .= ",email='".$_POST["editemail"]."',type='".$_POST["edittype"]."',bankcode='".$_POST["editbankcode"]."',bankname='".$_POST["editbankname"]."',date='' ";
    // $strSQL .= "WHERE username= '".$_POST["editusername"]."' ";

    $strSQL = "UPDATE storage_unit SET ";
    $strSQL .= "storage_name='".$_POST["editstorage_name"]."',ratio='".$_POST["editratio"]."' ";
    $strSQL .= ",date='".date("Y-m-d")."',time='".date("H:i:s")."'";
    $strSQL .= "WHERE storage_id= '".$_POST["code"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขกลุ่ม '.$_POST["storage_name"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>