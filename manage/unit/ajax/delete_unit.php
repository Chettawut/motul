<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    
	// $strSQL = "UPDATE user SET ";
    // $strSQL .= "username='".$_POST["editusername"]."',password='".$_POST["editpassword"]."',firstname='".$_POST["editfirstname"]."',lastname='".$_POST["editlastname"]."',tel='".$_POST["edittel"]."' ";
    // $strSQL .= ",email='".$_POST["editemail"]."',type='".$_POST["edittype"]."',bankcode='".$_POST["editbankcode"]."',bankname='".$_POST["editbankname"]."',date='' ";
    // $strSQL .= "WHERE username= '".$_POST["editusername"]."' ";

    $strSQL = "DELETE FROM unit ";    
    $strSQL .= "WHERE unitcode= '".$_POST["unitcode"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'ลบหน่วยใช้ '.$_POST["editunit"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>