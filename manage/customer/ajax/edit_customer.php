<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    
	// $strSQL = "UPDATE user SET ";
    // $strSQL .= "username='".$_POST["editusername"]."',password='".$_POST["editpassword"]."',firstname='".$_POST["editfirstname"]."',lastname='".$_POST["editlastname"]."',tel='".$_POST["edittel"]."' ";
    // $strSQL .= ",email='".$_POST["editemail"]."',type='".$_POST["edittype"]."',bankcode='".$_POST["editbankcode"]."',bankname='".$_POST["editbankname"]."',date='' ";
    // $strSQL .= "WHERE username= '".$_POST["editusername"]."' ";

    $strSQL = "UPDATE customer SET ";
    $strSQL .= "cuscode='".$_POST["editcuscode"]."',cusname='".$_POST["editcusname"]."',idno='".$_POST["editidno"]."',road='".$_POST["editroad"]."' ";
    $strSQL .= ",subdistrict='".$_POST["editsubdistrict"]."',district='".$_POST["editdistrict"]."',province='".$_POST["editprovince"]."' ";
    $strSQL .= ",zipcode='".$_POST["editzipcode"]."',tel='".$_POST["edittel"]."',fax='".$_POST["editfax"]."'";
    $strSQL .= ",taxnumber='".$_POST["edittaxnumber"]."',email='".$_POST["editemail"]."',status='".$_POST["editstatus"]."',s_date='".date("Y-m-d")."',s_time='".date("H:i:s")."' ";
    $strSQL .= "WHERE code= '".$_POST["code"]."' ";

                            
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขรหัสลูกค้า '.$_POST["editcuscode"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>