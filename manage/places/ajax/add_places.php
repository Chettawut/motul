<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    $StrSQL = "INSERT INTO places (`places`, `status`) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["places"]."','Y' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    
    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่ม location '.$_POST["places"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>