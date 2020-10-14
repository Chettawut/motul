<?php
	header('Content-Type: application/json');
	include('../../../conn.php');
    
    $strSQL = "UPDATE places SET ";
    $strSQL .= " places ='".$_POST["editplaces"]."',status='".$_POST["status"]."' ";
    $strSQL .= "WHERE placescode= '".$_POST["placescode"]."' ";

    
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไข location '.$_POST["editplaces"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>