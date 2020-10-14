<?php
	header('Content-Type: application/json');
    include('../../../conn.php');
    
    $StrSQL = "INSERT INTO unit (`unit`, `status`) ";
    $StrSQL .= "VALUES (";
    $StrSQL .= "'".$_POST["unit"]."','Y' ";
    $StrSQL .= ")";
    $query = mysqli_query($conn,$StrSQL);
    
    // echo $StrSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'เพิ่มหน่วยใช้ '.$_POST["unit"].' สำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'Error insert data!'));
        }
    
        mysqli_close($conn);
?>