<?php
	header('Content-Type: application/json');
	include('../../../../conn.php');
    
    date_default_timezone_set("Asia/Bangkok");
    
    $strSQL = "UPDATE data_report SET ";
    $strSQL .= "data='".$_POST["value"]."' ";
    $strSQL .= "WHERE num_order = '".$_POST["row"]."' and report = '1' ";

                            
	$query = mysqli_query($conn,$strSQL);
    
    // echo $strSQL;


        if($query) {
            echo json_encode(array('status' => '1','message'=> 'แก้ไขสำเร็จ'));
        }
        else
        {
            echo json_encode(array('status' => '0','message'=> 'หมายเลขหัวข้อการประชุมซ้ำ'));
        }
    
        mysqli_close($conn);
?>