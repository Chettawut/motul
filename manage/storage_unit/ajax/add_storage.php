<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
    $StrSQL = "INSERT INTO storage_unit (storage_name,ratio,date,time) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["storage_name"]."','".$_POST["ratio"]."', '".date("Y-m-d")."','".date("H:i:s")."' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    
    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มกลุ่ม '.$_POST["storage_name"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>